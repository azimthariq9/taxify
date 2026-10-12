<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `master_pemotong` (taxusakti.sql).
 * tinyint(1) -> smallint agar pembacaan nilai 0/1 oleh PHP tetap sama seperti MySQL.
 * Kolom `akun_id` & `user_id` di skema asli memang tidak punya foreign key.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_pemotong', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->enum('tipe', ['Orang Pribadi', 'Badan']);
            $table->smallInteger('is_active')->default(1);
            $table->string('npwp', 32)->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('negara', 100)->nullable();
            $table->integer('akun_id')->nullable();
            $table->integer('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_pemotong');
    }
};
