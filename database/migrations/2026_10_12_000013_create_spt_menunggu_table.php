<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_menunggu` (taxusakti.sql).
 * Skema asli tidak punya foreign key.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_menunggu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_konsep');
            $table->string('jenis_pajak')->nullable();
            $table->integer('periode_bulan')->nullable();
            $table->integer('periode_tahun')->nullable();
            $table->string('jenis_spt', 50)->nullable();
            $table->string('model_spt', 50)->nullable();
            $table->string('masa_pajak', 50)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('nama')->nullable();
            $table->decimal('pajak_penghasilan', 15, 2)->default(0);
            $table->dateTime('tanggal_dibuat')->nullable();
            $table->string('status', 50)->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_menunggu');
    }
};
