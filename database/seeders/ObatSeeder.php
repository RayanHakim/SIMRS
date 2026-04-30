<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        Obat::create([
            'kode_obat' => 'OBT001', 
            'nama_obat' => 'Paracetamol 500mg', 
            'satuan' => 'Tablet', 
            'stok' => 100, 
            'stok_minimal' => 10,
            'harga_jual' => 5000
        ]);

        Obat::create([
            'kode_obat' => 'OBT002', 
            'nama_obat' => 'Amoxicillin', 
            'satuan' => 'Kapsul', 
            'stok' => 50, 
            'stok_minimal' => 5,
            'harga_jual' => 12000
        ]);

        Obat::create([
            'kode_obat' => 'OBT003', 
            'nama_obat' => 'OBH Tropica', 
            'satuan' => 'Botol', 
            'stok' => 20, 
            'stok_minimal' => 3,
            'harga_jual' => 25000
        ]);
    }
}