<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tabel `kelas` — primary key memakai nama asli `id_kelas`.
 */
class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'id_kelas',
        'kode_kelas',
        'status',
        'nama_kelas',
        'tanggal_mulai',
        'tanggal_selesai',
        'file_pdf',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /** @return BelongsToMany<User, $this> */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'kelas_user',
            'kelas_id',
            'user_id'
        )->withPivot('joined_at');
    }

    /** @return HasMany<Praktikum, $this> */
    public function praktikums(): HasMany
    {
        return $this->hasMany(Praktikum::class, 'id_kelas', 'id_kelas');
    }

    /** @return HasMany<KelasPraktikum, $this> */
    public function kelasPraktikums(): HasMany
    {
        return $this->hasMany(KelasPraktikum::class, 'kelas_id', 'id_kelas');
    }
}
