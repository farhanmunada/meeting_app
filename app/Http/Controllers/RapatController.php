<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapat;
use App\Models\Ruang;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RapatController extends Controller
{
    public function index()
    {
        $rapat = Rapat::with('ruang')->orderBy('tanggal', 'asc')->get();
        return view('rapat.index', compact('rapat'));
    }

    public function create()
    {
        $ruang = Ruang::all();
        return view('rapat.create', compact('ruang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'agenda' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'ruang_id' => 'required|exists:ruang,id',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $exists = Rapat::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                    });
            })->exists();

        if ($exists) {
            return back()->withErrors(['ruang_id' => 'Ruang sudah digunakan pada waktu yang bentrok'])->withInput();
        }

        Rapat::create($request->all());

        return redirect()->route('rapat.index')->with('success', 'Rapat berhasil dibuat.');
    }

    public function show(string $id)
    {
        $rapat = Rapat::with('absensi', 'ruang')->findOrFail($id);

        // Generate QR code yang mengarah ke form absensi peserta
        $qrCode = QrCode::size(150)->generate(route('absensi.create', $rapat->id));

        return view('rapat.show', compact('rapat', 'qrCode'));
    }

    public function edit(string $id)
    {
        $rapat = Rapat::findOrFail($id);
        $ruang = Ruang::all();
        return view('rapat.edit', compact('rapat', 'ruang'));
    }

    public function update(Request $request, string $id)
    {
        $rapat = Rapat::findOrFail($id); // ✅ Ambil data rapat dulu

        $request->validate([
            'judul' => 'required|string|max:255',
            'agenda' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'ruang_id' => 'required|exists:ruang,id',
            'penyelenggara' => 'required|string|max:255',
        ]);

        $exists = Rapat::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where('id', '!=', $rapat->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                    });
            })->exists();

        if ($exists) {
            return back()->withErrors(['ruang_id' => 'Ruang sudah digunakan pada waktu yang bentrok'])->withInput();
        }

        $rapat->update($request->all());

        return redirect()->route('rapat.index')->with('success', 'Rapat berhasil diupdate.');
    }

    public function destroy(string $id)
    {
        $rapat = Rapat::findOrFail($id); // ✅ Ambil data rapat dulu
        $rapat->delete();

        return redirect()->route('rapat.index')->with('success', 'Rapat berhasil dihapus.');
    }

    public function homepage()
    {
        $rapat = Rapat::with('ruang')
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('home', compact('rapat'));
    }
}
