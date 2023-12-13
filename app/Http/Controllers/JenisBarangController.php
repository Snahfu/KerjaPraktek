<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisBarang = JenisBarang::all();

        return view('jenis-barang.dataJenisBarang', ['datas' =>$jenisBarang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();

        return view('jenis-barang.tambahjenis', ['kategori' => $kategori]);
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
            'nama' => 'required',
            'harga_sewa' => 'required',
            'kategori_barang_id' => 'required',
            'spesifikasi' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        
        $jenis = JenisBarang::create($request->all());
        $dataId = $jenis->id;

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
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBarang $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $jenis = JenisBarang::find($request->input('id'));
        // $jenis = JenisBarang::find(1);

        return view('jenis-barang.editjenis', [
            'jenis' => $jenis,
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisBarang  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisBarang $jenis)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga_sewa' => 'required',
            'kategori_barang_id' => 'required',
            'spesifikasi' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $jenis = JenisBarang::find($request->input('id'));

        if (!$jenis) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $jenis->update([
            'nama' => $request->input('nama'),
            'harga_sewa' => $request->input('harga_sewa'),
            'kategori_barang_id' => $request->input('kategori_barang_id'),
            'spesifikasi' => $request->input('spesifikasi'),
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
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $jenis = JenisBarang::find($request['id']);
        
        if ($jenis) {
            $deleted = $jenis->delete();

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
