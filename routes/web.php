<?php

use App\Http\Controllers\AdvancePaymentController;
use App\Http\Controllers\WebController;

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssemblyController;

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CashboxController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\OpenClosedCashboxController;
use App\Http\Controllers\ProductSerieController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\VoucherController;
use App\Models\OpenClosedCashbox;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [WebController::class, 'dashboard'])->name('web.dashboard');
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');
    //Sale
    Route::middleware(['is.opening.cashbox'])->group(function () {
        Route::get('/cuentas-por-pagar', [WebController::class, 'accountsToPay'])->name('web.accounts-to-pay');
        Route::get('/nueva-venta', [WebController::class, 'newSale'])->name('web.new-sale');
        Route::get('/anticipos', [WebController::class, 'advancePayments'])->name('web.advance-payments');
        Route::get('/nueva-compra', [WebController::class, 'newPurchase'])->name('web.new-purchase');
    });

    Route::get('/ventas', [WebController::class, 'sales'])->name('web.ventas');
    Route::get('/notas-de-venta', [WebController::class, 'saleNotes'])->name('web.sale-notes');


    Route::get('/cotizaciones', [WebController::class, 'quotations'])->name('web.quotations');
    Route::get('/nueva-cotizacion', [WebController::class, 'quotations'])->name('web.new-quotation');

    Route::get('/notas-de-credito', [WebController::class, 'creditNotes'])->name('web.credit-notes');
    Route::get('/nueva-nota-de-credito', [WebController::class, 'newCreditNote'])->name('web.new-credit-note');

    Route::get('/comunicaciones-de-baja', [WebController::class, 'voideds'])->name('web.voideds');

    Route::get('/garantias', [WebController::class, 'warranties'])->name('web.warranties');

    //CashBoxes
    Route::get('/cajas', [WebController::class, 'cashboxes'])->name('web.cajas');
    Route::get('/cajas/detalle/{id}', [WebController::class, 'cashboxes']);

    //Catalogs
    Route::get('/familias-lineas-marcas', [WebController::class, 'familiesLinesBrands'])->name('web.families-lines-brands');
    Route::get('/productos', [WebController::class, 'products'])->name('web.products');
    Route::get('/nuevo-producto', [WebController::class, 'products'])->name('web.new-products');
    Route::get('/editar-producto/{id}', [WebController::class, 'products'])->name('web.edit-products');
    Route::get('/producto-series', [WebController::class, 'productSeries'])->name('web.product-series');

    //Rutas egresos-ingresos
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');

    // Rutas compras
    Route::get('/compras', [WebController::class, 'purchases'])->name('web.compras');

    // Rutas Terceros
    Route::get('/proveedores', [WebController::class, 'providers'])->name('web.proveedores');
    Route::get('/clientes', [WebController::class, 'customers'])->name('web.clientes');

    //Inventory
    Route::get('/sucursales', [WebController::class, 'branches'])->name('web.branches');
    Route::get('/sucursales/productos/{id}', [WebController::class, 'branches'])->name('web.branches.products');
    Route::get('/sucursales/productos/{id}/agregar', [WebController::class, 'branches'])->name('web.branches.add-products');

    Route::get('/movimiento-sucursal', [WebController::class, 'branchMovements'])->name('web.branch-movements');
    Route::get('/kardex', [WebController::class, 'kardex'])->name('web.kardex');

    Route::get('/modificacion-stock', [WebController::class, 'stockModifications'])->name('web.stock-modifications');
    Route::get('/devoluciones', [WebController::class, 'devolutions'])->name('web.devolutions');

    //Modulo Configuracion
    Route::get('/empresa', [WebController::class, 'company'])->name('web.company');
    Route::get('/usuarios', [WebController::class, 'users'])->name('web.users');
    Route::get('/cambio-de-divisas', [WebController::class, 'currencyExchanges'])->name('web.currency-exchanges');
    Route::get('/tipo-de-pagos', [WebController::class, 'paymentTypes'])->name('web.payment-types');
    Route::get('/roles', [WebController::class, 'roles'])->name('web.roles');
    Route::get('/roles/{id}', [WebController::class, 'roles'])->name('web.roles.update');
    Route::get('/series', [WebController::class, 'series'])->name('web.series');

    //Rutas imprimir
    Route::get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
    Route::get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print')
        ->where('type', 'A4|TICKET|WARRANTY');

    Route::get('print/advance-payments/{type}/{id}', [AdvancePaymentController::class, 'print'])->name('advance-payments.print')
        ->where('type', 'A4|TICKET');

    //Rutas descarga
    Route::get('download/vouchers/{voucherType}/{type}/{sale}', [VoucherController::class, 'download'])->name('vouchers.download');



    // Rutas emsamblajes
    Route::get('/ensamblajes', [WebController::class, 'assemblies'])->name('web.assemblies');

    // Rutas reportes
    Route::get('/reportes/cajas', [WebController::class, 'reportCashboxes'])->name('web.reports.cashboxes');
    Route::get('/reportes/compras', [WebController::class, 'reportPurchases'])->name('web.reports.purchases');
    Route::get('/reportes/ventas', [WebController::class, 'reportSales'])->name('web.reports.sales');
    Route::get('/reportes/productos', [WebController::class, 'reportProducts'])->name('web.reports.products');
    Route::get('/reportes/detallado', [WebController::class, 'reportDetails'])->name('web.reports.details');
    Route::get('/reportes/inventario', [WebController::class, 'reportInventory'])->name('web.reports.inventory');
    Route::get('/reportes/utilidad', [WebController::class, 'reportUtility'])->name('web.reports.utility');
    Route::get('/reportes/series', [WebController::class, 'reportSeries'])->name('web.reports.series');
    Route::get('/reportes/egresos-ingresos', [WebController::class, 'reportExpensesIncomes'])->name('web.reports.expenses-incomes');
});

Route::get('/prueba', [WebController::class, 'prueba']);


Route::get('assemblies/datos', [AssemblyController::class, 'datos']);

//Modulo Catalago
Route::middleware(['auth:sanctum', 'verified'])->resource('assemblies', AssemblyController::class)->names('assemblies');


//Modulo Inventario
Route::middleware(['auth:sanctum', 'verified'])->resource('branches', BranchController::class)->names('branches');
Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}', [BranchController::class, 'products'])->name('branches.products');
Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}/add', [BranchController::class, 'productsAdd'])->name('branches.products.add');
Route::middleware(['auth:sanctum', 'verified'])->delete('branches/products/{branchProduct}', [BranchController::class, 'productsDestroy'])->name('branches.products.destroy');
Route::middleware(['auth:sanctum', 'verified'])->get('kardex/{id}', [KardexController::class, 'show']);


Route::get('/occ/report/{occ}', [OpenClosedCashboxController::class, 'report'])->name('occ.report'); // PEPORTE DE APERTURAS Y CIERRES DE CAJA

Route::get('print/cashbox/report/{occId}', [CashboxController::class, 'reportCashboxOpenClosed'])->name('cashbox.reportOC');
Route::get('print/purchase/{purchase}', [PurchaseController::class, 'printPurchase'])->name('purchase.print');


Route::get('/reports/sales/print/{fromDate}/{untilDate}/{branch_id?}/{customer_id?}/{voucher_type_id?}', [ReportController::class, 'printReportSales'])->name('reports.sales.print');
Route::get('/reports/products/print/{branch_id?}', [ReportController::class, 'printReportProducts'])->name('reports.products.print');
Route::get('/reports/purchases/print/{fromDate}/{untilDate}/{branch_id?}/{provider_id?}/{document_type?}', [ReportController::class, 'printReportPurchases'])->name('reports.purchases.print');
Route::get('/reports/details/print/{fromDate}/{untilDate}/{branch_id?}/{customer_id?}/{product_id?}', [ReportController::class, 'printReportSalesDetails'])->name('reports.details.print');
