<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_konsep` — draf SPT sebelum diposting.
 * Kolom `sumber_data_json` bertipe jsonb (dulu longtext + CHECK json_valid).
 */
class SptKonsep extends Model
{
    protected $table = 'spt_konsep';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'jenis_pajak',
        'periode_bulan',
        'periode_tahun',
        'jenis_spt',
        'sumber_data_json',
        'sumber_id',
        'model_spt',
        'nop',
        'nama_objek',
        'status',
        'tanggal_dibuat',
        'masa_pajak',
        'created_by',
        'pemotong_alamat',
        'npwp',
        'nama',
        'user_id',
        'posted_at',
        'akun_id',
    ];

    protected function casts(): array
    {
        return [
            'sumber_data_json' => 'array',
            'tanggal_dibuat' => 'datetime',
            'posted_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
