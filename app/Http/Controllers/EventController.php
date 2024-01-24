<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventJenis;
use App\Models\Invoice;
use App\Models\ItemBarangHasEvent;
use App\Models\ItemDamage;
use App\Models\JenisBarang;
use App\Models\Kategori;
use App\Models\Shipping;
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

    public function create2(Request $request)
    {
        $userRole = Auth::user()->divisi_id;
        if (!$userRole) {
            abort(403);
        }

        $detail_invoice = EventJenis::join('invoices', 'invoices.id', '=', 'detail_invoice.invoices_id')
            ->join('jenis_barang', 'jenis_barang.id', '=', 'detail_invoice.jenis_barang_id')
            ->join('events', 'events.id', '=', 'invoices.events_id')
            ->join('customers', 'customers.id', '=', 'events.customers_id')
            ->where('detail_invoice.invoices_id', $request['id'])
            ->select(
                'events.*',
                'jenis_barang.kategori_barang_id',
                'jenis_barang.nama as nama_barang',
                'detail_invoice.*',
            )
            ->get();

        // dd($detail_invoice);

        $semua_customer = Customer::all();
        $semua_kategori = Kategori::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->id] = [];
            $kategori_map[$kategori->id] = $kategori->nama;
        }

        $array_jenisKegiatan = [
            "Wisuda",
            "Ulang Tahun",
            "Wedding",
            "Meeting",
            "Galla Dinner",
            "Konser",
            "Bazzar",
            "Drama",
        ];
        return view('common.tambahorder2', [
            'detail_invoices' => $detail_invoice,
            'array_kategori' => $kategori_array,
            'kategori_map' => $kategori_map,
            'semua_customer' => $semua_customer,
            'array_jenisKegiatan' => $array_jenisKegiatan,
            'invoices_id' => $detail_invoice[0]->invoices_id,
            'events_id' => $detail_invoice[0]->id,
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

        $jenis_barang_type = Barang::where('jenis_barang_id', $id_jenis_barangs)->first();

        if ($jenis_barang_type->type == "serial") {

            $jumlahBarangYangStockReady = count(DB::select(DB::raw("SELECT ib.* FROM item_barang ib LEFT JOIN item_barang_has_events ibhe ON ib.id = ibhe.item_barang_id WHERE ib.jenis_barang_id = $id_jenis_barangs AND (('$tanggal_in' < ibhe.status_in AND '$tanggal_out' > ibhe.status_out) OR ibhe.item_barang_id IS NULL ) AND ibhe.item_barang_id IS NULL")));

            $jumlahBarangRusakPadaJenisX = count(ItemDamage::join('item_barang', 'item_damage.item_barang_id', '=', 'item_barang.id')
                ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
                ->select('item_barang.*')
                ->where('jenis_barang.id', $id_jenis_barangs)
                ->whereNull('item_damage.repair_date')
                ->get());

            // Stock itu barang yang ready pada tanggal itu dan sudah dikurangi dengan data item_barang yg rusak
            $sisa = $jumlahBarangYangStockReady - $jumlahBarangRusakPadaJenisX;
            if ($sisa < 0) {
                $sisa = 0;
            }
        } else {
            $jumlahBarangYangStockReady = Barang::where('jenis_barang_id', $id_jenis_barangs)->get();
            $stock = 0;
            foreach ($jumlahBarangYangStockReady as $barang) {
                $stock += $barang->qty;
            }

            $jumlahBarangYangTerpakai = ItemBarangHasEvent::join('item_barang', 'item_barang.id', '=', 'item_barang_has_events.item_barang_id')
                ->where('item_barang.jenis_barang_id', $id_jenis_barangs)
                ->where(function($query) use ($tanggal_in, $tanggal_out) {
                    $query->where('item_barang_has_events.status_out', '>=', $tanggal_in)
                        ->where('item_barang_has_events.status_out', '<=', $tanggal_out);
                })
                ->select('item_barang_has_events.qty')
                ->get();
            
            $pakai = 0;
            foreach($jumlahBarangYangTerpakai as $barang){
                $pakai += $barang->qty;
            }

            $sisa = $stock-$pakai;
        }


        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'sisa' => $sisa,
        ), 200);
    }

    public function getstock2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_in' => 'required',
            'tanggal_out' => 'required',
            'nama_jenis_barang' => 'required',
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
        $id_jenis_barangs = JenisBarang::where('nama', $request['nama_jenis_barang'])
            ->first()->id;

        $jenis_barang_type = Barang::where('jenis_barang_id', $id_jenis_barangs)->first();
        if ($jenis_barang_type->type == "serial") {

            $jumlahBarangYangStockReady = count(DB::select(DB::raw("SELECT ib.* FROM item_barang ib LEFT JOIN item_barang_has_events ibhe ON ib.id = ibhe.item_barang_id WHERE ib.jenis_barang_id = $id_jenis_barangs AND (('$tanggal_in' < ibhe.status_in AND '$tanggal_out' > ibhe.status_out) OR ibhe.item_barang_id IS NULL ) AND ibhe.item_barang_id IS NULL")));

            $jumlahBarangRusakPadaJenisX = count(ItemDamage::join('item_barang', 'item_damage.item_barang_id', '=', 'item_barang.id')
                ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
                ->select('item_barang.*')
                ->where('jenis_barang.id', $id_jenis_barangs)
                ->whereNull('item_damage.repair_date')
                ->get());

            // Stock itu barang yang ready pada tanggal itu dan sudah dikurangi dengan data item_barang yg rusak
            $sisa = $jumlahBarangYangStockReady - $jumlahBarangRusakPadaJenisX;
            if ($sisa < 0) {
                $sisa = 0;
            }
        } else {
            $jumlahBarangYangStockReady = Barang::where('jenis_barang_id', $id_jenis_barangs)->get();
            $stock = 0;
            foreach ($jumlahBarangYangStockReady as $barang) {
                $stock += $barang->qty;
            }

            $jumlahBarangYangTerpakai = ItemBarangHasEvent::join('item_barang', 'item_barang.id', '=', 'item_barang_has_events.item_barang_id')
                ->where('item_barang.jenis_barang_id', $id_jenis_barangs)
                ->where(function($query) use ($tanggal_in, $tanggal_out) {
                    $query->where('item_barang_has_events.status_out', '>=', $tanggal_in)
                        ->where('item_barang_has_events.status_out', '<=', $tanggal_out);
                })
                ->select('item_barang_has_events.qty')
                ->get();
            
            $pakai = 0;
            foreach($jumlahBarangYangTerpakai as $barang){
                $pakai += $barang->qty;
            }
            
            $sisa = $stock-$pakai;
        }

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
                'status' => "Menunggu Persetujuan",
                'catatan' => "",
            ]);
            $invoice_id = $invoice->id;
            $total_harga = 0;

            // DETAIL INVOICE
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
                    $kategori_dummy = $barang['kategori'];
                }
                DB::insert('INSERT INTO events_has_divisi (events_id, divisi_id) VALUES (?, ?)', [$dataId, $kategori_dummy]);
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

    public function store2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'listbarang' => 'required',
            'id_event' => 'required',
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
            $dataId = $request->input('id_event');
            $invoice = Invoice::create([
                'events_id' => $dataId,
                'tanggal_jatuh_tempo' => $request->input('tanggal'),
                'total_harga' => 0,
                'status' => "Menunggu Persetujuan",
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
                'status' => $request->input('status'),
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
            $invoice_data->status = "Menunggu Persetujuan";
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
