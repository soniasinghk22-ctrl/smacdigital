<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Default categories list for automatic seeding.
     */
    public const DEFAULT_CATEGORIES = [
        'Bellezza',
        'Migliore',
        'Forte',
        'Amore',
        'Spazio',
        'Giovane',
        'Lontano',
        'Italian Marble',
        'Imported Marble',
        'Exotic Quartzite',
        'Translucent Onyx',
        'Classic Travertine',
        'Italian Marble Price List',
        'White & Light Marble',
        'Beige & Cream Marble',
        'Grey & Silver Marble',
        'Black & Dark Marble',
        'Brown & Earth Tones',
        'Exotic & Rare Colors',
    ];

    /**
     * Ensure the categories table exists and has default categories seeded.
     * Prevents SQLSTATE[42S02] Table doesn't exist errors on production servers
     * where migrations may not have executed automatically.
     */
    public static function ensureTableExists(): void
    {
        try {
            if (!Schema::hasTable('categories')) {
                Schema::create('categories', function (Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('slug')->unique();
                    $table->string('type')->default('service');
                    $table->text('description')->nullable();
                    $table->boolean('status')->default(true);
                    $table->integer('sort_order')->default(0);
                    $table->timestamps();
                });

                $order = 1;
                $now = now();
                foreach (self::DEFAULT_CATEGORIES as $catName) {
                    $slug = Str::slug($catName);
                    if (!DB::table('categories')->where('slug', $slug)->exists()) {
                        DB::table('categories')->insert([
                            'name' => $catName,
                            'slug' => $slug,
                            'type' => 'service',
                            'description' => "Category for {$catName}",
                            'status' => true,
                            'sort_order' => $order++,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }
                }

                // If migrations table exists, record migration so future artisan migrate won't conflict
                try {
                    if (Schema::hasTable('migrations')) {
                        $migrationName = '2026_08_02_000000_create_categories_table';
                        $batch = (DB::table('migrations')->max('batch') ?? 0) + 1;
                        if (!DB::table('migrations')->where('migration', $migrationName)->exists()) {
                            DB::table('migrations')->insert([
                                'migration' => $migrationName,
                                'batch' => $batch,
                            ]);
                        }
                    }
                } catch (\Throwable $mEx) {
                    // Ignore migration tracker error
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Category::ensureTableExists failed: ' . $e->getMessage());
        }
    }

    /**
     * Safely fetch all categories ordered by sort_order and name, self-healing if table is missing.
     */
    public static function getSafeAll(): Collection
    {
        self::ensureTableExists();

        try {
            if (Schema::hasTable('categories')) {
                return self::query()->orderBy('sort_order')->orderBy('name')->get();
            }
        } catch (\Throwable $e) {
            Log::warning('Category::getSafeAll query failed: ' . $e->getMessage());
        }

        return collect();
    }

    /**
     * Safely fetch all active categories ordered by sort_order and name.
     */
    public static function getSafeActive(): Collection
    {
        self::ensureTableExists();

        try {
            if (Schema::hasTable('categories')) {
                return self::query()->where('status', true)->orderBy('sort_order')->orderBy('name')->get();
            }
        } catch (\Throwable $e) {
            Log::warning('Category::getSafeActive query failed: ' . $e->getMessage());
        }

        return collect();
    }
}

