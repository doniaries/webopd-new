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
}
