<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UserController;
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
    if(auth()->check()){
        return redirect()->route('pago');
    }
    return view('home');
})->name('home');

Route::get("/login", [LoginController::class,'showLogin'])->name('login');
Route::get("/pagos", [PagoController::class,'showResumenPagos'])->name('pagos');
Route::get("/agua", [PagoController::class,'showAgua'])->name('agua');
Route::get("/arbitrios", [PagoController::class,'showArbitrio'])->name('arbitrio');
Route::get("/predios", [PagoController::class,'showPredio'])->name('predio');
Route::get('/profile', [UserController::class,'showProfile'])->name('profile');
