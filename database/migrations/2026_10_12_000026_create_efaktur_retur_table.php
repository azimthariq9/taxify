<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `efaktur_retur` (taxusakti.sql).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('efaktur_retur', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dokumen_id');
            $table->string('alasan')->nullable();
            $table->date('tanggal_retur');
            $table->enum('status', ['diajukan', 'dibatalkan'])->default('diajukan');
            $table->integer('user_id');
            $table->timestamp('created_at')->useCurrent();

            $table->index('dokumen_id', 'fk_efretur_dokumen');
            $table->index('user_id', 'fk_efretur_user');

            $table->foreign('dokumen_id', 'fk_efretur_dokumen')
                ->references('id')->on('efaktur_dokumen')->cascadeOnDelete();
            $table->foreign('user_id', 'fk_efretur_user')
                ->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('efaktur_retur');
    }
};
