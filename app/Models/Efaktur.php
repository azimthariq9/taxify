<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `efaktur` — faktur pajak (keluaran/masukan) ringkas.
 */
class Efaktur extends Model
{
    protected $table = 'efaktur';

    protected $fillable = [
        'id',
        'nomor_seri',
        'jenis_faktur',
        'tanggal_faktur',
        'kode_transaksi',
        'npwp_lawan',
        'nama_lawan',
        'alamat_lawan',
        'dpp',
        'ppn',
        'ppnbm',
        'masa_pajak',
        'tahun_pajak',
        'status',
        'keterangan',
        'akun_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_faktur' => 'date',
            'dpp' => 'decimal:2',
            'ppn' => 'decimal:2',
            'ppnbm' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function akun(): BelongsTo
    {
        return $this->belongsTo(MasterAkun::class, 'akun_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
