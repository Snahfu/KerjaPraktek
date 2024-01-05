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

Route::middleware('role:1,2,3,4,5')->group(function () {
  Route::get('/', function () {
    return view('admin.index');
  });
  Route::get('/dashboard', function () {
    return view('karyawan.index');
  });
  Route::get('/myprofile', [App\Http\Controllers\DashboardController::class, 'myprofile']);
  Route::get('/dashboard-admin', [App\Http\Controllers\DashboardController::class, 'index']);
  Route::post('/dashboard-admin-param', [App\Http\Controllers\DashboardController::class, 'indexParameter'])->name('admin.indexParameter');
  // Route::get('/dashboard-admin', function () {
  //     return view('admin.index');
  // });
  Route::get('/tambah', function () {
    return view('common.tambahorder');
  });
  Route::get('/tambah', [App\Http\Controllers\EventController::class, 'create'])->name('common.tambahorder');

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
  Route::get('/edit-pelanggan', [App\Http\Controllers\AdminController::class, 'edit'])->name('admin.editpelanggan');
  Route::post('/update-pelanggan', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.updatepelanggan');

  // EVENT CONTORLLER
  Route::get('/event-list', [App\Http\Controllers\EventController::class, 'index'])->name('common.listevent');
  Route::get('/tambah-event', [App\Http\Controllers\EventController::class, 'create'])->name('common.index.tambahevent');
  Route::post('/detail-event', [App\Http\Controllers\EventController::class, 'show'])->name('common.detailevent');
  Route::post('/get-barang', [App\Http\Controllers\EventController::class, 'get_barang'])->name('common.getbarang');
  Route::post('/tambah-event', [App\Http\Controllers\EventController::class, 'store'])->name('common.tambahevent');
  Route::post('/delete-event', [App\Http\Controllers\EventController::class, 'destroy'])->name('common.deleteevent');
  Route::post('/update-event', [App\Http\Controllers\EventController::class, 'update'])->name('common.updateevent');
  Route::post('/get-stock', [App\Http\Controllers\EventController::class, 'getstock'])->name('common.getstock');

  //   INVOICE CONTROLLER
  Route::get('/data-invoice', [App\Http\Controllers\InvoiceController::class, 'tabelPenawaran'])->name('invoice.list');
  Route::get('/detail-invoice', [App\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.detail');
  Route::get('/data-tagihan', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.tagihan.list');
  Route::post('/invoice-status-update', [App\Http\Controllers\InvoiceController::class, 'ubahStatus'])->name('invoice.ubahstatus');
  Route::get('/invoice-cetak', [App\Http\Controllers\InvoiceController::class, 'pdfPage'])->name('invoice.cetak');
  Route::get('/form-bayar-invoice', [App\Http\Controllers\InvoiceController::class, 'showBayar'])->name('invoice.bayar.index');
  Route::post('/bayar-invoice', [App\Http\Controllers\InvoiceController::class, 'bayar'])->name('invoice.bayar');
  Route::get('/tagihan-cetak', [App\Http\Controllers\InvoiceController::class, 'pdfPageTagihan'])->name('tagihan.cetak');
  
  // GUDANG CONTROLLER
  Route::get('/data-gudang', [App\Http\Controllers\BarangController::class, 'index'])->name('gudang.datagudang');
  Route::get('/gudang', [App\Http\Controllers\BarangController::class, 'task'])->name('gudang');
  Route::get('/tambah-gudang', [App\Http\Controllers\BarangController::class, 'create'])->name('tambahgudang');
  Route::post('/tambah-gudang', [App\Http\Controllers\BarangController::class, 'store'])->name('storegudang');
  Route::post('/get-nama', [App\Http\Controllers\BarangController::class, 'getNama'])->name('getnama');
  Route::post('/check-task', [App\Http\Controllers\BarangController::class, 'doneTask'])->name('checktask');
  Route::get('/edit-gudang', [App\Http\Controllers\BarangController::class, 'edit'])->name('editgudang');
  Route::post('/update-gudang', [App\Http\Controllers\BarangController::class, 'update'])->name('updategudang');
  Route::post('/delete-gudang', [App\Http\Controllers\BarangController::class, 'destroy'])->name('deletegudang');
  
  // JENIS CONTROLLER
  Route::get('/data-jenis', [App\Http\Controllers\JenisBarangController::class, 'index'])->name('jenis.datajenis');
  Route::get('/tambah-jenis', [App\Http\Controllers\JenisBarangController::class, 'create'])->name('tambahjenis');
  Route::post('/tambah-jenis', [App\Http\Controllers\JenisBarangController::class, 'store'])->name('storejenis');
  Route::get('/edit-jenis', [App\Http\Controllers\JenisBarangController::class, 'edit'])->name('editjenis');
  Route::post('/update-jenis', [App\Http\Controllers\JenisBarangController::class, 'update'])->name('updatejenis');
  Route::post('/delete-jenis', [App\Http\Controllers\JenisBarangController::class, 'destroy'])->name('deletejenis');

  // ITEM DAMAGE CONTROLLER
  Route::get('/data-damage', [App\Http\Controllers\ItemDamageController::class, 'index'])->name('damage.datadamage');
  Route::get('/data-damage-servicer', [App\Http\Controllers\ItemDamageController::class, 'indexServicer'])->name('damage.datadamage-servicer');
  Route::get('/tambah-damage', [App\Http\Controllers\ItemDamageController::class, 'create'])->name('tambahdamage');
  Route::post('/tambah-damage', [App\Http\Controllers\ItemDamageController::class, 'store'])->name('storedamage');
  Route::get('/edit-damage', [App\Http\Controllers\ItemDamageController::class, 'edit'])->name('editdamage');
  Route::post('/update-damage', [App\Http\Controllers\ItemDamageController::class, 'update'])->name('updatedamage');
  Route::get('/edit-service-damage', [App\Http\Controllers\ItemDamageController::class, 'editService'])->name('editservicedamage');
  Route::post('/service-damage', [App\Http\Controllers\ItemDamageController::class, 'service'])->name('servicedamage');
  Route::post('/delete-damage', [App\Http\Controllers\ItemDamageController::class, 'destroy'])->name('deletedamage');
  
  // SHIPPING CONTROLLER
  Route::get('/data-shipping', [App\Http\Controllers\ShippingController::class, 'index'])->name('shipping.datashipping');
  Route::get('/tambah-shipping', [App\Http\Controllers\ShippingController::class, 'create'])->name('tambahshipping');
  Route::post('/check-driver', [App\Http\Controllers\ShippingController::class, 'checkDriver'])->name('checkdriver');
  Route::post('/get-barang-shipping', [App\Http\Controllers\ShippingController::class, 'getBarang'])->name('getbarangshipping');
  Route::post('/get-list-barang-shipping', [App\Http\Controllers\ShippingController::class, 'getListBarang'])->name('getlistbarangshipping');
  Route::get('/get-barang-keluar-get', [App\Http\Controllers\ShippingController::class, 'getBarangOut'])->name('getbarangoutget');
  Route::post('/get-barang-keluar-post', [App\Http\Controllers\ShippingController::class, 'getBarangOut'])->name('getbarangoutpost');
  Route::post('/tambah-shipping', [App\Http\Controllers\ShippingController::class, 'store'])->name('storeshipping');
  Route::get('/edit-shipping', [App\Http\Controllers\ShippingController::class, 'edit'])->name('editshipping');
  Route::post('/get-barang-edit-shipping', [App\Http\Controllers\ShippingController::class, 'getBarangEdit'])->name('getbarangeditshipping');
  Route::post('/update-shipping', [App\Http\Controllers\ShippingController::class, 'update'])->name('updateshipping');
  Route::post('/delete-shipping', [App\Http\Controllers\ShippingController::class, 'destroy'])->name('deleteshipping');
  Route::get('/surat-jalan', [App\Http\Controllers\ShippingController::class, 'cetakSuratjalan'])->name('suratjalan');
});

// KARYAWAN CONTROLLER
Route::get('/dashbord-sales', [App\Http\Controllers\KaryawanController::class, 'index'])->name('sales.dashboard');
// Route::get('/reminder', [App\Http\Controllers\KaryawanController::class, 'jadwalreminder'])->name('karyawan.reminder');
// Route::get('/tagihan', [App\Http\Controllers\KaryawanController::class, 'getTagihan'])->name('karyawan.tagihan');
// Route::post('/detail-agenda', [App\Http\Controllers\KaryawanController::class, 'getData'])->name('karyawan.detailagenda');
// Route::post('/delete-agenda', [App\Http\Controllers\KaryawanController::class, 'destroy'])->name('karyawan.deleteagenda');
// Route::post('/update-agenda', [App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.updateagenda');
// Route::post('/tambah-agenda', [App\Http\Controllers\KaryawanController::class, 'store'])->name('karyawan.tambahagenda');


// Route::get('/', function () {
//     return view('admin.index');
// });
// Route::get('/dashboard', function () {
//     return view('karyawan.index');
// });
// Route::get('/dashboard-admin', function () {
//     return view('admin.index');
// });
// // Route::get('/tambah', function () {
// //     return view('common.tambahorder');
// // });
// Route::get('/tambah', [App\Http\Controllers\EventController::class, 'create'])->name('common.tambahorder');
// Route::get('/data-transaksi', function () {
//     return view('common.datatransaksi');
// });
// Route::get('/detail', function () {
//     return view('common.detailorder');
// });

// // ADMIN CONTROLLER
// Route::get('/data-pelanggan', [App\Http\Controllers\AdminController::class, 'index_datapelanggan'])->name('admin.datapelanggan');
// Route::get('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'index_tambahpelanggan'])->name('admin.index.tambahpelanggan');
// Route::post('/detail-pelanggan', [App\Http\Controllers\AdminController::class, 'detail'])->name('admin.detailpelanggan');
// Route::post('/tambah-pelanggan', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.tambahpelanggan');
// Route::post('/delete-pelanggan', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.deletepelanggan');
// Route::post('/update-pelanggan', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.updatepelanggan');

// // EVENT CONTORLLER
// Route::get('/event-list', [App\Http\Controllers\EventController::class, 'index'])->name('common.listevent');
// Route::get('/tambah-event', [App\Http\Controllers\EventController::class, 'create'])->name('common.index.tambahevent');
// Route::post('/detail-event', [App\Http\Controllers\EventController::class, 'show'])->name('common.detailevent');
// Route::post('/get-barang', [App\Http\Controllers\EventController::class, 'get_barang'])->name('common.getbarang');
// Route::post('/tambah-event', [App\Http\Controllers\EventController::class, 'store'])->name('common.tambahevent');
// Route::post('/delete-event', [App\Http\Controllers\EventController::class, 'destroy'])->name('common.deleteevent');
// Route::post('/update-event', [App\Http\Controllers\EventController::class, 'update'])->name('common.updateevent');

// AUTH CONTROLLER
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('loginPage');
Route::post('/loginAkun', [App\Http\Controllers\AuthController::class, 'login'])->name('masuk');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegistrationForm'])->name('registerPage');
Route::post('/registerAkun', [App\Http\Controllers\AuthController::class, 'register'])->name('daftar');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


// Route::get('/data-gudang', [App\Http\Controllers\GudangController::class, 'index'])->name('gudang.datagudang');
