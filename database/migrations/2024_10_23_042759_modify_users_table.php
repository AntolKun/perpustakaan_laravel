<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama', 'username', 'nisn', 'kelas']); // Hapus kolom yang tidak diperlukan
            $table->enum('role', ['siswa', 'admin', 'juri', 'pustakawan'])->default('siswa'); // Tambah kolom role
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama')->unique();
            $table->string('username')->unique();
            $table->string('nisn')->unique();
            $table->string('kelas');
            $table->dropColumn('role');
        });
    }
}
