<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_a1` — bukti potong PPh 21/23 A1.
 */
class SptA1 extends Model
{
    protected $table = 'spt_a1';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'status',
        'masa_pajak',
        'periode_bulan_awal',
        'periode_tahun_awal',
        'periode_bulan_akhir',
        'periode_tahun_akhir',
        'nomor_bukti_potong',
        'tanggal_bukti_potong',
        'kode_objek_pajak',
        'fasilitas_pajak',
        'npwp',
        'nama',
        'alamat',
        'penghasilan_bruto',
        'pajak_penghasilan',
        'user_id',
        'akun_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_bukti_potong' => 'date',
            'penghasilan_bruto' => 'integer',
            'pajak_penghasilan' => 'integer',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
