<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountToPayResource;
use App\Models\AccountToPay;
use Illuminate\Http\Request;

class AccountToPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountsToPay = AccountToPay::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return AccountToPayResource::collection($accountsToPay);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountToPay  $accountToPay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accountToPay = AccountToPay::included()->findOrFail($id);
        return AccountToPayResource::make($accountToPay);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountToPay  $accountToPay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountToPay $accountToPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountToPay  $accountToPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountToPay $accountToPay)
    {
        //
    }
}
