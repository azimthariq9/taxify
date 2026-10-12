<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_bpspt` (taxusakti.sql) — bukti potong SPT.
 *
 * `updated_at NULL DEFAULT current_timestamp ON UPDATE current_timestamp`
 * diwakilkan trigger (lihat migration add_updated_at_triggers).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_bpspt', function (Blueprint $table) {
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
            $table->string('status_ptkp', 20)->nullable();
            $table->decimal('dasar_pengenaan_pajak', 15, 0)->nullable();
            $table->decimal('pajak_penghasilan', 15, 0)->nullable();
            $table->string('fasilitas_pajak', 100)->nullable();
            $table->string('created_by')->nullable();
            $table->string('pemotong_nama')->nullable();
            $table->text('pemotong_alamat')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id')->nullable();
            $table->string('nama_objek')->nullable();
            $table->string('sifat_penghasilan')->nullable();
            $table->string('kap', 50)->nullable();
            $table->decimal('penghasilan_bruto', 18, 2)->nullable();
            $table->decimal('dpp', 18, 2)->nullable();
            $table->decimal('tarif', 18, 2)->nullable();
            $table->string('jenis_dokumen')->nullable();
            $table->string('nomor_dokumen')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->string('nomor_sub_unit')->nullable();
            $table->string('kode_objek', 100)->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_bpspt');
    }
};
