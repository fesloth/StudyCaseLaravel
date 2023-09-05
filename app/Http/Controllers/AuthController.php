<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            return redirect('/');
        } else {
            return back()->withErrors(['message' => 'Kredensial tidak valid.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function showRegistrationForm()
    {
        return view('registration.index');
    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'username' => 'required|unique:users|max:255',
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validatedData) {

            $user = new User;
            $user->username = $validatedData['username'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return redirect('/');
        } else {
            return back()->withErrors(['message' => 'Konfirmasi password tidak sesuai'])->withInput();
        }
    }
}
