<?php

use App\Http\Controllers\BranchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashboxController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseIncomeController;
use App\Http\Controllers\IdentificationDocumentController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([
    'auth:sanctum', 'verified'
])->group(function () {

    //------------------------Sales-----------------------
    //Sales
    Route::post('/sales', [VoucherController::class, 'store'])->name('api.sales.store');
    Route::get('/sales', [VoucherController::class, 'index'])->name('api.sales.index');
    Route::get('/sales/salenotes', [VoucherController::class, 'saleNotes'])->name('api.sales.saleNotes');
    Route::get('/sales/identificationdocuments', [VoucherController::class, 'identificationDocuments'])->name('api.sales.identificationDocuments');
    Route::get('/sales/products', [VoucherController::class, 'products'])->name('api.sales.products');
    Route::get('/sales/products/series/{id}', [VoucherController::class, 'productSeries'])->name('api.sales.productSeries');
    Route::get('/sales/vouchertypes', [VoucherController::class, 'voucherTypes'])->name('api.sales.voucherTypes');
    Route::get('/sales/series/{id}', [VoucherController::class, 'series'])->name('api.sales.series');
    Route::get('/sales/quotation/{serie}/{number}', [VoucherController::class, 'quotation'])->name('api.sales.quotation');


    //Quotations
    Route::get('/quotations', [QuotationController::class, 'index'])->name('api.quotations.index');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('api.quotations.store');
    Route::get('/quotations/series', [QuotationController::class, 'series'])->name('api.quotations.series');

    //Products
    Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
    Route::post('products', [ProductController::class, 'store'])->name('api.products.store');
    Route::get('products/branches', [ProductController::class, 'branches'])->name('api.products.branches');
    Route::get('products/lines', [ProductController::class, 'lines'])->name('api.products.lines');
    Route::get('products/brands/{id}', [ProductController::class, 'brands'])->name('api.products.brands');
    Route::get('products/currencyexchange', [ProductController::class, 'currencyExchanges'])->name('api.products.currencyExchanges');


    Route::apiResource('cajas', CashboxController::class)->parameters([
        'cajas' => 'cashbox'
    ])->names('api.cajas');

    Route::post('/cashbox/open', [CashboxController::class, 'openCashbox'])->name('api.opencashbox');
    Route::patch('/cashbox/{id}/close', [CashboxController::class, 'closeCashbox'])->name('api.closecashbox');
    Route::get('/cashbox/detail/{id}', [CashboxController::class, 'cashboxDetail'])->name('api.cashboxdetail');
    Route::post('/cashbox/{id}/movement', [CashboxController::class, 'movement'])->name('api.movementCashbox');

    Route::apiResource('egresos-ingresos', ExpenseIncomeController::class)->parameters([
        'egresos-ingresos' => 'expenseIncome'
    ])->names('api.egresos-ingresos');

    Route::apiResource('tipos-documentos', IdentificationDocumentController::class)->names('api.tipos-documentos');
    Route::get('/data-document/{cod}/{number}', [IdentificationDocumentController::class, 'getDataApi'])->name('api.data-document');

    Route::apiResource('clientes', CustomerController::class)->parameters([
        'clientes' => 'customer'
    ])->names('api.clientes');

    Route::apiResource('proveedores', ProviderController::class)->parameters([
        'proveedores' => 'provider'
    ])->names('api.proveedores');

    //------------------------Inventory----------------------
    Route::apiResource('branches', BranchController::class)->names('api.branches');

    //------------------------Settings-----------------------

    //Company
    Route::get('company', [CompanyController::class, 'index'])->name('api.company.index');
    Route::put('company/{id}', [CompanyController::class, 'update'])->name('api.company.update');

    //users
    Route::apiResource('users', UserController::class)->names('api.users');

    //Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('api.role.index');

    //Series
    Route::get('/series', [SerieController::class, 'index'])->name('api.serie.index');
    Route::post('/series', [SerieController::class, 'store'])->name('api.serie.store');
    Route::get('/series/voucherTypes', [SerieController::class, 'voucherTypes'])->name('api.serie.voucherTypes');

    //Currency Exchanges
    Route::get('currencyexchanges/current', [CurrencyExchangeController::class, 'currentCurrencyExchange'])->name('api.currencyexchanges.currentCurrencyExchange');
    Route::apiResource('currencyexchanges', CurrencyExchangeController::class)->names('api.currencyexchanges');
});
