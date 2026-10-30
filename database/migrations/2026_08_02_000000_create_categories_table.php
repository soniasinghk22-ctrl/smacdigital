<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('type')->default('service'); // service, blog, stone, etc.
                $table->text('description')->nullable();
                $table->boolean('status')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        // Prepopulate the requested categories
        $categories = [
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
            'Exotic & Rare Colors'
        ];

        $order = 1;
        $now = now();
        foreach ($categories as $catName) {
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
