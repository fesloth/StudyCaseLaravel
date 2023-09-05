<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SessionController extends Controller
{
    public function login()
    {
        return view('sesi/login');
    }

    public function loginProses(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($data)) {
            return redirect('dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Username atau Password salah');
        }
    }

    public function register()
    {
        return view('sesi/register');
    }

    public function registerProses(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|unique:user|max:200',
            'email' => 'required|max:200',
            'password' => 'required',
            'confirm' => 'required|same:password'
        ]);

        if ($validateData) {
            $user = new User;
            $user->username = $validateData['username'];
            $user->email = $validateData['email'];
            $user->password = Hash::make($validateData['password']);
            $user->save();

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login kembali.');
        } else {
            return redirect()->route('register')->with('failed', 'Konfirmasi Password tidak sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}
