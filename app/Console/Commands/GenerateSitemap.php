<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {--root-url= : Canonical base URL for SMAC Digital}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap, robots.txt, and LLMO files for SMAC Digital';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $rootUrl = $this->option('root-url') ?: 'https://www.smacdigital.com';
        $this->info("Generating SMAC Digital SEO assets using root URL: {$rootUrl}");

        $request = Request::create('/admin/seo/regenerate-all', 'POST', [
            'root_url' => $rootUrl,
        ]);

        $admin = new AdminController();
        $admin->regenerateAllSeoFiles($request);

        $sitemapPath = public_path('sitemap.xml');
        $robotsPath = public_path('robots.txt');
        $llmsPath = public_path('llms.txt');

        $urlCount = is_file($sitemapPath) ? substr_count(file_get_contents($sitemapPath), '<loc>') : 0;
        $this->info("✓ sitemap.xml generated with {$urlCount} clean SMAC Digital URLs at {$sitemapPath}");
        $this->info("✓ robots.txt updated at {$robotsPath}");
        $this->info("✓ llms.txt and llms-full.txt generated at {$llmsPath}");

        return Command::SUCCESS;
    }
}
