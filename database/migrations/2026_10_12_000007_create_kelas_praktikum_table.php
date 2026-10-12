<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `kelas_praktikum` (taxusakti.sql).
 * Skema asli tidak punya created_at/updated_at.
 * `created_by` (default 0 + FK users) dibuat nullable agar aman.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_praktikum', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kelas_id');
            $table->string('nama_praktikum', 100);
            $table->string('deskripsi_file')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('created_by')->nullable();

            $table->index('kelas_id', 'id_kelas');
            $table->index('created_by', 'fk_praktikum_createdby');
            $table->foreign('created_by', 'fk_praktikum_createdby')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_praktikum');
    }
};
