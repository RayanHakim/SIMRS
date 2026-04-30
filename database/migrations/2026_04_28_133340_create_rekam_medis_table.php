<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pasien_id')->constrained()->cascadeOnDelete();
            $table->foreignId('dokter_id')->constrained()->cascadeOnDelete();
            
            // SOAP Format
            $table->text('keluhan');       // Subjective
            $table->text('pemeriksaan');   // Objective
            $table->string('diagnosa');    // Assessment (Kode ICD-10)
            $table->text('tindakan');      // Plan
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};