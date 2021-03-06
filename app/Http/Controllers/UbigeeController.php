<?php

namespace App\Http\Controllers;

use App\Http\Resources\UbigeeResource;
use App\Models\Ubigee;
use Illuminate\Http\Request;

class UbigeeController extends Controller
{
    public function index()
    {
        $ubigees = Ubigee::included()
                                ->filter()
                                ->sort()
                                ->getOrPaginate();

        return UbigeeResource::collection($ubigees);
    }
}
