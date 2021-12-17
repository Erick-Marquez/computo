<?php

namespace App\Http\Controllers;

use App\Http\Resources\SaleResource;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Voided;
use App\Services\Facturacion\Adapters\VoidedInputs;
use App\Services\Facturacion\VoidedService;
use App\Services\SunatService;
use Illuminate\Http\Request;

class VoidedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $voideds = Voided::with('sale.serie', 'sale.customer')->latest()->get();
        
        return SaleResource::collection($voideds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'sale_id' => 'required',
        ]);

        //Hallar la fecha de referencia

        $sale = Sale::findOrFail($request->sale_id);

        $numberVoidedToday = Voided::where('date_issue', now()->format('Y-m-d'))->count();
        $numeration = $numberVoidedToday + 1;

        $identifier = join('-', ['RA', now()->format('Ymd'), $numeration ]);

        $voided = Voided::create([
            'date_issue' => now()->format('Y-m-d'),
            'date_reference' => $sale->date_issue,
            'identifier' => $identifier,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'sale_id' => $request->sale_id
        ]);

        $sunat = SunatService::facturar($voided->id, 'voided');

        // $company = Company::active();

        // try {

        //     $inputs = VoidedInputs::getVoidedServiceInputs($voided, $company, $numeration, $request->description);

        //     $sunat = new VoidedService();
        //     $sunat->setDataVoided($inputs);
        //     $sunat->createXml();
        //     $sunat->singXml();
        //     $sunat->zipXml();
        //     $sunat->sendXmlSunat();
        //     $sunat->sendTicketSunat();
        //     $sunat->getCdr();
        //     $respose = $sunat->getResponse();

        //     $voided->update([

        //     ]);

        //     return $sunat->getMessage();
            
        // } catch (\Exception $e) {

        //     return response()->json($sunat->getMessage(), 500);

        // }


        
        if (!$sunat['response']['send']) { // Si no ha sido enviado
            $voided->update([
                'send_sunat' => $sunat['response']['send'],
                'state' => $sunat['response']['state'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
            return response()->json($sunat['response']['message']);
        } 

        if (!$sunat['response']['response_sunat']) { // Si no hay respuesta
            $voided->update([

                'send_sunat' => $sunat['response']['send'],
                'state' => $sunat['response']['state'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
            return response()->json($sunat['response']['message']);
        }

        $sale->update([
            'state' => Sale::ANULADO,
            'canceled' => true,
        ]);

        if (!$sunat['ticket']['send']) { // Si no ha sido enviado
            $voided->update([
                'ticket_number' => $sunat['response']['cod_ticket'],
                'send_sunat' => $sunat['ticket']['send'],
                'state' => $sunat['ticket']['state'],
                'response_sunat' => $sunat['ticket']['response_sunat'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
            return response()->json($sunat['ticket']['message']);
        }
        
        if (!$sunat['ticket']['response_sunat']) { // Si no hay respuesta
            $voided->update([
                'ticket_number' => $sunat['response']['cod_ticket'],
                'send_sunat' => $sunat['response']['send'],
                'state' => $sunat['response']['state'],
                'response_sunat' => $sunat['ticket']['response_sunat'],
                'hash_cpe' => $sunat['response']['hash_cpe']
            ]);
            return response()->json($sunat['response']['message']);
        }

        $voided->update([
            'ticket_number' => $sunat['response']['cod_ticket'],
            'state' => $sunat['ticket']['state'],

            'send_sunat' => $sunat['response']['send'],
            'response_sunat' => $sunat['response']['response_sunat'],
            'description_sunat_cdr' => $sunat['response']['message'],
            'hash_cdr' => $sunat['response']['hash_cdr'],
            'hash_cpe' => $sunat['response']['hash_cpe']
        ]);

        return response()->json($sunat['response']['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
