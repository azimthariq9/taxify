<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Tabel `master_soal` — daftar nama soal/praktikum induk.
 */
class MasterSoal extends Model
{
    protected $table = 'master_soal';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'nama_soal',
        'deskripsi',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
