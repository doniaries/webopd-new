<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Post;

#[Lazy]
class BeritaIndex extends Component
{
    use WithPagination;

    #[Url]
    public $tag = '';

    public function render()
    {
        $query = Post::where('status', 'published')
            ->where('published_at', '<=', now());

        if ($this->tag) {
            $query->whereHas('tags', function ($q) {
                $q->where('slug', $this->tag);
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(6);

        $tags = \App\Models\Tag::has('posts')->withCount('posts')->get();

        return view('livewire.berita-index', [
            'posts' => $posts,
            'tags' => $tags
        ]);
    }
}
