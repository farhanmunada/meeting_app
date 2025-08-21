<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruang;
use App\Models\Rapat;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRuang = Ruang::count();
        $totalRapat = Rapat::count();
        $totalPeserta = Absensi::count();

        // Ambil 8 absensi terakhir secara global
        $absensiTerbaru = Absensi::with('rapat')
            ->orderBy('waktu_absen', 'desc')
            ->limit(7)
            ->get();

        return view('dashboard', compact('totalRuang', 'totalRapat', 'totalPeserta', 'absensiTerbaru'));
    }

    public function absensiRealtime()
    {
        $absensiTerbaru = Absensi::with('rapat')
            ->orderBy('waktu_absen', 'desc')
            ->limit(8)
            ->get();

        return view('absensi.absensi-table', compact('absensiTerbaru'));
    }
}
