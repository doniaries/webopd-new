<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infografis extends Model
{
    use SoftDeletes;

    protected $table = 'infografis';

    protected $fillable = [
        'judul',
        'gambar',
        'kategori',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
