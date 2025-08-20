@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <h2>Detail Rapat: {{ $rapat->judul }}</h2>
        <p>Agenda: {{ $rapat->agenda }}</p>
        <p>Ruang: {{ $rapat->ruang->nama_ruang }}</p>
        <p>Tanggal: {{ $rapat->tanggal->format('d-m-Y') }}</p>
        <p>Waktu: {{ $rapat->waktu_mulai }} - {{ $rapat->waktu_selesai }}</p>

        <a href="{{ route('absensi.index', $rapat->id) }}" class="btn btn-primary">
            Lihat Daftar Hadir
        </a>
    </div>
@endsection
