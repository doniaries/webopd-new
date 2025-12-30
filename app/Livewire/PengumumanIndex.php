<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Models\Pengumuman;

#[Lazy]
class PengumumanIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $pengumuman = Pengumuman::where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.pengumuman-index', [
            'pengumuman' => $pengumuman
        ]);
    }
}
