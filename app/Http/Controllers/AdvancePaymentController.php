<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvancePaymentRequest;
use App\Http\Resources\QuotationResource;
use App\Models\PaymentTypeQuotation;
use App\Models\Quotation;
use Illuminate\Http\Request;

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
            ->with('customer', 'user', 'serie', 'paymentTypes')
            ->withMax('paymentTypes as last_created_at_advance_payment', 'payment_type_quotation.created_at')
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
        PaymentTypeQuotation::where('quotation_id', $request->id_quotation)->delete();

        $advancePayments = [];
        $now = now();

        foreach ($request->payments as $payment) {
            
            $advancePayment['quotation_id'] = $request->id_quotation;
            $advancePayment['payment_type_id'] = $payment['payment_type_id'];
            $advancePayment['amount'] = $payment['amount'];
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


    public function quotation($serie, $number)
    {
        $quotation = Quotation::with('customer', 'user', 'serie', 'paymentTypes')
            ->where('serie_id', $serie)
            ->where('document_number', $number)
            ->firstOrFail();

        return QuotationResource::make($quotation);
    }
}
