<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'images',
        'published_at',
    ];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'date',
    ];

    protected $slugSource = 'title';
    protected $slugField = 'slug';
}
