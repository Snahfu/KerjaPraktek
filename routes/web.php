<?php

use Illuminate\Support\Facades\Route;

Route::middleware('role:2,3,4,5')->group(function () {
  Route::get('/', function () {
    return view('admin.index');
  });
  Route::get('/dashboard', function () {
    return view('karyawan.index');
  });
  Route::get('/myprofile', [App\Http\Controllers\DashboardController::class, 'myprofile']);
  Route::get('/dashboard-admin', [App\Http\Controllers\DashboardController::class, 'index']);
  Route::post('/dashboard-admin-param', [App\Http\Controllers\DashboardController::class, 'indexParameter'])->name('admin.indexParameter');
});

Route::middleware('role:4,5')->group(function () {
  // EVENT CONTORLLER
  Route::get('/dashboard-sales', [App\Http\Controllers\KaryawanController::class, 'index'])->name('sales.dashboard');
  Route::post('/dashboard-sales-param', [App\Http\Controllers\KaryawanController::class, 'indexParameter'])->name('sales.dashboard.param');
  Route::get('/event-list', [App\Http\Controllers\EventController::class, 'index'])->name('common.listevent');
  Route::get('/tambah-event', [App\Http\Controllers\EventController::class, 'create'])->name('common.index.tambahevent');
  Route::get('/tambah-event2', [App\Http\Controllers\EventController::class, 'create2'])->name('common.index.tambahevent2');
  Route::post('/detail-event', [App\Http\Controllers\EventController::class, 'show'])->name('common.detailevent');
  Route::post('/get-barang', [App\Http\Controllers\EventController::class, 'get_barang'])->name('common.getbarang');
  Route::post('/tambah-event', [App\Http\Controllers\EventController::class, 'store'])->name('common.tambahevent');
  Route::post('/tambah-event2', [App\Http\Controllers\EventController::class, 'store2'])->name('common.tambahevent2');
  Route::post('/delete-event', [App\Http\Controllers\EventController::class, 'destroy'])->name('common.deleteevent');
  Route::post('/update-event', [App\Http\Controllers\EventController::class, 'update'])->name('common.updateevent');
  Route::post('/get-stock', [App\Http\Controllers\EventController::class, 'getstock'])->name('common.getstock');
  Route::post('/get-stock2', [App\Http\Controllers\EventController::class, 'getstock2'])->name('common.getstock2');
});

Route::middleware('role:4,5')->group(function () {
  // ADMIN CONTROLLER
  Route::get('/data-pelanggan', [App\Http\Controllers\AdminController::class, 'index_datapelanggan'])->name('admin.datapelanggan');
  Route::get('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'index_tambahpelanggan'])->name('admin.index.tambahpelanggan');
  Route::post('/detail-pelanggan', [App\Http\Controllers\AdminController::class, 'detail'])->name('admin.detailpelanggan');
  Route::post('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.tambahpelanggan');
  Route::post('/delete-pelanggan', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.deletepelanggan');
  Route::get('/edit-pelanggan', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.editpelanggan');
  Route::post('/update-pelanggan', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.updatepelanggan');
});

Route::middleware('role:4,5')->group(function () {
  //   INVOICE CONTROLLER
  Route::get('/data-invoice', [App\Http\Controllers\InvoiceController::class, 'tabelPenawaran'])->name('invoice.list');
  Route::get('/detail-invoice', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.detail');
  Route::get('/data-tagihan', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.tagihan.list');
  Route::post('/invoice-status-update', [App\Http\Controllers\InvoiceController::class, 'ubahStatus'])->name('invoice.ubahstatus');
  Route::get('/invoice-cetak', [App\Http\Controllers\InvoiceController::class, 'pdfPage'])->name('invoice.cetak');
  Route::get('/form-bayar-invoice', [App\Http\Controllers\InvoiceController::class, 'showBayar'])->name('invoice.bayar.index');
  Route::post('/bayar-invoice', [App\Http\Controllers\InvoiceController::class, 'bayar'])->name('invoice.bayar');
  Route::get('/tagihan-cetak', [App\Http\Controllers\InvoiceController::class, 'pdfPageTagihan'])->name('tagihan.cetak');
});

Route::middleware('role:2,3,5')->group(function () {
  // GUDANG CONTROLLER
  Route::get('/dashboard-gudang', [App\Http\Controllers\BarangController::class, 'dashboard'])->name('gudang.dashboard');
  Route::post('/dashboard-gudang-param', [App\Http\Controllers\BarangController::class, 'dashboardParameter'])->name('gudang.dashboard.parameter');
  Route::get('/data-gudang', [App\Http\Controllers\BarangController::class, 'index'])->name('gudang.datagudang');
  Route::get('/gudang', [App\Http\Controllers\BarangController::class, 'task'])->name('gudang');
  Route::get('/tambah-gudang', [App\Http\Controllers\BarangController::class, 'create'])->name('tambahgudang');
  Route::post('/tambah-gudang', [App\Http\Controllers\BarangController::class, 'store'])->name('storegudang');
  Route::post('/get-nama', [App\Http\Controllers\BarangController::class, 'getNama'])->name('getnama');
  Route::post('/check-task', [App\Http\Controllers\BarangController::class, 'doneTask'])->name('checktask');
  Route::get('/edit-gudang', [App\Http\Controllers\BarangController::class, 'edit'])->name('editgudang');
  Route::post('/update-gudang', [App\Http\Controllers\BarangController::class, 'update'])->name('updategudang');
  Route::post('/delete-gudang', [App\Http\Controllers\BarangController::class, 'destroy'])->name('deletegudang');
});

Route::middleware('role:2,3,4,5')->group(function () {
  // JENIS CONTROLLER
  Route::get('/data-jenis', [App\Http\Controllers\JenisBarangController::class, 'index'])->name('jenis.datajenis');
  Route::get('/tambah-jenis', [App\Http\Controllers\JenisBarangController::class, 'create'])->name('tambahjenis');
  Route::post('/tambah-jenis', [App\Http\Controllers\JenisBarangController::class, 'store'])->name('storejenis');
  Route::get('/edit-jenis', [App\Http\Controllers\JenisBarangController::class, 'edit'])->name('editjenis');
  Route::post('/update-jenis', [App\Http\Controllers\JenisBarangController::class, 'update'])->name('updatejenis');
  Route::post('/delete-jenis', [App\Http\Controllers\JenisBarangController::class, 'destroy'])->name('deletejenis');
});

Route::middleware('role:2,3,5')->group(function () {
});

Route::get('/', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('loginPage');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('loginPage2');
Route::post('/loginAkun', [App\Http\Controllers\AuthController::class, 'login'])->name('masuk');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registerAkun', [App\Http\Controllers\AuthController::class, 'register'])->name('daftar');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('role:1,2,3,4,5')->group(function () {


});