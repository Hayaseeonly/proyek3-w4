<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======================
// AUTH
// ======================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================
// DASHBOARD (protected by auth)
// ======================
Route::middleware(['auth'])->group(function () {

    // ---------- ADMIN ----------
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/admin/mahasiswa/create', [AdminController::class, 'createMahasiswa'])->name('admin.mahasiswa.create');
        Route::post('/admin/mahasiswa/store', [AdminController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
    });

    // ---------- MAHASISWA ----------
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    });
});
