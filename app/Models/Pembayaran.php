<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `pembayaran` — status pembayaran atas suatu billing.
 * Primary key memakai nama asli `id_pembayaran`.
 */
class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    public $timestamps = false;

    protected $fillable = [
        'id_pembayaran',
        'id_spt',
        'id_billing',
        'pajak_penghasilan',
        'tanggal_bayar',
        'status_bayar',
        'metode_bayar',
        'bukti_bayar',
        'masa_pajak',
        'npwp',
        'nama',
        'alamat',
        'user_id',
        'akun_id',
        'pemotong_id',
        'ntpn',
    ];

    protected function casts(): array
    {
        return [
            'pajak_penghasilan' => 'decimal:2',
            'tanggal_bayar' => 'date',
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

    public function pemotong(): BelongsTo
    {
        return $this->belongsTo(MasterPemotong::class, 'pemotong_id');
    }
}
