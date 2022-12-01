<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('otentikasi.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $valid = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($valid)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('gagal', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
