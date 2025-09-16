<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // simpan data user ke session
            $request->session()->put('user', $user);

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/mahasiswa/dashboard');
            }
        }

        return back()->withErrors(['login' => 'Username atau Password salah!']);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }
}
