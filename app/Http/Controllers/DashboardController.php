<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::whereYear('tanggal', '=', now('Y'))
        ->whereMonth('tanggal', '=', now('m'))
        ->get();

        $jumlah_event = count($events);

        $omzet = Event::join('invoices', 'invoices.events_id', '=', 'events.id')
        ->whereYear('events.tanggal', '=', now('Y'))
        ->whereMonth('events.tanggal', '=', now('m'))
        ->sum('invoices.total_harga');

        $status_events = Event::select('status', DB::raw('count(*) as total'))
        ->whereYear('events.tanggal', '=', now('Y'))
        ->whereMonth('events.tanggal', '=', now('m'))
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

          $list_kategori = Event::select('kategori_barang.nama')
          ->join('jenis_barang_has_events', 'events.id', '=', 'jenis_barang_has_events.events_id')
          ->join('jenis_barang', 'jenis_barang_has_events.jenis_barang_id', '=', 'jenis_barang.id')
          ->join('kategori_barang', 'jenis_barang.kategori_barang_id', '=', 'kategori_barang.id')
          ->get();

          $string_kategori = "";
          for ($i=0; $i<count($list_kategori); $i++) {
            if ($i != count($list_kategori)-1)
              $string_kategori .= $list_kategori[$i] .= ", ";
            else
              $string_kategori .= $list_kategori[$i];
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
        return view('admin.index', ['data' => $data]);
    }

    public function indexParameter(Request $request)
    {
        $date = $request['date'];
        $date = explode('-', $date);
        $year = $date[0];
        $month = $date[1];
        $events = Event::whereYear('tanggal', '=', $year)
        ->whereMonth('tanggal', '=', $month)
        ->get();

        $jumlah_event = count($events);

        $omzet = Event::join('invoices', 'invoices.events_id', '=', 'events.id')
        ->whereYear('events.tanggal', '=', $year)
        ->whereMonth('events.tanggal', '=', $month)
        ->sum('invoices.total_harga');

        $status_events = Event::select('status', DB::raw('count(*) as total'))
        ->whereYear('events.tanggal', '=', $year)
        ->whereMonth('events.tanggal', '=', $month)
        ->groupBy('status')
        ->get();

        $list_event = [];
        foreach ($events as $event) {
          $tanggal = $event->tanggal;
          $nama = $event->nama;
          $status = $event->status;
          $lokasi = $event->lokasi;
          $budget = $event->budget;

          $list_kategori = Event::select('kategori_barang.nama')
          ->join('jenis_barang_has_events', 'events.id', '=', 'jenis_barang_has_events.events_id')
          ->join('jenis_barang', 'jenis_barang_has_events.jenis_barang_id', '=', 'jenis_barang.id')
          ->join('kategori_barang', 'jenis_barang.kategori_barang_id', '=', 'kategori_barang.id')
          ->get();

          $string_kategori = "";
          for ($i=0; $i<count($list_kategori); $i++) {
            if ($i != count($list_kategori)-1)
              $string_kategori .= $list_kategori[$i] .= ", ";
            else
              $string_kategori .= $list_kategori[$i];
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
}
