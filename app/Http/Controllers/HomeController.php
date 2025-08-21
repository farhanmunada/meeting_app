<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rapat;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua rapat beserta relasinya
        $rapat = Rapat::with('absensi', 'ruang')->orderBy('tanggal', 'asc')->get();

        // Filter rapat berdasarkan tanggal saja (hari ini atau nanti)
        $rapatAktif = $rapat->filter(function ($r) {
            $tanggalRapat = Carbon::parse($r->tanggal);
            return $tanggalRapat->isToday() || $tanggalRapat->isFuture();
        });

        // Generate QR Code untuk setiap rapat aktif
        foreach ($rapatAktif as $r) {
            $r->qrCode = QrCode::size(120)->generate(route('absensi.create', $r->id));
        }

        return view('welcome', compact('rapatAktif'));
    }
}
