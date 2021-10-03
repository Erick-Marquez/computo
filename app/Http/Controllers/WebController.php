<?php

namespace App\Http\Controllers;

use App\Services\SunatService;
use Illuminate\Http\Request;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{
    public function familiesLinesBrands()
    {
        return view('catalogs.families-lines-brands.index');
    }

    public function productSeries()
    {
        return view('catalogs.product-series.index');
    }


    public function branches()
    {
        return view('inventory.branches.index');
    }

    public function kardex()
    {
        return view('inventory.kardex.index');
    }

    public function prueba()
    {    
        return SunatService::facturar(1, 'credit');
    }
}
