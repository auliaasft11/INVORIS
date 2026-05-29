<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function store(Request $request)
    {
        // PROTEKSI: Cek apakah yang login adalah admin
        if (Auth::user()->email !== 'admin@gmail.com') {
            return redirect()->back()->with('error', 'Akses Ditolak! Hanya Admin yang boleh menambah barang.');
        }

        $request->validate([
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'kategori'    => 'required',
            'stok'        => 'required|numeric',
            'kondisi'     => 'required',
            'lokasi'      => 'required',
        ]);

        Barang::create($request->all());

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        // PROTEKSI: Cek apakah yang login adalah admin
        if (Auth::user()->email !== 'admin@gmail.com') {
            return redirect()->back()->with('error', 'Akses Ditolak! Hanya Admin yang boleh menghapus barang.');
        }

        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->back()->with('success', 'Barang berhasil dihapus!');
    }
}