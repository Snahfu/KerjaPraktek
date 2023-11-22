<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function jadwalreminder()
    {
        $colorEvent = [
            '#00ff00' => "Meeting",
            '#0000ff' => "Event",
            '#ff0000' => "Tagihan",
        ];
        $semua_agenda = Agenda::all();
        $events = [];
        foreach ($semua_agenda as $agenda) {
            $events[] = [
                'id' => $agenda->id,
                'title' => $agenda->judul,
                'start' => $agenda->mulai,
                'end' => $agenda->selesai,
                'description' => $agenda->deskripsi,
                'backgroundColor' => $agenda->warna,
            ];
        }
        return view('karyawan.reminder', ['semua_agenda' => $events, 'colors' => $colorEvent]);
    }

    public function getData(Request $request)
    {
        $status = "failed";
        $msg = "Gagal Ambil Data, Id tidak ditemukan";
        $data = "";

        if ($request['id']) {
            $status = "success";
            $msg = "Berhasil";
            $data = Agenda::find($request['id']);
        }

        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:190',
            'deskripsi' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'warna' => 'required|string',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $agenda = Agenda::create($request->all());
        $dataId = $agenda->id;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataId,
        ), 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'judul' => 'required|max:190',
            'deskripsi' => 'required',
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'warna' => 'required|string',
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
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'mulai' => $request->input('mulai'),
            'selesai' => $request->input('selesai'),
            'warna' => $request->input('warna'),
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
        $agenda = Agenda::find($request['id']);
        
        if ($agenda) {
            $deleted = $agenda->delete();

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
