<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function validasiInput(Request $request)
    {
        $message = "";
        $status = "success";
        if($request['tipe'] == "event")
        {
            $request->validate([
                'nama' => 'required|string',
                'kegiatan' => 'required|string',
                'budget' => 'required|',
            ]);
        }
        else if ($request['tipe'] == "invoice")
        {
            $request->validate([
                'nama' => 'required|string',
                'kegiatan' => 'required|string',
                'budget' => 'required|string',
            ]);
        }
        else if ($request['tipe'] == "customers")
        {

        }
        else {
            $status = "error";
            return response()->json(array(
                'status' => $status,
                'message' => $message,
            ), 200);
        }

        return response()->json(array(
            'status' => $status,
            'message' => $message,
        ), 200);
    }
}
