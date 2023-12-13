<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index_datapelanggan()
    {
        $all_customer = Customer::all();
        // dd($all_customer);
        return view('admin.datapelanggan', ['all_customer' => $all_customer]);
    }

    function index_tambahpelanggan()
    {
        return view('admin.tambahpelanggan', []);
    }

    public function detail(Request $request)
    {
        $status = "failed";
        $msg = "Gagal Ambil Data, Id tidak ditemukan";
        $data = "";

        if ($request['id']) {
            $status = "success";
            $msg = "Berhasil";
            $data = Customer::find($request['id']);
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
            'nama_pelanggan' => 'required',
            'nohp_pelanggan' => 'required|max:99',
            'alamat_pelanggan' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $pelanggan = Customer::create($request->all());
        $dataId = $pelanggan->id;

        $status = "success";
        $msg = "Berhasil menambahkan data";
        return response()->json(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $dataId,
        ), 200);
    }

    public function edit(Request $request)
    {
        $customer = Customer::find($request->input('id'));
        // $customer = Customer::find(1);

        return view('admin.editpelanggan', ['customer' => $customer]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'nama_pelanggan' => 'required',
            'nohp_pelanggan' => 'required|max:99',
            'alamat_pelanggan' => 'required',
        ]);

        if ($validator->fails()) {
            $status = "failed";
            $msg = $validator->errors()->first();
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $pelanggan = Customer::find($request->input('id'));

        if (!$pelanggan) {
            $status = "failed";
            $msg = "Data tidak ditemukan";
            return response()->json([
                'status' => $status,
                'msg' => $msg,
            ], 200);
        }

        $pelanggan->update([
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'nohp_pelanggan' => $request->input('nohp_pelanggan'),
            'alamat_pelanggan' => $request->input('alamat_pelanggan'),
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
        $pelanggan = Customer::find($request['id']);

        if ($pelanggan) {
            $deleted = $pelanggan->delete();

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
