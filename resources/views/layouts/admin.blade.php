<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #2563eb;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            padding: 1rem;
            transition: transform 0.3s ease;
            z-index: 1040;
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
        }

        .content {
            flex: 1;
            padding: 2rem;
            position: relative;
            z-index: 1;
        }

        .card {
            height: auto;
        }

        /* Mobile & Tablet */
        @media(max-width: 992px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.4);
                z-index: 1030;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .content {
                padding: 1rem;
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Header -->
    <div class="d-flex align-items-center justify-content-between bg-light p-2 mb-4 shadow-sm d-lg-none">
        <button class="btn btn-primary" id="mobileToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
        <h2 class="m-0 fs-5">Dashboard Admin</h2>
    </div>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="wrapper">
        <!-- Sidebar -->
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <h4 class="text-white mb-4 text-center">
                <i class="bi bi-house-door fs-2 d-block mb-1"></i>
                Admin Dashboard
            </h4>
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('rapat.index') }}">
                <i class="bi bi-calendar-event me-2"></i> Rapat
            </a>
            <a href="{{ route('ruang.index') }}">
                <i class="bi bi-building me-2"></i> Ruang
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>


        <!-- Main Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobileToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
        });
    </script>

</body>

</html>
