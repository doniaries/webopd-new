<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

use Livewire\Attributes\Lazy;

#[Lazy]
class Slider extends Component
{
    public function placeholder()
    {
        return view('livewire.skeletons.slider');
    }

    public function render()
    {
        // Get featured posts for slider (following webopd_old pattern)
        $sliders = Post::select('id', 'title', 'slug', 'foto_utama', 'published_at', 'views', 'user_id', 'created_at')
            ->where('status', 'published')
            ->where('is_featured', true)
            ->with(['tags:id,name,slug,color', 'user:id,name'])
            ->latest('published_at')
            ->take(5)
            ->get();

        // Get popular posts for overlay
        $popularPosts = Post::select('id', 'title', 'slug', 'foto_utama', 'published_at', 'views', 'user_id', 'created_at')
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags:id,name,slug,color', 'user:id,name'])
            ->orderBy('views', 'desc')
            ->take(4)
            ->get();

        return view('livewire.slider', [
            'sliders' => $sliders,
            'popularPosts' => $popularPosts,
        ]);
    }
}
