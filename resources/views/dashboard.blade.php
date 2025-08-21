@extends('layouts.admin')

@section('content')
    <div class="container-fluid p-0">

        <!-- Dashboard cards -->
        <div class="row g-4">
            <!-- Total Ruang -->
            <div class="col-md-4">
                <div class="card text-white border border-light rounded h-100" style="background-color: #2563eb;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title">Total Ruang</h5>
                        <div class="d-flex align-items-center mt-2 mb-1">
                            <i class="bi bi-door-closed fs-2 me-2"></i>
                            <span class="fs-3 fw-bold">{{ $totalRuang }}</span>
                        </div>
                        <small class="text-light">Jumlah ruang yang tersedia</small>
                    </div>
                </div>
            </div>

            <!-- Total Rapat -->
            <div class="col-md-4">
                <div class="card text-white border border-light rounded h-100" style="background-color: #38bdf8;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title">Total Rapat</h5>
                        <div class="d-flex align-items-center mt-2 mb-1">
                            <i class="bi bi-calendar-event fs-2 me-2"></i>
                            <span class="fs-3 fw-bold">{{ $totalRapat }}</span>
                        </div>
                        <small class="text-light">Jumlah rapat yang terjadwal</small>
                    </div>
                </div>
            </div>

            <!-- Total Peserta -->
            <div class="col-md-4">
                <div class="card text-white border border-light rounded h-100" style="background-color: #64748b;">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h5 class="card-title">Total Peserta</h5>
                        <div class="d-flex align-items-center mt-2 mb-1">
                            <i class="bi bi-people-fill fs-2 me-2"></i>
                            <span class="fs-3 fw-bold">{{ $totalPeserta }}</span>
                        </div>
                        <small class="text-light">Jumlah peserta yang terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Peserta -->
        <h3 class="mt-5 mb-3">Daftar Peserta Rapat</h3>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Rapat</th>
                        <th>Nama Peserta</th>
                        <th>Instansi</th>
                        <th>Jabatan</th>
                        <th>Kontak</th>
                        <th>Waktu Absen</th>
                    </tr>
                </thead>
                <tbody id="pesertaTable">
                    @foreach ($absensiTerbaru as $a)
                        <tr>
                            <td>{{ $a->rapat->judul }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->instansi ?? '-' }}</td>
                            <td>{{ $a->jabatan ?? '-' }}</td>
                            <td>{{ $a->kontak ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($a->waktu_absen)->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        const sidebar = document.querySelector('.sidebar');
        const mobileToggle = document.getElementById('mobileToggle');

        // Toggle sidebar mobile
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            // sembunyikan tombol toggle jika sidebar terbuka
            if (sidebar.classList.contains('show')) {
                mobileToggle.style.display = 'none';
            } else {
                mobileToggle.style.display = 'block';
            }
        });

        // tutup sidebar saat klik di luar (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                    mobileToggle.style.display = 'block';
                }
            }
        });

        // Live reload absensi setiap 3 detik
        setInterval(function() {
            fetch("{{ route('dashboard.absensi.realtime') }}")
                .then(response => response.text())
                .then(html => {
                    document.getElementById('pesertaTable').innerHTML = html;
                });
        }, 3000);

        // reset toggle saat resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
                mobileToggle.style.display = 'none';
            } else {
                mobileToggle.style.display = 'block';
            }
        });
    </script>
@endsection
