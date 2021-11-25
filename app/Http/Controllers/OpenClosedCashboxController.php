<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpenClosedCashboxResource;
use App\Models\OpenClosedCashbox;
use Illuminate\Http\Request;

class OpenClosedCashboxController extends Controller
{
    public function index()
    {
        $occ = OpenClosedCashbox::included()
                                ->filter()
                                ->sort()
                                ->dateInterval()
                                ->getOrPaginate();

        return OpenClosedCashboxResource::collection($occ);
    }

    public function report()
    {
    }
}
