<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('otentikasi.register', [
            'title' => 'Register'
        ]);
    }
    public function store(Request $request)
    {
        $valid = $request->validate([
            'username' => 'required|min:7|max:255|unique:users',
            'password' => 'required|min:8|max:255',
            'level' => 'required'
        ]);

        $valid['password'] = Hash::make($valid['password']);

        User::create($valid);

        return redirect('/register')->with('berhasil', 'Berhasil Menambahkan User!');
    }
}
