<?php

namespace Database\Seeders;

use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Poli
        $poliUmum = Poli::create(['nama_poli' => 'Poli Umum', 'lokasi' => 'Lantai 1']);
        $poliGigi = Poli::create(['nama_poli' => 'Poli Gigi', 'lokasi' => 'Lantai 2']);

        // 2. Seed Pasien Dummy (Resepsionis Input)
        Pasien::create([
            'nik' => '3306012345678901',
            'no_rm' => 'RM-0001',
            'nama' => 'Budi Santoso',
            'tempat_lahir' => 'Purworejo',
            'tgl_lahir' => '1990-05-20',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Kutoarjo No. 10, Purworejo'
        ]);

        // 3. Seed Pasien Online (Terhubung ke User)
        $userPasien = User::where('username', 'pasien1')->first();
        
        if ($userPasien) {
            Pasien::create([
                'user_id' => $userPasien->id, // Jembatan Login
                'nik' => '3306012204040001',
                'no_rm' => 'RM-ONLINE',
                'nama' => 'Rayan Luqman Hakim',
                'tempat_lahir' => 'Yogyakarta',
                'tgl_lahir' => '2004-01-01',
                'jenis_kelamin' => 'L',
                'alamat' => 'Depok, Sleman',
                'no_hp' => '08123456789'
            ]);
        }

        // 4. Hubungkan User Dokter ke Tabel Dokter
        $userDokter = User::where('username', 'dokter1')->first();
        
        if ($userDokter) {
            Dokter::create([
                'user_id' => $userDokter->id,
                'poli_id' => $poliUmum->id,
                'spesialis' => 'Dokter Umum',
                'nip' => '198801012023011001',
                'kuota_harian' => 30,
                'biaya_konsultasi' => 50000
            ]);
        }
    }
}