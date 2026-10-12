<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Pengganti `ON UPDATE current_timestamp()` milik MySQL untuk kolom
 * `updated_at` pada tabel: efaktur, efaktur_dokumen, kelas, spt_bpspt, spt_edit.
 *
 * PostgreSQL tidak punya ON UPDATE pada kolom, jadi dipakai trigger
 * BEFORE UPDATE yang selalu menyegarkan updated_at (kecuali aplikasi
 * mengisi sendiri nilainya tetap dihormati karena kita pakai now()).
 */
return new class extends Migration
{
    /** @var array<int, string> */
    private array $tables = [
        'efaktur',
        'efaktur_dokumen',
        'kelas',
        'spt_bpspt',
        'spt_edit',
    ];

    public function up(): void
    {
        // Hanya PostgreSQL; MySQL memakai ON UPDATE bawaan, SQLite tidak butuh.
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        DB::statement(<<<'SQL'
            CREATE OR REPLACE FUNCTION taxify_set_updated_at()
            RETURNS trigger AS $$
            BEGIN
                NEW.updated_at = now();
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql
        SQL);

        foreach ($this->tables as $table) {
            DB::statement(
                "CREATE TRIGGER trg_{$table}_set_updated_at
                 BEFORE UPDATE ON {$table}
                 FOR EACH ROW EXECUTE FUNCTION taxify_set_updated_at()"
            );
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        foreach ($this->tables as $table) {
            DB::statement("DROP TRIGGER IF EXISTS trg_{$table}_set_updated_at ON {$table}");
        }

        DB::statement('DROP FUNCTION IF EXISTS taxify_set_updated_at()');
    }
};
