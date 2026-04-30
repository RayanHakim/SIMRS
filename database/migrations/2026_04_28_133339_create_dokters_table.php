<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (untuk login) dan Poli
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('poli_id')->constrained()->cascadeOnDelete();
            
            $table->string('spesialis');
            $table->string('nip', 20)->unique(); // Nomor Induk Pegawai
            $table->integer('kuota_harian')->default(20);
            $table->decimal('biaya_konsultasi', 15, 2)->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};