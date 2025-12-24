<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'nama_dokumen',
        'slug',
        'deskripsi',
        'cover',
        'tahun_terbit',
        'file',
        'views',
        'downloads',
        'published_at',
    ];

    protected $casts = [
        'tahun_terbit' => 'date',
        'published_at' => 'datetime',
        'views' => 'integer',
        'downloads' => 'integer',
    ];

    protected $slugSource = 'nama_dokumen';
    protected $slugField = 'slug';
}
