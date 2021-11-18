<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\SerieResource;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use App\Models\Serie;
use Illuminate\Http\Request;

use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::with('customer', 'user','serie')->get();
        return QuotationResource::collection($quotations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationRequest $request)
    {
        
        
        // return $request;

        if (is_null($request->customer['id'])) {
            $customer = Customer::create([
                'name' => $request->customer['name'],
                'document' => $request->customer['document'],
                'phone' => $request->customer['phone'],
                'email' => $request->customer['email'],
                'address' => $request->customer['address'],
                'identification_document_id' => $request->customer['identification_document_id'],
            ]);
            $request->customer['id'] = $customer->id;
        }

        // Obtener la numeracion siguiente
        $serie = Serie::find($request->quotation['serie_id']);
        $serie->current_number = $serie->current_number + 1;
        $serie->save();

        // Crear la cotizacion
        $quotation = Quotation::create([

            'document_number' => $serie->current_number,
            'date_due' => $request->quotation['date_due'],

            'discount' => $request->quotation['discount'],

            'have_warranty' => $request->quotation['warranty'],

            'observation' => $request->quotation['observation'],

            'payment_type_id' => $request->quotation['payment_type_id'],
            'serie_id' => $request->quotation['serie_id'],
            'customer_id' => $request->customer['id'],
            'user_id' => auth()->user()->id
        ]);

        // Variables para los totales de la cotizacion
        $subtotalQuotation = 0;
        $totalIgvQuotation = 0;
        $totalExoneratedQuotation = 0;
        $totalUnaffectedQuotation = 0;
        $totalFreeQuotation = 0;
        $totalTaxedQuotation = 0;
        $totalQuotation = 0;

        $igv = 0.18;
        // Crear los detalles de la cotizacion
        foreach ($request->detail as $key => $detail) {

            $subtotal = 0;
            $totalIgv = 0;
            $total = 0;

            switch ($detail['igv_type_id']) {
                case 10:
                    // hallar el precio sin igv
                    $priceWithoutIgv = $detail['sale_price'] / (1 + $igv);
        
                    // hallar el subtotal = (precio sin igv * cantidad) - descuento
                    $subtotal = round($priceWithoutIgv * $detail['quantity'], 2) - $detail['discount'];
        
                    // hallar el total = (subtotal * 1.18)
                    $total = round($subtotal * (1 + $igv), 2);
                    
                    // hallar el igv = (total - subtotal)
                    $totalIgv = $total - $subtotal;
        
                    // Actualizar totales globales
                    $subtotalQuotation += $subtotal;
                    $totalIgvQuotation += $totalIgv;
                    $totalTaxedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 11:
                case 12:
                case 13:
                case 14:
                case 15:
                case 16:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalQuotation += $subtotal;
                    $totalFreeQuotation += $total;
                    break;
                case 20:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalQuotation += $subtotal;
                    $totalExoneratedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 30:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalQuotation += $subtotal;
                    $totalUnaffectedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                case 31:
                case 32:
                case 33:
                case 34:
                case 35:
                case 36:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalQuotation += $subtotal;
                    $totalFreeQuotation += $total;
                    break;
                case 40:
                    $subtotal = round($detail['sale_price'] * $detail['quantity'], 2) - $detail['discount'];
                    $total = $subtotal;

                    $subtotalQuotation += $subtotal;
                    $totalUnaffectedQuotation += $subtotal;
                    $totalQuotation += $total;
                    break;
                default:
                    # code...
                    break;
            }

            $quotationDetails = QuotationDetail::create([

                'discount' => $detail['discount'],
                'price' => $detail['sale_price'],
                'quantity' => $detail['quantity'],

                'total_igv' => $totalIgv,
                'subtotal' => $subtotal,
                'total' => $total,

                'igv_type_id' => $detail['igv_type_id'],
                'quotation_id' => $quotation->id,
                'branch_product_id' => $detail['product_id']

            ]);
        }
        
        $quotation->update([
            'subtotal' => $subtotalQuotation,
            'total_igv' => $totalIgvQuotation,
            'total_exonerated' => $totalExoneratedQuotation,
            'total_unaffected' => $totalUnaffectedQuotation,
            'total_free' => $totalFreeQuotation,
            'total_taxed' => $totalTaxedQuotation,
            'total' => $totalQuotation
        ]);

        return $serie->serie . '-' .$quotation->document_number;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
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
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function print(Quotation $quotation)
    {
        $company = Company::find(1);
        $head = Quotation::where('id', $quotation->id)->with('quotationDetails.branchProduct.product', 'customer.identificationDocument', 'serie.voucherType')->firstOrFail();
        
        $details = $head->quotationDetails;

        $text = join('|', [
            $company->ruc,
            'Cotizacion',
            $head->serie->serie,
            $head->document_number,
            $head->total,
            $head->customer->identificationDocument->id,
            $head->customer->document,
        ]);

        $qr = base64_encode(QrCode::format('png')->size(200)->generate($text));
    

        $pdf = PDF::loadView('templates.pdf.quotation-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4','portrait');



        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }

    public function series()
    {
        $series = Serie::where('branch_id', auth()->user()->branch_id)->where('voucher_type_id', 8)->get(); //voucher type 8 = cotizacion
        return SerieResource::collection($series);
    }
}
