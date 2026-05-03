<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    $works = collect();
    try {
        $res = Http::get(env('API_BASE_URL') . '/api/works');
        if ($res->successful()) {
            $works = collect($res->json())->where('fileType', 'Fotografi')->take(4);
        }
    } catch (\Exception $e) {}
    return view('beranda', compact('works'));
})->name('beranda');

Route::get('/anggota', function () {
    $members = collect();
    try {
        $res = Http::get(env('API_BASE_URL') . '/api/members');
        if ($res->successful()) {
            $members = collect($res->json());
        }
    } catch (\Exception $e) {}
    return view('anggota', compact('members'));
})->name('anggota');

Route::get('/artikel', function () {
    $articles = collect();
    try {
        $res = Http::get(env('API_BASE_URL') . '/api/articles');
        if ($res->successful()) {
            $articles = collect($res->json()['data'] ?? []);
        }
    } catch (\Exception $e) {}
    return view('artikel', compact('articles'));
})->name('artikel');

Route::get('/materi', function () {
    $materials = collect();
    try {
        $res = Http::get(env('API_BASE_URL') . '/api/materials');
        if ($res->successful()) {
            $materials = collect($res->json());
        }
    } catch (\Exception $e) {}
    return view('materi', compact('materials'));
})->name('materi');

Route::get('/materi/fotografi', function () {
    $materiFiltered = collect();
    try {
        $res = \Illuminate\Support\Facades\Http::get(env('API_BASE_URL') . '/api/materials');
        if ($res->successful()) {
            $materiFiltered = collect($res->json())
                ->filter(fn($m) => str_contains(strtolower($m['title'] ?? ''), 'fotografi'));
        }
    } catch (\Exception $e) {}
    return view('materi_fotografi', compact('materiFiltered'));
})->name('materi.fotografi');

Route::get('/materi/videografi', function () {
    $materiFiltered = collect();
    try {
        $res = \Illuminate\Support\Facades\Http::get(env('API_BASE_URL') . '/api/materials');
        if ($res->successful()) {
            $materiFiltered = collect($res->json())
                ->filter(fn($m) => str_contains(strtolower($m['title'] ?? ''), 'videografi'));
        }
    } catch (\Exception $e) {}
    return view('materi_videografi', compact('materiFiltered'));
})->name('materi.videografi');

Route::get('/materi/editing', function () {
    $materiFiltered = collect();
    try {
        $res = \Illuminate\Support\Facades\Http::get(env('API_BASE_URL') . '/api/materials');
        if ($res->successful()) {
            $materiFiltered = collect($res->json())
                ->filter(fn($m) => str_contains(strtolower($m['title'] ?? ''), 'editing'));
        }
    } catch (\Exception $e) {}
    return view('materi_editing', compact('materiFiltered'));
})->name('materi.editing');

Route::get('/karya', function () {
    $works = collect();
    try {
        $res = Http::get(env('API_BASE_URL') . '/api/works');
        if ($res->successful()) {
            $works = collect($res->json());
        }
    } catch (\Exception $e) {}
    return view('karya', compact('works'));
})->name('karya');