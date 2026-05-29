<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::create([
            'nama_barang' => 'HT',
            'stok' => 3,
            'kondisi' => 'Ready',
        ]);

        Barang::create([
            'nama_barang' => 'Printer Epson',
            'stok' => 5,
            'kondisi' => 'Ready',
        ]);
    }
}