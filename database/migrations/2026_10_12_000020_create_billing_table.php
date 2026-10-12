<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `billing` (taxusakti.sql).
 * Dua unique key duplikat di MySQL (kode_billing & uq_kode_billing)
 * dipakai satu index unik bernama uq_kode_billing.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_billing', 20)->unique('uq_kode_billing');
            $table->integer('spt_id')->nullable();
            $table->decimal('pajak_penghasilan', 15, 2);
            $table->string('masa_pajak', 20);
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');
            $table->integer('akun_id');
            $table->integer('pemotong_id')->nullable();

            $table->index('spt_id', 'fk_billing_spt_edit');
            $table->index('user_id', 'fk_billing_user');

            $table->foreign('spt_id', 'fk_billing_spt_edit')
                ->references('id')->on('spt_edit')->nullOnDelete();
            $table->foreign('user_id', 'fk_billing_user')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
