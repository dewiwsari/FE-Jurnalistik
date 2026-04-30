@extends('layouts.app')

@section('content')

<style>
    .materi-page { padding: 50px 80px 80px; background: var(--white); }

    .materi-page h1 {
        font-family: var(--font-sans);
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 36px;
        color: var(--dark);
    }

    .materi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .materi-card {
        border: 1px solid var(--border);
        border-radius: 10px;
        overflow: hidden;
        background: var(--white);
        text-decoration: none;
        color: inherit;
        display: block;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .materi-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.1); }

    .materi-card-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        background: #ddd;
    }
    .materi-card-img-placeholder {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #2a2a2a 0%, #444 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .materi-card-body { padding: 16px; }
    .materi-card-body h3 { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
    .materi-card-body p { font-size: 13px; color: var(--text-light); line-height: 1.5; }

    @media (max-width: 1024px) {
        .materi-page { padding: 40px 40px 60px; }
    }
    @media (max-width: 768px) {
        .materi-page { padding: 28px 20px 48px; }
        .materi-page h1 { font-size: 26px; margin-bottom: 24px; }
        .materi-grid { grid-template-columns: 1fr; gap: 16px; }
        .materi-card-img, .materi-card-img-placeholder { height: 160px; }
    }
</style>

<div class="materi-page">
    <h1>Dashboard Materi</h1>

    <div class="materi-grid">

        <!-- Fotografi -->
        <a href="{{ route('materi.fotografi') }}" class="materi-card">
            @if(file_exists(public_path('images/cover-fotografi.jpg')))
                <img src="{{ asset('images/cover-fotografi.jpg') }}" alt="Materi Fotografi" class="materi-card-img">
            @else
                <div class="materi-card-img-placeholder">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </div>
            @endif
            <div class="materi-card-body">
                <h3>Materi Fotografi</h3>
                <p>Kumpulan Materi Fotografi - Jurnalistik SMA Negeri 2 Depok</p>
            </div>
        </a>

        <!-- Videografi -->
        <a href="{{ route('materi.videografi') }}" class="materi-card">
            @if(file_exists(public_path('images/cover-videografi.jpg')))
                <img src="{{ asset('images/cover-videografi.jpg') }}" alt="Materi Videografi" class="materi-card-img">
            @else
                <div class="materi-card-img-placeholder">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5">
                        <polygon points="23 7 16 12 23 17 23 7"/>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"/>
                    </svg>
                </div>
            @endif
            <div class="materi-card-body">
                <h3>Materi Videografi</h3>
                <p>Kumpulan Materi Videografi - Jurnalistik SMA Negeri 2 Depok</p>
            </div>
        </a>

        <!-- Editing -->
        <a href="{{ route('materi.editing') }}" class="materi-card">
            @if(file_exists(public_path('images/cover-editing.jpg')))
                <img src="{{ asset('images/cover-editing.jpg') }}" alt="Materi Editing" class="materi-card-img">
            @else
                <div class="materi-card-img-placeholder">
                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
            @endif
            <div class="materi-card-body">
                <h3>Materi Editing</h3>
                <p>Kumpulan Materi Editing - Jurnalistik SMA Negeri 2 Depok</p>
            </div>
        </a>

    </div>
</div>

@endsection