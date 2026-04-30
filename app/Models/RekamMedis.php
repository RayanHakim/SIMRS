<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RekamMedis extends Model
{
    protected $fillable = ['pendaftaran_id', 'pasien_id', 'dokter_id', 'keluhan', 'pemeriksaan', 'diagnosa', 'tindakan'];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function resep_obats(): HasMany
    {
        return $this->hasMany(ResepObat::class);
    }
}