<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Tabel `users` (skema warisan taxusakti.sql).
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'email_verified_at',
        'verification_token',
        'role',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * Kolom bawaan Laravel yang tidak ada pada skema legacy.
     *
     * @var list<string>
     */
    protected $appends = [];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function akun(): HasMany
    {
        return $this->hasMany(MasterAkun::class, 'user_id');
    }

    public function pemotong(): HasMany
    {
        return $this->hasMany(MasterPemotong::class, 'user_id');
    }

    public function kelas(): BelongsToMany
    {
        return $this->belongsToMany(
            Kelas::class,
            'kelas_user',
            'user_id',
            'kelas_id'
        )->withPivot('joined_at');
    }
}
