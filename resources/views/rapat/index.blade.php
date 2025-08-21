@extends('layouts.admin')

@section('title', 'Daftar Rapat')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0"><i class="bi bi-calendar-event me-2"></i>Daftar Rapat</h2>
            <a href="{{ route('rapat.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Tambah Rapat
            </a>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Rapat Mendatang --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white fw-semibold">
                <i class="bi bi-calendar-check me-1"></i> Rapat Mendatang
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th>Judul</th>
                                <th>Agenda</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruang</th>
                                <th>Penyelenggara</th>
                                <th>Jumlah Peserta</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rapatMendatang as $r)
                                <tr>
                                    <td class="fw-semibold">{{ $r->judul }}</td>
                                    <td>{{ Str::limit($r->agenda, 40) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($r->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $r->ruang->nama_ruang ?? '-' }}</td>
                                    <td>{{ $r->penyelenggara }}</td>
                                    <td>{{ $r->absensi->count() ?? 0 }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('rapat.show', $r->id) }}" class="btn btn-sm me-1"
                                                style="background-color: #2563eb; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Detail & QR Code">
                                                <i class="bi bi-qr-code-scan"></i>
                                            </a>
                                            <a href="{{ route('absensi.index', ['rapat' => $r->id]) }}"
                                                class="btn btn-sm me-1"
                                                style="background-color: #38bdf8; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Daftar Hadir">
                                                <i class="bi bi-people-fill"></i>
                                            </a>
                                            <a href="{{ route('rapat.edit', $r->id) }}" class="btn btn-sm me-1"
                                                style="background-color: #4f46e5; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Edit Rapat">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('rapat.destroy', $r->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin hapus rapat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    style="border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                    data-bs-toggle="tooltip" title="Hapus Rapat">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        <i class="bi bi-calendar-x me-1"></i> Tidak ada rapat mendatang
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Rapat Selesai --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white fw-semibold">
                <i class="bi bi-calendar-check2 me-1"></i> Rapat Selesai
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary">
                            <tr>
                                <th>Judul</th>
                                <th>Agenda</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruang</th>
                                <th>Penyelenggara</th>
                                <th>Jumlah Peserta</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rapatSelesai as $r)
                                <tr>
                                    <td class="fw-semibold">{{ $r->judul }}</td>
                                    <td>{{ Str::limit($r->agenda, 40) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->translatedFormat('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($r->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $r->ruang->nama_ruang ?? '-' }}</td>
                                    <td>{{ $r->penyelenggara }}</td>
                                    <td>{{ $r->absensi->count() ?? 0 }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('rapat.show', $r->id) }}" class="btn btn-sm me-1"
                                                style="background-color: #2563eb; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Detail & QR Code">
                                                <i class="bi bi-qr-code-scan"></i>
                                            </a>
                                            <a href="{{ route('absensi.index', ['rapat' => $r->id]) }}"
                                                class="btn btn-sm me-1"
                                                style="background-color: #38bdf8; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Daftar Hadir">
                                                <i class="bi bi-people-fill"></i>
                                            </a>
                                            <a href="{{ route('rapat.edit', $r->id) }}" class="btn btn-sm me-1"
                                                style="background-color: #4f46e5; color: white; border-radius: 0.5rem; box-shadow: 0 2px 5px rgba(0,0,0,0.15);"
                                                data-bs-toggle="tooltip" title="Edit Rapat">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('rapat.destroy', $r->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin ingin hapus rapat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    style="border-radius:0.5rem; box-shadow:0 2px 5px rgba(0,0,0,0.15);"
                                                    data-bs-toggle="tooltip" title="Hapus Rapat">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        <i class="bi bi-calendar-x me-1"></i> Belum ada rapat selesai
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
