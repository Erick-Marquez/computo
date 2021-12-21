<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Http\Resources\BranchProductResource;
use App\Http\Resources\BranchProductSerieResource;
use App\Http\Resources\CurrencyExchangeResource;
use App\Http\Resources\GlobalResource;
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
use App\Models\Product;
use App\Models\Quotation;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Serie;
use App\Models\VoucherType;
use App\Models\Warranty;
use App\Models\WarrantyDetail;
use App\Services\KardexService;
use App\Services\NumberLetterService;
use App\Services\SaleService;
use App\Services\SunatService;
use Illuminate\Http\Request;

use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VoucherController extends Controller
{

    public function __construct()
    {   
        $this->saleService = new SaleService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Sale::whereHas('serie', function($q) {
            $q->where('voucher_type_id', '!=', 3)
            ->where('branch_id', auth()->user()->branch_id); // 3 - id de nota de venta
        })
        ->with('serie.voucherType', 'customer')->latest()->get();
        
        return SaleResource::collection($vouchers);
    }

    public function saleNotes()
    {
        $vouchers = Sale::whereHas('serie', function($q) {
            $q->where('voucher_type_id', '=', 3)
            ->where('branch_id', auth()->user()->branch_id);
        })->with('serie.voucherType', 'customer')->latest()->get();
        
        return SaleResource::collection($vouchers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $identificationDocuments = IdentificationDocument::all();
        $currencyExchange = CurrencyExchange::latest()->first();
        $igvTypes = IgvType::all();
        $paymentTypes = PaymentType::all();
        $voucherTypes = VoucherType::whereIn('id', [1, 2, 3])->get();

        $series = Serie::where('branch_id', auth()->user()->branch_id)->whereNotIn('voucher_type_id', [4, 5, 6, 7])->get(); //Filtrar en el fronted

        return GlobalResource::make([ 
            'currencyExchange' => $currencyExchange,
            'identificationDocuments' => $identificationDocuments,
            'igvTypes' => $igvTypes,
            'paymentTypes' => $paymentTypes,
            'voucherTypes' => $voucherTypes,
            
            'series' => $series,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {    
        //Datos adicionales para el guardar la venta en el servicio
        $request->offsetSet('open_closed_cashbox_id', auth()->user()->open_closed_cashbox_id);
        $request->offsetSet('user_id', auth()->user()->id);
        
        return $this->saleService->storeSale($request);

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
        $company = Company::findOrFail(1);
        $head = Sale::with('saleDetails.branchProduct.product', 'customer.identificationDocument', 'serie.voucherType', 'paymentTypes', 'quotation.user')->findOrFail($sale->id);

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
            $pdf = PDF::loadView('templates.pdf.sale-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4', 'portrait');
        }
        if ($type == 'TICKET') {
            $pdf = PDF::loadView('templates.pdf.sale-ticket', compact('company', 'head', 'details', 'qr'))->setPaper(array(0,0,220,700), 'portrait');
        }
        if ($type == 'WARRANTY') {

            $head = Warranty::where('sale_id', $sale->id)->with('warrantyDetails.branchProduct.product', 'customer.identificationDocument', 'serie.voucherType')->firstOrFail();
            $details = $head->warrantyDetails;
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

    public function searchProducts($search)
    {
        $branchProducts = BranchProduct::from('branch_product AS bp')
            ->where('bp.branch_id', auth()->user()->branch_id)
            ->where('p.name', 'like', '%' . $search . '%')
            ->orWhere('p.cod', 'like', '%' . $search . '%')
            ->join('products AS p', 'bp.product_id', '=', 'p.id')
            ->join('brand_line AS bl', 'p.brand_line_id', '=', 'bl.id')
            ->join('brands AS b', 'bl.brand_id', '=', 'b.id')
            ->select(
                'bp.id', 'p.cod', 'p.name', 'b.description as brand', 'p.manager_series', 'bp.stock', 'bp.igv_type_id',
                'bp.sale_price', 'bp.referential_sale_price_one', 'bp.referential_sale_price_two'
                )
            ->limit(10)
            ->get();
        return GlobalResource::collection($branchProducts);
    }

    public function searchSeries($branchProductId, $search)
    {
        $branchProductSeries = BranchProductSerie::select('serie')
            ->where('branch_product_id', $branchProductId)
            ->where('sold', 0)
            ->where('serie', 'like', '%' . $search . '%')
            ->limit(10)
            ->get();
        return GlobalResource::collection($branchProductSeries);
    }

    public function productSeries($id)
    {
        $branchProductSeries = BranchProductSerie::where('branch_product_id', $id)->where('active', true)->where('sold', false)->get();
        return BranchProductSerieResource::collection($branchProductSeries);
    }

    public function quotation($serie, $number)
    {
        $quotation = Quotation::where('document_number', $number)->where('serie_id', $serie)->with('quotationDetails.branchProduct.product.brandLine.brand', 'paymentTypes')->firstOrFail();
        return QuotationResource::make($quotation);
    }

    public function currencyExchange()
    {
        $currencyExchange = CurrencyExchange::latest()->first();
        return CurrencyExchangeResource::make($currencyExchange);
    }

}
