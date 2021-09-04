<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SerieController;

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



//Modulo Inventario
Route::middleware(['auth:sanctum', 'verified'])->resource('branches', BranchController::class)->names('branches');
Route::middleware(['auth:sanctum', 'verified'])->get('branches/{branch}/products', [BranchController::class, 'products'])->name('branches.products');


//Rutas en español
//Route::middleware(['auth:sanctum', 'verified'])->get('usuarios/{user}/editar', [UserController::class, 'edit'])->name('users.edit');

// Modulo Configuracion
Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class)->names('users');
Route::middleware(['auth:sanctum', 'verified'])->resource('roles', RoleController::class)->names('roles');
Route::middleware(['auth:sanctum', 'verified'])->resource('series', SerieController::class)->names('series');


