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
        return view('livewire.skeletons.posts');
    }

    public function render()
    {
        $recentPosts = Post::query()
            ->select('id', 'title', 'slug', 'foto_utama', 'published_at', 'views', 'user_id', 'created_at')
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['tags:id,name,slug,color', 'user:id,name'])
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('livewire.home-latest-posts', [
            'recentPosts' => $recentPosts,
        ]);
    }
}
