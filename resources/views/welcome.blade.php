<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fb;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .login-btn {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1000;
        }

        /* Hero Section */
        .hero {
            background-color: #2563eb;
            color: white;
            border-radius: 1.5rem;
            padding: 4rem 2rem;
            text-align: center;
            margin: 4rem auto 3rem auto;
            max-width: 900px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.75rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.15rem;
            opacity: 0.9;
        }

        /* Card Rapat */
        .rapat-card {
            border-radius: 1.25rem;
            background-color: #ffffff;
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s, box-shadow 0.2s;
            padding: 1rem;
        }

        .rapat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .card-header-blue {
            background-color: #2563eb;
            color: #fff;
            font-weight: 700;
            border-radius: 1rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .card-body-content {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 0.5rem 0;
        }

        .rapat-info h6 {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .rapat-info p {
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
            color: #4b5563;
        }

        .qr-code {
            text-align: center;
            margin-top: 1rem;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.75rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 1rem;
        }

        .btn-absensi {
            background-color: #2563eb;
            color: #fff;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-absensi:hover {
            background-color: #1e40af;
            color: #fff;
        }

        .text-muted {
            color: #6b7280;
        }

        /* Grid card spacing */
        .rapat-grid {
            gap: 2rem;
        }
    </style>
</head>

<body>
    <div class="container position-relative p-0 pt-4">
        <!-- Tombol Login Admin -->
        <a href="{{ route('login') }}" class="btn btn-outline-primary fw-bold login-btn">Login Admin</a>

        <!-- Hero Section -->
        <div class="hero mt-0">
            <h1>Sistem Absensi Rapat</h1>
            <p>Silahkan scan kode qr sesuai dengan rapat yang anda ikuti</p>
        </div>

        <!-- Daftar Rapat -->
        <h4 class="text-center mb-4 fw-bold text-primary">Jadwal Rapat Terbaru</h4>

        @if ($rapatAktif->isEmpty())
            <div class="alert alert-info rounded-3 text-center">Belum ada rapat terjadwal.</div>
        @else
            <div class="row rapat-grid justify-content-center">
                @foreach ($rapatAktif->sortByDesc('tanggal') as $r)
                    <div class="col-sm-8 col-md-6 col-lg-4 d-flex">
                        <div class="card rapat-card w-100">
                            <!-- Header -->
                            <div class="card-header-blue">
                                {{ $r->judul }}
                            </div>

                            <!-- Body -->
                            <div class="card-body-content">
                                <div
                                    class="rapat-info d-flex flex-column justify-content-center align-items-center text-center">
                                    <h6>{{ $r->agenda }}</h6>
                                    <p>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</p>
                                    <p>{{ \Carbon\Carbon::parse($r->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($r->waktu_selesai)->format('H:i') }}</p>
                                    <p>Ruang: {{ $r->ruang->nama_ruang }}</p>
                                    <p>Peserta hadir: {{ $r->absensi->count() }}</p>
                                </div>
                                <div class="qr-code">
                                    {!! $r->qrCode !!}
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer">
                                <small class="text-muted">Last updated {{ $r->updated_at->diffForHumans() }}</small>
                                <a href="{{ route('absensi.create', ['rapat' => $r->id]) }}" class="btn-absensi">
                                    Isi Absensi <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
