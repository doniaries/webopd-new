<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

class GalleryIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $galleries = \App\Models\Gallery::query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('livewire.gallery-index', [
            'galleries' => $galleries
        ]);
    }
}
