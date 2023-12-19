<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use App\Models\EventJenis;
use App\Models\JenisBarang;
use App\Models\Kategori;
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
        if($userRole){
            abort(403);
        }
        return view('karyawan.reminder', []);
    }

    public function create()
    {
        $userRole = Auth::user()->divisi_id;
        if(!$userRole){
            abort(403);
        }

        $semua_kategori = Kategori::all();
        $semua_customer = Customer::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->id] = [];
            $kategori_map[$kategori->id] = $kategori->nama;
        }
        // dd($kategori_map);
        return view('common.tambahorder', ['array_kategori' => $kategori_array, 'kategori_map' => $kategori_map, 'semua_customer' => $semua_customer]);
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
            'listbarang' => 'required'
        ]);
        
        dd($request);

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
            ]);
            $dataId = $event->id;
            foreach ($request['listbarang'] as $kategori) {
                foreach($kategori as $barang){
                    $detailBarang = new EventJenis();
                    $detailBarang->events_id = $dataId;
                    $detailBarang->jenis_barang_idjenis_barang = $barang['idbarang'];
                    $detailBarang->qty = $barang['jumlah'];
                    $detailBarang->harga_barang = $barang['harga'];
                    $detailBarang->subtotal = $barang['subtotal'];
                    $detailBarang->save();
                }
            }

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
        $validator = Validator::make($request->all(), [
            'id' => 'required',
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
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $event = Event::find($request->input('id'));

        if (!$event) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $event->update([
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
        ]);

        $status = "success";
        $msg = "Berhasil mengubah data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
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
