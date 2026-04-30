<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'kode_obat', 
        'nama_obat', 
        'satuan', 
        'stok', 
        'stok_minimal', 
        'harga_jual'
    ];
}