<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProdukController;
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


//ROUTE LANDING PAGE TANPA MIDDLEWARE
Route::get('/', [LandingController::class, 'landingpage'])->name('landingpage')->middleware('guest');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//ROUTE UNTUK ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.index');

    // Route untuk menampilkan halaman daftar produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('/admin/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/admin/produk/{produk}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/admin/produk/{produk}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

    // Route untuk menampilkan halaman daftar orderan
    Route::get('/admin/order', [OrderController::class, 'adminIndex'])->name('admin.order.index');
    Route::get('/admin/order/{order}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::put('/admin/order/{order}', [OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/admin/order/{order}', [OrderController::class, 'destroy'])->name('admin.order.destroy');

});


//ROUTE UNTUK USER
Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/profile', function () {
    //     return view('user.profile');
    // });
    Route::get('/home', [UserController::class, 'home'])->name('user.home');

    //UNTUK ROUTE PROFILE
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/profile/{id}/edit', [UserController::class, 'profileEdit'])->name('user.profileEdit');
    Route::put('/profile/{id}/update', [UserController::class, 'profileUpdate'])->name('user.profileUpdate');



    Route::get('/produk', [UserController::class, 'produk'])->name('user.produk');
    Route::get('/cart', [UserController::class, 'cart'])->name('user.cart');
    Route::get('/history', [UserController::class, 'history'])->name('user.history');
    Route::get('/cekoutView', [UserController::class, 'cekoutView'])->name('user.cekoutView');
    Route::post('/order', [UserController::class, 'order'])->name('user.order');

    Route::post('/order/{order}/upload-payment-proof', [OrderController::class, 'uploadPaymentProof'])->name('order.uploadPaymentProof');
    


    // Route untuk melihat dan menambah produk ke keranjang
    // Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::post('/cart/add/{produk_id}', [CartController::class, 'addToCart'])->name('user.cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('user.cart.delete');
    Route::post('/cart/{cartId}/update', [CartController::class, 'updateQuantity']);

    
});

