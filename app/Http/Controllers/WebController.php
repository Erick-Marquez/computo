<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\CurrencyExchange;
use App\Models\Quotation;
use App\Models\VoucherType;
use App\Services\KardexService;
use App\Services\SunatService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WebController extends Controller
{

    public function newSale()
    {
        return view('sales.new-sale.index');
    }

    public function saleNotes()
    {
        return view('sales.sale-notes.index');
    }

    public function quotations()
    {
        return view('sales.quotations.index');
    }

    public function warranties()
    {
        return view('sales.warranties.index');
    }

    //Catalogs
    public function familiesLinesBrands()
    {
        return view('catalogs.families-lines-brands.index');
    }

    public function products()
    {
        return view('catalogs.products.index');
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

    public function purchases()
    {
        return view('purchases.register-purchases.index');
    }

    public function newPurchase()
    {
        return view('purchases.register-purchases.new-purchase');
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function providers()
    {
        return view('third-parties.providers.index');
    }

    public function customers()
    {
        return view('third-parties.customers.index');
    }

    public function stockModifications()
    {
        return view('inventory.stock-modifications.index');
    }

    public function devolutions()
    {
        return view('inventory.devolutions.index');
    }

    public function assemblies()
    {
        return view('catalogs.assemblies.index');
    }

    public function reportCashboxes()
    {
        return view('reports.cashboxes.index');
    }

    public function reportPurchases()
    {
        return view('reports.purchases.index');
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
        return SunatService::facturar(7, 'invoice');

        // $currencyExchange = CurrencyExchange::latest()->first()->change;
        // $branchProducts = BranchProduct::select(
        //     DB::raw(
        //         'id,
        //         ROUND(sale_price * ' .$currencyExchange.',3) as sale_price_dollar,
        //         ROUND(referential_sale_price_one * ' .$currencyExchange.',3) as sale_price_dollar_one,
        //         ROUND(referential_sale_price_two * ' .$currencyExchange.',3) as sale_price_dollar_two'
        //         )
        // )->get();

        // return $branchProducts;

        // $quotation = Quotation::find(1);
        // return $quotation;
    }
}
