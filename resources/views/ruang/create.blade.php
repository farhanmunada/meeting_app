@extends('layouts.admin')

@section('title', 'Tambah Ruang')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body,
        input,
        select,
        textarea,
        button {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-title {
            animation: fadeInUp 0.8s ease forwards;
        }

        .form-container {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .card-petunjuk {
            font-size: 0.875rem;
            padding: 0.75rem 1rem;
        }
    </style>

    <div class="container mt-3 form-container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <h2 class="mb-3 fw-bold text-primary text-center animate-title">Tambah Ruang</h2>

                <a href="{{ route('ruang.index') }}" class="btn btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i>
                </a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('ruang.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Ruang</label>
                                <input type="text" name="nama_ruang" class="form-control" value="{{ old('nama_ruang') }}"
                                    required>
                                @error('nama_ruang')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}"
                                    required>
                                @error('kapasitas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
                                @error('lokasi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Petunjuk / Tips -->
            <div class="col-12 col-lg-5 mt-4 mt-lg-0">
                <div class="card shadow-sm border-0 bg-light card-petunjuk">
                    <h6 class="fw-semibold">Petunjuk Pengisian</h6>
                    <ul class="mb-0 ps-3">
                        <li>Isi nama ruang dengan jelas.</li>
                        <li>Tentukan kapasitas sesuai kenyataan.</li>
                        <li>Lokasi opsional, bisa diisi untuk referensi.</li>
                        <li>Periksa data sebelum menyimpan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
