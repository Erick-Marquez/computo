<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\IdentificationDocument;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Serie;
use App\Models\VoucherType;
use App\Services\KardexService;
use App\Services\NumberLetterService;
use Illuminate\Http\Request;

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
        $vouchers = Sale::all();
        return view('sales.vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $identificationDocuments = IdentificationDocument::all();
        $voucherTypes = VoucherType::offset(0)->limit(3)->get();
        $series = Serie::where('branch_id', 1)->get();
        return view('sales.vouchers.create', compact('customers', 'identificationDocuments', 'voucherTypes', 'series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $document_number = Serie::find($request->serie_id)->current_number + 1;
        $sale = Sale::create([
            'document_number' => $document_number,
            'date_issue' => $request->date_issue,
            'date_due' => $request->date_due,

            'observation' => $request->observation,
            'recived_money' => $request->recived_money,
            'change' => $request->change,

            'serie_id' => $request->serie_id,
            'customer_id' => $request->customer_id,
            'open_closed_cashbox_id' => $request->open_closed_cashbox_id,
            'user_id' => auth()->user()->id
        ]);
        

        $subtotalSale = 0;
        $totalIgvSale = 0;
        $totalExoneratedSale = 0;
        $totalUnaffectedSale = 0;
        $totalFreeSale = 0;
        $totalTaxedSale = 0;
        $totalSale = 0;

        for ($i = 0; $i < count($request->branch_product_id); $i++) { 

            //$product = BranchProduct::find($request->branch_product_id[$i]);

            $total_igv = 0;

            // Totales del detalle venta
            $subtotal = $request->quantity[$i] * $request->price[$i];
            $total = $request->quantity[$i] * $request->price[$i];

            // Suma en cadena para la venta
            $totalSale += $total;
            $subtotalSale += $subtotal;
            $totalExoneratedSale += $subtotal;

            SaleDetail::create([
                'price' => $request->price[$i],
                'quantity' => $request->quantity[$i],
                'total_igv' => $total_igv,
                'subtotal' => $subtotal,
                'total' => $total,
                //'discount' => $request->discount[$i],
                'sale_id' => $sale->id,
                'branch_product_id' => $request->branch_product_id[$i],
                'igv_type_id' => 8,
            ]);


            $data['branch_product_id'] = $request->branch_product_id[$i];
            $data['quantity'] = $request->quantity[$i];
            $data['document'] = $sale->serie->serie . '-' . $sale->document_number;
            $data['series'] = $request->serie[$i];
            $data['user_id'] = auth()->user()->id;
            
            $kardex = KardexService::sale($data);
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
        return redirect()->route('vouchers.index');
        
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $company = [];
        $head = Sale::find($sale->id);
        $details = $head->saleDetails;

        $qr = base64_encode(QrCode::format('png')->size(200)->generate('Hola'));
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
}
