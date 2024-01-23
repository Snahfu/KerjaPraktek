<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\InvoiceBarang;
use App\Models\JenisBarang;
use App\Models\Karyawan;
use App\Models\Shipping;
use App\Models\ShippingBarang;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping = Shipping::all();

        return view('shipping.dataShipping', ['datas' => $shipping]);
    }

    public function cetakSuratjalan(Request $request)
    {
        $shipping_id = $request->id;
        $shipping = Shipping::with('event', 'event.customer')
            ->where('id', '=', $shipping_id)
            ->first();
        $event_id = $shipping->events_id;
        $shipping_jenis = $shipping->jenis;
        $kloter = DB::table(DB::raw('(SELECT 
      item_shipping.id, item_shipping.events_id, ROW_NUMBER() OVER(ORDER BY item_shipping.id ASC) as kloter
      FROM 
      item_barang_has_item_shipping
      INNER JOIN item_shipping ON item_barang_has_item_shipping.item_shipping_id = item_shipping.id
      WHERE 
      item_shipping.events_id = "' . $event_id . '" AND item_shipping.jenis = "' . $shipping_jenis . '"
      GROUP BY 
      item_barang_has_item_shipping.item_barang_id) as sub'))
            ->select('sub.id', 'sub.events_id', 'sub.kloter')
            ->where('sub.id', $shipping_id) // Specify the desired shipping_id here
            ->first();

        $no_invoice = $shipping->id;
        $lokasi = $shipping->event->lokasi;
        $nama = $shipping->event->customer->nama_pelanggan;
        $namaAcara = $shipping->event->nama;
        $tanggal = $shipping->tglJalan;
        $nohp_pelanggan = $shipping->event->customer->nohp_pelanggan;

        $barang_shipping = ShippingBarang::where('item_shipping_id', '=', $shipping_id)
            ->get();

        $jenis = substr($shipping->jenis, 0, 1);

        $result_no_surat = "SJ-" . $no_invoice . "-" . $jenis . "-" . $kloter->kloter;

        //Create A4 Page with Portrait 
        $pdf = new Fpdf("P", "mm", "A4");
        $pdf->AddPage();
        // HEADER
        //Display Surat Jalan text
        $pdf->SetY(15);
        $pdf->SetX(-40);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(72, 10, "", 0, 0);
        $pdf->Cell(59, 5, "SURAT JALAN", 0, 0);
        $pdf->Cell(59, 10, "", 0, 1);

        //Display Company Info
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(50, 10, "ABC Alat", 0, 1);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(50, 7, "Rental Alat Surabaya", 0, 1);
        $pdf->Cell(50, 7, "Jalan Salem No. 1, Surabaya.", 0, 1);
        $pdf->Cell(50, 7, "Telp : 8778731770", 0, 1);

        //Display Horizontal line
        $pdf->Line(0, 60, 210, 60);


        // BODY
        //Billing Details
        $pdf->SetY(65);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 7, 'No Dokumen: ' . $result_no_surat, 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 7, 'Customer: ' . $nama, 0, 1);
        $pdf->Cell(50, 7, 'Nama Acara: ' . $namaAcara, 0, 1);
        $pdf->Cell(50, 7, 'Alamat Pengiriman: ' . $lokasi, 0, 1);

        // Display Tanggal Pengiriman
        $pdf->SetY(65);
        $pdf->SetX(-100);
        $pdf->Cell(50, 7, 'Tanggal Pengiriman: ' . $tanggal);

        // Dsiplay No Telp Customer
        $pdf->SetY(73);
        $pdf->SetX(-100);
        $pdf->Cell(50, 7, 'No Telp Customer: ' . $nohp_pelanggan);

        // Display Jenis Pengiriman
        $pdf->SetY(81);
        $pdf->SetX(-100);
        $pdf->Cell(50, 7, 'Jenis Pengiriman: ' . $shipping->jenis);

        //Display Table headings
        $pdf->SetY(95);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 9, "No", 1, 0, "C");
        $pdf->Cell(90, 9, "Nama Barang", 1, 0, "C");
        $pdf->Cell(30, 9, "Kuantitas", 1, 0, "C");
        $pdf->Cell(60, 9, "Satuan", 1, 1, "C");
        $pdf->SetFont('Arial', '', 12);

        //Display table barang rows
        $i = 1;
        foreach ($barang_shipping as $barang) {
            $pdf->Cell(10, 9, $i, "LR", 0, "C");
            $pdf->Cell(90, 9, $barang->barang->nama, "R", 0);
            $pdf->Cell(30, 9, $barang->qty, "R", 0, "C");
            $pdf->Cell(60, 9, $barang->barang->satuan, "R", 1, "C");
            $i += 1;
        }
        //Display table empty rows
        for ($i = 0; $i < 12 - count($barang_shipping); $i++) {
            if ($i != 12 - count($barang_shipping) - 1) {
                $pdf->Cell(10, 9, "", "LR", 0);
                $pdf->Cell(90, 9, "", "R", 0, "R");
                $pdf->Cell(30, 9, "", "R", 0, "C");
                $pdf->Cell(60, 9, "", "R", 1, "C");
            } else {
                $pdf->Cell(10, 9, "", "LRB", 0);
                $pdf->Cell(90, 9, "", "RB", 0, "R");
                $pdf->Cell(30, 9, "", "RB", 0, "C");
                $pdf->Cell(60, 9, "", "RB", 1, "C");
            }
        }

        $pdf->SetX(10);
        $pdf->Cell(190, 9, "Notes: " . $shipping->notes, 0, 0);

        // FOOTER
        //set footer position
        $pdf->SetY(-70);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Customer", 0, 1, "R");
        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $nama, 0, 1, "R");
        $pdf->SetFont('Arial', '', 10);

        $pdf->SetY(-70);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Driver", 0, 1, "L");
        $pdf->Ln(15);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $shipping->karyawan->nama, 0, 1, "L");
        $pdf->SetFont('Arial', '', 10);

        //Display Footer Text
        $pdf->Cell(0, 10, "This is a computer generated", 0, 1, "C");

        $pdfFileName = $result_no_surat . ".pdf";

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($pdfFileName) . '"');
        // header('Content-Length: ' . filesize($pdfFileName));
        $pdf->Output($pdfFileName, "D");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRole = Auth::user()->divisi_id;
        if (!$userRole) {
            abort(403);
        }

        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
            ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
            ->where('divisi.nama', '=', 'Driver')
            ->get();
        $event = Event::select('events.id', 'events.nama', 'events.tanggal', 'events.lokasi')
            ->distinct()
            ->join('invoices', 'events.id', '=', 'invoices.events_id')
            ->get();
        $jenis = JenisBarang::all();


        foreach ($jenis as $j) {
            $array_jenis[$j->id] = [];
            $jenis_map[$j->id] = $j->nama;
        }
        return view('shipping.tambahshipping', ['karyawan' => $karyawan, 'event' => $event, 'jenis_map' => $jenis_map, 'array_jenis' => $array_jenis]);
    }

    public function checkDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'driver' => 'required',
            'tglJalan' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        $from = date_create($request['tglJalan']);
        $to = date_create($request['tglJalan']);
        date_sub($from, date_interval_create_from_date_string('2 hours'));
        date_add($to, date_interval_create_from_date_string('2 hours'));
        $shipping = Shipping::where("driver", "=", $request["driver"])
            ->whereBetween('tgljalan', [$from, $to])
            ->get();

        // Jika driver sudah memiliki jadwal pengiriman dalam range 2 jam baik sebelum maupun setelah waktu yang dipilih
        if (count($shipping) != 0) {
            $status = "failed";
            $msg = "Driver sudah memiliki jadwal pengiriman dalam range 2 jam baik sebelum maupun setelah waktu yang dipilih";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    public function getBarangOut(Request $request)
    {
        $date = date("Y-m-d");
        $originalDate = "2023-12-12";
        $date = date("Y-m-d", strtotime($originalDate));
        if (isset($request->date)) {
            $date = $request->date;
            $barang_out = InvoiceBarang::with(['invoice.event', 'barang.jenis'])
                ->whereDate('status_out', $date)
                ->get();

            $status = "success";
            $msg = "Berhasil mengubah tanggal data";
            return response()->json(array(
                'status' => $status,
                'msg' => $msg,
                'datas' => $barang_out,
            ), 200);
        } else {
            $barang_out = InvoiceBarang::whereDate('status_in', $date)
                ->get();

            return view('shipping.databarangkeluar', ['datas' => $barang_out]);
        }
    }

    public function getBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $kirim = [];
        $resultInvoices = DB::table('detail_invoice')
            ->join('invoices', 'invoices.id', '=', 'detail_invoice.invoices_id')
            ->join('jenis_barang', 'jenis_barang.id', '=', 'detail_invoice.jenis_barang_id')
            // ->join('item_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
            ->where('invoices.events_id',  $request['id']) // Specify the desired events_id here
            ->groupBy('detail_invoice.jenis_barang_id', 'jenis_barang.nama')
            ->select(
                'detail_invoice.jenis_barang_id as jenis_barang_invoices',
                DB::raw('SUM(detail_invoice.qty) as total_qty_invoices'),
                'jenis_barang.nama as nama_jenis',
                // 'item_barang.type as type_barang'
            )
            ->get();

          foreach($resultInvoices as $key => $ri) {
            $type_barang = Barang::select("type")
            ->where('jenis_barang_id', '=', $ri->jenis_barang_invoices)
            ->first();
            $resultInvoices[$key]->type_barang = $type_barang->type;
          }
        // $resultInvoices = DB::table('item_barang_has_invoices')
        //         ->join('invoices', 'invoices.id', '=', 'item_barang_has_invoices.invoices_id')
        //         ->join('item_barang', 'item_barang.id', '=', 'item_barang_has_invoices.item_barang_id')
        //         ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
        //         ->select(
        //             'item_barang_has_invoices.item_barang_id as barang_invoices',
        //             DB::raw('SUM(item_barang_has_invoices.qty) as total_qty_invoices'),
        //             'jenis_barang.nama as nama_jenis',
        //             'item_barang.jenis_barang_id as id_jenis'
        //         )
        //         ->where('invoices.events_id',  $request['id']) // Specify the desired events_id here
        //         ->groupBy('item_barang_has_invoices.item_barang_id', 'jenis_barang.nama', 'item_barang.jenis_barang_id')
        //         ->get();

        $resultShipping = DB::table('item_barang_has_item_shipping')
            ->join('item_shipping', 'item_barang_has_item_shipping.item_shipping_id', '=', 'item_shipping.id')
            ->join('item_barang', 'item_barang_has_item_shipping.item_barang_id', '=', 'item_barang.id')
            ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
            ->select(
                'item_barang_has_item_shipping.item_barang_id as barang_shipping',
                DB::raw('SUM(item_barang_has_item_shipping.qty) as total_qty_shipping'),
                'jenis_barang.nama as nama_jenis',
                'item_barang.jenis_barang_id as id_jenis',
            )
            ->where('item_shipping.events_id', $request['id']) // Specify the desired events_id here
            ->where('item_shipping.jenis', $request['jenis'])
            ->groupBy('item_barang_has_item_shipping.item_barang_id', 'jenis_barang.nama', 'item_barang.jenis_barang_id')
            ->get();

        $acara = Event::find($request['id']);
        $tanggal = $acara->tanggal;

        // dd($resultInvoices);

        if ($request['jenis'] == "kirim") {
          $list_barang = [];
          foreach ($resultInvoices as $item_barang_pada_invoices) {
              $item_barang = Barang::where('jenis_barang_id', $item_barang_pada_invoices->jenis_barang_invoices)->get();
              // $array_itemBarang = [];
              $history_shipping = ShippingBarang::where()
                          ->join('item_shipping', 'item_shipping.id', '=', 'item_barang_has_item_shipping.item_shipping_id')
                          ->join('item_barang', 'item_barang.id', '=', 'item_barang_has_item_shipping.item_barang_id')
                          ->where('item_shipping.jenis', '!=', 'Jemput')
                          ->where('item_shipping.tglJalan', '<', $tanggal)
                          ->get();
              foreach ($item_barang as $item) {
                  $pernah_shipping = ShippingBarang::where('item_barang_id', $item->id)->first();

                  // Kalau belum pernah shipping lgsg masukan database
                  if ($pernah_shipping) {
                      // Cek semua item shipping yang pernah dilakukan dan mengandung item_barang ini
                      $history_shipping = ShippingBarang::where('item_barang.id', $item->id)
                          ->join('item_shipping', 'item_shipping.id', '=', 'item_barang_has_item_shipping.item_shipping_id')
                          ->join('item_barang', 'item_barang.id', '=', 'item_barang_has_item_shipping.item_barang_id')
                          ->where('item_shipping.jenis', '!=', 'Jemput')
                          ->where('item_shipping.tglJalan', '<', $tanggal)
                          ->get();
                      // dd($history_shipping);
                      if (!$history_shipping) {
                          array_push($list_barang, $item);

                          // Tambahkan ke array
                      }
                  } else {
                      array_push($list_barang, $item);
                  }
              }
              // dd($item_barang_pada_invoices);
              $kirim[] = [
                  "qty" => $item_barang_pada_invoices->total_qty_invoices,
                  "idjenis" => $item_barang_pada_invoices->jenis_barang_invoices,
                  "jenis" => $item_barang_pada_invoices->nama_jenis,
                  "list_barang" => $list_barang,
                  "type_barang" => $item_barang_pada_invoices->type_barang
              ];
              $list_barang = [];
          }
        }

        else {
          $list_barang = [];
          foreach ($resultInvoices as $item_barang_pada_invoices) {
              $item_barang = Barang::where('jenis_barang_id', $item_barang_pada_invoices->jenis_barang_invoices)->get();
              // $array_itemBarang = [];
              foreach ($item_barang as $item) {
                  $invoice = Invoice::where('events_id',  $request['id'])
                  ->select('id')
                  ->get();
                  $list_id_invoice = $invoice->id;
                  foreach ($list_id_invoice as $key => $id_invoice) {
                    $pernah_shipping = ShippingBarang::where('item_barang_id', $item->id)->first();

                    // Kalau belum pernah shipping lgsg masukan database
                    if ($pernah_shipping) {
                        // Cek semua item shipping yang pernah dilakukan dan mengandung item_barang ini
                        $history_shipping = ShippingBarang::where('item_barang.id', $item->id)
                            ->join('item_shipping', 'item_shipping.id', '=', 'item_barang_has_item_shipping.item_shipping_id')
                            ->join('item_barang', 'item_barang.id', '=', 'item_barang_has_item_shipping.item_barang_id')
                            ->where('item_shipping.jenis', '=', 'Jemput')
                            ->get();
                        if ($history_shipping) {
                            array_push($list_barang, $item);

                            // Tambahkan ke array
                        }
                    }
                  }
                  
              }
              // dd($item_barang_pada_invoices);
              $kirim[] = [
                  "qty" => $item_barang_pada_invoices->total_qty_invoices,
                  "idjenis" => $item_barang_pada_invoices->jenis_barang_invoices,
                  "jenis" => $item_barang_pada_invoices->nama_jenis,
                  "list_barang" => $list_barang,
                  "type_barang" => $item_barang_pada_invoices->type_barang
              ];
              $list_barang = [];
          }
        }
        

        // dd($kirim);
        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'datas' => $kirim,
        ), 200);
    }

    public function getListBarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idJenis' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        $barang = Barang::where('jenis_barang_id', '=', $request['idJenis'])
            ->get();
        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'datas' => $barang,
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
            'events_id' => 'required',
            'jenis' => 'required|string',
            'driver' => 'required',
            'tglJalan' => 'required|date',
            'listbarang' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $request->merge(['tglInput' => Carbon::now()]);

        DB::beginTransaction();

        try {
            $shipping = Shipping::create([
                'events_id' => $request->input('events_id'),
                'jenis' => $request->input('jenis'),
                'driver' => $request->input('driver'),
                'tglInput' => $request->input('tglInput'),
                'tglJalan' => $request->input('tglJalan'),
            ]);
            $dataId = $shipping->id;
            
            foreach ($request['listbarang'] as $barang) {
                    $shippingBarang = new ShippingBarang();
                    $shippingBarang->item_shipping_id = $dataId;
                    $shippingBarang->item_barang_id = $barang['idbarang'];
                    $shippingBarang->qty = $barang['quantity'];
                    $shippingBarang->save();
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
            ), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $userRole = Auth::user()->divisi_id;
        if (!$userRole) {
            abort(403);
        }
        $shipping = Shipping::find($request->input('id'));
        // $shipping = Shipping::find(6);
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
            ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
            ->where('divisi.nama', '=', 'Driver')
            ->get();
        $event = Event::select('events.id', 'events.nama', 'events.lokasi','events.tanggal')
            ->distinct()
            ->join('invoices', 'events.id', '=', 'invoices.events_id')
            ->get();
        $jenis = JenisBarang::all();
        foreach ($jenis as $j) {
            $array_jenis[$j->id] = [];
            $jenis_map[$j->id] = $j->nama;
        }

        // dd($event);
        return view('shipping.editshipping', ['shipping' => $shipping, 'karyawan' => $karyawan, 'event' => $event, 'jenis_map' => $jenis_map, 'array_jenis' => $array_jenis]);
    }

    public function getBarangEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jenis' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $resultShipping = DB::table('item_barang_has_item_shipping')
            ->join('item_shipping', 'item_barang_has_item_shipping.item_shipping_id', '=', 'item_shipping.id')
            ->join('item_barang', 'item_barang_has_item_shipping.item_barang_id', '=', 'item_barang.id')
            ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
            ->select(
                'item_barang_has_item_shipping.item_barang_id as id',
                DB::raw('SUM(item_barang_has_item_shipping.qty) as qty'),
                'jenis_barang.nama as jenis',
                'item_barang.jenis_barang_id as idjenis'
            )
            ->where('item_shipping.events_id', $request['id']) // Specify the desired events_id here
            ->where('item_shipping.jenis', $request['jenis'])
            ->groupBy('item_barang_has_item_shipping.item_barang_id', 'jenis_barang.nama', 'item_barang.jenis_barang_id')
            ->get();

        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'datas' => $resultShipping,
        ), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipping $shipping)
    {
        $validator = Validator::make($request->all(), [
            'events_id' => 'required',
            'id' => 'required',
            'jenis' => 'required|string',
            'driver' => 'required',
            'tglJalan' => 'required|date',
            'listbarang' => 'required'
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
            $shipping = Shipping::find($request->input('id'));
            $jenis = $shipping['jenis'];

            if (!$shipping) {
                $status = "failed";
                $msg = "Data tidak ditemukan";
                return response()->json([
                    'status' => $status,
                    'msg' => $msg,
                ], 200);
            }

            $shipping->update([
                'events_id' => $request->input('events_id'),
                'jenis' => $request->input('jenis'),
                'driver' => $request->input('driver'),
                'tglJalan' => $request->input('tglJalan'),
            ]);

            ShippingBarang::where('item_shipping_id', $request->input('id'))->delete();

            // foreach ($request['listbarang'] as $jenis) {
            //     foreach ($jenis as $barang) {
            //         $shippingBarang = new ShippingBarang();
            //         $shippingBarang->item_shipping_id = $request->input('id');
            //         $shippingBarang->item_barang_id = $barang['idbarang'];
            //         $shippingBarang->qty = $barang['quantity'];
            //         $shippingBarang->save();
            //     }
            // }
            $dataId = $shipping->id;
            foreach ($request['listbarang'] as $barang) {
                    $shippingBarang = new ShippingBarang();
                    $shippingBarang->item_shipping_id = $dataId;
                    $shippingBarang->item_barang_id = $barang['idbarang'];
                    $shippingBarang->qty = $barang['quantity'];
                    $shippingBarang->save();
            }

            DB::commit();
            $status = "success";
            $msg = "Berhasil mengubah data";
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shipping = Shipping::find($request['id']);

        DB::beginTransaction();

        try {
            if ($shipping) {
                $deletedSB = ShippingBarang::where('item_shipping_id', $request->input('id'))->delete();
                $deleted = $shipping->delete();

                if ($deleted && $deletedSB) {
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

            DB::commit();
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
}