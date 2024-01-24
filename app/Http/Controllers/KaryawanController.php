<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Event;
use App\Models\Tagihan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        // Merubah semua event dengan status diproses menjadi selesai ketika tanggal hari ini sudah melewati tanggal loading out
        $tanggalSekarang = Carbon::now();
        $semua_event = Event::where('waktu_loading_out', '<=', $tanggalSekarang)
          ->where('status', 'Diproses')
          ->get();
        foreach ($semua_event as $event){
          $event->status = "Selesai";
          $event->save();
        }

        $user_id = Auth::user()->id;
        $events = Event::whereYear('tanggal', '=', now('Y'))
        ->whereMonth('tanggal', '=', now('m'))
        ->where('PIC','=',$user_id)
        ->get();

        $jumlah_event = count($events);

        $omzet = Event::join('invoices', 'invoices.events_id', '=', 'events.id')
        ->whereYear('events.tanggal', '=', now('Y'))
        ->whereMonth('events.tanggal', '=', now('m'))
        ->where('events.PIC','=',$user_id)
        ->sum('invoices.total_harga');

        $status_events = Event::select('status', DB::raw('count(*) as total'))
        ->whereYear('events.tanggal', '=', now('Y'))
        ->whereMonth('events.tanggal', '=', now('m'))
        ->where('events.PIC','=',$user_id)
        ->groupBy('status')
        ->get();

        $list_event = [];
        foreach ($events as $event) {
          $id = $event->id;
          $tanggal = $event->tanggal;
          $nama = $event->nama;
          $status = $event->status;
          $lokasi = $event->lokasi;
          $budget = $event->budget;

          $list_kategori = Event::select(DB::raw('DISTINCT kategori_barang.nama'))
          ->join('invoices', 'events.id', '=', 'invoices.events_id')
          ->join('item_barang_has_events', 'events.id', '=', 'item_barang_has_events.events_id')
          ->join('item_barang', 'item_barang_has_events.item_barang_id', '=', 'item_barang.id')
          ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
          ->join('kategori_barang', 'jenis_barang.kategori_barang_id', '=', 'kategori_barang.id')
          ->where('events.PIC','=',$user_id)
          ->get();

          $string_kategori = "";
          for ($i=0; $i<count($list_kategori); $i++) {
            if ($i != count($list_kategori)-1)
              $string_kategori .= $list_kategori[$i]->nama .= ", ";
            else
              $string_kategori .= $list_kategori[$i]->nama;
          }
          $list = [
            'id' => $id,
            'tanggal' => $tanggal,
            'nama' => $nama,
            'status' => $status,
            'lokasi' => $lokasi,
            'budget' => $budget,
            'kategori' => $string_kategori,
          ];
          array_push($list_event, $list);
        }
        $data = [
          'jumlah_event' => $jumlah_event,
          'omzet' => $omzet,
          'status_events' => $status_events,
          'list_events' => $list_event
        ];


        
        return view('karyawan.index', ['data' => $data]);
    }

    public function indexParameter(Request $request)
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

        $omzet = Event::join('invoices', 'invoices.events_id', '=', 'events.id')
        ->whereYear('events.tanggal', '=', $year)
        ->whereMonth('events.tanggal', '=', $month)
        ->where('events.PIC','=',$user_id)
        ->sum('invoices.total_harga');

        $status_events = Event::select('status', DB::raw('count(*) as total'))
        ->whereYear('events.tanggal', '=', $year)
        ->whereMonth('events.tanggal', '=', $month)
        ->where('events.PIC','=',$user_id)
        ->groupBy('status')
        ->get();

        $list_event = [];
        foreach ($events as $event) {
          $tanggal = $event->tanggal;
          $nama = $event->nama;
          $status = $event->status;
          $lokasi = $event->lokasi;
          $budget = $event->budget;

          $list_kategori = Event::select(DB::raw('DISTINCT kategori_barang.nama'))
          ->join('invoices', 'events.id', '=', 'invoices.events_id')
          ->join('item_barang_has_events', 'events.id', '=', 'item_barang_has_events.events_id')
          ->join('item_barang', 'item_barang_has_events.item_barang_id', '=', 'item_barang.id')
          ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
          ->join('kategori_barang', 'jenis_barang.kategori_barang_id', '=', 'kategori_barang.id')
          ->get();

          $string_kategori = "";
          for ($i=0; $i<count($list_kategori); $i++) {
            if ($i != count($list_kategori)-1)
              $string_kategori .= $list_kategori[$i]->nama .= ", ";
            else
              $string_kategori .= $list_kategori[$i]->nama;
          }
          $list = [
            'tanggal' => $tanggal,
            'nama' => $nama,
            'status' => $status,
            'lokasi' => $lokasi,
            'budget' => $budget,
            'kategori' => $string_kategori,
          ];
          array_push($list_event, $list);
        }
        $data = [
          'jumlah_event' => $jumlah_event,
          'omzet' => $omzet,
          'status_events' => $status_events,
          'list_events' => $list_event
        ];
        $status = "success";
        $msg = "Berhasil mengubah tanggal data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
        ), 200);
    }
    
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

    public function getTagihan(){
        $tagihans = Tagihan::where('status', 'Not Paid')->get();
        return view('karyawan.tagihan', ['tagihans' => $tagihans]);
    }
}
