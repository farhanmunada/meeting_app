@extends('layouts.admin')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Daftar Absensi</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Instansi / Bagian</th>
                            <th>Jabatan</th>
                            <th>Kontak</th>
                            <th>Rapat</th>
                            <th>Waktu Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absensi as $index => $a)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $a->nama }}</td>
                                <td>{{ $a->instansi }}</td>
                                <td>{{ $a->jabatan ?? '-' }}</td>
                                <td>{{ $a->kontak ?? '-' }}</td>
                                <td>{{ $a->rapat->judul ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($a->waktu_absen)->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Belum ada absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
