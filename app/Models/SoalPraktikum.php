<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `soal_praktikum` — butir soal pada suatu praktikum.
 * `praktikum_id` di skema legacy hanya index biasa (tanpa foreign key).
 */
class SoalPraktikum extends Model
{
    protected $table = 'soal_praktikum';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'praktikum_id',
        'soal',
        'file_support',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(Praktikum::class, 'praktikum_id', 'id_praktikum');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
