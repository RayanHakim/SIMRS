<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index()
    {
        // Ambil rekam medis yang belum diproses obatnya
        $resepMasuk = RekamMedis::with(['pasien', 'resep_obats.obat', 'dokter.user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('apotek.index', compact('resepMasuk'));
    }
}