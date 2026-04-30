<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; 
use Illuminate\Database\Eloquent\Relations\HasOne; 

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Menghubungkan User dengan data detail Dokter
     * Digunakan saat Dokter login untuk melihat antrean pasiennya.
     */
    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class);
    }

    /**
     * Menghubungkan User dengan data detail Pasien
     * Digunakan agar Pasien yang login bisa mendaftar online menggunakan data rekam medisnya.
     */
    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class);
    }
}