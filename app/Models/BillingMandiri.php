<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `billing_mandiri` — billing pembayaran mandiri wajib pajak.
 */
class BillingMandiri extends Model
{
    protected $table = 'billing_mandiri';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'npwp',
        'nama_wp',
        'alamat_wp',
        'kap_kjs',
        'periode',
        'tahun',
        'masa_pajak',
        'nominal',
        'terbilang',
        'jumlah_pajak',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'jumlah_pajak' => 'decimal:2',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
