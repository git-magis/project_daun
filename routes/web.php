<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PohonController;
use App\Http\Controllers\JenisPohonController;

use App\Http\Controllers\BungaController;
use App\Http\Controllers\JenisBungaController;

use App\Http\Controllers\TamanController;
use App\Http\Controllers\AtributController;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VarianPohonController;
use App\Http\Controllers\VarianBungaController;

use App\Http\Controllers\DetailPohonController;
use App\Http\Controllers\DetailBungaController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QRpohonController;
use App\Http\Controllers\QRbungaController;

Route::group(['middleware' => 'revalidate'], function () {
    // Login Routes
    Route::get('/loginform', [LoginController::class, 'showLoginForm'])->name('loginform');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Routes
    Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function () {
        Route::get('/admin-index', [DashboardController::class, 'index'])->name('admin.admin-index');

        Route::get('/manage-user', [UserController::class, 'index'])->name('manage-user');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/manage-pohon', [PohonController::class, 'index'])->name('admin.manage-pohon');
        Route::get('/manage-jenis-pohon', [JenisPohonController::class, 'index'])->name('admin.manage-jenis-pohon');

        Route::get('/manage-bunga', [BungaController::class, 'index'])->name('admin.manage-bunga');
        Route::get('/manage-jenis-bunga', [JenisBungaController::class, 'index'])->name('admin.manage-jenis-bunga');

        Route::get('/manage-taman', [TamanController::class, 'index'])->name('admin.manage-taman');

        Route::get('/manage-atribut', [AtributController::class, 'index'])->name('admin.manage-atribut');
    });

    // Staff Routes
    Route::prefix('staff')->middleware(['auth', 'user-access:staff'])->group(function () {
        Route::get('/admin-index', [DashboardController::class, 'index'])->name('staff.admin-index');

        Route::get('/manage-pohon', [PohonController::class, 'index'])->name('staff.manage-pohon');
        Route::get('/manage-jenis-pohon', [JenisPohonController::class, 'index'])->name('staff.manage-jenis-pohon');

        Route::get('/manage-bunga', [BungaController::class, 'index'])->name('staff.manage-bunga');
        Route::get('/manage-jenis-bunga', [JenisBungaController::class, 'index'])->name('staff.manage-jenis-bunga');

        Route::get('/manage-taman', [TamanController::class, 'index'])->name('staff.manage-taman');

        Route::get('/manage-atribut', [AtributController::class, 'index'])->name('staff.manage-atribut');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/pohon/create', [PohonController::class, 'create'])->name('pohon.create');
        Route::post('/pohon/store', [PohonController::class, 'store'])->name('pohon.store');
        Route::get('/pohon/{id}/edit', [PohonController::class, 'edit'])->name('pohon.edit');
        Route::put('/pohon/{id}', [PohonController::class, 'update'])->name('pohon.update');
        Route::delete('/pohon/{id}', [PohonController::class, 'destroy'])->name('pohon.destroy');
    
        Route::get('/jenis_pohon/create', [JenisPohonController::class, 'create'])->name('jenis_pohon.create');
        Route::post('/jenis_pohon/store', [JenisPohonController::class, 'store'])->name('jenis_pohon.store');
        Route::put('/jenis_pohon/{id}', [JenisPohonController::class, 'update'])->name('jenis_pohon.update');
        Route::delete('/jenis_pohon/{id}', [JenisPohonController::class, 'destroy'])->name('jenis_pohon.destroy');
    
        Route::post('/bunga/store', [BungaController::class, 'store'])->name('bunga.store');
        Route::put('/bunga/{id}', [BungaController::class, 'update'])->name('bunga.update');
        Route::delete('/bunga/{id}', [BungaController::class, 'destroy'])->name('bunga.destroy');
    
        Route::get('/jenis_bunga/create', [JenisBungaController::class, 'create'])->name('jenis_bunga.create');
        Route::post('/jenis_bunga/store', [JenisBungaController::class, 'store'])->name('jenis_bunga.store');
        Route::put('/jenis_bunga/{id}', [JenisBungaController::class, 'update'])->name('jenis_bunga.update');
        Route::delete('/jenis_bunga/{id}', [JenisBungaController::class, 'destroy'])->name('jenis_bunga.destroy');
    
        Route::post('/taman/store', [TamanController::class, 'store'])->name('taman.store');
        Route::put('/taman/update/{id}', [TamanController::class, 'update'])->name('taman.update');
        Route::delete('/taman/{id}', [TamanController::class, 'destroy'])->name('taman.destroy'); 
        
        Route::get('/atribut/create/{id}', [AtributController::class, 'create'])->name('atribut.create');
        Route::post('/atribut/store', [AtributController::class, 'store'])->name('atribut.store');
        Route::get('/atribut/edit/{id}', [AtributController::class, 'edit'])->name('atribut.edit');
        Route::put('/atribut/update/{id}', [AtributController::class, 'update'])->name('atribut.update');
        Route::delete('/atribut/delete/{id}', [AtributController::class, 'destroy'])->name('atribut.destroy');

        Route::get('/add-peta', [TamanController::class, 'showMap'])->name('add-peta');
        Route::get('/edit-peta/{id}', [TamanController::class, 'editMap'])->name('edit-peta');
        Route::post('/save-location', [TamanController::class, 'saveLocation'])->name('save-location');
        Route::get('/get-taman-data/{id}', [TamanController::class, 'getTamanData']);
        Route::post('/edit-location', [TamanController::class, 'update'])->name('edit-location');
    });
});

Route::get('/getMonthlyTrends', [DashboardController::class, 'getMonthlyTrends'])->name('getMonthlyTrends');
Route::get('/get-entities', [AtributController::class, 'getEntities']);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/varian-pohon', [VarianPohonController::class, 'index'])->name('varian-pohon');
Route::get('/varian-bunga', [VarianBungaController::class, 'index'])->name('varian-bunga');

Route::get('/detail-pohon/{id}', [DetailPohonController::class, 'show'])->name('detail-pohon.show');
Route::get('/detail-bunga/{id}', [DetailBungaController::class, 'show'])->name('detail-bunga.show');

Route::get('/download-qr-pohon/{id}', [PohonController::class, 'downloadQRPohon'])->name('downloadQRPohon');
Route::get('/download-qr-bunga/{id}', [BungaController::class, 'downloadQRBunga'])->name('downloadQRBunga');

Route::get('/pohon/{id}', [QRpohonController::class, 'show'])->name('qr-pohon.show');
Route::get('/bunga/{id}', [QRbungaController::class, 'show'])->name('qr-bunga.show');

Route::get('api/maps', [TamanController::class, 'getTamans']);
Route::get('api/taman/{id}', [TamanController::class, 'getTamansById']);
Route::get('/taman-detail/{id}', function ($id) {return view('taman_detail', compact('id'));})->name('taman-detail');
Route::get('/peta', function () {return view('peta');})->name('peta');
Route::get('/api/charts/{id}', [TamanController::class, 'chartTaman']);
Route::get('/taman/{id}/report-pdf', [TamanController::class, 'downloadPDF'])->name('taman.pdf');


Route::get('/scan', function () {
    return view('scan');
})->name('scan');


// Route::get('/detail-pohon/{id}', [VarianPohonController::class, 'show'])->name('detail-pohon');


// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

// Route::get('/varian-pohon', function () {
//     return view('varian_pohon');
// })->name('varian-pohon');

// Route::get('/detail-pohon', function () {
//     return view('detail_pohon');
// })->name('detail-pohon');

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

// Route::get('/manage-atribut', function () {
//     return view('admin.manage_atribut');
// })->name('manage-atribut');

// Route::get('/manage-taman', function () {
//     return view('admin.manage_taman');
// })->name('manage-taman');

// Route::get('/manage-user', function () {
//     return view('admin.manage_user');
// })->name('manage-user');
