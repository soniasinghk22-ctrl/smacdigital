@extends('layouts.app')

@section('title', $applicationPage->metatitle ?? 'Marble Applications & Architectural Spaces | Stone Hub India')
@section('meta_description', $applicationPage->metadescription ?? 'Explore luxury marble applications for flooring, living rooms, hotel lobbies, outdoor travertine, kitchen countertops, and designer washrooms by Stone Hub India.')
@section('meta_keywords', $applicationPage->metakeywords ?? 'marble application, italian marble flooring, living room marble wall, marble lobby design, outdoor travertine, kitchen marble countertop, bathroom marble design')

@section('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'CollectionPage',
      '@id' => route('application') . '/#webpage',
      'url' => route('application'),
      'name' => 'Marble Applications & Architectural Spaces | ' . ($site['site_name'] ?? 'Stone Hub India'),
      'description' => 'Discover curated architectural marble applications for luxury residential and commercial spaces.',
      'isPartOf' => [
        '@type' => 'WebSite',
        '@id' => route('home') . '/#website'
      ],
      'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
          [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => route('home')
          ],
          [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Applications',
            'item' => route('application')
          ]
        ]
      ]
    ]
  ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('styles')
<style>
    /* Application Hub Styles */
    .app-hero {
        position: relative;
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5rem 1.5rem 4rem;
        background: #0f0f11;
        overflow: hidden;
    }
    .app-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.38;
        transform: scale(1.03);
        transition: transform 10s ease;
    }
    .app-hero:hover .app-hero-bg {
        transform: scale(1.08);
    }
    .app-hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(15,15,17,0.4) 0%, rgba(11,11,12,0.92) 100%);
    }
    .app-hero-content {
        position: relative;
        z-index: 2;
        max-width: 920px;
        margin: 0 auto;
    }
    .app-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(197, 168, 128, 0.12);
        border: 1px solid rgba(197, 168, 128, 0.35);
        border-radius: 999px;
        color: var(--accent-gold, #C5A880);
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
    }
    .app-hero h1 {
        font-size: clamp(2.2rem, 4.5vw, 3.6rem);
        color: #ffffff !important;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        line-height: 1.18;
        margin-bottom: 1.25rem;
        letter-spacing: -0.02em;
    }
    .app-hero p {
        font-size: clamp(1rem, 1.8vw, 1.2rem);
        color: rgba(255, 255, 255, 0.82);
        max-width: 760px;
        margin: 0 auto 2rem;
        line-height: 1.65;
    }
    .app-hero-cta-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
    }

    /* Quick Filter Pills */
    .app-nav-bar {
        background: #ffffff;
        border-bottom: 1px solid rgba(15,15,17,0.08);
        position: sticky;
        top: 70px;
        z-index: 90;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }
    .app-nav-pills {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 0.85rem 0;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .app-nav-pills::-webkit-scrollbar {
        display: none;
    }
    .app-nav-pill {
        padding: 0.5rem 1.15rem;
        border-radius: 999px;
        background: #f4f2ed;
        color: #4a4a54;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.25s ease;
        border: 1px solid transparent;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .app-nav-pill:hover, .app-nav-pill.active {
        background: #151518;
        color: #ffffff;
        border-color: var(--accent-gold, #C5A880);
    }
    .app-nav-pill i {
        width: 15px;
        height: 15px;
        color: var(--accent-gold, #C5A880);
    }

    /* Grid of Architectural Applications */
    .app-grid-section {
        padding: 5rem 0 6rem;
        background: #f7f6f2;
    }
    .app-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 2.25rem;
    }
    @media (max-width: 640px) {
        .app-card-grid {
            grid-template-columns: 1fr;
        }
    }
    .app-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 10px 30px rgba(15,15,17,0.04);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
    }
    .app-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(15,15,17,0.12);
        border-color: rgba(197, 168, 128, 0.4);
    }
    .app-card-media {
        position: relative;
        height: 280px;
        overflow: hidden;
        background: #1a1a1e;
    }
    .app-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .app-card:hover .app-card-img {
        transform: scale(1.08);
    }
    .app-card-tag {
        position: absolute;
        top: 1.25rem;
        left: 1.25rem;
        background: rgba(15, 15, 17, 0.8);
        backdrop-filter: blur(8px);
        color: var(--accent-gold, #C5A880);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 5px 12px;
        border-radius: 999px;
        border: 1px solid rgba(197, 168, 128, 0.3);
    }
    .app-card-badge-count {
        position: absolute;
        bottom: 1.25rem;
        right: 1.25rem;
        background: rgba(255, 255, 255, 0.95);
        color: #121214;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .app-card-body {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .app-card-title {
        font-size: 1.45rem;
        color: #121214 !important;
        font-weight: 700;
        margin-bottom: 0.6rem;
        font-family: 'Outfit', sans-serif;
    }
    .app-card-subtitle {
        color: #8a6d3b;
        font-size: 0.88rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.85rem;
    }
    .app-card-desc {
        color: #55555e;
        font-size: 0.94rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }
    .app-card-features {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 1.75rem;
    }
    .app-feature-pill {
        background: #f4f2ed;
        color: #2f2f36;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        border: 1px solid rgba(15,15,17,0.05);
    }
    .app-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1.25rem;
        border-top: 1px solid rgba(15,15,17,0.06);
    }
    .app-card-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #121214;
        font-weight: 700;
        font-size: 0.92rem;
        text-decoration: none;
        transition: color 0.2s ease, transform 0.2s ease;
    }
    .app-card-link i {
        width: 16px;
        height: 16px;
        color: var(--accent-gold, #C5A880);
        transition: transform 0.2s ease;
    }
    .app-card:hover .app-card-link {
        color: var(--accent-gold-hover, #B4956C);
    }
    .app-card:hover .app-card-link i {
        transform: translateX(4px);
    }

    /* Consultation Banner */
    .app-cta-banner {
        background: linear-gradient(135deg, #121214 0%, #1e1e24 100%);
        border-radius: 24px;
        padding: 4rem 3rem;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(197, 168, 128, 0.25);
        box-shadow: 0 24px 60px rgba(0,0,0,0.25);
        margin-top: 4rem;
    }
    .app-cta-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(197, 168, 128, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .app-cta-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 3rem;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    @media (max-width: 900px) {
        .app-cta-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        .app-cta-banner {
            padding: 2.5rem 1.5rem;
        }
    }
    .app-form-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        padding: 2rem;
    }
</style>
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="app-hero">
        <img src="{{ asset('uploads/collection/italian_marble_statuario_salon.jpg') }}" alt="Luxury marble applications by Stone Hub India" class="app-hero-bg">
        <div class="app-hero-overlay"></div>
        <div class="app-hero-content animate-on-scroll">
            <span class="app-hero-badge"><i data-lucide="sparkles" style="width: 14px; height: 14px;"></i> Architectural Spaces & Design</span>
            <h1>Luxury Marble Applications</h1>
            <p>From monumental living room bookmatched walls to sprawling Italian marble flooring, hotel lobbies, and outdoor travertine — explore how natural stone defines bespoke spaces.</p>
            <div class="app-hero-cta-group">
                <a href="#applications-grid" class="btn btn-primary btn-lg" style="background: var(--accent-gold); border-color: var(--accent-gold); color: #121214; font-weight: 700;">
                    <span>Explore Spaces</span>
                    <i data-lucide="arrow-down" style="width: 18px; height: 18px;"></i>
                </a>
                <a href="{{ route('enquiry') }}" class="btn btn-outline-white btn-lg">
                    <span>Request Material Quotation</span>
                    <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Sticky Navigation Filter Pills -->
    <nav class="app-nav-bar" aria-label="Applications quick links">
        <div class="container">
            <div class="app-nav-pills">
                <a href="#flooring" class="app-nav-pill"><i data-lucide="layers"></i> Flooring</a>
                <a href="#living-room" class="app-nav-pill"><i data-lucide="tv"></i> Living Room</a>
                <a href="#lobby" class="app-nav-pill"><i data-lucide="building"></i> Lobby & Foyers</a>
                <a href="#outdoor-travertine" class="app-nav-pill"><i data-lucide="sun"></i> Outdoor Travertine</a>
                <a href="#kitchen" class="app-nav-pill"><i data-lucide="utensils"></i> Kitchen Islands</a>
                <a href="#bathroom-marble-design" class="app-nav-pill"><i data-lucide="droplet"></i> Bathrooms</a>
                <a href="{{ route('pricelist') }}" class="app-nav-pill" style="background: rgba(197, 168, 128, 0.15); color: #8a6d3b; border-color: rgba(197, 168, 128, 0.4);"><i data-lucide="dollar-sign"></i> Marble Price List</a>
            </div>
        </div>
    </nav>

    <!-- Main Applications Section -->
    <section class="app-grid-section" id="applications-grid">
        <div class="container">
            
            <div class="section-header text-center" style="max-width: 780px; margin: 0 auto 3.5rem;">
                <span class="eyebrow" style="color: #8a6d3b; font-weight: 700; letter-spacing: 2px;">CURATED SPACES</span>
                <h2 style="font-size: clamp(1.8rem, 3.2vw, 2.5rem); color: #121214 !important; font-weight: 700; margin-top: 0.5rem;">Explore Natural Stone by Application Area</h2>
                <p style="color: #666671; font-size: 1.05rem; margin-top: 0.75rem;">Each stone category exhibits unique porosity, vein composition, light translucency, and compressive durability engineered for specific architectural spaces.</p>
            </div>

            <!-- Application Cards Grid -->
            <div class="app-card-grid">

                <!-- 1. Flooring -->
                <article class="app-card" id="flooring">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/italian_marble_statuario_salon.jpg') }}" alt="Italian marble flooring application" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Interior Flooring</span>
                        <span class="app-card-badge-count">6+ Gallery Views</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">Timeless Grandeur Underfoot</span>
                        <h3 class="app-card-title">Italian Marble Flooring</h3>
                        <p class="app-card-desc">Seamless mirror-polished Italian marble slabs with continuous vein matching. Keeps interiors naturally cool, enhances ambient light, and creates an unrivaled luxury aesthetic in expansive halls and living quarters.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Statuario White</span>
                            <span class="app-feature-pill">Botticino Classic</span>
                            <span class="app-feature-pill">Michael Angelo</span>
                            <span class="app-feature-pill">Grey Laurent</span>
                            <span class="app-feature-pill">18mm - 20mm Calibrated</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'flooring') }}" class="app-card-link">
                                <span>Explore Flooring Slabs & Designs</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- 2. Living Room -->
                <article class="app-card" id="living-room">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/brown_earth_marble_living.jpg') }}" alt="Living room marble wall cladding and flooring" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Living & Wall Cladding</span>
                        <span class="app-card-badge-count">Bookmatched Walls</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">Focal Center of Architecture</span>
                        <h3 class="app-card-title">Living Room & Accent Walls</h3>
                        <p class="app-card-desc">Transform double-height living areas and television backdrops with four-piece quad-matched marble slabs, backlit quartzite panels, and warm earthy tones that complement modern luxury furnishings.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Calacatta Gold</span>
                            <span class="app-feature-pill">Patagonia Quartzite</span>
                            <span class="app-feature-pill">Golden Portoro</span>
                            <span class="app-feature-pill">Pink Onyx</span>
                            <span class="app-feature-pill">Backlit Panels</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'living-room') }}" class="app-card-link">
                                <span>View Living Room Concepts</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- 3. Lobby -->
                <article class="app-card" id="lobby">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/imported_marble_grand_foyer.jpg') }}" alt="Grand lobby entrance marble design" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Lobbies & Atriums</span>
                        <span class="app-card-badge-count">High Footfall Zones</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">First Impressions of Prestige</span>
                        <h3 class="app-card-title">Grand Lobby & Entrance Foyers</h3>
                        <p class="app-card-desc">Architectural imported marble engineered for monumental residential foyers, corporate headquarters, 5-star hotel receptions, and elevator cladding with heavy-duty abrasion endurance.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Statuario Venato</span>
                            <span class="app-feature-pill">Grey Flurry</span>
                            <span class="app-feature-pill">Perlato Sicilia</span>
                            <span class="app-feature-pill">Waterjet Inlays</span>
                            <span class="app-feature-pill">Mirror Polish</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'lobby') }}" class="app-card-link">
                                <span>Explore Lobby Architecture</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- 4. Outdoor Travertine -->
                <article class="app-card" id="outdoor-travertine">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/classic_travertine_villa_terrace.jpg') }}" alt="Outdoor travertine terrace and facade marble" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Exterior & Facades</span>
                        <span class="app-card-badge-count">Weather-Resistant</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">Nature-Carved Resilience</span>
                        <h3 class="app-card-title">Outdoor Travertine & Facades</h3>
                        <p class="app-card-desc">Natural pitted Travertine Romano and Titanium Travertine for villa terraces, swimming pool surrounds, ventilated wall facades, and garden pathways. Naturally heat-dissipating and slip-resistant.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Travertine Romano</span>
                            <span class="app-feature-pill">Silver Travertine</span>
                            <span class="app-feature-pill">Titanium Travertine</span>
                            <span class="app-feature-pill">Honed / Unfilled</span>
                            <span class="app-feature-pill">Anti-Skid</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'outdoor-travertine') }}" class="app-card-link">
                                <span>View Outdoor Travertine Details</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- 5. Kitchen -->
                <article class="app-card" id="kitchen">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/exotic_quartzite_patagonia_island.jpg') }}" alt="Luxury kitchen waterfall island in exotic quartzite" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Kitchens & Counters</span>
                        <span class="app-card-badge-count">Waterfall Slabs</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">Culinary Artistry in Stone</span>
                        <h3 class="app-card-title">Kitchen Countertops & Islands</h3>
                        <p class="app-card-desc">Monolithic waterfall edge kitchen islands, dining tabletops, and stain-sealed cooktop slabs. Engineered with high-density exotic quartzite and Italian marble for heat and scratch resistance.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Calacatta Borghini</span>
                            <span class="app-feature-pill">Blue Roma Quartzite</span>
                            <span class="app-feature-pill">Nero Marquina</span>
                            <span class="app-feature-pill">Taj Mahal Quartzite</span>
                            <span class="app-feature-pill">Mitred Edge Profiles</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'kitchen') }}" class="app-card-link">
                                <span>Discover Kitchen Countertops</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- 6. Bathrooms -->
                <article class="app-card" id="bathroom-marble-design">
                    <div class="app-card-media">
                        <img src="{{ asset('uploads/collection/black_gold_bath_suite.jpg') }}" alt="Luxury bathroom marble and vanity design" class="app-card-img" loading="lazy">
                        <span class="app-card-tag">Bathrooms & Washrooms</span>
                        <span class="app-card-badge-count">Private Sanctuary</span>
                    </div>
                    <div class="app-card-body">
                        <span class="app-card-subtitle">Spa Sanctuary in Pure Stone</span>
                        <h3 class="app-card-title">Luxury Bathrooms & Vanities</h3>
                        <p class="app-card-desc">Indulge in five-star bathroom suites with bookmatched shower enclosures, floating marble vanity tops, integrated monolithic sinks, and honed anti-slip flooring.</p>
                        
                        <div class="app-card-features">
                            <span class="app-feature-pill">Statuario White</span>
                            <span class="app-feature-pill">Black & Gold Portoro</span>
                            <span class="app-feature-pill">Pink Onyx</span>
                            <span class="app-feature-pill">Blue Lagoon</span>
                            <span class="app-feature-pill">Waterproof Epoxy Sealed</span>
                        </div>

                        <div class="app-card-footer">
                            <a href="{{ route('application.show', 'bathroom-marble-design') }}" class="app-card-link">
                                <span>Explore Bathroom Collections</span>
                                <i data-lucide="arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

            </div>

            <!-- Consultation Banner & Form -->
            <div class="app-cta-banner animate-on-scroll">
                <div class="app-cta-grid">
                    <div>
                        <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">EXPERT ARCHITECTURAL GUIDANCE</span>
                        <h2 style="font-size: clamp(1.8rem, 3vw, 2.4rem); color: #ffffff !important; font-weight: 700; margin: 0.6rem 0 1rem; font-family: 'Outfit', sans-serif;">Unsure Which Marble Best Fits Your Space?</h2>
                        <p style="color: rgba(255,255,255,0.8); line-height: 1.65; margin-bottom: 1.5rem;">Our stone curators in Kishangarh assist architects, interior designers, and homeowners with block matching, slab calculation, cutting optimization, and nationwide delivery.</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.9); font-size: 0.95rem;">
                                <i data-lucide="check-circle-2" style="width: 18px; height: 18px; color: var(--accent-gold);"></i> Direct Quarry Sourcing from Italy, Greece, Brazil, and Turkey
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.9); font-size: 0.95rem;">
                                <i data-lucide="check-circle-2" style="width: 18px; height: 18px; color: var(--accent-gold);"></i> 100% Calibrated 18mm/20mm Slabs with Zero Thickness Variations
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,0.9); font-size: 0.95rem;">
                                <i data-lucide="check-circle-2" style="width: 18px; height: 18px; color: var(--accent-gold);"></i> Live HD Video Calling for Standing Slab & Lot Inspection
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: #ffffff; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
                                <i data-lucide="phone" style="width: 16px; height: 16px; color: var(--accent-gold);"></i> {{ $site['phone'] ?? '+91 96727 77749' }}
                            </a>
                        </div>
                    </div>

                    <div class="app-form-card">
                        <h3 style="color: #ffffff !important; font-size: 1.25rem; font-weight: 700; margin-bottom: 1.25rem;">Book Space Consultation</h3>
                        
                        @if(session('success'))
                            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #86efac; padding: 12px; border-radius: 8px; margin-bottom: 1rem; font-size: 0.9rem;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('application.consultation.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="source" value="Application Page Consultation">
                            
                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label style="font-size: 0.82rem; color: rgba(255,255,255,0.7); display: block; margin-bottom: 4px;">Your Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Architect / Client Name" required style="background: rgba(0,0,0,0.35); border: 1px solid rgba(255,255,255,0.15); color: #ffffff; padding: 0.65rem 1rem; border-radius: 8px; width: 100%;">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 0.82rem; color: rgba(255,255,255,0.7); display: block; margin-bottom: 4px;">Phone / WhatsApp *</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required style="background: rgba(0,0,0,0.35); border: 1px solid rgba(255,255,255,0.15); color: #ffffff; padding: 0.65rem 1rem; border-radius: 8px; width: 100%;">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 0.82rem; color: rgba(255,255,255,0.7); display: block; margin-bottom: 4px;">City / Project Location</label>
                                    <input type="text" name="city" class="form-control" placeholder="e.g. Mumbai, Delhi, Bangalore" style="background: rgba(0,0,0,0.35); border: 1px solid rgba(255,255,255,0.15); color: #ffffff; padding: 0.65rem 1rem; border-radius: 8px; width: 100%;">
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 1rem;">
                                <label style="font-size: 0.82rem; color: rgba(255,255,255,0.7); display: block; margin-bottom: 4px;">Primary Application Space *</label>
                                <select name="space" class="form-control" required style="background: #151518; border: 1px solid rgba(255,255,255,0.15); color: #ffffff; padding: 0.65rem 1rem; border-radius: 8px; width: 100%;">
                                    <option value="Flooring" style="background: #151518; color: #fff;">Flooring (Living & Bedrooms)</option>
                                    <option value="Living Room Feature Wall" style="background: #151518; color: #fff;">Living Room Accent / TV Wall</option>
                                    <option value="Lobby & Foyers" style="background: #151518; color: #fff;">Grand Lobby & Entrance</option>
                                    <option value="Outdoor Travertine" style="background: #151518; color: #fff;">Outdoor Travertine / Pool / Facade</option>
                                    <option value="Kitchen Island & Counters" style="background: #151518; color: #fff;">Kitchen Waterfall Island & Counters</option>
                                    <option value="Luxury Bathroom" style="background: #151518; color: #fff;">Luxury Bathroom & Vanity</option>
                                    <option value="Complete Villa Project" style="background: #151518; color: #fff;">Complete Villa / Commercial Project</option>
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom: 1.25rem;">
                                <label style="font-size: 0.82rem; color: rgba(255,255,255,0.7); display: block; margin-bottom: 4px;">Estimated Area (Sq. Ft.) or Specific Requirements</label>
                                <textarea name="message" class="form-control" rows="2" placeholder="e.g. 3,500 sq ft flooring + bookmatched TV wall in white marble" style="background: rgba(0,0,0,0.35); border: 1px solid rgba(255,255,255,0.15); color: #ffffff; padding: 0.65rem 1rem; border-radius: 8px; width: 100%;"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; background: var(--accent-gold); border-color: var(--accent-gold); color: #121214; font-weight: 700; padding: 0.85rem; border-radius: 8px;">
                                Request Expert Consultation
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
