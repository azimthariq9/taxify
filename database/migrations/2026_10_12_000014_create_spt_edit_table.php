<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `spt_edit` (taxusakti.sql).
 *
 * Penyesuaian:
 *  - double -> double precision
 *  - `updated_at ... ON UPDATE current_timestamp` -> trigger
 *    (lihat migration add_updated_at_triggers)
 *  - Nama index unik global di pgsql sudah baku: uniq_spt_edit,
 *    idx_masa_createdby, idx_sync (sama dengan skema asli).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spt_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_spt_asli');
            $table->string('sumber_data', 50)->nullable();
            $table->string('masa_pajak', 50);
            $table->string('nomor_pemotongan', 50)->default('-');
            $table->string('status', 50);
            $table->string('jenis_pajak', 50);
            $table->enum('jenis_spt', ['Normal', 'Pembetulan'])->default('Normal');
            $table->string('kode_pajak', 50);
            $table->string('npwp', 32)->default('000000000000000');
            $table->string('nama')->default('WAJIB PAJAK');
            $table->text('alamat')->default('INDONESIA');
            $table->double('dasar_pengenaan_pajak');
            $table->double('pajak_penghasilan');
            $table->string('fasilitas_pajak', 100)->nullable();
            $table->string('created_by', 100);
            $table->string('pemotong_nama')->nullable();
            $table->text('pemotong_alamat')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('id_spt_konsep');
            $table->integer('akun_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->decimal('pph21', 20, 2)->default(0);
            $table->decimal('pph26', 20, 2)->default(0);

            $table->unique(
                ['masa_pajak', 'nomor_pemotongan', 'akun_id', 'user_id'],
                'uniq_spt_edit'
            );
            $table->index(['masa_pajak', 'created_by'], 'idx_masa_createdby');
            $table->index(
                ['masa_pajak', 'npwp', 'nomor_pemotongan', 'user_id', 'akun_id'],
                'idx_sync'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spt_edit');
    }
};
