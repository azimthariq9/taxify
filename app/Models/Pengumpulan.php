<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `pengumpulan` — jawaban mahasiswa, unik per (praktikum_id, user_id).
 */
class Pengumpulan extends Model
{
    protected $table = 'pengumpulan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'praktikum_id',
        'user_id',
        'file_jawaban',
        'catatan',
        'uploaded_at',
        'status',
        'nilai',
        'feedback',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
            'nilai' => 'decimal:2',
        ];
    }

    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(KelasPraktikum::class, 'praktikum_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
