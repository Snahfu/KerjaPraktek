<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventJenis;
use App\Models\Invoice;
use App\Models\JenisBarang;
use App\Models\Kategori;
use App\Models\ShippingBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        //
        $userRole = Auth::user()->divisi_id;
        if ($userRole) {
            abort(403);
        }
        return view('karyawan.reminder', []);
    }

    public function create()
    {
        $userRole = Auth::user()->divisi_id;
        if (!$userRole) {
            abort(403);
        }

        $semua_kategori = Kategori::all();
        $semua_customer = Customer::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->id] = [];
            $kategori_map[$kategori->id] = $kategori->nama;
        }
        // dd($kategori_map);
        return view('common.tambahorder', [
            'array_kategori' => $kategori_array,
            'kategori_map' => $kategori_map,
            'semua_customer' => $semua_customer
        ]);
    }

    public function get_barang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $barang = JenisBarang::where('kategori_barang_id', $request['id'])->get();

        if (!$barang) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'datas' => $barang,
        ), 200);
    }

    public function getstock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_in' => 'required',
            'tanggal_out' => 'required',
            'id_jenis_barangs' => 'required',
        ]);
        
        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        // dd($request['tanggal_in']);
        $tanggal_in = Carbon::parse($request['tanggal_in']);
        $tanggal_out = Carbon::parse($request['tanggal_out']);
        $id_jenis_barangs = $request['id_jenis_barangs'];

        // Query database untuk mengambil id_item_barangs yang sesuai dengan rentang tanggal_in dan tanggal_out
        $shippings_data = ShippingBarang::join('item_shipping', 'item_shipping.id', '=', 'item_barang_has_item_shipping.item_shipping_id')
            // ->join('item_barang','item_barang.id','=','item_barang_has_item_shipping.item_barang_id')
            ->whereBetween('item_shipping.tglJalan', [$tanggal_in, $tanggal_out])
            ->get();
        // dd($shippings_data);

        // Inisialisasi Variabel Total
        $total_pakai = 0;

        // Menghitung total pakai
        foreach ($shippings_data as $shipping) {
            $qty = $shipping->qty;
            $total_pakai += $qty;
        }

        // Stock yg Dimiliki pada Jenis Barang $request
        $total_stock = Barang::where('jenis_barang_id', $id_jenis_barangs)
            ->sum('qty');
        
        $sisa = $total_stock - $total_pakai;
        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'sisa' => $sisa,
        ), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'PIC' => 'required',
            'customers_id' => 'required',
            'nama' => 'required|string',
            'status' => 'required|string',
            'lokasi' => 'required|string',
            'jabatan_client' => 'required|string',
            'waktu_loading_out' => 'required|date',
            'waktu_loading' => 'required|date',
            'jam_mulai_acara' => 'required|date',
            'jam_selesai_acara' => 'required|date',
            'listbarang' => 'required',
            'jenis_kegiatan' => 'required',
            'penyelenggara' => 'required',
            'tanggal' => 'required|date',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        DB::beginTransaction();

        try {
            $event = Event::create([
                'PIC' => $request->input('PIC'),
                'customers_id' => $request->input('customers_id'),
                'nama' => $request->input('nama'),
                'status' => $request->input('status'),
                'lokasi' => $request->input('lokasi'),
                'jabatan_client' => $request->input('jabatan_client'),
                'waktu_loading_out' => $request->input('waktu_loading_out'),
                'waktu_loading' => $request->input('waktu_loading'),
                'jam_mulai_acara' => $request->input('jam_mulai_acara'),
                'jam_selesai_acara' => $request->input('jam_selesai_acara'),
                'tanggal' => $request->input('tanggal'),
                'penyelenggara' => $request->input('penyelenggara'),
                'jenis_kegiatan' => $request->input('jenis_kegiatan'),
                'budget' => $request->input('budget'),
                'catatan' => $request->input('catatan'),
            ]);
            $dataId = $event->id;
            $invoice = Invoice::create([
                'events_id' => $dataId,
                'tanggal_jatuh_tempo' => $request->input('tanggal'),
                'total_harga' => 0,
                'status' => "Penawaran",
                'catatan' => "",
            ]);
            $invoice_id = $invoice->id;
            $total_harga = 0;
            foreach ($request['listbarang'] as $kategori) {
                foreach ($kategori as $barang) {
                    // EventJenis ini adalah Detail Invoice
                    $detailBarang = new EventJenis();
                    $detailBarang->invoices_id = $invoice_id;
                    $detailBarang->jenis_barang_id = $barang['idbarang'];
                    $detailBarang->qty = $barang['jumlah'];
                    $detailBarang->harga_barang = $barang['harga'];
                    $detailBarang->subtotal = $barang['subtotal'];
                    $detailBarang->save();
                    $total_harga += $barang['subtotal'];
                }
            }

            $invoice->total_harga = $total_harga;
            $invoice->save();

            DB::commit();
            $status = "success";
            $msg = "Berhasil menambahkan data";
            return response()->json(array(
                'status' => $status,
                'msg' => $msg,
                'data' => $dataId,
            ), 200);
        } catch (\Exception $e) {

            DB::rollback();

            $status = "failed";
            return response()->json(array(
                'status' => $status,
                'msg' => $e->getMessage(),
                'data' => $dataId,
            ), 200);
        }
    }

    public function show(Request $request)
    {
        $status = "failed";
        $msg = "Gagal Ambil Data, Id tidak ditemukan";
        $data = "";

        if ($request['id']) {
            $status = "success";
            $msg = "Berhasil";
            $data = Event::find($request['id']);
        }

        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ), 200);
    }

    public function update(Request $request)
    {
        // UPDATE DATA STATUS TIDAK PERLU DIKIRIM
        $validator = Validator::make($request->all(), [
            'PIC' => 'required',
            'customers_id' => 'required',
            'nama' => 'required|string',
            'lokasi' => 'required|string',
            'jabatan_client' => 'required|string',
            'waktu_loading_out' => 'required|date',
            'waktu_loading' => 'required|date',
            'jam_mulai_acara' => 'required|date',
            'jam_selesai_acara' => 'required|date',
            'listbarang' => 'required',
            'jenis_kegiatan' => 'required',
            'penyelenggara' => 'required',
            'tanggal' => 'required|date',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        // 
        $event = Event::find($request->input('id'));

        if (!$event) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        DB::beginTransaction();

        try {
            $event->update([
                'PIC' => $request->input('PIC'),
                'customers_id' => $request->input('customers_id'),
                'nama' => $request->input('nama'),
                'lokasi' => $request->input('lokasi'),
                'jabatan_client' => $request->input('jabatan_client'),
                'waktu_loading_out' => $request->input('waktu_loading_out'),
                'waktu_loading' => $request->input('waktu_loading'),
                'jam_mulai_acara' => $request->input('jam_mulai_acara'),
                'jam_selesai_acara' => $request->input('jam_selesai_acara'),
                'tanggal' => $request->input('tanggal'),
                'penyelenggara' => $request->input('penyelenggara'),
                'jenis_kegiatan' => $request->input('jenis_kegiatan'),
                'budget' => $request->input('budget'),
                'catatan' => $request->input('catatan'),
            ]);

            // Hapus Database 
            DB::table('detail_invoice')->where('invoices_id', $request['invoices_id'])->delete();

            $invoice_data = Invoice::find($request['invoices_id']);
            $invoice_id = $invoice_data->id;
            $total_harga = 0;

            foreach ($request['listbarang'] as $kategori) {
                foreach ($kategori as $barang) {
                    // EventJenis ini adalah Detail Invoice
                    $detailBarang = new EventJenis();
                    $detailBarang->invoices_id = $invoice_id;
                    $detailBarang->jenis_barang_id = $barang['idbarang'];
                    $detailBarang->qty = $barang['jumlah'];
                    $detailBarang->harga_barang = $barang['harga'];
                    $detailBarang->subtotal = $barang['subtotal'];
                    $detailBarang->save();
                    $total_harga += $barang['subtotal'];
                }
            }

            $invoice_data->total_harga = $total_harga;
            $invoice_data->save();

            DB::commit();
            $status = "success";
            $msg = "Berhasil merubah data";
            return response()->json(array(
                'status' => $status,
                'msg' => $msg,
            ), 200);
        } catch (\Exception $e) {

            DB::rollback();

            $status = "failed";
            return response()->json(array(
                'status' => $status,
                'msg' => $e->getMessage(),
            ), 200);
        }
    }

    public function destroy(Request $request)
    {
        $event = Event::find($request['id']);

        if ($event) {
            $deleted = $event->delete();

            if ($deleted) {
                $status = "success";
                $msg = "Berhasil menghapus data";
            } else {
                $status = "failed";
                $msg = "Gagal menghapus data";
            }
        } else {
            $status = "failed";
            $msg = "Data tidak ditemukan";
        }

        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }
}
