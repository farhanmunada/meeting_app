@extends('layouts.admin')

@section('title', 'Tambah Rapat')

@section('content')
    <div class="container my-4">
        <h2>Tambah Rapat</h2>
        <a href="{{ route('rapat.index') }}" class="btn btn-secondary mb-3">Kembali</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rapat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="agenda" class="form-label">Agenda</label>
                <textarea class="form-control" id="agenda" name="agenda" required>{{ old('agenda') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                    value="{{ old('waktu_mulai') }}" required>
            </div>

            <div class="mb-3">
                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                    value="{{ old('waktu_selesai') }}" required>
            </div>

            <div class="mb-3">
                <label for="ruang_id" class="form-label">Ruang</label>
                <select class="form-select" id="ruang_id" name="ruang_id" required>
                    <option value="">-- Pilih Ruang --</option>
                    @foreach ($ruang as $r)
                        <option value="{{ $r->id }}" {{ old('ruang_id') == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ruang }} ({{ $r->kapasitas }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                    value="{{ old('penyelenggara') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
