<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `kelas_user` (taxusakti.sql).
 *
 * Nama index disesuaikan karena di PostgreSQL nama index berlaku global
 * (unik satu schema), bukan per tabel seperti MySQL:
 *  - UNIQUE KEY user_id  -> uq_kelas_user_user_kelas
 *  - KEY idx_user_id     -> idx_kelas_user_user_id
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('kelas_id');
            $table->timestamp('joined_at')->useCurrent();

            $table->unique(['user_id', 'kelas_id'], 'uq_kelas_user_user_kelas');
            $table->index('user_id', 'idx_kelas_user_user_id');
            $table->index('kelas_id', 'fk_kelasuser_kelas');

            $table->foreign('kelas_id', 'fk_kelasuser_kelas')
                ->references('id_kelas')->on('kelas')->cascadeOnDelete();
            $table->foreign('user_id', 'kelas_user_ibfk_1')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_user');
    }
};
