<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Barang;
use App\Models\JenisBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();

        return view('gudang.datagudang', ['all_barang' => $barang]);
      }

    public function task()
    {
        $userId = Auth::user()->id;
        $tasks = Agenda::where('karyawans_id', '=', $userId)->whereNull("selesai")->get();
        
        return view('gudang.index', ["tasks" => $tasks]);
    }

    public function doneTask(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $agenda = Agenda::find($request->input('id'));

        if (!$agenda) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $agenda->update([
            'selesai' => Carbon::today(),
        ]);

        $status = "success";
        $msg = "Berhasil menghapus task";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semua_jenis = JenisBarang::all();

        return view('gudang.tambahgudang', ['jenis_barang' => $semua_jenis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang_id' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'tanggalBeli' => 'required|date',
            'hargaBeli' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        
        $barang = Barang::create($request->all());
        $dataId = $barang->id;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataId,
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $barang = Barang::find($request->input('id'));
        // $barang = Barang::find(1);

        return view('gudang.editgudang', [
            'barang' => $barang,
            'jenis' => JenisBarang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang_id' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'tanggalBeli' => 'required|date',
            'hargaBeli' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $barang = Barang::find($request->input('id'));

        if (!$barang) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $barang->update([
            'jenis_barang_id' => $request->input('jenis_barang_id'),
            'qty' => $request->input('qty'),
            'satuan' => $request->input('satuan'),
            'tanggalBeli' => $request->input('tanggalBeli'),
            'hargaBeli' => $request->input('hargaBeli'),
        ]);

        $status = "success";
        $msg = "Berhasil mengubah data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $barang = Barang::find($request['id']);
        
        if ($barang) {
            $deleted = $barang->delete();

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