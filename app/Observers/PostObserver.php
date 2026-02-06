<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->clearCache();

        // Clear specific related posts cache for this post
        Cache::forget('related_posts_' . $post->id);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearCache();
        Cache::forget('related_posts_' . $post->id);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearCache();
        Cache::forget('related_posts_' . $post->id);
    }

    /**
     * Clear global post caches.
     */
    protected function clearCache(): void
    {
        Cache::forget('home_latest_posts');
    }
}
