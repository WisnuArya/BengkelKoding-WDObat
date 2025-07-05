<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Periksa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function count_user()
    {
        $countusers = User::count();
        $countpasien = User::where('role', 'pasien')->count();
        $countdokter = User::where('role', 'dokter')->count();
        $countperiksa = Periksa::count();

        return view('dashboard', compact('countusers', 'countpasien', 'countdokter','countperiksa'));
    }

    public function count_pasien()
    {
        $countpasien = User::where('role', 'pasien')->count(); // Hitung semua user
        return view('dashboard', compact('countpasien'));
    }
}
