<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashboxController;

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
    Route::apiResource('cajas', CashboxController::class)->names('api.cajas');
    Route::post('/cashbox/open', [CashboxController::class, 'openCashbox'])->name('api.opencashbox');
    Route::patch('/cashbox/{id}/close', [CashboxController::class, 'closeCashbox'])->name('api.closecashbox');
    Route::get('/cashbox/detail/{id}', [CashboxController::class, 'cashboxDetail'])->name('api.cashboxdetail');
    Route::post('/cashbox/{id}/income', [CashboxController::class, 'income'])->name('api.incomeCashbox');
    Route::post('/cashbox/{id}/expense', [CashboxController::class, 'expense'])->name('api.expenseCashbox');
});
