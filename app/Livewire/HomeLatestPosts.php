<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Post;

#[Lazy]
class HomeLatestPosts extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton-news-grid');
    }

    public function render()
    {
        $recentPosts = Post::query()
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags', 'user'])
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('livewire.home-latest-posts', [
            'recentPosts' => $recentPosts,
        ]);
    }
}
