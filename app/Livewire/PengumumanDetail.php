<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Pengumuman;

#[Lazy]
class PengumumanDetail extends Component
{
    public Pengumuman $pengumuman;

    public function mount(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    public function render()
    {
        return view('livewire.pengumuman-detail', [
            'pengumuman' => $this->pengumuman
        ]);
    }
}
