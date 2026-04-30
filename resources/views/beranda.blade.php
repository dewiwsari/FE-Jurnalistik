@extends('layouts.app')

@section('content')

<style>
    /* ─── HERO ─── */
    .hero {
        position: relative;
        width: 100%;
        height: 420px;
        overflow: hidden;
        background: #1a1a1a;
    }
    .hero-bg {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.55;
        display: block;
    }
    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.6) 40%, rgba(0,0,0,0.1));
    }
    .hero-content {
        position: absolute;
        right: 100px;
        top: 50%;
        transform: translateY(-50%);
        max-width: 420px;
        color: white;
    }
    .hero-content h1 {
        font-family: var(--font-serif);
        font-size: 28px;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 14px;
    }
    .hero-content p {
        font-size: 14px;
        line-height: 1.7;
        margin-bottom: 22px;
        opacity: 0.9;
    }

    /* ─── SHARED SECTION ─── */
    /* Urutan section di beranda:
       1. Hero          → gelap (gambar)
       2. Visi & Misi   → PUTIH
       3. Sejarah       → HIJAU (bg-light)
       4. Hasil Karya   → PUTIH
    */

    /* ─── VISI MISI — putih ─── */
    .visi-misi-section {
        padding: 60px 80px;
        background: var(--white);
    }
    .visi-misi-section h2 {
        text-align: center;
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 36px;
    }
    .visi-misi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }
    .vm-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 32px 28px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .vm-card h3 {
        font-family: var(--font-serif);
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        margin-bottom: 16px;
    }
    .vm-card p {
        font-size: 14px;
        line-height: 1.7;
        color: var(--text);
        text-align: justify;
    }
    .vm-card ol {
        padding-left: 18px;
        font-size: 14px;
        line-height: 2;
        color: var(--text);
    }

    /* ─── SEJARAH — hijau ─── */
    .sejarah-section {
        padding: 60px 80px;
        background: var(--bg-light);   /* ← hijau muda */
    }
    .sejarah-section h2 {
        text-align: center;
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 40px;
    }
    .sejarah-content {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 48px;
        align-items: center;
    }
    .sejarah-text {
        font-size: 14px;
        line-height: 1.9;
        color: var(--text);
        text-align: justify;
    }
    .sejarah-img {
        width: 100%;
        height: 260px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
    }
    .sejarah-img-placeholder {
        width: 100%;
        height: 260px;
        background: #b8cfc9;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7a9e97;
        font-size: 13px;
        text-align: center;
        line-height: 1.6;
    }

    /* ─── HASIL KARYA — putih ─── */
    .karya-section {
        padding: 60px 80px;
        background: var(--white);
    }
    .karya-section h2 {
        text-align: center;
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 36px;
    }
    .karya-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 36px;
    }
    .karya-card {
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        background: var(--white);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }
    .karya-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
    .karya-card-img-placeholder {
        width: 80px;
        min-width: 80px;
        min-height: 120px;
        background: linear-gradient(135deg, #c8d6d2 0%, #a0b8b2 100%);
        flex-shrink: 0;
    }
    .karya-card img.karya-thumb {
        width: 80px;
        min-width: 80px;
        height: 100%;
        min-height: 120px;
        object-fit: cover;
        object-position: center;
        display: block;
        flex-shrink: 0;
    }
    .karya-card-body { padding: 10px; flex: 1; min-width: 0; }
    .karya-card-body h4 { font-size: 12px; font-weight: 600; margin-bottom: 6px; line-height: 1.4; }
    .karya-card-meta { font-size: 10px; color: var(--text-light); display: flex; align-items: center; gap: 3px; margin-bottom: 4px; }
    .karya-card-link { font-size: 10px; color: var(--teal); text-decoration: none; display: flex; align-items: center; gap: 3px; margin-bottom: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .karya-card-cover { font-size: 10px; color: var(--text-light); margin-top: 2px; }
    .karya-center { text-align: center; }

    @media (max-width: 1024px) {.hero-content { right: 40px; max-width: 360px; }
        .visi-misi-section, .sejarah-section, .karya-section { padding: 48px 40px; }
        .karya-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .hero { height: 300px; }
        .hero-content { right: 20px; left: 20px; max-width: 100%; }
        .hero-content h1 { font-size: 20px; }
        .hero-content p { font-size: 13px; }
        .visi-misi-section, .sejarah-section, .karya-section { padding: 36px 20px; }
        .visi-misi-section h2, .sejarah-section h2, .karya-section h2 { font-size: 28px; margin-bottom: 24px; }
        .visi-misi-grid { grid-template-columns: 1fr; gap: 16px; }
        .sejarah-content { grid-template-columns: 1fr; gap: 24px; }
        .sejarah-img, .sejarah-img-placeholder { height: 200px; }
        .karya-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .karya-card { flex-direction: column; }
        .karya-card img.karya-thumb,
        .karya-card-img-placeholder { width: 100% !important; min-width: unset !important; height: 90px; min-height: unset !important; }
    }
    @media (max-width: 480px) {
        .karya-grid { grid-template-columns: 1fr; }
        .hero { height: 260px; }
    }
</style>

<!-- ① HERO -->
<section class="hero">
    @if(file_exists(public_path('images/bg-fotografi.png')))
        <img src="{{ asset('images/bg-fotografi.png') }}" alt="Hero" class="hero-bg">
    @else
        <img src="https://images.unsplash.com/photo-1502920514313-52581002a659?w=1200&q=80" alt="Hero" class="hero-bg">
    @endif
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Ekstrakurikuler Jurnalistik SMA Negeri 12 Depok</h1>
        <p>Wadah bagi siswa untuk mengembangkan kemampuan menulis, fotografi, dan liputan berita biografi, fotografi, dan videografi untuk menyampaikan informasi yang inspiratif dan terpercaya.</p>
        <a href="{{ route('karya') }}" class="btn-teal">Lihat karya</a>
    </div>
</section>

<!-- ② VISI & MISI — putih -->
<section class="visi-misi-section">
    <h2>Visi &amp; Misi</h2>
    <div class="visi-misi-grid">
        <div class="vm-card">
            <h3>Visi</h3>
            <p>Meningkatakan pengetahuan Jurnalistik dan membentuk karakter seorang Jurnalis profesional serta mewujudkan ekstrakulikuler yang dapat menambah wawasan baru di bidang Fotografi, Videografi, dan Editing.</p>
        </div>
        <div class="vm-card">
            <h3>Misi</h3>
            <ol>
                <li>Mencetak Jurnalis sekolah yang kompeten dan berprestasi</li>
                <li>Menjadikan ekskul Jurnalistik sebagai wadah penyebaran ilmu pengetahuan</li>
                <li>Menyiapkan kemampuan Jurnalistik siswa sebagai bekal hidup di lingkungan sekolah maupun masyarakat</li>
            </ol>
        </div>
    </div>
</section>

<!-- ③ SEJARAH — hijau muda -->
<section class="sejarah-section">
    <h2>Sejarah</h2>
    <div class="sejarah-content">
        <p class="sejarah-text">
            Ekstrakulikuler Jurnalistik adalah ekstrakurikuler yang terfokus pada bidang Fotografi, Videografi, dan Editing. Jurnalistik ini berdiri sejak tahun ajaran 2014-2015 yang di pimpin oleh Bapak Rahmat Muhammad Mp.d selaku Kepala SMAN 12 Depok serta dilatih oleh bapak Robby Z Millian (mendiang). Ekskul ini berdiri atas dasar perkembangan digital di zaman modern yang diharapkan Jurnalistik ini menjadi media digital sekolah. Sekarang ekskul jurnalistik dilatih oleh anggota terbaik Jurnalistik, yaitu Chandra Putera, Akmal Tri dan beberapa pelatih lainnya.
        </p>
        @if(file_exists(public_path('images/sejarah.png')))
            <img src="{{ asset('images/sejarah.png') }}" alt="Sejarah" class="sejarah-img">
        @else
            <div class="sejarah-img-placeholder">
                Foto Sejarah<br>
                <small>Taruh di<br>public/images/sejarah.png</small>
            </div>
        @endif
    </div>
</section>

<!-- ④ HASIL KARYA PREVIEW — putih -->
<section class="karya-section">
    <h2>Hasil Karya</h2>
    <div class="karya-grid">
        @php
            $karyas = [
                ['img' => 'karya1.png', 'judul' => 'Hunting Foto Taman Ismail Marzuki', 'tanggal' => 'Sabtu, 6 Desember 2025', 'link' => 'https://drive.google.com/file', 'cover' => 'Ilya Saruni'],
                ['img' => 'karya1.png', 'judul' => 'Hunting Foto Taman Ismail Marzuki', 'tanggal' => 'Sabtu, 6 Desember 2025', 'link' => 'https://drive.google.com/file', 'cover' => 'Ilya Saruni'],
                ['img' => 'karya1.png', 'judul' => 'Hunting Foto Taman Ismail Marzuki', 'tanggal' => 'Sabtu, 6 Desember 2025', 'link' => 'https://drive.google.com/file', 'cover' => 'Ilya Saruni'],
                ['img' => 'karya1.png', 'judul' => 'Hunting Foto Taman Ismail Marzuki', 'tanggal' => 'Sabtu, 6 Desember 2025', 'link' => 'https://drive.google.com/file', 'cover' => 'Ilya Saruni'],
            ];
        @endphp

        @foreach($karyas as $karya)
        <div class="karya-card">
            {{-- Foto di kiri --}}
            @if(file_exists(public_path('images/' . $karya['img'])))
                <img src="{{ asset('images/' . $karya['img']) }}" alt="{{ $karya['judul'] }}" class="karya-thumb" style="width:110px; min-width:110px; height:100%; min-height:120px; object-fit:cover; object-position:center; display:block; flex-shrink:0;">
            @else
                <div class="karya-card-img-placeholder" style="width:110px; min-width:110px;"></div>
            @endif

            {{-- Detail di kanan --}}
            <div class="karya-card-body">
                <h4>{{ $karya['judul'] }}</h4>
                <div class="karya-card-meta">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $karya['tanggal'] }}
                </div>
                <a href="{{ $karya['link'] }}" class="karya-card-link" target="_blank">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    {{ $karya['link'] }}
                </a>
                <p class="karya-card-cover">Cover by: {{ $karya['cover'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="karya-center">
        <a href="{{ route('karya') }}" class="btn-teal">Lihat lebih banyak</a>
    </div>
</section>

@endsection