<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DaftarPoli;
use App\Models\Periksa;

class PeriksaController extends Controller
{
    //
    public function index()
    {
        $pasienId = auth()->user()->pasienModels->id;
        $dokters = User::where('role', 'dokter')->get();
        $daftars = daftar_poliModel::all();
        $periksas = Periksa::with('dokter', 'pasienModels.user', 'daftarPoli.jadwal.poli')
            ->where('id_pasien', $pasienId)
            ->get();
        return view('list-dokter', compact('dokters', 'daftars', 'periksas'));
    }

    public function lihatDetailPeriksa($id)
    {
        $pasienId = auth()->user()->pasienModels->id;

        $periksa = periksa::with('dokter', 'pasienModels.user') // load user dari pasien
            ->where('id_pasien', $pasienId)
            ->findOrFail($id);

        return view('detail-periksa', compact('periksa'));
    }
}
