<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class BeritaIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('livewire.berita-index', [
            'posts' => $posts
        ]);
    }
}
