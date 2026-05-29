<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

// Langsung ke Login saat pertama buka
Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Semua halaman di bawah ini wajib Login
Route::middleware(['auth'])->group(function () {

    Route::get('/home',
        [HomeController::class, 'index'])
        ->name('home');

    // Rute Data Barang
    Route::get('/barang',
        [BarangController::class, 'index'])
        ->name('barang.index');

    Route::post('/barang',
        [BarangController::class, 'store'])
        ->name('barang.store');

    Route::delete('/barang/{id}',
        [BarangController::class, 'destroy'])
        ->name('barang.destroy');

    // Rute Peminjaman
    Route::get('/peminjaman',
        [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');

    Route::post('/peminjaman',
        [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');

    // SELESAIKAN PEMINJAMAN
    Route::put('/peminjaman/{id}/selesai',
        [PeminjamanController::class, 'selesai'])
        ->name('peminjaman.selesai');

});