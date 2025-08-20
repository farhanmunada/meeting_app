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

        return view('dashboard', compact('totalRuang', 'totalRapat', 'totalPeserta'));
    }
}
