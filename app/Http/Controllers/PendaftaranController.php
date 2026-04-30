<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan daftar pendaftaran (antrean) hari ini.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Pendaftaran::with(['pasien', 'dokter.user', 'dokter.poli'])
                    ->whereDate('tgl_pendaftaran', now())
                    ->orderBy('no_antrean', 'asc');

        // Skenario SQA: Privacy Filter
        // Pasien hanya boleh melihat pendaftaran atas nama dirinya sendiri
        if ($user->hasRole('pasien')) {
            $query->whereHas('pasien', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Dokter hanya melihat antrean yang menuju ke dirinya sendiri
        if ($user->hasRole('dokter')) {
            $query->where('dokter_id', $user->dokter->id);
        }

        $pendaftarans = $query->get();

        return view('pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Menampilkan form pendaftaran baru.
     */
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $dokters = Dokter::with(['user', 'poli'])->get();
        
        // Skenario SQA: Data Isolation
        if ($user->hasRole('pasien')) {
            // Pasien hanya bisa mendaftarkan dirinya sendiri
            $pasiens = Pasien::where('user_id', $user->id)->get();
            
            if ($pasiens->isEmpty()) {
                return redirect()->route('dashboard')->with('error', 'Profil medis Anda belum ditemukan. Silakan hubungi admin.');
            }
        } else {
            // Admin/Resepsionis bisa mendaftarkan semua pasien
            $pasiens = Pasien::all();
        }
        
        return view('pendaftaran.create', compact('pasiens', 'dokters'));
    }

    /**
     * Menyimpan data pendaftaran ke database.
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'cara_bayar' => 'required|in:umum,bpjs',
        ]);

        // 2. Security Check (Cegah ID Injection)
        if ($user->hasRole('pasien')) {
            $pasienMilikUser = Pasien::where('user_id', $user->id)->first();
            if ($request->pasien_id != $pasienMilikUser->id) {
                return redirect()->back()->with('error', 'Tindakan tidak sah! Anda hanya bisa mendaftar untuk diri sendiri.');
            }
        }

        // 3. Logic Auto-Number Antrean berdasarkan Dokter & Hari ini
        $antreanTerakhir = Pendaftaran::where('dokter_id', $request->dokter_id)
                            ->whereDate('tgl_pendaftaran', now())
                            ->count();

        // 4. Eksekusi Simpan
        Pendaftaran::create([
            'no_reg' => 'REG-' . now()->format('YmdHis'),
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'tgl_pendaftaran' => now(),
            'no_antrean' => $antreanTerakhir + 1,
            'status' => 'antre',
            'cara_bayar' => $request->cara_bayar,
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran Berhasil!');
    }
}