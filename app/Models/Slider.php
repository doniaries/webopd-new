<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getTitleAttribute()
    {
        return $this->post->title ?? '';
    }

    public function getSlugAttribute()
    {
        return $this->post->slug ?? '#';
    }

    public function getFotoUtamaUrlAttribute()
    {
        // Prioritize post image
        return $this->post->foto_utama_url ?? asset('assets/img/hero-img.png');
    }

    public function getTagsAttribute()
    {
        return $this->post->tags ?? collect();
    }
}
