<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Bukutamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #1a1a2e;
            --secondary: #16213e;
            --accent: #e94560;
            --gold: #c9a959;
            --text-dark: #1a1a2e;
            --text-light: #6b7280;
            --bg-light: #fafbfc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-light);
            min-height: 100vh;
        }

        .register-page {
            min-height: 100vh;
            display: flex;
        }

        .register-left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -30%;
            width: 80%;
            height: 150%;
            background: linear-gradient(135deg, rgba(233, 69, 96, 0.15) 0%, rgba(201, 169, 89, 0.1) 100%);
            border-radius: 50%;
            transform: rotate(-10deg);
        }

        .register-left::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -20%;
            width: 60%;
            height: 100%;
            background: linear-gradient(135deg, rgba(201, 169, 89, 0.1) 0%, rgba(233, 69, 96, 0.08) 100%);
            border-radius: 50%;
        }

        .branding {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
        }

        .brand-logo i {
            font-size: 2.5rem;
            color: var(--accent);
        }

        .brand-logo span {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
        }

        .hero-content-left {
            position: relative;
            z-index: 2;
        }

        .hero-badge-left {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(233, 69, 96, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 24px;
        }

        .hero-title-left {
            font-size: 2.8rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            margin-bottom: 24px;
        }

        .hero-description-left {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            margin-bottom: 40px;
            max-width: 450px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon i {
            color: var(--gold);
            font-size: 1.2rem;
        }

        .venue-visual {
            position: relative;
            z-index: 2;
            margin-top: 60px;
            display: flex;
            gap: 20px;
        }

        .venue-card-visual {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .venue-card-visual img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .venue-card-visual h4 {
            font-size: 1rem;
            font-weight: 600;
            color: white;
            margin-bottom: 8px;
        }

        .venue-card-visual p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .venue-card-visual-small {
            flex: 0.6;
            align-self: flex-end;
        }

        .venue-card-visual-small img {
            height: 180px;
        }

        .register-right {
            flex: 0.6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            background: white;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
        }

        .form-header {
            margin-bottom: 32px;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: 1rem;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 16px;
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(233, 69, 96, 0.1);
        }

        .form-control-custom::placeholder {
            color: #9ca3af;
        }

        .input-group-custom {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .input-icon:hover {
            color: var(--accent);
        }

        .input-with-icon {
            padding-right: 48px;
        }

        .error-message {
            color: var(--accent);
            font-size: 0.85rem;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(233, 69, 96, 0.3);
            margin-top: 12px;
        }

        .btn-register:hover {
            background: #d63651;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider-text {
            padding: 0 16px;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .login-link {
            text-align: center;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .login-link a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #d63651;
            text-decoration: underline;
        }

        .back-link {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 40px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: white;
        }

        .back-link-light {
            color: var(--text-light);
        }

        .back-link-light:hover {
            color: var(--accent);
        }

        @media (max-width: 991px) {
            .register-page {
                flex-direction: column;
            }

            .register-left {
                padding: 40px 24px;
                min-height: auto;
            }

            .brand-logo {
                margin-bottom: 32px;
            }

            .brand-logo i {
                font-size: 2rem;
            }

            .brand-logo span {
                font-size: 1.5rem;
            }

            .hero-title-left {
                font-size: 2rem;
            }

            .hero-description-left {
                font-size: 1rem;
            }

            .features-list {
                gap: 12px;
            }

            .feature-item {
                font-size: 0.9rem;
            }

            .venue-visual {
                display: none;
            }

            .register-right {
                padding: 40px 24px;
            }

            .form-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .register-left {
                padding: 32px 20px;
            }

            .hero-title-left {
                font-size: 1.8rem;
            }

            .hero-description-left {
                font-size: 0.95rem;
                margin-bottom: 28px;
            }

            .register-right {
                padding: 32px 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-control-custom {
                padding: 12px 14px;
                font-size: 0.95rem;
            }

            .btn-register {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="register-page">
        <div class="register-left">
            <div class="branding">
                <a href="/" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Beranda
                </a>

                <div class="brand-logo">
                    <i class="bi bi-building"></i>
                    <span>Bukutamu</span>
                </div>

                <div class="hero-content-left">
                    <div class="hero-badge-left">
                        <i class="bi bi-star-fill"></i>
                        Platform Reservasi Venue Terpercaya
                    </div>

                    <h1 class="hero-title-left">
                        Mulai Temukan Venue Impianmu
                    </h1>

                    <p class="hero-description-left">
                        Temukan dan reservasi venue untuk pernikahan, meeting, seminar, dan berbagai acara spesial lainnya dengan mudah dan cepat.
                    </p>

                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span>500+ Venue terverifikasi di seluruh Indonesia</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span>Proses reservasi cepat dan transparan</span>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-check-lg"></i>
                            </div>
                            <span>Dukungan customer service 24/7</span>
                        </div>
                    </div>
                </div>

                <div class="venue-visual">
                    <div class="venue-card-visual">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=400&q=80" alt="Elegant Venue">
                        <h4>Grand Ballroom</h4>
                        <p>Jakarta • Rp10.000.000/hari</p>
                    </div>
                    <div class="venue-card-visual venue-card-visual-small">
                        <img src="https://images.unsplash.com/photo-1469371670807-013ccf25f16a?w=400&q=80" alt="Garden Venue">
                        <h4>Garden Celebration</h4>
                        <p>Yogyakarta • Rp6.000.000/hari</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="register-right">
            <div class="form-card">
                <a href="/" class="back-link back-link-light d-lg-none">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Beranda
                </a>

                <div class="form-header">
                    <h2 class="form-title">Buat Akun</h2>
                    <p class="form-subtitle">Daftar sebagai customer Bukutamu</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <input type="hidden" name="redirect" value="{{ request()->query('redirect', session('register_redirect', url()->previous())) }}">

                    <div class="form-group">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group-custom">
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                class="form-control-custom input-with-icon @error('name') is-invalid @enderror" 
                                placeholder="Masukkan nama lengkap Anda"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                            >
                            <span class="input-icon">
                                <i class="bi bi-person"></i>
                            </span>
                        </div>
                        @error('name')
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group-custom">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control-custom input-with-icon @error('email') is-invalid @enderror" 
                                placeholder="Masukkan alamat email Anda"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >
                            <span class="input-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                        </div>
                        @error('email')
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group-custom">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-control-custom input-with-icon @error('password') is-invalid @enderror" 
                                placeholder="Masukkan password Anda"
                                required
                                autocomplete="new-password"
                            >
                            <span class="input-icon" onclick="togglePassword('password')">
                                <i class="bi bi-eye" id="toggle-password-icon"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-group-custom">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-control-custom input-with-icon" 
                                placeholder="Ulangi password Anda"
                                required
                                autocomplete="new-password"
                            >
                            <span class="input-icon" onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye" id="toggle-password_confirmation-icon"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-register">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <p class="login-link">
                    Sudah punya akun? <a href="{{ route('login', ['redirect' => request()->query('redirect', session('register_redirect', url()->previous()))]) }}">Masuk</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById('toggle-' + inputId + '-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
