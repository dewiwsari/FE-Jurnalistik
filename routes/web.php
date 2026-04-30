<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryaController;

Route::get('/karya', [KaryaController::class, 'index']);

Route::get('/', function () {
    return view('beranda');
})->name('beranda'); //memberi nama route pada laravel untuk memudahkan referensi

Route::get('/anggota', function () {
    return view('anggota');
})->name('anggota');

Route::get('/artikel', function () {
    return view('artikel');
})->name('artikel');

Route::get('/materi', function () {
    return view('materi');
})->name('materi');

Route::get('/materi/fotografi', function () {
    return view('materi_fotografi');
})->name('materi.fotografi');

Route::get('/materi/videografi', function () {
    return view('materi_videografi');
})->name('materi.videografi');

Route::get('/materi/editing', function () {
    return view('materi_editing');
})->name('materi.editing');

Route::get('/karya', function () {
    return view('karya');
})->name('karya');
