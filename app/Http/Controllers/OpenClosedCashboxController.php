<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpenClosedCashboxResource;
use App\Models\Company;
use App\Models\OpenClosedCashbox;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

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

    public function report(OpenClosedCashbox $occ)
    {
        $company = Company::first();
        $salesPayment = $occ->salesPayment();
        $expenses = $occ->getExpenses();
        $incomes = $occ->getIncomes();
        $total = $occ->getMovementsTotal();
        $salesNull = $occ->getSalesNull();

        $pdf = \PDF::loadView('templates.pdf.reports.cashbox', compact('occ', 'company', 'salesPayment', 'expenses', 'incomes', 'total'))->setPaper('A4');
        return $pdf->stream();
    }
}
