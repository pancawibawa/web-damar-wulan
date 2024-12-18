<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'landingpage'])->name('landingpage');

Route::middleware('auth')->group(function () {
    Route::get('/produk', [UserController::class, 'produk'])->name('user.produk');
});

Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
Route::get('/cekoutView', [UserController::class, 'cekoutView'])->name('user.cekoutView');
Route::post('/cekout', [UserController::class, 'cekout'])->name('user.cekout');
// Route::get('/get-provinces', [UserController::class, 'getProvinces'])->name('getProvinces');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






