<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `kelas_praktikum_files` (taxusakti.sql).
 * Skema asli: hanya primary key, tanpa foreign key.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_praktikum_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_praktikum');
            $table->string('nama_file')->nullable();
            $table->string('path_file')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
            $table->integer('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_praktikum_files');
    }
};
