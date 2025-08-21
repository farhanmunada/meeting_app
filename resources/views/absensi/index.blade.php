@extends('layouts.admin')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="container my-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">Daftar Absensi</h2>
            <button class="btn btn-primary no-print" onclick="printTable()">Print</button>
        </div>

        <!-- Tabel Absensi -->
        <div class="card shadow-sm rounded-3 border-0">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="text-center">No</th>
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
                            <tr class="align-middle">
                                <td class="text-center fw-semibold">{{ $index + 1 }}</td>
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

    <style>
        /* Tabel Modern untuk Web */
        table {
            border-collapse: separate !important;
            border-spacing: 0 0.5rem;
        }

        table tbody tr {
            background: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        table thead th {
            border-bottom: none;
        }

        table tbody td {
            vertical-align: middle !important;
        }

        .fw-medium {
            font-weight: 500;
        }

        .fw-semibold {
            font-weight: 600;
        }

        .no-print {
            display: inline-block;
        }
    </style>

    <script>
        function printTable() {
            const table = document.querySelector('table');
            const currentDate = new Date();
            const formattedDate = currentDate.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });

            // Ambil judul rapat dari data blade (misal untuk 1 rapat)
            const rapatJudul = "{{ $rapat->judul ?? 'Semua Rapat' }}";

            const newWin = window.open('', '', 'width=1000,height=700');
            newWin.document.write('<html><head><title>Print Absensi</title>');
            newWin.document.write(
                '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">'
            );

            newWin.document.write(`
        <style>
            body {
                font-family: 'Inter', sans-serif;
                font-size: 12pt;
                color: #333;
                margin: 1cm;
            }

            .header {
                text-align: center;
                margin-bottom: 1rem;
            }
            .header img {
                max-height: 50px;
                margin-bottom: 0.5rem;
            }
            .header h2 {
                margin: 0;
                font-weight: 600;
            }
            .header p {
                margin: 0.25rem 0 0;
                font-size: 11pt;
            }

            table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0 0.3rem;
                margin-top: 1rem;
            }
            th, td {
                border: 1px solid #ccc;
                padding: 6px 10px;
                text-align: left;
                font-size: 11pt;
            }
            th {
                background-color: #f8f9fa;
                font-weight: 600;
            }
            tbody tr {
                background: #fff;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            }
        </style>
        `);

            newWin.document.write('</head><body>');

            // Header print
            newWin.document.write(`
            <div class="header">
                <img src="{{ asset('logo-bappeda.png') }}" alt="Logo BAPPEDA">
                <h2>Daftar Absensi: ${rapatJudul}</h2>
                <p>Tanggal Print: ${formattedDate}</p>
            </div>
        `);

            newWin.document.write(table.outerHTML);
            newWin.document.write('</body></html>');
            newWin.document.close();
            newWin.print();
        }
    </script>


@endsection
