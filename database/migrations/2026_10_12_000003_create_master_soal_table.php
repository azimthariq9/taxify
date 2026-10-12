<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `master_soal` (taxusakti.sql).
 * datetime DEFAULT current_timestamp -> useCurrent().
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_soal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_soal');
            $table->text('deskripsi')->nullable();
            $table->integer('created_by');
            $table->dateTime('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_soal');
    }
};
