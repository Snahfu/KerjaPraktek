<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ItemDamage;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemDamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item_damage = ItemDamage::all();

        return view('item-damage.dataItemDamage', ['datas' => $item_damage]);
    }

    public function indexServicer()
    {
        $user_id = Auth::user()->id;
        $item_damage = ItemDamage::where('user_servicer', '=', $user_id)
        ->whereNull('repair_date')
        ->get();
        $item_repaired = ItemDamage::where('user_servicer', '=', $user_id)
        ->whereNotNull('repair_date')
        ->get();

        return view('item-damage.dataItemDamageServicer', ['datas' => $item_damage, 'datas2' =>$item_repaired]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::where('type', '=', 'serial')
        ->get();
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
                    ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
                    ->where('divisi.nama', '=', 'Teknisi')
                    ->get();

        return view('item-damage.tambahitemdamage', ['barang' => $barang, 'karyawan' => $karyawan]);
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
            'item_barang_id' => 'required',
            'damage_date' => 'required|date',
            'damage_type' => 'required',
            'damage_details' => 'required',
            'user_servicer' => 'required',
        ]);
        
        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }
        $request->merge(['user_reporter' => auth()->user()->id]);
        
        $damage = ItemDamage::create($request->all());
        $dataId = $damage->id;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataId,
        ), 200);
    }

    public function editService(Request $request)
    {
        $damage = ItemDamage::find($request->input('id'));
        // $damage = ItemDamage::find(1);
        $barang = Barang::all();

        return view('item-damage.servisitemdamage', ['itemDamage' => $damage, 'barang' => $barang]);
    }

    public function service(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'repair_status' => 'required',
            'repair_date' => 'required|date',
            'repair_notes' => 'required',
            'estimated_completion' => 'required|date',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $itemDamage = ItemDamage::find($request->input('id'));

        if (!$itemDamage) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $itemDamage->update([
            'repair_status' => $request->input('repair_status'),
            'repair_date' => $request->input('repair_date'),
            'repair_notes' => $request->input('repair_notes'),
            'estimated_completion' => $request->input('estimated_completion'),
        ]);

        $status = "success";
        $msg = "Berhasil mengubah data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemDamage  $itemDamage
     * @return \Illuminate\Http\Response
     */
    public function show(ItemDamage $itemDamage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemDamage  $itemDamage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $damage = ItemDamage::find($request->input('id'));
        // $damage = ItemDamage::find(1);
        $barang = Barang::all();
        $karyawan = Karyawan::select('karyawans.id', 'karyawans.nama')
                    ->join('divisi', 'karyawans.divisi_id', '=', 'divisi.id')
                    ->where('divisi.nama', '=', 'Teknisi')
                    ->get();

        return view('item-damage.edititemdamage', ['itemDamage' => $damage, 'barang' => $barang, 'karyawan' => $karyawan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemDamage  $itemDamage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemDamage $itemDamage)
    {
        $validator = Validator::make($request->all(), [
            'item_barang_id' => 'required',
            'damage_date' => 'required|date',
            'damage_type' => 'required',
            'damage_details' => 'required',
            'user_servicer' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $itemDamage = ItemDamage::find($request->input('id'));

        if (!$itemDamage) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $itemDamage->update([
            'item_barang_id' => $request->input('item_barang_id'),
            'damage_date' => $request->input('damage_date'),
            'damage_type' => $request->input('damage_type'),
            'damage_details' => $request->input('damage_details'),
            'user_servicer' => $request->input('user_servicer'),
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
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $itemDamage = ItemDamage::find($request['id']);
        
        if ($itemDamage) {
            $deleted = $itemDamage->delete();

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
