<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_bpbpt` — bukti potong BP/BPT.
 */
class SptBpbpt extends Model
{
    protected $table = 'spt_bpbpt';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'masa_pajak',
        'periode_bulan',
        'periode_tahun',
        'nomor_pemotongan',
        'status',
        'nitku',
        'jenis_pajak',
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
        'user_id',
        'akun_id',
    ];

    protected function casts(): array
    {
        return [
            'dasar_pengenaan_pajak' => 'decimal:0',
            'pajak_penghasilan' => 'decimal:0',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
