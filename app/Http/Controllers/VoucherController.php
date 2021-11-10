<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchProductResource;
use App\Http\Resources\BranchProductSerieResource;
use App\Http\Resources\IdentificationDocumentResource;
use App\Http\Resources\IgvTypeResource;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\SaleResource;
use App\Http\Resources\SerieResource;
use App\Http\Resources\VoucherTypeResource;
use App\Models\BranchProduct;
use App\Models\BranchProductSerie;
use App\Models\Company;
use App\Models\CurrencyExchange;
use App\Models\Customer;
use App\Models\IdentificationDocument;
use App\Models\IgvType;
use App\Models\PaymentType;
use App\Models\Quotation;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Serie;
use App\Models\VoucherType;
use App\Services\KardexService;
use App\Services\NumberLetterService;
use App\Services\SunatService;
use Illuminate\Http\Request;

use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Sale::whereHas('serie', function($q) {
            $q->where('voucher_type_id', '!=', 3); // 3 - id de nota de venta
        })->with('serie.voucherType', 'customer')->get();
        
        return SaleResource::collection($vouchers);
    }

    public function saleNotes()
    {
        $vouchers = Sale::whereHas('serie', function($q) {
            $q->where('voucher_type_id', '=', 3);
        })->with('serie.voucherType', 'customer')->get();
        
        return SaleResource::collection($vouchers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        
        // $request->detail[0]['series'][0]['serie']
        $serie = Serie::find($request->voucher['serie_id']);
        $serie->current_number = $serie->current_number + 1;
        $serie->save();

        $sale = Sale::create([
            'document_number' => $serie->current_number,
            'date_issue' => $request->voucher['date_issue'],
            'date_due' => $request->voucher['date_due'],

            'observation' => $request->voucher['observation'],
            'discount' => $request->voucher['discount'],
            'received_money' => $request->voucher['received_money'],
            'change' => $request->voucher['change'],

            'have_warranty' => $request->voucher['warranty'], 

            'payment_type_id' => $request->voucher['payment_type_id'],
            'serie_id' => $request->voucher['serie_id'],
            'customer_id' => $request->customer['id'],
            //'open_closed_cashbox_id' => $request->open_closed_cashbox_id,
            'user_id' => auth()->user()->id
        ]);

        $subtotalSale = 0;
        $totalIgvSale = 0;
        $totalExoneratedSale = 0;
        $totalUnaffectedSale = 0;
        $totalFreeSale = 0;
        $totalTaxedSale = 0;
        $totalSale = 0;

        for ($i = 0; $i < count($request->detail); $i++) {

            $productSeries = [];

            for ($j=0; $j < count($request->detail[$i]['series']) ; $j++) {
                array_push($productSeries, $request->detail[$i]['series'][$j]['serie']);
            }

            $total_igv = 0;

            // Totales del detalle venta
            $subtotal = $request->detail[$i]['quantity'] * $request->detail[$i]['sale_price'];
            $total = $request->detail[$i]['quantity'] * $request->detail[$i]['sale_price'];

            // Suma en cadena para la venta
            $totalSale += $total;
            $subtotalSale += $subtotal;
            $totalExoneratedSale += $subtotal;

            SaleDetail::create([
                'price' => $request->detail[$i]['sale_price'],
                'quantity' => $request->detail[$i]['quantity'],
                'total_igv' => $total_igv,
                'subtotal' => $subtotal,
                'total' => $total,
                //'discount' => $request->discount[$i],
                'series' => $productSeries,
                'sale_id' => $sale->id,
                'branch_product_id' => $request->detail[$i]['product_id'],
                'igv_type_id' => $request->detail[$i]['igv_type_id'],
            ]);


            $data['branch_product_id'] = $request->detail[$i]['product_id'];
            $data['quantity'] = $request->detail[$i]['quantity'];
            $data['document'] = $sale->serie->serie . '-' . $sale->document_number;
            $data['series'] = $request->detail[$i]['series'];
            $data['user_id'] = auth()->user()->id;

            KardexService::sale($data);
        }

        $sale->update([
            'subtotal' => $subtotalSale,
            'total_igv' => $totalIgvSale,
            'total_exonerated' => $totalExoneratedSale,
            'total_unaffected' => $totalUnaffectedSale,
            'total_free' => $totalFreeSale,
            'total_taxed' => $totalTaxedSale,
            'total' => $totalSale
        ]);

        // Enviar a Sunat
        if ($request->voucher['document_type'] == 1) { // Factura

            $sunat = SunatService::facturar($sale->id, 'invoice');

            $sale->update([
                'send_sunat' => $sunat['send'],
                'state' => $sunat['state'],
                'response_sunat' => $sunat['response_sunat'],
                'description_sunat_cdr' => $sunat['response']['message'],
                'hash_cdr' => $sunat['response']['hash_cdr']
            ]);
        }
        elseif ($request->voucher['document_type'] == 2) { // Boleta
            
            $sunat = SunatService::facturar($sale->id, 'ticket');

            $sale->update([
                'send_sunat' => $sunat['send'],
                'state' => $sunat['state'],
                'response_sunat' => $sunat['response_sunat'],
                'description_sunat_cdr' => $sunat['response']['message'],
                'hash_cdr' => $sunat['response']['hash_cdr']
            ]);
        }
        else {

            return "Nota de Venta Guardada";

        }

        return $sale->description_sunat_cdr;

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

    public function print($type, Sale $sale)
    {
        $company = Company::find(1);
        $head = Sale::where('id', $sale->id)->with('saleDetails.branchProduct.product', 'customer.identificationDocument', 'serie.voucherType')->firstOrFail();
        $details = $head->saleDetails;

        $text = join('|', [
            $company->ruc,
            $head->serie->voucherType->id,
            $head->serie->serie,
            $head->document_number,
            $head->total_igv,
            $head->total,
            $head->date_issue,
            $head->customer->identificationDocument->id,
            $head->customer->document,
            $head->hash_cdr
        ]);

        $qr = base64_encode(QrCode::format('png')->size(200)->generate($text));

        if ($type == 'A4') {
            $pdf = PDF::loadView('templates.pdf.sale-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4','portrait');
        }
        if ($type == 'TICKET') {
            $pdf = PDF::loadView('templates.pdf.sale-ticket', compact('company', 'head', 'details', 'qr'))->setPaper(array(0,0,220,700),'portrait');
        }
        if ($type == 'WARRANTY') {
            $pdf = PDF::loadView('templates.pdf.warranty-a4', compact('company', 'head', 'details'))->setPaper('A4','portrait');
        }


        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }

    public function download($voucherType, $type, Sale $sale)
    {
        $company = Company::findorFail(1);

        $pathToFile = 'app'.DIRECTORY_SEPARATOR.'Facturacion';

        switch ($voucherType) {
            case '01': // Factura
                $pathToFile .= DIRECTORY_SEPARATOR.'Factura';
                break;
            case '03': //Boleta
                $pathToFile .= DIRECTORY_SEPARATOR.'Boleta';
                break;
            case '07': //Nota de credito
                $pathToFile .= DIRECTORY_SEPARATOR.'NotaCredito';
                break;
            case '08': //Nota de debito
                $pathToFile .= DIRECTORY_SEPARATOR.'NotaDebito';
                break;
            case 'baja': //Comunicacion de baja
                $pathToFile .= DIRECTORY_SEPARATOR.'Baja';
                break;
            default:
                break;
        }

        if ($type == 'xml') {
            $pathToFile .= DIRECTORY_SEPARATOR.'ZipXml'.DIRECTORY_SEPARATOR;
            //nombre del zip del xml del comprabante solicitado
            $nameZip = $company->ruc . '-' . $sale->serie->voucherType->cod . '-' . $sale->serie->serie . '-' . $sale->document_number . '.zip';
           
            $pathToFile .= $nameZip;
        }
        else if ($type == 'cdr') {
            $pathToFile .= DIRECTORY_SEPARATOR.'Cdr'.DIRECTORY_SEPARATOR;
            //nombre del zip del cdr del comprabante solicitado
            $nameZip = 'R-' . $company->ruc . '-' . $sale->serie->voucherType->cod . '-' . $sale->serie->serie . '-' . $sale->document_number . '.zip';
            
            $pathToFile .= $nameZip;
        }

        return response()->download(storage_path($pathToFile));
    }

    public function voucherTypes()
    {
        $voucherTypes = VoucherType::offset(0)->limit(3)->get();
        return VoucherTypeResource::collection($voucherTypes);
    }

    public function igvTypes()
    {
        $igvTypes = IgvType::all();
        return IgvTypeResource::collection($igvTypes);
    }

    public function series($id)
    {
        $series = Serie::where('branch_id', auth()->user()->branch_id)->where('voucher_type_id', $id)->get();
        return SerieResource::collection($series);
    }

    public function identificationDocuments()
    {
        $identificationDocuments = IdentificationDocument::all();
        return IdentificationDocumentResource::collection($identificationDocuments);
    }

    public function paymentTypes()
    {
        $paymentTypes = PaymentType::all();
        return PaymentTypeResource::collection($paymentTypes);
    }

    public function products()
    {
        $branchProducts = BranchProduct::where('branch_id', auth()->user()->branch_id)->with('product.brandLine.brand')->get();
        return BranchProductResource::collection($branchProducts);
    }

    public function productSeries($id)
    {
        $branchProductSeries = BranchProductSerie::where('branch_product_id', $id)->where('active', true)->where('sold', false)->get();
        return BranchProductSerieResource::collection($branchProductSeries);
    }

    public function quotation($serie, $number)
    {
        $quotation = Quotation::where('document_number', $number)->where('serie_id', $serie)->with('quotationDetails.branchProduct.product')->firstOrFail();
        return QuotationResource::make($quotation);
    }
}
