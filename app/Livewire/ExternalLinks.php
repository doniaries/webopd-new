<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExternalLink;
use Livewire\Attributes\Lazy;

#[Lazy]
class ExternalLinks extends Component
{

    public function render()
    {
        $links = \Illuminate\Support\Facades\Cache::remember('external_links', 60 * 60, function () {
            return ExternalLink::orderBy('created_at', 'desc')->get();
        });

        return view('livewire.external-links', [
            'links' => $links
        ]);
    }
}
