<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Menghapus cache permission agar role baru terbaca
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar Role Utama SIMRS
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'resepsionis']);
        Role::create(['name' => 'dokter']);
        Role::create(['name' => 'pasien']);  
        Role::create(['name' => 'apoteker']);
        Role::create(['name' => 'kasir']);
    }
}