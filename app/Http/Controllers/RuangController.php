<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    // Tampilkan daftar ruang
    public function index()
    {
        $ruang = Ruang::orderBy('nama_ruang')->get();
        return view('ruang.index', compact('ruang'));
    }

    // Form tambah ruang
    public function create()
    {
        return view('ruang.create');
    }

    // Simpan ruang baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:255|unique:ruang,nama_ruang',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
        ]);

        Ruang::create($request->all());

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil dibuat.');
    }

    // Tampilkan detail ruang (opsional)
    public function show(Ruang $ruang)
    {
        return view('ruang.show', compact('ruang'));
    }

    // Form edit ruang
    public function edit(Ruang $ruang)
    {
        return view('ruang.edit', compact('ruang'));
    }

    // Update ruang
    public function update(Request $request, Ruang $ruang)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:255|unique:ruang,nama_ruang,' . $ruang->id,
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $ruang->update($request->all());

        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil diupdate.');
    }

    // Hapus ruang
    public function destroy(Ruang $ruang)
    {
        $ruang->delete();
        return redirect()->route('ruang.index')->with('success', 'Ruang berhasil dihapus.');
    }
}
