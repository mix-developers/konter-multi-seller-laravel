<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KonterTokoController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananKonterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StatusController;
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

Route::get('/', [FrontController::class, 'index']);
Route::get('/konter_list', [FrontController::class, 'konter_list']);
Route::get('/konter_detail/{slug}', [FrontController::class, 'konter_detail']);
Route::get('/produk_list', [FrontController::class, 'produk_list']);
Route::post('/service', [FrontController::class, 'service']);

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => ['admin']], function () {
    // index dashboar admin dan super admin
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/akun/admin', [App\Http\Controllers\UserController::class, 'admin'])->name('akun.admin');
    Route::get('/akun/konter', [App\Http\Controllers\UserController::class, 'konter'])->name('akun.konter');
    Route::get('produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('konter', [KonterTokoController::class, 'index'])->name('konter');
    Route::post('konter/store', [KonterTokoController::class, 'store'])->name('konter.store');
    Route::put('konter/update/{id}', [KonterTokoController::class, 'update'])->name('konter.update');
    Route::delete('konter/destroy/{id}', [KonterTokoController::class, 'destroy'])->name('konter.destroy');
    Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('layanan', [LayananController::class, 'index'])->name('layanan');
    Route::post('layanan/store', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
    Route::delete('layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    Route::get('status', [StatusController::class, 'index'])->name('status');
    Route::post('status/store', [StatusController::class, 'store'])->name('status.store');
    Route::put('status/update/{id}', [StatusController::class, 'update'])->name('status.update');
    Route::delete('status/destroy/{id}', [StatusController::class, 'destroy'])->name('status.destroy');
    Route::get('laporan', [LaporanController::class, 'admin'])->name('laporan');
});
Route::group(['prefix' => 'konter', 'as' => 'konter', 'middleware' => ['konter']], function () {
    // index dashboar konter
    Route::get('/', [App\Http\Controllers\KonterController::class, 'index'])->name('home');
    Route::get('layanan', [LayananKonterController::class, 'index'])->name('layanan');
    Route::post('layanan/store', [LayananKonterController::class, 'store'])->name('layanan.store');
    Route::put('layanan/update/{id}', [LayananKonterController::class, 'update'])->name('layanan.update');
    Route::delete('layanan/destroy/{id}', [LayananKonterController::class, 'destroy'])->name('layanan.destroy');
    Route::get('produk', [ProdukController::class, 'list'])->name('produk');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('produk/destroy/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('laporan', [LaporanController::class, 'konter'])->name('laporan');
    Route::get('service', [ServiceController::class, 'index'])->name('service');
    Route::get('service/detail/{id}', [ServiceController::class, 'detail'])->name('service.detail');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::post('service/storeStatus', [ServiceController::class, 'storeStatus'])->name('service.storeStatus');
    Route::put('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('service/destroy/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::delete('service/destroyStatus/{id}', [ServiceController::class, 'destroyStatus'])->name('service.destroyStatus');
});
Route::group(['prefix' => 'member', 'as' => 'konter', 'middleware' => ['user']], function () {
    // index user
    Route::get('/', [App\Http\Controllers\MemberController::class, 'index'])->name('home');
    Route::get('/ulasan', [App\Http\Controllers\MemberController::class, 'ulasan'])->name('ulasan');
    Route::get('/status_service', [App\Http\Controllers\MemberController::class, 'status_service'])->name('status_service');
    Route::get('/ubah_password', [App\Http\Controllers\MemberController::class, 'ubah_password'])->name('ubah_password');
    Route::get('/status/{code}', [App\Http\Controllers\MemberController::class, 'status'])->name('status');
    Route::post('service/storeFinish', [ServiceController::class, 'storeFinish'])->name('service.storeFinish');
    Route::post('service/storeRating', [ServiceController::class, 'storeRating'])->name('service.storeRating');
});
