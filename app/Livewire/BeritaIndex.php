<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;
use App\Models\Post;

#[Lazy]
class BeritaIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('livewire.berita-index', [
            'posts' => $posts
        ]);
    }

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton-news-grid');
    }
}
