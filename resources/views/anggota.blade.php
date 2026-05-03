@extends('layouts.app')

@section('content')

<style>
    .anggota-page { background: var(--white); }

    /* MENTOR */
    .mentor-section {
        padding: 60px 80px 50px;
        text-align: center;
        background: var(--white);
    }
    .mentor-section h2 {
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 40px;
    }
    .mentor-grid { display: flex; justify-content: center; gap: 60px; flex-wrap: wrap; }
    .mentor-item { text-align: center; }
    .mentor-avatar {
        width: 100px; height: 100px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 12px;
    }
    .mentor-avatar-placeholder {
        width: 100px; height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #b0c4be, #8aada5);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
        overflow: hidden;
    }
    .mentor-name { font-size: 14px; color: var(--text-light); font-weight: 400; }

    /* ANGGOTA AKTIF */
    .anggota-section {
        padding: 60px 80px;
        background: var(--bg-light);
        text-align: center;
    }
    .anggota-section h2 {
        font-family: var(--font-serif);
        font-size: 38px;
        font-weight: 400;
        margin-bottom: 40px;
    }
    .anggota-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 24px 20px;
    }
    .anggota-item { text-align: center; }
    .anggota-avatar {
        width: 88px; height: 88px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 10px;
    }
    .anggota-avatar-placeholder {
        width: 88px; height: 88px;
        border-radius: 50%;
        background: #c8d6d2;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 10px;
        overflow: hidden;
    }
    .anggota-avatar-placeholder svg { opacity: 0.5; }
    .anggota-name { font-size: 13px; color: var(--text-light); }

    /* Kosong */
    .anggota-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
        font-size: 14px;
        grid-column: 1 / -1;
    }

    @media (max-width: 1024px) {
        .mentor-section, .anggota-section { padding: 48px 40px; }
        .anggota-grid { grid-template-columns: repeat(4, 1fr); }
        .mentor-grid { gap: 40px; }
    }
    @media (max-width: 768px) {
        .mentor-section, .anggota-section { padding: 36px 20px; }
        .mentor-section h2, .anggota-section h2 { font-size: 28px; margin-bottom: 28px; }
        .mentor-grid { gap: 24px; }
        .anggota-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .mentor-avatar-placeholder, .mentor-avatar { width: 80px; height: 80px; }
        .anggota-avatar-placeholder, .anggota-avatar { width: 70px; height: 70px; }
    }
    @media (max-width: 480px) {
        .anggota-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .anggota-avatar-placeholder, .anggota-avatar { width: 60px; height: 60px; }
    }
</style>

<div class="anggota-page">

    @php
        // Pisah mentor (status = 'mentor') dan anggota aktif (status = 'active' atau lainnya)
        // Sesuaikan nilai status dengan yang ada di database
        $mentors  = $members->filter(fn($m) => strtolower($m['status'] ?? '') === 'mentor');
        $aktif    = $members->filter(fn($m) => strtolower($m['status'] ?? '') !== 'mentor');
    @endphp

    <!-- MENTOR -->
    <section class="mentor-section">
        <h2>Mentor</h2>
        <div class="mentor-grid">
            @forelse($mentors as $mentor)
            <div class="mentor-item">
                @if(!empty($mentor['photo']))
                    <img src="{{ $mentor['photo'] }}" alt="{{ $mentor['fullName'] }}" class="mentor-avatar">
                @else
                    <div class="mentor-avatar-placeholder">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="#7a9e97">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </div>
                @endif
                <p class="mentor-name">{{ $mentor['fullName'] }}</p>
            </div>
            @empty
            {{-- Fallback: tampilkan mentor hardcode jika API belum ada data mentor --}}
            @foreach(['Chandra Putera', 'Rehan Pratama', 'Akmal Tri'] as $nama)
            <div class="mentor-item">
                <div class="mentor-avatar-placeholder">
                    <svg width="50" height="50" viewBox="0 0 24 24" fill="#7a9e97">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>
                <p class="mentor-name">{{ $nama }}</p>
            </div>
            @endforeach
            @endforelse
        </div>
    </section>

    <!-- ANGGOTA AKTIF -->
    <section class="anggota-section">
        <h2>Anggota Aktif</h2>
        <div class="anggota-grid">
            @forelse($aktif as $anggota)
            <div class="anggota-item">
                @if(!empty($anggota['photo']))
                    <img src="{{ $anggota['photo'] }}" alt="{{ $anggota['fullName'] }}" class="anggota-avatar">
                @else
                    <div class="anggota-avatar-placeholder">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="#7a9e97">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </div>
                @endif
                <p class="anggota-name">{{ $anggota['fullName'] }}</p>
            </div>
            @empty
            <div class="anggota-empty">Belum ada data anggota aktif.</div>
            @endforelse
        </div>
    </section>

</div>

@endsection