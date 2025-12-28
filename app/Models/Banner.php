<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'gambar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->gambar)) {
            return asset('assets/images/placeholder2.jpg');
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (\Illuminate\Support\Str::startsWith($this->gambar, 'storage/banners/')) {
            return asset($this->gambar);
        }

        if (\Illuminate\Support\Str::startsWith($this->gambar, 'banners/')) {
            return asset('storage/' . $this->gambar);
        }

        return asset('storage/banners/' . $this->gambar);
    }
}
