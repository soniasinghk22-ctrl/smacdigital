@extends('layouts.app')

@php
    $content = is_array($locationPage->content) ? $locationPage->content : json_decode($locationPage->content ?? '[]', true);
    $cityName = $content['city_name'] ?? ucwords(str_replace('-', ' ', $locationPage->city));
    $cityImage = !empty($content['image']) && file_exists(public_path($content['image'])) 
        ? asset($content['image']) 
        : (file_exists(public_path('uploads/product/' . ($content['image'] ?? ''))) 
            ? asset('uploads/product/' . $content['image']) 
            : asset('assets/images/infra/infra-15.jpg'));
    
    $heroSubtitle = $content['hero_subtitle'] ?? "Direct Importers & Curation Experts of World-Class Italian, Greek, Brazilian & Turkish Marble Slabs in {$cityName}.";
    $metaKeywords = $content['meta_keywords'] ?? ($locationPage->meta_keywords ?? "imported marble {$cityName}, italian marble supplier {$cityName}, marble price in {$cityName}");
@endphp

@section('title', $locationPage->title)
@section('meta_description', $locationPage->meta_description ?? "Discover premium imported and Italian marble in {$cityName} with Stone Hub India. Sourced directly from premier global quarries with insured delivery.")
@section('meta_keywords', $metaKeywords)

@section('schema')
@php
    $sitePhone = $site['phone'] ?? '+91 96727 77749';
    $siteEmail = $site['email'] ?? 'info@stonehubindia.com';
    $siteLogo = !empty($site['logo_path']) ? site_image($site['logo_path']) : asset('assets/images/logo.png');
    $siteAddress = $site['address'] ?? 'Plot No. 12, Industrial Area, Makrana Road, Kishangarh, Rajasthan - 305801';
    $currentUrl = request()->url();
    $pageTitle = $locationPage->title;
    $pageDesc = $locationPage->meta_description ?? "Discover premium imported and Italian marble in {$cityName} with Stone Hub India.";

    $graph = [];

    // 1. LocalBusiness / WholesaleStore Schema
    $graph[] = [
        '@type' => 'HomeAndConstructionBusiness',
        '@id' => $currentUrl . '#business',
        'name' => ($site['site_name'] ?? 'Stone Hub India') . ' - ' . $cityName,
        'legalName' => $site['site_name'] ?? 'Stone Hub India',
        'url' => $currentUrl,
        'logo' => $siteLogo,
        'image' => $cityImage,
        'description' => $pageDesc,
        'telephone' => $sitePhone,
        'email' => $siteEmail,
        'priceRange' => '₹₹₹₹',
        'currenciesAccepted' => 'INR',
        'paymentAccepted' => 'Cash, Credit Card, Bank Transfer, Cheque, RTGS, UPI',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $siteAddress,
            'addressLocality' => $cityName,
            'addressRegion' => 'Rajasthan',
            'postalCode' => '305801',
            'addressCountry' => 'IN',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 26.5744,
            'longitude' => 74.8647,
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => $cityName,
            'addressCountry' => 'IN',
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '09:00',
                'closes' => '20:00',
            ],
        ],
    ];

    // 2. WebPage Schema
    $graph[] = [
        '@type' => 'WebPage',
        '@id' => $currentUrl . '#webpage',
        'url' => $currentUrl,
        'name' => $pageTitle,
        'description' => $pageDesc,
        'inLanguage' => 'en-IN',
        'isPartOf' => [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => $site['site_name'] ?? 'Stone Hub India',
        ],
        'primaryImageOfPage' => [
            '@type' => 'ImageObject',
            'url' => $cityImage,
        ],
    ];

    // 3. BreadcrumbList Schema
    $graph[] = [
        '@type' => 'BreadcrumbList',
        '@id' => $currentUrl . '#breadcrumb',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => url('/'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Collections',
                'item' => url('/collections'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $cityName,
                'item' => $currentUrl,
            ],
        ],
    ];

    // 4. Product / AggregateOffer Schema (For Google rich product snippets)
    $graph[] = [
        '@type' => 'Product',
        '@id' => $currentUrl . '#product',
        'name' => 'Imported Italian Marble Slabs in ' . $cityName,
        'image' => $cityImage,
        'description' => "Premium imported Italian marble, Onyx, Travertine, and Quartzite slabs with doorstep delivery in {$cityName}.",
        'brand' => [
            '@type' => 'Brand',
            'name' => $site['site_name'] ?? 'Stone Hub India',
        ],
        'offers' => [
            '@type' => 'AggregateOffer',
            'priceCurrency' => 'INR',
            'lowPrice' => '350',
            'highPrice' => '4500',
            'offerCount' => '100+',
            'availability' => 'https://schema.org/InStock',
            'priceSpecification' => [
                '@type' => 'UnitPriceSpecification',
                'priceCurrency' => 'INR',
                'unitCode' => 'FTK',
                'unitText' => 'per sq ft',
            ],
            'seller' => [
                '@type' => 'Organization',
                'name' => $site['site_name'] ?? 'Stone Hub India',
            ],
        ],
    ];

    // 5. FAQPage Schema (For Google Search FAQ Dropdowns / Rich Extension Results)
    if (!empty($content['faqs']) && is_array($content['faqs'])) {
        $faqEntities = [];
        foreach ($content['faqs'] as $faq) {
            $q = trim(strip_tags($faq['q'] ?? ''));
            $a = trim(strip_tags($faq['a'] ?? ''));
            if (!empty($q) && !empty($a)) {
                $faqEntities[] = [
                    '@type' => 'Question',
                    'name' => $q,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $a,
                    ],
                ];
            }
        }
        if (!empty($faqEntities)) {
            $graph[] = [
                '@type' => 'FAQPage',
                '@id' => $currentUrl . '#faq',
                'mainEntity' => $faqEntities,
            ];
        }
    }

    $finalSchema = [
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($finalSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

    <!-- 1. LUXURY HERO SECTION -->
    <section class="city-hero" style="position: relative; background: linear-gradient(180deg, rgba(11, 11, 12, 0.78) 0%, rgba(11, 11, 12, 0.94) 100%), url('{{ $cityImage }}') center/cover no-repeat; padding: 7rem 1rem 5.5rem 1rem; color: #fff; overflow: hidden;">
        <div style="position: absolute; inset: 0; background: radial-gradient(circle at top right, rgba(197, 168, 128, 0.12) 0%, transparent 60%); pointer-events: none;"></div>
        
        <div class="container text-center" style="position: relative; z-index: 2; max-width: 960px; margin: 0 auto;">
            <!-- Breadcrumbs -->
            <nav style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.82rem; color: rgba(255,255,255,0.6); margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 1px;">
                <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.2s ease;">Home</a>
                <span>/</span>
                <span style="color: var(--accent-gold); font-weight: 600;">{{ $cityName }}</span>
            </nav>

            <div style="display: inline-block; background: rgba(197, 168, 128, 0.12); border: 1px solid rgba(197, 168, 128, 0.35); padding: 6px 18px; border-radius: 50px; margin-bottom: 1.25rem; backdrop-filter: blur(8px);">
                <span style="color: var(--accent-gold); font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">
                    📍 PREMIER NATURAL STONE SOURCING FOR {{ strtoupper($cityName) }}
                </span>
            </div>

            <h1 style="color: #ffffff !important; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 700; line-height: 1.18; margin: 0 auto 1.25rem auto; letter-spacing: -0.5px;">
                {{ $locationPage->title }}
            </h1>

            <p style="color: rgba(255, 255, 255, 0.9) !important; font-size: 1.15rem; line-height: 1.7; max-width: 780px; margin: 0 auto 2.25rem auto; font-weight: 400;">
                {{ $heroSubtitle }}
            </p>

            <!-- Dual Action CTAs -->
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; align-items: center;">
                <button onclick="openDialog('callback-dialog');" class="btn btn-primary" style="padding: 14px 32px; font-size: 1.02rem; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 10px 25px rgba(197, 168, 128, 0.25);">
                    <i data-lucide="phone-call" style="width: 18px; height: 18px;"></i>
                    Request Instant Quote for {{ $cityName }}
                </button>
                <a href="#live-slabs-section" class="btn btn-secondary" style="padding: 14px 28px; font-size: 1.02rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.25); color: #fff; backdrop-filter: blur(8px); display: inline-flex; align-items: center; gap: 8px;">
                    <i data-lucide="layers" style="width: 18px; height: 18px;"></i>
                    Explore Live Slabs
                </a>
                <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text={{ urlencode('Hello Stone Hub India, I am inquiring about premium imported marble delivery for my project in ' . $cityName) }}" target="_blank" class="btn" style="padding: 14px 24px; font-size: 1.02rem; background: #25D366; color: #fff; border: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; border-radius: var(--radius-md);">
                    <i data-lucide="message-circle" style="width: 18px; height: 18px;"></i>
                    WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- 2. VALUE PROPS RIBBON -->
    <section style="background: #111113; border-top: 1px solid rgba(255,255,255,0.06); border-bottom: 1px solid rgba(255,255,255,0.06); padding: 1.75rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 20px;">
                <div style="display: flex; align-items: center; gap: 14px; padding: 8px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(197,168,128,0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i data-lucide="globe" style="width: 22px; height: 22px;"></i>
                    </div>
                    <div>
                        <h4 style="color: #ffffff !important; font-size: 0.95rem; margin: 0 0 2px 0; font-weight: 600;">Direct Global Imports</h4>
                        <p style="color: rgba(255,255,255,0.7) !important; font-size: 0.8rem; margin: 0;">Italy, Spain, Greece & Brazil</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 14px; padding: 8px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(197,168,128,0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i data-lucide="truck" style="width: 22px; height: 22px;"></i>
                    </div>
                    <div>
                        <h4 style="color: #ffffff !important; font-size: 0.95rem; margin: 0 0 2px 0; font-weight: 600;">Insured Freight</h4>
                        <p style="color: rgba(255,255,255,0.7) !important; font-size: 0.8rem; margin: 0;">100% Insured Delivery to {{ $cityName }}</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 14px; padding: 8px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(197,168,128,0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i data-lucide="sparkles" style="width: 22px; height: 22px;"></i>
                    </div>
                    <div>
                        <h4 style="color: #ffffff !important; font-size: 0.95rem; margin: 0 0 2px 0; font-weight: 600;">Italian Breton Polish</h4>
                        <p style="color: rgba(255,255,255,0.7) !important; font-size: 0.8rem; margin: 0;">36-Head High-Gloss Finish</p>
                    </div>
                </div>

                <div style="display: flex; align-items: center; gap: 14px; padding: 8px;">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(197,168,128,0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i data-lucide="video" style="width: 22px; height: 22px;"></i>
                    </div>
                    <div>
                        <h4 style="color: #ffffff !important; font-size: 0.95rem; margin: 0 0 2px 0; font-weight: 600;">Virtual Slab Tour</h4>
                        <p style="color: rgba(255,255,255,0.7) !important; font-size: 0.8rem; margin: 0;">Live 4K Slab Inspection Before Transit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. CITY OVERVIEW & ARCHITECTURAL HERITAGE SECTION -->
    <section class="section" style="padding: 5.5rem 0 4.5rem 0; background: #faf9f6;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 45px; align-items: flex-start;">
                
                <!-- Left: Rich Description Content -->
                <div class="animate-on-scroll">
                    <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 8px;">
                        ARCHITECTURAL SPLENDOR & SOURCING
                    </span>
                    <h2 style="color: #121214; font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 700; margin-top: 0; margin-bottom: 1.5rem; line-height: 1.25;">
                        {{ $content['intro_title'] ?? ("Premium Imported & Italian Marble in " . $cityName) }}
                    </h2>

                    <div class="city-rich-text" style="color: #44444a; line-height: 1.85; font-size: 1.05rem;">
                        @if(!empty($content['description']))
                            {!! $content['description'] !!}
                        @elseif(!empty($content['intro_text']))
                            {!! $content['intro_text'] !!}
                        @else
                            <p>Stone Hub India is one of the largest suppliers and direct importers of top-quality Italian marble, Greek white stone, Brazilian quartzite, and Turkish travertine in {{ $cityName }}. Sourced directly from globally renowned quarries, our collection features meticulously processed slabs with resin reinforcement and computerized calibration.</p>
                            <p>Whether you are designing a grand luxury villa, bespoke penthouse, hotel lobby, or modern commercial development in {{ $cityName }}, our team ensures seamless handpicking, insured door-to-door transit, and consecutive bookmatched sets.</p>
                        @endif
                    </div>

                    <div style="margin-top: 2rem; padding: 1.5rem; background: #ffffff; border-left: 4px solid var(--accent-gold); border-radius: 0 var(--radius-md) var(--radius-md) 0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                        <p style="margin: 0; font-size: 0.98rem; color: #2d2d32; font-style: italic; line-height: 1.6;">
                            "Every slab supplied to {{ $cityName }} is individually cataloged, vein-matched, and delivered in heavy export-grade timber A-frames for zero damage transit."
                        </p>
                    </div>
                </div>

                <!-- Right: High-Spec Curation Card -->
                <div class="animate-on-scroll" style="position: sticky; top: 100px;">
                    <div style="background: #151518; border-radius: var(--radius-lg); padding: 2.25rem; color: #fff; box-shadow: 0 20px 40px rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.08);">
                        <div style="position: relative; border-radius: var(--radius-md); overflow: hidden; height: 220px; margin-bottom: 1.75rem; border: 1px solid rgba(255,255,255,0.1);">
                            <img src="{{ $cityImage }}" alt="Stone Hub India supply in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; bottom: 12px; left: 12px; background: rgba(0,0,0,0.75); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; color: var(--accent-gold); font-weight: 600; backdrop-filter: blur(4px);">
                                📍 {{ $cityName }} Sourcing Hub
                            </div>
                        </div>

                        <h3 style="color: #ffffff; font-size: 1.3rem; margin: 0 0 1.25rem 0; font-weight: 700;">
                            Quick Specs for {{ $cityName }} Projects
                        </h3>

                        <ul style="list-style: none; padding: 0; margin: 0 0 1.75rem 0; display: flex; flex-direction: column; gap: 12px; font-size: 0.92rem;">
                            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 8px;">
                                <span style="color: rgba(255,255,255,0.6);">Transit Timeline:</span>
                                <span style="color: #fff; font-weight: 600;">4 – 7 Business Days</span>
                            </li>
                            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 8px;">
                                <span style="color: rgba(255,255,255,0.6);">Available Slabs:</span>
                                <span style="color: var(--accent-gold); font-weight: 600;">300+ Varieties in Stock</span>
                            </li>
                            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 8px;">
                                <span style="color: rgba(255,255,255,0.6);">Thickness Options:</span>
                                <span style="color: #fff; font-weight: 600;">18mm & 20mm Calibrated</span>
                            </li>
                            <li style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 8px;">
                                <span style="color: rgba(255,255,255,0.6);">Available Finishes:</span>
                                <span style="color: #fff; font-weight: 600;">Mirror, Honed, Leathered</span>
                            </li>
                            <li style="display: flex; justify-content: space-between; padding-bottom: 4px;">
                                <span style="color: rgba(255,255,255,0.6);">Packaging:</span>
                                <span style="color: #fff; font-weight: 600;">Heavy Export Timber A-Frames</span>
                            </li>
                        </ul>

                        <button onclick="openDialog('callback-dialog');" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 12px; font-weight: 600;">
                            Get Custom Quote for {{ $cityName }}
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. FEATURED LIVE MARBLE SLABS GALLERY -->
    <section id="live-slabs-section" class="section" style="padding: 5.5rem 0; background: #ffffff; border-top: 1px solid rgba(15,15,17,0.06);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                    CURATED SLAB SELECTIONS
                </span>
                <h2 style="color: #121214; font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 700; margin-top: 6px; margin-bottom: 10px;">
                    Top Imported Marble Slabs for {{ $cityName }}
                </h2>
                <p style="color: #666; max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Hand-selected blocks available for immediate delivery to {{ $cityName }} residences and commercial properties.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                @foreach($featuredMarbles as $marble)
                    <div class="product-card animate-on-scroll" style="background: #ffffff; border: 1px solid rgba(15,15,17,0.08); border-radius: var(--radius-lg); overflow: hidden; transition: all 0.35s ease; box-shadow: 0 4px 20px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
                        <div style="position: relative; height: 260px; overflow: hidden; background: #eceae5;">
                            <img src="{{ site_image($marble->image) }}" alt="{{ $marble->name }} in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" loading="lazy">
                            <span style="position: absolute; top: 12px; left: 12px; background: rgba(15,15,17,0.8); color: var(--accent-gold); padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; backdrop-filter: blur(4px);">
                                {{ $marble->origin ?? 'Imported' }}
                            </span>
                        </div>

                        <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                            <h3 style="color: #121214; font-size: 1.25rem; font-weight: 700; margin: 0 0 8px 0;">
                                <a href="{{ route('products.show', $marble->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $marble->name }}
                                </a>
                            </h3>
                            <p style="color: #71717a; font-size: 0.88rem; line-height: 1.5; margin: 0 0 1.25rem 0; flex-grow: 1;">
                                {{ Str::limit(strip_tags($marble->description), 90) }}
                            </p>

                            <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid rgba(15,15,17,0.06); padding-top: 12px;">
                                <a href="{{ route('products.show', $marble->slug) }}" style="color: var(--accent-gold); font-weight: 600; font-size: 0.92rem; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    View Slab Details <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                                </a>
                                <button onclick="openDialog('callback-dialog');" style="background: none; border: none; color: #121214; font-size: 0.85rem; font-weight: 600; cursor: pointer; text-decoration: underline;">
                                    Enquire
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 3.5rem;">
                <a href="{{ route('products.index') }}" class="btn btn-secondary" style="padding: 12px 32px; font-weight: 600;">
                    View All 100+ Marble Slabs Catalog
                </a>
            </div>
        </div>
    </section>

    <!-- 5. THE 4-PILLAR STONE HUB CURATION STANDARD -->
    <section class="section" style="padding: 5.5rem 0; background: #111113; color: #fff;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                    QUALITY BENCHMARKS
                </span>
                <h2 style="color: #ffffff !important; font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 700; margin-top: 6px;">
                    {{ $content['features_title'] ?? ("The Stone Hub Curation Standard for " . $cityName) }}
                </h2>
                <p style="color: rgba(255,255,255,0.7) !important; max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    State-of-the-art Italian processing standards delivering zero micro-fissures, uniform calibration, and enduring polish.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 25px;">
                @php
                    $features = $content['features'] ?? [
                        ['title' => 'Quarry-Direct Sourcing', 'desc' => "Direct handpicking in Carrara, Drama, and Espirito Santo ensures authenticity for projects in {$cityName}."],
                        ['title' => '36-Head Automated Polishing', 'desc' => 'Processed with Italian Breton lines, high-density resin mesh, and mirror gloss calibration.'],
                        ['title' => 'Insured Doorstep Freight', 'desc' => "Crated securely in heavy timber A-frames with full transit insurance right to your site in {$cityName}."],
                        ['title' => 'Virtual Slab Inspection', 'desc' => 'High-definition 4K video consultations and 3D visualizer previews prior to dispatch.']
                    ];
                @endphp

                @foreach($features as $idx => $f)
                    <div class="animate-on-scroll" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: var(--radius-lg); padding: 2rem; transition: transform 0.3s ease, border-color 0.3s ease;">
                        <div style="width: 48px; height: 48px; border-radius: 14px; background: rgba(197,168,128,0.12); color: var(--accent-gold); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-weight: 700; font-size: 1.1rem;">
                            0{{ $idx + 1 }}
                        </div>
                        <h3 style="color: #ffffff !important; font-size: 1.25rem; font-weight: 700; margin: 0 0 10px 0;">
                            {{ $f['title'] ?? '' }}
                        </h3>
                        <p style="color: rgba(255,255,255,0.7) !important; font-size: 0.95rem; line-height: 1.65; margin: 0;">
                            {{ $f['desc'] ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 6. APPLICATIONS IN LUXURY RESIDENCES -->
    <section class="section" style="padding: 5.5rem 0; background: #faf9f6;">
        <div class="container">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                    TIMELESS DESIGN INSPIRATION
                </span>
                <h2 style="color: #121214; font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 700; margin-top: 6px;">
                    Architectural Applications in {{ $cityName }}
                </h2>
                <p style="color: #666; max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                    Elevate every architectural facet with bespoke natural stone installations.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 25px;">
                <div class="animate-on-scroll" style="background: #ffffff; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(15,15,17,0.06); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <div style="height: 200px; background: #eee;">
                        <img src="{{ asset('uploads/collection/imported_marble_grand_foyer.jpg') }}" alt="Living room marble flooring in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #121214; font-size: 1.2rem; font-weight: 700; margin: 0 0 8px 0;">Grand Living Room Flooring</h3>
                        <p style="color: #666; font-size: 0.9rem; line-height: 1.6; margin: 0;">Seamless high-gloss Botticino, Statuario, and Dyna slabs for luminous, grand residential floors.</p>
                    </div>
                </div>

                <div class="animate-on-scroll" style="background: #ffffff; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(15,15,17,0.06); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <div style="height: 200px; background: #eee;">
                        <img src="{{ asset('uploads/collection/white_marble_statuario_feature.jpg') }}" alt="Bookmatched accent wall marble in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #121214; font-size: 1.2rem; font-weight: 700; margin: 0 0 8px 0;">Bookmatched Feature Walls</h3>
                        <p style="color: #666; font-size: 0.9rem; line-height: 1.6; margin: 0;">Symmetrical butterfly pattern veining creating dramatic focal art in living spaces and lobbies.</p>
                    </div>
                </div>

                <div class="animate-on-scroll" style="background: #ffffff; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(15,15,17,0.06); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <div style="height: 200px; background: #eee;">
                        <img src="{{ asset('uploads/collection/black_gold_bath_suite.jpg') }}" alt="Master bath suite marble in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #121214; font-size: 1.2rem; font-weight: 700; margin: 0 0 8px 0;">Master Bath & Spa Suites</h3>
                        <p style="color: #666; font-size: 0.9rem; line-height: 1.6; margin: 0;">Resistant, non-porous sealed onyx and marble for vanities, shower walls, and custom bathtubs.</p>
                    </div>
                </div>

                <div class="animate-on-scroll" style="background: #ffffff; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(15,15,17,0.06); box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <div style="height: 200px; background: #eee;">
                        <img src="{{ asset('uploads/collection/exotic_quartzite_patagonia_island.jpg') }}" alt="Kitchen countertops in {{ $cityName }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    </div>
                    <div style="padding: 1.5rem;">
                        <h3 style="color: #121214; font-size: 1.2rem; font-weight: 700; margin: 0 0 8px 0;">Kitchen Islands & Quartzite</h3>
                        <p style="color: #666; font-size: 0.9rem; line-height: 1.6; margin: 0;">Scratch-proof, heat-resistant Brazilian quartzite slabs for stunning designer waterfall islands.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FREQUENTLY ASKED QUESTIONS SECTION -->
    <section class="section" style="padding: 5.5rem 0; background: #ffffff; border-top: 1px solid rgba(15,15,17,0.06);">
        <div class="container" style="max-width: 860px; margin: 0 auto;">
            <div class="text-center" style="margin-bottom: 3.5rem;">
                <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                    HELPFUL CLARIFICATIONS
                </span>
                <h2 style="color: #121214; font-size: clamp(1.8rem, 2.8vw, 2.4rem); font-weight: 700; margin-top: 6px;">
                    {{ $content['faq_title'] ?? ("Frequently Asked Questions about Marble in " . $cityName) }}
                </h2>
            </div>

            <div style="display: flex; flex-direction: column; gap: 16px;">
                @php
                    $faqs = $content['faqs'] ?? [
                        [
                            'q' => "How do I select and order imported marble for my site in {$cityName}?",
                            'a' => "You can browse our curated catalog online or connect directly with our natural stone consultants. We provide live high-definition video walkthroughs of standing slab bundles, mail physical samples, and coordinate insured logistics straight to your site in {$cityName}."
                        ],
                        [
                            'q' => "What is the typical shipping duration to {$cityName}?",
                            'a' => "All orders are loaded via automated gantry cranes into heavy timber A-frames at our Kishangarh stockyard and dispatched with end-to-end transit insurance, typically arriving in {$cityName} within 4 to 7 business days."
                        ],
                        [
                            'q' => "Which types of imported marble are most popular for residences in {$cityName}?",
                            'a' => "Our most requested stones in {$cityName} include Statuario White, Bottochino Classic, Armani Grey, Black Marquina, Dyna Royal, Translucent Onyx, and Brazilian Exotic Quartzite."
                        ],
                        [
                            'q' => "Can I inspect the live slabs before making a purchase?",
                            'a' => "Absolutely. We provide comprehensive 4K video inspections, high-resolution photographs of individual numbered slabs, and 3D visualizer previews matching your architectural floor plan."
                        ]
                    ];
                @endphp

                @foreach($faqs as $index => $faq)
                    <div style="background: #ffffff; border: 1px solid rgba(15,15,17,0.1); border-radius: var(--radius-md); overflow: hidden; transition: all 0.2s ease;">
                        <div style="padding: 1.25rem 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; user-select: none;" onclick="toggleFaq({{ $index }})">
                            <h3 style="color: #121214; font-size: 1.08rem; font-weight: 600; margin: 0; padding-right: 15px;">
                                {{ $faq['q'] ?? '' }}
                            </h3>
                            <div style="width: 28px; height: 28px; border-radius: 50%; background: rgba(197, 168, 128, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i id="faq-chevron-{{ $index }}" data-lucide="chevron-down" style="color: var(--accent-gold); width: 18px; height: 18px; transition: transform 0.3s ease;"></i>
                            </div>
                        </div>
                        <div id="faq-answer-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }}; padding: 0 1.5rem 1.5rem 1.5rem; color: #55555c; font-size: 0.98rem; line-height: 1.7; border-top: 1px solid rgba(15,15,17,0.05);">
                            <div style="padding-top: 12px;">
                                {!! nl2br(e($faq['a'] ?? '')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 8. PAN-INDIA CITY NETWORK & NEARBY LOCATIONS -->
    @if(isset($allCities) && $allCities->count() > 0)
    <section class="section" style="padding: 4.5rem 0; background: #f4f3ef; border-top: 1px solid rgba(15,15,17,0.06);">
        <div class="container">
            <div class="text-center" style="margin-bottom: 2.5rem;">
                <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
                    PAN-INDIA SOURCING NETWORK
                </span>
                <h2 style="color: #121214; font-size: 1.8rem; font-weight: 700; margin-top: 5px;">
                    Explore Stone Hub India in Other Major Cities
                </h2>
                <p style="color: #666; font-size: 0.95rem; margin: 0 auto; max-width: 600px;">
                    We supply and deliver imported natural stone blocks and gangsaw slabs across India with dedicated logistics.
                </p>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; max-width: 1100px; margin: 0 auto;">
                @foreach($allCities as $cItem)
                    @php
                        $cName = $cItem->content['city_name'] ?? ucwords(str_replace('-', ' ', $cItem->city));
                        $cSlug = $cItem->content['city_slug'] ?? \Illuminate\Support\Str::slug($cItem->city);
                    @endphp
                    <a href="{{ route('location.city.seller', ['city' => $cSlug]) }}" style="background: #ffffff; border: 1px solid rgba(15,15,17,0.08); padding: 8px 16px; border-radius: 30px; font-size: 0.88rem; font-weight: 500; color: #2d2d32; text-decoration: none; transition: all 0.2s ease; display: inline-flex; align-items: center; gap: 6px;">
                        <span style="color: var(--accent-gold);">📍</span> {{ $cName }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 9. FINAL LUXURY CONVERSION BANNER -->
    <section class="final-cta-section" style="background: linear-gradient(135deg, #17171a 0%, #0d0d0f 100%); border-top: 1px solid rgba(255,255,255,0.08); color: #fff; padding: 5rem 1rem;">
        <div class="container text-center" style="max-width: 800px; margin: 0 auto;">
            <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 10px;">
                START YOUR NATURAL STONE JOURNEY
            </span>
            <h2 style="color: #ffffff !important; font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: 700; line-height: 1.25; margin-bottom: 1.25rem;">
                Receive Catalogue & Current Slabs Stocklist for {{ $cityName }}
            </h2>
            <p style="color: rgba(255,255,255,0.7) !important; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2.25rem;">
                Speak directly with our natural stone curators to obtain prioritized pricing, block availability, and insured transit schedules for your site in {{ $cityName }}.
            </p>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px;">
                <button onclick="openDialog('callback-dialog');" class="btn btn-primary" style="padding: 14px 34px; font-size: 1rem; font-weight: 600;">
                    Request Free Consultation
                </button>
                <a href="{{ route('contact') }}" class="btn btn-secondary" style="padding: 14px 28px; font-size: 1rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.2); color: #fff;">
                    <i data-lucide="phone"></i> Contact Showroom
                </a>
            </div>
        </div>
    </section>

    <script>
        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const chevron = document.getElementById(`faq-chevron-${index}`);
            if (answer.style.display === 'none' || answer.style.display === '') {
                answer.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
            } else {
                answer.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        }
    </script>

@endsection
