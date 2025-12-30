<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class Slider extends Component
{
    public function render()
    {
        // Get featured posts for slider (following webopd_old pattern)
        $sliders = Post::where('status', 'published')
            ->where('is_featured', true)
            ->with(['tags', 'user'])
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get popular posts for overlay
        $popularPosts = Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags', 'user'])
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        return view('livewire.slider', [
            'sliders' => $sliders,
            'popularPosts' => $popularPosts,
        ]);
    }
}
