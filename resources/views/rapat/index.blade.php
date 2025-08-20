@extends('layouts.admin')

@section('title', 'Daftar Rapat')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Rapat</h2>
            <a href="{{ route('rapat.create') }}" class="btn btn-primary shadow-sm">Tambah Rapat</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th>Judul</th>
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruang</th>
                            <th>Penyelenggara</th>
                            <th>Jumlah Peserta</th> <!-- Tambah kolom -->
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rapat as $r)
                            <tr>
                                <td class="fw-medium">{{ $r->judul }}</td>
                                <td>{{ $r->agenda }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($r->waktu_selesai)->format('H:i') }}</td>
                                <td>{{ $r->ruang->nama_ruang }}</td>
                                <td>{{ $r->penyelenggara }}</td>
                                <td>{{ $r->absensi->count() }}</td> <!-- Hitung jumlah peserta -->
                                <td class="text-center">
                                    <a href="{{ route('rapat.edit', $r->id) }}"
                                        class="btn btn-sm btn-outline-warning me-1">Edit</a>
                                    <form action="{{ route('rapat.destroy', $r->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>

                                    <!-- Tombol Daftar Hadir (Admin) -->
                                    <a href="{{ route('absensi.index', ['rapat' => $r->id]) }}"
                                        class="btn btn-primary btn-sm">
                                        Daftar Hadir
                                    </a>

                                    <!-- Tombol Isi Absensi (Peserta, publik) -->
                                    <a href="{{ route('absensi.create', ['rapat' => $r->id]) }}"
                                        class="btn btn-success btn-sm">
                                        Isi Absensi
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">Belum ada rapat.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
