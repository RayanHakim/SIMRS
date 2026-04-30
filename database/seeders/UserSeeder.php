<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::create([
            'name' => 'Admin SIMRS',
            'username' => 'admin',
            'email' => 'admin@simrs.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // 2. Akun Dokter
        $dokter = User::create([
            'name' => 'dr. Rayan Hakim',
            'username' => 'dokter1',
            'email' => 'dokter@simrs.com',
            'password' => Hash::make('password'),
        ]);
        $dokter->assignRole('dokter');

        // 3. Akun Pasien (PENTING untuk tes Daftar Online)
        $pasien = User::create([
            'name' => 'Rayan Luqman Hakim',
            'username' => 'pasien1',
            'email' => 'pasien@simrs.com',
            'password' => Hash::make('password'),
        ]);
        $pasien->assignRole('pasien');

        // 4. Akun Apoteker 
        $apoteker = User::create([
            'name' => 'Apoteker SIMRS',
            'username' => 'apoteker1',
            'email' => 'apoteker@simrs.com',
            'password' => Hash::make('password'),
        ]);
        $apoteker->assignRole('apoteker');
    }
}