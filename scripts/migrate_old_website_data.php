<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Marble;
use App\Models\Collection;
use App\Models\CmsPage;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

echo "=== STARTING OLD WEBSITE DATA MIGRATION ===\n\n";

$oldPdo = new PDO("mysql:host=127.0.0.1;dbname=stonehub_old", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// -------------------------------------------------------------
// 1. SYNC & ALIGN COLLECTIONS / CATEGORIES
// -------------------------------------------------------------
echo "1. Syncing Collections and Categories...\n";

$collectionDefinitions = [
    // Core Stone Types
    'imported-marble' => [
        'name' => 'Imported Marble',
        'image' => 'uploads/collection/imported_marble_grand_foyer.jpg',
        'description' => 'Stone Hub India brings the finest imported marble slabs directly from world-renowned quarries across Italy, Spain, Turkey, Greece, and Brazil.',
        'metatitle' => 'Imported Marble in Kishangarh & Delhi | Stone Hub India',
        'metadescription' => 'Explore the finest collection of imported marble in India. Premium grade marble slabs with bespoke finishes at competitive prices.',
        'metakeywords' => 'imported marble, luxury imported marble, italian imported stone, kishangarh marble suppliers'
    ],
    'italian-marble' => [
        'name' => 'Italian Marble',
        'image' => 'uploads/collection/italian_marble_statuario_salon.jpg',
        'description' => 'Hand-quarried in the historic stone regions of Italy, including Carrara and Tuscany, our Italian marble collection offers unmatched prestige and natural elegance.',
        'metatitle' => 'Italian Marble Supplier in India | Stone Hub India',
        'metadescription' => 'Discover world-class Italian marble slabs in Kishangarh. Genuine Statuario, Botticino, Calacatta, and exotic Italian stone varieties.',
        'metakeywords' => 'italian marble, statuario marble, carrara marble, italian marble prices'
    ],
    'onyx' => [
        'name' => 'Translucent Onyx',
        'image' => 'uploads/collection/translucent_onyx_backlit_lounge.jpg',
        'description' => 'Rare translucent onyx slabs ideal for backlit feature walls, luxury bars, bathroom vanities, and high-end statement architectural installations.',
        'metatitle' => 'Translucent Onyx Stone Slabs | Stone Hub India',
        'metadescription' => 'Buy premium translucent Onyx stone in India. Available in Pink, Mango, Green, Honey, and White Onyx with backlit capabilities.',
        'metakeywords' => 'onyx stone, backlit onyx, pink onyx, green onyx, luxury translucent stone'
    ],
    'travertine' => [
        'name' => 'Classic Travertine',
        'image' => 'uploads/collection/classic_travertine_villa_terrace.jpg',
        'description' => 'Naturally porous, earthy travertine stone slabs featuring linear vein-cut and cross-cut patterns for timeless Mediterranean architecture and facades.',
        'metatitle' => 'Travertine Stone Slabs & Tiles | Stone Hub India',
        'metadescription' => 'Premium Travertine marble supplier in Kishangarh. Beige, Silver, Titanium, and Roman Travertine slabs for wall cladding and exterior spaces.',
        'metakeywords' => 'travertine marble, silver travertine, beige travertine, travertine wall cladding'
    ],
    'quartzite' => [
        'name' => 'Exotic Quartzite',
        'image' => 'uploads/collection/exotic_quartzite_patagonia_island.jpg',
        'description' => 'Extremely durable and crystalline natural quartzite slabs known for dramatic veining, scratch resistance, and breathtaking interior aesthetics.',
        'metatitle' => 'Exotic Quartzite Slabs in India | Stone Hub India',
        'metadescription' => 'Explore rare Brazilian and Italian quartzites including Patagonia, Blue Roma, and Fusion. Harder than granite with marble-like luxury.',
        'metakeywords' => 'exotic quartzite, patagonia quartzite, blue roma, luxury stone countertops'
    ],
    'marble-by-collection' => [
        'name' => 'Marble by Collection',
        'image' => 'uploads/collection/marble_by_collection_gallery.jpg',
        'description' => 'Curated designer collections of imported natural stone curated specifically for high-end architects, luxury residences, and commercial developments.',
        'metatitle' => 'Designer Marble Collections | Stone Hub India',
        'metadescription' => 'Browse our curated signature collections of imported marble slabs categorized by aesthetic themes, textures, and origins.',
        'metakeywords' => 'marble collections, designer marble, signature imported stone'
    ],

    // Signature Old Collections
    'bellezza' => [
        'name' => 'Bellezza Collection',
        'image' => 'uploads/collection/bellezza_luxury_lounge.jpg',
        'description' => 'The Bellezza collection represents the pinnacle of subtle sophistication and artistic elegance, featuring deeply nuanced natural stone varieties with harmonious warm tones.',
        'metatitle' => 'Bellezza Imported Marble Collection | Stone Hub India',
        'metadescription' => 'Discover the Bellezza collection of luxury imported marbles at Stone Hub India. Exceptional quality and timeless beauty for high-end residences.',
        'metakeywords' => 'bellezza collection, imported marble, luxury stone kishangarh'
    ],
    'migliore' => [
        'name' => 'Migliore Collection',
        'image' => 'uploads/collection/migliore_grand_dining_hall.jpg',
        'description' => 'Our Migliore collection consists of highly lustrous, light-toned opulent marble slabs that enhance ambient light and elevate the visual grandeur of interior spaces.',
        'metatitle' => 'Migliore Marble Collection | Stone Hub India',
        'metadescription' => 'Top quality imported marble Migliore collection in Kishangarh Rajasthan. Luminous, elegant marble slabs for luxury floors and walls.',
        'metakeywords' => 'migliore marble, light marble, imported marble collection kishangarh'
    ],
    'forte' => [
        'name' => 'Forte Collection',
        'image' => 'uploads/collection/56911678_01_09_2021_04_43_32.webp',
        'description' => 'Forte brings an expressive blend of bold patterns, rich veining, and striking natural textures engineered by nature for dramatic modern and classical spaces.',
        'metatitle' => 'Forte Marble Collection | Stone Hub India',
        'metadescription' => 'Forte Italian and imported marble collection. Bold colors, exquisite designs, and unmatched durability for luxury villas and corporate projects.',
        'metakeywords' => 'forte marble, bold marble collection, luxury italian stone'
    ],
    'amore' => [
        'name' => 'Amore Collection',
        'image' => 'uploads/collection/79415689_16_10_2023_04_48_30.webp',
        'description' => 'Amore features warm and alluring tones with delicate crystalline quartz veining, offering an inviting and luxurious atmosphere for floors, accent walls, and vanities.',
        'metatitle' => 'Amore Imported Marble Collection | Stone Hub India',
        'metadescription' => 'Explore the Amore Collection featuring premium imported marbles like Bulgari Grey, Burberry Grey, and Ice Beige at Stone Hub India.',
        'metakeywords' => 'amore collection, amore marble, imported brown and grey marble'
    ],
    'spazio' => [
        'name' => 'Spazio Collection',
        'image' => 'uploads/collection/362685643_01_09_2021_04_45_41.webp',
        'description' => 'Spazio offers alluring imported stones primarily from Spain and Italy, known for contemporary sophistication, deep rich hues, and striking focal impact.',
        'metatitle' => 'Spazio Marble Collection | Stone Hub India',
        'metadescription' => 'Spazio marble collection of alluring imported marbles. Perfect for contemporary countertops, accent walls, and floor constructions.',
        'metakeywords' => 'spazio marble, spanish marble, imported contemporary stone'
    ],
    'lontano' => [
        'name' => 'Lontano Travertine Collection',
        'image' => 'uploads/collection/118137930_16_10_2023_04_46_53.webp',
        'description' => 'Lontano features authentic travertine stone slabs and natural earth-toned stones imported from premier global quarries, bringing organic warmth to luxury architecture.',
        'metatitle' => 'Lontano Travertine Marble Collection | Stone Hub India',
        'metadescription' => 'Lontano collection of high quality imported travertine stone and marble in Kishangarh. Wide range of beige, gold, and earthy tones.',
        'metakeywords' => 'lontano collection, travertine stone, organic natural stone'
    ],
    'giovane' => [
        'name' => 'Giovane Collection',
        'image' => 'uploads/collection/black_gold_bath_suite.jpg',
        'description' => 'Giovane highlights dramatic dark and black figurine natural stone slabs with contrasting golden and white veins, delivering bold architectural statements.',
        'metatitle' => 'Giovane Black & Dark Marble Collection | Stone Hub India',
        'metadescription' => 'Giovane collection of luxury black and dark imported marble. Outstanding durability and distinctive veining for contemporary luxury interiors.',
        'metakeywords' => 'giovane collection, black marble, dark imported stone'
    ],

    // Color/Tone Specific Categories
    'white-marble' => [
        'name' => 'White & Light Marble',
        'image' => 'uploads/collection/white_marble_statuario_feature.jpg',
        'description' => 'Pristine white imported marble slabs including Statuario, Calacatta, Carrara, and Thassos, radiating timeless purity and illumination.',
        'metatitle' => 'White Imported Marble Slabs | Stone Hub India',
        'metadescription' => 'Browse white imported marble slabs in Kishangarh. Pure white Italian marble, Statuario, Calacatta, and Greek white stone.',
        'metakeywords' => 'white marble, statuario white, calacatta gold, white italian stone'
    ],
    'beige-marble' => [
        'name' => 'Beige & Cream Marble',
        'image' => 'uploads/collection/migliore_grand_dining_hall.jpg',
        'description' => 'Warm beige, cream, and champagne marble slabs offering subtle elegance, soothing warmth, and versatility for residential and commercial flooring.',
        'metatitle' => 'Beige & Cream Imported Marble | Stone Hub India',
        'metadescription' => 'Explore imported beige and cream marble slabs including Botticino, Crema Marfil, Dyna, and Armani Beige at Stone Hub India.',
        'metakeywords' => 'beige marble, cream marble, botticino marble, dyna marble'
    ],
    'black-marble' => [
        'name' => 'Black & Dark Marble',
        'image' => 'uploads/collection/black_gold_bath_suite.jpg',
        'description' => 'Bold black and deep charcoal imported marble featuring dramatic golden, white, and bronze veining for statement walls and modern accents.',
        'metatitle' => 'Black & Dark Exotic Marble | Stone Hub India',
        'metadescription' => 'Discover black imported marble slabs including Black Marquina, Black Gold, Portoro, and Black River at Stone Hub India.',
        'metakeywords' => 'black marble, black marquina, black gold marble, portoro marble'
    ],
    'grey-marble' => [
        'name' => 'Grey & Silver Marble',
        'image' => 'uploads/collection/56911678_01_09_2021_04_43_32.webp',
        'description' => 'Contemporary grey and silver imported marble varieties providing sleek minimalism, intricate veining, and modern architectural aesthetics.',
        'metatitle' => 'Grey & Silver Imported Marble | Stone Hub India',
        'metadescription' => 'Premium grey and silver imported marble slabs including Armani Grey, Bulgari Grey, Alaska Grey, and Silver Shadow.',
        'metakeywords' => 'grey marble, silver marble, armani grey, bulgari grey'
    ],
    'brown-marble' => [
        'name' => 'Brown & Earth Tone Marble',
        'image' => 'uploads/collection/brown_earth_marble_living.jpg',
        'description' => 'Rich chocolate, coffee, and mocha brown natural marble slabs accented with golden and cream crystalline veins.',
        'metatitle' => 'Brown & Earth Tone Marble Slabs | Stone Hub India',
        'metadescription' => 'Luxury brown imported marble slabs including African Brown, Armani Brown, and Bronze Amani at Stone Hub India.',
        'metakeywords' => 'brown marble, african brown, armani brown marble'
    ],
    'exotic-colored-marble' => [
        'name' => 'Exotic & Rare Color Marble',
        'image' => 'uploads/collection/pink_onyx_bar_lounge.jpg',
        'description' => 'Rare and striking natural stones in captivating shades of blue, green, pink, red, and multi-color for bespoke luxury architectural projects.',
        'metatitle' => 'Exotic & Rare Color Stone Slabs | Stone Hub India',
        'metadescription' => 'Rare colored natural stone slabs including Blue Lagoon, Pink Onyx, Red Levanto, and Emerald Green at Stone Hub India.',
        'metakeywords' => 'exotic marble, blue marble, pink onyx, rare stone slabs'
    ]
];

$collectionMap = []; // slug => Collection model
foreach ($collectionDefinitions as $slug => $data) {
    // Check if image exists locally or fallback
    $imgPath = $data['image'];
    if (!file_exists(public_path($imgPath))) {
        // Fallback to existing valid collection image
        $fallback = 'uploads/collection/214944853_01_09_2021_04_39_59.webp';
        if (file_exists(public_path($fallback))) {
            $imgPath = $fallback;
        }
    }

    $col = Collection::updateOrCreate(
        ['slug' => $slug],
        [
            'name' => $data['name'],
            'image' => $imgPath,
            'description' => $data['description'],
            'metatitle' => $data['metatitle'],
            'metadescription' => $data['metadescription'],
            'metakeywords' => $data['metakeywords'],
            'status' => true
        ]
    );
    $collectionMap[$slug] = $col;
}

echo "Created/Updated " . count($collectionMap) . " collections.\n\n";

// Map old collection IDs (48..54) to new collection slugs
$oldColIdToSlug = [
    48 => 'bellezza',
    49 => 'migliore',
    50 => 'forte',
    51 => 'amore',
    52 => 'spazio',
    53 => 'lontano',
    54 => 'giovane'
];

// Map old color IDs (1..16) to color category slugs
$oldColorIdToSlug = [
    1 => 'brown-marble',
    2 => 'black-marble',
    3 => 'grey-marble',
    4 => 'grey-marble',
    5 => 'beige-marble',
    6 => 'white-marble',
    7 => 'beige-marble',
    8 => 'exotic-colored-marble',
    9 => 'exotic-colored-marble',
    10 => 'beige-marble',
    11 => 'beige-marble',
    12 => 'exotic-colored-marble',
    13 => 'exotic-colored-marble',
    14 => 'exotic-colored-marble',
    15 => 'exotic-colored-marble',
    16 => 'exotic-colored-marble',
];


// -------------------------------------------------------------
// 2. IMPORT & ENHANCE ALL 109 PRODUCTS / SLABS
// -------------------------------------------------------------
echo "2. Importing and enhancing 109 Marble Products/Slabs...\n";

// Load old gallery images by product_id
$galleryStmt = $oldPdo->query("SELECT * FROM product_images");
$oldGalleryImages = [];
while ($row = $galleryStmt->fetch(PDO::FETCH_ASSOC)) {
    $oldGalleryImages[$row['product_id']][] = $row['name'];
}

// Function to generate rich unique description for marble
function generateUniqueMarbleDescription($p, $origin, $finishes, $applications) {
    $name = $p['name'];
    $type = !empty($p['type']) ? $p['type'] : 'Premium Natural Stone';
    $oldDesc = trim(strip_tags($p['description']));

    $intro = "<p><strong>{$name}</strong> is an exquisite selection of {$type} sourced directly from premier natural quarries in <strong>{$origin}</strong>. Renowned for its distinctive aesthetic personality, refined crystalline structure, and timeless architectural appeal, this slab is engineered by nature to bring opulence and warmth into elite residential and commercial interior spaces.</p>";

    $veinPattern = "<p>Featuring a harmonious surface pattern with subtle, organic veining and tonal depth, {$name} creates an atmosphere of serene luxury. Each individual slab is a unique piece of geological art, making it an ideal choice for bespoke feature walls, bookmatched installations, and high-traffic grand flooring.</p>";

    $specs = "<h3>Architectural Applications & Finishes</h3>
<ul>
    <li><strong>Recommended Applications:</strong> {$applications}.</li>
    <li><strong>Available Finishes:</strong> {$finishes}.</li>
    <li><strong>Standard Slab Thickness:</strong> 18mm & 20mm with custom sizing available upon request.</li>
    <li><strong>Durability & Maintenance:</strong> High density, low porosity when sealed, and exceptional resistance to everyday wear.</li>
</ul>";

    $customNote = "";
    if (!empty($oldDesc) && strlen($oldDesc) > 30) {
        $customNote = "<h3>Designer Highlights</h3><p>" . htmlspecialchars($oldDesc) . "</p>";
    }

    $conclusion = "<p>At <strong>Stone Hub India</strong>, every bundle of {$name} undergoes rigorous quality inspection at our Kishangarh stockyards to ensure zero structural flaws, uniform calibration, and maximum polish retention. Contact our natural stone specialists to request high-resolution photos of live slabs or schedule a private viewing.</p>";

    return $intro . $veinPattern . $customNote . $specs . $conclusion;
}

// Helper to determine origin
function determineOrigin($name, $type) {
    $n = strtolower($name);
    if (str_contains($n, 'statuario') || str_contains($n, 'calacatta') || str_contains($n, 'carrara') || str_contains($n, 'botticino') || str_contains($n, 'dyna') || str_contains($n, 'portoro') || str_contains($n, 'armani') || str_contains($n, 'italian')) {
        return 'Italy';
    }
    if (str_contains($n, 'marquina') || str_contains($n, 'marfil') || str_contains($n, 'emperador') || str_contains($n, 'spain')) {
        return 'Spain';
    }
    if (str_contains($n, 'patagonia') || str_contains($n, 'blue roma') || str_contains($n, 'brazil') || str_contains($n, 'quartzite')) {
        return 'Brazil';
    }
    if (str_contains($n, 'travertine') || str_contains($n, 'onyx') || str_contains($n, 'turkey')) {
        return 'Turkey';
    }
    if (str_contains($n, 'thassos') || str_contains($n, 'volakas') || str_contains($n, 'greece')) {
        return 'Greece';
    }
    if (str_contains($n, 'african')) {
        return 'Africa';
    }
    return 'Imported / International Quarries';
}

$prodStmt = $oldPdo->query("SELECT * FROM products ORDER BY id ASC");
$oldProducts = $prodStmt->fetchAll(PDO::FETCH_ASSOC);

$importedCount = 0;

foreach ($oldProducts as $p) {
    $slug = trim($p['slug']);
    if (empty($slug)) {
        $slug = Str::slug($p['name']);
    }

    // Resolve Image Path
    $imagePath = 'uploads/product/' . $p['image'];
    if (!file_exists(public_path($imagePath))) {
        // Check pricelist or category folders
        $alt1 = 'uploads/pricelist/' . $slug . '.webp';
        $alt2 = 'uploads/pricelist/' . $slug . '.jpg';
        $alt3 = 'uploads/pricelist/' . $slug . '.jpeg';
        if (file_exists(public_path($alt1))) {
            $imagePath = $alt1;
        } elseif (file_exists(public_path($alt2))) {
            $imagePath = $alt2;
        } elseif (file_exists(public_path($alt3))) {
            $imagePath = $alt3;
        }
    }

    // Resolve Gallery
    $gallery = [];
    $rawGallery = $oldGalleryImages[$p['id']] ?? [];
    foreach ($rawGallery as $gImg) {
        $gPath1 = 'uploads/gallery/' . $gImg;
        $gPath2 = 'uploads/product/' . $gImg;
        if (file_exists(public_path($gPath1))) {
            $gallery[] = $gPath1;
        } elseif (file_exists(public_path($gPath2))) {
            $gallery[] = $gPath2;
        }
    }

    // Determine specifications
    $origin = determineOrigin($p['name'], $p['type']);
    $thickness = '18mm & 20mm standard (custom gangsaw sizes on request)';
    $finishes = !empty($p['finishes_available']) ? $p['finishes_available'] : 'High-Gloss Mirror Polish, Honed Matte, Antique Brushed, Leathered';
    $applications = !empty($p['application']) ? $p['application'] : 'Luxury Flooring, Master Bathroom Vanities, Bookmatched Feature Walls, Countertops, Grand Foyers, Exterior Cladding';

    // Generate unique rich content
    $uniqueDescription = generateUniqueMarbleDescription($p, $origin, $finishes, $applications);

    // Keep metadata exactly identical to old website
    $metatitle = !empty($p['metatitle']) ? $p['metatitle'] : ($p['name'] . ' | Imported Marble | Stone Hub India');
    $metadescription = !empty($p['meta_description']) ? $p['meta_description'] : ('Explore premium ' . $p['name'] . ' at Stone Hub India. Sourced directly from premier quarries in ' . $origin . '.');
    $metakeywords = !empty($p['meta_keyword']) ? $p['meta_keyword'] : ($p['name'] . ', imported marble, kishangarh marble suppliers');

    // Create or Update Marble
    $marble = Marble::updateOrCreate(
        ['slug' => $slug],
        [
            'name' => $p['name'],
            'image' => $imagePath,
            'gallery' => json_encode(array_values(array_unique($gallery))),
            'description' => $uniqueDescription,
            'origin' => $origin,
            'thickness' => $thickness,
            'finishes' => $finishes,
            'applications' => $applications,
            'status' => true,
            'metatitle' => $metatitle,
            'metadescription' => $metadescription,
            'metakeywords' => $metakeywords,
            'created_at' => $p['created_at'] ?? now(),
            'updated_at' => $p['updated_at'] ?? now(),
        ]
    );

    // ---------------------------------------------------------
    // ALIGN IN MULTIPLE COLLECTIONS / CATEGORIES
    // ---------------------------------------------------------
    $assignedCollectionIds = [];

    // 1. All imported marbles belong to "imported-marble"
    if (isset($collectionMap['imported-marble'])) {
        $assignedCollectionIds[] = $collectionMap['imported-marble']->id;
    }

    // 2. Specific stone types
    $nameLower = strtolower($p['name']);
    if (str_contains($nameLower, 'onyx') && isset($collectionMap['onyx'])) {
        $assignedCollectionIds[] = $collectionMap['onyx']->id;
    } elseif (str_contains($nameLower, 'travertine') && isset($collectionMap['travertine'])) {
        $assignedCollectionIds[] = $collectionMap['travertine']->id;
    } elseif (str_contains($nameLower, 'quartzite') && isset($collectionMap['quartzite'])) {
        $assignedCollectionIds[] = $collectionMap['quartzite']->id;
    } else {
        // Italian/International Marble
        if (isset($collectionMap['italian-marble'])) {
            $assignedCollectionIds[] = $collectionMap['italian-marble']->id;
        }
    }

    // 3. Signature Collection from old collection_id (e.g. Bellezza, Migliore, Forte, Amore, Spazio, Lontano, Giovane)
    $oldColId = intval($p['collection_id'] ?? 0);
    if (isset($oldColIdToSlug[$oldColId])) {
        $cSlug = $oldColIdToSlug[$oldColId];
        if (isset($collectionMap[$cSlug])) {
            $assignedCollectionIds[] = $collectionMap[$cSlug]->id;
        }
    }
    if (isset($collectionMap['marble-by-collection'])) {
        $assignedCollectionIds[] = $collectionMap['marble-by-collection']->id;
    }

    // 4. Color Categories from old color_id or name analysis
    $oldColorIds = explode(',', (string)($p['color_id'] ?? ''));
    foreach ($oldColorIds as $cId) {
        $cId = intval(trim($cId));
        if (isset($oldColorIdToSlug[$cId])) {
            $colorSlug = $oldColorIdToSlug[$cId];
            if (isset($collectionMap[$colorSlug])) {
                $assignedCollectionIds[] = $collectionMap[$colorSlug]->id;
            }
        }
    }

    // Name-based color fallbacks if color_id was missing
    if (str_contains($nameLower, 'white') || str_contains($nameLower, 'statuario') || str_contains($nameLower, 'carrara') || str_contains($nameLower, 'calacatta') || str_contains($nameLower, 'bianco')) {
        if (isset($collectionMap['white-marble'])) $assignedCollectionIds[] = $collectionMap['white-marble']->id;
    }
    if (str_contains($nameLower, 'beige') || str_contains($nameLower, 'crema') || str_contains($nameLower, 'botticino') || str_contains($nameLower, 'dyna') || str_contains($nameLower, 'perlato')) {
        if (isset($collectionMap['beige-marble'])) $assignedCollectionIds[] = $collectionMap['beige-marble']->id;
    }
    if (str_contains($nameLower, 'black') || str_contains($nameLower, 'marquina') || str_contains($nameLower, 'portoro')) {
        if (isset($collectionMap['black-marble'])) $assignedCollectionIds[] = $collectionMap['black-marble']->id;
    }
    if (str_contains($nameLower, 'grey') || str_contains($nameLower, 'gray') || str_contains($nameLower, 'silver')) {
        if (isset($collectionMap['grey-marble'])) $assignedCollectionIds[] = $collectionMap['grey-marble']->id;
    }
    if (str_contains($nameLower, 'brown') || str_contains($nameLower, 'bronze') || str_contains($nameLower, 'tobacco')) {
        if (isset($collectionMap['brown-marble'])) $assignedCollectionIds[] = $collectionMap['brown-marble']->id;
    }

    // Sync pivot table
    $marble->collections()->sync(array_unique($assignedCollectionIds));
    $importedCount++;
}

echo "Successfully migrated and categorized {$importedCount} Marble Products!\n\n";


// -------------------------------------------------------------
// 3. MIGRATE ALL CMS PAGES FROM OLD WEBSITE
// -------------------------------------------------------------
echo "3. Migrating CMS Pages...\n";

$cmsStmt = $oldPdo->query("SELECT * FROM cms");
$oldCmsPages = $cmsStmt->fetchAll(PDO::FETCH_ASSOC);

$cmsCount = 0;
foreach ($oldCmsPages as $c) {
    $slug = trim($c['slug']);
    if (empty($slug)) continue;

    $imgPath = 'uploads/page/' . $c['image'];
    if (!file_exists(public_path($imgPath))) {
        $imgPath = null;
    }

    CmsPage::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => $c['title'],
            'content' => $c['description'],
            'image_path' => $imgPath,
            'metatitle' => $c['metatitle'] ?: ($c['title'] . ' | Stone Hub India'),
            'metadescription' => $c['meta_description'] ?: ('Stone Hub India ' . $c['title']),
            'metakeywords' => $c['meta_keyword'] ?: ($c['title'] . ', stone hub india'),
            'status' => true
        ]
    );
    $cmsCount++;
}

echo "Migrated {$cmsCount} CMS Pages.\n\n";


// -------------------------------------------------------------
// 4. MIGRATE ALL BLOGS AND ARTICLES
// -------------------------------------------------------------
echo "4. Migrating Blogs and Articles...\n";

if (!file_exists(public_path('uploads/blogs'))) {
    mkdir(public_path('uploads/blogs'), 0777, true);
}

$blogStmt = $oldPdo->query("SELECT * FROM blogs");
$oldBlogs = $blogStmt->fetchAll(PDO::FETCH_ASSOC);

$searchDirs = [
    public_path('uploads/product'),
    base_path('public_html/public/uploads/product'),
    public_path('uploads/gallery'),
    base_path('public_html/public/uploads/gallery'),
    public_path('uploads/page'),
    public_path('uploads/blogs'),
];

$blogCount = 0;
foreach ($oldBlogs as $b) {
    $slug = trim($b['slug']);
    if (empty($slug)) $slug = Str::slug($b['name']);

    $rawImg = trim($b['image'] ?? '');
    $filename = basename($rawImg);

    if ($slug === 'can-water-stain-marble' || empty($filename) || $filename === 'blogs') {
        $imgPath = 'uploads/blogs/can-water-stain-marble.jpg';
    } else {
        $imgPath = 'uploads/blogs/' . $filename;
        $dest = public_path($imgPath);

        if (!file_exists($dest)) {
            foreach ($searchDirs as $dir) {
                $candidate = $dir . '/' . $filename;
                if (file_exists($candidate) && is_file($candidate)) {
                    copy($candidate, $dest);
                    break;
                }
            }
        }
    }

    $summary = Str::limit(strip_tags($b['description']), 200);

    Blog::updateOrCreate(
        ['slug' => $slug],
        [
            'title' => $b['name'],
            'content' => $b['description'],
            'summary' => $summary,
            'category' => 'Imported Marble Insights',
            'image_path' => $imgPath,
            'metatitle' => $b['metatitle'] ?: ($b['name'] . ' | Stone Hub India Blog'),
            'metadescription' => $b['metadescription'] ?: $summary,
            'metakeywords' => $b['metakeywords'] ?: ($b['name'] . ', stone hub india blogs'),
            'published_at' => $b['created_at'] ?? now(),
        ]
    );
    $blogCount++;
}

echo "Migrated {$blogCount} Blogs.\n\n";

// -------------------------------------------------------------
// 5. MIGRATE ALL 61 CITY & LOCATION PAGES
// -------------------------------------------------------------
echo "5. Migrating 61 City & Location Pages...\n";

use App\Models\LocationPage;

$cityUploadDir = public_path('uploads/city');
if (!file_exists($cityUploadDir)) {
    mkdir($cityUploadDir, 0777, true);
}

try {
    $cityStmt = $oldPdo->query("SELECT * FROM cities ORDER BY id ASC");
    $oldCities = $cityStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (\Exception $e) {
    // If not in oldPdo directly, read from temp_cities_import or SmJp_kis.sql
    $oldCities = DB::table('temp_cities_import')->get()->map(fn($item) => (array)$item)->toArray();
}

$cityCount = 0;
foreach ($oldCities as $c) {
    $citySlug = trim($c['slug'] ?? '');
    if (empty($citySlug)) {
        $citySlug = Str::slug($c['name']);
    }

    $imageName = basename(trim($c['image'] ?? ''));
    $imageRelPath = 'uploads/product/' . $imageName;

    foreach ($searchDirs as $dir) {
        $src = $dir . '/' . $imageName;
        if (file_exists($src) && is_file($src)) {
            copy($src, $cityUploadDir . '/' . $imageName);
            $imageRelPath = 'uploads/city/' . $imageName;
            break;
        }
    }

    $cityName = trim($c['name']);
    $metaTitle = trim($c['metatitle'] ?? '') ?: ('Imported & Italian Marble Supplier in ' . $cityName . ' | Stone Hub India');
    $metaDesc = trim($c['meta_description'] ?? '') ?: ('Discover premium imported and Italian marble in ' . $cityName . ' with Stone Hub India. Explore our luxury collection.');
    $metaKeywords = trim($c['meta_keyword'] ?? '') ?: ('imported marble ' . $cityName . ', italian marble in ' . $cityName . ', best marble dealers in ' . $cityName);
    $tags = trim($c['tags'] ?? '');
    $description = trim($c['description'] ?? '');

    $content = [
        'city_name' => $cityName,
        'city_slug' => $citySlug,
        'image' => $imageRelPath,
        'description' => $description,
        'meta_title' => $metaTitle,
        'meta_description' => $metaDesc,
        'meta_keywords' => $metaKeywords,
        'tags' => $tags,
        'hero_title' => $metaTitle,
        'hero_subtitle' => "Direct Importers & Curation Experts of World-Class Italian, Greek, Brazilian & Turkish Marble Slabs in {$cityName}.",
        'intro_title' => "Premium Imported Marble in {$cityName}",
        'intro_text' => $description,
        'features_title' => "The Stone Hub Curation Standard for {$cityName}",
        'features' => [
            [
                'title' => 'Quarry-Direct Sourcing',
                'desc' => "We import prime stone blocks directly from Italy, Spain, Turkey, Greece, and Brazil, ensuring genuine natural beauty and durability for projects in {$cityName}."
            ],
            [
                'title' => '36-Head Automated Polishing',
                'desc' => 'Every slab undergoes resin reinforcement backing, multi-stage diamond polishing, and thickness calibration matching Italian benchmarks.'
            ],
            [
                'title' => 'Doorstep Insured Transit',
                'desc' => "Securely crated in heavy timber A-frames with end-to-end transit insurance directly delivered to your architectural site in {$cityName}."
            ],
            [
                'title' => 'Live Slab Lot Video Inspection',
                'desc' => 'HD video walkthroughs, slab photos, and 3D visualizer previews of exact numbered bundles before dispatch.'
            ]
        ],
        'faq_title' => "Frequently Asked Questions about Marble in {$cityName}",
        'faqs' => [
            [
                'q' => "How do I choose and purchase imported marble for a project in {$cityName}?",
                'a' => "You can browse our curated live slab collection online or contact our marble specialists. We offer high-resolution video tours of standing slabs, complimentary samples, and transparent per square foot pricing with insured logistics to {$cityName}."
            ],
            [
                'q' => "What is the delivery timeline for marble slabs to {$cityName}?",
                'a' => "Dispatches are processed from our Kishangarh stockyard within 24-48 hours. Secure transit to {$cityName} typically takes 4 to 7 business days depending on load volume."
            ],
            [
                'q' => "Which varieties of Italian marble are most popular in {$cityName}?",
                'a' => "Our most requested stones in {$cityName} include Statuario White, Bottochino Classic, Armani Grey, Black Marquina, Dyna Royal, Translucent Onyx, and Brazilian Exotic Quartzite."
            ],
            [
                'q' => "Do you assist with bookmatched slab layouts?",
                'a' => "Yes, all gangsaw slabs are consecutively numbered from the same raw block, allowing flawless bookmatched and diamond vein matching for your grand foyer and living spaces."
            ]
        ]
    ];

    $schema = json_encode([
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'LocalBusiness',
                'name' => 'Stone Hub India - ' . $cityName,
                'description' => $metaDesc,
                'image' => url($imageRelPath),
                'url' => url($citySlug . '/imported-marble-seller'),
                'telephone' => '+91-8800000000',
                'priceRange' => '₹₹₹₹',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $cityName,
                    'addressCountry' => 'IN'
                ]
            ],
            [
                '@type' => 'WebPage',
                'name' => $metaTitle,
                'description' => $metaDesc,
                'url' => url($citySlug . '/imported-marble-seller')
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    LocationPage::updateOrCreate(
        [
            'city' => $citySlug,
            'slug' => 'imported-marble-seller',
        ],
        [
            'title' => $metaTitle,
            'meta_description' => $metaDesc,
            'content' => $content,
            'status' => true,
            'schema_markup' => $schema,
        ]
    );
    $cityCount++;
}

echo "Migrated {$cityCount} City Pages.\n\n";

echo "=== MIGRATION COMPLETE ===\n";
echo "Total Marbles in database: " . Marble::count() . "\n";
echo "Total Collections in database: " . Collection::count() . "\n";
echo "Total CMS Pages in database: " . CmsPage::count() . "\n";
echo "Total Blogs in database: " . Blog::count() . "\n";
echo "Total City/Location Pages in database: " . LocationPage::count() . "\n";

