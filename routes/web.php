<?php

use App\Http\Controllers\WebController;

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssemblyController;

use App\Http\Controllers\BranchController;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\ProductSerieController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\VoucherController;
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
    //Sale
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');
    
    Route::middleware(['opening.cashbox'])->get('/nueva-venta', [WebController::class, 'newSale'])->name('web.new-sale');
    Route::get('/ventas', [WebController::class, 'sales'])->name('web.ventas');
    Route::get('/notas-de-venta', [WebController::class, 'saleNotes'])->name('web.sale-notes');
    Route::get('/cotizaciones', [WebController::class, 'quotations'])->name('web.quotations');
    Route::get('/nueva-cotizacion', [WebController::class, 'quotations'])->name('web.new-quotation');

    Route::get('/garantias', [WebController::class, 'warranties'])->name('web.warranties');

    //CashBoxes
    Route::get('/cajas', [WebController::class, 'cashboxes'])->name('web.cajas');
    Route::get('/cajas/detalle/{id}', [WebController::class, 'cashboxes']);

    //Catalogs
    Route::get('/familias-lineas-marcas', [WebController::class, 'familiesLinesBrands'])->name('web.families-lines-brands');
    Route::get('/productos', [WebController::class, 'products'])->name('web.products');
    Route::get('/nuevo-producto', [WebController::class, 'products'])->name('web.new-products');

        //Rutas egresos-ingresos
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');

    // Rutas compras
    Route::get('/compras', [WebController::class, 'purchases'])->name('web.compras');
    Route::middleware(['opening.cashbox'])->get('/nueva-compra', [WebController::class, 'newPurchase'])->name('web.new-purchase');

    // Rutas Terceros
    Route::get('/proveedores', [WebController::class, 'providers'])->name('web.proveedores');
    Route::get('/clientes', [WebController::class, 'customers'])->name('web.clientes');

    //Inventory
    Route::get('/sucursales', [WebController::class, 'branches'])->name('web.branches');
    Route::get('/sucursales/productos/{id}', [WebController::class, 'branches'])->name('web.branches.products');

    Route::get('/movimiento-sucursal', [WebController::class, 'branchMovements'])->name('web.branch-movements');
    Route::get('/kardex', [WebController::class, 'kardex'])->name('web.kardex');

    Route::get('/modificacion-stock', [WebController::class, 'stockModifications'])->name('web.stock-modifications');
    Route::get('/devoluciones', [WebController::class, 'devolutions'])->name('web.devolutions');

    //Modulo Configuracion
    Route::get('/empresa', [WebController::class, 'company'])->name('web.company');
    Route::get('/usuarios', [WebController::class, 'users'])->name('web.users');
    Route::get('/cambio-de-divisas', [WebController::class, 'currencyExchanges'])->name('web.currency-exchanges');
    Route::get('/roles', [WebController::class, 'roles'])->name('web.roles');
    Route::get('/series', [WebController::class, 'series'])->name('web.series');

});

Route::get('/prueba', [WebController::class, 'prueba']);


//Rutas imprimir
Route::middleware(['auth:sanctum', 'verified'])->get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
Route::middleware(['auth:sanctum', 'verified'])->get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print');

//Rutas descarga
Route::middleware(['auth:sanctum', 'verified'])->get('download/vouchers/{voucherType}/{type}/{sale}', [VoucherController::class, 'download'])->name('vouchers.download');


Route::get('assemblies/datos', [AssemblyController::class ,'datos' ]);

//Modulo Catalago
Route::middleware(['auth:sanctum', 'verified'])->resource('families', FamilyController::class)->names('families');
Route::middleware(['auth:sanctum', 'verified'])->resource('lines', LineController::class)->names('lines');
Route::middleware(['auth:sanctum', 'verified'])->resource('brands', BrandController::class)->names('brands');
Route::middleware(['auth:sanctum', 'verified'])->resource('products', ProductController::class)->names('products');
Route::middleware(['auth:sanctum', 'verified'])->resource('product-series', ProductSerieController::class)->names('product-series')->parameters(['product-series' => 'productSerie']);
Route::middleware(['auth:sanctum', 'verified'])->resource('assemblies', AssemblyController::class)->names('assemblies');


//Modulo Inventario
Route::middleware(['auth:sanctum', 'verified'])->resource('branches', BranchController::class)->names('branches');
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}', [BranchController::class, 'products'])->name('branches.products');
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}/add', [BranchController::class, 'productsAdd'])->name('branches.products.add');
    Route::middleware(['auth:sanctum', 'verified'])->delete('branches/products/{branchProduct}', [BranchController::class, 'productsDestroy'])->name('branches.products.destroy');
    Route::middleware(['auth:sanctum', 'verified'])->get('kardex/{id}', [KardexController::class, 'show']);


