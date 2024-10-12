<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentScoresTable extends Migration
{
    public function up()
    {
        Schema::create('nilai_siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pendaftaran_id');
            $table->unsignedBigInteger('kategori_lomba_id');
            $table->integer('field_1')->unsigned();
            $table->integer('field_2')->unsigned();
            $table->integer('field_3')->unsigned();
            $table->integer('field_4')->unsigned();
            $table->integer('total_nilai')->unsigned();
            $table->timestamps();

            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran_lombas')->onDelete('cascade');
            $table->foreign('kategori_lomba_id')->references('id')->on('kategori_lombas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_siswas');
    }
}

