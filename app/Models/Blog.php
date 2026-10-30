<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'slug',
        'title',
        'category',
        'summary',
        'content',
        'image_path',
        'published_at',
        'schema_markup',
        'metatitle',
        'metadescription',
        'metakeywords',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Defensive self-healing check to ensure SEO columns exist on production.
     */
    public static function ensureSeoColumnsExist(): void
    {
        try {
            if (Schema::hasTable('blogs') && !Schema::hasColumn('blogs', 'metatitle')) {
                Schema::table('blogs', function (Blueprint $table) {
                    if (!Schema::hasColumn('blogs', 'metatitle')) {
                        $table->string('metatitle')->nullable()->after('schema_markup');
                    }
                    if (!Schema::hasColumn('blogs', 'metadescription')) {
                        $table->text('metadescription')->nullable()->after('metatitle');
                    }
                    if (!Schema::hasColumn('blogs', 'metakeywords')) {
                        $table->text('metakeywords')->nullable()->after('metadescription');
                    }
                });
            }
        } catch (\Throwable $e) {
            // Silently continue if DB not yet available
        }
    }

    protected static function booted(): void
    {
        static::ensureSeoColumnsExist();
    }
}
