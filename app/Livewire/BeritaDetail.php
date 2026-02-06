<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Post;

#[Lazy]
class BeritaDetail extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;

        // Increment Views
        // Increment Views (Every Hit)
        $post->increment('views');
    }

    public function render()
    {
        $relatedPosts = \Illuminate\Support\Facades\Cache::remember('related_posts_' . $this->post->id, 60 * 60, function () {
            return Post::where('status', 'published')
                ->where('id', '!=', $this->post->id)
                ->when($this->post->category_id, function ($query) {
                    return $query->where('category_id', $this->post->category_id);
                })
                ->latest('published_at')
                ->limit(5)
                ->get();
        });

        return view('livewire.berita-detail', [
            'post' => $this->post,
            'relatedPosts' => $relatedPosts
        ]);
    }
}
