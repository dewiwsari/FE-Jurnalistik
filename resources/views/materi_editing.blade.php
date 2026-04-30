@extends('layouts.app')

@section('content')

<style>
    .submateri-page { padding: 28px 80px 80px; background: var(--white); }
    .back-btn { display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: var(--text); font-size: 14px; margin-bottom: 20px; transition: color 0.2s; }
    .back-btn:hover { color: var(--teal); }
    .submateri-page h1 { font-family: var(--font-serif); font-size: 36px; font-weight: 500; margin-bottom: 32px; }
    .materi-list { display: flex; flex-direction: column; gap: 20px; }
    .materi-item { border: 1px solid var(--border); border-radius: 12px; padding: 24px; background: var(--white); box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
    .materi-item h3 { font-size: 17px; font-weight: 700; margin-bottom: 6px; }
    .materi-item .materi-desc { font-size: 14px; color: var(--text-light); margin-bottom: 14px; }
    .materi-embed { width: 460px; max-width: 100%; height: 300px; background: #d8d8d8; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 13px; overflow: hidden; }
    .materi-embed iframe { width: 100%; height: 100%; border: none; border-radius: 8px; }
    .materi-date { font-size: 12px; color: var(--text-light); margin-top: 10px; }
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

    <h1>Materi Editing</h1>

    <div class="materi-list">
        @php
            $materis = [
                ['title' => 'Pengenalan Dasar Editing', 'desc' => 'Membahas jenis kamera dan fungsi dasar kamera', 'date' => 'Sabtu, 6 Desember 2025'],
                ['title' => 'Pengenalan Dasar Editing', 'desc' => 'Membahas jenis kamera dan fungsi dasar kamera', 'date' => 'Sabtu, 6 Desember 2025'],
            ];
        @endphp

        @foreach($materis as $m)
        <div class="materi-item">
            <h3>{{ $m['title'] }}</h3>
            <p class="materi-desc">{{ $m['desc'] }}</p>
            <div class="materi-embed">
                {{-- Ganti src dengan embed Google Drive / YouTube Anda --}}
                <span>Embed Materi di Sini<br><small style="display:block;margin-top:6px;text-align:center">Ganti dengan iframe Google Drive / YouTube</small></span>
            </div>
            <p class="materi-date">Update: {{ $m['date'] }}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection