<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `billing` — kode billing yang terbit dari SPT (spt_edit).
 */
class Billing extends Model
{
    protected $table = 'billing';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'kode_billing',
        'spt_id',
        'pajak_penghasilan',
        'masa_pajak',
        'user_id',
        'akun_id',
        'pemotong_id',
    ];

    protected function casts(): array
    {
        return [
            'pajak_penghasilan' => 'decimal:2',
            'created_at' => 'datetime',
        ];
    }

    public function spt(): BelongsTo
    {
        return $this->belongsTo(SptEdit::class, 'spt_id');
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
