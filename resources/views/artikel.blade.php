@extends('layouts.app')

@section('content')

<style>
    .artikel-page { padding: 20px 120px 60px; background: var(--white); }

    .artikel-list { display: flex; flex-direction: column; gap: 20px; }

    .artikel-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px;
        background: var(--white);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s;
    }
    .artikel-card:hover { box-shadow: 0 6px 20px rgba(0,0,0,0.08); }

    .artikel-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 14px;
        font-size: 13px;
        color: var(--text-light);
    }
    .artikel-meta-date { display: flex; align-items: center; gap: 5px; }
    .artikel-meta-author { font-weight: 600; color: var(--text); }

    .artikel-body { display: flex; align-items: flex-start; gap: 20px; }

    .artikel-thumb {
        width: 160px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        display: block;
    }
    .artikel-thumb-placeholder {
        width: 160px;
        height: 100px;
        border-radius: 8px;
        background: #e8e8e8;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .artikel-info h3 {
        font-family: var(--font-serif);
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .artikel-info p {
        font-size: 14px;
        color: var(--text-light);
        line-height: 1.6;
        margin-bottom: 16px;
    }

    /* ─── MODAL OVERLAY ─── */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        justify-content: center;
        align-items: flex-start;
        overflow-y: auto;
        padding: 40px 20px;
    }
    .modal-overlay.active {
        display: flex;
    }

    /* ─── MODAL BOX ─── */
    .modal-box {
        background: var(--white);
        border-radius: 16px;
        width: 100%;
        max-width: 680px;
        padding: 32px 28px 28px;
        position: relative;
        margin: auto;
        animation: modalIn 0.25s ease;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: translateY(-20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Tombol silang */
    .modal-close-x {
        position: absolute;
        top: 16px;
        left: 16px;
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
        color: var(--text);
        line-height: 1;
        padding: 4px 8px;
        border-radius: 6px;
        transition: background 0.15s;
    }
    .modal-close-x:hover { background: #f0f0f0; }

    /* Cover gambar artikel */
    .modal-cover {
        width: 100%;
        max-height: 280px;
        object-fit: contain;
        display: block;
        margin: 24px auto 0;
        border-radius: 8px;
    }
    .modal-cover-placeholder {
        width: 100%;
        height: 200px;
        background: #eee;
        border-radius: 8px;
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 13px;
    }

    /* Meta di dalam modal */
    .modal-meta {
        margin-top: 24px;
        margin-bottom: 6px;
        font-size: 13px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .modal-author {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 16px;
    }

    /* Judul artikel di modal */
    .modal-title {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 14px;
        line-height: 1.5;
    }

    /* Isi artikel */
    .modal-content {
        font-size: 14px;
        line-height: 1.9;
        color: var(--text);
        text-align: justify;
    }
    .modal-content p { margin-bottom: 12px; }
    .modal-content ol { padding-left: 20px; margin-bottom: 12px; }
    .modal-content ol li { margin-bottom: 4px; }

    /* Tombol Tutup di bawah */
    .modal-footer { margin-top: 28px; }

    @media (max-width: 1024px) {
        .artikel-page { padding: 20px 40px 60px; }
    }
    @media (max-width: 768px) {
        .artikel-page { padding: 16px 20px 48px; }
        .artikel-body { flex-direction: column; gap: 14px; }
        .artikel-thumb, .artikel-thumb-placeholder { width: 100%; height: 180px; }
        .artikel-info h3 { font-size: 17px; }
        .modal-box { padding: 24px 18px 20px; }
        .modal-cover { max-height: 200px; }
    }
    @media (max-width: 480px) {
        .artikel-thumb, .artikel-thumb-placeholder { height: 140px; }
    }
</style>

<div class="artikel-page">
    <h1 class="page-title">Artikel</h1>

    @php
        $articles = [
            [
                'title'   => 'Daftar Nama Siswa yang Berhasil Lolos SNBP 2026',
                'excerpt' => 'Kabar membanggakan datang dari SMAN 1 Contoh. Sejumlah siswa berhasil lolos dalam Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2026 dan diterima di berbagai perguruan tinggi negeri di Indonesia.',
                'date'    => 'Sabtu, 6 Desember 2025',
                'author'  => 'Nama lengkap',
                'thumb'   => 'SNBP.png',   // gambar thumbnail di card
                'cover'   => 'SNBP.png', // gambar cover di popup (boleh sama dengan thumb)
                'isi'     => '
                    <p>Kabar membanggakan datang dari SMAN 1 Contoh. Sejumlah siswa berhasil lolos dalam Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2026 dan diterima di berbagai perguruan tinggi negeri di Indonesia.</p>
                    <p>SNBP merupakan jalur seleksi masuk perguruan tinggi negeri yang didasarkan pada prestasi akademik dan non-akademik siswa selama menempuh pendidikan di sekolah. Keberhasilan para siswa ini menjadi bukti dari kerja keras, dedikasi, serta dukungan dari para guru dan orang tua.</p>
                    <p>Pihak sekolah mengucapkan selamat kepada seluruh siswa yang telah berhasil lolos melalui jalur SNBP. Diharapkan para siswa dapat terus berprestasi dan mengharumkan nama sekolah di jenjang pendidikan yang lebih tinggi.</p>
                    <p>Berikut beberapa siswa yang berhasil lolos SNBP tahun 2026:</p>
                    <ol>
                        <li>Ilya Saruni – Universitas Indonesia – Ilmu Komunikasi</li>
                        <li>Merita Windya – Institut Pertanian Bogor – Teknologi Pangan</li>
                        <li>Wildan Nugroho – Universitas Gadjah Mada – Teknik Informatika</li>
                        <li>Putri Tatami – Universitas Padjadjaran – Manajemen</li>
                    </ol>
                    <p>Sekolah juga berharap keberhasilan ini dapat menjadi motivasi bagi siswa lainnya untuk terus belajar dengan giat dan meraih prestasi terbaik.</p>
                    <p>Sekali lagi, selamat kepada seluruh siswa yang telah berhasil lolos SNBP 2026. Semoga perjalanan akademik selanjutnya berjalan lancar dan penuh kesuksesan.</p>
                ',
            ],
            [
                'title'   => 'Daftar Nama Siswa yang Berhasil Lolos SNBP 2026',
                'excerpt' => 'Kabar membanggakan datang dari SMAN 1 Contoh. Sejumlah siswa berhasil lolos dalam Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2026 dan diterima di berbagai perguruan tinggi negeri di Indonesia.',
                'date'    => 'Sabtu, 6 Desember 2025',
                'author'  => 'Nama lengkap',
                'thumb'   => 'SNBP.png',
                'cover'   => 'SNBP.png',
                'isi'     => '<p>Isi artikel kedua di sini...</p>',
            ],
            [
                'title'   => 'Daftar Nama Siswa yang Berhasil Lolos SNBP 2026',
                'excerpt' => 'Kabar membanggakan datang dari SMAN 1 Contoh. Sejumlah siswa berhasil lolos dalam Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2026 dan diterima di berbagai perguruan tinggi negeri di Indonesia.',
                'date'    => 'Sabtu, 6 Desember 2025',
                'author'  => 'Nama lengkap',
                'thumb'   => 'SNBP.png',
                'cover'   => 'SNBP.png',
                'isi'     => '<p>Isi artikel ketiga di sini...</p>',
            ],
            [
                'title'   => 'Daftar Nama Siswa yang Berhasil Lolos SNBP 2026',
                'excerpt' => 'Kabar membanggakan datang dari SMAN 1 Contoh. Sejumlah siswa berhasil lolos dalam Seleksi Nasional Berdasarkan Prestasi (SNBP) tahun 2026 dan diterima di berbagai perguruan tinggi negeri di Indonesia.',
                'date'    => 'Sabtu, 6 Desember 2025',
                'author'  => 'Nama lengkap',
                'thumb'   => 'SNBP.png',
                'cover'   => 'SNBP.png',
                'isi'     => '<p>Isi artikel keempat di sini...</p>',
            ],
        ];
    @endphp

    <div class="artikel-list">
        @foreach($articles as $i => $article)
        <div class="artikel-card">
            <div class="artikel-meta">
                <span class="artikel-meta-date">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ $article['date'] }}
                </span>
                <span>Author: <span class="artikel-meta-author">{{ $article['author'] }}</span></span>
            </div>
            <div class="artikel-body">
                @if(file_exists(public_path('images/' . $article['thumb'])))
                    <img src="{{ asset('images/' . $article['thumb']) }}" alt="{{ $article['title'] }}" class="artikel-thumb">
                @else
                    <div class="artikel-thumb-placeholder">
                        <svg width="40" height="30" viewBox="0 0 80 50"><rect width="80" height="50" fill="#ddd"/><text x="40" y="30" text-anchor="middle" font-size="9" fill="#999">Gambar</text></svg>
                    </div>
                @endif
                <div class="artikel-info">
                    <h3>{{ $article['title'] }}</h3>
                    <p>{{ $article['excerpt'] }}</p>
                    {{-- Tombol Selengkapnya — buka modal sesuai index --}}
                    <button class="btn-teal" onclick="bukaModal({{ $i }})">Selengkapnya</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ─── MODAL POPUP ─── --}}
<div class="modal-overlay" id="modalOverlay" onclick="tutupModalJikaLuar(event)">
    <div class="modal-box" id="modalBox">

        {{-- Tombol silang --}}
        <button class="modal-close-x" onclick="tutupModal()">&#x2715;</button>

        {{-- Cover gambar --}}
        <div id="modalCover"></div>

        {{-- Meta --}}
        <div class="modal-meta" id="modalDate"></div>
        <div class="modal-author" id="modalAuthor"></div>

        {{-- Judul --}}
        <div class="modal-title" id="modalTitle"></div>

        {{-- Isi --}}
        <div class="modal-content" id="modalIsi"></div>

        {{-- Tombol Tutup --}}
        <div class="modal-footer">
            <button class="btn-teal" onclick="tutupModal()">Tutup</button>
        </div>
    </div>
</div>

<script>
    // Data artikel dari PHP ke JavaScript
    const artikelData = @json($articles);

    function bukaModal(index) {
        const a = artikelData[index];

        // Cover
        const coverEl = document.getElementById('modalCover');
        const imgPath  = '/images/' + a.cover;
        // coba load gambar, kalau gagal tampilkan placeholder
        const img = new Image();
        img.onload  = () => { coverEl.innerHTML = `<img src="${imgPath}" class="modal-cover" alt="${a.title}">`; };
        img.onerror = () => { coverEl.innerHTML = `<div class="modal-cover-placeholder">Cover tidak tersedia</div>`; };
        img.src = imgPath;

        // Meta
        document.getElementById('modalDate').innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            ${a.date}`;
        document.getElementById('modalAuthor').textContent  = 'Author: ' + a.author;
        document.getElementById('modalTitle').textContent   = a.title;
        document.getElementById('modalIsi').innerHTML       = a.isi;

        // Tampilkan overlay
        document.getElementById('modalOverlay').classList.add('active');
        document.body.style.overflow = 'hidden'; // cegah scroll background
    }

    function tutupModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Klik di luar modal box → tutup
    function tutupModalJikaLuar(event) {
        if (event.target === document.getElementById('modalOverlay')) {
            tutupModal();
        }
    }

    // Tekan Escape → tutup
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') tutupModal();
    });
</script>

@endsection