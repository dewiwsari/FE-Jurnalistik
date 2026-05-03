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

    /* Kosong / loading state */
    .artikel-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-light);
        font-size: 15px;
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
    .modal-overlay.active { display: flex; }

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

    .modal-meta {
        margin-top: 24px;
        margin-bottom: 6px;
        font-size: 13px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .modal-author { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 16px; }
    .modal-title  { font-size: 17px; font-weight: 700; margin-bottom: 14px; line-height: 1.5; }

    .modal-content {
        font-size: 14px;
        line-height: 1.9;
        color: var(--text);
        text-align: justify;
    }
    .modal-content p  { margin-bottom: 12px; }
    .modal-content ol { padding-left: 20px; margin-bottom: 12px; }
    .modal-content ol li { margin-bottom: 4px; }

    .modal-footer { margin-top: 28px; }

    @media (max-width: 1024px) { .artikel-page { padding: 20px 40px 60px; } }
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

    <div class="artikel-list">
        @forelse($articles as $i => $article)
        <div class="artikel-card">
            <div class="artikel-meta">
                <span class="artikel-meta-date">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{-- Ambil dari timestamps.last_update API --}}
                    {{ $article['timestamps']['last_update'] ?? '-' }}
                </span>
                <span>Author: <span class="artikel-meta-author">{{ $article['author']['name'] ?? '-' }}</span></span>
            </div>
            <div class="artikel-body">
                {{-- Thumbnail dari URL API langsung --}}
                @if(!empty($article['thumbnail']))
                    <img src="{{ $article['thumbnail'] }}" alt="{{ $article['title'] }}" class="artikel-thumb">
                @else
                    <div class="artikel-thumb-placeholder">
                        <svg width="40" height="30" viewBox="0 0 80 50"><rect width="80" height="50" fill="#ddd"/><text x="40" y="30" text-anchor="middle" font-size="9" fill="#999">Gambar</text></svg>
                    </div>
                @endif
                <div class="artikel-info">
                    <h3>{{ $article['title'] }}</h3>
                    <p>{{ $article['content_preview'] }}</p>
                    <button class="btn-teal" onclick="bukaModal({{ $i }})">Selengkapnya</button>
                </div>
            </div>
        </div>

        @empty
        {{-- Tampil jika API kosong atau gagal --}}
        <div class="artikel-empty">
            <p>Belum ada artikel yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ─── MODAL POPUP ─── --}}
<div class="modal-overlay" id="modalOverlay" onclick="tutupModalJikaLuar(event)">
    <div class="modal-box" id="modalBox">
        <button class="modal-close-x" onclick="tutupModal()">&#x2715;</button>
        <div id="modalCover"></div>
        <div class="modal-meta"   id="modalDate"></div>
        <div class="modal-author" id="modalAuthor"></div>
        <div class="modal-title"  id="modalTitle"></div>
        <div class="modal-content" id="modalIsi"></div>
        <div class="modal-footer">
            <button class="btn-teal" onclick="tutupModal()">Tutup</button>
        </div>
    </div>
</div>

<script>
    // Kirim data dari PHP (API) ke JavaScript
    const artikelData = @json($articles->values());

    function bukaModal(index) {
        const a = artikelData[index];

        // Cover — pakai thumbnail dari API (URL langsung, bukan path lokal)
        const coverEl = document.getElementById('modalCover');
        if (a.thumbnail) {
            const img = new Image();
            img.onload  = () => { coverEl.innerHTML = `<img src="${a.thumbnail}" class="modal-cover" alt="${a.title}">`; };
            img.onerror = () => { coverEl.innerHTML = `<div class="modal-cover-placeholder">Cover tidak tersedia</div>`; };
            img.src = a.thumbnail;
        } else {
            coverEl.innerHTML = `<div class="modal-cover-placeholder">Cover tidak tersedia</div>`;
        }

        // Meta
        document.getElementById('modalDate').innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
            ${a.timestamps?.last_update ?? '-'}`;

        document.getElementById('modalAuthor').textContent = 'Author: ' + (a.author?.name ?? '-');
        document.getElementById('modalTitle').textContent  = a.title;

        // Isi artikel — pakai full_content dari API
        document.getElementById('modalIsi').innerHTML = a.full_content ?? a.content_preview ?? '';

        document.getElementById('modalOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function tutupModal() {
        document.getElementById('modalOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    function tutupModalJikaLuar(event) {
        if (event.target === document.getElementById('modalOverlay')) tutupModal();
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupModal(); });
</script>

@endsection