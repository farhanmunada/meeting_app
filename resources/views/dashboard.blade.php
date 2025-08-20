@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <h2>Dashboard Admin</h2>
        <div class="row mt-4">
            <!-- Total Ruang -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Ruang</h5>
                        <p class="card-text fs-3">{{ $totalRuang }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Rapat -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Rapat</h5>
                        <p class="card-text fs-3">{{ $totalRapat }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Peserta -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Peserta</h5>
                        <p class="card-text fs-3">{{ $totalPeserta }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
