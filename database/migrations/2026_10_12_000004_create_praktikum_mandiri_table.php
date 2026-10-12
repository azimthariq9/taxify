<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `praktikum_mandiri` (taxusakti.sql).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('praktikum_mandiri', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_praktikum');
            $table->string('pembuat');
            $table->string('soal');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->integer('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('praktikum_mandiri');
    }
};
