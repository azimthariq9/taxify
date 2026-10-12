<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `kelas` (taxusakti.sql).
 *
 * Penyesuaian:
 *  - `created_by` skema asli NOT NULL DEFAULT 0 dengan FK ke users.id,
 *    karena tidak ada user id 0 maka kolom dibuat nullable (NULL diperbolehkan FK-nya).
 *  - `updated_at ... ON UPDATE current_timestamp` diwakilkan trigger
 *    (lihat migration add_updated_at_triggers).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->string('kode_kelas', 50);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->string('nama_kelas', 150);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('created_by')->nullable();

            $table->index('created_by', 'fk_kelas_createdby');
            $table->foreign('created_by', 'fk_kelas_createdby')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
