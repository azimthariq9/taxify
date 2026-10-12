<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data hasil migrasi dari taxusakti.sql (users, master_*, praktikum_mandiri)
        $this->call(LegacyDataSeeder::class);
    }
}
