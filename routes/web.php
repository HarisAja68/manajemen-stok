<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukContoller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['middleware' => 'pemilik'])->group(function () {
    Route::resource('supplier', SuppliersController::class);
    Route::resource('user', PenggunaController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::post('/export-laporan', [LaporanController::class, 'laporanPdf'])->name('laporanPdf');
});

Route::middleware(['middleware' => 'pegawai'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('bMasuk', BarangMasukContoller::class);
    Route::resource('bKeluar', BarangKeluarController::class);
    Route::get('/bKeluar-detail/{id}', [BarangKeluarController::class, 'detail'])->name('bKeluar.detail');
    Route::post('/tambah-keranjang', [BarangKeluarController::class, 'addCart'])->name('addCartKeluar');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::post('/export-laporan', [LaporanController::class, 'laporanPdf'])->name('laporanPdf');
});
