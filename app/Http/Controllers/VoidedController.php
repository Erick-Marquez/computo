<?php

namespace App\Http\Controllers;

use App\Http\Resources\SaleResource;
use App\Models\Company;
use App\Models\Sale;
use App\Models\Voided;
use App\Services\Facturacion\Adapters\CompanyInputs;
use App\Services\Facturacion\Adapters\VoidedInputs;
use App\Services\Facturacion\Exception\TicketSunatOutOfServiceException;
use App\Services\Facturacion\Exception\TicketSunatRejectedException;
use App\Services\Facturacion\Exception\XmlSunatOutOfServiceException;
use App\Services\Facturacion\Exception\XmlSunatRejectedException;
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

        $company = Company::active();

        try {

            $inputs = VoidedInputs::getVoidedServiceInputs($sale, $numeration, $request->description);

            $service = new VoidedService(CompanyInputs::getCompanyInputs($company));
            $service->setDataVoided($inputs);
            $service->createXml();
            $service->singXml();
            $service->zipXml();
            $service->sendXmlSunat();
            $service->sendTicketSunat();
            $service->getCdr();

            $response = $service->getResponse();

            Voided::create([
                'date_issue' => now()->format('Y-m-d'),
                'date_reference' => $sale->date_issue,
                'identifier' => $identifier,
                'ticket_number' => $response['response']['cod_ticket'],
                'description' => $request->description,
                'state' => $response['ticket']['state'],
                'send_sunat' => $response['ticket']['send'],
                'description_sunat_cdr' => $response['response']['message'],
                'hash_cdr' => $response['response']['hash_cdr'],
                'hash_cpe' => $response['response']['hash_cpe'],
                'sale_id' => $request->sale_id,
                'user_id' => auth()->user()->id,
            ]);

            $sale->update([
                'state' => Sale::ANULADO,
                'canceled' => true
            ]);

            return response()->json([
                'message' => $response['response']['message']
            ]);

        } catch (XmlSunatOutOfServiceException $e) {

            return response()->json([
                'have_ticket' => false,
                'error' => $e->getMessage(),
                'message' => 'El comprobante no puede anularse.'
            ], 400);

        } catch (XmlSunatRejectedException $e) {

            $response = $service->getResponse();
            return response()->json([
                'have_ticket' => false,
                'error' => $e->getMessage(),
                'message' => $response['response']['message']
            ], 400);

        } catch (TicketSunatOutOfServiceException $e) {

            $response = $service->getResponse();

            Voided::create([
                'date_issue' => now()->format('Y-m-d'),
                'date_reference' => $sale->date_issue,
                'identifier' => $identifier,
                'ticket_number' => $response['response']['cod_ticket'],
                'description' => $request->description,
                'state' => $response['ticket']['state'],
                'send_sunat' => $response['ticket']['send'],
                'hash_cpe' => $response['response']['hash_cpe'],
                'sale_id' => $request->sale_id,
                'user_id' => auth()->user()->id,
            ]);

            $sale->update([
                'state' => Sale::ANULADO,
                'canceled' => true
            ]);

            return response()->json([
                'have_ticket' => true,
                'error' => $e->getMessage(),
                'message' => 'Comprobante Anulado, consulte el estado del ticket en unos minutos.'
            ], 400);

        } catch (TicketSunatRejectedException $e) {

            $response = $service->getResponse();

            Voided::create([
                'date_issue' => now()->format('Y-m-d'),
                'date_reference' => $sale->date_issue,
                'identifier' => $identifier,
                'ticket_number' => $response['response']['cod_ticket'],
                'description' => $request->description,
                'state' => $response['ticket']['state'],
                'send_sunat' => $response['ticket']['send'],
                'hash_cpe' => $response['response']['hash_cpe'],
                'description_sunat_cdr' => $response['ticket']['response']['message'],
                'sale_id' => $request->sale_id,
                'user_id' => auth()->user()->id,
            ]);

            $sale->update([
                'state' => Sale::ANULADO,
                'canceled' => true
            ]);

            return response()->json([
                'have_ticket' => true,
                'error' => $e->getMessage(),
                'message' => $response['ticket']['response']['message']
            ],  400);

        } catch (\Exception $e) {

            return response()->json([
                'have_ticket' => false,
                'error' => 'Algo esta pasando, ponganse en contacto con el administrador del sistema.',
                'message' => $e->getMessage()
            ], 400);

        }
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

    public function ticketStatus(Request $request)
    {
        $company = Company::active();
        $voided = Voided::findOrFail($request->voided_id);

        try {
            $service = new VoidedService(CompanyInputs::getCompanyInputs($company));
            $service->setTicket($voided->ticket_number, $voided->identifier);
            $service->sendTicketSunat();
            $service->getCdr();

            $response = $service->getResponse();

            $voided->update([
                'state' => $response['ticket']['state'],
                'send_sunat' => $response['ticket']['send'],
                'description_sunat_cdr' => $response['response']['message'],
                'hash_cdr' => $response['response']['hash_cdr'],
            ]);

            return response()->json([
                'message' => $response['response']['message']
            ]);
            
        } catch (TicketSunatOutOfServiceException $e) {

            $response = $service->getResponse();

            return response()->json([
                'have_ticket' => true,
                'error' => $e->getMessage(),
                'message' => 'Consulte el estado del ticket en unos minutos.'
            ], 400);

        } catch (TicketSunatRejectedException $e) {

            $response = $service->getResponse();

            $voided->update([
                'state' => $response['ticket']['state'],
                'send_sunat' => $response['ticket']['send'],
                'description_sunat_cdr' => $response['response']['message'],
            ]);

            return response()->json([
                'have_ticket' => true,
                'error' => $e->getMessage(),
                'message' => $response['ticket']['response']['message']
            ],  400);

        } catch (\Exception $e) {

            return response()->json([
                'have_ticket' => false,
                'error' => 'Algo esta pasando, ponganse en contacto con el administrador del sistema.',
                'message' => $e->getMessage()
            ], 400);

        }
        
    }
}
