@extends('layouts.admin')

@section('title', 'Daftar Ruang')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold text-dark">Daftar Ruang</h3>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2">
            <span class="fw-semibold text-muted">Ruang</span>
            <a href="{{ route('ruang.create') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="bi bi-plus-circle me-1"></i> Tambah Ruang
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="border-collapse: separate; border-spacing: 0 0.5rem;">
                    <thead class="bg-light">
                        <tr class="text-muted text-uppercase small">
                            <th>#</th>
                            <th>Nama Ruang</th>
                            <th>Kapasitas</th>
                            <th>Lokasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ruang as $r)
                            <tr class="bg-white align-middle" style="border-radius: 0.5rem;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $r->nama_ruang }}</td>
                                <td>{{ $r->kapasitas }}</td>
                                <td>{{ $r->lokasi ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ruang.edit', $r->id) }}"
                                        class="btn btn-outline-warning btn-sm rounded-pill me-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('ruang.destroy', $r->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus ruang ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm rounded-pill">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">
                                    Belum ada data ruang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
