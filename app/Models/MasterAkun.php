<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `master_akun` — data wajib pajak milik user (npwp, nitku, alamat).
 */
class MasterAkun extends Model
{
    protected $table = 'master_akun';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama',
        'npwp',
        'nitku',
        'alamat',
        'tipe',
        'email',
        'negara',
        'user_id',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
