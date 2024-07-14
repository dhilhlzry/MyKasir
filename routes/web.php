<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\produkController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [loginController::class, 'login'])->name('login')->middleware('guest');
Route::get('/login', [loginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/cek_login', [LoginController::class, 'cek_login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::post('/user-simpan', [UserController::class, 'store'])->middleware('auth');
Route::put('/user-update/{id}', [UserController::class, 'update'])->middleware('auth');
Route::delete('/delete_user/{id}', [UserController::class, 'delete'])->middleware('auth');

Route::get('/roles', [RolesController::class, 'index'])->middleware('auth');
Route::get('/create_roles', [RolesController::class, 'create'])->middleware('auth');
Route::post('/roles-simpan', [RolesController::class, 'store'])->middleware('auth');
Route::get('/edit_roles/{id}', [RolesController::class, 'edit'])->middleware('auth');
Route::put('/roles-update/{id}', [RolesController::class, 'update'])->middleware('auth');
Route::delete('/delete_roles/{id}', [RolesController::class, 'destroy'])->middleware('auth');

Route::get('/produk', [produkController::class, 'index'])->middleware('auth');
Route::post('/produk-simpan', [produkController::class, 'store'])->middleware('auth');
Route::put('/produk-update/{id}', [produkController::class, 'update'])->middleware('auth');
Route::delete('/delete_produk/{id}', [produkController::class, 'delete'])->middleware('auth');

Route::get('/kategori', [kategoriController::class, 'index'])->middleware('auth');
Route::post('/kategori-simpan', [kategoriController::class, 'store'])->middleware('auth');
Route::put('/kategori-update/{id}', [kategoriController::class, 'update'])->middleware('auth');
Route::delete('/delete_kategori/{id}', [kategoriController::class, 'delete'])->middleware('auth');

Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::post('/supplier-simpan', [SupplierController::class, 'store'])->middleware('auth');
Route::put('/supplier-update/{id}', [SupplierController::class, 'update'])->middleware('auth');
Route::delete('/delete_supplier/{id}', [SupplierController::class, 'delete'])->middleware('auth');


Route::get('/input_penjualan', [transaksiController::class, 'input_penjualan'])->middleware('auth');
Route::get('/tmbh_keranjang/{id}', [transaksiController::class, 'tmbh_keranjang'])->middleware('auth');
Route::post('/keranjang-simpan', [transaksiController::class, 'store'])->middleware('auth');
Route::put('/keranjang-update/{id}', [transaksiController::class, 'update'])->middleware('auth');
Route::delete('/delete_keranjang/{id}', [transaksiController::class, 'delete_keranjang'])->middleware('auth');

Route::get('/data_transaksi', [transaksiController::class, 'data_transaksi'])->middleware('auth');
Route::get('/detail_transaksi/{id}', [transaksiController::class, 'detail'])->middleware('auth');
