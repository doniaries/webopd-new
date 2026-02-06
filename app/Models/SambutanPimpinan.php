<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SambutanPimpinan extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'judul',
        'slug',
        'isi_sambutan',
        'nama_pimpinan',
        'foto_pimpinan',
    ];

    protected $slugSource = 'judul';

    protected $appends = ['foto_pimpinan_url'];

    public function getFotoPimpinanUrlAttribute()
    {
        if (!$this->foto_pimpinan) {
            return null;
        }

        return asset('storage/' . $this->foto_pimpinan);
    }
}
