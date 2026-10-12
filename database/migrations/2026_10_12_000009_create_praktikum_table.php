<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `praktikum` (taxusakti.sql) — praktikum per kelas.
 * FK `id_kelas` -> kelas.id_kelas ON DELETE CASCADE.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->increments('id_praktikum');
            $table->integer('id_kelas');
            $table->string('nama_praktikum', 200);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');

            $table->index('id_kelas', 'fk_praktikum_kelas');
            $table->foreign('id_kelas', 'fk_praktikum_kelas')
                ->references('id_kelas')->on('kelas')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('praktikum');
    }
};
