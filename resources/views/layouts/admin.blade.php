<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 220px;
            min-height: 100vh;
            background-color: #2563eb;
            /* biru dominan */
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .sidebar a:hover {
            background-color: #1e40af;
        }

        .sidebar .logout {
            margin-top: auto;
            /* push ke bawah */
        }

        .content {
            flex: 1;
            padding: 2rem;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-white mb-4">Admin Dashboard</h4>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('rapat.index') }}">Rapat</a>
            <a href="{{ route('ruang.index') }}">Ruang</a>
            {{-- <a href="{{ route('absensi.index') }}">Absensi</a> --}}

            <!-- Logout di pojok bawah -->
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">Logout</button>
            </form>
        </div>

        <!-- Main content -->
        <div class="content">
            {{-- @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif --}}

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
