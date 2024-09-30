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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id');
            $table->date('tanggal_dikembalikan')->nullable(); // Tanggal pengembalian dilakukan
            $table->integer('denda')->default(0); // Denda jika ada keterlambatan
            $table->string('status')->default('belum'); // Status pengembalian
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('peminjaman_id')->references('id')->on('peminjamans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
