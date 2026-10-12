<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `kelas_praktikum_files` — file pendukung praktikum.
 */
class KelasPraktikumFile extends Model
{
    protected $table = 'kelas_praktikum_files';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_praktikum',
        'nama_file',
        'path_file',
        'uploaded_at',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',
        ];
    }

    public function praktikum(): BelongsTo
    {
        return $this->belongsTo(KelasPraktikum::class, 'id_praktikum');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
