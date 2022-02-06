<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\OpenClosedCashboxDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class OpenClosedCashboxDetailController extends Controller
{
    public function printDetail($occd_id)
    {

        $detail = OpenClosedCashboxDetail::find($occd_id);
        $company = Company::active();


        $pdf = PDF::loadView('templates.pdf.cashbox-movements.cashbox-movements-ticket', compact('detail', 'company'))->setPaper(array(0,0,220,700), 'portrait');
        return $pdf->stream();
    }
}
