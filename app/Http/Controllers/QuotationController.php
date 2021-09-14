<?php

namespace App\Http\Controllers;

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
        $quotations = Quotation::all();
        return view('sales.quotations.index', compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('sales.quotations.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quotation = Quotation::create([
            'total' => $request->cod,
            'observation' => $request->observation,
            'customer_id' => $request->customer_id,
            'user_id' => auth()->user()->id
        ]);
        
        $totalQuotation = 0;

        for ($i=0; $i < count($request->product_id); $i++) { 

            $total = $request->quantity[$i] * $request->price[$i];

            $totalQuotation = $totalQuotation + $total;

            $quotationDetails = QuotationDetail::create([
                'price' => $request->cod,
                'quantity' => $request->quantity[$i],
                'total' => $total,
                'quotation_id' => $quotation->id,
                'product_id' => $request->product_id[$i]
            ]);
        }
        
        $quotation->update([
            'total' => $totalQuotation
        ]);


        return redirect()->route('quotations.index');
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
        $company = [];
        $head = Quotation::find($quotation->id);
        $details = $head->quotationDetails;
        // $qr = base64_encode(QrCode::format('png')->size(200)->generate('Hola'));
        // dd($qr);

        $pdf = PDF::loadView('templates.pdf.quotation-a4', compact('company', 'head', 'details'))->setPaper('A4','portrait');

        

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
