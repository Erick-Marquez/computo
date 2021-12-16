<?php

use App\Http\Controllers\AccountToPayController;
use App\Http\Controllers\AccountToPayDetailController;
use App\Http\Controllers\AdvancePaymentController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseIncomeController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\IdentificationDocumentController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\OpenClosedCashboxController;
use App\Http\Controllers\BranchProductSerieController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UbigeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoidedController;
use App\Http\Controllers\WarrantyController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::get('/sales/igvtypes', [VoucherController::class, 'igvTypes'])->name('api.sales.igvTypes');
    Route::get('/sales/paymenttypes', [VoucherController::class, 'paymentTypes'])->name('api.sales.paymentTypes');
    Route::get('/sales/products/{search}', [VoucherController::class, 'products'])->name('api.sales.products');
    Route::get('/sales/products/series/{id}', [VoucherController::class, 'productSeries'])->name('api.sales.productSeries');
    Route::get('/sales/vouchertypes', [VoucherController::class, 'voucherTypes'])->name('api.sales.voucherTypes');
    Route::get('/sales/series/{id}', [VoucherController::class, 'series'])->name('api.sales.series');
    Route::get('/sales/quotation/{serie}/{number}', [VoucherController::class, 'quotation'])->name('api.sales.quotation');
    Route::get('/sales/currencyexchange', [VoucherController::class, 'currencyExchange'])->name('api.sales.currencyExchange');

    //Advance Payments
    Route::get('/advance-payments', [AdvancePaymentController::class, 'index'])->name('api.advancePayments.index');
    Route::post('/advance-payments', [AdvancePaymentController::class, 'store'])->name('api.advancePayments.store');
    Route::get('/advance-payments/quotation/{serie}/{number}', [AdvancePaymentController::class, 'quotation'])->name('api.advancePayments.quotation');

    //Voideds
    Route::get('/voideds', [VoidedController::class, 'index'])->name('api.voideds.index');
    Route::post('/voideds', [VoidedController::class, 'store'])->name('api.voideds.store');

    //Quotations
    Route::get('/quotations', [QuotationController::class, 'index'])->name('api.quotations.index');
    Route::post('/quotations', [QuotationController::class, 'store'])->name('api.quotations.store');
    Route::get('/quotations/series', [QuotationController::class, 'series'])->name('api.quotations.series');
    Route::get('/quotations/sellers', [QuotationController::class, 'sellers'])->name('api.quotations.sellers');

    //Warranties
    Route::get('/warranties', [WarrantyController::class, 'index'])->name('api.warranties.index');

    Route::apiResource('cajas', CashboxController::class)->parameters([
        'cajas' => 'cashbox'
    ])->names('api.cajas');

    Route::post('/cashbox/open', [CashboxController::class, 'openCashbox'])->name('api.opencashbox');
    Route::patch('/cashbox/{id}/close', [CashboxController::class, 'closeCashbox'])->name('api.closecashbox');
    Route::get('/cashbox/detail/{id}', [CashboxController::class, 'cashboxDetail'])->name('api.cashboxdetail');
    Route::post('/cashbox/{id}/movement', [CashboxController::class, 'movement'])->name('api.movementCashbox');

    Route::apiResource('openClosedCashboxes', OpenClosedCashboxController::class)->names('api.openClosedCashboxes');

    Route::apiResource('egresos-ingresos', ExpenseIncomeController::class)->parameters([
        'egresos-ingresos' => 'expenseIncome'
    ])->names('api.egresos-ingresos');

    Route::apiResource('accounts-to-pay', AccountToPayController::class)->parameters([
        'accounts-to-pay' => 'account-to-pay'
    ])->names('api.accounts-to-pay');

    Route::apiResource('account-to-pay-details', AccountToPayDetailController::class)->names('api.account-to-pay-details');

    Route::apiResource('tipos-documentos', IdentificationDocumentController::class)->names('api.tipos-documentos');
    Route::get('/data-document/{cod}/{number}', [IdentificationDocumentController::class, 'getDataApi'])->name('api.data-document');

    Route::apiResource('clientes', CustomerController::class)->parameters([
        'clientes' => 'customer'
    ])->names('api.clientes');

    Route::apiResource('proveedores', ProviderController::class)->parameters([
        'proveedores' => 'provider'
    ])->names('api.proveedores');

    //------------------------Catalogs-----------------------
    //Families-Lines-Brands
    Route::apiResource('families', FamilyController::class)->names('api.families');
    Route::put('lines/add-brands/{line}', [LineController::class, 'addBrands'])->name('api.lines.addBrands');
    Route::apiResource('lines', LineController::class)->names('api.lines');
    Route::apiResource('brands', BrandController::class)->names('api.brands');

    //Products
    Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
    Route::post('products', [ProductController::class, 'store'])->name('api.products.store');
    Route::get('products/branches', [ProductController::class, 'branches'])->name('api.products.branches');
    Route::get('products/lines', [ProductController::class, 'lines'])->name('api.products.lines');
    Route::get('products/brands/{id}', [ProductController::class, 'brands'])->name('api.products.brands');
    Route::get('products/currencyexchange', [ProductController::class, 'currencyExchanges'])->name('api.products.currencyExchanges');

    //Product-Series
    Route::get('productseries', [BranchProductSerieController::class, 'index'])->name('api.product-series.index');

    Route::apiResource('assemblies', AssemblyController::class)->names('api.assemblies');

    //------------------------Inventory----------------------
    Route::get('branches/products/{id}', [BranchController::class, 'products'])->name('api.branches.products');
    Route::apiResource('branches', BranchController::class)->names('api.branches');

    //------------------------Settings-----------------------

    //Company
    Route::get('company', [CompanyController::class, 'index'])->name('api.company.index');
    Route::put('company/{id}', [CompanyController::class, 'update'])->name('api.company.update');

    //users
    Route::apiResource('users', UserController::class)->names('api.users');

    //Roles
    Route::apiResource('roles', RoleController::class)->names('api.roles');

    //Series
    Route::get('/series', [SerieController::class, 'index'])->name('api.serie.index');
    Route::post('/series', [SerieController::class, 'store'])->name('api.serie.store');
    Route::get('/series/voucherTypes', [SerieController::class, 'voucherTypes'])->name('api.serie.voucherTypes');

    //Currency Exchanges
    Route::get('currencyexchanges/current', [CurrencyExchangeController::class, 'currentCurrencyExchange'])->name('api.currencyexchanges.currentCurrencyExchange');
    Route::apiResource('currencyexchanges', CurrencyExchangeController::class)->names('api.currencyexchanges');

    //------------------------Purchases-----------------------//
    Route::apiResource('purchases', PurchaseController::class)->names('api.purchases');

    // Dashboard
    Route::get('dashboard/vouchers', [DashboardController::class, 'vouchers'])->name('api.dashboard.voucher');
    Route::get('dashboard/widgets', [DashboardController::class, 'widgets'])->name('api.dashboard.widgets');
    Route::get('dashboard/type-payments', [DashboardController::class, 'amountTypePayment'])->name('api.dashboard.type-payments');

    // catalogos

    Route::get('ubigees', [UbigeeController::class, 'index'])->name('api.ubigees');
    Route::get('payment-types', [PaymentTypeController::class, 'index'])->name('api.payment-types');
});
