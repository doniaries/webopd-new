<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\AgendaKegiatan;
use App\Models\Pengumuman;

class Home extends Component
{
    public function render()
    {
        $recentPosts = Post::query()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags', 'user'])
            ->latest('published_at')
            ->take(6)
            ->get();

        $agendas = AgendaKegiatan::query()
            ->where('dari_tanggal', '>=', now()->toDateString())
            ->orderBy('dari_tanggal')
            ->orderBy('waktu_mulai')
            ->take(7)
            ->get();

        $pengumuman = Pengumuman::query()
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        // Popular posts (most viewed)
        $popularPosts = Post::query()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags'])
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        $infografis = \App\Models\Infografis::where('is_active', true)
            ->oldest()
            ->get();

        return view('livewire.home', [
            'recentPosts' => $recentPosts,
            'agendas' => $agendas,
            'pengumuman' => $pengumuman,
            'popularPosts' => $popularPosts,
            'infografis' => $infografis,
            'pageTitle' => config('app.name'),
            'pageDescription' => 'Website Resmi ' . config('app.name'),
        ]);
    }
}
