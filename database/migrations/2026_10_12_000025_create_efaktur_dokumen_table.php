<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `efaktur_dokumen` (taxusakti.sql).
 *
 * Komentar kolom di skema MySQL tidak dibawa (PostgreSQL memakai
 * COMMENT ON terpisah); deskripsinya ada di docblock:
 *  - akun_id       : FK -> master_pemotong.id (akun aktif pemilik dokumen)
 *  - npwp_lawan    : NPWP Pembeli (keluaran) / NPWP Penjual (masukan)
 *  - nomor_dokumen : Nomor Faktur Pajak / Nomor Dokumen
 *  - masa_pajak    : 1-12, tahun_pajak : 4 digit
 *  - is_kredit     : khusus arah=masukan, 1=dikreditkan, 0=tidak, NULL=belum ditentukan
 *  - file_path     : path upload (csv/pdf), relatif thd e-faktur/uploads/
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('efaktur_dokumen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('akun_id');
            $table->enum('arah', ['keluaran', 'masukan']);
            $table->enum('kategori', ['faktur', 'dokumen_lain'])->default('faktur');
            $table->string('npwp_lawan', 32)->nullable();
            $table->string('nama_lawan')->nullable();
            $table->string('kode_transaksi', 10)->nullable();
            $table->string('nomor_dokumen', 50)->nullable();
            $table->date('tanggal_dokumen')->nullable();
            $table->smallInteger('masa_pajak')->nullable();
            $table->smallInteger('tahun_pajak')->nullable();
            $table->decimal('dpp', 18, 2)->default(0);
            $table->decimal('ppn', 18, 2)->default(0);
            $table->decimal('ppnbm', 18, 2)->default(0);
            $table->enum('status', ['draft', 'approved', 'amended', 'canceled'])
                ->default('draft');
            $table->enum('esign_status', ['belum', 'sudah'])->default('belum');
            $table->smallInteger('is_kredit')->nullable();
            $table->smallInteger('is_retur')->default(0);
            $table->string('file_path')->nullable();
            $table->enum('sumber', ['manual', 'upload'])->default('manual');
            $table->string('catatan')->nullable();
            $table->integer('user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index('akun_id', 'fk_efdok_akun');
            $table->index('user_id', 'fk_efdok_user');
            $table->index(['akun_id', 'arah', 'kategori', 'is_retur'], 'idx_efdok_filter');

            $table->foreign('akun_id', 'fk_efdok_akun')
                ->references('id')->on('master_pemotong')->cascadeOnDelete();
            $table->foreign('user_id', 'fk_efdok_user')
                ->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('efaktur_dokumen');
    }
};
