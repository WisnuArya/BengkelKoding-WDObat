<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPeriksa;
use App\Models\Pasien;
use Carbon\Carbon;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use App\Models\Poli;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index()
    {
        $pasien = Pasien::with('user')->get();
        $jadwal = JadwalPeriksa::with(['dokter.user'])->get();
        $poli = Poli::all();

        return view('daftar-poli', compact('pasien', 'jadwal', 'poli',));
    }

    public function poli()
    {
        $user = Auth::user();

        // Ambil pasien yang login
        $pasien = Pasien::where('user_id', $user->id)->first();
        $periksa = Periksa::where('id_pasien', $pasien->id)->latest()->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
        }

        $jadwal = JadwalPeriksa::with(['dokter.user'])->get();
        $poli = Poli::all();
        $riwayat = DaftarPoli::with(['jadwal.poli', 'jadwal.dokter.user','periksa'])
            ->where('id_pasien', $pasien->id)
            ->get();
        $rekam = Pasien::generateNoRM();

        return view('poli', compact('pasien', 'jadwal', 'poli', 'riwayat', 'rekam', 'periksa'));
    }
    public function daftar(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required',
            'id_jadwal' => 'required',
            'tanggal_daftar' => 'required|date',
        ]);

        $id_pasien = $request->input('id_pasien');
        $id_jadwal = $request->input('id_jadwal');
        $tanggal_daftar = $request->input('tanggal_daftar');

        // Ambil data jadwal dan poli
        $jadwal = JadwalPeriksa::with('poli')->findOrFail($id_jadwal);
        $id_poli = $jadwal->id_poli;
        $kodePoli = $jadwal->poli->kode_poli; // Pastikan kolom ini ada, misalnya "PG", "PJ"

        $tahun = Carbon::parse($tanggal_daftar)->format('Y');

        // Hitung jumlah antrean hari itu di poli yang sama
        $jumlahAntrianHariIni = DaftarPoli::whereHas('jadwal', function ($query) use ($id_poli) {
            $query->where('id_poli', $id_poli);
        })
            ->where('tanggal_daftar', $tanggal_daftar)
            ->count();

        // Format nomor antrean: 2025-PG-001
        $noAntrian = $tahun . '-' . $kodePoli . '-' . str_pad($jumlahAntrianHariIni + 1, 3, '0', STR_PAD_LEFT);

        DaftarPoli::create([
            'id_pasien' => $id_pasien,
            'id_jadwal' => $id_jadwal,
            'no_antrean' => $noAntrian,
            'tanggal_daftar' => $tanggal_daftar,
        ]);

        return redirect()->route('poli')->with('success', 'Pendaftaran berhasil! No Antrian Anda: ' . $noAntrian);
    }
}
