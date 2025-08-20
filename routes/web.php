<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;

// Homepage (daftar rapat untuk peserta)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login / Logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes yang hanya bisa diakses admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('ruang', RuangController::class);
    Route::resource('rapat', RapatController::class);

    // Admin lihat daftar absensi
    Route::get('/absensi/{rapat}', [AbsensiController::class, 'index'])->name('absensi.index');
});

// Form absensi peserta (public, tidak perlu login)
Route::get('/absensi/create/{rapat}', [AbsensiController::class, 'create'])->name('absensi.create');
Route::post('/absensi/store/{rapat}', [AbsensiController::class, 'store'])->name('absensi.store');
