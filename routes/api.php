<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [LoginController::class, 'login'])->name('login.api');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.api');
Route::post('/users', [UserController::class, 'createBacth'])->name('users.create');
Route::post('/user', [UserController::class, 'create'])->name('user.create');
Route::put('/user', [UserController::class, 'update'])->name('profile.update');
Route::put('/user/password', [UserController::class, 'updatePassword'])->name('profile.update.password');

Route::post('/users/pagos', [PagoController::class, 'registrarPagosPendientes'])->name('users.pagos');

Route::get('/izipay/authentication',[TransactionController::class, 'requestAuthentication']);
Route::post('/izipay/requestpayment',[TransactionController::class, 'requestPayment'])->name('izipay.requestpayment');
Route::post('/izipay/paid.php',[TransactionController::class, 'confirmPayment'])->name('izipay.confirm');

Route::get('/transaction/validates', [TransactionController::class, 'getTransactionValidates']);
Route::post('/users/pagos/validateServicios', [PagoController::class, 'validateServicios']);
Route::post('/users/pagos/validatePredio', [PagoController::class, 'validatePredio']);