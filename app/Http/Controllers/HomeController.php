<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Peminjaman;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // =========================
        // ADMIN
        // =========================
        if (Auth::user()->role == 'admin') {

            // TOTAL BARANG
            $totalBarang = Barang::count();

            // TOTAL STOK
            $totalStok = Barang::sum('stok');

            // TOTAL PEMINJAMAN AKTIF
            $barangPinjam = Peminjaman::where('status', 'Dipinjam')->count();

            // SEMUA AKTIVITAS
            $recentActivities = Peminjaman::with('barang')
                ->latest()
                ->take(5)
                ->get();

        }

        // =========================
        // USER
        // =========================
        else {

            // TOTAL BARANG
            $totalBarang = Barang::count();

            // TOTAL STOK
            $totalStok = Barang::sum('stok');

            // PEMINJAMAN USER SENDIRI
            $barangPinjam = Peminjaman::where(
                    'nama_peminjam',
                    Auth::user()->name
                )
                ->where('status', 'Dipinjam')
                ->count();

            // HANYA AKTIVITAS USER LOGIN
            $recentActivities = Peminjaman::with('barang')
                ->where('nama_peminjam', Auth::user()->name)
                ->latest()
                ->take(5)
                ->get();

        }

        return view('home', compact(
            'totalBarang',
            'totalStok',
            'barangPinjam',
            'recentActivities'
        ));
    }
}