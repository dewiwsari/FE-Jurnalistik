@extends('layouts.app')

@section('content')

<style>
    .submateri-page { padding: 28px 80px 80px; background: var(--white); }
    .back-btn {
        display: inline-flex; align-items: center; gap: 8px;
        text-decoration: none; color: var(--text); font-size: 14px;
        margin-bottom: 20px; transition: color 0.2s;
    }
    .back-btn:hover { color: var(--teal); }
    .submateri-page h1 { font-family: var(--font-serif); font-size: 36px; font-weight: 500; margin-bottom: 32px; }

    .materi-list { display: flex; flex-direction: column; gap: 20px; }
    .materi-item {
        border: 1px solid var(--border); border-radius: 12px;
        padding: 24px; background: var(--white);
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .materi-item h3 { font-size: 17px; font-weight: 700; margin-bottom: 6px; }
    .materi-item .materi-desc { font-size: 14px; color: var(--text-light); margin-bottom: 14px; }

    .materi-drive-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--teal); color: var(--white);
        text-decoration: none; font-size: 13px; font-weight: 500;
        padding: 9px 18px; border-radius: 50px; margin-bottom: 16px;
        transition: background 0.2s;
    }
    .materi-drive-btn:hover { background: var(--teal-dark); }

    .materi-embed {
        width: 460px; max-width: 100%; height: 300px;
        border: none; border-radius: 8px; background: #f5f5f5; display: block;
    }
    .materi-date { font-size: 12px; color: var(--text-light); margin-top: 10px; }

    .materi-empty {
        text-align: center; padding: 60px 20px;
        color: var(--text-light); font-size: 15px;
    }

    @media (max-width: 1024px) { .submateri-page { padding: 24px 40px 60px; } }
    @media (max-width: 768px) {
        .submateri-page { padding: 20px 20px 48px; }
        .submateri-page h1 { font-size: 26px; margin-bottom: 20px; }
        .materi-embed { width: 100%; height: 220px; }
        .materi-item { padding: 18px; }
    }
</style>

<div class="submateri-page">
    <a href="{{ route('materi') }}" class="back-btn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
        </svg>
        Kembali
    </a>

    <h1>Materi Videografi</h1>

    <div class="materi-list">
        @forelse($materiFiltered as $m)
        <div class="materi-item">
            <h3>{{ $m['title'] }}</h3>
            <p class="materi-desc">{{ $m['description'] ?? '' }}</p>

            @if(!empty($m['googleDriveLink']))
            <a href="{{ $m['googleDriveLink'] }}" class="materi-drive-btn" target="_blank" rel="noopener">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
                Buka di Google Drive
            </a>

            <iframe
                src="{{ str_replace(['/edit', '/view'], '/preview', $m['googleDriveLink']) }}"
                class="materi-embed"
                allowfullscreen>
            </iframe>
            @endif

            <p class="materi-date">Update: {{ isset($m['updated_at']) ? \Carbon\Carbon::parse($m['updated_at'])->translatedFormat('l, d F Y') : '-' }}</p>
        </div>
        @empty
        <div class="materi-empty">
            <p>Belum ada materi videografi yang tersedia.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection