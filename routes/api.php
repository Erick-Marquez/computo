<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashboxController;
use App\Http\Controllers\CurrencyExchangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VoucherController;

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
    Route::get('/sales/identificationdocuments', [VoucherController::class, 'identificationDocuments'])->name('api.sales.identificationDocuments');
    Route::get('/sales/products', [VoucherController::class, 'products'])->name('api.sales.products');
    Route::get('/sales/products/series/{id}', [VoucherController::class, 'productSeries'])->name('api.sales.productSeries');
    Route::get('/sales/vouchertypes', [VoucherController::class, 'voucherTypes'])->name('api.sales.voucherTypes');
    Route::get('/sales/series/{id}', [VoucherController::class, 'series'])->name('api.sales.series');
    Route::get('/sales/quotation/{id}', [VoucherController::class, 'quotation'])->name('api.sales.quotation');

    //Quotations
    Route::get('/quotations', [QuotationController::class, 'index'])->name('api.quotations.index');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('api.quotations.store');

    //Products
    Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
    Route::post('products', [ProductController::class, 'store'])->name('api.products.store');
    Route::get('products/branches', [ProductController::class, 'branches'])->name('api.products.branches');
    Route::get('products/lines', [ProductController::class, 'lines'])->name('api.products.lines');
    Route::get('products/brands/{id}', [ProductController::class, 'brands'])->name('api.products.brands');
    Route::get('products/currencyexchange', [ProductController::class, 'currencyExchanges'])->name('api.products.currencyExchanges');


    Route::apiResource('cajas', CashboxController::class)->names('api.cajas');
    Route::post('/cashbox/open', [CashboxController::class, 'openCashbox'])->name('api.opencashbox');
    Route::patch('/cashbox/{id}/close', [CashboxController::class, 'closeCashbox'])->name('api.closecashbox');
    Route::get('/cashbox/detail/{id}', [CashboxController::class, 'cashboxDetail'])->name('api.cashboxdetail');
    Route::post('/cashbox/{id}/income', [CashboxController::class, 'income'])->name('api.incomeCashbox');
    Route::post('/cashbox/{id}/expense', [CashboxController::class, 'expense'])->name('api.expenseCashbox');


    

    

    

    //------------------------Settings-----------------------
    //Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('api.role.index');

    //Currency Exchanges
    Route::get('currencyexchanges/current', [CurrencyExchangeController::class, 'currentCurrencyExchange'])->name('api.currencyexchanges.currentCurrencyExchange');
    Route::apiResource('currencyexchanges', CurrencyExchangeController::class)->names('api.currencyexchanges');
});
