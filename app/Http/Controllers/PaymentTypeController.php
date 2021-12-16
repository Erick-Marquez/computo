<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentTypes = PaymentType::included()
                                    ->filter()
                                    ->sort()
                                    ->getOrPaginate();

        return PaymentTypeResource::collection($paymentTypes);
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
        $paymentType = PaymentType::create([
            'description' => $request->description,
        ]);

        return response()->json($paymentType);
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
        $paymentType = PaymentType::findOrFail($id);

        $paymentType->update([
            'description' => $request->description,
        ]);
        return response()->json($paymentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentType = PaymentType::findOrFail($id);

        if ($paymentType->sales()->count() || $paymentType->quotations()->count() || $paymentType->accountToPayDetails()->count()) {
            return response()->json(['error' => 'Este tipo de pago esta siendo utilizado.'], 405);
        }
        
        $paymentType->delete();
        return response()->json(['message' => 'El tipo de pago ha sido eliminado']);
    }
}
