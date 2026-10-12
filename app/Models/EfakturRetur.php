<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Tabel `efaktur_retur` — pengajuan retur atas suatu dokumen e-faktur.
 */
class EfakturRetur extends Model
{
    protected $table = 'efaktur_retur';

    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'dokumen_id',
        'alasan',
        'tanggal_retur',
        'status',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_retur' => 'date',
            'created_at' => 'datetime',
        ];
    }

    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(EfakturDokumen::class, 'dokumen_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
