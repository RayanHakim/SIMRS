<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function index()
    {
        // Ambil data dokter yang sedang login
        $user = Auth::user();
        $dokter = $user->dokter;

        if (!$dokter) {
            return redirect()->route('dashboard')->with('error', 'Akun Anda tidak terhubung ke data Dokter.');
        }

        // Tampilkan antrean khusus untuk dokter ini yang statusnya masih 'antre'
        $antrean = Pendaftaran::with('pasien')
                    ->where('dokter_id', $dokter->id)
                    ->where('status', 'antre')
                    ->whereDate('tgl_pendaftaran', now())
                    ->orderBy('no_antrean', 'asc')
                    ->get();

        return view('pemeriksaan.index', compact('antrean'));
    }

    public function create($id)
    {
        // Menampilkan form pemeriksaan untuk pasien tertentu
        $pendaftaran = Pendaftaran::with('pasien')->findOrFail($id);
        return view('pemeriksaan.create', compact('pendaftaran'));
    }

    public function store(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'keluhan' => 'required',
            'pemeriksaan' => 'required',
            'diagnosa' => 'required',
        ]);

        // 1. Simpan ke tabel Rekam Medis
        RekamMedis::create([
            'pendaftaran_id' => $pendaftaran->id,
            'pasien_id'      => $pendaftaran->pasien_id,
            'dokter_id'      => $pendaftaran->dokter_id,
            'keluhan'        => $request->keluhan,
            'pemeriksaan'    => $request->pemeriksaan,
            'diagnosa'       => $request->diagnosa,
            'tindakan'       => $request->tindakan,
        ]);

        // 2. Update status pendaftaran jadi 'selesai'
        $pendaftaran->update(['status' => 'selesai']);

        return redirect()->route('pemeriksaan.index')->with('success', 'Pasien berhasil diperiksa!');
    }
}