<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

Route::get('/', \App\Livewire\Home::class)->name('home');

// Berita
Route::get('/berita', \App\Livewire\BeritaIndex::class)->name('berita.index');
Route::get('/berita/{post:slug}', \App\Livewire\BeritaDetail::class)->name('berita.show');

// Pengumuman
Route::get('/pengumuman', \App\Livewire\PengumumanIndex::class)->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman:slug}', \App\Livewire\PengumumanDetail::class)->name('pengumuman.show');

// Dokumen & Download
Route::get('/dokumen', \App\Livewire\DokumenIndex::class)->name('dokumen.index');

// Galeri Kegiatan
Route::get('/galeri', \App\Livewire\GalleryIndex::class)->name('galeri.index');
// Route::get('/dokumen/{slug}', function () {
//     return 'Dokumen Detail Placeholder';
// })->name('dokumen.detail');

// Agenda Kegiatan
Route::get('/agenda', \App\Livewire\AgendaKegiatan::class)->name('agenda.index');
Route::get('/agenda/{agenda:slug}', \App\Livewire\AgendaDetail::class)->name('agenda.show');

// Struktur Organisasi
Route::get('/struktur-organisasi', \App\Livewire\StrukturOrganisasi::class)->name('struktur-organisasi');

// Sambutan Pimpinan
Route::get('/sambutan-pimpinan', \App\Livewire\SambutanPimpinan::class)->name('sambutan-pimpinan');
