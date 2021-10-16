<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\VoucherType;
use App\Services\KardexService;
use App\Services\SunatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{

    public function newSale()
    {
        return view('sales.new-sale.index');
    }

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

    public function branchMovements()
    {
        return view('inventory.branch-movements.index');
    }

    public function kardex()
    {
        return view('inventory.kardex.index');
    }

    public function cashboxes()
    {
        return view('cashboxes.open-closed.index');
    }

    public function expensesIncomes()
    {
        return view('cashboxes.expenses-incomes.index');
    }

    public function sales()
    {
        return view('sales.vouchers.index');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function stockModifications()
    {
        return view('inventory.stock-modifications.index');
    }

    public function devolutions()
    {
        return view('inventory.devolutions.index');
    }

    /*========Configuracion=========*/

    public function company()
    {
        return view('settings.company.index');
    }

    public function users()
    {
        return view('settings.users.index');
    }

    public function roles()
    {
        return view('settings.roles.index');
    }

    public function series()
    {
        return view('settings.series.index');
    }

    public function currencyExchanges()
    {
        return view('settings.currency-exchanges.index');
    }

    public function prueba()
    {
        // $data['branch_product_id'] = 1;
        // $data['quantity'] = 2;
        // $data['document'] = "F001" . '-' . "352";
        // //$data['operation'] = "resta";
        // $data['series'] = ["TDX00N", "TDX01N"];
        // $data['user_id'] = auth()->user()->id;

        // KardexService::purchase($data);
        // return SunatService::facturar(1, 'invoice');

        $branch = VoucherType::find(1);
        return $branch->branches;
    }
}
