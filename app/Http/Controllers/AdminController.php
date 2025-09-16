<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Dashboard admin
    public function dashboard()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('admin.dashboard', compact('mahasiswa'));
    }

    // Form tambah mahasiswa
    public function createMahasiswa()
    {
        return view('admin.create_mahasiswa');
    }

    // Simpan mahasiswa baru
    public function storeMahasiswa(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }
}
