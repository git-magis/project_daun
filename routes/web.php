<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PohonController;
use App\Http\Controllers\JenisPohonController;

use App\Http\Controllers\BungaController;
use App\Http\Controllers\JenisBungaController;

use App\Http\Controllers\TamanController;
use App\Http\Controllers\VarianPohonController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;


Route::group(['middleware' => 'revalidate'], function () {
    // Login Routes
    Route::get('/loginform', [LoginController::class, 'showLoginForm'])->name('loginform');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Shared Routes
    Route::group(['middleware' => ['auth', 'user-access:admin,staff']], function () {
        Route::get('/manage-pohon', [PohonController::class, 'index'])->name('manage-pohon');

        // // For storing new Pohon data
        Route::get('/admin/pohon/create', [PohonController::class, 'create'])->name('pohon.create');
        Route::post('/pohon/store', [PohonController::class, 'store'])->name('pohon.store');

        Route::get('/pohon/{id}/edit', [PohonController::class, 'edit'])->name('pohon.edit');
        Route::put('/pohon/{id}', [PohonController::class, 'update'])->name('pohon.update');

        Route::delete('/pohon/{id}', [PohonController::class, 'destroy'])->name('pohon.destroy');

        // For displaying the list of Pohon
        Route::get('/manage-jenis-pohon', [JenisPohonController::class, 'index'])->name('manage-jenis-pohon');

        // // For showing the create form for Pohon
        Route::get('/jenis_pohon/create', [JenisPohonController::class, 'create'])->name('jenis_pohon.create');

        // // For storing new Pohon data
        Route::post('/jenis_pohon/store', [JenisPohonController::class, 'store'])->name('jenis_pohon.store');
        Route::put('/jenis_pohon/{id}', [JenisPohonController::class, 'update'])->name('jenis_pohon.update');
        Route::delete('/jenis_pohon/{id}', [JenisPohonController::class, 'destroy'])->name('jenis_pohon.destroy');


        // For displaying the list of Pohon
        Route::get('/manage-bunga', [BungaController::class, 'index'])->name('manage-bunga');

        // // For storing new bunga data
        Route::post('/bunga/store', [BungaController::class, 'store'])->name('bunga.store');
        Route::put('/bunga/{id}', [BungaController::class, 'update'])->name('bunga.update');
        Route::delete('/bunga/{id}', [BungaController::class, 'destroy'])->name('bunga.destroy');

        // For displaying the list of bunga
        Route::get('/manage-jenis-bunga', [JenisBungaController::class, 'index'])->name('manage-jenis-bunga');

        // // For showing the create form for bunga
        Route::get('/jenis_bunga/create', [JenisBungaController::class, 'create'])->name('jenis_bunga.create');

        // // For storing new bunga data
        Route::post('/jenis_bunga/store', [JenisBungaController::class, 'store'])->name('jenis_bunga.store');
        Route::put('/jenis_bunga/{id}', [JenisBungaController::class, 'update'])->name('jenis_bunga.update');
        Route::delete('/jenis_bunga/{id}', [JenisBungaController::class, 'destroy'])->name('jenis_bunga.destroy');


        // For displaying the list of Pohon
        Route::get('/manage-taman', [TamanController::class, 'index'])->name('manage-taman');

        // // For storing new bunga data
        Route::post('/taman/store', [TamanController::class, 'store'])->name('taman.store');
        Route::put('/taman/{id}', [TamanController::class, 'update'])->name('taman.update');
        Route::delete('/taman/{id}', [TamanController::class, 'destroy'])->name('taman.destroy');
    });

    // Admin Routes
    Route::group(['middleware' => ['auth', 'user-access:admin']], function () {
        Route::get('/admin-index', [DashboardController::class, 'index'])->name('admin-index');
        Route::get('/manage-user', [AdminController::class, 'index'])->name('manage-user');
    });

    // Staff Routes
    Route::group(['middleware' => ['auth', 'user-access:staff']], function () {
        Route::get('/staff-index', [StaffController::class, 'index'])->name('staff-index');
    });
});

// For displaying data in the varian-pohon
Route::get('/varian-pohon', [VarianPohonController::class, 'index'])->name('varian-pohon');
// Route::get('/detail-pohon/{id}', [VarianPohonController::class, 'show'])->name('detail-pohon');


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/varian-pohon', function () {
//     return view('varian_pohon');
// })->name('varian-pohon');

Route::get('/detail-pohon', function () {
    return view('detail_pohon');
})->name('detail-pohon');

// Route::get('/admin-index', function () {
//     return view('admin.admin_index');
// })->name('admin-index');

// Route::get('/manage-jenis-pohon', function () {
//     return view('admin.manage_jenis_pohon');
// })->name('manage-jenis-pohon');

// Route::get('/manage-bunga', function () {
//     return view('admin.manage_bunga');
// })->name('manage-bunga');

// Route::get('/manage-jenis-bunga', function () {
//     return view('admin.manage_jenis_bunga');
// })->name('manage-jenis-bunga');

Route::get('/manage-kelas', function () {
    return view('admin.manage_kelas');
})->name('manage-kelas');

// Route::get('/manage-taman', function () {
//     return view('admin.manage_taman');
// })->name('manage-taman');

// Route::get('/manage-user', function () {
//     return view('admin.manage_user');
// })->name('manage-user');
