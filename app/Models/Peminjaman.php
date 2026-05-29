<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model {
    use HasFactory;

    protected $table = 'peminjamans';
    protected $fillable = ['barang_id', 'nama_peminjam', 'jumlah_pinjam', 'tgl_pinjam', 'status'];

    // Relasi ke Model Barang
    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}