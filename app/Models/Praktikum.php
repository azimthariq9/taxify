<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `praktikum` — primary key memakai nama asli `id_praktikum`.
 */
class Praktikum extends Model
{
    protected $table = 'praktikum';

    protected $primaryKey = 'id_praktikum';

    const UPDATED_AT = null;

    protected $fillable = [
        'id_praktikum',
        'id_kelas',
        'nama_praktikum',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'created_at' => 'datetime',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return HasMany<SoalPraktikum, $this> */
    public function soals(): HasMany
    {
        return $this->hasMany(SoalPraktikum::class, 'praktikum_id');
    }
}
