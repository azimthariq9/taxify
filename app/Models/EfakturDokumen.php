<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `efaktur_dokumen` — dokumen e-faktur (faktur & dokumen lain).
 * `akun_id` merujuk ke master_pemotong (pemilik dokumen aktif).
 */
class EfakturDokumen extends Model
{
    protected $table = 'efaktur_dokumen';

    protected $fillable = [
        'id',
        'akun_id',
        'arah',
        'kategori',
        'npwp_lawan',
        'nama_lawan',
        'kode_transaksi',
        'nomor_dokumen',
        'tanggal_dokumen',
        'masa_pajak',
        'tahun_pajak',
        'dpp',
        'ppn',
        'ppnbm',
        'status',
        'esign_status',
        'is_kredit',
        'is_retur',
        'file_path',
        'sumber',
        'catatan',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_dokumen' => 'date',
            'masa_pajak' => 'integer',
            'tahun_pajak' => 'integer',
            'dpp' => 'decimal:2',
            'ppn' => 'decimal:2',
            'ppnbm' => 'decimal:2',
            'is_kredit' => 'integer',
            'is_retur' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function pemotong(): BelongsTo
    {
        return $this->belongsTo(MasterPemotong::class, 'akun_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @return HasMany<EfakturRetur, $this> */
    public function returs(): HasMany
    {
        return $this->hasMany(EfakturRetur::class, 'dokumen_id');
    }
}
