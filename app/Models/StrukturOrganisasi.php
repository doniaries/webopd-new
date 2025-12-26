<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasSlug;

    protected $table = 'struktur_organisasis';

    protected $fillable = [
        'name',
        'description',
        'pimpinan',
        'image',
        'slug',
    ];

    /**
     * The field that should be used for generating the slug.
     *
     * @var string
     */
    protected $slugSource = 'name';

    /**
     * The field where the slug is stored.
     *
     * @var string
     */
    protected $slugField = 'slug';

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
