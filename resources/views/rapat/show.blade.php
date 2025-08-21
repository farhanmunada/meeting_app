@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <h2>Detail Rapat: {{ $rapat->judul }}</h2>
        <p>Agenda: {{ $rapat->agenda }}</p>
        <p>Ruang: {{ $rapat->ruang->nama_ruang }}</p>
        <p>Tanggal: {{ \Carbon\Carbon::parse($rapat->tanggal)->format('d-m-Y') }}</p>
        <p>Waktu: {{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</p>

        <!-- Tombol Daftar Hadir (Admin) -->
        <a href="{{ route('absensi.index', ['rapat' => $rapat->id]) }}" class="btn btn-primary mb-3">
            Lihat Daftar Hadir
        </a>

        <!-- QR Code untuk peserta -->
        <div class="mt-4">
            <h5>Scan QR Code untuk absen:</h5>
            <div>
                {!! $qrCode !!}
            </div>
        </div>
    </div>
@endsection
