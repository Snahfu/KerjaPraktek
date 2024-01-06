<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Barang;
use App\Models\Event;
use App\Models\ItemDamage;
use App\Models\JenisBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $events = Event::whereYear('tanggal', '=', now('Y'))
            ->whereMonth('tanggal', '=', now('m'))
            ->where('PIC','=',$user_id)
            ->get();

        $jumlah_event = count($events);

        $item_damage = ItemDamage::whereYear('damage_date','=', now('Y'))
            ->whereMonth('damage_date','=',now('m'))
            ->where('repair_status','=',"Proses")
            ->get();
        
        $jumlah_rusak = count($item_damage);

        $data = [
            'jumlah_event' => $jumlah_event,
            'jumlah_rusak' => $jumlah_rusak,
        ];
        return view('gudang.dashboard', ['data' => $data]);
    }

    public function dashboardParameter(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = $request['date'];
        $date = explode('-', $date);
        $year = $date[0];
        $month = $date[1];
        $events = Event::whereYear('tanggal', '=', $year)
        ->whereMonth('tanggal', '=', $month)
        ->where('PIC','=',$user_id)
        ->get();

        $jumlah_event = count($events);

        $item_damage = ItemDamage::whereYear('damage_date','=', $year)
            ->whereMonth('damage_date','=',$month)
            ->where('repair_status','=',"Proses")
            ->get();
        
        $jumlah_rusak = count($item_damage);
        
        $data = [
          'jumlah_event' => $jumlah_event,
          'jumlah_rusak' => $jumlah_rusak,
        ];
        $status = "success";
        $msg = "Berhasil mengubah tanggal data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ), 200);
    }

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

    public function doneTask(Request $request)
    {
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

    public function getNama(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_barang_id' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        $nama = JenisBarang::select('nama')
            ->find($request['jenis_barang_id']);

        $total = Barang::select(DB::raw('COUNT(*) AS total'))
            ->where('jenis_barang_id', '=', $request['jenis_barang_id'])
            ->first();

        $nama = $nama->nama . " - " . $total->total + 1;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $nama,
        ), 200);
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
            'type' => 'required',
            'nama' => 'required'
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $count_jumlah_data = Barang::select(DB::raw('jenis_barang.nama as nama, COUNT(*) AS total'))
            ->where('jenis_barang_id', '=', $request['jenis_barang_id'])
            ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
            ->first();

        $dataId = "";
        if ($request->type == "serial") {
            $qty = $request['qty'];
            $request_copy = $request;
            $request_copy['qty'] = 1;
            $request_copy['hargaBeli'] = $request_copy['hargaBeli'] / $qty;
            for ($i = 1; $i <= $qty; $i++) {
                $request_copy['nama'] = $count_jumlah_data->nama . " - " . $count_jumlah_data->total + $i;
                $barang = Barang::create($request_copy->all());
                $id = $barang->id;
                if ($i != $qty)
                    $dataId .= $id . ", ";
                else
                    $dataId .= $id;
            }
        } else {
            $barang = Barang::create($request->all());
            $dataId = $barang->id;
        }

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
            'type' => 'required',
            'nama' => 'required'
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
            'type' => $request->input('type'),
            'nama' => $request->input('nama'),
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
