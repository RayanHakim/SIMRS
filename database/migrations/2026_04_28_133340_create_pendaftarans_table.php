<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_reg')->unique();
            $table->foreignId('pasien_id')->constrained()->cascadeOnDelete();
            $table->foreignId('dokter_id')->constrained()->cascadeOnDelete();
            $table->date('tgl_pendaftaran');
            $table->integer('no_antrean');
            $table->enum('status', ['antre', 'periksa', 'selesai', 'batal'])->default('antre');
            $table->enum('cara_bayar', ['umum', 'bpjs']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};