<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'foto_utama',
        'gallery',
        'user_id',
        'status',
        'published_at',
        'views',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'gallery' => 'array',
    ];

    protected $slugSource = 'title';
    protected $slugField = 'slug';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function getFotoUtamaUrlAttribute()
    {
        if (empty($this->foto_utama)) {
            return null;
        }

        if (filter_var($this->foto_utama, FILTER_VALIDATE_URL)) {
            return $this->foto_utama;
        }

        return asset('storage/' . $this->foto_utama);
    }
}
