<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `kode_billing` (taxusakti.sql).
 * Primary key memakai nama asli `id_billing`.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_billing', function (Blueprint $table) {
            $table->increments('id_billing');
            $table->integer('id_spt');
            $table->string('jenis_spt', 50)->nullable();
            $table->string('kode', 50);
            $table->string('masa_pajak', 20)->nullable();
            $table->integer('tahun_pajak')->nullable();
            $table->string('jenis_setoran', 20)->nullable();
            $table->decimal('jumlah', 15, 2)->default(0);
            $table->dateTime('tanggal_buat')->useCurrent();
            $table->enum('status', ['AKTIF', 'KEDALUWARSA'])->default('AKTIF');
            $table->integer('user_id')->nullable();

            $table->index('id_spt');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_billing');
    }
};
