<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnalistik SMANDAS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --teal: #2aa18a;
            --teal-dark: #1d8a74;
            --dark: #1a1a1a;
            --dark-footer: #232323;
            --text: #333;
            --text-light: #666;
            --bg-light: #d6e8e3;
            --white: #fff;
            --border: #e0e0e0;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'DM Sans', sans-serif;
        }

        body {
            font-family: var(--font-sans);
            color: var(--text);
            background: var(--white);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 60px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            flex-shrink: 0;
        }
        /* Logo sudah oval hitam — tampilkan apa adanya */
        .navbar-logo img {
            height: 52px;
            width: auto;
            object-fit: contain;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 40px;
            list-style: none;
        }

        .navbar-links a {
            text-decoration: none;
            font-size: 15px;
            font-weight: 400;
            color: var(--text);
            transition: color 0.2s;
        }
        .navbar-links a:hover { color: var(--teal); }
        .navbar-links a.active { color: var(--teal); font-weight: 600; }

        .navbar-search {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: var(--text);
            transition: color 0.2s;
            flex-shrink: 0;
        }
        .navbar-search:hover { color: var(--teal); }

        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            z-index: 300;
        }
        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--text);
            border-radius: 2px;
            transition: all 0.3s;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 72px;
            left: 0;
            right: 0;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            z-index: 199;
            padding: 16px 24px 24px;
            flex-direction: column;
            gap: 4px;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            text-decoration: none;
            font-size: 16px;
            color: var(--text);
            padding: 12px 8px;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
        }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu a:hover { color: var(--teal); }
        .mobile-menu a.active { color: var(--teal); font-weight: 600; }

        /* ─── MAIN ─── */
        main { flex: 1; }

        /* ─── FOOTER ─── */
        footer {
            background: var(--dark-footer);
            color: #ccc;
            padding: 48px 60px 32px;
            margin-top: auto;
        }

        .footer-inner {
            display: grid;
            grid-template-columns: 160px 1fr 1fr 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .footer-logo a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        .footer-logo img {
            height: 52px;
            width: auto;
            object-fit: contain;
        }

        .footer-section h4 {
            color: var(--white);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .footer-section ul { list-style: none; }
        .footer-section ul li { margin-bottom: 8px; }
        .footer-section ul li a {
            text-decoration: none;
            color: #aaa;
            font-size: 13px;
            transition: color 0.2s;
        }
        .footer-section ul li a:hover { color: var(--teal); }

        .footer-section p {
            font-size: 13px;
            color: #aaa;
            line-height: 1.6;
        }

        .footer-socials { display: flex; gap: 12px; align-items: center; }
        .footer-socials a {
            display: inline-flex;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.2s;
        }
        .footer-socials a:hover { transform: translateY(-2px); }

        /* ─── BUTTON ─── */
        .btn-teal {
            display: inline-block;
            background: var(--teal);
            color: var(--white);
            font-size: 14px;
            font-weight: 500;
            padding: 10px 22px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-teal:hover { background: var(--teal-dark); transform: translateY(-1px); }

        /* ─── PAGE TITLE ─── */
        .page-title {
            text-align: center;
            font-family: var(--font-serif);
            font-size: 42px;
            font-weight: 400;
            color: var(--dark);
            padding: 50px 0 30px;
        }

        @media (max-width: 1024px) {
            .navbar { padding: 0 32px; }
            .navbar-links { gap: 24px; }
            .footer-inner { grid-template-columns: 1fr 1fr 1fr; gap: 28px; }
            footer { padding: 40px 32px 28px; }
            .page-title { font-size: 34px; }
        }
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; height: 64px; }
            .navbar-links { display: none; }
            .navbar-search { display: none; }
            .hamburger { display: flex; }
            .navbar-logo img { height: 42px; }
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 24px; }
            .footer-logo { grid-column: 1 / -1; }
            footer { padding: 32px 20px 24px; }
            .page-title { font-size: 28px; padding: 32px 0 20px; }
            .btn-teal { font-size: 13px; padding: 9px 18px; }
        }
        @media (max-width: 480px) {
            .footer-inner { grid-template-columns: 1fr; }
            .page-title { font-size: 24px; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('beranda') }}" class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Jurnalistik SMANDAS">
    </a>

    <ul class="navbar-links">
        <li><a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda')  ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('anggota') }}" class="{{ request()->routeIs('anggota')  ? 'active' : '' }}">Anggota</a></li>
        <li><a href="{{ route('artikel') }}" class="{{ request()->routeIs('artikel')  ? 'active' : '' }}">Artikel</a></li>
        <li><a href="{{ route('materi') }}"  class="{{ request()->routeIs('materi*')  ? 'active' : '' }}">Materi</a></li>
        <li><a href="{{ route('karya') }}"   class="{{ request()->routeIs('karya')    ? 'active' : '' }}">Hasil Karya</a></li>
    </ul>

    <button class="navbar-search" aria-label="Cari">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
    </button>

    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
    <a href="{{ route('anggota') }}" class="{{ request()->routeIs('anggota') ? 'active' : '' }}">Anggota</a>
    <a href="{{ route('artikel') }}" class="{{ request()->routeIs('artikel') ? 'active' : '' }}">Artikel</a>
    <a href="{{ route('materi') }}"  class="{{ request()->routeIs('materi*') ? 'active' : '' }}">Materi</a>
    <a href="{{ route('karya') }}"   class="{{ request()->routeIs('karya')   ? 'active' : '' }}">Hasil Karya</a>
</div>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-logo">
            <a href="{{ route('beranda') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Jurnalistik SMANDAS">
            </a>
        </div>

        <div class="footer-section">
            <h4>Site Links</h4>
            <ul>
                <li><a href="{{ route('beranda') }}">Beranda</a></li>
                <li><a href="{{ route('anggota') }}">Anggota</a></li>
                <li><a href="{{ route('artikel') }}">Artikel</a></li>
                <li><a href="{{ route('materi') }}">Materi</a></li>
                <li><a href="{{ route('karya') }}">Hasil Karya</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Sosial Media</h4>
            <div class="footer-socials">
                <a href="https://www.instagram.com/jurnal_smandas" target="_blank" rel="noopener" title="Instagram">
                    <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="ig-grad" x1="0%" y1="100%" x2="100%" y2="0%">
                                <stop offset="0%"   stop-color="#f09433"/>
                                <stop offset="25%"  stop-color="#e6683c"/>
                                <stop offset="50%"  stop-color="#dc2743"/>
                                <stop offset="75%"  stop-color="#cc2366"/>
                                <stop offset="100%" stop-color="#bc1888"/>
                            </linearGradient>
                        </defs>
                        <rect width="40" height="40" rx="10" fill="url(#ig-grad)"/>
                        <rect x="12" y="12" width="16" height="16" rx="4" fill="none" stroke="white" stroke-width="2"/>
                        <circle cx="20" cy="20" r="4.5" fill="none" stroke="white" stroke-width="2"/>
                        <circle cx="26.5" cy="13.5" r="1.2" fill="white"/>
                    </svg>
                </a>
                {{-- YouTube: rasio asli 16:9 ≈ 71x40 agar tinggi sama dengan Instagram --}}
                <a href="https://youtube.com/@jurnalsmandas?si=Qrg58E46cD4mg9yi" target="_blank" rel="noopener" title="YouTube" style="width:auto; height:40px; border-radius:0;">
                    <svg width="57" height="40" viewBox="0 0 57 40" xmlns="http://www.w3.org/2000/svg">
                        <rect width="57" height="40" rx="10" fill="#FF0000"/>
                        <path d="M46.5 13.2c-.5-1.8-1.9-3.2-3.7-3.7C39.6 8.7 28.5 8.7 28.5 8.7s-11.1 0-14.3.8c-1.8.5-3.2 1.9-3.7 3.7-.8 3.2-.8 9.8-.8 9.8s0 6.6.8 9.8c.5 1.8 1.9 3.2 3.7 3.7 3.2.8 14.3.8 14.3.8s11.1 0 14.3-.8c1.8-.5 3.2-1.9 3.7-3.7.8-3.2.8-9.8.8-9.8s0-6.6-.8-9.8z" fill="#FF0000"/>
                        <polygon points="23.5,27 35.5,20 23.5,13" fill="white"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-section">
            <h4>Kontak Kami</h4>
            <a href="https://wa.me/6289650018741" target="_blank" rel="noopener"
               style="color:#aaa; font-size:13px; text-decoration:none; display:block; margin-bottom:6px; transition:color 0.2s;"
               onmouseover="this.style.color='#2aa18a'" onmouseout="this.style.color='#aaa'">
                +62 896-5001-8741
            </a>
            <a href="mailto:jurnalistiksmandas@gmail.com"
               style="color:#aaa; font-size:13px; text-decoration:none; display:block; transition:color 0.2s;"
               onmouseover="this.style.color='#2aa18a'" onmouseout="this.style.color='#aaa'">
                jurnalistiksmandas@gmail.com
            </a>
        </div>

        <div class="footer-section">
            <h4>Alamat</h4>
            <p>Jl. Raya Cipayung No.47,<br>Cipayung Jaya, Kec. Cipayung,<br>Kota Depok, Jawa Barat 16437</p>
        </div>
    </div>
</footer>

<script>
    const btn  = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mobileMenu');
    btn.addEventListener('click', () => {
        btn.classList.toggle('open');
        menu.classList.toggle('open');
    });
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            btn.classList.remove('open');
            menu.classList.remove('open');
        });
    });
</script>

</body>
</html>