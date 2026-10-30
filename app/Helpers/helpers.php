<?php

if (!function_exists('site_image')) {
    function site_image($path) {
        if (empty($path)) {
            return '';
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }
        $path = ltrim($path, '/');
        if (str_starts_with($path, 'assets/') || str_starts_with($path, 'uploads/') || str_starts_with($path, 'images/') || str_starts_with($path, 'storage/')) {
            return asset($path);
        }
        return asset('storage/' . $path);
    }
}

if (!function_exists('youtube_video_id')) {
    function youtube_video_id(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }
        $url = trim($url);
        // Handle direct 11-char video ID
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }
        // Handle full and short youtube URLs including shorts and live
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/|live/)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match)) {
            return $match[1];
        }
        return null;
    }
}

if (!function_exists('youtube_embed_url')) {
    function youtube_embed_url(?string $url): ?string
    {
        $id = youtube_video_id($url);
        return $id ? "https://www.youtube.com/embed/{$id}?autoplay=1&rel=0" : null;
    }
}

if (!function_exists('instagram_reel_code')) {
    function instagram_reel_code(?string $url): ?string
    {
        if (empty($url)) {
            return null;
        }
        $url = trim($url);
        // Handle shortcode directly (typically 9-14 chars alphanumeric and _-)
        if (preg_match('/^[a-zA-Z0-9_-]{9,15}$/', $url)) {
            return $url;
        }
        // Handle Instagram Reel / Post / TV URLs
        if (preg_match('%(?:instagram\.com|instagr\.am)/(?:reel|reels|p|tv)/([a-zA-Z0-9_-]+)%i', $url, $match)) {
            return $match[1];
        }
        return null;
    }
}

if (!function_exists('instagram_reel_embed_url')) {
    function instagram_reel_embed_url(?string $url): ?string
    {
        $code = instagram_reel_code($url);
        return $code ? "https://www.instagram.com/reel/{$code}/embed" : null;
    }
}

if (!function_exists('instagram_reel_thumbnail_url')) {
    function instagram_reel_thumbnail_url(?string $url, ?string $fallback = null): ?string
    {
        $code = instagram_reel_code($url);
        if ($code) {
            return "https://www.instagram.com/p/{$code}/media/?size=l";
        }
        return $fallback ? site_image($fallback) : null;
    }
}

if (!function_exists('italian_marble_pricelist')) {
    function italian_marble_pricelist(): array
    {
        static $items = null;
        if ($items !== null) {
            return $items;
        }

        $path = storage_path('app/italian_marble_pricelist.json');
        if (!is_file($path)) {
            $items = [];
            return $items;
        }

        $decoded = json_decode(file_get_contents($path), true);
        $items = is_array($decoded) ? $decoded : [];
        return $items;
    }
}

if (!function_exists('italian_marble_by_slug')) {
    function italian_marble_by_slug(string $slug): ?array
    {
        foreach (italian_marble_pricelist() as $item) {
            if (($item['slug'] ?? '') === $slug) {
                return $item;
            }
        }
        return null;
    }
}

if (!function_exists('site_cta_url')) {
    /**
     * Resolve CMS / hash CTA targets to real site pages.
     */
    function site_cta_url(?string $link, string $fallback = 'collections'): string
    {
        $link = trim((string) $link);
        if ($link === '' || $link === '#') {
            return route($fallback);
        }

        if (str_starts_with($link, '#')) {
            $hash = strtolower($link);
            if (in_array($hash, ['#specialties', '#collections', '#categories', '#slabs'], true)) {
                return route('collections');
            }
            if (in_array($hash, ['#contact-us', '#contact', '#appointment', '#catalogue', '#catalogue-section'], true)) {
                return route('contact');
            }
            if (in_array($hash, ['#infrastructure', '#showroom', '#infra'], true)) {
                return route('infrastructure');
            }
            if (in_array($hash, ['#about', '#curators'], true)) {
                return route('about');
            }
            if (in_array($hash, ['#blog', '#blogs', '#journals'], true)) {
                return route('blog');
            }
            if (in_array($hash, ['#faq', '#faqs'], true)) {
                return route('faq');
            }
            if (in_array($hash, ['#testimonials', '#reviews'], true)) {
                return route('testimonials');
            }
            return route($fallback);
        }

        if (preg_match('#^https?://#i', $link) || str_starts_with($link, '//')) {
            return $link;
        }

        return url($link);
    }
}

if (!function_exists('service_icon')) {
    /**
     * Return SVG icon markup matching SMAC Digital services.
     */
    function service_icon(?string $key = null, ?string $fallback = null): string
    {
        $raw = trim((string) ($key ?: $fallback));
        if ($raw === '') {
            $raw = 'search';
        }

        // If raw SVG was provided directly
        if (str_starts_with($raw, '<svg') && str_ends_with($raw, '</svg>')) {
            return $raw;
        }

        // Normalize string for key matching
        $normalized = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', basename($raw)));

        // Exact SVG lookup table
        $svgs = [
            'search' => '<svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'camera' => '<svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="7.5" r="0.8" fill="currentColor"/></svg>',
            'trending-up' => '<svg viewBox="0 0 24 24"><path d="M4 16.5 9 11l3 3 8-8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 6h6v6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'download' => '<svg viewBox="0 0 24 24"><path d="M12 4v10" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 11l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 19h14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'layout' => '<svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9.5h17M8 5v4.5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>',
            'file-text' => '<svg viewBox="0 0 24 24"><path d="M6 4.5h9.5L19 8v11.5H6z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M15 4.5V8h4M8.5 12h7M8.5 15.5h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'video' => '<svg viewBox="0 0 24 24"><rect x="3.5" y="6" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M15.5 10.5 20.5 8v8l-5-2.5z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            'users' => '<svg viewBox="0 0 24 24"><circle cx="9" cy="9" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M4.5 18.5c.8-2.4 2.4-3.5 4.5-3.5s3.7 1.1 4.5 3.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="16.5" cy="9.5" r="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 15c1.6.2 2.8 1 3.5 3" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'star' => '<svg viewBox="0 0 24 24"><path d="M12 3.8 14.2 9l5.5.4-4.2 3.5 1.3 5.3L12 15.4 7.2 18.2 8.5 13 4.3 9.4 9.8 9z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>',
            'bar-chart-2' => '<svg viewBox="0 0 24 24"><path d="M4 19V5M4 19h16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 15v-3M12 15V8M16 15v-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'monitor' => '<svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'smartphone' => '<svg viewBox="0 0 24 24"><rect x="8" y="3.5" width="8" height="17" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M11 18.2h2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'cpu' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'smile' => '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 14.2c.9 1.2 2.1 1.8 3.5 1.8s2.6-.6 3.5-1.8M9 10h.1M15 10h.1" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
            'cloud' => '<svg viewBox="0 0 24 24"><path d="M7 16.5a3.2 3.2 0 0 1 .4-6.3A4.2 4.2 0 0 1 15.6 8 3.4 3.4 0 0 1 18 14.5H7" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>',
        ];

        // Check direct key matches
        if (isset($svgs[$raw])) {
            return $svgs[$raw];
        }
        if (isset($svgs[$normalized])) {
            return $svgs[$normalized];
        }

        // Fuzzy alias matching by slug / title / icon name
        if (str_contains($normalized, 'search') || str_contains($normalized, 'seo') || str_contains($normalized, 'optimization')) {
            return $svgs['search'];
        }
        if (str_contains($normalized, 'camera') || str_contains($normalized, 'instagram') || str_contains($normalized, 'social-media-marketing') || str_contains($normalized, 'socialmediamarketing')) {
            return $svgs['camera'];
        }
        if (str_contains($normalized, 'trending') || str_contains($normalized, 'lead') || str_contains($normalized, 'generation')) {
            return $svgs['trending-up'];
        }
        if (str_contains($normalized, 'download') || str_contains($normalized, 'inbound')) {
            return $svgs['download'];
        }
        if (str_contains($normalized, 'layout') || str_contains($normalized, 'media-planning') || str_contains($normalized, 'mediaplanning') || str_contains($normalized, 'planning')) {
            return $svgs['layout'];
        }
        if (str_contains($normalized, 'file') || str_contains($normalized, 'content')) {
            return $svgs['file-text'];
        }
        if (str_contains($normalized, 'video') || str_contains($normalized, 'film') || str_contains($normalized, 'movie')) {
            return $svgs['video'];
        }
        if (str_contains($normalized, 'users') || str_contains($normalized, 'influencer') || str_contains($normalized, 'people')) {
            return $svgs['users'];
        }
        if (str_contains($normalized, 'star') || str_contains($normalized, 'reputation') || str_contains($normalized, 'orm')) {
            return $svgs['star'];
        }
        if (str_contains($normalized, 'chart') || str_contains($normalized, 'analytics') || str_contains($normalized, 'graph')) {
            return $svgs['bar-chart-2'];
        }
        if (str_contains($normalized, 'monitor') || str_contains($normalized, 'website') || str_contains($normalized, 'web') || str_contains($normalized, 'desktop')) {
            return $svgs['monitor'];
        }
        if (str_contains($normalized, 'phone') || str_contains($normalized, 'mobile') || str_contains($normalized, 'application') || str_contains($normalized, 'app')) {
            return $svgs['smartphone'];
        }
        if (str_contains($normalized, 'cpu') || str_contains($normalized, 'automation') || str_contains($normalized, 'marketing-automation')) {
            return $svgs['cpu'];
        }
        if (str_contains($normalized, 'smile') || str_contains($normalized, 'sentiment') || str_contains($normalized, 'emotion')) {
            return $svgs['smile'];
        }
        if (str_contains($normalized, 'cloud') || str_contains($normalized, 'devops') || str_contains($normalized, 'server')) {
            return $svgs['cloud'];
        }

        return $svgs['search'];
    }
}
