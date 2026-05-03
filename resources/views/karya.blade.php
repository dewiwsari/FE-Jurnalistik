@extends('layouts.app')

@section('content')

<style>
    /* PENGHARGAAN — putih */
    .penghargaan-section {
        padding: 60px 80px 50px;
        text-align: center;
        background: var(--white);
    }
    .penghargaan-section h2 {
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 36px;
    }
    .penghargaan-grid { display: flex; justify-content: center; gap: 24px; }
    .penghargaan-card {
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        width: 220px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .penghargaan-card:hover { transform: translateY(-3px); }
    .penghargaan-img { width: 100%; height: 160px; object-fit: cover; display: block; }
    .penghargaan-img-placeholder {
        width: 100%; height: 160px;
        background: linear-gradient(135deg, #fde8d8, #f8c4a0);
        display: flex; align-items: center; justify-content: center;
    }
    .penghargaan-body { padding: 14px; }
    .penghargaan-body h4 { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
    .penghargaan-body p  { font-size: 12px; color: var(--text-light); }

    /* SHARED KARYA */
    .karya-kategori { padding: 50px 80px; }
    .karya-kategori.fotografi  { background: var(--bg-light); }
    .karya-kategori.videografi { background: var(--white); }
    .karya-kategori.penulisan  { background: var(--bg-light); }

    .karya-kategori h2 {
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        text-align: center;
        margin-bottom: 36px;
    }

    .karya-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
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
    .karya-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }

    .karya-card img.karya-thumb {
        width: 110px;
        min-width: 110px;
        height: 100%;
        min-height: 120px;
        object-fit: cover;
        object-position: center;
        display: block;
        flex-shrink: 0;
    }
    .karya-card-img-placeholder {
        width: 110px;
        min-width: 110px;
        min-height: 120px;
        background: linear-gradient(135deg, #c8d6d2, #a0b8b2);
        flex-shrink: 0;
    }

    .karya-card-body { padding: 12px; flex: 1; min-width: 0; }
    .karya-card-body h4 { font-size: 12px; font-weight: 600; margin-bottom: 6px; line-height: 1.4; }
    .karya-meta { font-size: 10px; color: var(--text-light); display: flex; align-items: center; gap: 3px; margin-bottom: 4px; }
    .karya-link { font-size: 10px; color: var(--teal); text-decoration: none; display: flex; align-items: center; gap: 3px; margin-bottom: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .karya-cover { font-size: 10px; color: var(--text-light); }

    /* Card samping untuk fotografi */
    .karya-card.samping { display: flex; flex-direction: row; }

    /* Kosong */
    .karya-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
        font-size: 14px;
        grid-column: 1 / -1;
    }

    @media (max-width: 1024px) {
        .penghargaan-section, .karya-kategori { padding: 40px 40px; }
        .karya-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    }
    @media (max-width: 768px) {
        .penghargaan-section, .karya-kategori { padding: 32px 20px; }
        .penghargaan-section h2, .karya-kategori h2 { font-size: 28px; margin-bottom: 24px; }
        .karya-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .karya-card.samping img.karya-thumb,
        .karya-card.samping .karya-card-img-placeholder { width: 80px; min-width: 80px; }
        .penghargaan-card { width: 180px; }
    }
    @media (max-width: 480px) { .karya-grid { grid-template-columns: 1fr; } }
</style>

@php
    // Pisahkan works berdasarkan fileType dari ERD
    $fotografi  = $works->filter(fn($w) => ($w['fileType'] ?? '') === 'Fotografi');
    $videografi = $works->filter(fn($w) => ($w['fileType'] ?? '') === 'Videografi');
    $penulisan  = $works->filter(fn($w) => ($w['fileType'] ?? '') === 'Penulisan');
@endphp

<!-- PENGHARGAAN — putih -->
<section class="penghargaan-section">
    <h2>Penghargaan</h2>
    <div class="penghargaan-grid">
        <div class="penghargaan-card">
            @if(file_exists(public_path('images/penghargaan.png')))
                <img src="{{ asset('images/penghargaan.png') }}" alt="Juara Favorite" class="penghargaan-img">
            @else
                <div class="penghargaan-img-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#e07040" stroke-width="1.5">
                        <path d="M8 21l4-4 4 4M12 17V9M5 3h14l-2 6H7L5 3z"/>
                    </svg>
                </div>
            @endif
            <div class="penghargaan-body">
                <h4>Juara Favorite</h4>
                <p>Lomba Fotografi AKSI Cretasfora</p>
            </div>
        </div>
    </div>
</section>

<!-- FOTOGRAFI — hijau -->
<section class="karya-kategori fotografi">
    <h2>Fotografi</h2>
    <div class="karya-grid">
        @forelse($fotografi as $karya)
        <div class="karya-card samping">
            @if(!empty($karya['cover_image']))
                <img src="{{ $karya['cover_image'] }}" alt="{{ $karya['title'] }}" class="karya-thumb">
            @else
                <div class="karya-card-img-placeholder"></div>
            @endif
            <div class="karya-card-body">
                <h4>{{ $karya['title'] }}</h4>
                <div class="karya-meta">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ isset($karya['created_at']) ? \Carbon\Carbon::parse($karya['created_at'])->translatedFormat('l, d F Y') : '-' }}
                </div>
                <a href="{{ $karya['url'] ?? '#' }}" class="karya-link" target="_blank">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    {{ $karya['url'] ?? '-' }}
                </a>
                <p class="karya-cover">Cover by: {{ $karya['cover_by'] ?? '-' }}</p>
            </div>
        </div>
        @empty
        <div class="karya-empty">Belum ada karya fotografi.</div>
        @endforelse
    </div>
</section>

<!-- VIDEOGRAFI — putih -->
<section class="karya-kategori videografi">
    <h2>Videografi</h2>
    <div class="karya-grid">
        @forelse($videografi as $karya)
        <div class="karya-card samping">
            @if(!empty($karya['cover_image']))
                <img src="{{ $karya['cover_image'] }}" alt="{{ $karya['title'] }}" class="karya-thumb">
            @else
                <div class="karya-card-img-placeholder"></div>
            @endif
            <div class="karya-card-body">
                <h4>{{ $karya['title'] }}</h4>
                <div class="karya-meta">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ isset($karya['created_at']) ? \Carbon\Carbon::parse($karya['created_at'])->translatedFormat('l, d F Y') : '-' }}
                </div>
                <a href="{{ $karya['url'] ?? '#' }}" class="karya-link" target="_blank">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    {{ $karya['url'] ?? '-' }}
                </a>
                <p class="karya-cover">Cover by: {{ $karya['cover_by'] ?? '-' }}</p>
            </div>
        </div>
        @empty
        <div class="karya-empty">Belum ada karya videografi.</div>
        @endforelse
    </div>
</section>

<!-- PENULISAN — hijau -->
<section class="karya-kategori penulisan">
    <h2>Penulisan</h2>
    <div class="karya-grid">
        @forelse($penulisan as $karya)
        <div class="karya-card samping">
            @if(!empty($karya['cover_image']))
                <img src="{{ $karya['cover_image'] }}" alt="{{ $karya['title'] }}" class="karya-thumb">
            @else
                <div class="karya-card-img-placeholder"></div>
            @endif
            <div class="karya-card-body">
                <h4>{{ $karya['title'] }}</h4>
                <div class="karya-meta">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    {{ isset($karya['created_at']) ? \Carbon\Carbon::parse($karya['created_at'])->translatedFormat('l, d F Y') : '-' }}
                </div>
                <a href="{{ $karya['url'] ?? '#' }}" class="karya-link" target="_blank">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    {{ $karya['url'] ?? '-' }}
                </a>
                <p class="karya-cover">Cover by: {{ $karya['cover_by'] ?? '-' }}</p>
            </div>
        </div>
        @empty
        <div class="karya-empty">Belum ada karya penulisan.</div>
        @endforelse
    </div>
</section>

@endsection