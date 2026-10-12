<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `praktikum_mandiri` — praktikum yang dibuat mandiri oleh dosen.
 */
class PraktikumMandiri extends Model
{
    protected $table = 'praktikum_mandiri';

    protected $fillable = [
        'id',
        'nama_praktikum',
        'pembuat',
        'soal',
        'created_at',
        'updated_at',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
