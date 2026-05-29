<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - INVORIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .card-register {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        .form-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1px solid #cccccc;
        }
        .form-control:focus {
            border-color: #044b36;
            box-shadow: 0 0 0 3px rgba(4, 75, 54, 0.1);
        }
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 20px 0;
        }
        .btn-register {
            background-color: #044b36;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background-color: #033627;
            color: white;
        }
    </style>
</head>
<body>

<div class="register-container">
    <div class="card card-register p-3">
        <div class="card-body">
            
            <div class="text-center mb-2">
                <h2 class="fw-bold m-0" style="letter-spacing: 1px;">REGISTER</h2>
                <p class="text-muted small uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Platform Inventaris Himpunan Sistem Informasi</p>
            </div>
            
            <div class="divider"></div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap Anda" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@email.com" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 characters" required>
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-secondary">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Korfirmasi Password" required>
                </div>

                <button type="submit" class="btn btn-register w-100 mb-3">
                    Register
                </button>

                <div class="divider"></div>

                <div class="text-center alternative-link">
                    <span class="text-muted small">Sudah Punya Akun? </span>
                    <a href="{{ route('login') }}" class="text-decoration-none small fw-bold text-uppercase" style="color: #044b36; border-bottom: 2px solid #044b36; padding-bottom: 2px;">Login Sini</a>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>