@extends('layouts.admin')

@section('title', 'Edit Ruang')

@section('content')
    <h3>Edit Ruang</h3>

    <form action="{{ route('ruang.update', $ruang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Ruang</label>
            <input type="text" name="nama_ruang" class="form-control" value="{{ old('nama_ruang', $ruang->nama_ruang) }}">
            @error('nama_ruang')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $ruang->kapasitas) }}">
            @error('kapasitas')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $ruang->lokasi) }}">
            @error('lokasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
