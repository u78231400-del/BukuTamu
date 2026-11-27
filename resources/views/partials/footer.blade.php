<style>
    .footer-landing {
        background: var(--primary);
        color: white;
        padding: 60px 0 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .footer-landing .footer-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        text-decoration: none;
    }

    .footer-landing .footer-brand i {
        color: var(--accent);
        font-size: 1.3rem;
    }

    .footer-landing .footer-desc {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 0;
    }

    .footer-landing .footer-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 20px;
    }

    .footer-landing .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-landing .footer-links li {
        margin-bottom: 12px;
    }

    .footer-landing .footer-links a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .footer-landing .footer-links a:hover {
        color: var(--accent);
    }

    .footer-landing .footer-links a i {
        margin-right: 8px;
        width: 16px;
    }

    .footer-landing .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
    }

    .footer-landing .footer-contact-item i {
        color: var(--accent);
        margin-top: 3px;
        flex-shrink: 0;
    }

    .footer-landing .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 24px 0;
        margin-top: 40px;
        text-align: center;
    }

    .footer-landing .footer-copyright {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.9rem;
        margin: 0;
    }

    .footer-landing .footer-copyright a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
    }

    @media (max-width: 767px) {
        .footer-landing {
            padding: 40px 0 0;
        }

        .footer-landing .footer-brand {
            font-size: 1.3rem;
        }

        .footer-landing .footer-title {
            margin-top: 24px;
            margin-bottom: 16px;
        }
    }
</style>

<footer class="footer-landing">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('home') }}" class="footer-brand">
                    <i class="bi bi-building"></i>
                    GrandVenue
                </a>
                <p class="footer-desc">
                    GrandVenue adalah platform terpercaya untuk menemukan dan reservasi venue terbaik untuk berbagai acara Anda. Dari pernikahan hingga meeting, semuanya jadi lebih mudah.
                </p>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-title">Navigasi</h5>
                <ul class="footer-links">
                    <li><a href="/">Beranda</a></li>
                    <li><a href="{{ route('venues.index') }}">Venue</a></li>
                    <li><a href="/#cara-kerja">Cara Kerja</a></li>
                    <li><a href="/#tentang">Tentang</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-title">Akun</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="/grandvenue">Buku Tamu</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title">Kontak</h5>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>info@grandvenue.com</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>+62 21 1234 5678</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copyright">
                Copyright &copy; 2026 <a href="{{ route('home') }}">GrandVenue</a>. All rights reserved.
            </p>
        </div>
    </div>
</footer>
