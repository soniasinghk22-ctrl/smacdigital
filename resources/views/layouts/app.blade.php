<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $site['site_meta_title'] ?? 'Stone Hub India | Importers of Premium Italian Marble & Quartzite Slabs')</title>
    <meta name="description" content="@yield('meta_description', $site['site_meta_description'] ?? 'Stone Hub India is India\'s premier natural stone curator. Sourcing directly from Italy, Greece, and Brazil, we offer luxury marble, granite, quartzite, and onyx slabs.')">
    <meta name="keywords" content="@yield('meta_keywords', $site['site_meta_keywords'] ?? 'imported marble, italian marble slabs, quartzite stockyard, luxury onyx stone, kishangarh marble seller, stone hub india')">
    <link rel="canonical" href="{{ !empty($pageContents['seo']['settings']['base_url']) ? rtrim($pageContents['seo']['settings']['base_url'], '/') . '/' . ltrim(Request::path(), '/') : url(Request::url()) }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title', $site['site_meta_title'] ?? 'Stone Hub India | Importers of Premium Italian Marble & Quartzite Slabs')" />
    <meta property="og:description" content="@yield('meta_description', $site['site_meta_description'] ?? 'Stone Hub India is India\'s premier natural stone curator. Sourcing directly from Italy, Greece, and Brazil, we offer luxury marble, granite, quartzite, and onyx slabs.')" />
    <meta property="og:url" content="{{ !empty($pageContents['seo']['settings']['base_url']) ? rtrim($pageContents['seo']['settings']['base_url'], '/') . '/' . ltrim(Request::path(), '/') : url(Request::url()) }}" />
    <meta property="og:site_name" content="Stone Hub India" />
    <meta property="og:image" content="@yield('og_image', !empty($site['logo_path']) ? site_image($site['logo_path']) : '')" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@stonehubindia" />
    <meta name="twitter:title" content="@yield('title', $site['site_meta_title'] ?? 'Stone Hub India | Importers of Premium Italian Marble & Quartzite Slabs')" />
    <meta name="twitter:description" content="@yield('meta_description', $site['site_meta_description'] ?? 'Stone Hub India is India\'s premier natural stone curator. Sourcing directly from Italy, Greece, and Brazil, we offer luxury marble, granite, quartzite, and onyx slabs.')" />
    <meta name="twitter:image" content="@yield('og_image', !empty($site['logo_path']) ? site_image($site['logo_path']) : '')" />

    
    <!-- Dynamic Favicon -->
    @if(!empty($site['favicon_path']))
        <link rel="icon" type="image/webp" href="{{ site_image($site['favicon_path']) }}">
    @else
        <link rel="icon" type="image/x-icon" href="/favicon.ico">
    @endif

    <!-- Google Fonts: load only the active theme pair -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @php
        $fontFamily = $site['global_font_family'] ?? 'outfit-inter';
        $fontHref = match ($fontFamily) {
            'poppins-roboto' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap',
            'montserrat-lato' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Lato:wght@400;700&display=swap',
            'playfair-georgia' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap',
            'sans-serif' => null,
            default => 'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
        };
    @endphp
    @if($fontHref)
        <link href="{{ $fontHref }}" rel="stylesheet">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')

    <!-- Custom Theme Styling Overrides -->
    <style id="custom-theme-styles">
        :root {
            /* Luxury Stone Hub Design System Tokens */
            --obsidian: #0b0b0c;
            --alabaster: #F7F7F9;
            --accent-gold: #C5A880;
            --accent-gold-hover: #B4956C;
            --white: #FFFFFF;
            --dark-charcoal: #151518;
            --card-bg-dark: #151518;
            --soft-border: rgba(255, 255, 255, 0.08);
            --radius-premium: 16px;

            @if(!empty($site['global_primary_color']))
                --primary-teal: {{ $site['global_primary_color'] }} !important;
                --mint-green: {{ $site['global_primary_color'] }} !important;
            @endif
            @if(!empty($site['global_primary_color_hover']))
                --primary-teal-light: {{ $site['global_primary_color_hover'] }} !important;
                --mint-green-light: {{ $site['global_primary_color_hover'] }} !important;
            @endif
            @if(!empty($site['global_primary_color_dark']))
                --primary-teal-dark: {{ $site['global_primary_color_dark'] }} !important;
                --text-dark: {{ $site['global_primary_color_dark'] }} !important;
            @endif
            @if(!empty($site['global_secondary_color']))
                --secondary-teal: {{ $site['global_secondary_color'] }} !important;
            @endif
            @if(!empty($site['global_button_color']))
                --accent-orange: {{ $site['global_button_color'] }} !important;
                --shadow-orange: 0 8px 20px {{ $site['global_button_color'] }}40 !important;
            @endif
            @if(!empty($site['global_button_color_hover']))
                --accent-orange-hover: {{ $site['global_button_color_hover'] }} !important;
            @endif
            @if(!empty($site['global_font_family']))
                @if($site['global_font_family'] === 'sans-serif')
                    --font-heading: system-ui, sans-serif !important;
                    --font-body: system-ui, sans-serif !important;
                @elseif($site['global_font_family'] === 'outfit-inter')
                    --font-heading: 'Outfit', sans-serif !important;
                    --font-body: 'Inter', sans-serif !important;
                @elseif($site['global_font_family'] === 'poppins-roboto')
                    --font-heading: 'Poppins', sans-serif !important;
                    --font-body: 'Roboto', sans-serif !important;
                @elseif($site['global_font_family'] === 'montserrat-lato')
                    --font-heading: 'Montserrat', sans-serif !important;
                    --font-body: 'Lato', sans-serif !important;
                @elseif($site['global_font_family'] === 'playfair-georgia')
                    --font-heading: 'Playfair Display', serif !important;
                    --font-body: 'Georgia', serif !important;
                @endif
            @endif
            @if(!empty($site['global_button_shape']))
                @if($site['global_button_shape'] === 'square')
                    --radius-sm: 0px !important;
                    --radius-md: 0px !important;
                    --radius-lg: 0px !important;
                    --radius-xl: 0px !important;
                @elseif($site['global_button_shape'] === 'rounded')
                    --radius-sm: 4px !important;
                    --radius-md: 8px !important;
                    --radius-lg: 12px !important;
                    --radius-xl: 16px !important;
                @elseif($site['global_button_shape'] === 'pill')
                    --radius-sm: 999px !important;
                    --radius-md: 999px !important;
                    --radius-lg: 999px !important;
                    --radius-xl: 999px !important;
                @endif
            @endif

            /* Background variables */
            @if(!empty($site['index_hero_bg'])) --index-hero-bg: {!! $site['index_hero_bg'] !!} !important; @endif
            @if(!empty($site['index_services_bg'])) --index-services-bg: {!! $site['index_services_bg'] !!} !important; @endif
            @if(!empty($site['index_about_bg'])) --index-about-bg: {!! $site['index_about_bg'] !!} !important; @endif
            @if(!empty($site['index_why_bg'])) --index-why-bg: {!! $site['index_why_bg'] !!} !important; @endif
            @if(!empty($site['index_testimonials_bg'])) --index-testimonials-bg: {!! $site['index_testimonials_bg'] !!} !important; @endif
            @if(!empty($site['index_faq_bg'])) --index-faq-bg: {!! $site['index_faq_bg'] !!} !important; @endif
            @if(!empty($site['index_cta_bg'])) --index-cta-bg: {!! $site['index_cta_bg'] !!} !important; @endif
        }

        /* Light theme + dark text ONLY on internal pages (never force on homepage) */
        body:not(.homepage-active) {
            background-color: #f4f2ed !important;
            color: #2f2f36 !important;
        }

        /* Default heading colors for content pages (no !important so dark surfaces can override) */
        body:not(.homepage-active) h1,
        body:not(.homepage-active) h2,
        body:not(.homepage-active) h3,
        body:not(.homepage-active) h4,
        body:not(.homepage-active) h5,
        body:not(.homepage-active) h6 {
            color: #121214;
            font-family: 'Outfit', var(--font-heading), sans-serif;
        }

        /* Enforce crisp high-contrast white headings & subtitles on all dark surfaces, city pages, heroes, and CTAs */
        .city-hero h1,
        .city-hero h2,
        .city-hero h3,
        .city-hero h4,
        .city-hero p,
        .page-hero h1,
        .page-hero h2,
        .page-hero h3,
        .page-hero-content h1,
        .page-hero-content h2,
        .page-hero-content h3,
        .details-hero h1,
        .details-hero h2,
        .details-hero h3,
        .hero h1,
        .hero h2,
        .hero h3,
        .hero-section h1,
        .hero-section h2,
        .hero-section h3,
        .about-hero h1,
        .about-hero h2,
        .infra-hero h1,
        .infra-hero h2,
        .final-cta-section h1,
        .final-cta-section h2,
        .final-cta-section h3,
        .final-cta-section h4,
        .cta-section h1,
        .cta-section h2,
        .cta-section h3,
        .dark-section h1,
        .dark-section h2,
        .dark-section h3,
        .dark-section h4,
        .dark-hero h1,
        .dark-hero h2,
        .dark-hero h3,
        section[style*="background: var(--obsidian)"] h1,
        section[style*="background: var(--obsidian)"] h2,
        section[style*="background: var(--obsidian)"] h3,
        section[style*="background: var(--obsidian)"] h4,
        section[style*="background: #000"] h1,
        section[style*="background: #000"] h2,
        section[style*="background: #000"] h3,
        section[style*="background: #000"] h4,
        section[style*="background: #0b0b0c"] h1,
        section[style*="background: #0b0b0c"] h2,
        section[style*="background: #0b0b0c"] h3,
        section[style*="background: #0d0d0f"] h1,
        section[style*="background: #0d0d0f"] h2,
        section[style*="background: #0d0d0f"] h3,
        section[style*="background: #111113"] h1,
        section[style*="background: #111113"] h2,
        section[style*="background: #111113"] h3,
        section[style*="background: #111113"] h4,
        section[style*="background: #141418"] h1,
        section[style*="background: #141418"] h2,
        section[style*="background: #141418"] h3,
        section[style*="background: #17171a"] h1,
        section[style*="background: #17171a"] h2,
        section[style*="background: #17171a"] h3,
        section[style*="background: #18181b"] h1,
        section[style*="background: #18181b"] h2,
        section[style*="background: #18181b"] h3,
        section[style*="linear-gradient(180deg, rgba(11, 11, 12"] h1,
        section[style*="linear-gradient(180deg, rgba(11, 11, 12"] h2,
        section[style*="linear-gradient(180deg, rgba(11, 11, 12"] h3,
        section[style*="linear-gradient(135deg, #17171a"] h1,
        section[style*="linear-gradient(135deg, #17171a"] h2,
        section[style*="linear-gradient(135deg, #17171a"] h3,
        footer.footer h3,
        footer.footer h4 {
            color: #ffffff !important;
        }

        body:not(.homepage-active) .blog-content h1,
        body:not(.homepage-active) .blog-content h2,
        body:not(.homepage-active) .blog-content h3,
        body:not(.homepage-active) .blog-content h4,
        body:not(.homepage-active) .blog-content h5,
        body:not(.homepage-active) .blog-content h6 {
            color: #121214 !important;
        }

        /* Enforce dynamic backgrounds if variables are set */
        @if(!empty($site['index_hero_bg']))
        .hero, .hero-slider-container { background: var(--index-hero-bg) !important; }
        @endif
        @if(!empty($site['index_services_bg']))
        #specialties { background: var(--index-services-bg) !important; }
        @endif
        @if(!empty($site['index_about_bg']))
        #about-doctor { background: var(--index-about-bg) !important; }
        @endif
        @if(!empty($site['index_why_bg']))
        #why-choose-us { background: var(--index-why-bg) !important; }
        @endif
        @if(!empty($site['index_testimonials_bg']))
        .testimonials-section { background: var(--index-testimonials-bg) !important; }
        @endif
        @if(!empty($site['index_faq_bg']))
        #locations { background: var(--index-faq-bg) !important; }
        @endif
        @if(!empty($site['index_cta_bg']))
        .final-cta-section { background: var(--index-cta-bg) !important; }
        @endif

        /* Desktop Hover Dropdowns & Dynamic Menus */
        .nav-links li {
            position: relative;
        }
        .nav-dropdown-item:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background-color: #ffffff !important;
            min-width: 240px;
            box-shadow: 0 14px 36px rgba(15, 15, 17, 0.1);
            border-radius: 12px;
            padding: 0.65rem 0;
            list-style: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1001;
            border: 1px solid rgba(15, 15, 17, 0.08);
        }
        .dropdown-menu li {
            width: 100%;
            text-align: left;
        }
        .dropdown-menu li a {
            display: block;
            padding: 0.65rem 1.35rem;
            font-family: 'Outfit', var(--font-heading), sans-serif;
            font-size: 0.9rem;
            color: #2f2f36 !important;
            font-weight: 550;
            transition: all 0.2s ease;
            text-decoration: none;
            white-space: nowrap;
        }
        .header .nav-links .dropdown-menu a {
            color: #2f2f36 !important;
        }
        .header .nav-links > li > a {
            padding-left: 0.85rem;
            padding-right: 0.85rem;
        }
        .dropdown-menu li a:hover {
            background-color: rgba(197, 168, 128, 0.15) !important;
            color: var(--accent-gold, #C5A880) !important;
        }
        .nav-chevron {
            width: 14px;
            height: 14px;
            margin-left: 2px;
            transition: transform 0.2s ease;
            display: inline-block;
            vertical-align: middle;
        }
        .nav-dropdown-item:hover .nav-chevron {
            transform: rotate(180deg);
        }

        /* Horizontal Mega Dropdown for Collections */
        .dropdown-mega {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(12px);
            background-color: #ffffff !important;
            width: 760px;
            max-width: calc(100vw - 40px);
            box-shadow: 0 20px 50px rgba(15, 15, 17, 0.16);
            border-radius: 16px;
            padding: 1.5rem 1.75rem 1.25rem;
            list-style: none;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1001;
            border: 1px solid rgba(15, 15, 17, 0.08);
        }
        .nav-dropdown-item:hover .dropdown-mega {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        .mega-grid {
            display: grid;
            grid-template-columns: 1.15fr 1fr 1fr;
            gap: 1.75rem;
            text-align: left;
        }
        .mega-col-title {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #8a6d3b;
            margin-bottom: 0.75rem;
            padding-bottom: 0.4rem;
            border-bottom: 1px solid rgba(15, 15, 17, 0.06);
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'Outfit', var(--font-heading), sans-serif;
        }
        .mega-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }
        .mega-links-list li {
            width: 100%;
            margin: 0;
        }
        .mega-links-list li a {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            padding: 0.45rem 0.65rem !important;
            font-family: 'Outfit', var(--font-heading), sans-serif;
            font-size: 0.88rem !important;
            color: #2f2f36 !important;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease;
            text-decoration: none;
            line-height: 1.3;
        }
        .mega-links-list li a:hover {
            background-color: rgba(197, 168, 128, 0.14) !important;
            color: #121214 !important;
            padding-left: 0.85rem !important;
        }
        .mega-badge {
            font-size: 0.68rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            background: rgba(197, 168, 128, 0.18);
            color: #8a6d3b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .mega-footer {
            grid-column: 1 / -1;
            margin-top: 0.85rem;
            padding: 0.75rem 1rem;
            border-top: 1px solid rgba(15, 15, 17, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #faf9f6;
            border-radius: 8px;
        }
        .mega-footer a {
            font-size: 0.85rem;
            font-weight: 600;
            color: #121214 !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }
        .mega-footer a:hover {
            color: var(--accent-gold, #C5A880) !important;
        }

        @media (max-width: 1100px) {
            .dropdown-menu {
                position: static;
                transform: none !important;
                opacity: 1;
                visibility: visible;
                box-shadow: none;
                border: none;
                background-color: rgba(0, 0, 0, 0.02);
                padding-left: 1.5rem;
                display: none;
                min-width: 100%;
            }
            .dropdown-mega {
                width: 100% !important;
                max-width: 100% !important;
                position: static !important;
                transform: none !important;
                box-shadow: none !important;
                border: none !important;
                padding: 0.5rem 1rem !important;
                background: transparent !important;
            }
            .mega-grid {
                grid-template-columns: 1fr !important;
                gap: 1.25rem !important;
            }
            .mega-footer {
                flex-direction: column;
                gap: 8px;
                align-items: flex-start;
            }
            .nav-dropdown-item.active-mobile .dropdown-menu {
                display: block;
            }
            .nav-dropdown-item.active-mobile .nav-chevron {
                transform: rotate(180deg);
            }
            .nav-links li {
                text-align: left;
            }
            .nav-item {
                display: flex !important;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                box-sizing: border-box;
                padding: 1rem 1.5rem !important;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                color: #1a1a1e !important;
            }
            .nav-links.open > li > a,
            .nav-links.open .nav-item,
            body.homepage-active .header .nav-links.open > li > a {
                color: #1a1a1e !important;
            }
            .nav-links.open > li > a:hover,
            .nav-links.open > li > a.active,
            body.homepage-active .header .nav-links.open > li > a.active {
                color: var(--accent-gold, #C5A880) !important;
            }
        }

        /* Force highly premium black theme for the footer on all pages */
        footer.footer {
            background-color: #000000 !important;
            color: #d1d5db !important;
            border-top: none !important;
            padding: 5rem 0 2rem 0 !important;
        }
        footer.footer h3, footer.footer h4 {
            color: #ffffff !important;
            font-family: 'Outfit', var(--font-heading), sans-serif !important;
            font-weight: 700 !important;
            margin-bottom: 1.25rem !important;
            text-transform: none !important;
            letter-spacing: -0.01em !important;
            font-size: 1.05rem !important;
        }
        footer.footer a {
            color: #a1a1aa !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
        }
        footer.footer a:hover {
            color: var(--accent-gold, #C5A880) !important;
        }
        footer.footer .footer-bottom {
            border-top: none !important;
            padding-top: 2rem !important;
            margin-top: 3rem !important;
            text-align: center !important;
            color: #71717a !important;
        }
        
        /* General Layering fixes */
        header.header {
            position: sticky !important;
            top: 0 !important;
            z-index: 1000 !important;
        }
        .dropdown-menu {
            z-index: 1050 !important;
        }
    </style>

    <!-- Google Tag (gtag.js) -->
    @if(!empty($site['google_tag_id']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $site['google_tag_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $site['google_tag_id'] }}');
        </script>
    @endif

    <!-- Custom Header Tracking Scripts -->
    @if(!empty($site['header_scripts']))
        {!! $site['header_scripts'] !!}
    @endif

    <!-- Structured SEO Schemas -->
    @yield('schema')

    @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="Z6_bJzFWyldCGZIlsK6idnrCxu0xhNGdRRsNbreDovo" />
</head>
<body class="stonehub-body @yield('body_class')">

    <!-- Sticky Header -->
    <header class="header">
        <!-- Top Strip -->
        <div class="top-strip">
            <div class="container">
                <div class="top-strip-actions">
                    <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" class="top-strip-phone" aria-label="Call {{ $site['phone'] ?? '+91 96727 77749' }}">
                        <i data-lucide="phone" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="top-strip-btn">{{ $pageContents['header']['top_strip']['cta_label'] ?? 'Download Brochure' }}</a>
                </div>
            </div>
        </div>

        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">
                @if(!empty($site['logo_path']))
                    <img src="{{ site_image($site['logo_path']) }}" alt="{{ $site['site_name'] ?? 'Stone Hub India' }}" class="header-brand-logo">
                @else
                    <img src="{{ asset('assets/images/logo.png') }}" alt="{{ $site['site_name'] ?? 'Stone Hub India' }}" class="header-brand-logo">
                @endif
            </a>
            
            <nav style="margin-left: auto;">
                <ul class="nav-links">
                    @php
                        $hasSlotConfig = false;
                        for ($slot = 1; $slot <= 8; $slot++) {
                            if (!empty($pageContents['header']["menu_item_{$slot}"]['label'])) {
                                $hasSlotConfig = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasSlotConfig)
                        @for($i = 1; $i <= 8; $i++)
                            @php
                                $menuLabel = $pageContents['header']["menu_item_{$i}"]['label'] ?? '';
                                $menuLink = $pageContents['header']["menu_item_{$i}"]['link'] ?? '';
                                $menuIcon = $pageContents['header']["menu_item_{$i}"]['icon'] ?? '';
                                $menuDrop = $pageContents['header']["menu_item_{$i}"]['dropdown_type'] ?? 'none';
                                $menuCustom = $pageContents['header']["menu_item_{$i}"]['custom_dropdown'] ?? '';
                                
                                $isActive = false;
                                if (!empty($menuLink)) {
                                    $currentPath = '/' . request()->path();
                                    $isActive = (request()->is(ltrim($menuLink, '/')) || $currentPath === $menuLink || (request()->path() === '/' && $menuLink === '/'));
                                }
                            @endphp
                            @if(!empty($menuLabel))
                                <li class="{{ $menuDrop !== 'none' ? 'nav-dropdown-item' : '' }}">
                                    <a href="{{ $menuLink ?: '#' }}" class="nav-item {{ $isActive ? 'active' : '' }}">
                                        @if(!empty($menuIcon))
                                            <i data-lucide="{{ $menuIcon }}" style="width: 16px; height: 16px; display: inline-block; vertical-align: middle;"></i>
                                        @endif
                                        {{ $menuLabel }}
                                        @if($menuDrop !== 'none') 
                                            <i data-lucide="chevron-down" class="nav-chevron"></i> 
                                        @endif
                                    </a>
                                    @if($menuDrop !== 'none')
                                        <ul class="dropdown-menu">
                                            @if($menuDrop === 'marbles' && isset($globalMarbles))
                                                @foreach($globalMarbles as $gm)
                                                    <li><a href="{{ route('products.show', $gm->slug) }}">{{ $gm->name }}</a></li>
                                                @endforeach
                                            @elseif($menuDrop === 'collections' && isset($globalCollections))
                                                @foreach($globalCollections as $gc)
                                                    <li><a href="{{ route('collections.show', $gc->slug) }}">{{ $gc->name }}</a></li>
                                                @endforeach
                                            @elseif($menuDrop === 'custom' && !empty($menuCustom))
                                                @foreach(explode("\n", $menuCustom) as $line)
                                                    @php
                                                        $parts = explode('|', trim($line));
                                                        $cLabel = $parts[0] ?? '';
                                                        $cUrl = $parts[1] ?? '#';
                                                    @endphp
                                                    @if(!empty($cLabel))
                                                        <li><a href="{{ url($cUrl) }}">{{ $cLabel }}</a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endfor
                    @else
                        {{-- Streamlined Header Navigation --}}
                        <li><a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                        <li><a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">{{ $pageContents['header']['menu']['about'] ?? 'About Us' }}</a></li>
                        
                        <!-- Collections Horizontal Mega Dropdown -->
                        <li class="nav-dropdown-item">
                            <a href="{{ route('collections') }}" class="nav-item {{ request()->routeIs('collections') || request()->routeIs('collections.show') ? 'active' : '' }}">
                                Collections
                                <i data-lucide="chevron-down" class="nav-chevron"></i>
                            </a>
                            <div class="dropdown-menu dropdown-mega">
                                <div class="mega-grid">
                                    <!-- Col 1: Signature Italian Collections -->
                                    <div>
                                        <div class="mega-col-title">
                                            <i data-lucide="gem" style="width: 13px; height: 13px; color: var(--accent-gold);"></i>
                                            Signature Series
                                        </div>
                                        <ul class="mega-links-list">
                                            <li><a href="{{ route('collections.show', 'bellezza') }}">Bellezza</a></li>
                                            <li><a href="{{ route('collections.show', 'migliore') }}">Migliore</a></li>
                                            <li><a href="{{ route('collections.show', 'forte') }}">Forte</a></li>
                                            <li><a href="{{ route('collections.show', 'amore') }}">Amore</a></li>
                                            <li><a href="{{ route('collections.show', 'spazio') }}">Spazio</a></li>
                                            <li><a href="{{ route('collections.show', 'giovane') }}">Giovane</a></li>
                                            <li><a href="{{ route('collections.show', 'lontano') }}">Lontano</a></li>
                                        </ul>
                                    </div>

                                    <!-- Col 2: Stone Types & Imports -->
                                    <div>
                                        <div class="mega-col-title">
                                            <i data-lucide="layers" style="width: 13px; height: 13px; color: var(--accent-gold);"></i>
                                            Natural Stone Types
                                        </div>
                                        <ul class="mega-links-list">
                                            <li><a href="{{ route('collections.show', 'italian-marble') }}">Italian Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'imported-marble') }}">Imported Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'quartzite') }}">Exotic Quartzite</a></li>
                                            <li><a href="{{ route('collections.show', 'onyx') }}">Translucent Onyx</a></li>
                                            <li><a href="{{ route('collections.show', 'travertine') }}">Classic Travertine</a></li>
                                            <li><a href="{{ route('pricelist') }}" style="color: #8a6d3b !important; font-weight: 600;">Italian Marble Price List</a></li>
                                        </ul>
                                    </div>

                                    <!-- Col 3: Color Tones & Palettes -->
                                    <div>
                                        <div class="mega-col-title">
                                            <i data-lucide="palette" style="width: 13px; height: 13px; color: var(--accent-gold);"></i>
                                            By Color Palette
                                        </div>
                                        <ul class="mega-links-list">
                                            <li><a href="{{ route('collections.show', 'white-marble') }}">White & Light Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'beige-marble') }}">Beige & Cream Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'grey-marble') }}">Grey & Silver Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'black-marble') }}">Black & Dark Marble</a></li>
                                            <li><a href="{{ route('collections.show', 'brown-marble') }}">Brown & Earth Tones</a></li>
                                            <li><a href="{{ route('collections.show', 'exotic-colored-marble') }}">Exotic & Rare Colors</a></li>
                                        </ul>
                                    </div>

                                    <!-- Mega Footer -->
                                    <div class="mega-footer">
                                        <a href="{{ route('collections') }}">
                                            <i data-lucide="grid" style="width: 14px; height: 14px;"></i>
                                            <strong>Browse All 19 Marble Collections</strong>
                                        </a>
                                        <a href="{{ route('pricelist') }}">
                                            <i data-lucide="tag" style="width: 14px; height: 14px; color: var(--accent-gold);"></i>
                                            <span>2026 Kishangarh Price Guide &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li><a href="{{ route('application') }}" class="nav-item {{ request()->routeIs('application*') ? 'active' : '' }}">Applications</a></li>
                        <li><a href="{{ route('infrastructure') }}" class="nav-item {{ request()->routeIs('infrastructure') ? 'active' : '' }}">Infrastructure</a></li>
                        <li><a href="{{ route('testimonials') }}" class="nav-item {{ request()->routeIs('testimonials') ? 'active' : '' }}">{{ $pageContents['header']['menu']['success_stories'] ?? 'Testimonials' }}</a></li>
                        <li><a href="{{ route('blog') }}" class="nav-item {{ request()->routeIs('blog') || request()->routeIs('blog.*') ? 'active' : '' }}">{{ $pageContents['header']['menu']['blog'] ?? 'Blog' }}</a></li>
                        <li><a href="{{ route('contact') }}" class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">{{ $pageContents['header']['menu']['contact'] ?? 'Contact Us' }}</a></li>
                    @endif
                </ul>
            </nav>
            
            <div class="nav-actions">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-sm nav-catalogue-btn"><i data-lucide="download"></i><span>{{ $pageContents['header']['menu']['cta'] ?? 'Request Catalogue' }}</span></a>
            </div>
            
            <button class="mobile-toggle" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 3rem;">
            <!-- Left Column -->
            <div class="footer-col footer-col-about">
                <div class="logo footer-brand" style="margin-bottom:1.25rem;">
                    <a href="{{ route('home') }}" aria-label="{{ $site['site_name'] ?? 'Stone Hub India' }} home">
                        @if(!empty($site['logo_path']))
                            <img src="{{ site_image($site['logo_path']) }}" alt="{{ $site['site_name'] ?? 'Stone Hub India' }}" class="header-brand-logo footer-brand-logo">
                        @else
                            <img src="{{ asset('assets/images/logo.png') }}" alt="{{ $site['site_name'] ?? 'Stone Hub India' }}" class="header-brand-logo footer-brand-logo">
                        @endif
                    </a>
                </div>
                <h4 style="color: var(--accent-gold); font-size: 0.95rem; margin-bottom: 0.5rem; font-family: var(--font-heading), sans-serif; font-weight: 700;">{{ $pageContents['footer']['about']['tagline'] ?? 'Curators & Importers of Premium Natural Stone Slabs' }}</h4>
                <p>{{ $pageContents['footer']['about']['description'] ?? 'Direct importers of premium Italian marble, exotic quartzite, travertine, and translucent onyx slabs sourced globally.' }}</p>
            </div>
            
            <!-- Middle Column -->
            <div class="footer-col" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <h3 style="margin-bottom: 1.25rem;">{{ $pageContents['footer']['headings']['quick_links'] ?? 'Quick Links' }}</h3>
                    <ul class="footer-links-list">
                        @php
                            $fType = $pageContents['footer']['quick_links']['type'] ?? 'default';
                            $fCustom = $pageContents['footer']['quick_links']['custom_links'] ?? '';
                        @endphp
                        @if($fType === 'default')
                            @php
                                $hasSlotConfig = false;
                                for ($slot = 1; $slot <= 8; $slot++) {
                                    if (!empty($pageContents['header']["menu_item_{$slot}"]['label'])) {
                                        $hasSlotConfig = true;
                                        break;
                                    }
                                }
                            @endphp
                            @if($hasSlotConfig)
                                @for($i = 1; $i <= 8; $i++)
                                    @php
                                        $menuLabel = $pageContents['header']["menu_item_{$i}"]['label'] ?? '';
                                        $menuLink = $pageContents['header']["menu_item_{$i}"]['link'] ?? '';
                                    @endphp
                                    @if(!empty($menuLabel))
                                        <li><a href="{{ $menuLink ?: '#' }}">{{ $menuLabel }}</a></li>
                                    @endif
                                @endfor
                            @else
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('collections') }}">Collections</a></li>
                                <li><a href="{{ route('application') }}">Applications</a></li>
                                <li><a href="{{ route('infrastructure') }}">Infrastructure</a></li>
                                <li><a href="{{ route('pricelist') }}">Italian Marble Price List</a></li>
                                <li><a href="{{ route('enquiry') }}">Project Enquiry</a></li>
                                <li><a href="{{ route('careers') }}">Careers</a></li>
                                <li><a href="{{ route('faq') }}">FAQ</a></li>
                                <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            @endif
                        @elseif($fType === 'treatments' && isset($globalMarbles))
                            @foreach($globalMarbles as $gt)
                                <li><a href="{{ route('products.show', $gt->slug) }}">{{ $gt->name }}</a></li>
                            @endforeach
                        @elseif($fType === 'services' && isset($globalCollections))
                            @foreach($globalCollections as $gs)
                                <li><a href="{{ route('collections.show', $gs->slug) }}">{{ $gs->name }}</a></li>
                            @endforeach
                        @elseif($fType === 'specialists' && isset($globalSpecialists))
                            @foreach($globalSpecialists as $gsp)
                                <li><a href="{{ route('specialists.show', $gsp->slug) }}">{{ $gsp->name }}</a></li>
                            @endforeach
                        @elseif($fType === 'custom' && !empty($fCustom))
                            @foreach(explode("\n", $fCustom) as $line)
                                @php
                                    $parts = explode('|', trim($line));
                                    $cLabel = $parts[0] ?? '';
                                    $cUrl = $parts[1] ?? '#';
                                @endphp
                                @if(!empty($cLabel))
                                    <li><a href="{{ url($cUrl) }}">{{ $cLabel }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div>
                    <h3 style="margin-bottom: 1.25rem;">{{ $pageContents['footer']['headings']['services'] ?? 'Collections' }}</h3>
                    <ul class="footer-links-list">
                        @if(isset($globalCollections) && $globalCollections->count() > 0)
                            @foreach($globalCollections->take(12) as $gc)
                                <li><a href="{{ route('collections.show', $gc->slug) }}">{{ $gc->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="{{ route('collections.show', 'italian-marble') }}">Italian Marble</a></li>
                            <li><a href="{{ route('collections.show', 'imported-marble') }}">Imported Marble</a></li>
                            <li><a href="{{ route('collections.show', 'quartzite') }}">Exotic Quartzite</a></li>
                            <li><a href="{{ route('collections.show', 'onyx') }}">Translucent Onyx</a></li>
                            <li><a href="{{ route('collections.show', 'travertine') }}">Classic Travertine</a></li>
                            <li><a href="{{ route('collections.show', 'bellezza') }}">Bellezza Collection</a></li>
                            <li><a href="{{ route('collections.show', 'migliore') }}">Migliore Collection</a></li>
                            <li><a href="{{ route('collections.show', 'forte') }}">Forte Collection</a></li>
                            <li><a href="{{ route('collections.show', 'amore') }}">Amore Collection</a></li>
                            <li><a href="{{ route('collections.show', 'spazio') }}">Spazio Collection</a></li>
                            <li><a href="{{ route('collections.show', 'giovane') }}">Giovane Collection</a></li>
                            <li><a href="{{ route('collections.show', 'lontano') }}">Lontano Collection</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="footer-col">
                <div class="newsletter-wrap" style="margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 0.5rem; color: white;">{{ $pageContents['footer']['newsletter']['title'] ?? 'Subscribe to Stone Journals' }}</h3>
                    <p style="font-size: 0.85rem; color: var(--text-light-muted); margin-bottom: 0.75rem;">{{ $pageContents['footer']['newsletter']['description'] ?? 'Get exclusive design inspiration, new shipment arrivals, and architectural blueprints.' }}</p>
                    <form onsubmit="event.preventDefault(); alert('Subscribed successfully!'); this.reset();" style="display: flex; gap: 8px;">
                        <input type="email" placeholder="{{ $pageContents['footer']['newsletter']['placeholder'] ?? 'Enter your email' }}" required style="padding: 0.5rem 0.75rem; border-radius: 4px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.05); color: white; font-size: 0.85rem; flex-grow: 1; outline: none;">
                        <button type="submit" class="btn btn-primary btn-sm" style="padding: 0.5rem 1rem; font-size: 0.85rem; background: var(--accent-gold); border-color: var(--accent-gold); color: #000; font-weight: bold;">{{ $pageContents['footer']['newsletter']['btn_label'] ?? 'Subscribe' }}</button>
                    </form>
                </div>
                
                <h3 style="margin-bottom: 1rem;">{{ $pageContents['footer']['headings']['contact'] ?? 'Experience Center' }}</h3>
                <ul class="footer-contact-info">
                    <li style="align-items: flex-start; display: flex; gap: 12px; margin-bottom: 0.85rem;">
                        <i data-lucide="map-pin" style="margin-top: 2px; width: 22px; height: 22px; min-width: 22px; color: var(--accent-gold, #C5A880);"></i>
                        <span style="font-size: 0.92rem; line-height: 1.55; color: #d4d4d8;">{{ $pageContents['footer']['contact']['address'] ?? ($site['address'] ?? 'Plot No. 12, Industrial Area, Makrana Road, Kishangarh, Rajasthan - 305801') }}</span>
                    </li>
                    <li style="align-items: center; display: flex; gap: 12px; margin-bottom: 0.85rem;">
                        <i data-lucide="phone" style="width: 20px; height: 20px; min-width: 20px; color: var(--accent-gold, #C5A880);"></i>
                        <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" style="font-size: 0.92rem; color: #d4d4d8; text-decoration: none;">{{ $site['phone'] ?? '+91 96727 77749' }}</a>
                    </li>
                    <li style="align-items: center; display: flex; gap: 12px; margin-bottom: 0.85rem;">
                        <i data-lucide="mail" style="width: 20px; height: 20px; min-width: 20px; color: var(--accent-gold, #C5A880);"></i>
                        <a href="mailto:{{ $site['email'] ?? 'info@stonehubindia.com' }}" style="font-size: 0.92rem; color: #d4d4d8; text-decoration: none;">{{ $site['email'] ?? 'info@stonehubindia.com' }}</a>
                    </li>
                </ul>
                
                <div class="social-links" style="margin-top: 1.25rem;">
                    {{-- Inline brand SVGs: Lucide removed facebook/instagram/linkedin/twitter from recent versions --}}
                    <a href="{{ !empty($site['social_facebook']) ? $site['social_facebook'] : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook" title="Facebook">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="{{ !empty($site['social_instagram']) ? $site['social_instagram'] : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram" title="Instagram">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="{{ !empty($site['social_linkedin']) ? $site['social_linkedin'] : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn" title="LinkedIn">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="{{ !empty($site['social_twitter']) ? $site['social_twitter'] : '#' }}" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Twitter" title="Twitter">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        @php
            $footerLocations = (isset($globalLocations) && $globalLocations->count() > 0) ? $globalLocations : \App\Models\LocationPage::where('status', true)->orderBy('city')->get();
        @endphp
        @if(isset($footerLocations) && $footerLocations->count() > 0)
        <div class="container" style="border-top: 1px solid rgba(255,255,255,0.08); margin-top: 3rem; padding-top: 2rem;">
            <div style="display: flex; flex-wrap: wrap; align-items: baseline; gap: 8px 12px; font-size: 0.82rem; color: #71717a; line-height: 1.8;">
                <span style="color: var(--accent-gold, #C5A880); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; font-size: 0.78rem; margin-right: 4px;">Cities We Supply To:</span>
                @foreach($footerLocations as $loc)
                    @php
                        $locSlug = $loc->content['city_slug'] ?? \Illuminate\Support\Str::slug($loc->city);
                        $locName = $loc->content['city_name'] ?? ucwords(str_replace('-', ' ', $loc->city));
                    @endphp
                    <a href="/{{ $locSlug }}/imported-marble-seller" style="color: #a1a1aa; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#C5A880'" onmouseout="this.style.color='#a1a1aa'">{{ $locName }}</a>@if(!$loop->last) <span style="color: rgba(255,255,255,0.15);">&bull;</span>@endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="container footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $site['site_name'] ?? 'Stone Hub India' }}. {{ $pageContents['footer']['bottom']['copyright'] ?? 'All Rights Reserved.' }} | <a href="{{ route('application') }}" style="color: inherit; text-decoration: underline;">Applications</a> | <a href="{{ route('enquiry') }}" style="color: inherit; text-decoration: underline;">Enquiry</a> | <a href="{{ route('careers') }}" style="color: inherit; text-decoration: underline;">Careers</a> | <a href="{{ route('pricelist') }}" style="color: inherit; text-decoration: underline;">Italian Marble Price List</a> | <a href="/disclaimer" style="color: inherit; text-decoration: underline;">Disclaimer</a> | <a href="/privacy-policy" style="color: inherit; text-decoration: underline;">Privacy Policy</a></p>
        </div>
    </footer>

    <!-- Floating Conversion Action Buttons -->
    <div class="floating-widgets">
        <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text=Hi%20Stone%20Hub%20India,%20I'm%20interested%20in%20requesting%20a%20catalogue." target="_blank" class="widget-btn widget-whatsapp" aria-label="WhatsApp Us">
            <i data-lucide="message-circle"></i>
        </a>
        <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" class="widget-btn widget-call" aria-label="Call Us Now">
            <i data-lucide="phone"></i>
        </a>
        <button class="widget-btn widget-top" aria-label="Back to Top">
            <i data-lucide="arrow-up"></i>
        </button>
    </div>

    <!-- Mobile Sticky Action Bar -->
    <div class="mobile-action-bar">
        <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" class="mobile-action-btn call">
            <i data-lucide="phone"></i> Call Now
        </a>
        <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text=Hi%20Stone%20Hub%20India,%20I'm%20interested%20in%20requesting%20a%20catalogue." target="_blank" class="mobile-action-btn whatsapp">
            <i data-lucide="message-circle"></i> WhatsApp
        </a>
    </div>

    <!-- Callback Modals Overlay (Catalogue Request) -->
    <div class="dialog-overlay" id="callback-dialog">
        <div class="dialog-modal">
            <button class="dialog-close" aria-label="Close Modal" onclick="closeDialog('callback-dialog')">&times;</button>
            <div class="dialog-header">
                <h3>Request A Catalogue</h3>
                <p>Provide your contact details and our showroom coordinator will send over our premium stone catalog and price guides.</p>
            </div>
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="source" id="cb-hidden-source" value="Catalogue Request Modal">
                <input type="hidden" name="message" id="cb-hidden-message" value="">
                <div class="form-group">
                    <label for="cb-name">Your Full Name</label>
                    <input type="text" id="cb-name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="cb-phone">Phone Number</label>
                    <input type="tel" id="cb-phone" name="phone" class="form-control" placeholder="Enter 10-digit number" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label for="cb-dept">Preferred Stone Collection</label>
                    <select id="cb-dept" name="service" class="form-control" required>
                        <option value="">-- Select Collection --</option>
                        @forelse(($globalCollections ?? []) as $gcOpt)
                            <option value="{{ $gcOpt->slug }}">{{ $gcOpt->name }}</option>
                        @empty
                            <option value="bellezza">Bellezza</option>
                            <option value="migliore">Migliore</option>
                            <option value="forte">Forte</option>
                            <option value="amore">Amore</option>
                            <option value="spazio">Spazio</option>
                            <option value="lontano">Lontano</option>
                            <option value="giovane">Giovane</option>
                        @endforelse
                    </select>
                </div>
                @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
                    <div class="form-group" style="margin-bottom: 1rem; display: flex; justify-content: center;">
                        <div class="g-recaptcha" data-sitekey="{{ $site['recaptcha_site_key'] }}"></div>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Send Catalogue Guide</button>
            </form>
        </div>
    </div>

    <!-- Exit Intent Modal Overlay -->
    <div class="dialog-overlay" id="exit-intent-dialog">
        <div class="dialog-modal">
            <button class="dialog-close" aria-label="Close Modal" onclick="closeDialog('exit-intent-dialog')">&times;</button>
            <div class="dialog-header">
                <h3 style="color: var(--accent-gold);">Download Premium Stone Catalogue!</h3>
                <p>Get instant access to our exclusive catalog showing 300+ handselected marble slabs directly imported from Italy, Brazil, and Greece.</p>
            </div>
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="source" value="Exit Intent Modal">
                <div class="form-group">
                    <label for="exit-name">Your Full Name</label>
                    <input type="text" id="exit-name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="exit-phone">Phone Number</label>
                    <input type="tel" id="exit-phone" name="phone" class="form-control" placeholder="Enter 10-digit number" pattern="[0-9]{10}" required>
                </div>
                @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
                    <div class="form-group" style="margin-bottom: 1rem; display: flex; justify-content: center;">
                        <div class="g-recaptcha" data-sitekey="{{ $site['recaptcha_site_key'] }}"></div>
                    </div>
                @endif
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Get Catalogue Now</button>
            </form>
        </div>
    </div>

    <!-- Success Modal Overlay -->
    <div class="dialog-overlay" id="success-dialog" style="{{ session('success') ? 'display: flex;' : '' }}">
        <div class="dialog-modal text-center">
            <button class="dialog-close" aria-label="Close Modal" onclick="closeDialog('success-dialog')">&times;</button>
            <div class="success-icon-wrap" style="background: rgba(92, 203, 179, 0.1); color: var(--accent-teal);">
                <i data-lucide="check"></i>
            </div>
            <h3>Request Submitted Successfully!</h3>
            <p style="margin-top:1rem; color: var(--text-muted);">{{ session('success') ?? 'Thank you for requesting our catalogue. Our showroom coordinator will contact you shortly with the catalogue and price guides.' }}</p>
            <button onclick="closeDialog('success-dialog')" class="btn btn-primary" style="margin-top: 2rem; width: 150px;">OK</button>
        </div>
    </div>

    <!-- Error Modal Overlay -->
    <div class="dialog-overlay" id="error-dialog" style="{{ session('error') ? 'display: flex;' : '' }}">
        <div class="dialog-modal text-center">
            <button class="dialog-close" aria-label="Close Modal" onclick="closeDialog('error-dialog')">&times;</button>
            <div class="success-icon-wrap" style="background: rgba(232, 92, 36, 0.1); color: #e85c24;">
                <i data-lucide="alert-triangle"></i>
            </div>
            <h3 style="color: #e85c24;">Submission Failed</h3>
            <p style="margin-top:1rem; color: var(--text-muted);">{{ session('error') }}</p>
            <button onclick="closeDialog('error-dialog')" class="btn btn-primary" style="margin-top: 2rem; width: 150px; background-color: #e85c24; border-color: #e85c24;">OK</button>
        </div>
    </div>

    <!-- Lucide Icons: pinned version (avoid @latest redirects / breakage) -->
    <script src="https://unpkg.com/lucide@0.469.0/dist/umd/lucide.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide && typeof lucide.createIcons === 'function') {
                lucide.createIcons();
            }
        });
        
        // Modal Control Functions
        function openDialog(id) {
            const dialog = document.getElementById(id);
            if (dialog) {
                dialog.style.display = 'flex';
                setTimeout(() => {
                    dialog.classList.add('open');
                }, 10);
                document.body.style.overflow = 'hidden';
            }
        }
        function closeDialog(id) {
            const dialog = document.getElementById(id);
            if (dialog) {
                dialog.classList.remove('open');
                setTimeout(() => {
                    if (!dialog.classList.contains('open')) {
                        dialog.style.display = 'none';
                    }
                }, 300);
                document.body.style.overflow = '';
            }
        }
        
        // 1-Minute Auto-Popup Trigger for Appointment Booking
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const hasOpenedCallback = sessionStorage.getItem('callback_auto_triggered');
                const hasInteractedWithForm = sessionStorage.getItem('form_interacted');
                if (!hasOpenedCallback && !hasInteractedWithForm) {
                    sessionStorage.setItem('callback_auto_triggered', 'true');
                    openDialog('callback-dialog');
                }
            }, 60000); // 1 minute (60,000 milliseconds)
            
            document.querySelectorAll('input, select, textarea').forEach(el => {
                el.addEventListener('focus', () => {
                    sessionStorage.setItem('form_interacted', 'true');
                });
            });
        });
    </script>
    
    <!-- Floating Chat Widget -->
    <div id="clinic-chat-widget" style="position: fixed; bottom: 20px; left: 20px; z-index: 1000; font-family: 'Outfit', sans-serif;">
        <!-- Floating Toggle Button -->
        <button id="chat-toggle-btn" onclick="toggleChatWindow()" style="width: 60px; height: 60px; border-radius: 50%; background-color: var(--primary-teal); color: white; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.15); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; position: relative;">
            <div id="chat-icon-open" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                    <!-- Headband -->
                    <path d="M16 32C16 19.85 23.16 10 32 10C40.84 10 48 19.85 48 32" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <!-- Shoulders/Body -->
                    <path d="M16 54C16 47.37 21.37 42 28 42H36C42.63 42 48 47.37 48 54V56H16V54Z" fill="white"/>
                    <!-- Neck -->
                    <path d="M28 38V43H36V38H28Z" fill="#e2e8f0"/>
                    <!-- Face -->
                    <rect x="23" y="21" width="18" height="18" rx="9" fill="#f8fafc"/>
                    <!-- Hair/Fringe -->
                    <path d="M23 25C25 22 29 23 32 24C35 23 39 22 41 25C41 25 39 18 32 18C25 18 23 25 23 25Z" fill="#334155"/>
                    <!-- Earcups -->
                    <rect x="14" y="28" width="4" height="8" rx="2" fill="#334155"/>
                    <rect x="46" y="28" width="4" height="8" rx="2" fill="#334155"/>
                    <!-- Mic -->
                    <path d="M46 34C41 38 37 38 37 38" stroke="#334155" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="36" cy="38" r="1.5" fill="#334155"/>
                </svg>
            </div>
            <i data-lucide="x" id="chat-icon-close" style="width: 28px; height: 28px; display: none;"></i>
            <span id="chat-unread-badge" style="position: absolute; top: -5px; right: -5px; background-color: #ef4444; color: white; font-size: 0.75rem; font-weight: 700; width: 22px; height: 22px; border-radius: 50%; display: none; align-items: center; justify-content: center; border: 2px solid white;">0</span>
        </button>

        <!-- Chat Window -->
        <div id="chat-window" style="position: absolute; bottom: 75px; left: 0; width: 350px; height: 480px; background-color: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); display: none; flex-direction: column; overflow: hidden; border: 1px solid var(--border-color); transition: all 0.3s ease;">
            <!-- Chat Header -->
            <div style="background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-light) 100%); color: white; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                    <div style="position: relative; flex-shrink: 0;">
                        @if(!empty($site['chat_assistant_avatar']))
                            <img src="{{ site_image($site['chat_assistant_avatar']) }}" alt="Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
                        @else
                            <div style="width: 40px; height: 40px; border-radius: 50%; background-color: var(--accent-gold); color: black; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid white; font-size: 0.9rem;">
                                SH
                            </div>
                        @endif
                        <div style="position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; background-color: #22c55e; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 4px #22c55e;"></div>
                    </div>
                    <div style="min-width: 0;">
                        <strong style="display: block; font-size: 1rem; font-weight: 700;">{{ $site['chat_assistant_name'] ?? 'Stone Hub Curator' }}</strong>
                        <span style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Stone Hub Live Chat support</span>
                    </div>
                </div>
                <button type="button" onclick="toggleChatWindow()" aria-label="Close chat" title="Close" style="flex-shrink: 0; width: 32px; height: 32px; border: none; background: rgba(255,255,255,0.12); color: white; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.25)'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.12)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <!-- Chat Messages Body -->
            <div id="chat-messages-body" style="flex-grow: 1; padding: 1rem; overflow-y: auto; background-color: #f8fafc; display: flex; flex-direction: column; gap: 10px;">
                <!-- Messages will populate here via JS -->
            </div>
            <!-- Chat Footer Input -->
            <div style="padding: 0.75rem; border-top: 1px solid var(--border-color); display: flex; gap: 8px; background-color: white;">
                <input type="text" id="chat-input-message" placeholder="Type a message..." onkeydown="handleChatKey(event)" style="flex-grow: 1; border: 1px solid var(--border-color); padding: 0.6rem 0.8rem; border-radius: 20px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--primary-teal)'" onblur="this.style.borderColor='var(--border-color)'">
                <button onclick="sendChatMessage()" style="background-color: var(--primary-teal); color: white; border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#163638'" onmouseout="this.style.backgroundColor='var(--primary-teal)'">
                    <i data-lucide="send" style="width: 16px; height: 16px;"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Setup localStorage session ID
        let chatSessionId = localStorage.getItem('clinic_chat_session');
        if (!chatSessionId) {
            chatSessionId = 'sess_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
            localStorage.setItem('clinic_chat_session', chatSessionId);
        }

        let isChatOpen = false;
        let autoMessageTimer = null;
        let pollTimer = null;

        document.addEventListener('DOMContentLoaded', () => {
            // Welcome message after 60s — no continuous background chat polling while closed
            autoMessageTimer = setTimeout(() => {
                triggerAutoMessage();
            }, 60000);
        });

        function toggleChatWindow() {
            const chatWindow = document.getElementById('chat-window');
            const openIcon = document.getElementById('chat-icon-open');
            const closeIcon = document.getElementById('chat-icon-close');

            if (isChatOpen) {
                chatWindow.style.display = 'none';
                openIcon.style.display = 'flex';
                closeIcon.style.display = 'none';
                isChatOpen = false;
                clearInterval(pollTimer);
            } else {
                chatWindow.style.display = 'flex';
                openIcon.style.display = 'none';
                closeIcon.style.display = 'block';
                isChatOpen = true;
                loadChatHistory();
                // Start polling every 5s when open
                pollTimer = setInterval(loadChatHistory, 5000);
            }
        }

        function triggerAutoMessage() {
            fetch('/chat/auto-trigger', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ session_id: chatSessionId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    if (!isChatOpen) {
                        toggleChatWindow();
                    } else {
                        loadChatHistory();
                    }
                }
            })
            .catch(err => console.error('Error triggering auto message:', err));
        }

        function loadChatHistory() {
            fetch(`/chat/history?session_id=${chatSessionId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        renderMessages(data.messages);
                    }
                });
        }

        function checkNewMessagesSilently() {
            if (isChatOpen) return;
            fetch(`/chat/history?session_id=${chatSessionId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const unreadCount = data.messages.filter(m => m.sender === 'admin' && !m.is_read).length;
                        const badge = document.getElementById('chat-unread-badge');
                        if (unreadCount > 0) {
                            badge.textContent = unreadCount;
                            badge.style.display = 'flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                });
        }

        function renderMessages(messages) {
            const body = document.getElementById('chat-messages-body');
            body.innerHTML = '';
            
            if (messages.length === 0) {
                body.innerHTML = `<div style="text-align: center; color: #94a3b8; font-size: 0.85rem; margin-top: 2rem;">How can we help you today? Type below to start talking to our team.</div>`;
                return;
            }

            messages.forEach(msg => {
                const isMsgAdmin = msg.sender === 'admin';
                const msgDiv = document.createElement('div');
                msgDiv.style.display = 'flex';
                msgDiv.style.justifyContent = isMsgAdmin ? 'flex-start' : 'flex-end';
                
                const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                msgDiv.innerHTML = `
                    <div style="max-width: 80%; background-color: ${isMsgAdmin ? '#e2e8f0' : 'var(--primary-teal)'}; color: ${isMsgAdmin ? '#1e293b' : 'white'}; padding: 0.6rem 0.9rem; border-radius: 14px; position: relative; box-shadow: 0 1px 2px rgba(0,0,0,0.05); font-size: 0.9rem; line-height: 1.4; margin-bottom: 4px;">
                        <div style="word-break: break-word;">${escapeHTML(msg.message)}</div>
                        <div style="font-size: 0.65rem; text-align: right; margin-top: 3px; color: ${isMsgAdmin ? '#64748b' : 'rgba(255,255,255,0.7)'};">${time}</div>
                    </div>
                `;
                body.appendChild(msgDiv);
            });

            document.getElementById('chat-unread-badge').style.display = 'none';
            body.scrollTop = body.scrollHeight;
        }

        function escapeHTML(str) {
            return str.replace(/[&<>'"]/g, 
                tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
            );
        }

        function handleChatKey(e) {
            if (e.key === 'Enter') {
                sendChatMessage();
            }
        }

        function sendChatMessage() {
            const input = document.getElementById('chat-input-message');
            const msg = input.value.trim();
            if (!msg) return;

            input.value = '';
            clearTimeout(autoMessageTimer);

            fetch('/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    session_id: chatSessionId,
                    message: msg
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    loadChatHistory();
                }
            });
        }
    </script>
    
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('scripts')

    @if(!empty($site['cloudflare_analytics_token']))
        <!-- Cloudflare Web Analytics -->
        <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"token": "{{ $site['cloudflare_analytics_token'] }}"}'></script>
        <!-- End Cloudflare Web Analytics -->
    @endif

    <!-- Combined Cookie & Notification Consent Module -->
    <div id="consent-banner" style="position: fixed; bottom: 20px; left: 20px; right: 20px; max-width: 480px; z-index: 999999; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(12px); border: 1px solid rgba(92, 203, 179, 0.25); border-radius: 12px; padding: 1.25rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5); display: none; color: white; animation: slideUpBanner 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
        <style>
            @keyframes slideUpBanner {
                from { transform: translateY(100px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            .consent-btn {
                padding: 8px 14px;
                border-radius: 6px;
                font-size: 0.8rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
                border: none;
            }
            .consent-allow {
                background-color: var(--primary-teal, #5ccbb3);
                color: #0b1e36;
            }
            .consent-allow:hover {
                filter: brightness(1.1);
            }
            .consent-deny {
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.1);
                color: white;
            }
            .consent-deny:hover {
                background: rgba(255,255,255,0.1);
            }
            .toast-alert {
                position: relative;
                max-width: 350px;
                background: rgba(15, 23, 42, 0.98);
                border-left: 4px solid var(--primary-teal, #5ccbb3);
                border-radius: 8px;
                padding: 12px;
                box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3);
                color: white;
                display: flex;
                gap: 10px;
                cursor: pointer;
                animation: slideInToast 0.3s ease;
            }
            @keyframes slideInToast {
                from { transform: translateX(100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>
        <div style="display: flex; gap: 12px; align-items: start;">
            <div style="width: 38px; height: 38px; border-radius: 50%; background-color: rgba(92, 203, 179, 0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #5ccbb3;">
                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
            </div>
            <div>
                <strong style="font-size: 0.9rem; font-family: 'Outfit', sans-serif; display: block; margin-bottom: 2px;">Cookie & Notification Request</strong>
                <p style="margin: 0; font-size: 0.75rem; color: #94a3b8; line-height: 1.4;">
                    We use cookies to optimize your browsing experience. Would you also like to receive push notifications for premium slab updates and catalog releases?
                </p>
                <div style="margin-top: 10px; display: flex; gap: 8px;">
                    <button class="consent-btn consent-allow" onclick="acceptAllConsent()">Accept All</button>
                    <button class="consent-btn consent-deny" onclick="acceptCookiesOnly()">Cookies Only</button>
                    <button class="consent-btn consent-deny" onclick="closeConsentBanner()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Client-side notification toasts container -->
    <div id="client-toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999999; display: flex; flex-direction: column; gap: 10px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Auto-open Live Chat if open_chat=1 query parameter is set
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('open_chat') === '1') {
                setTimeout(() => {
                    if (typeof toggleChatWindow === 'function' && !isChatOpen) {
                        toggleChatWindow();
                    }
                }, 800);
            }

            // 2. Manage Consent Banner Visibility
            const cookiesAccepted = localStorage.getItem('cookies_accepted');
            const consentViewed = localStorage.getItem('consent_viewed');
            
            if (!consentViewed && !cookiesAccepted) {
                setTimeout(() => {
                    const banner = document.getElementById('consent-banner');
                    if (banner) banner.style.display = 'block';
                }, 2000);
            }

            // 3. Only poll notifications if the visitor opted in
            if (localStorage.getItem('notifications_subscribed') === 'true') {
                startNotificationPolling();
            }
        });

        function closeConsentBanner() {
            const banner = document.getElementById('consent-banner');
            if (banner) banner.style.display = 'none';
            localStorage.setItem('consent_viewed', 'true');
        }

        function acceptCookiesOnly() {
            localStorage.setItem('cookies_accepted', 'true');
            closeConsentBanner();
        }

        function acceptAllConsent() {
            localStorage.setItem('cookies_accepted', 'true');
            localStorage.setItem('notifications_subscribed', 'true');
            
            // Request native notification permission
            if ('Notification' in window) {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        // Subscribe session in DB
                        fetch('/api/push-subscribe', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ session_id: chatSessionId })
                        })
                        .then(() => {
                            startNotificationPolling();
                        });
                    }
                });
            }
            closeConsentBanner();
        }

        let notificationPollTimer = null;
        let lastReceivedNotificationId = parseInt(localStorage.getItem('last_received_notification_id') || '0');

        function startNotificationPolling() {
            if (notificationPollTimer) return;
            
            // Poll immediately
            pollNotifications();
            // Poll every 30s (was 8s — too aggressive for every page view)
            notificationPollTimer = setInterval(pollNotifications, 30000);
        }

        function pollNotifications() {
            fetch(`/api/notifications/poll?session_id=${chatSessionId}&last_id=${lastReceivedNotificationId}`)
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        if (data.last_id && data.last_id > lastReceivedNotificationId) {
                            lastReceivedNotificationId = data.last_id;
                            localStorage.setItem('last_received_notification_id', lastReceivedNotificationId.toString());
                        }
                        if (data.notifications && data.notifications.length > 0) {
                            data.notifications.forEach(notif => {
                                // Update last received id
                                if (notif.id > lastReceivedNotificationId) {
                                    lastReceivedNotificationId = notif.id;
                                    localStorage.setItem('last_received_notification_id', lastReceivedNotificationId.toString());
                                }
                                
                                // Deliver Alert
                                deliverWebNotification(notif);
                            });
                        }
                    }
                })
                .catch(err => console.error('Error polling alerts:', err));
        }

        function deliverWebNotification(notif) {
            // Check if native Notification is permitted
            if ('Notification' in window && Notification.permission === 'granted') {
                const n = new Notification(notif.title, {
                    body: notif.message,
                    icon: '/favicon.ico',
                    tag: 'notif_' + notif.id
                });
                
                n.onclick = function() {
                    window.focus();
                    if (notif.url) {
                        window.location.href = notif.url;
                    }
                };
            } else {
                // Fallback to in-app webpage toast alert
                showInAppToast(notif);
            }
        }

        function showInAppToast(notif) {
            const container = document.getElementById('client-toast-container');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = 'toast-alert';
            toast.onclick = () => {
                if (notif.url) {
                    window.location.href = notif.url;
                }
            };
            
            toast.innerHTML = `
                <div style="width: 32px; height: 32px; border-radius: 6px; background-color: var(--primary-teal, #5ccbb3); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #0d1718;">
                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2.5" fill="none"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </div>
                <div style="flex-grow: 1;">
                    <strong style="font-size: 0.85rem; font-weight: 700; color: white; display: block; margin-bottom: 2px;">${escapeHTML(notif.title)}</strong>
                    <p style="margin: 0; font-size: 0.75rem; color: #cbd5e1; line-height: 1.3;">${escapeHTML(notif.message)}</p>
                    ${notif.url ? `<span style="font-size: 0.65rem; color: var(--primary-teal, #5ccbb3); margin-top: 3px; display: block; text-decoration: underline;">Click to open update link</span>` : ''}
                </div>
            `;
            
            container.appendChild(toast);
            
            // Remove after 6s
            setTimeout(() => {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }, 6000);
        }
    </script>
</body>
</html>

