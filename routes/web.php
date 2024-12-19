<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/varian-pohon', function () {
    return view('varian_pohon'); // Assuming your view file is named `varian_pohon.blade.php`
})->name('varian-pohon');

Route::get('/detail-pohon', function () {
    return view('detail_pohon'); // Assuming your view file is named `varian_pohon.blade.php`
})->name('detail-pohon');