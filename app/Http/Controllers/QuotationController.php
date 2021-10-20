<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuotationResource;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationDetail;
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
        $quotations = Quotation::with('customer', 'user')->get();
        return QuotationResource::collection($quotations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtener la numeracion siguiente
        $documentNumber = Quotation::select("document_number")->latest()->first();
        $documentNumber = $documentNumber != null ? $documentNumber->document_number + 1 : 1;

        $quotation = Quotation::create([
            'observation' => $request->quotation['observation'],
            'document_number' => $documentNumber,
            'discount' => $request->quotation['discount'],
            'customer_id' => $request->customer['customer_id'],
            'user_id' => auth()->user()->id
        ]);

        
        $totalQuotation = 0;

        foreach ($request->detail as $key => $detail) {

            $total = $detail['quantity'] * $detail['sale_price'];
            $totalQuotation = $totalQuotation + $total;

            $quotationDetails = QuotationDetail::create([
                'price' => $detail['sale_price'],
                'quantity' => $detail['quantity'],
                'discount' => $detail['discount'],
                'total' => $total,
                'quotation_id' => $quotation->id,
                'branch_product_id' => $detail['product_id']
            ]);
        }
        
        $quotation->update([
            'total' => $totalQuotation - $request->quotation['discount']
        ]);


        return $quotation;
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
        $head = Quotation::where('id', $quotation->id)->with('quotationDetails.branchProduct.product', 'customer.identificationDocument')->firstOrFail();
        
        $details = $head->quotationDetails;

        $qr = base64_encode(QrCode::format('png')->size(200)->generate('Hola'));
    

        $pdf = PDF::loadView('templates.pdf.quotation-a4', compact('company', 'head', 'details', 'qr'))->setPaper('A4','portrait');

        

        // $text = join('|', [
        //     $this->company->number,
        //     $this->document->document_type_id,
        //     $this->document->series,
        //     $this->document->number,
        //     $this->document->total_igv,
        //     $this->document->total,
        //     $this->document->date_of_issue->format('Y-m-d'),
        //     $customer->identity_document_type_id,
        //     $customer->number,
        //     $this->document->hash
        // ]);

        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }
}
