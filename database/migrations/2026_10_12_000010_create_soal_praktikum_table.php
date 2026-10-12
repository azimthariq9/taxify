<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `soal_praktikum` (taxusakti.sql).
 * `praktikum_id` hanya index biasa (skema asli tidak punya foreign key).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal_praktikum', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('praktikum_id');
            $table->string('soal', 100);
            $table->string('file_support')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('user_id');

            $table->index('praktikum_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal_praktikum');
    }
};
