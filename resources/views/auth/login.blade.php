<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - INVORIS</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            overflow-x: hidden;
        }

        /* CONTAINER */
        .split-container {
            display: flex;
            min-height: 100vh;
        }

        /* =========================
           LEFT SIDE
        ========================= */

        .left-side {

            width: 58%;

            background:
                radial-gradient(circle at top left,
                    rgba(16,185,129,.15),
                    transparent 35%),
                linear-gradient(135deg,
                    #033b2c 0%,
                    #02271d 100%);

            color: white;

            padding: 60px 70px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            clip-path: polygon(0 0, 92% 0, 84% 100%, 0% 100%);
        }

        /* BRAND */

        .brand h1 {

            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .brand p {

            font-size: 1.05rem;
            opacity: .75;
        }

        /* HERO */

        .hero-content {

            max-width: 620px;
            margin-top: -30px;
        }

        .hero-content h2 {

            font-size: 2.7rem;
            line-height: 1.35;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .highlight {

            color: #19d38a;
        }

        .hero-content p {

            font-size: 1.15rem;
            line-height: 1.8;
            opacity: .82;

            max-width: 580px;
        }

        /* ICONS */

        .features-icons {

            display: flex;
            gap: 25px;
            margin-top: 45px;
        }

        .icon-item {

            text-align: center;
            color: white;
        }

        .icon-box {

            width: 68px;
            height: 68px;

            border-radius: 18px;

            background: rgba(255,255,255,.08);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 1.8rem;

            margin-bottom: 10px;

            backdrop-filter: blur(10px);
        }

        .icon-item span {

            font-size: 1rem;
            opacity: .9;
        }

        /* =========================
           RIGHT SIDE
        ========================= */

        .right-side {

            width: 42%;
            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }

        .login-box {

            width: 100%;
            max-width: 430px;

            background: white;

            padding: 45px;

            border-radius: 28px;

            box-shadow:
                0 10px 40px rgba(0,0,0,.06);
        }

        /* LOCK ICON */

        .lock-icon-wrapper {

            width: 90px;
            height: 90px;

            border-radius: 50%;

            background: #eaf7f1;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 25px auto;
        }

        .lock-icon-wrapper i {

            font-size: 2.3rem;
            color: #f59e0b;
        }

        /* LOGIN TITLE */

        .login-title {

            font-size: 3rem;
            font-weight: 800;
            color: #0f172a;
        }

        .login-subtitle {

            color: #64748b;
            font-size: 1rem;
        }

        /* FORM */

        .form-label {

            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control {

            height: 60px;

            border-radius: 18px;

            border: 1px solid #dbe3ea;

            padding: 0 20px;

            font-size: 1rem;

            transition: .3s;
        }

        .form-control:focus {

            border-color: #10b981;

            box-shadow:
                0 0 0 5px rgba(16,185,129,.10);
        }

        /* BUTTON */

        .btn-login {

            height: 58px;

            border: none;

            border-radius: 18px;

            background:
                linear-gradient(135deg,
                    #065f46,
                    #047857);

            color: white;

            font-size: 1.1rem;
            font-weight: 700;

            transition: .3s;
        }

        .btn-login:hover {

            transform: translateY(-2px);

            opacity: .95;

            color: white;
        }

        /* ALERT */

        .alert-security {

            background: #edf9f3;

            border: none;

            border-radius: 18px;

            color: #065f46;

            padding: 18px;

            font-size: .95rem;
        }

        /* RESPONSIVE */

        @media(max-width: 992px) {

            .split-container {

                flex-direction: column;
            }

            .left-side {

                width: 100%;

                clip-path: none;

                padding: 50px 30px;
            }

            .right-side {

                width: 100%;

                padding: 30px 20px;
            }

            .hero-content h2 {

                font-size: 2.2rem;
            }

            .brand h1 {

                font-size: 2.5rem;
            }

            .features-icons {

                justify-content: center;
                flex-wrap: wrap;
            }
        }

    </style>
</head>

<body>

<div class="split-container">

    {{-- LEFT SIDE --}}
    <div class="left-side">

        {{-- BRAND --}}
        <div class="brand">

            <h1>INVORIS</h1>

            <p>
                Inventory Organization Information System
            </p>

        </div>

        {{-- HERO --}}
        <div class="hero-content">

            <h2>

                Sistem Inventaris Barang

                <span class="highlight">

                    Himpunan Mahasiswa Sistem Informasi

                </span>

            </h2>

            <p>

                Kelola inventaris organisasi secara digital,
                terstruktur, aman, dan efisien dalam
                satu platform modern berbasis web.

            </p>

            {{-- ICON --}}
            <div class="features-icons">

                <div class="icon-item">

                    <div class="icon-box">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <span>Barang</span>

                </div>

                <div class="icon-item">

                    <div class="icon-box">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>

                    <span>Pinjam</span>

                </div>

                <div class="icon-item">

                    <div class="icon-box">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                    </div>

                    <span>Laporan</span>

                </div>

                <div class="icon-item">

                    <div class="icon-box">
                        <i class="bi bi-shield-check"></i>
                    </div>

                    <span>Aman</span>

                </div>

            </div>

        </div>

    </div>

    {{-- RIGHT SIDE --}}
    <div class="right-side">

        <div class="login-box">

            {{-- HEADER --}}
            <div class="text-center mb-4">

                <div class="lock-icon-wrapper">

                    <i class="bi bi-lock-fill"></i>

                </div>

                <div class="login-title">

                    Login

                </div>

                <div class="login-subtitle">

                    Masuk untuk mengakses dashboard inventaris

                </div>

            </div>

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('login') }}">

                @csrf

                {{-- EMAIL --}}
                <div class="mb-4">

                    <label class="form-label">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Masukkan email Anda"
                           value="{{ old('email') }}"
                           required
                           autofocus>

                    @error('email')

                        <span class="invalid-feedback">

                            <strong>{{ $message }}</strong>

                        </span>

                    @enderror

                </div>

                {{-- PASSWORD --}}
                <div class="mb-4">

                    <label class="form-label">

                        Password

                    </label>

                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan password Anda"
                           required>

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="btn btn-login w-100 mb-4">

                    Login Sekarang

                </button>

                {{-- REGISTER --}}
                <div class="text-center mb-4">

                    <span class="text-muted">

                        Belum punya akun?

                    </span>

                    <a href="{{ route('register') }}"
                       class="fw-bold text-decoration-none"
                       style="color:#065f46;">

                        Daftar di sini

                    </a>

                </div>

            </form>

            {{-- ALERT --}}
            <div class="alert alert-security d-flex align-items-center">

                <i class="bi bi-shield-fill-check me-3 fs-4"></i>

                <div>

                    Sistem aman untuk pengelolaan inventaris organisasi.

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>