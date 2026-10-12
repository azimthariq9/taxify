<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_konsep` (taxusakti.sql).
 *
 * Penyesuaian MySQL -> PostgreSQL:
 *  - longtext CHECK (json_valid(...)) -> jsonb (pgsql menolak teks bukan JSON).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_konsep', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_pajak', 100);
            $table->string('periode_bulan', 20);
            $table->string('periode_tahun', 10);
            $table->string('jenis_spt', 100);
            $table->jsonb('sumber_data_json')->nullable();
            $table->integer('sumber_id')->nullable();
            $table->string('model_spt', 50)->default('Normal');
            $table->string('nop', 50)->nullable();
            $table->string('nama_objek', 50)->nullable();
            $table->string('status', 50)->default('Konsep');
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->string('masa_pajak', 30)->nullable();
            $table->string('created_by')->nullable();
            $table->text('pemotong_alamat')->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('nama')->nullable();
            $table->integer('user_id');
            $table->dateTime('posted_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('akun_id')->nullable();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_konsep');
    }
};
