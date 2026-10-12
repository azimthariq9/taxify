<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_a1` (taxusakti.sql) — bukti potong A1.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_a1', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['Belum Terbit', 'Terbit', 'Tidak Valid'])
                ->default('Belum Terbit');
            $table->string('masa_pajak', 20)->nullable();
            $table->string('periode_bulan_awal', 20)->nullable();
            $table->string('periode_tahun_awal', 10)->nullable();
            $table->string('periode_bulan_akhir', 20)->nullable();
            $table->string('periode_tahun_akhir', 10)->nullable();
            $table->string('nomor_bukti_potong', 100)->nullable();
            $table->date('tanggal_bukti_potong')->nullable();
            $table->string('kode_objek_pajak', 30)->nullable();
            $table->string('fasilitas_pajak', 100)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('nama', 200)->nullable();
            $table->text('alamat')->nullable();
            $table->bigInteger('penghasilan_bruto')->default(0);
            $table->bigInteger('pajak_penghasilan')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_a1');
    }
};
