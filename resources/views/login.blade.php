<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Masuk - Bukutamu</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

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

        .login-page {
            min-height: 100vh;
            display: flex;
        }

        /* =========================
           LEFT SIDE
        ========================== */

        .login-left {
            flex: 1;
            background: linear-gradient(
                135deg,
                var(--primary) 0%,
                var(--secondary) 100%
            );

            padding: 60px;

            display: flex;
            flex-direction: column;
            justify-content: center;

            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';

            position: absolute;
            top: -50%;
            left: -30%;

            width: 80%;
            height: 150%;

            background: linear-gradient(
                135deg,
                rgba(233, 69, 96, 0.15) 0%,
                rgba(201, 169, 89, 0.1) 100%
            );

            border-radius: 50%;
            transform: rotate(-10deg);
        }

        .login-left::after {
            content: '';

            position: absolute;
            bottom: -30%;
            right: -20%;

            width: 60%;
            height: 100%;

            background: linear-gradient(
                135deg,
                rgba(201, 169, 89, 0.1) 0%,
                rgba(233, 69, 96, 0.08) 100%
            );

            border-radius: 50%;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            color: rgba(255, 255, 255, 0.7);

            text-decoration: none;

            font-size: 0.9rem;

            margin-bottom: 40px;

            transition: 0.3s;
        }

        .back-link:hover {
            color: white;
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

        .hero-badge {
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

        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;

            color: white;

            line-height: 1.2;

            margin-bottom: 24px;
        }

        .hero-description {
            font-size: 1.1rem;

            color: rgba(255, 255, 255, 0.8);

            line-height: 1.8;

            max-width: 450px;

            margin-bottom: 40px;
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

        /* =========================
           RIGHT SIDE
        ========================== */

        .login-right {
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

        .input-group-custom {
            position: relative;
        }

        .form-control-custom {
            width: 100%;

            padding: 14px 48px 14px 16px;

            font-size: 1rem;

            font-family: 'Plus Jakarta Sans', sans-serif;

            border: 2px solid #e5e7eb;

            border-radius: 12px;

            background: white;

            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            outline: none;

            border-color: var(--accent);

            box-shadow: 0 0 0 4px rgba(233, 69, 96, 0.1);
        }

        .form-control-custom::placeholder {
            color: #9ca3af;
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

        .error-message {
            color: var(--accent);

            font-size: 0.85rem;

            margin-top: 6px;

            display: flex;

            align-items: center;

            gap: 6px;
        }

        .success-message {
            padding: 12px 16px;

            background: #ecfdf5;

            color: #047857;

            border-left: 3px solid #10b981;

            border-radius: 8px;

            font-size: 0.9rem;

            margin-bottom: 20px;
        }

        .btn-login {
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

        .btn-login:hover {
            background: #d63651;

            transform: translateY(-2px);

            box-shadow: 0 6px 20px rgba(233, 69, 96, 0.4);
        }

        .btn-login:active {
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

        .register-link {
            text-align: center;

            color: var(--text-light);

            font-size: 0.95rem;
        }

        .register-link a {
            color: var(--accent);

            font-weight: 600;

            text-decoration: none;

            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #d63651;

            text-decoration: underline;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 991px) {

            .login-page {
                flex-direction: column;
            }

            .login-left {
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

            .hero-title {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .login-right {
                padding: 40px 24px;
            }

            .form-card {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {

            .login-left {
                padding: 32px 20px;
            }

            .hero-title {
                font-size: 1.8rem;
            }

            .hero-description {
                font-size: 0.95rem;

                margin-bottom: 28px;
            }

            .login-right {
                padding: 32px 20px;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-control-custom {
                padding: 12px 44px 12px 14px;

                font-size: 0.95rem;
            }

            .btn-login {
                padding: 14px;
            }
        }
    </style>
</head>

<body>

<div class="login-page">

    <!-- LEFT -->
    <div class="login-left">

        <div class="left-content">

            <a href="/" class="back-link">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Beranda
            </a>

            <div class="brand-logo">
                <i class="bi bi-building"></i>
                <span>Bukutamu</span>
            </div>

            <div class="hero-badge">
                <i class="bi bi-star-fill"></i>
                Platform Reservasi Venue Terpercaya
            </div>

            <h1 class="hero-title">
                Selamat Datang Kembali
            </h1>

            <p class="hero-description">
                Masuk ke akun Bukutamu dan temukan venue terbaik
                untuk berbagai kebutuhan acara kamu.
            </p>

            <div class="features-list">

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <span>
                        500+ Venue terverifikasi di seluruh Indonesia
                    </span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <span>
                        Proses reservasi cepat dan transparan
                    </span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-check-lg"></i>
                    </div>

                    <span>
                        Kelola reservasi dengan mudah
                    </span>
                </div>

            </div>

        </div>

    </div>


    <!-- RIGHT -->
    <div class="login-right">

        <div class="form-card">

            <a href="/" class="back-link"
               style="color: var(--text-light); margin-bottom: 24px;">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Beranda
            </a>

            <div class="form-header">

                <h2 class="form-title">
                    Masuk ke Akun
                </h2>

                <p class="form-subtitle">
                    Selamat datang kembali di Bukutamu
                </p>

            </div>


            @if(session('status'))

                <div class="success-message">
                    <i class="bi bi-check-circle"></i>
                    {{ session('status') }}
                </div>

            @endif


            <form method="POST" action="{{ route('login') }}">

                @csrf

                <input type="hidden" name="redirect" value="{{ request()->query('redirect', session('login_redirect', url()->previous())) }}">

                <!-- EMAIL -->
                <div class="form-group">

                    <label for="email" class="form-label">
                        Email
                    </label>

                    <div class="input-group-custom">

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-custom @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Masukkan alamat email Anda"
                            required
                            autofocus
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


                <!-- PASSWORD -->
                <div class="form-group">

                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-group-custom">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-custom @error('password') is-invalid @enderror"
                            placeholder="Masukkan password Anda"
                            required
                            autocomplete="current-password"
                        >

                        <span
                            class="input-icon"
                            onclick="togglePassword()"
                        >
                            <i class="bi bi-eye" id="password-icon"></i>
                        </span>

                    </div>

                    @error('password')

                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <!-- BUTTON -->
                <button type="submit" class="btn-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    Masuk

                </button>

            </form>


            <div class="divider">

                <div class="divider-line"></div>

                <span class="divider-text">
                    atau
                </span>

                <div class="divider-line"></div>

            </div>


            <p class="register-link">

                Belum punya akun?

                <a href="{{ route('register', ['redirect' => request()->query('redirect', session('login_redirect', url()->previous()))]) }}">
                    Daftar sekarang
                </a>

            </p>

        </div>

    </div>

</div>


<script>

    function togglePassword() {

        const password = document.getElementById('password');
        const icon = document.getElementById('password-icon');

        if (password.type === 'password') {

            password.type = 'text';

            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');

        } else {

            password.type = 'password';

            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');

        }

    }

</script>

</body>
</html>