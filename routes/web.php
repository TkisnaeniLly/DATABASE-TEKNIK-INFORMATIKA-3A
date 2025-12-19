<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('pages.home');

// Route::get('/', function () {
//     // return view('welcome');
//     return view('pages.home');
// });
Route::get('/produkdetail', function () {
    return view('pages.detailproduk');
});

Route::get('/keranjang', function () {
    return view('pages.cart');
});
Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});