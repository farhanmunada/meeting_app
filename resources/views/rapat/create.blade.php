@extends('layouts.admin')

@section('title', 'Tambah Rapat')

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

        /* Form lebih clean dengan white space */
        .form-container {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        /* Card petunjuk */
        .card-petunjuk {
            font-size: 0.875rem;
            /* small text */
            padding: 0.75rem 1rem;
        }
    </style>

    <div class="container mt-3 form-container">
        <div class="row">
            <!-- Form -->
            <div class="col-12 col-lg-7">
                <h2 class="mb-3 fw-bold text-primary text-center animate-title">Tambah Rapat</h2>

                <a href="{{ route('rapat.index') }}" class="btn btn-outline-secondary mb-3">
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
                        <form action="{{ route('rapat.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ old('judul') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="agenda" class="form-label">Agenda</label>
                                <textarea class="form-control" id="agenda" name="agenda" rows="3" required>{{ old('agenda') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ old('tanggal') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ruang_id" class="form-label">Ruang</label>
                                    <select class="form-select" id="ruang_id" name="ruang_id" required>
                                        <option value="">-- Pilih Ruang --</option>
                                        @foreach ($ruang as $r)
                                            <option value="{{ $r->id }}"
                                                {{ old('ruang_id') == $r->id ? 'selected' : '' }}>
                                                {{ $r->nama_ruang }} ({{ $r->kapasitas }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai"
                                        value="{{ old('waktu_mulai') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai"
                                        value="{{ old('waktu_selesai') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control" id="penyelenggara" name="penyelenggara"
                                    value="{{ old('penyelenggara') }}" required>
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
                        <li>Isi judul rapat dengan singkat dan jelas.</li>
                        <li>Agenda dapat dijelaskan secara ringkas.</li>
                        <li>Pilih tanggal dan waktu rapat sesuai jadwal ruang.</li>
                        <li>Pastikan memilih ruang yang tersedia.</li>
                        <li>Isi nama penyelenggara rapat dengan lengkap.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
