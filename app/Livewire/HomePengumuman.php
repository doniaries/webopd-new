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
        return view('livewire.placeholders.skeleton-pengumuman');
    }

    public function render()
    {
        $pengumuman = Pengumuman::query()
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('livewire.home-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
