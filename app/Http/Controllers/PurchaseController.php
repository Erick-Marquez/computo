<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Company;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Services\PurchaseService;
use Barryvdh\DomPDF\PDF;
class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->purchaseService = new PurchaseService();
    }

    public function index()
    {
        $purchases = Purchase::included()
                                ->filter()
                                ->search()
                                ->sort()
                                ->getOrPaginate();

        return PurchaseResource::collection($purchases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        return $this->purchaseService->storePurchase($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }


    public function printPurchase(Purchase $purchase)
    {
        $company = Company::all()->first();
        $pdf = \PDF::loadView('templates.pdf.purchase', compact('company', 'purchase'))->setPaper('A4','portrait');
        return $pdf->stream();
    }
}
