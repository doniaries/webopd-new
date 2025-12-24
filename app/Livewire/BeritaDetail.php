<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BeritaDetail extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.berita-detail', [
            'post' => $this->post
        ]);
    }
}
