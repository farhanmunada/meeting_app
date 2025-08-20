<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Sistem Absensi Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f3f6;
        }

        .navbar {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }

        .card-rapat {
            border-radius: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .card-rapat:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .btn-absensi {
            border-radius: 50px;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 shadow-sm mb-4">
        <a class="navbar-brand fw-bold" href="/">Sistem Absensi Rapat</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-outline-light fw-bold">Login Admin</a>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4 fw-bold text-primary">Daftar Rapat</h2>

        @if ($rapat->isEmpty())
            <div class="alert alert-info rounded-3">Belum ada rapat terjadwal.</div>
        @else
            <div class="row g-4">
                @foreach ($rapat as $r)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-rapat shadow-sm h-100 p-3">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $r->judul }}</h5>
                                <p class="card-text text-secondary mb-2">{{ $r->agenda }}</p>
                                <small class="text-muted mb-2">
                                    {{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }} |
                                    {{ $r->waktu_mulai }} - {{ $r->waktu_selesai }} |
                                    Ruang: {{ $r->ruang->nama_ruang }}
                                </small>
                                <!-- Jumlah peserta hadir -->
                                <p class="mb-3"><strong>Peserta hadir:</strong> {{ $r->absensi->count() }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('absensi.create', ['rapat' => $r->id]) }}"
                                        class="btn btn-primary btn-absensi w-100">Isi Absensi</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
