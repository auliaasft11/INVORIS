<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel barangs
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->integer('jumlah_pinjam'); 
            $table->date('tgl_pinjam');
            $table->string('status')->default('Dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('peminjamans');
    }
};