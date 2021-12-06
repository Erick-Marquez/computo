<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentTypeResource;
use App\Models\PaymentType;

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
}
