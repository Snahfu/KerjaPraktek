<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Jenis;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        //
        return view('karyawan.reminder', []);
    }

    public function create()
    {
        $semua_kategori = Kategori::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->idkategori] = [];
            $kategori_map[$kategori->idkategori] = $kategori->nama;
        }
        // dd($kategori_map);
        return view('common.tambahorder', ['array_kategori' => $kategori_array, 'kategori_map' => $kategori_map]);
    }

    public function get_barang(Request $request)
    {
        $datas = "";
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

        $barang = Jenis::where('kategori_barang_idkategori', $request['id'])->get();
        // dd($barang);

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
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $event = Event::create($request->all());
        $dataId = $event->id;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataId,
        ), 200);
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
            'PIC' => $request->input('judul'),
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
