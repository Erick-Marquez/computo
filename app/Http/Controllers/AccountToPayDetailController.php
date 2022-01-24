<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountToPayDetailResource;
use App\Models\AccountToPay;
use App\Models\AccountToPayDetail;
use Illuminate\Http\Request;

class AccountToPayDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountToPayDetails = AccountToPayDetail::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return AccountToPayDetailResource::collection($accountToPayDetails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|min:1', #|max:'.$account['debt'],
            'date_issue' => 'required|date',
            'payment_type_id' => 'required|exists:payment_types,id',
            'account_to_pay_id' => 'required|exists:accounts_to_pay,id'
        ]);

        $account = AccountToPay::findOrFail($request->account_to_pay_id);

        if ($account['debt'] < $request->amount) {
            return response()->json(['errors' => ['amount' => ['Su monto sobrepasa la deuda']]], 422);
        }

        try {
            AccountToPayDetail::create($request->all());

            $account->update([
                'debt' => $account['debt'] - $request->amount,
                'residue' => $account['residue'] + $request->amount
            ]);

            if ($account['debt'] == 0) {
                $account->purchase()->update([
                    'has_debt' => false,
                ]);
            }

            return response()->json(['message' => 'Pago exitoso']);
        } catch (\Throwable $th) {

            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountToPayDetail  $accountToPayDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AccountToPayDetail $accountToPayDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountToPayDetail  $accountToPayDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountToPayDetail $accountToPayDetail)
    {
        $request->validate([
            'id' => 'required|exists:account_to_pay_details,id',
            'payment_type_id' => 'required|exists:payment_types,id',
        ]);

        try {

            $accountToPayDetail->update([
                'payment_type_id' => $request->payment_type_id,
                'payd' => true,
                // 'open_closed_cashbox_id' => auth()->user()->open_closed_cashbox_id,
            ]);

            $account = $accountToPayDetail->accountToPay;

            $account->update([
                'debt' => $account['debt'] - $accountToPayDetail['amount'],
                'residue' => $account['residue'] + $accountToPayDetail['amount']
            ]);

            return response()->json(['message' => 'Pago exitoso']);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountToPayDetail  $accountToPayDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountToPayDetail $accountToPayDetail)
    {

        $account = $accountToPayDetail->accountToPay;

        $account->update([
            'debt' => $account['debt'] + $accountToPayDetail['amount'],
            'residue' => $account['residue'] - $accountToPayDetail['amount'],
        ]);

        if ($account['debt'] > 0) {
            $account->purchase()->update([
                'has_debt' => true,
            ]);
        }

        $accountToPayDetail->delete();
        return response()->json(['message' => 'Detalle de pago borrado!']);
    }
}
