<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    protected $fillable = [
        'user_id', 
        'nik',
        'no_rm',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat'
    ];

    /**
     * Relasi ke User (Akun Login)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}