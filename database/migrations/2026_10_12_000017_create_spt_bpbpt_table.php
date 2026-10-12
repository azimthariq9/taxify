<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_bpbpt` (taxusakti.sql) — bukti potong BP/BPT.
 * Skema asli tidak punya updated_at.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_bpbpt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masa_pajak', 20)->nullable();
            $table->string('periode_bulan', 20)->nullable();
            $table->string('periode_tahun', 4)->nullable();
            $table->string('nomor_pemotongan', 50)->nullable();
            $table->string('status', 20)->default('Normal');
            $table->string('nitku', 100)->nullable();
            $table->string('jenis_pajak', 100)->nullable();
            $table->string('kode_pajak', 50)->nullable();
            $table->string('npwp', 30)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->decimal('dasar_pengenaan_pajak', 15, 0)->nullable();
            $table->decimal('pajak_penghasilan', 15, 0)->nullable();
            $table->string('fasilitas_pajak', 100)->nullable();
            $table->string('created_by')->nullable();
            $table->string('pemotong_nama')->nullable();
            $table->text('pemotong_alamat')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_bpbpt');
    }
};
