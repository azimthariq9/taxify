<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_dilaporkan` (taxusakti.sql).
 * Skema asli tidak punya created_at/updated_at.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_dilaporkan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_spt');
            $table->string('masa_pajak', 50)->nullable();
            $table->string('npwp', 25)->nullable();
            $table->string('nama', 100)->nullable();
            $table->decimal('pajak_penghasilan', 15, 2)->default(0);
            $table->dateTime('tanggal_lapor')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id')->nullable();
            $table->decimal('pph21', 20, 2)->default(0);
            $table->decimal('pph26', 20, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_dilaporkan');
    }
};
