<?php

require 'C:/xampp/htdocs/smac-digital/vendor/autoload.php';
$app = require_once 'C:/xampp/htdocs/smac-digital/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

echo "== Starting MySQL Blog Replacement ==\n";

// 1. Read JSON
$jsonPath = __DIR__ . '/scraped_blogs.json';
if (!file_exists($jsonPath)) {
    die("Error: scraped_blogs.json not found!\n");
}
$blogsData = json_decode(file_get_contents($jsonPath), true);
$total = count($blogsData);
echo "Loaded {$total} blogs from scraped_blogs.json\n";

// 2. Remove all existing blog posts from backend (NO backup, as instructed)
DB::statement('SET FOREIGN_KEY_CHECKS=0;');
Blog::truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');
echo "Truncated existing blogs table. Current count: " . Blog::count() . "\n";

// 3. Ensure marketing categories exist in categories table
$categories = [
    'SEO',
    'E-Commerce & D2C',
    'Social Media Marketing',
    'Mobile App Development',
    'Web Development',
    'Content Marketing',
    'Lead Generation',
    'Google Ads & PPC',
    'Performance Marketing',
    'Digital Marketing Strategy'
];

foreach ($categories as $catName) {
    if (!Category::where('name', $catName)->exists()) {
        Category::create([
            'name' => $catName,
            'slug' => Str::slug($catName),
            'status' => true
        ]);
        echo "Created category: {$catName}\n";
    }
}

// 4. Insert all 65 blog posts into MySQL
$inserted = 0;
$reactData = [];

foreach ($blogsData as $b) {
    $blog = Blog::create([
        'title'           => $b['title'],
        'slug'            => $b['slug'],
        'category'        => $b['category'],
        'summary'         => $b['summary'],
        'content'         => $b['content'],
        'image_path'      => $b['image_path'],
        'published_at'    => $b['published_at'],
        'metatitle'       => $b['metatitle'] ?: $b['title'],
        'metadescription' => $b['metadescription'] ?: $b['summary'],
        'metakeywords'    => $b['metakeywords'] ?: $b['category'],
        'schema_markup'   => $b['schema_markup'],
    ]);

    $inserted++;

    // Prepare matching React frontend dataset
    $reactData[] = [
        'id'        => $blog->id,
        'slug'      => $b['slug'],
        'title'     => $b['title'],
        'tag'       => $b['category'],
        'excerpt'   => $b['summary'],
        'image'     => '/' . ltrim($b['image_path'], '/'),
        'date'      => substr($b['published_at'], 0, 10),
        'dateLabel' => $b['dateLabel'],
        'author'    => $b['author'] ?? 'SMAC Digital',
        'readTime'  => max(3, min(12, round(str_word_count(strip_tags($b['content'])) / 200))) . ' min read',
        'bodyHtml'  => $b['content']
    ];
}

echo "Successfully inserted {$inserted} blogs into database.\n";
echo "Verification count in DB: " . Blog::count() . "\n";

// 5. Update resources/js/data/blogsData.json for frontend synchronization
$frontendJsonPath = resource_path('js/data/blogsData.json');
file_put_contents($frontendJsonPath, json_encode($reactData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo "Synchronized {$inserted} blogs to resources/js/data/blogsData.json\n";

// 6. Clear view and application caches
\App\Providers\AppServiceProvider::clearSharedViewCache();
echo "== Blog Migration & DB Import Finished Successfully ==\n";
