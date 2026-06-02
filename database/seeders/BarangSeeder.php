<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::create([
            'kode_barang' => 'BRG-001',
            'nama_barang' => 'HT',
            'kategori' => 'Elektronik',
            'stok' => 3,
            'kondisi' => 'Ready',
        ]);

        Barang::create([
            'kode_barang' => 'BRG-002',
            'nama_barang' => 'Printer Epson',
            'kategori' => 'Elektronik',
            'stok' => 5,
            'kondisi' => 'Ready',
        ]);
    }
}