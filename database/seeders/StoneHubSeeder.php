<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoneHubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Site Parameters
        $parameters = [
            ['id' => 'site_name', 'value' => 'Stone Hub India', 'label' => 'Site Name', 'category' => 'general'],
            ['id' => 'site_tagline', 'value' => 'Curators & Importers of Premium Natural Stone Slabs', 'label' => 'Site Tagline', 'category' => 'general'],
            ['id' => 'phone', 'value' => '+91 96727 77749', 'label' => 'Contact Phone Number', 'category' => 'contact'],
            ['id' => 'email', 'value' => 'info@stonehubindia.com', 'label' => 'Contact Email Address', 'category' => 'contact'],
            ['id' => 'address', 'value' => 'Plot No. 12, Industrial Area, Makrana Road, Kishangarh, Rajasthan - 305801', 'label' => 'Physical Address', 'category' => 'contact'],
            ['id' => 'whatsapp_number', 'value' => '919672777749', 'label' => 'WhatsApp Number', 'category' => 'contact'],
            ['id' => 'livechat_auto_reply', 'value' => 'Hello! Welcome to Stone Hub India. How can we help you today with your premium marble selection?', 'label' => 'Live Chat Auto Reply Welcome Message', 'category' => 'general'],
            
            // Custom Styling Colors (StoneHub Theme)
            ['id' => 'global_primary_color', 'value' => '#0F0F11', 'label' => 'Primary Obsidian Color', 'category' => 'styling'],
            ['id' => 'global_primary_color_hover', 'value' => '#1F1F24', 'label' => 'Primary Hover Color', 'category' => 'styling'],
            ['id' => 'global_primary_color_dark', 'value' => '#000000', 'label' => 'Base Background Color', 'category' => 'styling'],
            ['id' => 'global_secondary_color', 'value' => '#F7F7F9', 'label' => 'Secondary Alabaster Color', 'category' => 'styling'],
            ['id' => 'global_button_color', 'value' => '#C5A880', 'label' => 'Accent Gold Color', 'category' => 'styling'],
            ['id' => 'global_button_color_hover', 'value' => '#B4956C', 'label' => 'Accent Hover Gold Color', 'category' => 'styling'],
            ['id' => 'global_font_family', 'value' => 'outfit-inter', 'label' => 'Font Family Pair', 'category' => 'styling'],
            ['id' => 'global_button_shape', 'value' => 'rounded', 'label' => 'Global Button Shape', 'category' => 'styling'],

            // Custom Section Backgrounds
            ['id' => 'index_hero_bg', 'value' => 'linear-gradient(180deg, #0b0b0c 0%, #0f0f11 100%)', 'label' => 'Home Hero Background', 'category' => 'styling'],
            ['id' => 'index_services_bg', 'value' => '#ffffff', 'label' => 'Home Services Background', 'category' => 'styling'],
            ['id' => 'index_about_bg', 'value' => '#fcfcfa', 'label' => 'Home About Background', 'category' => 'styling'],
            ['id' => 'index_why_bg', 'value' => '#0f0f11', 'label' => 'Home Why Choose Us Background', 'category' => 'styling'],
            ['id' => 'index_testimonials_bg', 'value' => '#ffffff', 'label' => 'Home Testimonials Background', 'category' => 'styling'],
            ['id' => 'index_faq_bg', 'value' => '#fbfbfa', 'label' => 'Home FAQ Background', 'category' => 'styling'],
            ['id' => 'index_cta_bg', 'value' => 'linear-gradient(135deg, #0F0F11 0%, #1F1F24 100%)', 'label' => 'Home CTA Section Background', 'category' => 'styling'],
        ];

        foreach ($parameters as $param) {
            DB::table('site_parameters')->updateOrInsert(
                ['id' => $param['id']],
                [
                    'value' => $param['value'],
                    'label' => $param['label'],
                    'category' => $param['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Seed Page Contents
        $contents = [
            // Homepage Hero
            ['page' => 'home', 'section' => 'hero', 'key' => 'title', 'value' => 'CURATORS OF FINEST NATURAL STONE SLABS'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Handpicked marble, exotic quartzite, translucent onyx, and travertine sourced from Italy, Spain, Brazil, and Greece.'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'trust_badge', 'value' => 'Premier Importers & Curators'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'primary_cta_label', 'value' => 'Book Showroom Tour'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'secondary_cta_label', 'value' => 'Download Catalogue'],

            // Homepage Finder Widget
            ['page' => 'home', 'section' => 'finder', 'key' => 'title', 'value' => "I am looking for"],
            ['page' => 'home', 'section' => 'finder', 'key' => 'description', 'value' => 'Find the perfect match for your design projects based on stone category and applications.'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'concerns', 'value' => 'Italian Marble, Exotic Quartzite, Translucent Onyx, Classic Travertine, Premium Granite'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'treatment_types', 'value' => 'Living Room Wall, Kitchen Island Countertop, Bathroom Vanity, Flooring, Exterior Facade'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'cta_label', 'value' => 'Explore Ideal Slabs'],

            // Homepage Quick Actions
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item1', 'value' => 'Request Sample Slabs'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item2', 'value' => 'Interactive Slab Gallery'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item3', 'value' => 'Get Quote Estimate'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item4', 'value' => 'Virtual Walkthrough'],

            // Homepage Specialties
            ['page' => 'home', 'section' => 'specialties', 'key' => 'title', 'value' => 'Signature Stone Categories'],
            ['page' => 'home', 'section' => 'specialties', 'key' => 'subtitle', 'value' => 'Handpicked stone varieties curated directly from exclusive global quarries.'],

            // About Company Section
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'title', 'value' => 'Crafting Architectural Masterpieces Since 2012'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'intro_text', 'value' => 'Stone Hub India is a premier curator and importer of luxury natural stones. Sourcing directly from exclusive quarries in Carrara (Italy), Drama (Greece), and Espirito Santo (Brazil), we provide architectural surfaces that redefine luxury residential and commercial design.'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'philosophy', 'value' => 'Providing architects, interior designers, and luxury homeowners with the finest quality natural stone slabs, hand-selected block by block.'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'image', 'value' => 'uploads/about/showroom.jpg'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat1_value', 'value' => '40+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat1_label', 'value' => 'Global Quarries Sourced'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat2_value', 'value' => '10k+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat2_label', 'value' => 'Standing Slabs in Stock'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat3_value', 'value' => '1,200+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat3_label', 'value' => 'Bespoke Projects Completed'],

            // Why Choose Us Section
            ['page' => 'home', 'section' => 'why_choose_us', 'key' => 'title', 'value' => 'The Curation Standard'],
            ['page' => 'home', 'section' => 'why_choose_us', 'key' => 'subtitle', 'value' => 'Uncompromising checks and balances that make us India\'s first choice for luxury stone.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r1_title', 'value' => 'Direct Quarry Curation'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r1_desc', 'value' => 'We visit quarries globally to handpick only the top 5% of marble blocks.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r2_title', 'value' => 'Bookmatched Precision'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r2_desc', 'value' => 'Perfect mirror-image matching for dramatic feature walls.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r3_title', 'value' => 'Italian Reinforcing Mesh'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r3_desc', 'value' => 'Italian-grade epoxy and structural mesh backing for high-impact durability.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r4_title', 'value' => 'Bespoke Custom Cutting'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r4_desc', 'value' => 'Precise waterjet and bridge saw cutting to your exact specifications.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r5_title', 'value' => 'Translucency Mapping'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r5_desc', 'value' => 'Light-transmission testing for high-end backlit applications.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r6_title', 'value' => 'Showroom Slab Gallery'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r6_desc', 'value' => 'Walk through full-size standing slabs to experience the final scale.'],

            // Video Consults
            ['page' => 'home', 'section' => 'videos', 'key' => 'title', 'value' => 'Geological Art In Motion'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'title', 'value' => 'Showroom Tour & Exotic Slab Reveal'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'duration', 'value' => '05:14'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'link', 'value' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'title', 'value' => 'Statuario vs Calacatta: Sourcing Guide'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'duration', 'value' => '03:45'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'link', 'value' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'title', 'value' => 'Installing Bookmatched Marble Walls'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'duration', 'value' => '08:12'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'link', 'value' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],

            // Testimonials
            ['page' => 'home', 'section' => 'testimonials', 'key' => 'title', 'value' => 'Architect & Designer Perspectives'],
            ['page' => 'home', 'section' => 'testimonials', 'key' => 'subtitle', 'value' => 'Collaborating with elite visionaries to create bespoke luxury estates.'],

            // Awards
            ['page' => 'home', 'section' => 'awards', 'key' => 'title', 'value' => 'Awards & Credentials'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'title', 'value' => 'Top Natural Stone Importer'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'org', 'value' => 'India Stone Guild 2025'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'year', 'value' => '2025'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'title', 'value' => 'Quarry Sourcing Leadership Award'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'org', 'value' => 'Stone Industry Association 2024'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'year', 'value' => '2024'],

            // Locations
            ['page' => 'home', 'section' => 'locations', 'key' => 'title', 'value' => 'Luxury Showroom Locations'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'name', 'value' => 'Main Experience Center'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'address', 'value' => 'Plot No. 12, Industrial Area, Makrana Road, Kishangarh, Rajasthan - 305801'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'phone', 'value' => '+91-96727-77749'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'map', 'value' => 'https://maps.google.com'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'name', 'value' => 'Kishangarh Stockyard Hub'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'address', 'value' => 'Opposite Marble Association Hall, Jaipur-Ajmer Expressway, Kishangarh, Rajasthan - 305801'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'phone', 'value' => '+91-88559-50433'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'map', 'value' => 'https://maps.google.com'],

            // Blogs
            ['page' => 'home', 'section' => 'blogs', 'key' => 'title', 'value' => 'Design Journals & Stone Guides'],
            ['page' => 'home', 'section' => 'blogs', 'key' => 'subtitle', 'value' => 'Unveiling stone design concepts, maintenance guides, and selection blueprints.'],
            ['page' => 'home', 'section' => 'blogs', 'key' => 'cta_label', 'value' => 'Read All Journals'],

            // Header Top Strip & Menus
            ['page' => 'header', 'section' => 'top_strip', 'key' => 'left_label', 'value' => 'DISCOVER IMMERSIVE LUXURY'],
            ['page' => 'header', 'section' => 'top_strip', 'key' => 'cta_label', 'value' => 'Download E-Brochure'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'home', 'value' => 'Home'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'about', 'value' => 'Curators'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'treatments_services', 'value' => 'Collections & Slabs'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'patient_info', 'value' => 'Architect Resources'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'success_stories', 'value' => 'Testimonials'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'blog', 'value' => 'Design Journals'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'contact', 'value' => 'Find Showroom'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'cta', 'value' => 'Request Catalogue'],

            // Footer
            ['page' => 'footer', 'section' => 'about', 'key' => 'tagline', 'value' => 'Crafting High-End Spaces With Majestic Geological Art'],
            ['page' => 'footer', 'section' => 'about', 'key' => 'description', 'value' => 'Providing premium natural stone slabs including Italian marble, exotic quartzite, Onyx, and Travertine to architectural masterworks.'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'quick_links', 'value' => 'Company'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'services', 'value' => 'Collections'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'contact', 'value' => 'Experience Center'],
            ['page' => 'footer', 'section' => 'bottom', 'key' => 'copyright', 'value' => 'All Rights Reserved.'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'title', 'value' => 'Subscribe to Stone Design Journals'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'description', 'value' => 'Get curated stone ideas, technical manuals, and new stock announcements.'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'placeholder', 'value' => 'Enter your email'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'btn_label', 'value' => 'Subscribe'],
            ['page' => 'footer', 'section' => 'bottom', 'key' => 'disclaimer', 'value' => 'Natural stone colors and vein maps will vary due to geological formations. We recommend reviewing standing slabs in our showroom.'],
        ];

        DB::table('page_contents')->where('page', 'home')->orWhere('page', 'header')->orWhere('page', 'footer')->delete();
        foreach ($contents as $content) {
            DB::table('page_contents')->insert([
                'page' => $content['page'],
                'section' => $content['section'],
                'key' => $content['key'],
                'value' => $content['value'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Seed Homepage Slides
        DB::table('home_slides')->delete();
        DB::table('home_slides')->insert([
            [
                'title' => 'EXOTIC PATAGONIA QUARTZITE SLABS',
                'subtitle' => 'Highly crystalline geological wonders with striking translucency, hand-selected from the heart of Brazil.',
                'image_path' => 'uploads/hero/slide1.jpg',
                'button_text' => 'View Exotic Slabs',
                'button_link' => '#specialties',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TIMELESS ITALIAN STATUARIO MARBLE',
                'subtitle' => 'The peak of architectural luxury, featuring pure white bases crossed by majestic bookmatched grey veins.',
                'image_path' => 'uploads/hero/slide2.jpg',
                'button_text' => 'Request Brochure',
                'button_link' => '#contact-us',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 4. Seed Testimonials
        DB::table('testimonials')->delete();
        DB::table('testimonials')->insert([
            [
                'name' => 'Sanjay Mehta',
                'role' => 'Lead Architect, Studio Vista',
                'content' => 'Stone Hub India has provided some of the most exquisite bookmatched marble slabs we\'ve used in our high-end residential projects. The curation and client alignment are outstanding.',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ananya Goel',
                'role' => 'Principal Designer, Alabaster Space',
                'content' => 'Their collection of exotic quartzite is unmatched. The Patagonia slab we backlit for our penthouse client became the focal point of the home. Truly multi-million dollar visuals.',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vikram Malhotra',
                'role' => 'Luxury Homeowner, Balewadi',
                'content' => 'The experience of walking through the full-sized slab gallery made stone selection extremely easy. Excellent post-sales reinforcement and custom bridge-saw cutting.',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. Seed Blogs
        DB::table('blogs')->delete();
        DB::table('blogs')->insert([
            [
                'slug' => 'stone-selection-blueprint',
                'title' => 'The Ultimate Natural Stone Selection Blueprint',
                'category' => 'Design Guide',
                'summary' => 'How architects and homeowners choose between marble, quartzite, and granite for luxury surfaces.',
                'content' => '<h3>Selecting the Perfect Surface</h3><p>Natural stone is a long-term investment. This guide breaks down the physical properties, aesthetics, and maintenance of each stone family...</p>',
                'image_path' => 'uploads/blogs/guide1.jpg',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'art-of-backlighting-onyx',
                'title' => 'The Art of Backlighting Onyx & Quartzite Slabs',
                'category' => 'Technical Guide',
                'summary' => 'Step-by-step setup for dramatic backlit walls and structural features.',
                'content' => '<h3>Illuminating Translucent Stones</h3><p>Onyx and certain quartzites possess unique translucent properties. Here is how to install LED panels for an even, shadow-free glow...</p>',
                'image_path' => 'uploads/blogs/guide2.jpg',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'maintaining-italian-marble',
                'title' => 'Maintaining Italian Marble: The Curation Guide',
                'category' => 'Maintenance',
                'summary' => 'Best practices to preserve the pristine polished surface of luxury white marble.',
                'content' => '<h3>Preserving Calacatta and Statuario Surfaces</h3><p>Luxury white marble requires delicate care. Avoid acidic solutions, use pH-neutral sealers, and wipe spills immediately to prevent etching...</p>',
                'image_path' => 'uploads/blogs/guide3.jpg',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 6. Seed Collections
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('collections')->delete();
        $collections = [
            [
                'id' => 1,
                'name' => 'Imported Marble',
                'slug' => 'imported-marble',
                'image' => 'uploads/category/imported-marble.jpg',
                'description' => 'Directly imported premium natural stone slabs sourced from world-class quarries in Italy, Spain, Turkey, and Greece.',
                'status' => 1,
                'metatitle' => 'Luxury Imported Marble Slabs in India | Stone Hub India',
                'metadescription' => 'Discover the finest collection of premium imported marble slabs directly from Italy, Greece, and Turkey. Hand-selected for ultimate elegance.',
                'metakeywords' => 'imported marble, luxury marble slabs, italian marble kishangarh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Italian Marble',
                'slug' => 'italian-marble',
                'image' => 'uploads/category/italian-marble.jpg',
                'description' => 'The global benchmark for architectural luxury. Featuring beautiful white-backed Statuario, Michelangelo, Carrara, and Calacatta blocks.',
                'status' => 1,
                'metatitle' => 'Premium Italian Marble | Sourced from Carrara | Stone Hub India',
                'metadescription' => 'Explore premium Italian marble slabs directly imported from Carrara, Italy. Ideal for high-end flooring, kitchen islands, and signature accent walls.',
                'metakeywords' => 'italian marble, statuario white, carrara marble, calacatta marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Translucent Onyx',
                'slug' => 'onyx',
                'image' => 'uploads/category/onyx.jpg',
                'description' => 'Vibrant, light-transmitting banded mineral panels. These stones create breathtaking glowing surfaces when integrated with custom backlighting grids.',
                'status' => 1,
                'metatitle' => 'Translucent Onyx Marble Slabs | Stone Hub India',
                'metadescription' => 'Explore translucent onyx marble slabs. Perfect for glowing vertical panels, back-lit tables, master vanity sets, and architectural screens.',
                'metakeywords' => 'translucent onyx, pink onyx, green onyx, backlight marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Classic Travertine',
                'slug' => 'travertine',
                'image' => 'uploads/category/travertine.jpg',
                'description' => 'Warm, earthy, and textured terrestrial limestone slabs. Highly favored by contemporary architects for modern minimalist facades, fireplaces, and flooring.',
                'status' => 1,
                'metatitle' => 'Classic Travertine Slabs | Honed & Filled | Stone Hub India',
                'metadescription' => 'Check our warm, organic modern travertine collection in silver, beige, and noce finishes. Perfect for interior walls and exterior facade cladding.',
                'metakeywords' => 'travertine slabs, beige travertine, noce travertine, cladding stones',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Exotic Quartzite',
                'slug' => 'quartzite',
                'image' => 'uploads/category/quartzite.jpg',
                'description' => 'Boasting immense geological strength and scratch resistance. Blends the high durability of granite with the elegant sweeping motions of premium marble.',
                'status' => 1,
                'metatitle' => 'Exotic Quartzite Slabs | Brazilian Quartz | Stone Hub India',
                'metadescription' => 'Shop highly durable, acid-resistant exotic quartzite slabs like Patagonia and Taj Mahal. Perfect for premium heavy-use kitchen countertops and bar tops.',
                'metakeywords' => 'exotic quartzite, patagonia quartzite, brazilian stone, kitchen countertop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Marble by Collection',
                'slug' => 'marble-by-collection',
                'image' => 'uploads/category/by-collection.jpg',
                'description' => 'Our handpicked signature collection of premium marbles grouped together for elite design and luxury themes.',
                'status' => 1,
                'metatitle' => 'Signature Marble Collections | Hand-selected blocks',
                'metadescription' => 'View our curated marble groupings tailored for high-end residential and commercial architecture layouts.',
                'metakeywords' => 'premium marble, signature marble collection',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($collections as $col) {
            DB::table('collections')->updateOrInsert(['id' => $col['id']], $col);
        }

        // 7. Seed Marbles (detailed products)
        DB::table('marbles')->delete();
        DB::table('collection_marble')->delete();

        $marbles = [
            [
                'id' => 1,
                'name' => 'Statuario White Marble',
                'slug' => 'statuario-white-marble',
                'image' => 'uploads/treatments/statuario.jpg',
                'gallery' => json_encode(['uploads/treatments/statuario.jpg', 'uploads/treatments/statuario_gallery.jpg']),
                'description' => 'The absolute pinnacle of Italian luxury. Statuario features a crisp white backdrop crossed by dramatic, deep-grey bookmatched veining, perfect for grand fireplaces and feature walls.',
                'origin' => 'Italy',
                'thickness' => '18mm',
                'finishes' => 'Polished',
                'applications' => 'Flooring, Wall Cladding, Bathrooms, Fireplaces',
                'status' => 1,
                'metatitle' => 'Statuario White Italian Marble | Premium Slab | Stone Hub India',
                'metadescription' => 'Get the finest Statuario White Italian marble. Features classic bookmatched veining layouts and a high-gloss polished face. Sourced directly from Carrara.',
                'metakeywords' => 'statuario marble, white italian marble, bookmatched slabs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Patagonia Exotic Quartzite',
                'slug' => 'patagonia-exotic-quartzite',
                'image' => 'uploads/treatments/patagonia.jpg',
                'gallery' => json_encode(['uploads/treatments/patagonia.jpg']),
                'description' => 'A geological masterwork. Patagonia quartzite presents a dynamic mix of clear translucent quartz sections, dark obsidian-like minerals, and beige feldspar blocks, ideal for backlit kitchen islands.',
                'origin' => 'Brazil',
                'thickness' => '20mm',
                'finishes' => 'Polished',
                'applications' => 'Kitchen Countertops, Backlit Accent Murals, Flooring',
                'status' => 1,
                'metatitle' => 'Patagonia Exotic Quartzite Slab | Brazilian Stone',
                'metadescription' => 'Add architectural drama with Patagonia Exotic Quartzite. Highly translucent sections respond beautifully to backlighting setup. Extreme durability.',
                'metakeywords' => 'patagonia quartzite, backlit stone, exotic brazilian quartzite',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Blue Roma Quartzite',
                'slug' => 'blue-roma-quartzite',
                'image' => 'uploads/treatments/blue-roma.jpg',
                'gallery' => json_encode(['uploads/treatments/blue-roma.jpg']),
                'description' => 'Sought-after for its deep blue-grey canvas overlaid by dramatic coppery-gold vein nets. It creates a stunning luxury statement in bathrooms, master vanity sets, and bar fronts.',
                'origin' => 'Brazil',
                'thickness' => '20mm',
                'finishes' => 'Polished, Leathered',
                'applications' => 'Kitchen Countertops, Bathrooms, Wall Cladding, Bar Fronts',
                'status' => 1,
                'metatitle' => 'Blue Roma Quartzite Slabs | Luxury Copper Veins',
                'metadescription' => 'Explore Blue Roma quartzite slabs. A luxurious blue-grey stone with a metallic copper vein net. Highly stain and scratch resistant.',
                'metakeywords' => 'blue roma quartzite, luxury kitchen countertop, blue stone slab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Pink Onyx Premium',
                'slug' => 'pink-onyx-premium',
                'image' => 'uploads/treatments/pink-onyx.jpg',
                'gallery' => json_encode(['uploads/treatments/pink-onyx.jpg']),
                'description' => 'An artistic, light-transmitting translucent onyx displaying cloud-like structures of rose, blush, and ivory. Designed for backlit bars, vanity walls, and artistic partitions.',
                'origin' => 'Turkey',
                'thickness' => '18mm',
                'finishes' => 'Polished',
                'applications' => 'Backlit Accent Murals, Bathrooms, Bar Tops, Partitions',
                'status' => 1,
                'metatitle' => 'Pink Onyx Premium Slab | Translucent Backlit Stone',
                'metadescription' => 'Make a soft artistic statement with Pink Onyx Premium. Highly translucent stone panels displaying waves of rose and ivory.',
                'metakeywords' => 'pink onyx, translucent onyx slabs, pink backlit marble',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Victoria Beige Marble',
                'slug' => 'victoria-beige',
                'image' => 'uploads/category/victoria-beige.jpg',
                'gallery' => json_encode(['uploads/category/victoria-beige.jpg']),
                'description' => 'A classic and versatile beige marble. Sourced from Italian quarries, it presents a consistent warm background with delicate, faint white veining and soft clouds, giving a cozy, elegant layout.',
                'origin' => 'Italy',
                'thickness' => '18mm',
                'finishes' => 'Polished, Honed',
                'applications' => 'Flooring, Wall Cladding, Staircases, Bathrooms',
                'status' => 1,
                'metatitle' => 'Victoria Beige Marble | Italian Warmth Slabs',
                'metadescription' => 'Check Victoria Beige marble slabs. Known for uniform warm beige tones and fine structural integrity. Sourced directly from Italy.',
                'metakeywords' => 'victoria beige marble, beige italian marble, flooring slabs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Golden Portoro Marble',
                'slug' => 'golden-portoro',
                'image' => 'uploads/category/golden-portoro.jpg',
                'gallery' => json_encode(['uploads/category/golden-portoro.jpg']),
                'description' => 'An intense obsidian-black marble with sweeping gold and amber veins. Highly dramatic, it has been used in premium palace floors and upscale lobbies for centuries.',
                'origin' => 'Italy',
                'thickness' => '18mm',
                'finishes' => 'Polished',
                'applications' => 'Wall Cladding, Fireplaces, Bathrooms, Highlighters',
                'status' => 1,
                'metatitle' => 'Golden Portoro Marble Slabs | Obsidian & Gold Veins',
                'metadescription' => 'Discover Golden Portoro, the black gold marble of Italy. Premium dark obsidian base with gold streaks. Perfect for bold signature installations.',
                'metakeywords' => 'golden portoro, black gold marble, luxury italian stone',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'African Brown Marble',
                'slug' => 'african-brown-marble',
                'image' => 'uploads/category/african-brown.jpg',
                'gallery' => json_encode(['uploads/category/african-brown.jpg']),
                'description' => 'African Brown Marble is a luxury natural stone known for its rich, deep brown backdrop intertwined with elegant gold, copper, and cream veining. Sourced from premium quarries, it offers a sophisticated warmth and dramatic visual appeal, making it an excellent choice for luxury flooring, wall cladding, fireplace surrounds, and vanity countertops.',
                'origin' => 'Africa',
                'thickness' => '18mm',
                'finishes' => 'Polished, Honed, Brushed',
                'applications' => 'Flooring, Wall Cladding, Bathrooms, Fireplaces, Countertops',
                'status' => 1,
                'metatitle' => 'African Brown Marble Slabs | Rich Gold & Copper Veins',
                'metadescription' => 'Explore premium African Brown marble slabs. A luxury natural stone with deep brown tones and warm gold/copper veining. Perfect for flooring and vanity counters.',
                'metakeywords' => 'african brown marble, brown italian marble, luxury stone flooring, brown marble slab',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($marbles as $m) {
            DB::table('marbles')->updateOrInsert(['id' => $m['id']], $m);
        }

        // Link Marbles to Collections (Pivot seeding)
        $links = [
            // Statuario White Marble -> Imported Marble (1), Italian Marble (2), Marble by Collection (6)
            ['marble_id' => 1, 'collection_id' => 1],
            ['marble_id' => 1, 'collection_id' => 2],
            ['marble_id' => 1, 'collection_id' => 6],
            
            // Patagonia Exotic Quartzite -> Imported Marble (1), Exotic Quartzite (5), Marble by Collection (6)
            ['marble_id' => 2, 'collection_id' => 1],
            ['marble_id' => 2, 'collection_id' => 5],
            ['marble_id' => 2, 'collection_id' => 6],

            // Blue Roma Quartzite -> Imported Marble (1), Exotic Quartzite (5)
            ['marble_id' => 3, 'collection_id' => 1],
            ['marble_id' => 3, 'collection_id' => 5],

            // Pink Onyx Premium -> Imported Marble (1), Translucent Onyx (3), Marble by Collection (6)
            ['marble_id' => 4, 'collection_id' => 1],
            ['marble_id' => 4, 'collection_id' => 3],
            ['marble_id' => 4, 'collection_id' => 6],

            // Victoria Beige -> Imported Marble (1), Italian Marble (2)
            ['marble_id' => 5, 'collection_id' => 1],
            ['marble_id' => 5, 'collection_id' => 2],

            // Golden Portoro -> Imported Marble (1), Italian Marble (2), Marble by Collection (6)
            ['marble_id' => 6, 'collection_id' => 1],
            ['marble_id' => 6, 'collection_id' => 2],
            ['marble_id' => 6, 'collection_id' => 6],

            // African Brown Marble -> Imported Marble (1), Marble by Collection (6)
            ['marble_id' => 7, 'collection_id' => 1],
            ['marble_id' => 7, 'collection_id' => 6],
        ];

        foreach ($links as $link) {
            DB::table('collection_marble')->insert([
                'marble_id' => $link['marble_id'],
                'collection_id' => $link['collection_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 8. Truncate Comparison Lenders
        DB::table('comparison_banks')->delete();

        // 9. Seed CMS Pages & Cleanup Clinic Data
        DB::table('team_members')->delete();
        
        DB::table('cms_pages')->whereIn('slug', [
            'cupping-therapy-treatment',
            'dry-needling-therapy',
            'mfr-therapy-myofascial-release-therapy',
            'treatments',
            'facilities',
            'services',
            'specialists',
            'appointments',
            'teams'
        ])->delete();

        $cmsPages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'metatitle' => 'Premium Imported Marble & Slabs | Stone Hub India',
                'metadescription' => 'Stone Hub India is India\'s premier importer of luxury natural stones, including Statuario marble, exotic quartzite, Onyx, and Travertine slabs.',
                'metakeywords' => 'imported marble, luxury quartzite slabs, statuario marble, onyx slabs, stone hub india',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'About Stone Hub India',
                'slug' => 'about-us',
                'metatitle' => 'Leading Imported Marble Supplier | Stone Hub India',
                'metadescription' => 'Learn about Stone Hub India, an ISO:2015 certified imported marble supplier based in Kishangarh, Rajasthan. Discover our mission, values, and premium collections.',
                'metakeywords' => 'about stone hub, imported marble kishangarh, italian marble supplier, best marble kishangarh',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'metatitle' => 'Contact Premium Marble Showrooms | Stone Hub India',
                'metadescription' => 'Contact Stone Hub India. Request a catalogue, chat with our stone experts, or locate our premium Italian marble showrooms in Kishangarh and Delhi.',
                'metakeywords' => 'imported marble supplier kishangarh, italian marble showroom delhi, stone hub india contact',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'Infrastructure',
                'slug' => 'infrastructure',
                'metatitle' => 'Factory Infrastructure & Processing | Stone Hub India',
                'metadescription' => 'Explore Stone Hub India industrial infrastructure in Kishangarh. Premium processing gang saws, automated slab polishing lines, and over 2 million sqft of standing inventory.',
                'metakeywords' => 'marble factory kishangarh, stone processing equipment, imported marble stockyard, stone hub india infrastructure',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'FAQs',
                'slug' => 'faqs',
                'metatitle' => 'Frequently Asked Questions | Stone Hub India',
                'metadescription' => 'Find answers to frequently asked questions about imported marble collections, quartzite slabs, delivery logistics, custom bookmatching, and stockyard processing at Stone Hub India.',
                'metakeywords' => 'imported marble faq, quartzite slabs query, stone hub india support',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'Blogs',
                'slug' => 'blogs',
                'metatitle' => 'Design Journals & Stone Guides | Stone Hub India',
                'metadescription' => 'Unveiling stone design concepts, maintenance guides, and selection blueprints from the curators of Stone Hub India.',
                'metakeywords' => 'stone design blog, marble maintenance guide, quartzite selection blueprints',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'Testimonials',
                'slug' => 'testimonials',
                'metatitle' => 'Architect & Designer Reviews | Stone Hub India',
                'metadescription' => 'Read reviews and testimonials from elite architects, designers, and homeowners about their experience with Stone Hub India.',
                'metakeywords' => 'stone hub india reviews, client testimonials, marble feedback',
                'description' => null,
                'status' => 1,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'metatitle' => 'Privacy Policy | Stone Hub India',
                'metadescription' => 'Read the Privacy Policy of Stone Hub India to understand how we collect, use, and protect your personal information.',
                'metakeywords' => 'privacy policy, stone hub india',
                'description' => '<h3>Privacy Policy</h3><p>Stone Hub India is committed to protecting your privacy. This policy explains how we collect and use your data when you visit our website...</p>',
                'status' => 1,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'metatitle' => 'Terms & Conditions | Stone Hub India',
                'metadescription' => 'Read the Terms & Conditions governing the use of the Stone Hub India website and showroom services.',
                'metakeywords' => 'terms and conditions, stone hub india',
                'description' => '<h3>Terms & Conditions</h3><p>By accessing or using the Stone Hub India website, you agree to comply with and be bound by these terms and conditions of use...</p>',
                'status' => 1,
            ],
            [
                'title' => 'Disclaimer',
                'slug' => 'disclaimer',
                'metatitle' => 'Disclaimer | Stone Hub India',
                'metadescription' => 'Read the legal disclaimer for content, images, and slab dimensions shown on the Stone Hub India website.',
                'metakeywords' => 'disclaimer, stone hub india',
                'description' => '<h3>Disclaimer</h3><p>All information, images, and dimensions of marble slabs displayed on this website are for informational purposes only. Natural stone varies in pattern, texture, and color...</p>',
                'status' => 1,
            ],
        ];

        foreach ($cmsPages as $page) {
            DB::table('cms_pages')->updateOrInsert(
                ['slug' => $page['slug']],
                array_merge($page, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
