<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $userlevel = Auth::user()->divisi_id;
            if ($userlevel == 2) {
                return redirect('/dashboard-gudang');
            } else if ($userlevel == 4) {
                return redirect('/dashboard-sales');
            } else if ($userlevel == 5) {
                return redirect('/dashboard-admin');
            } else {
                return redirect('/dashboard-gudang');
            }
        }

        return redirect()->route('loginPage')->with('error', 'Login gagal. Periksa kembali email dan password.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:karyawans',
            'nomortelepon' => 'required|string|max:255',
            'email' => 'required|string|email|unique:karyawans',
            'password' => 'required|string|min:6',
            'divisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $karyawan = new Karyawan;
        $karyawan->username = $request->input('username');
        $karyawan->email = $request->input('email');
        $karyawan->nama = $request->input('nama');
        $karyawan->nomer_telepon = $request->input('nomortelepon');
        $karyawan->divisi_id = $request->input('divisi');
        $karyawan->password = Hash::make($request->input('password'));
        $karyawan->save();

        Auth::login($karyawan);
        $userlevel = $karyawan->divisi_id;
        if ($userlevel == 2) {
            return redirect('/data-gudang');
        } else if ($userlevel == 4) {
            return redirect('/dashbord-sales');
        } else if ($userlevel == 5) {
            return redirect('/dashboard-admin');
        } else {
            return redirect('/dashbord-sales');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
