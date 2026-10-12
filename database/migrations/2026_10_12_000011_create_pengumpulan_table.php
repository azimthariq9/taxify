<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `pengumpulan` (taxusakti.sql).
 * Nama index `user_id` di skema asli bentrok dengan tabel lain di PostgreSQL,
 * menjadi idx_pengumpulan_user_id.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumpulan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('praktikum_id');
            $table->integer('user_id');
            $table->string('file_jawaban')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
            $table->enum('status', ['menunggu', 'dinilai'])->default('menunggu');
            $table->decimal('nilai', 5, 2)->nullable();
            $table->text('feedback')->nullable();

            $table->unique(['praktikum_id', 'user_id'], 'uq_pengumpulan');
            $table->index('user_id', 'idx_pengumpulan_user_id');

            $table->foreign('praktikum_id', 'pengumpulan_ibfk_1')
                ->references('id')->on('kelas_praktikum')->cascadeOnDelete();
            $table->foreign('user_id', 'pengumpulan_ibfk_2')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumpulan');
    }
};
