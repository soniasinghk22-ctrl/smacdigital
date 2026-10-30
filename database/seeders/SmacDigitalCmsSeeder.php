<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteParameter;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SmacDigitalCmsSeeder extends Seeder
{
    /**
     * Run the database seeds for SMAC Digital CMS.
     */
    public function run(): void
    {
        // 1. Site Parameters
        $params = [
            'site_name' => ['value' => 'SMAC Digital', 'label' => 'Site Name', 'category' => 'general'],
            'site_tagline' => ['value' => 'Performance-Driven Digital Marketing Agency', 'label' => 'Site Tagline', 'category' => 'general'],
            'primary_email' => ['value' => 'Jitendra@smacdigital.com', 'label' => 'Primary Email', 'category' => 'contact'],
            'email' => ['value' => 'Jitendra@smacdigital.com', 'label' => 'Contact Email Address', 'category' => 'contact'],
            'primary_phone' => ['value' => '+91 98290 69519', 'label' => 'Primary Phone', 'category' => 'contact'],
            'phone' => ['value' => '+91 98290 69519', 'label' => 'Contact Phone Number', 'category' => 'contact'],
            'whatsapp_number' => ['value' => '919582792638', 'label' => 'WhatsApp Number', 'category' => 'contact'],
            'address' => ['value' => 'Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur, Rajasthan 302020', 'label' => 'Physical Address', 'category' => 'contact'],
            'logo_path' => ['value' => 'assets/brand/logo-white.png', 'label' => 'Website Logo', 'category' => 'branding'],
            'favicon_path' => ['value' => 'assets/brand/favicon.ico', 'label' => 'Favicon Image', 'category' => 'branding'],
            'social_facebook' => ['value' => 'https://www.facebook.com/smacdigi', 'label' => 'Facebook URL', 'category' => 'general'],
            'social_twitter' => ['value' => 'https://twitter.com/DigitalSmac', 'label' => 'Twitter/X URL', 'category' => 'general'],
            'social_linkedin' => ['value' => 'https://www.linkedin.com/company/smac-digital-pvt-ltd', 'label' => 'LinkedIn URL', 'category' => 'general'],
            'social_instagram' => ['value' => 'https://www.instagram.com/smacdigital/', 'label' => 'Instagram URL', 'category' => 'general'],
            'livechat_auto_reply' => ['value' => 'Hello! Welcome to SMAC Digital. How can we help you scale your business through Social, Mobile, Analytics, and Cloud?', 'label' => 'Live Chat Welcome Message', 'category' => 'general'],
        ];

        foreach ($params as $id => $data) {
            SiteParameter::updateOrCreate(
                ['id' => $id],
                [
                    'value' => $data['value'],
                    'label' => $data['label'],
                    'category' => $data['category']
                ]
            );
        }

        // 2. SMAC Digital Testimonials
        $testimonials = [
            [
                'name' => 'Stone Hub India',
                'role' => 'Client Partner',
                'avatar_path' => 'assets/people/stone-hub.jpg',
                'content' => 'Our contracts have gone higher by about one-third of what we were getting before we took the services from SMAC Digital. They helped us a lot in finding more new clients from all over India digitally through their great website setup and digital marketing strategy.',
                'rating' => 5,
                'sort_order' => 1
            ],
            [
                'name' => 'Tumbledry',
                'role' => 'Client Partner',
                'avatar_path' => 'assets/people/tumbledry.png',
                'content' => "It's been 12 months of our association with SMAC Digital. Their partnership, service delivery and quality control have made us stand out among our competitors, and are some of the key reasons for our expansion. We are grateful to them.",
                'rating' => 5,
                'sort_order' => 2
            ],
            [
                'name' => 'Belearno',
                'role' => 'Client Partner',
                'avatar_path' => 'assets/people/belearno.png',
                'content' => 'Online learning and quizzing is on its zenith now and because of SMAC Digital, the students enrolled in our online learning platform Belearno are finding our website handy for their use. Thanks a million SMAC Digital for such great service.',
                'rating' => 5,
                'sort_order' => 3
            ],
            [
                'name' => 'Casa Interno',
                'role' => 'Client Partner',
                'avatar_path' => null,
                'content' => 'SMAC Digital gave our interior designing business exposure to the world of the internet. They gave us steady growth by making our website greatly influential. We really appreciate what you did.',
                'rating' => 5,
                'sort_order' => 4
            ]
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                $t
            );
        }

        // 3. SMAC Digital Blogs
        $blogsJsonPath = resource_path('js/data/blogsData.json');
        if (File::exists($blogsJsonPath)) {
            $blogs = json_decode(File::get($blogsJsonPath), true);
            foreach ($blogs as $b) {
                Blog::updateOrCreate(
                    ['slug' => $b['slug']],
                    [
                        'title' => $b['title'],
                        'category' => $b['tag'] ?? 'Insights',
                        'summary' => $b['excerpt'] ?? '',
                        'content' => $b['bodyHtml'] ?? '',
                        'image_path' => $b['image'] ?? '/assets/blog/' . ($b['imgLocal'] ?? 'lead-generation.jpg'),
                        'published_at' => !empty($b['date']) ? Carbon::parse($b['date']) : Carbon::now(),
                        'metatitle' => $b['title'] . ' | SMAC Digital Insights',
                        'metadescription' => $b['excerpt'] ?? '',
                        'metakeywords' => ($b['tag'] ?? '') . ', digital marketing, SMAC Digital'
                    ]
                );
            }
        }

        // 4. Ensure an Admin user exists with SMAC Digital credentials
        User::firstOrCreate(
            ['email' => 'admin@smacdigital.com'],
            [
                'name' => 'SMAC Digital Admin',
                'password' => Hash::make('Admin@123456'),
                'role' => 'superadmin',
                'permissions' => json_encode(['all'])
            ]
        );

        // 5. Ensure all 15 mega_services menu items exist with proper icons
        $services = [
            // 01 DIGITAL MARKETING
            ['title' => 'Search Engine Optimization', 'url' => '/services/search-engine-optimization', 'category_group' => '01 DIGITAL MARKETING', 'icon' => 'search', 'description' => 'Earn a stronger place in search.', 'sort_order' => 1],
            ['title' => 'Social Media Marketing', 'url' => '/services/social-media-marketing', 'category_group' => '01 DIGITAL MARKETING', 'icon' => 'camera', 'description' => 'Show up where the audience already spends time.', 'sort_order' => 2],
            ['title' => 'Lead Generation', 'url' => '/services/lead-generation', 'category_group' => '01 DIGITAL MARKETING', 'icon' => 'trending-up', 'description' => 'Campaigns judged by the inquiries they create.', 'sort_order' => 3],
            ['title' => 'Inbound Marketing', 'url' => '/services/inbound-marketing', 'category_group' => '01 DIGITAL MARKETING', 'icon' => 'download', 'description' => 'Bring the right people in.', 'sort_order' => 4],
            ['title' => 'Digital Media Planning', 'url' => '/services/digital-media-planning', 'category_group' => '01 DIGITAL MARKETING', 'icon' => 'layout', 'description' => 'Decide where attention and budget should work.', 'sort_order' => 5],
            // 02 CONTENT AND REPUTATION
            ['title' => 'Content Marketing', 'url' => '/services/content-marketing', 'category_group' => '02 CONTENT AND REPUTATION', 'icon' => 'file-text', 'description' => 'Give the brand something worth finding.', 'sort_order' => 6],
            ['title' => 'Video Marketing', 'url' => '/services/video-marketing', 'category_group' => '02 CONTENT AND REPUTATION', 'icon' => 'video', 'description' => 'Show the product in motion, then place the films.', 'sort_order' => 7],
            ['title' => 'Influencer Marketing', 'url' => '/services/influencer-marketing', 'category_group' => '02 CONTENT AND REPUTATION', 'icon' => 'users', 'description' => 'Put the brand with people the audience already trusts.', 'sort_order' => 8],
            ['title' => 'Online Reputation Management', 'url' => '/services/online-reputation-management', 'category_group' => '02 CONTENT AND REPUTATION', 'icon' => 'star', 'description' => 'Shape what people find about the brand.', 'sort_order' => 9],
            ['title' => 'Social Media Analytics', 'url' => '/services/social-media-analytics', 'category_group' => '02 CONTENT AND REPUTATION', 'icon' => 'bar-chart-2', 'description' => 'See which activity earns its place.', 'sort_order' => 10],
            // 03 WEBSITES AND PRODUCTS
            ['title' => 'Website Design and Development', 'url' => '/services/website-design-and-development', 'category_group' => '03 WEBSITES AND PRODUCTS', 'icon' => 'monitor', 'description' => 'A site that answers a marketing problem.', 'sort_order' => 11],
            ['title' => 'Mobile Application Development', 'url' => '/services/mobile-application-development', 'category_group' => '03 WEBSITES AND PRODUCTS', 'icon' => 'smartphone', 'description' => 'Meet people on the device they already use.', 'sort_order' => 12],
            ['title' => 'Marketing Automation', 'url' => '/services/marketing-automation', 'category_group' => '03 WEBSITES AND PRODUCTS', 'icon' => 'cpu', 'description' => 'Let email and social follow-up keep moving.', 'sort_order' => 13],
            ['title' => 'Sentiment Analysis', 'url' => '/services/sentiment-analysis', 'category_group' => '03 WEBSITES AND PRODUCTS', 'icon' => 'smile', 'description' => 'Read how people talk about the brand.', 'sort_order' => 14],
            ['title' => 'DevOps Services', 'url' => '/services/devops-services', 'category_group' => '03 WEBSITES AND PRODUCTS', 'icon' => 'cloud', 'description' => 'Keep the product shipping and stable.', 'sort_order' => 15],
        ];

        foreach ($services as $srv) {
            MenuItem::updateOrCreate(
                [
                    'menu_type' => 'mega_services',
                    'title' => $srv['title']
                ],
                [
                    'url' => $srv['url'],
                    'category_group' => $srv['category_group'],
                    'icon' => $srv['icon'],
                    'description' => $srv['description'],
                    'sort_order' => $srv['sort_order'],
                    'is_active' => true
                ]
            );
        }
    }
}
