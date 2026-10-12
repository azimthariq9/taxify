<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `spt_wpln` — bukti potong WPLN / PPh Pasal 26 luar negeri.
 * Skema asli tidak punya created_at/updated_at.
 */
class SptWpln extends Model
{
    protected $table = 'spt_wpln';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'masa_pajak',
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
        'user_id',
        'created_by',
        'pemotong_nama',
        'pemotong_alamat',
        'akun_id',
    ];

    protected function casts(): array
    {
        return [
            'dasar_pengenaan_pajak' => 'integer',
            'pajak_penghasilan' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
