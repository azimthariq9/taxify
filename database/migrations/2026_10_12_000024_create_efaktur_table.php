<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `efaktur` (taxusakti.sql).
 * `updated_at ... ON UPDATE current_timestamp` diwakilkan trigger
 * (lihat migration add_updated_at_triggers).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('efaktur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_seri', 30);
            $table->enum('jenis_faktur', ['Keluaran', 'Masukan'])->default('Keluaran');
            $table->date('tanggal_faktur');
            $table->string('kode_transaksi', 5)->nullable();
            $table->string('npwp_lawan', 25);
            $table->string('nama_lawan');
            $table->text('alamat_lawan')->nullable();
            $table->decimal('dpp', 18, 2)->default(0);
            $table->decimal('ppn', 18, 2)->default(0);
            $table->decimal('ppnbm', 18, 2)->default(0)->nullable();
            $table->string('masa_pajak', 20);
            $table->char('tahun_pajak', 4);
            $table->enum('status', ['Normal', 'Batal', 'Diganti'])->default('Normal');
            $table->text('keterangan')->nullable();
            $table->integer('akun_id');
            $table->integer('user_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index(['akun_id', 'masa_pajak'], 'idx_akun_masa');
            $table->index('user_id', 'idx_user');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('efaktur');
    }
};
