<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Event;
use App\Models\JenisBarang;
use App\Models\Karyawan;
use App\Models\Shipping;
use App\Models\ShippingBarang;
use Carbon\Carbon;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRole = Auth::user()->divisi_id;
        if(!$userRole){
            abort(403);
        }   

        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
                    ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
                    ->where('divisi.nama', '=', 'Driver')
                    ->get();
        $event = Event::select('events.id', 'events.nama')
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

    public function barangOut(Request $request)
    {
        $date = $request->date;

        ShippingBarang::where('datr');
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
        $resultInvoices = DB::table('item_barang_has_invoices')
                ->join('invoices', 'invoices.id', '=', 'item_barang_has_invoices.invoices_id')
                ->join('item_barang', 'item_barang.id', '=', 'item_barang_has_invoices.item_barang_id')
                ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
                ->select(
                    'item_barang_has_invoices.item_barang_id as barang_invoices',
                    DB::raw('SUM(item_barang_has_invoices.qty) as total_qty_invoices'),
                    'jenis_barang.nama as nama_jenis',
                    'item_barang.jenis_barang_id as id_jenis'
                )
                ->where('invoices.events_id',  $request['id']) // Specify the desired events_id here
                ->groupBy('item_barang_has_invoices.item_barang_id', 'jenis_barang.nama', 'item_barang.jenis_barang_id')
                ->get();

        $resultShipping = DB::table('item_barang_has_item_shipping')
                ->join('item_shipping', 'item_barang_has_item_shipping.item_shipping_id', '=', 'item_shipping.id')
                ->join('item_barang', 'item_barang_has_item_shipping.item_barang_id', '=', 'item_barang.id')
                ->join('jenis_barang', 'item_barang.jenis_barang_id', '=', 'jenis_barang.id')
                ->select(
                    'item_barang_has_item_shipping.item_barang_id as barang_shipping',
                    DB::raw('SUM(item_barang_has_item_shipping.qty) as total_qty_shipping'),
                    'jenis_barang.nama as nama_jenis',
                    'item_barang.jenis_barang_id as id_jenis'
                )
                ->where('item_shipping.events_id', $request['id']) // Specify the desired events_id here
                ->where('item_shipping.jenis', $request['jenis'])
                ->groupBy('item_barang_has_item_shipping.item_barang_id', 'jenis_barang.nama', 'item_barang.jenis_barang_id')
                ->get();

        foreach($resultInvoices as $ri){
            $found = false;
            foreach($resultShipping as $rs){
                if($ri->barang_invoices == $rs->barang_shipping) {
                    $found = true;
                    $diff = $ri->total_qty_invoices - $rs->total_qty_shipping;
                    if($diff != 0) {
                        $kirim[] = ["qty"=> $diff, "id" => $ri->barang_invoices, "idjenis" => $ri->id_jenis, "jenis" => $ri->nama_jenis];
                    }
                }
            }
            if(!$found) {
                $kirim[] = ["qty"=> $ri->total_qty_invoices, "id" => $ri->barang_invoices, "idjenis" => $ri->id_jenis, "jenis" => $ri->nama_jenis];
            }
        }

        $status = "success";
        $msg = "Data berhasil diambil";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'datas' => $kirim,
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

            foreach ($request['listbarang'] as $jenis) {
                foreach($jenis as $barang){
                    $shippingBarang = new ShippingBarang();
                    $shippingBarang->item_shipping_id = $dataId;
                    $shippingBarang->item_barang_id = $barang['idbarang'];
                    $shippingBarang->qty = $barang['quantity'];
                    $shippingBarang->save();
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
        $shipping = Shipping::find($request->input('id'));
        // $shipping = Shipping::find(6);
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
                    ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
                    ->where('divisi.nama', '=', 'Driver')
                    ->get();
        $event = Event::select('events.id', 'events.nama')
            ->distinct()
            ->join('invoices', 'events.id', '=', 'invoices.events_id')
            ->get();
        $jenis = JenisBarang::all();
        foreach ($jenis as $j) {
            $array_jenis[$j->id] = [];
            $jenis_map[$j->id] = $j->nama;
        }
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

            foreach ($request['listbarang'] as $jenis) {
                foreach($jenis as $barang){
                    $shippingBarang = new ShippingBarang();
                    $shippingBarang->item_shipping_id = $request->input('id');
                    $shippingBarang->item_barang_id = $barang['idbarang'];
                    $shippingBarang->qty = $barang['quantity'];
                    $shippingBarang->save();
                }
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
