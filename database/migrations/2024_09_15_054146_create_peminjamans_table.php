<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->unsignedBigInteger('user_id');
            // Informasi tambahan dari form
            $table->string('email');
            $table->string('jurusan');
            $table->string('nisn');
            $table->string('username');
            $table->string('nama');
            $table->string('kelas');
            $table->string('status')->default('menunggu persetujuan'); // Status peminjaman
            $table->date('tanggal_pinjam')->nullable(); // Tanggal peminjaman
            $table->date('tanggal_pengembalian')->nullable(); // Tanggal pengembalian
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
