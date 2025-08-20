@extends('layouts.admin')

@section('title', 'Tambah Ruang')

@section('content')
    <h3>Tambah Ruang</h3>

    <form action="{{ route('ruang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Ruang</label>
            <input type="text" name="nama_ruang" class="form-control" value="{{ old('nama_ruang') }}">
            @error('nama_ruang')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}">
            @error('kapasitas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
            @error('lokasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
@endsection
