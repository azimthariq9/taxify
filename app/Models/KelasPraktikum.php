<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `kelas_praktikum` — daftar praktikum di dalam satu kelas.
 * Skema asli tidak memiliki kolom created_at/updated_at.
 */
class KelasPraktikum extends Model
{
    protected $table = 'kelas_praktikum';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'kelas_id',
        'nama_praktikum',
        'deskripsi_file',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** @return HasMany<KelasPraktikumFile, $this> */
    public function files(): HasMany
    {
        return $this->hasMany(KelasPraktikumFile::class, 'id_praktikum');
    }

    /** @return HasMany<Pengumpulan, $this> */
    public function pengumpulans(): HasMany
    {
        return $this->hasMany(Pengumpulan::class, 'praktikum_id');
    }
}
