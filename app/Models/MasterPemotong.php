<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `master_pemotong` — pemotong/penerbit bukti potong (per akun aktif).
 */
class MasterPemotong extends Model
{
    protected $table = 'master_pemotong';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'nama',
        'tipe',
        'is_active',
        'npwp',
        'alamat',
        'email',
        'negara',
        'akun_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function akun(): BelongsTo
    {
        return $this->belongsTo(MasterAkun::class, 'akun_id');
    }

    /** @return HasMany<EfakturDokumen, $this> */
    public function dokumen(): HasMany
    {
        return $this->hasMany(EfakturDokumen::class, 'akun_id');
    }
}
