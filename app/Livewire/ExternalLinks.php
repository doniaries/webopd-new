<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExternalLink;
use Livewire\Attributes\Lazy;

#[Lazy]
class ExternalLinks extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton-sidebar');
    }
    public function render()
    {
        $links = ExternalLink::orderBy('created_at', 'desc')->get(); // Removed is_active check

        return view('livewire.external-links', [
            'links' => $links
        ]);
    }
}
