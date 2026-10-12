<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `billing_mandiri` (taxusakti.sql).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billing_mandiri', function (Blueprint $table) {
            $table->increments('id');
            $table->string('npwp', 25);
            $table->string('nama_wp', 100);
            $table->string('alamat_wp', 255)->nullable();
            $table->string('kap_kjs', 20);
            $table->char('periode', 2);
            $table->char('tahun', 4);
            $table->string('masa_pajak', 20);
            $table->decimal('nominal', 15, 2);
            $table->string('terbilang', 255)->nullable();
            $table->decimal('jumlah_pajak', 15, 2)->default(0);
            $table->enum('status', ['Draft', 'Dibayar'])->default('Draft');
            $table->dateTime('created_at')->useCurrent();
            $table->integer('user_id');

            $table->index('user_id', 'fk_billing_mandiri_user');
            $table->foreign('user_id', 'fk_billing_mandiri_user')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billing_mandiri');
    }
};
