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
}
