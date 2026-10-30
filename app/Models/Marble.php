<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marble extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'gallery',
        'description',
        'origin',
        'thickness',
        'finishes',
        'applications',
        'status',
        'metatitle',
        'metadescription',
        'metakeywords',
        'schema_markup',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the collections this marble belongs to.
     */
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_marble');
    }
}
