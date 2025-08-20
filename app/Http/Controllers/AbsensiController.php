<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use PDF;

class AbsensiController extends Controller
{
    // Form absensi peserta (publik)
    public function create(Rapat $rapat)
    {
        return view('absensi.create', compact('rapat'));
    }

    // Store absensi peserta
    public function store(Request $request, Rapat $rapat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
        ]);

        // Cek duplikat
        $exists = Absensi::where('rapat_id', $rapat->id)
            ->where('nama', $request->nama)
            ->exists();

        if ($exists) {
            return back()->withErrors(['nama' => 'Anda sudah melakukan absensi untuk rapat ini'])->withInput();
        }

        Absensi::create([
            'rapat_id' => $rapat->id,
            'nama' => $request->nama,
            'instansi' => $request->instansi,
            'jabatan' => $request->jabatan,
            'kontak' => $request->kontak,
        ]);

        return redirect('/')->with('success', 'Absensi berhasil dicatat.');
    }

    // Daftar hadir (Admin)
    public function index(Rapat $rapat)
    {
        $absensi = $rapat->absensi()->orderBy('waktu_absen', 'asc')->get();
        return view('absensi.index', compact('rapat', 'absensi'));
    }

    // Export Excel
    public function exportExcel(Rapat $rapat)
    {
        return Excel::download(new AbsensiExport($rapat->id), "Absensi_Rapat_{$rapat->id}.xlsx");
    }

    // Export PDF
    public function exportPdf(Rapat $rapat)
    {
        $absensi = $rapat->absensi;
        $pdf = PDF::loadView('absensi.pdf', compact('rapat', 'absensi'));
        return $pdf->download("Absensi_Rapat_{$rapat->id}.pdf");
    }
}
