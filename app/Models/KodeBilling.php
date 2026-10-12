<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `kode_billing` — kumpulan kode billing per SPT.
 * Primary key memakai nama asli `id_billing`.
 */
class KodeBilling extends Model
{
    protected $table = 'kode_billing';

    protected $primaryKey = 'id_billing';

    public $timestamps = false;

    protected $fillable = [
        'id_billing',
        'id_spt',
        'jenis_spt',
        'kode',
        'masa_pajak',
        'tahun_pajak',
        'jenis_setoran',
        'jumlah',
        'tanggal_buat',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'decimal:2',
            'tanggal_buat' => 'datetime',
        ];
    }

    public function spt(): BelongsTo
    {
        return $this->belongsTo(SptEdit::class, 'id_spt');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
