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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [WebController::class, 'dashboard'])->name('web.dashboard');
    //Sale
    Route::get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');
    Route::get('/ventas', [WebController::class, 'sales'])->name('web.ventas');
    Route::get('/nueva-venta', [WebController::class, 'newSale'])->name('web.new-sale');
    Route::get('/cotizaciones', [WebController::class, 'quotations'])->name('web.quotations');
    Route::get('/nueva-cotizacion', [WebController::class, 'quotations'])->name('web.new-quotation');
    
    Route::get('/garantias', [WebController::class, 'warranties'])->name('web.warranties');


    Route::get('/familias-lineas-marcas', [WebController::class, 'familiesLinesBrands'])->name('web.families-lines-brands');

    Route::get('/sucursales', [WebController::class, 'branches'])->name('web.branches');
    Route::get('/sucursales/productos/{id}', [WebController::class, 'branches'])->name('web.branches.products');

    Route::get('/movimiento-sucursal', [WebController::class, 'branchMovements'])->name('web.branch-movements');
    Route::get('/kardex', [WebController::class, 'kardex'])->name('web.kardex');

    Route::get('/cajas', [WebController::class, 'cashboxes'])->name('web.cajas');


    Route::get('/modificacion-stock', [WebController::class, 'stockModifications'])->name('web.stock-modifications');
    Route::get('/devoluciones', [WebController::class, 'devolutions'])->name('web.devolutions');

    //Settings
    Route::get('/cambio-de-divisas', [WebController::class, 'currencyExchanges'])->name('web.currency-exchanges');
    Route::get('/roles', [WebController::class, 'roles'])->name('web.roles');

});

Route::get('/prueba', [WebController::class, 'prueba']);

//Rutas imprimir
Route::middleware(['auth:sanctum', 'verified'])->get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
Route::middleware(['auth:sanctum', 'verified'])->get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print');


Route::get('assemblies/datos', [AssemblyController::class ,'datos' ]);

//Modulo Catalago
Route::middleware(['auth:sanctum', 'verified'])->resource('families', FamilyController::class)->names('families');
Route::middleware(['auth:sanctum', 'verified'])->resource('lines', LineController::class)->names('lines');
Route::middleware(['auth:sanctum', 'verified'])->resource('brands', BrandController::class)->names('brands');
Route::middleware(['auth:sanctum', 'verified'])->resource('products', ProductController::class)->names('products');
Route::middleware(['auth:sanctum', 'verified'])->resource('product-series', ProductSerieController::class)->names('product-series')->parameters(['product-series' => 'productSerie']);
Route::middleware(['auth:sanctum', 'verified'])->resource('assemblies', AssemblyController::class)->names('assemblies');


//Modulo Compras


//Modulo Inventario
Route::middleware(['auth:sanctum', 'verified'])->resource('branches', BranchController::class)->names('branches');
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}', [BranchController::class, 'products'])->name('branches.products');
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/products/{branch}/add', [BranchController::class, 'productsAdd'])->name('branches.products.add');
    Route::middleware(['auth:sanctum', 'verified'])->delete('branches/products/{branchProduct}', [BranchController::class, 'productsDestroy'])->name('branches.products.destroy');
    Route::middleware(['auth:sanctum', 'verified'])->get('kardex/{id}', [KardexController::class, 'show']);



//Modulo Terceros
Route::middleware(['auth:sanctum', 'verified'])->resource('customers', CustomerController::class)->names('customers');
Route::middleware(['auth:sanctum', 'verified'])->resource('providers', ProviderController::class)->names('providers');


//Modulo Configuracion
Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class)->names('users');
Route::middleware(['auth:sanctum', 'verified'])->resource('series', SerieController::class)->names('series')->parameters(['series' => 'serie']);
