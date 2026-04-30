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
    .mentor-grid {
        display: flex;
        justify-content: center;
        gap: 60px;
    }
    .mentor-item { text-align: center; }
    .mentor-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 12px;
        background: #ddd;
    }
    .mentor-avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #b0c4be, #8aada5);
        display: flex;
        align-items: center;
        justify-content: center;
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
    .anggota-avatar-placeholder {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        background: #c8d6d2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        overflow: hidden;
    }
    .anggota-avatar-placeholder svg { opacity: 0.5; }
    .anggota-name { font-size: 13px; color: var(--text-light); }

    @media (max-width: 1024px) {
        .mentor-section, .anggota-section { padding: 48px 40px; }
        .anggota-grid { grid-template-columns: repeat(4, 1fr); }
        .mentor-grid { gap: 40px; }
    }
    @media (max-width: 768px) {
        .mentor-section, .anggota-section { padding: 36px 20px; }
        .mentor-section h2, .anggota-section h2 { font-size: 28px; margin-bottom: 28px; }
        .mentor-grid { gap: 24px; flex-wrap: wrap; justify-content: center; }
        .anggota-grid { grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .mentor-avatar-placeholder, .mentor-avatar { width: 80px; height: 80px; }
        .anggota-avatar-placeholder { width: 70px; height: 70px; }
    }
    @media (max-width: 480px) {
        .anggota-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .anggota-avatar-placeholder { width: 60px; height: 60px; }
    }
</style>

<div class="anggota-page">

    <!-- MENTOR -->
    <section class="mentor-section">
        <h2>Mentor</h2>
        <div class="mentor-grid">
            @php
                $mentors = [
                    ['name' => 'Chandra Putera', 'img' => 'mentor1.jpg'],
                    ['name' => 'Rehan Pratama', 'img' => 'mentor2.jpg'],
                    ['name' => 'Akmal Tri', 'img' => 'mentor3.jpg'],
                ];
            @endphp
            @foreach($mentors as $mentor)
            <div class="mentor-item">
                @if(file_exists(public_path('images/' . $mentor['img'])))
                    <img src="{{ asset('images/' . $mentor['img']) }}" alt="{{ $mentor['name'] }}" class="mentor-avatar">
                @else
                    <div class="mentor-avatar-placeholder">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="#7a9e97">
                            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                        </svg>
                    </div>
                @endif
                <p class="mentor-name">{{ $mentor['name'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ANGGOTA AKTIF -->
    <section class="anggota-section">
        <h2>Anggota Aktif</h2>
        @php
            $anggota = [
                'Andi Pratama','Siti Rahmawati','Budi Santoso','Dimas Saputra','Arka Pratama','Rina Kartika',
                'Bima Saputra','Fajar Nugroho','Maya Lestari','Rina Kartika','Dita Karang','Ayu Puspita',
                'Rina Kartika','Dimas Saputra','Andi Pratama','Budi Santoso','Siti Rahmawati','Arka Pratama',
            ];
        @endphp
        <div class="anggota-grid">
            @foreach($anggota as $nama)
            <div class="anggota-item">
                <div class="anggota-avatar-placeholder">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="#7a9e97">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>
                <p class="anggota-name">{{ $nama }}</p>
            </div>
            @endforeach
        </div>
    </section>

</div>

@endsection