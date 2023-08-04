<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KonterController;
use App\Http\Controllers\KonterTokoController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LayananKonterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukStokController;
use App\Http\Controllers\PusherController;
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
Route::get('/service', [FrontController::class, 'service']);
Route::get('/chat', [PusherController::class, 'index']);

// Real-time Chat Routes
Route::post('/broadcast', [PusherController::class, 'broadcast']);
Route::post('/receive', [PusherController::class, 'receive']);

Route::get('/status/{code}', [MemberController::class, 'status'])->name('status');

Auth::routes();
// Admin Routes
Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/akun/admin', [UserController::class, 'admin'])->name('akun.admin');
    Route::get('/akun/konter', [UserController::class, 'konter'])->name('akun.konter');
    Route::get('/akun/user', [UserController::class, 'user'])->name('akun.user');
    Route::get('/akun/akun', [UserController::class, 'akunAdmin'])->name('akun.akun');
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
// Konter Routes
Route::prefix('konter')->middleware('konter')->name('konter.')->group(function () {
    Route::get('/', [KonterController::class, 'index'])->name('home');
    Route::post('konter/store', [KonterTokoController::class, 'store'])->name('konter.store');
    Route::get('layanan', [LayananKonterController::class, 'index'])->name('layanan');
    Route::post('layanan/store', [LayananKonterController::class, 'store'])->name('layanan.store');
    Route::put('layanan/update/{id}', [LayananKonterController::class, 'update'])->name('layanan.update');
    Route::delete('layanan/destroy/{id}', [LayananKonterController::class, 'destroy'])->name('layanan.destroy');
    //produk
    Route::get('produk', [ProdukController::class, 'list'])->name('produk');
    Route::post('produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('produk/destroy/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    //produk
    Route::get('stok', [ProdukStokController::class, 'index'])->name('stok');
    Route::post('stok/store', [ProdukStokController::class, 'store'])->name('stok.store');
    Route::put('stok/update/{id}', [ProdukStokController::class, 'update'])->name('stok.update');
    Route::delete('stok/destroy/{id}', [ProdukStokController::class, 'destroy'])->name('stok.destroy');
    //laporan
    Route::get('laporan', [LaporanController::class, 'konter'])->name('laporan');
    Route::get('service', [ServiceController::class, 'index'])->name('service');
    Route::get('service/detail/{id}', [ServiceController::class, 'detail'])->name('service.detail');
    Route::post('service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::post('service/storeStatus', [ServiceController::class, 'storeStatus'])->name('service.storeStatus');
    Route::post('service/storePrice', [ServiceController::class, 'storePrice'])->name('service.storePrice');
    Route::put('service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('service/destroy/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::delete('service/destroyStatus/{id}', [ServiceController::class, 'destroyStatus'])->name('service.destroyStatus');
    Route::delete('service/destroyPrice/{id}', [ServiceController::class, 'destroyPrice'])->name('service.destroyPrice');
    Route::get('user/akun', [UserController::class, 'akunKonter'])->name('konter.user.akun');
    Route::get('ulasan', [KonterController::class, 'ulasan'])->name('ulasan');
    Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::post('laporan/exportService', [LaporanController::class, 'exportService'])->name('laporan.exportService');
    Route::get('laporan/exportProduk', [LaporanController::class, 'exportProduk'])->name('laporan.exportProduk');
});
// Member Routes
Route::prefix('member')->middleware('user')->name('member.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('home');
    Route::get('/ulasan', [MemberController::class, 'ulasan'])->name('ulasan');
    Route::get('/status_service', [MemberController::class, 'status_service'])->name('status_service');
    Route::get('/ubah_password', [MemberController::class, 'ubah_password'])->name('ubah_password');
    Route::get('/status/{code}', [MemberController::class, 'status'])->name('status');
    Route::post('service/storeFinish', [ServiceController::class, 'storeFinish'])->name('service.storeFinish');
    Route::post('service/storeRating', [ServiceController::class, 'storeRating'])->name('service.storeRating');
    Route::post('/sendChat', [MemberController::class, 'sendChat'])->name('sendChat');
    Route::any('/sendChatAjax', [MemberController::class, 'sendChatAjax'])->name('sendChatAjax');
});
