<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvancePaymentRequest;
use App\Http\Resources\GlobalResource;
use App\Http\Resources\QuotationResource;
use App\Models\Company;
use App\Models\PaymentTypeQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class AdvancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advancePayments = Quotation::has('paymentTypes')
            ->with('customer', 'user', 'serie', 'paymentTypeQuotations')
            ->withMax('paymentTypes as last_created_at_advance_payment', 'payment_type_quotation.updated_at')
            ->withSum('paymentTypes as total_advance_payment', 'payment_type_quotation.amount')
            ->orderBy('last_created_at_advance_payment', 'DESC')->get();

        return QuotationResource::collection($advancePayments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvancePaymentRequest $request)
    {
        $advancePayments = [];
        $now = now();

        foreach ($request->newPayments as $newPayment) {

            $advancePayment['quotation_id'] = $request->id_quotation;
            $advancePayment['payment_type_id'] = $newPayment['payment_type_id'];
            $advancePayment['amount'] = $newPayment['amount'];
            $advancePayment['open_closed_cashbox_id'] = auth()->user()->open_closed_cashbox_id;
            $advancePayment['created_at'] = $now;
            $advancePayment['updated_at'] = $now;

            $advancePayments[] = $advancePayment;
        }

        return PaymentTypeQuotation::insert($advancePayments);
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
     * @param  PaymentTypeQuotation  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentTypeQuotation $advancePayment)
    {
        $request->validate([
            'payment_type_id' => 'required',
            'amount' => 'required'
        ]);

        $advancePayment->update([
            'payment_type_id' => $request->payment_type_id,
            'amount' => $request->amount,
            'updated_at' => now()
        ]);

        return GlobalResource::make($advancePayment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PaymentTypeQuotation  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentTypeQuotation $advancePayment)
    {
        $advancePayment->delete();
        return response()->noContent();
    }


    public function quotation($serie, $number)
    {
        $quotation = Quotation::with('customer', 'user', 'serie', 'paymentTypeQuotations')
            ->where('serie_id', $serie)
            ->where('document_number', $number)
            ->firstOrFail();

        return QuotationResource::make($quotation);
    }

    public function print($type, $id)
    {

        $advancePayment = PaymentTypeQuotation::with('quotation.quotationDetails.branchProduct.product', 'quotation.serie', 'quotation.customer.identificationDocument', 'paymentType')->findOrFail($id);
        $advancePayments = PaymentTypeQuotation::where('quotation_id', $advancePayment->quotation_id)->get();
        $company = Company::active();


        $pdf = PDF::loadView('templates.pdf.advance-payments.advance-payments-ticket', compact('advancePayment', 'advancePayments', 'company'))->setPaper(array(0,0,220,700), 'portrait');

        // TICKET
        //setPaper(array(0,0,220,700)

        return $pdf->stream();
    }
}
