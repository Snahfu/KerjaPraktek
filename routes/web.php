<?php

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

Route::get('/', function () {
    return view('admin.index');
});
Route::get('/dashboard', function () {
    return view('karyawan.index');
});
Route::get('/dashboard-admin', function () {
    return view('admin.index');
});
Route::get('/tambah', function () {
    return view('common.tambahorder');
});
Route::get('/data-transaksi', function () {
    return view('common.datatransaksi');
});
Route::get('/detail', function () {
    return view('common.detailorder');
});
// KARYAWAN CONTROLLER
Route::get('/reminder', [App\Http\Controllers\KaryawanController::class, 'jadwalreminder'])->name('karyawan.reminder');
Route::get('/tagihan', [App\Http\Controllers\KaryawanController::class, 'getTagihan'])->name('karyawan.tagihan');
Route::post('/detail-agenda', [App\Http\Controllers\KaryawanController::class, 'getData'])->name('karyawan.detailagenda');
Route::post('/delete-agenda', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.deleteagenda');
Route::post('/update-agenda', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.updateagenda');
Route::post('/tambah-agenda', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.tambahagenda');

// ADMIN CONTROLLER
Route::get('/data-pelanggan', [App\Http\Controllers\AdminController::class, 'index_datapelanggan'])->name('admin.datapelanggan');
Route::get('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'index_tambahpelanggan'])->name('admin.index.tambahpelanggan');
Route::post('/detail-pelanggan', [App\Http\Controllers\AdminController::class, 'detail'])->name('admin.detailpelanggan');
Route::post('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.tambahpelanggan');
Route::post('/delete-pelanggan', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.deletepelanggan');
Route::post('/update-pelanggan', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.updatepelanggan');

// EVENT CONTORLLER
Route::get('/event-list', [App\Http\Controllers\EventController::class, 'index'])->name('common.listevent');
Route::get('/tambah-event', [App\Http\Controllers\EventController::class, 'create'])->name('common.index.tambahevent');
Route::post('/detail-event', [App\Http\Controllers\EventController::class, 'show'])->name('common.detailevent');
Route::post('/get-barang', [App\Http\Controllers\EventController::class, 'get_barang'])->name('common.getbarang');
Route::post('/tambah-event', [App\Http\Controllers\EventController::class, 'store'])->name('common.tambahevent');
Route::post('/delete-event', [App\Http\Controllers\EventController::class, 'destroy'])->name('common.deleteevent');
Route::post('/update-event', [App\Http\Controllers\EventController::class, 'update'])->name('common.updateevent');

// AUTH CONTROLLER
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('loginPage');
Route::post('/loginAkun', [App\Http\Controllers\AuthController::class, 'login'])->name('masuk');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registerAkun', [App\Http\Controllers\AuthController::class, 'register'])->name('daftar');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
