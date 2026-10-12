<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel pivot `kelas_user` (user_id + kelas_id unik).
 */
class KelasUser extends Model
{
    protected $table = 'kelas_user';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'kelas_id',
        'joined_at',
    ];

    protected function casts(): array
    {
        return [
            'joined_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }
}
