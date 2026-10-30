<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Treatment;
use App\Models\TeamMember;
use App\Models\CmsPage;
use App\Models\SiteParameter;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap for the live site';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = \App\Models\PageContent::where('page', 'seo')
            ->where('section', 'settings')
            ->where('key', 'base_url')
            ->value('value')
            ?? SiteParameter::where('id', 'live_site_url')->value('value')
            ?? config('app.url');
        $baseUrl = rtrim($baseUrl, '/');
        
        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Static routes
        $staticRoutes = [
            '/' => ['priority' => '1.0', 'changefreq' => 'daily'],
            '/about-us' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/services' => ['priority' => '0.9', 'changefreq' => 'weekly'],
            '/testimonials' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/faq' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            '/blogs' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            '/contact-us' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/specialists' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            '/treatments' => ['priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        // Track what paths we added to avoid duplicates from CMS catch-all pages
        $addedPaths = array_keys($staticRoutes);

        foreach ($staticRoutes as $route => $config) {
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . $route . '</loc>';
            $xml[] = '    <lastmod>' . Carbon::now()->startOfDay()->toW3cString() . '</lastmod>';
            $xml[] = '    <changefreq>' . $config['changefreq'] . '</changefreq>';
            $xml[] = '    <priority>' . $config['priority'] . '</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic Services
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $lastMod = $service->updated_at ? $service->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/services/' . $service->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>weekly</changefreq>';
            $xml[] = '    <priority>0.8</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic Treatments
        $treatments = Treatment::where('status', true)->get();
        foreach ($treatments as $treatment) {
            $lastMod = $treatment->updated_at ? $treatment->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/treatments/' . $treatment->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>weekly</changefreq>';
            $xml[] = '    <priority>0.8</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic Specialists
        $specialists = TeamMember::where('status', true)->get();
        foreach ($specialists as $sp) {
            $lastMod = $sp->updated_at ? $sp->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/specialists/' . $sp->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>weekly</changefreq>';
            $xml[] = '    <priority>0.8</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic Blogs
        $blogs = Blog::whereNotNull('published_at')->get();
        foreach ($blogs as $blog) {
            $lastMod = $blog->updated_at ? $blog->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/blogs/' . $blog->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>monthly</changefreq>';
            $xml[] = '    <priority>0.7</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic Landing Pages
        $landingPages = \App\Models\LandingPage::all();
        foreach ($landingPages as $lp) {
            $lastMod = $lp->updated_at ? $lp->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/l/' . $lp->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>weekly</changefreq>';
            $xml[] = '    <priority>0.8</priority>';
            $xml[] = '  </url>';
        }

        // Dynamic CMS Pages (Catch-all)
        $cmsPages = CmsPage::where('status', true)->get();
        foreach ($cmsPages as $page) {
            // Exclude static route aliases to prevent duplicates
            if (in_array('/' . $page->slug, $addedPaths)) {
                continue;
            }
            $lastMod = $page->updated_at ? $page->updated_at->toW3cString() : Carbon::now()->startOfDay()->toW3cString();
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . $baseUrl . '/' . $page->slug . '</loc>';
            $xml[] = '    <lastmod>' . $lastMod . '</lastmod>';
            $xml[] = '    <changefreq>monthly</changefreq>';
            $xml[] = '    <priority>0.7</priority>';
            $xml[] = '  </url>';
        }

        $xml[] = '</urlset>';

        $sitemapContent = implode("\n", $xml);
        file_put_contents(public_path('sitemap.xml'), $sitemapContent);
        $this->info('Sitemap successfully generated at: ' . public_path('sitemap.xml'));

        // Generate LLMs.txt
        $siteName = SiteParameter::where('id', 'site_name')->value('value') ?? 'SumitZ Clinic';
        $siteTagline = SiteParameter::where('id', 'site_tagline')->value('value') ?? 'Orthopedic & Joint Replacement Surgeon';
        $address = SiteParameter::where('id', 'address')->value('value') ?? 'Baner, Pune';

        $llm = [];
        $llm[] = '# ' . $siteName . ' - AI & LLM Resource Directory';
        $llm[] = '';
        $llm[] = $siteName . ' (' . $siteTagline . ') is Pune\'s premier orthopedic, joint replacement, and physiotherapy clinic located at ' . $address . '. We specialize in restoring mobility and resolving pain using advanced surgical and non-surgical procedures.';
        $llm[] = '';
        $llm[] = 'This directory lists core services, treatments, medical specialists, guides, and pages for LLM agents (ChatGPT, Claude, Gemini, Perplexity) to index and answer user queries accurately.';
        $llm[] = '';
        $llm[] = '## Core Specialties';
        $llm[] = '';
        foreach ($services as $service) {
            $summary = trim($service->summary ?: 'Expert care under ' . $siteName);
            $llm[] = '- [' . $service->service_name . '](' . $baseUrl . '/services/' . $service->slug . ') - ' . $summary;
        }
        $llm[] = '';

        $llm[] = '## Clinic Treatments';
        $llm[] = '';
        foreach ($treatments as $treatment) {
            $summary = trim($treatment->metadescription ?: 'Specialized orthopedic treatment');
            $llm[] = '- [' . $treatment->name . '](' . $baseUrl . '/treatments/' . $treatment->slug . ') - ' . $summary;
        }
        $llm[] = '';

        $llm[] = '## Medical Specialists';
        $llm[] = '';
        foreach ($specialists as $sp) {
            $summary = trim($sp->designation ?: 'Specialist Doctor');
            $llm[] = '- [' . $sp->name . '](' . $baseUrl . '/specialists/' . $sp->slug . ') - ' . $summary;
        }
        $llm[] = '';

        $llm[] = '## Static Information Pages';
        $llm[] = '';
        $llm[] = '- [Home Page](' . $baseUrl . '/) - Clinic appointment booking, doctor profiles, and success stories.';
        $llm[] = '- [About Doctor](' . $baseUrl . '/about-us) - Doctor qualifications, credentials, and medical journey.';
        $llm[] = '- [All Services](' . $baseUrl . '/services) - Comprehensive list of bone, joint, and orthopedic services.';
        $llm[] = '- [All Treatments](' . $baseUrl . '/treatments) - Full list of specialized surgical and non-surgical treatments.';
        $llm[] = '- [All Specialists](' . $baseUrl . '/specialists) - Medical team profiles, experience, and bios.';
        $llm[] = '- [Frequently Asked Questions](' . $baseUrl . '/faq) - Direct answers to patient queries.';
        $llm[] = '- [Contact & Location](' . $baseUrl . '/contact-us) - Clinic branch map coordinates, phone numbers, and booking options.';
        $llm[] = '';
        $llm[] = '## Landing Pages';
        $llm[] = '';
        if ($landingPages->count() > 0) {
            foreach ($landingPages as $lp) {
                $desc = trim($lp->meta_description ?: 'Special campaign page for ' . $lp->title);
                $llm[] = '- [' . $lp->title . '](' . $baseUrl . '/l/' . $lp->slug . ') - ' . $desc;
            }
        } else {
            $llm[] = '*No active landing pages.*';
        }
        $llm[] = '';
        $llm[] = '## Blog Posts & Patient Guides';
        $llm[] = '';
        if ($blogs->count() > 0) {
            foreach ($blogs as $blog) {
                $summary = trim($blog->summary ?: 'Read our complete guide to ' . $blog->title);
                $llm[] = '- [' . $blog->title . '](' . $baseUrl . '/blogs/' . $blog->slug . ') - ' . $summary;
            }
        } else {
            $llm[] = '*No published blog posts.*';
        }
        $llm[] = '';

        $llmContent = implode("\n", $llm);
        file_put_contents(public_path('llms.txt'), $llmContent);
        $this->info('LLM directory successfully generated at: ' . public_path('llms.txt'));

        // Update robots.txt dynamically with the correct base URL sitemap link
        try {
            $robotsPath = public_path('robots.txt');
            $robotsContent = "User-agent: *\n" .
                "Disallow: /admin\n" .
                "Disallow: /login\n" .
                "Disallow: /register\n" .
                "Disallow: /api\n\n" .
                "User-agent: GPTBot\nAllow: /\n\n" .
                "User-agent: ChatGPT-User\nAllow: /\n\n" .
                "User-agent: Google-Extended\nAllow: /\n\n" .
                "User-agent: PerplexityBot\nAllow: /\n\n" .
                "User-agent: Claude-Web\nAllow: /\n\n" .
                "User-agent: Applebot-Extended\nAllow: /\n\n" .
                "Sitemap: " . $baseUrl . "/sitemap.xml\n" .
                "Link: <" . $baseUrl . "/llms.txt>; rel=\"llms\"\n";
            file_put_contents($robotsPath, $robotsContent);
            $this->info('robots.txt successfully updated with dynamic sitemap URL.');
        } catch (\Exception $e) {
            $this->warn('Failed to update robots.txt: ' . $e->getMessage());
        }
    }
}
