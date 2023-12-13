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
        $event = Event::all();
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
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = "Terdapat kesalahan pada sistem";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $barang = Barang::where('jenis_barang_id', $request['id'])->get();

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
                    // Update item_barang
                    $item_barang = Barang::find($barang['idbarang']);

                    if ($request->input('jenis') == "Jemput") {
                        $item_barang->update([
                            'qty' => $item_barang['qty'] + $barang['quantity'],
                        ]);
                    } else {
                        if($item_barang['qty'] < $barang['quantity']) {
                            DB::rollback();
            
                            $status = "failed";
                            return response()->json(array(
                                'status' => $status,
                                'msg' => 'Stok barang dengan ID '. $item_barang['id']. ' tidak mencukupi!',
                            ), 200);
                        }
                        $item_barang->update([
                            'qty' => $item_barang['qty'] - $barang['quantity'],
                        ]);
                    }
                    // end Update item_barang

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
        $shippingBarang = ShippingBarang::with('barang')->where('item_shipping_id', '=', $request->input('id'))->get();
        // $shipping = Shipping::find(1);
        // $shippingBarang = ShippingBarang::with('barang')->where('item_shipping_id', '=', 1)->get();
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
                    ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
                    ->where('divisi.nama', '=', 'Driver')
                    ->get();
        $event = Event::all();
        $jenis = JenisBarang::all();
        foreach ($jenis as $j) {
            $array_jenis[$j->id] = [];
            $jenis_map[$j->id] = $j->nama;
        }
        return view('shipping.editshipping', ['shipping' => $shipping, 'shippingBarang' => $shippingBarang, 'karyawan' => $karyawan, 'event' => $event, 'jenis_map' => $jenis_map, 'array_jenis' => $array_jenis]);
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

            $shippingBarang = ShippingBarang::where('item_shipping_id', $request->input('id'))->get();
            // Update item_barang
            foreach ($shippingBarang as $sb) {
                $item_barang = Barang::find($sb['item_barang_id']);
                if ($jenis == "Jemput") {
                    if($item_barang['qty'] < $sb['qty']) {
                        DB::rollback();
            
                        $status = "failed";
                        return response()->json(array(
                            'status' => $status,
                            'msg' => 'Stok barang dengan ID '. $item_barang['id']. ' tidak mencukupi!',
                        ), 200);
                    }
                    $item_barang->update([
                        'qty' => $item_barang['qty'] - $sb['qty'],
                    ]);
                } else {
                    $item_barang->update([
                        'qty' => $item_barang['qty'] + $sb['qty'],
                    ]);
                }
            }
            // end Update item_barang
            ShippingBarang::where('item_shipping_id', $request->input('id'))->delete();

            foreach ($request['listbarang'] as $jenis) {
                foreach($jenis as $barang){
                    // Update item_barang
                    $item_barang = Barang::find($barang['idbarang']);

                    if ($request->input('jenis') == "Jemput") {
                        $item_barang->update([
                            'qty' => $item_barang['qty'] + $barang['quantity'],
                        ]);
                    } else {
                        if($item_barang['qty'] < $barang['quantity']) {
                            DB::rollback();
            
                            $status = "failed";
                            return response()->json(array(
                                'status' => $status,
                                'msg' => 'Stok barang dengan ID '. $item_barang['id']. ' tidak mencukupi!',
                            ), 200);
                        }

                        $item_barang->update([
                            'qty' => $item_barang['qty'] - $barang['quantity'],
                        ]);
                    }
                    // end Update item_barang
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
                $shippingBarang = ShippingBarang::where('item_shipping_id', $request->input('id'))->get();
                // Update item_barang
                foreach ($shippingBarang as $sb) {
                    $item_barang = Barang::find($sb['item_barang_id']);
                    if ($shipping['jenis'] == "Jemput") {
                        if($item_barang['qty'] < $sb['quantity']) {
                            DB::rollback();
            
                            $status = "failed";
                            return response()->json(array(
                                'status' => $status,
                                'msg' => 'Stok barang dengan ID '. $item_barang['id']. ' tidak mencukupi!',
                            ), 200);
                        }

                        $item_barang->update([
                            'qty' => $item_barang['qty'] - $sb['qty'],
                        ]);
                    } else {
                        $item_barang->update([
                            'qty' => $item_barang['qty'] + $sb['qty'],
                        ]);
                    }
                }
                // end Update item_barang
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
