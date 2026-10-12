<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `pembayaran` (taxusakti.sql).
 * Primary key memakai nama asli `id_pembayaran`.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('id_spt')->nullable();
            $table->integer('id_billing');
            $table->decimal('pajak_penghasilan', 15, 2)->default(0);
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status_bayar', ['BELUM BAYAR', 'MENUNGGU', 'LUNAS'])
                ->default('BELUM BAYAR');
            $table->string('metode_bayar', 50)->nullable();
            $table->string('bukti_bayar', 255)->nullable();
            $table->string('masa_pajak', 20)->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->integer('user_id');
            $table->integer('akun_id');
            $table->integer('pemotong_id')->nullable();
            $table->string('ntpn', 50)->nullable();

            $table->index('id_spt', 'fk_pembayaran_spt_edit');
            $table->index('user_id', 'fk_pembayaran_user');

            $table->foreign('id_spt', 'fk_pembayaran_spt_edit')
                ->references('id')->on('spt_edit')->nullOnDelete();
            $table->foreign('user_id', 'fk_pembayaran_user')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
