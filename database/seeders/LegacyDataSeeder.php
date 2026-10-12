<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Migrasi data awal dari taxusakti.sql (MySQL) ke PostgreSQL.
 *
 * Hanya 5 tabel di dump tersebut yang berisi INSERT:
 *   users, master_akun, master_pemotong, master_soal, praktikum_mandiri.
 *
 * Setelah insert dengan id eksplisit, sekuens sengaja diselaraskan
 * (setval) agar insert berikutnya tidak bentrok primary key —
 * masalah khas PostgreSQL yang tidak ada di MySQL AUTO_INCREMENT.
 */
class LegacyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->seedMasterAkun();
        $this->seedMasterPemotong();
        $this->seedMasterSoal();
        $this->seedPraktikumMandiri();

        $this->syncSequences([
            'users' => 'id',
            'master_akun' => 'id',
            'master_pemotong' => 'id',
            'master_soal' => 'id',
            'praktikum_mandiri' => 'id',
        ]);
    }

    private function seedUsers(): void
    {
        $users = [
            [
                'id' => 1,
                'fullname' => 'THARIQ AZIM',
                'username' => 'mthariqazim',
                'email' => 'azimthariq9@gmail.com',
                'password' => '$2y$10$E57iZBLrzBKInlDFc00Io.bOXLzjmkETtxpRwPtZYyFbOXqVIK9H.',
                'created_at' => '2026-05-02 09:27:46',
                'email_verified_at' => '2026-05-02 16:30:19',
                'verification_token' => null,
                'role' => 'dosen',
            ],
            [
                'id' => 2,
                'fullname' => 'Riqo',
                'username' => 'riqqow',
                'email' => 'wonggundul333@gmail.com',
                'password' => '$2y$10$OqaOm/ACUIs1qKoqGfkSsObZH5Y7Dgg37Rzsx.QD/qeSfJrwIB/lm',
                'created_at' => '2026-05-02 10:38:55',
                'email_verified_at' => '2026-05-02 17:39:15',
                'verification_token' => null,
                'role' => 'mahasiswa',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['id' => $user['id']], $user);
        }
    }

    private function seedMasterAkun(): void
    {
        DB::table('master_akun')->updateOrInsert(['id' => 1], [
            'id' => 1,
            'nama' => 'M. Thariq',
            'npwp' => '3175081503051003',
            'nitku' => null,
            'alamat' => "Jl. Dato Tonggara V No.11\r\nJakarta",
            'tipe' => 'Orang Pribadi',
            'email' => 'azimthariq9@gmail.com',
            'negara' => 'Indonesia',
            'user_id' => 1,
        ]);
    }

    private function seedMasterPemotong(): void
    {
        $rows = [
            [
                'id' => 1,
                'nama' => 'Topik Hidayat',
                'tipe' => 'Orang Pribadi',
                'is_active' => 1,
                'npwp' => '3175081503051001',
                'alamat' => 'Jakarta',
                'email' => 'topik@gmail.com',
                'negara' => 'INDONESIA',
                'akun_id' => 1,
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'nama' => 'PT. Trisakti Indonesia',
                'tipe' => 'Badan',
                'is_active' => 1,
                'npwp' => '3175081503051002',
                'alamat' => 'Jl. Kyai Tapa Jakarta',
                'email' => 'trisakti@gmail.com',
                'negara' => 'INDONESIA',
                'akun_id' => 2,
                'user_id' => 1,
            ],
        ];

        foreach ($rows as $row) {
            DB::table('master_pemotong')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    private function seedMasterSoal(): void
    {
        DB::table('master_soal')->updateOrInsert(['id' => 1], [
            'id' => 1,
            'nama_soal' => 'PPh Pasal 21',
            'deskripsi' => '',
            'created_by' => 1,
            'created_at' => '2026-06-16 20:49:53',
        ]);
    }

    private function seedPraktikumMandiri(): void
    {
        DB::table('praktikum_mandiri')->updateOrInsert(['id' => 1], [
            'id' => 1,
            'nama_praktikum' => 'PPh 21',
            'pembuat' => 'THARIQ AZIM',
            'soal' => 'PPh Pasal 21',
            'created_at' => '2026-06-16 20:52:42',
            'updated_at' => null,
            'user_id' => 1,
        ]);
    }

    /**
     * Selaraskan sekuens serial dengan nilai maksimum yang baru disisipkan.
     *
     * @param  array<string, string>  $tables  tabel => kolom primary key
     */
    private function syncSequences(array $tables): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        foreach ($tables as $table => $key) {
            $max = (int) DB::table($table)->max($key);

            if ($max < 1) {
                continue;
            }

            DB::statement(
                "SELECT setval(pg_get_serial_sequence('{$table}', '{$key}'), {$max})"
            );
        }
    }
}
