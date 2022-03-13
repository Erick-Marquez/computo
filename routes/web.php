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
use App\Http\Controllers\CreditNoteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\OpenClosedCashboxController;
use App\Http\Controllers\OpenClosedCashboxDetailController;
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
    

    Route::get('/cuentas-por-pagar', [WebController::class, 'accountsToPay'])->name('web.accounts-to-pay');
    Route::get('/nueva-compra', [WebController::class, 'newPurchase'])->name('web.new-purchase');

    Route::get('/cajas', [WebController::class, 'cashboxes'])->name('web.cajas');
    Route::get('/cajas/detalle/{id}', [WebController::class, 'cashboxes']);


    //Sale

    Route::middleware(['is.opening.cashbox', 'can:vouchers.create'])->get('/nueva-venta', [WebController::class, 'newSale'])->name('web.new-sale');

    Route::middleware(['can:vouchers.index'])->get('/ventas', [WebController::class, 'sales'])->name('web.ventas');
    
    Route::middleware(['can:sale-notes.index'])->get('/notas-de-venta', [WebController::class, 'saleNotes'])->name('web.sale-notes');

    Route::middleware(['is.opening.cashbox', 'can:advance-payments.index'])->get('/anticipos', [WebController::class, 'advancePayments'])->name('web.advance-payments');

    Route::middleware(['can:credit-notes.index'])->get('/notas-de-credito', [WebController::class, 'creditNotes'])->name('web.credit-notes');
    Route::middleware(['is.opening.cashbox', 'can:credit-notes.create'])->get('/nueva-nota-de-credito', [WebController::class, 'newCreditNote'])->name('web.new-credit-note');

    Route::middleware(['is.opening.cashbox', 'can:credit-notes.create'])->get('/nueva-nota-de-credito', [WebController::class, 'newCreditNote'])->name('web.new-credit-note');

    Route::middleware(['can:voideds.index'])->get('/comunicaciones-de-baja', [WebController::class, 'voideds'])->name('web.voideds');

    Route::middleware(['can:quotations.index'])->get('/cotizaciones', [WebController::class, 'quotations'])->name('web.quotations');
    Route::middleware(['can:quotations.create'])->get('/nueva-cotizacion', [WebController::class, 'quotations'])->name('web.new-quotation');

    Route::middleware(['can:warranties.index'])->get('/garantias', [WebController::class, 'warranties'])->name('web.warranties');


    //CashBoxes




    //Catalogs

    Route::middleware(['can:families-lines-brands'])->get('/familias-lineas-marcas', [WebController::class, 'familiesLinesBrands'])->name('web.families-lines-brands');

    Route::middleware(['can:products.index'])->get('/productos', [WebController::class, 'products'])->name('web.products');
    Route::middleware(['can:products.create'])->get('/nuevo-producto', [WebController::class, 'products'])->name('web.new-products');
    Route::middleware(['can:products.edit'])->get('/editar-producto/{id}', [WebController::class, 'products'])->name('web.edit-products');

    Route::middleware(['can:product-series.index'])->get('/producto-series', [WebController::class, 'productSeries'])->name('web.product-series');

    Route::middleware(['can:assemblies.index'])->get('/ensamblajes', [WebController::class, 'assemblies'])->name('web.assemblies');

    //Purchases

    Route::middleware(['can:purchases.index'])->get('/compras', [WebController::class, 'purchases'])->name('web.compras');

    //Inventory

    Route::middleware(['can:branches.index'])->get('/sucursales', [WebController::class, 'branches'])->name('web.branches');
    Route::middleware(['can:branches.products'])->get('/sucursales/productos/{id}', [WebController::class, 'branches'])->name('web.branches.products');
    Route::middleware(['can:branches.add-products'])->get('/sucursales/productos/{id}/agregar', [WebController::class, 'branches'])->name('web.branches.add-products');

    // Route::get('/movimiento-sucursal', [WebController::class, 'branchMovements'])->name('web.branch-movements');

    Route::middleware(['can:kardex.index'])->get('/kardex', [WebController::class, 'kardex'])->name('web.kardex');

    Route::middleware(['can:edit-series.index'])->get('/editar-series', [WebController::class, 'editSeries'])->name('web.edit-series');

    Route::get('/modificacion-stock', [WebController::class, 'stockModifications'])->name('web.stock-modifications');
    // Route::get('/devoluciones', [WebController::class, 'devolutions'])->name('web.devolutions');


    //Rutas egresos-ingresos
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');

    

    // Rutas Terceros
    Route::get('/proveedores', [WebController::class, 'providers'])->name('web.proveedores');
    Route::get('/clientes', [WebController::class, 'customers'])->name('web.clientes');

    

    //Modulo Configuracion

    Route::middleware(['can:company.index'])->get('/empresa', [WebController::class, 'company'])->name('web.company');

    Route::middleware(['can:users.index'])->get('/usuarios', [WebController::class, 'users'])->name('web.users');

    Route::middleware(['can:currency-exchanges.index'])->get('/cambio-de-divisas', [WebController::class, 'currencyExchanges'])->name('web.currency-exchanges');
    
    Route::middleware(['can:payment-types.index'])->get('/tipo-de-pagos', [WebController::class, 'paymentTypes'])->name('web.payment-types');
    
    Route::middleware(['can:roles.index'])->get('/roles', [WebController::class, 'roles'])->name('web.roles');
    Route::middleware(['can:roles.edit'])->get('/roles/{id}', [WebController::class, 'roles'])->name('web.roles.update');
    
    Route::middleware(['can:series.index'])->get('/series', [WebController::class, 'series'])->name('web.series');



    
    //Rutas imprimir
    Route::get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
    Route::get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print')
        ->where('type', 'A4|TICKET|WARRANTY');

    Route::get('print/credit-notes/{type}/{id}', [CreditNoteController::class, 'print'])->name('credit-notes.print')
        ->where('type', 'A4');

    Route::get('print/advance-payments/{type}/{id}', [AdvancePaymentController::class, 'print'])->name('advance-payments.print')
        ->where('type', 'A4|TICKET');

    //Rutas descarga
    Route::get('download/vouchers/{voucherType}/{type}/{sale}', [VoucherController::class, 'download'])->name('vouchers.download');
    

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


Route::get('/reports/details/print/{fromDate}/{untilDate}/{branch_id?}/{customer_id?}/{product_id?}', [ReportController::class, 'printReportSalesDetails'])->name('reports.details.print');

Route::get('reports/products/{type}/{branch_id?}', [ReportController::class, 'reportProducts']);
Route::get('reports/sales/{type}/{fromDate}/{untilDate}/{branch_id?}/{customer_id?}/{voucher_type_id?}/{seller_id?}', [ReportController::class, 'reportSales']);
Route::get('reports/movements/{type}/{fromDate}/{untilDate}/{branch_id?}/{cashbox_id?}/{movement_type?}/{user_id?}', [ReportController::class, 'reportMovements']);
Route::get('reports/purchases/{type}/{fromDate}/{untilDate}/{branch_id?}/{provider_id?}/{document_type?}', [ReportController::class, 'reportPurchases']);
Route::get('reports/series/{type}/{serie}', [ReportController::class, 'reportSeries']);

Route::get('/print/movement/{occd_id}', [OpenClosedCashboxDetailController::class, 'printDetail']);
