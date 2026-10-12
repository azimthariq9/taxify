<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `spt_edit` — SPT yang sudah diterbitkan/dilaporkan (sumber billing).
 * Skema asli hanya punya `updated_at` (tanpa created_at).
 */
class SptEdit extends Model
{
    protected $table = 'spt_edit';

    const CREATED_AT = null;
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id',
        'id_spt_asli',
        'sumber_data',
        'masa_pajak',
        'nomor_pemotongan',
        'status',
        'jenis_pajak',
        'jenis_spt',
        'kode_pajak',
        'npwp',
        'nama',
        'alamat',
        'dasar_pengenaan_pajak',
        'pajak_penghasilan',
        'fasilitas_pajak',
        'created_by',
        'pemotong_nama',
        'pemotong_alamat',
        'id_spt_konsep',
        'akun_id',
        'user_id',
        'pph21',
        'pph26',
    ];

    protected function casts(): array
    {
        return [
            'dasar_pengenaan_pajak' => 'float',
            'pajak_penghasilan' => 'float',
            'pph21' => 'decimal:2',
            'pph26' => 'decimal:2',
            'updated_at' => 'datetime',
        ];
    }

    /** @return HasMany<Billing, $this> */
    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class, 'spt_id');
    }

    /** @return HasMany<Pembayaran, $this> */
    public function pembayarans(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'id_spt');
    }
}
