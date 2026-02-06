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

    protected $casts = [
        'foto_pimpinan' => 'array',
    ];

    protected $appends = ['foto_pimpinan_url'];

    public function getFotoPimpinanUrlAttribute()
    {
        if (!$this->foto_pimpinan) {
            return null;
        }

        // Handle if it's stored as array (multiple files) or string (single file)
        $foto = is_array($this->foto_pimpinan) ? $this->foto_pimpinan[0] : $this->foto_pimpinan;

        return asset('storage/' . $foto);
    }
}
