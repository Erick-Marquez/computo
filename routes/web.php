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
// Rutas Web
Route::middleware(['auth:sanctum', 'verified'])->get('/familias-lineas-marcas', [WebController::class, 'familiesLinesBrands'])->name('web.families-lines-brands');

Route::middleware(['auth:sanctum', 'verified'])->get('/sucursales', [WebController::class, 'branches'])->name('web.branches');
Route::middleware(['auth:sanctum', 'verified'])->get('/sucursales/productos/{id}', [WebController::class, 'branches']);

Route::middleware(['auth:sanctum', 'verified'])->get('/movimiento-sucursal', [WebController::class, 'branchMovements'])->name('web.branch-movements');
Route::middleware(['auth:sanctum', 'verified'])->get('/kardex', [WebController::class, 'kardex'])->name('web.kardex');

Route::middleware(['auth:sanctum', 'verified'])->get('/cajas', [WebController::class, 'cashboxes'])->name('web.cajas');
Route::middleware(['auth:sanctum', 'verified'])->get('/cajas/detalle/{id}', [WebController::class, 'cashboxes']);


Route::middleware(['auth:sanctum', 'verified'])->get('/modificacion-stock', [WebController::class, 'stockModifications'])->name('web.stock-modifications');
Route::middleware(['auth:sanctum', 'verified'])->get('/devoluciones', [WebController::class, 'devolutions'])->name('web.devolutions');

Route::middleware(['auth:sanctum', 'verified'])->get('/cambio-de-divisas', [WebController::class, 'currencyExchanges'])->name('web.currency-exchanges');

Route::middleware(['auth:sanctum', 'verified'])->get('/egresos-ingresos', [WebController::class, 'expensesIncomes'])->name('web.egresos-ingresos');
Route::middleware(['auth:sanctum', 'verified'])->get('/ventas', [WebController::class, 'sales'])->name('web.ventas');
Route::middleware(['auth:sanctum', 'verified', 'opening.cashbox'])->get('/nueva-venta', [WebController::class, 'newSale'])->name('web.new-sale');
// 'opening.cashbox'

Route::get('/prueba', [WebController::class, 'prueba']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [WebController::class, 'dashboard'])->name('web.dashboard');

//Rutas imprimir
Route::middleware(['auth:sanctum', 'verified'])->get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
// Route::middleware(['auth:sanctum', 'verified'])->get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print');



// //Modulo Ventas
Route::middleware(['auth:sanctum', 'verified'])->resource('vouchers', VoucherController::class)->names('vouchers');
Route::middleware(['auth:sanctum', 'verified'])->resource('quotations', QuotationController::class)->names('quotations');


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

//Rutas en español
//Route::middleware(['auth:sanctum', 'verified'])->get('usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');

//Modulo Configuracion
Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class)->names('users');
Route::middleware(['auth:sanctum', 'verified'])->resource('roles', RoleController::class)->names('roles');
Route::middleware(['auth:sanctum', 'verified'])->resource('series', SerieController::class)->names('series')->parameters(['series' => 'serie']);
