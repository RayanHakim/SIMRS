<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_reg', 
        'pasien_id', 
        'dokter_id', 
        'tgl_pendaftaran', 
        'no_antrean', 
        'status', 
        'cara_bayar'
    ];

    protected $casts = [
        'tgl_pendaftaran' => 'date',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}