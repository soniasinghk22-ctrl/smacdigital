<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/helpers.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $shared = $this->loadSharedViewData();

        View::share('site', $shared['site']);
        View::share('pageContents', $shared['pageContents']);
        View::share('globalCollections', $shared['globalCollections']);
        View::share('globalMarbles', $shared['globalMarbles']);
        View::share('globalSpecialists', $shared['globalSpecialists']);
        View::share('globalCategories', $shared['globalCategories'] ?? collect());
        View::share('globalLocations', $shared['globalLocations'] ?? collect());
    }

    /**
     * Load shared layout data, preferring a clean array cache.
     */
    protected function loadSharedViewData(): array
    {
        $cached = Cache::get('view.share.all');

        if (is_array($cached)
            && isset($cached['site'], $cached['pageContents'])
            && is_array($cached['site'])
            && is_array($cached['pageContents'])
            && is_array($cached['globalCollections'] ?? null)
            && is_array($cached['globalMarbles'] ?? null)
            && is_array($cached['globalSpecialists'] ?? null)
            && is_array($cached['globalCategories'] ?? null)
            && is_array($cached['globalLocations'] ?? null)
        ) {
            return [
                'site' => $cached['site'],
                'pageContents' => $cached['pageContents'],
                'globalCollections' => \App\Models\Collection::hydrate($cached['globalCollections']),
                'globalMarbles' => \App\Models\Marble::hydrate($cached['globalMarbles']),
                'globalSpecialists' => \App\Models\TeamMember::hydrate($cached['globalSpecialists']),
                'globalCategories' => \App\Models\Category::hydrate($cached['globalCategories']),
                'globalLocations' => \App\Models\LocationPage::hydrate($cached['globalLocations']),
            ];
        }

        // Drop corrupt / legacy cache payloads (e.g. serialized Eloquent objects)
        Cache::forget('view.share.all');

        $fresh = $this->fetchSharedViewData();
        Cache::put('view.share.all', [
            'site' => $fresh['site'],
            'pageContents' => $fresh['pageContents'],
            'globalCollections' => $fresh['globalCollections']->toArray(),
            'globalMarbles' => $fresh['globalMarbles']->toArray(),
            'globalSpecialists' => $fresh['globalSpecialists']->toArray(),
            'globalCategories' => $fresh['globalCategories']->toArray(),
            'globalLocations' => $fresh['globalLocations']->toArray(),
        ], 300);

        return $fresh;
    }

    protected function fetchSharedViewData(): array
    {
        $site = [];
        $pageContents = [];
        $globalCollections = collect();
        $globalMarbles = collect();
        $globalSpecialists = collect();
        $globalCategories = collect();
        $globalLocations = collect();

        try {
            if (Schema::hasTable('site_parameters')) {
                $site = \App\Models\SiteParameter::query()
                    ->pluck('value', 'id')
                    ->toArray();
            }

            if (Schema::hasTable('page_contents')) {
                $contents = \App\Models\PageContent::query()
                    ->select(['page', 'section', 'key', 'value'])
                    ->get();
                foreach ($contents as $content) {
                    $pageContents[$content->page][$content->section][$content->key] = $content->value;
                }
            }

            if (Schema::hasTable('collections')) {
                $globalCollections = \App\Models\Collection::query()
                    ->where('status', true)
                    ->orderBy('id')
                    ->get();
            }

            if (Schema::hasTable('marbles')) {
                $globalMarbles = \App\Models\Marble::query()
                    ->where('status', true)
                    ->orderBy('id')
                    ->get();
            }

            if (Schema::hasTable('team_members')) {
                $globalSpecialists = \App\Models\TeamMember::query()
                    ->where('status', true)
                    ->orderBy('id')
                    ->get();
            }

            \App\Models\Category::ensureTableExists();
            if (Schema::hasTable('categories')) {
                $globalCategories = \App\Models\Category::query()
                    ->where('status', true)
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->get();
            }

            if (Schema::hasTable('location_pages')) {
                $globalLocations = \App\Models\LocationPage::query()
                    ->where('status', 1)
                    ->orderBy('city')
                    ->get(['id', 'city', 'slug', 'title']);
            }
        } catch (\Exception $e) {
            // Keep empty defaults if DB is unavailable during boot.
        }

        return compact(
            'site',
            'pageContents',
            'globalCollections',
            'globalMarbles',
            'globalSpecialists',
            'globalCategories',
            'globalLocations'
        );
    }

    /**
     * Clear cached layout/shared view data after admin CMS updates.
     */
    public static function clearSharedViewCache(): void
    {
        Cache::forget('view.share.all');
    }
}
