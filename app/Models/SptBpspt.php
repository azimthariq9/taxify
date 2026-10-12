<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_bpspt` — bukti potong SPT (punya updated_at + trigger).
 */
class SptBpspt extends Model
{
    protected $table = 'spt_bpspt';

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
        'status_ptkp',
        'dasar_pengenaan_pajak',
        'pajak_penghasilan',
        'fasilitas_pajak',
        'created_by',
        'pemotong_nama',
        'pemotong_alamat',
        'user_id',
        'akun_id',
        'nama_objek',
        'sifat_penghasilan',
        'kap',
        'penghasilan_bruto',
        'dpp',
        'tarif',
        'jenis_dokumen',
        'nomor_dokumen',
        'tanggal_mulai',
        'nomor_sub_unit',
        'kode_objek',
    ];

    protected function casts(): array
    {
        return [
            'dasar_pengenaan_pajak' => 'decimal:0',
            'pajak_penghasilan' => 'decimal:0',
            'penghasilan_bruto' => 'decimal:2',
            'dpp' => 'decimal:2',
            'tarif' => 'decimal:2',
            'tanggal_mulai' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
