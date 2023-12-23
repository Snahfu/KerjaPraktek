<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\EventJenis;
use App\Models\Invoice;
use App\Models\Kategori;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function tabelPenawaran()
    {
        // Pengecekan User
        if (Auth::user()->divisi_id == 5) {
            $list_invoices = Invoice::join('events', 'invoices.events_id', '=', 'events.id')
                ->join('customers', 'events.customers_id', '=', 'customers.id')
                ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
                // ->whereNotIn('invoices.status', ['Batal', 'Deal', 'Selesai', 'Disetujui'])
                ->select('invoices.*', 'events.nama as nama', 'events.tanggal as tanggal', 'customers.sapaan as sapaan', 'customers.nama_pelanggan as nama_pelanggan', 'karyawans.nama as namaPIC')
                ->get();
        } else {
            $list_invoices = Invoice::join('events', 'invoices.events_id', '=', 'events.id')
                ->join('customers', 'events.customers_id', '=', 'customers.id')
                ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
                ->where('events.PIC', Auth::user()->id) // Cuman bisa lihat invoice yang dibuat dia saja
                // ->whereNotIn('invoices.status', ['Batal', 'Deal', 'Selesai', 'Disetujui'])
                ->select('invoices.*', 'events.nama as nama', 'events.tanggal as tanggal', 'customers.sapaan as sapaan', 'customers.nama_pelanggan as nama_pelanggan', 'karyawans.nama as namaPIC')
                ->get();
        }


        return view('common.datainvoice', [
            'list_invoices' => $list_invoices,
        ]);
    }

    public function index()
    {
        // Pengecekan User
        if (Auth::user()->divisi_id == 5) {
            $list_invoices = Invoice::join('events', 'invoices.events_id', '=', 'events.id')
                ->join('customers', 'events.customers_id', '=', 'customers.id')
                ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
                ->join('tagihan', function ($join) {
                    $join->on('tagihan.invoices_id', '=', 'invoices.id')
                        ->whereRaw('tagihan.tanggal_input = (SELECT MAX(tanggal_input) FROM tagihan WHERE invoices_id = invoices.id)');
                })
                ->where('invoices.status', 'Deal')
                ->select('invoices.*', 'tagihan.id as tagihan_id', 'tagihan.status as status_tagihan', 'tagihan.nominal as pembayaran', 'events.nama as nama', 'events.tanggal as tanggal', 'customers.nama_pelanggan', 'customers.sapaan', 'karyawans.nama as namaPIC')
                ->get();
        } else {
            $list_invoices = Invoice::join('events', 'invoices.events_id', '=', 'events.id')
                ->join('customers', 'events.customers_id', '=', 'customers.id')
                ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
                ->join('tagihan', function ($join) {
                    $join->on('tagihan.invoices_id', '=', 'invoices.id')
                        ->whereRaw('tagihan.tanggal_input = (SELECT MAX(tanggal_input) FROM tagihan WHERE invoices_id = invoices.id)');
                })
                ->where('invoices.status', 'Deal')
                ->where('events.PIC', Auth::user()->id)
                ->select('invoices.*', 'tagihan.id as tagihan_id', 'tagihan.status as status_tagihan', 'tagihan.nominal as pembayaran', 'events.nama as nama', 'events.tanggal as tanggal', 'customers.nama_pelanggan', 'customers.sapaan', 'karyawans.nama as namaPIC')
                ->get();
        }

        // dd($list_invoices);
        return view('common.datatagihan', [
            'list_invoices' => $list_invoices,
        ]);
    }

    public function ubahStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required',
            'status_baru' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Kesalahan Sistem! Parameter yang dikirimkan tidak lengkap";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $invoice = Invoice::find($request['invoice_id']);

        if (!$invoice) {
            $status = "failed";
            $msg = "Kesalahan Sistem! Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        if ($request['status_baru'] == "Deal") {
            // Bikin Tagihan Berdasarkan Invoice Id
            $tagihan = new Tagihan();
            $tagihan->invoices_id = $invoice->id;
            $tagihan->tanggal_input = now();
            $tagihan->nominal = 0;
            $tagihan->status = "Belum DP";
            $tagihan->save();
        }
        $invoice->status = $request['status_baru'];
        $invoice->save();

        $status = "success";
        $msg = "Berhasil memperbaruhi status";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    public function pdfPage(Request $request)
    {
        $detail_invoice = EventJenis::join('invoices', 'invoices.id', '=', 'detail_invoice.invoices_id')
            ->join('jenis_barang', 'jenis_barang.id', '=', 'detail_invoice.jenis_barang_id')
            ->join('events', 'events.id', '=', 'invoices.events_id')
            ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
            ->join('customers', 'customers.id', '=', 'events.customers_id')
            ->where('detail_invoice.invoices_id', $request['id'])
            ->select(
                'events.*',
                'customers.sapaan',
                'customers.nama_pelanggan',
                'karyawans.nama as picNama',
                'karyawans.nomer_telepon',
                'jenis_barang.kategori_barang_id',
                'jenis_barang.nama as nama_barang',
                'detail_invoice.*',
            )
            ->get();
        // dd($detail_invoice);
        $query_divisi_yang_terlibat =  EventJenis::join('invoices', 'invoices.id', '=', 'detail_invoice.invoices_id')
            ->join('jenis_barang', 'jenis_barang.id', '=', 'detail_invoice.jenis_barang_id')
            ->join('kategori_barang', 'jenis_barang.kategori_barang_id', '=', 'kategori_barang.id')
            ->where('detail_invoice.invoices_id', $request['id'])
            ->select(
                'jenis_barang.kategori_barang_id',
                'jenis_barang.nama as nama_barang',
                'kategori_barang.nama as nama_kategori',
            )
            ->get();
        
        $divisi_yang_terlibat = [];
        foreach ($query_divisi_yang_terlibat as $itemBarang) {
            $kategori_barang = $itemBarang->nama_kategori;
            if (!in_array($kategori_barang, $divisi_yang_terlibat)) {
                $divisi_yang_terlibat[] = $kategori_barang;
            }
        }
        $tanggalMulai = Carbon::parse($detail_invoice[0]->jam_mulai_acara);
        $tanggalSelesai = Carbon::parse($detail_invoice[0]->jam_selesai_acara);

        $perbedaanJam = $tanggalSelesai->diffInHours($tanggalMulai);
        $nilaiPerbedaan = 1;
        if ($tanggalMulai->isSameDay($tanggalSelesai) && $perbedaanJam < 24) {
            $nilaiPerbedaan = 1;
        } else {
            $nilaiPerbedaan = $tanggalSelesai->diffInDays($tanggalMulai);
        }
        $tanggalMulai->locale('id');
        $tanggalMulaiDiformat = $tanggalMulai->translatedFormat('l, d F Y');

        $tanggalSekarang = Date::now();
        $tanggalSekarang->locale('id');
        $tanggalDiformat = $tanggalSekarang->translatedFormat('d F Y');

        $semua_kategori = Kategori::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->id] = [];
            $kategori_map[$kategori->id] = $kategori->nama;
            $subtotal_map[$kategori->id] = 0;
        }

        $grandtotal = 0;
        foreach ($detail_invoice as $data) {
            $objek = (object) [
                'harga' => $data->harga_barang,
                'idbarang' => $data->jenis_barang_id,
                'jumlah' => $data->qty,
                'kategori' => $data->kategori_barang_id,
                'nama' => $data->nama_barang,
                'subtotal' => $data->subtotal,
            ];

            $subtotal_map[$data->kategori_barang_id] += $data->subtotal;
            array_push($kategori_array[$data->kategori_barang_id], $objek);
            $grandtotal += $data->subtotal;
        }

        // dd($subtotal_map);
        $data = [
            'namaClient' => $detail_invoice[0]->nama_pelanggan,
            'sapaanClient' => $detail_invoice[0]->sapaan,
            'jabatanClient' => $detail_invoice[0]->jabatan_client,
            'lembagaClient' => $detail_invoice[0]->penyelenggara,
            'tanggalNow' => $tanggalDiformat,
            'namaEvent' => $detail_invoice[0]->nama,
            'lamaEvent' => $nilaiPerbedaan,
            'pelaksanaan' => $tanggalMulaiDiformat,
            'kategoriSewa' => $divisi_yang_terlibat,
            'catatanEvent' => $detail_invoice[0]->catatan,
            'noHP_pic' => $detail_invoice[0]->nomer_telepon,
            'nama_pic' => $detail_invoice[0]->picNama,
            'array_kategori' => $kategori_array,
            'kategori_map' => $kategori_map,
            'subtotal_map' => $subtotal_map,
            'grandtotal' => $grandtotal,
        ];

        $pdf = PDF::loadView('common.cetak_invoice', ['data' => $data]);
        return $pdf->download('surat_penawaran.pdf');
        // return view('common.cetak_invoice', compact('data'));
    }

    public function pdfPageTagihan(Request $request)
    {
        $detail_invoice = EventJenis::join('invoices', 'invoices.id', '=', 'detail_invoice.invoices_id')
            ->join('jenis_barang', 'jenis_barang.id', '=', 'detail_invoice.jenis_barang_id')
            ->join('events', 'events.id', '=', 'invoices.events_id')
            ->join('karyawans', 'events.PIC', '=', 'karyawans.id')
            ->join('customers', 'customers.id', '=', 'events.customers_id')
            // ->join('tagihan', function ($join) {
            //     $join->on('tagihan.invoices_id', '=', 'invoices.id')
            //         ->whereRaw('tagihan.tanggal_input = (SELECT MAX(tanggal_input) FROM tagihan WHERE invoices_id = invoices.id)');
            // })
            ->where('detail_invoice.invoices_id', $request['id'])
            ->select(
                'events.*',
                'customers.sapaan',
                'customers.nama_pelanggan',
                'karyawans.nama as picNama',
                'karyawans.nomer_telepon',
                'jenis_barang.kategori_barang_id',
                'jenis_barang.nama as nama_barang',
                'detail_invoice.*',
                'invoices.tanggal_jatuh_tempo',
            )
            ->get();

        // dd($detail_invoice);
            
        $semua_kategori = Kategori::all();
        foreach ($semua_kategori as $kategori) {
            $kategori_array[$kategori->id] = [];
            $kategori_map[$kategori->id] = $kategori->nama;
            $subtotal_map[$kategori->id] = 0;
        }

        $grandtotal = 0;
        foreach ($detail_invoice as $data) {
            $objek = (object) [
                'harga' => $data->harga_barang,
                'idbarang' => $data->jenis_barang_id,
                'jumlah' => $data->qty,
                'kategori' => $data->kategori_barang_id,
                'nama' => $data->nama_barang,
                'subtotal' => $data->subtotal,
            ];

            $subtotal_map[$data->kategori_barang_id] += $data->subtotal;
            array_push($kategori_array[$data->kategori_barang_id], $objek);
            $grandtotal += $data->subtotal;
        }

        // $tanggalMulai = Carbon::parse("2023-12-29 14:13:56");
        // $tanggalSelesai = Carbon::parse("2023-12-30 14:13:56");
        $tanggalMulai = Carbon::parse($detail_invoice[0]->jam_mulai_acara);
        $tanggalSelesai = Carbon::parse($detail_invoice[0]->jam_selesai_acara);
        $tanggalSelesai->locale('id');
        $tanggalMulai->locale('id');
        $bulanMulai = $tanggalMulai->translatedFormat('F');
        $bulanSelesai = $tanggalSelesai->translatedFormat('F');
        $hariMulai = $tanggalMulai->translatedFormat('d');
        $hariSelesai = $tanggalSelesai->translatedFormat('d');
        $tanggalJadi = "";
        // dd($tanggalMulai);
        
        if($hariMulai == $hariSelesai && $bulanMulai == $bulanSelesai){
            $tanggalMulaiFormat = $tanggalMulai->translatedFormat('j');
            $tanggalSelesaiFormat = $tanggalSelesai->translatedFormat('j F Y');
            $tanggalJadi = "$tanggalSelesaiFormat";
        }
        else{
            $tanggalMulaiFormat = $tanggalMulai->translatedFormat('j');
            $tanggalSelesaiFormat = $tanggalSelesai->translatedFormat('j F Y');
            $tanggalJadi = "$tanggalMulaiFormat - $tanggalSelesaiFormat";
        }

        $tanggalJatuhTempo = Carbon::parse($detail_invoice[0]->tanggal_jatuh_tempo);
        $tanggalJatuhTempo->locale('id');
        
        $tanggalJatuhTempo = $tanggalJatuhTempo->translatedFormat('j F Y');
        // dd($tanggalJadi);

        // dd($subtotal_map);
        $data = [
            'namaClient' => $detail_invoice[0]->nama_pelanggan,
            'sapaanClient' => $detail_invoice[0]->sapaan,
            'jabatanClient' => $detail_invoice[0]->jabatan_client,
            'lembagaClient' => $detail_invoice[0]->penyelenggara,
            'idInvoice' => $detail_invoice[0]->invoices_id,
            'namaEvent' => $detail_invoice[0]->nama,
            'lokasi' => $detail_invoice[0]->lokasi,
            'jatuhtempo' => $tanggalJatuhTempo,
            'tanggal_acara' => $tanggalJadi,
            'array_kategori' => $kategori_array,
            'kategori_map' => $kategori_map,
            'subtotal_map' => $subtotal_map,
            'grandtotal' => $grandtotal,
        ];

        $pdf = PDF::loadView('common.cetak_tagihan', ['data' => $data]);
        return $pdf->download('invoice.pdf');
        // return view('common.cetak_tagihan', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'invoice_id' => 'required',
        // ]);
        // <a href="{{ route('editshipping', ['id' => $data->id]) }}"
        // if ($validator->fails()) {
        //     $status = "failed";
        //     $msg = "Kesalahan Sistem! Parameter yang dikirimkan tidak lengkap";
        //     return response()->json([
        //         'status' => $status,
        //         'msg' => $msg,
        //     ], 200);
        // }


        // if(!$detail_invoice){
        //     $status = "failed";
        //     $msg = "Kesalahan Sistem! Data tidak ditemukan";
        //     return response()->json([
        //         'status' => $status,
        //         'msg' => $msg,
        //     ], 200);
        // }

        // $status = "success";
        // $msg = "Berhasil memperbaruhi status";
        // return response()->json(array(
        //     'status' => $status,
        //     'msg' => $msg,
        //     'detail_invoice' => $detail_invoice,
        // ), 200);

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

        foreach ($detail_invoice as $data) {
            $objek = (object) [
                'harga' => $data->harga_barang,
                'idbarang' => $data->jenis_barang_id,
                'jumlah' => $data->qty,
                'kategori' => $data->kategori_barang_id,
                'nama' => $data->nama_barang,
                'subtotal' => $data->subtotal,
            ];
            array_push($kategori_array[$data->kategori_barang_id], $objek);
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
        return view('common.editinvoice', [
            'detail_invoices' => $detail_invoice,
            'array_kategori' => $kategori_array,
            'kategori_map' => $kategori_map,
            'semua_customer' => $semua_customer,
            'array_jenisKegiatan' => $array_jenisKegiatan,
            'invoices_id' => $detail_invoice[0]->invoices_id,
            'events_id' => $detail_invoice[0]->id,
        ]);
    }

    public function showBayar(Request $request)
    {
        $invoice = Invoice::where('invoices.id', $request['id'])
            ->select(
                'invoices.*',
            )
            ->get();

        $semua_tagihan = Tagihan::where('invoices_id', $request['id'])
            ->select(
                'tagihan.*'
            )
            ->get();
        $total_bayar = 0;
        foreach ($semua_tagihan as $tagihan) {
            $total_bayar += $tagihan->nominal;
        }
        $total_kurang = $invoice[0]->total_harga - $total_bayar;

        return view('common.bayar', [
            'invoice_data' => $invoice,
            'sisa' => $total_kurang,
        ]);
    }

    public function bayar(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|int',
            'nominal' => 'required|int',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'lunaskan' => 'string|max:255',
            // "lunaskan" => "Bayar Semua"
        ], [
            'bukti_pembayaran.image' => 'File harus dalam bentuk gambar (jpeg, png, jpg).',
            'bukti_pembayaran.mimes' => 'Format file harus jpeg, png, atau  jpg.',
            'bukti_pembayaran.max' => 'Ukuran file tidak boleh lebih dari 2 MB.',
        ]);

        // dd($request);

        $invoice = Invoice::where('invoices.id', $request['invoice_id'])
            ->select(
                'invoices.*',
            )
            ->get();

        if ($validator->fails()) {
            return redirect()->route('invoice.bayar.index', ['id' => $invoice[0]->id])
                ->withErrors($validator)
                ->withInput();
        }


        // Proses menyimpan file
        if (request()->hasFile('bukti_pembayaran')) {
            $tanggalHariIni = Carbon::now()->format('Y_m_d');
            $file = $request->file('bukti_pembayaran');
            $filename = "invoice" . $invoice[0]->id . "_" . $tanggalHariIni;
            $path = $request->file('bukti_pembayaran')->storeAs('public/bukti_pembayaran', $filename . "." . $file->getClientOriginalExtension());
            $savedPath = str_replace("public", "storage", $path);
        }

        if ($request['lunaskan']) {
            // Buat Tagihan yg datanya lunas
            $tagihanBaru = new Tagihan();
            $tagihanBaru->tanggal_input = now();
            $tagihanBaru->invoices_id = $invoice[0]->id;
            $tagihanBaru->nominal = $request['nominal'];
            $tagihanBaru->status = "Lunas";
            $tagihanBaru->bukti_pembayaran = $savedPath;
            $tagihanBaru->save();
        } else {
            // Buat tagihan yang baru
            $tagihanBaru = new Tagihan();
            $tagihanBaru->tanggal_input = now();
            $tagihanBaru->invoices_id = $invoice[0]->id;
            $tagihanBaru->nominal = $request['nominal'];
            $tagihanBaru->status = "Belum Lunas";
            $tagihanBaru->bukti_pembayaran = $savedPath;
            $tagihanBaru->save();
        }

        return redirect()->route('invoice.bayar.index', ['id' => $invoice[0]->id])
            ->with('success', 'Berhasil Input Data Pembayaran!');
    }

    public function destroy(Invoice $invoice)
    {
        //
    }
}
