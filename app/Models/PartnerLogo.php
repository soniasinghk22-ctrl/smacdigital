<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerLogo extends Model
{
    protected $table = 'partner_logos';

    protected $fillable = [
        'name',
        'logo_path',
        'website_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function getActive()
    {
        return static::where('is_active', true)->orderBy('sort_order')->get();
    }
}

