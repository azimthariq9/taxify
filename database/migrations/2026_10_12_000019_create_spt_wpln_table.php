<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_wpln` (taxusakti.sql) — bukti potong WPLN / Pasal 26 luar negeri.
 * Skema asli tidak punya created_at/updated_at.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_wpln', function (Blueprint $table) {
            $table->increments('id');
            $table->string('masa_pajak', 20);
            $table->string('nomor_pemotongan', 50);
            $table->string('status', 50);
            $table->string('nitku', 50)->nullable();
            $table->string('jenis_pajak', 50);
            $table->string('kode_pajak', 10);
            $table->string('npwp', 20);
            $table->string('nama', 200);
            $table->text('alamat');
            $table->bigInteger('dasar_pengenaan_pajak')->default(0);
            $table->bigInteger('pajak_penghasilan')->default(0);
            $table->string('fasilitas_pajak', 100)->nullable();
            $table->integer('user_id');
            $table->string('created_by')->nullable();
            $table->string('pemotong_nama')->nullable();
            $table->text('pemotong_alamat')->nullable();
            $table->integer('akun_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_wpln');
    }
};
