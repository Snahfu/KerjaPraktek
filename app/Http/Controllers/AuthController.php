<?php

namespace App\Http\Controllers;

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
            // if ($userlevel === 5) {
            //     return redirect('/dashboard-admin');
            // } elseif ($userlevel !== 5) {
            //     return redirect('/dashboard');
            // }
            return redirect('/dashboard-admin');
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
        ]);
    
        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $karyawan = \App\Models\Karyawan::create([
            'userlevel' => 'sales',
            'divisi_id' => 4,
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'nomer_telepon' => $request->input('nomortelepon'),
            'password' =>  Hash::make($request->input('password')),
        ]);

        Auth::login($karyawan);

        return redirect('/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
