<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'slug',
        'title',
        'meta_description',
        'content',
        'status',
        'schema_markup',
    ];

    protected $casts = [
        'content' => 'array',
        'status' => 'boolean',
    ];
}
