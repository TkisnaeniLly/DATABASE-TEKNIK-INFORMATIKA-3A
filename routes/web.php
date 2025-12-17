<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('pages.home');
});
Route::get('/produkdetail', function () {
    return view('pages.detailproduk');
});