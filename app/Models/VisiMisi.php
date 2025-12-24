<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisiMisi extends Model
{
    use SoftDeletes;

    protected $table = 'visi_misis';

    protected $fillable = [
        'visi',
        'misi',
    ];
}
