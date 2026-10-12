<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel `users` — skema identik dengan taxusakti.sql (MySQL/MariaDB)
 * ditambah kolom bawaan Laravel yang dibutuhkan guard & Sanctum.
 *
 * Penyesuaian MySQL -> PostgreSQL:
 *  - int(11) AUTO_INCREMENT -> serial (increments)
 *  - enum('dosen','mahasiswa') -> varchar(255) + CHECK (Laravel enum() pada pgsql)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 100);
            $table->string('username', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('verification_token', 255)->nullable();
            $table->enum('role', ['dosen', 'mahasiswa'])->default('mahasiswa');
            $table->rememberToken();
        });

        // Tabel bawaan Laravel (dipakai bila SESSION_DRIVER / CACHE_STORE = database)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
