<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $slugSource = 'name';
    protected $slugField = 'slug';

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getColorAttribute()
    {
        $colors = [
            'Teknologi' => '#3b82f6', // Blue
            'Teknologi Informasi' => '#3b82f6', // Blue
            'Kesehatan' => '#ef4444', // Red
            'Pendidikan' => '#f97316', // Orange
            'Olahraga' => '#f97316', // Orange
            'Politik' => '#64748b', // Slate
            'Sosial' => '#f59e0b', // Amber
            'Lingkungan' => '#10b981', // Emerald
            'Pariwisata' => '#06b6d4', // Cyan
            'Otomotif' => '#eab308', // Yellow
            'Agama' => '#8b5cf6', // Violet
            'Pemerintahan' => '#0ea5e9', // Sky
            'Peraturan' => '#6366f1', // Indigo
        ];

        return $colors[$this->name] ?? '#6b7280'; // Default Gray
    }
}
