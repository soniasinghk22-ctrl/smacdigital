<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
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
     * Get the marbles in this collection.
     */
    public function marbles()
    {
        return $this->belongsToMany(Marble::class, 'collection_marble');
    }
}
