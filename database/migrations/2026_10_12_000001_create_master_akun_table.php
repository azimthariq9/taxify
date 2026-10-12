<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `master_akun` (taxusakti.sql).
 * int(11) -> serial/integer, text -> text, enum -> varchar + CHECK.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_akun', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 100);
            $table->string('npwp', 50);
            $table->string('nitku', 50)->nullable();
            $table->text('alamat');
            $table->enum('tipe', ['Orang Pribadi', 'Badan']);
            $table->string('email', 100);
            $table->string('negara', 50);
            $table->integer('user_id');

            $table->index('user_id', 'fk_user_master');
            $table->foreign('user_id', 'fk_user_master')
                ->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_akun');
    }
};
