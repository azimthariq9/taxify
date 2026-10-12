<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_menunggu` — konsep yang menunggu proses/persetujuan.
 */
class SptMenunggu extends Model
{
    protected $table = 'spt_menunggu';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'id_konsep',
        'jenis_pajak',
        'periode_bulan',
        'periode_tahun',
        'jenis_spt',
        'model_spt',
        'masa_pajak',
        'npwp',
        'nama',
        'pajak_penghasilan',
        'tanggal_dibuat',
        'status',
        'user_id',
        'akun_id',
    ];

    protected function casts(): array
    {
        return [
            'pajak_penghasilan' => 'decimal:2',
            'tanggal_dibuat' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
