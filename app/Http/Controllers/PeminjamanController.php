<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        // =========================
        // ADMIN
        // =========================
        if (Auth::user()->role == 'admin') {

            // HANYA TAMPILKAN
            // YANG MASIH DIPINJAM
            $peminjamans = Peminjaman::with('barang')
                ->where('status', 'Dipinjam')
                ->latest()
                ->get();

        }

        // =========================
        // USER
        // =========================
        else {

            // USER MELIHAT
            // SEMUA RIWAYATNYA
            $peminjamans = Peminjaman::with('barang')
                ->where('nama_peminjam', Auth::user()->name)
                ->latest()
                ->get();

        }

        // DATA BARANG
        $barangs = Barang::where('stok', '>', 0)->get();

        return view('peminjaman.index', compact('peminjamans', 'barangs'));
    }

    // =========================
    // SIMPAN PEMINJAMAN
    // =========================
    public function store(Request $request)
    {
        // CEGAH ADMIN MEMINJAM
        if (Auth::user()->role == 'admin') {

            return redirect()->back()->with(
                'error',
                'Admin tidak diperbolehkan melakukan peminjaman.'
            );

        }

        // VALIDASI
        $request->validate([

            'barang_id' => 'required',

            'nama_peminjam' => 'required',

            'jumlah_pinjam' => 'required|numeric|min:1',

            'tgl_pinjam' => 'required|date',

            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',

        ]);

        // AMBIL DATA BARANG
        $barang = Barang::findOrFail($request->barang_id);

        // CEK STOK
        if ($barang->stok < $request->jumlah_pinjam) {

            return redirect()->back()->with(
                'error',
                'Stok barang tidak mencukupi.'
            );

        }

        // =========================
        // SIMPAN PEMINJAMAN
        // =========================
        Peminjaman::create([

            'barang_id' => $request->barang_id,

            'nama_peminjam' => $request->nama_peminjam,

            'jumlah_pinjam' => $request->jumlah_pinjam,

            'tgl_pinjam' => $request->tgl_pinjam,

            'tgl_kembali' => $request->tgl_kembali,

            'status' => 'Dipinjam'

        ]);

        // =========================
        // KURANGI STOK
        // =========================
        $barang->decrement(
            'stok',
            $request->jumlah_pinjam
        );

        // JIKA STOK HABIS
        if ($barang->stok <= 0) {

            $barang->update([
                'status' => 'Dipinjam'
            ]);

        }

        return redirect()->back()->with(
            'success',
            'Barang berhasil dipinjam.'
        );
    }

    // =========================
    // SELESAIKAN PEMINJAMAN
    // =========================
    public function selesai(int $id)
    {
        // HANYA ADMIN
        if (Auth::user()->role != 'admin') {

            return redirect()->back()->with(
                'error',
                'Akses ditolak.'
            );

        }

        // CARI DATA PEMINJAMAN
        $peminjaman = Peminjaman::findOrFail($id);

        // JIKA SUDAH SELESAI
        if ($peminjaman->status == 'Selesai') {

            return redirect()->back()->with(
                'error',
                'Peminjaman sudah selesai.'
            );

        }

        // =========================
        // AMBIL DATA BARANG
        // =========================
        $barang = Barang::find($peminjaman->barang_id);

        if ($barang) {

            // KEMBALIKAN STOK
            $barang->increment(
                'stok',
                $peminjaman->jumlah_pinjam
            );

            // STATUS BARANG READY LAGI
            $barang->update([
                'status' => 'Ready'
            ]);

        }

        // =========================
        // UPDATE STATUS PEMINJAMAN
        // =========================
        $peminjaman->update([
            'status' => 'Selesai'
        ]);

        return redirect()->back()->with(
            'success',
            'Barang berhasil dikembalikan.'
        );
    }
}