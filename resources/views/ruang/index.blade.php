@extends('layouts.admin')

@section('title', 'Daftar Ruang')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" style="color: #2563eb;">
                <i class="bi bi-building me-2"></i>Daftar Ruang
            </h2>
            <a href="{{ route('ruang.create') }}" class="btn btn-primary shadow-sm"
                style="background-color: #2563eb; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
                <i class="bi bi-plus-circle me-1"></i> Tambah Ruang
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Daftar Ruang --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-semibold">
                Ruang Tersedia
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th>#</th>
                                <th>Nama Ruang</th>
                                <th>Kapasitas</th>
                                <th>Lokasi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ruang as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $r->nama_ruang }}</td>
                                    <td>{{ $r->kapasitas }}</td>
                                    <td>{{ $r->lokasi ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('ruang.edit', $r->id) }}" class="btn btn-sm me-1"
                                                style="background-color: #4f46e5; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Edit Ruang">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('ruang.destroy', $r->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus ruang ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    style="border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                    data-bs-toggle="tooltip" title="Hapus Ruang">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        <i class="bi bi-x-circle me-1"></i> Belum ada ruang
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Tooltip Bootstrap --}}
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el)
                })
            });
        </script>
    @endpush
@endsection
