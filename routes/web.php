<?php


use App\Http\Controllers\FamilyController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssemblyController;

use App\Http\Controllers\BranchController;

use App\Http\Controllers\CustomerController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Rutas imprimir
Route::middleware(['auth:sanctum', 'verified'])->get('print/quotations/{quotation}', [QuotationController::class, 'print'])->name('quotations.print');
Route::middleware(['auth:sanctum', 'verified'])->get('print/vouchers/{type}/{sale}', [VoucherController::class, 'print'])->name('vouchers.print');



//Modulo Ventas
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
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/{branch}/products', [BranchController::class, 'products'])->name('branches.products');
    Route::middleware(['auth:sanctum', 'verified'])->get('branches/{branch}/products/add', [BranchController::class, 'productsAdd'])->name('branches.products.add');
    Route::middleware(['auth:sanctum', 'verified'])->delete('branches/products/{branchProduct}', [BranchController::class, 'productsDestroy'])->name('branches.products.destroy');
    


//Modulo Terceros
Route::middleware(['auth:sanctum', 'verified'])->resource('customers', CustomerController::class)->names('customers');
Route::middleware(['auth:sanctum', 'verified'])->resource('providers', ProviderController::class)->names('providers');

//Rutas en español
//Route::middleware(['auth:sanctum', 'verified'])->get('usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');

//Modulo Configuracion
Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class)->names('users');
Route::middleware(['auth:sanctum', 'verified'])->resource('roles', RoleController::class)->names('roles');
Route::middleware(['auth:sanctum', 'verified'])->resource('series', SerieController::class)->names('series')->parameters(['series' => 'serie']);