<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Pengumuman;

#[Lazy]
class HomePengumuman extends Component
{


    public function placeholder()
    {
        return view('livewire.skeletons.pengumuman');
    }

    public function render()
    {
        $pengumuman = Pengumuman::query()
            ->select('id', 'judul', 'slug', 'isi', 'published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('livewire.home-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
