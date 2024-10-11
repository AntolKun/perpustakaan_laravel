<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_lombas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lomba_id'); // Tambahkan kolom lomba_id
            $table->unsignedBigInteger('kategori_lomba_id');
            $table->string('nama');
            $table->string('kelas');
            $table->string('nomor_telepon');
            $table->string('bukti_pembayaran');
            $table->timestamps();

            $table->foreign('lomba_id')->references('id')->on('lombas')->onDelete('cascade');
            $table->foreign('kategori_lomba_id')->references('id')->on('kategori_lombas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_lombas');
    }
}
