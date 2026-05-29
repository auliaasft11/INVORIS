<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>INVORIS | Inventory System</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>

        :root {
            --si-dark: #0b1315;
            --si-green: #10b981;
            --si-bg: #f4f7f6;
            --si-text-muted: #94a3b8;
        }

        /* RESET */
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: var(--si-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--si-dark);
            color: #fff;
            padding: 50px 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        /* BRAND */
        .sidebar .brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            text-decoration: none;
            margin-bottom: 80px;
            display: block;
            padding-left: 10px;
        }

        .sidebar .brand span {
            color: var(--si-green);
        }

        /* MENU */
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .nav-link {
            color: var(--si-text-muted);
            padding: 14px 20px;
            border-radius: 12px;
            text-decoration: none;
            display: block;
            margin-bottom: 15px;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
        }

        .nav-link:hover {
            color: var(--si-green);
            background: rgba(16, 185, 129, 0.05);
        }

        .nav-link.active {
            background: var(--si-green) !important;
            color: #fff !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);
        }

        /* LOGOUT */
        .nav-logout-container {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* MAIN */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAV */
        .top-nav {
            background: #fff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        /* CONTENT */
        .content-padding {
            padding: 40px;
        }

        /* SWEET ALERT */
        .swal2-popup {
            border-radius: 24px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            padding: 2rem !important;
        }

        .swal2-title {
            font-weight: 800 !important;
            font-size: 1.5rem !important;
        }

        .swal2-confirm {
            border-radius: 12px !important;
            padding: 10px 24px !important;
            font-weight: 700 !important;
        }

        .swal2-cancel {
            border-radius: 12px !important;
            padding: 10px 24px !important;
            font-weight: 700 !important;
        }

    </style>

</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="brand">
            INV<span>ORIS</span>
        </a>

        {{-- MENU --}}
        <ul class="nav-menu">

            {{-- DASHBOARD --}}
            <li>

                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->is('home') ? 'active' : '' }}">

                    Dashboard

                </a>

            </li>

            {{-- DATA BARANG --}}
            <li>

                <a href="{{ route('barang.index') }}"
                   class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">

                    Data Barang

                </a>

            </li>

            {{-- PEMINJAMAN --}}
            <li>

                <a href="{{ route('peminjaman.index') }}"
                   class="nav-link {{ request()->is('peminjaman*') ? 'active' : '' }}">

                    @if(Auth::user()->role == 'admin')

                        Peminjaman

                    @else

                        Riwayat Peminjaman

                    @endif

                </a>

            </li>

        </ul>

        {{-- LOGOUT --}}
        <div class="nav-logout-container">

            <a href="{{ route('logout') }}"
               class="nav-link text-danger"
               onclick="logoutConfirm(event)">

                Keluar

            </a>

            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  class="d-none">

                @csrf

            </form>

        </div>

    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content">

        {{-- TOP NAV --}}
        <div class="top-nav">

            <div class="fw-bold text-success">

                INVORIS |

                <span class="text-muted fw-normal">
                    Inventory System
                </span>

            </div>

            <div class="d-flex align-items-center gap-3">

                <small class="text-muted">
                    {{ date('d M Y') }}
                </small>

                <div class="fw-bold small text-dark">
                    {{ Auth::user()->name ?? 'User' }}
                </div>

                <div style="
                    width: 35px;
                    height: 35px;
                    background: var(--si-dark);
                    border-radius: 50%;
                "></div>

            </div>

        </div>

        {{-- PAGE CONTENT --}}
        <div class="content-padding">

            @yield('content')

        </div>

    </div>

    {{-- BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SWEET ALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))

    <script>

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#10b981',
            background: '#ffffff',
            color: '#111827',
            timer: 2300,
            showConfirmButton: false
        });

    </script>

    @endif

    {{-- ERROR ALERT --}}
    @if(session('error'))

    <script>

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            confirmButtonColor: '#ef4444'
        });

    </script>

    @endif

    {{-- LOGOUT CONFIRM --}}
    <script>

        function logoutConfirm(event)
        {
            event.preventDefault();

            Swal.fire({
                title: 'Keluar dari akun?',
                text: 'Anda akan logout dari sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('logout-form').submit();

                }

            });
        }

    </script>

</body>

</html>