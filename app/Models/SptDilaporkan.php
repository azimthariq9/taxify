<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_dilaporkan` — riwayat SPT yang sudah dilaporkan.
 * Skema asli tidak punya created_at/updated_at (pakai `tanggal_lapor`).
 */
class SptDilaporkan extends Model
{
    protected $table = 'spt_dilaporkan';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_spt',
        'masa_pajak',
        'npwp',
        'nama',
        'pajak_penghasilan',
        'tanggal_lapor',
        'user_id',
        'akun_id',
        'pph21',
        'pph26',
    ];

    protected function casts(): array
    {
        return [
            'pajak_penghasilan' => 'decimal:2',
            'pph21' => 'decimal:2',
            'pph26' => 'decimal:2',
            'tanggal_lapor' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
