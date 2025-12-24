<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExternalLink;

class ExternalLinks extends Component
{
    public function render()
    {
        $links = ExternalLink::orderBy('created_at', 'desc')->get(); // Removed is_active check

        return view('livewire.external-links', [
            'links' => $links
        ]);
    }
}
