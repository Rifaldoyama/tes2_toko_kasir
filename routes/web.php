<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest routes
Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::put('/profile/update', [DashboardController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::get('/riwayat/print/{id}', [RiwayatController::class, 'print'])->name('riwayat.print');
    Route::get('/riwayat/laporan/print', [RiwayatController::class, 'printLaporan'])->name('riwayat.printLaporan');


    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/harian', [LaporanController::class, 'printLaporanHarian'])->name('laporan.harian');
    Route::get('/laporan/bulanan', [LaporanController::class, 'printLaporanBulanan'])->name('laporan.bulanan');
    Route::post('/laporan/custom', [LaporanController::class, 'printLaporanCustom'])->name('laporan.custom');
    
    // Barang routes - using resource
    Route::resource('barang', BarangController::class)->except(['create']);
    
    // If you need a custom create route
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/penjualan/barang', [PenjualanController::class, 'getBarang']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
});