@extends('layouts.app')

@section('title', $spaceData['metatitle'] ?? ($spaceData['title'] . ' | Marble Applications | Stone Hub India'))
@section('meta_description', $spaceData['metadescription'] ?? ('Explore ' . $spaceData['title'] . ' solutions in imported Italian marble, exotic quartzite, and travertine from Stone Hub India Kishangarh.'))
@section('meta_keywords', $spaceData['metakeywords'] ?? ($spaceData['title'] . ', italian marble, marble supplier kishangarh, stone hub india'))

@section('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'WebPage',
      '@id' => route('application.show', $spaceData['slug']) . '/#webpage',
      'url' => route('application.show', $spaceData['slug']),
      'name' => $spaceData['title'] . ' | ' . ($site['site_name'] ?? 'Stone Hub India'),
      'description' => $spaceData['metadescription'] ?? $spaceData['description'],
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
          ],
          [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $spaceData['title'],
            'item' => route('application.show', $spaceData['slug'])
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
    /* Space Hero */
    .space-hero {
        position: relative;
        min-height: 440px;
        display: flex;
        align-items: center;
        padding: 5rem 1.5rem 4rem;
        background: #0d0d0f;
        overflow: hidden;
    }
    .space-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.42;
    }
    .space-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(13,13,15,0.92) 0%, rgba(13,13,15,0.7) 60%, rgba(13,13,15,0.95) 100%);
    }
    .space-hero-content {
        position: relative;
        z-index: 2;
        max-width: 860px;
    }
    .space-breadcrumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: rgba(255,255,255,0.6);
        margin-bottom: 1rem;
    }
    .space-breadcrumbs a {
        color: rgba(255,255,255,0.75);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .space-breadcrumbs a:hover {
        color: var(--accent-gold, #C5A880);
    }
    .space-hero h1 {
        font-size: clamp(2.2rem, 4vw, 3.4rem);
        color: #ffffff !important;
        font-weight: 700;
        line-height: 1.15;
        margin-bottom: 1rem;
        font-family: 'Outfit', sans-serif;
    }
    .space-hero-lead {
        font-size: clamp(1rem, 1.6vw, 1.15rem);
        color: rgba(255,255,255,0.85);
        line-height: 1.65;
        margin-bottom: 2rem;
    }

    /* Technical Specs Strip */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-top: -3rem;
        position: relative;
        z-index: 10;
        margin-bottom: 4rem;
    }
    .spec-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 1.5rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .spec-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(197, 168, 128, 0.12);
        color: #8a6d3b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .spec-label {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #71717a;
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }
    .spec-val {
        font-size: 1rem;
        font-weight: 700;
        color: #121214;
    }

    /* Slabs & Gallery Section */
    .space-content-section {
        padding: 2rem 0 5rem;
        background: #f7f6f2;
    }

    /* Marble Slab Product Card */
    .slab-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.75rem;
        margin-bottom: 4rem;
    }
    .slab-item-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(15,15,17,0.07);
        box-shadow: 0 8px 24px rgba(15,15,17,0.03);
        transition: all 0.35s ease;
        display: flex;
        flex-direction: column;
    }
    .slab-item-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(15,15,17,0.08);
        border-color: rgba(197, 168, 128, 0.4);
    }
    .slab-item-media {
        position: relative;
        height: 230px;
        overflow: hidden;
        background: #151518;
    }
    .slab-item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .slab-item-card:hover .slab-item-img {
        transform: scale(1.08);
    }
    .slab-item-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .slab-item-title {
        font-size: 1.2rem;
        color: #121214 !important;
        font-weight: 700;
        margin-bottom: 0.4rem;
    }
    .slab-item-origin {
        font-size: 0.82rem;
        color: #8a6d3b;
        font-weight: 600;
        margin-bottom: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .slab-item-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid rgba(15,15,17,0.05);
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.25rem;
        margin-bottom: 4.5rem;
    }
    .gallery-tile {
        position: relative;
        height: 250px;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
    }
    .gallery-tile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .gallery-tile:hover img {
        transform: scale(1.06);
    }
    .gallery-tile-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem 1rem 0.75rem;
        background: linear-gradient(to top, rgba(15,15,17,0.85), transparent);
        color: #ffffff;
        font-size: 0.88rem;
        font-weight: 600;
    }

    /* Guidelines Two Column */
    .guideline-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 2.5rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        margin-bottom: 4rem;
    }
</style>
@endsection

@section('content')

    <!-- Space Hero -->
    <section class="space-hero">
        <img src="{{ asset($spaceData['hero_image'] ?? 'uploads/collection/italian_marble_statuario_salon.jpg') }}" alt="{{ $spaceData['title'] }}" class="space-hero-bg">
        <div class="space-hero-overlay"></div>
        <div class="container space-hero-content animate-on-scroll">
            <nav class="space-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('application') }}">Applications</a>
                <span>/</span>
                <span style="color: var(--accent-gold);">{{ $spaceData['title'] }}</span>
            </nav>
            <span style="color: var(--accent-gold); font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">ARCHITECTURAL APPLICATION</span>
            <h1>{{ $spaceData['title'] }}</h1>
            <p class="space-hero-lead">{{ $spaceData['description'] }}</p>
            <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                <a href="#consultation-form" class="btn btn-primary" style="background: var(--accent-gold); border-color: var(--accent-gold); color: #121214; font-weight: 700; padding: 0.75rem 1.75rem;">
                    <span>Request Material Consultation</span>
                    <i data-lucide="calendar" style="width: 16px; height: 16px;"></i>
                </a>
                <a href="{{ route('pricelist') }}" class="btn btn-outline-white" style="padding: 0.75rem 1.75rem;">
                    <span>View Price Per Sq Ft</span>
                    <i data-lucide="tag" style="width: 16px; height: 16px;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content Body -->
    <section class="space-content-section">
        <div class="container">

            <!-- Technical Specs Strip -->
            <div class="specs-grid animate-on-scroll">
                <div class="spec-card">
                    <div class="spec-icon"><i data-lucide="maximize-2"></i></div>
                    <div>
                        <span class="spec-label">Ideal Slab Thickness</span>
                        <span class="spec-val">{{ $spaceData['specs']['thickness'] ?? '18mm - 20mm' }}</span>
                    </div>
                </div>
                <div class="spec-card">
                    <div class="spec-icon"><i data-lucide="sparkles"></i></div>
                    <div>
                        <span class="spec-label">Recommended Finish</span>
                        <span class="spec-val">{{ $spaceData['specs']['finish'] ?? 'Mirror Polished / Honed' }}</span>
                    </div>
                </div>
                <div class="spec-card">
                    <div class="spec-icon"><i data-lucide="shield-check"></i></div>
                    <div>
                        <span class="spec-label">Durability / Traffic</span>
                        <span class="spec-val">{{ $spaceData['specs']['durability'] ?? 'High Abrasion Resistance' }}</span>
                    </div>
                </div>
                <div class="spec-card">
                    <div class="spec-icon"><i data-lucide="compass"></i></div>
                    <div>
                        <span class="spec-label">Bookmatching</span>
                        <span class="spec-val">{{ $spaceData['specs']['pattern'] ?? 'Open-Book & Cross Vein' }}</span>
                    </div>
                </div>
            </div>

            <!-- Recommended Marbles for this Space -->
            <div style="margin-bottom: 4rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <span style="color: #8a6d3b; font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">CURATED SELECTION</span>
                        <h2 style="font-size: clamp(1.6rem, 2.8vw, 2.2rem); color: #121214 !important; font-weight: 700; margin-top: 0.35rem;">Recommended Stones for {{ $spaceData['title'] }}</h2>
                    </div>
                    <a href="{{ route('products.index') }}" style="color: #121214; font-weight: 700; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                        <span>View All 300+ Stones</span>
                        <i data-lucide="arrow-right" style="width: 16px; height: 16px; color: var(--accent-gold);"></i>
                    </a>
                </div>

                <div class="slab-grid">
                    @forelse($curatedMarbles as $marble)
                        <div class="slab-item-card">
                            <div class="slab-item-media">
                                @php
                                    $mImg = $marble->image ? site_image($marble->image) : asset('uploads/collection/italian_marble_statuario_salon.jpg');
                                @endphp
                                <img src="{{ $mImg }}" alt="{{ $marble->name }}" class="slab-item-img" loading="lazy">
                            </div>
                            <div class="slab-item-body">
                                <h3 class="slab-item-title">{{ $marble->name }}</h3>
                                <span class="slab-item-origin"><i data-lucide="map-pin" style="width: 13px; height: 13px;"></i> Origin: {{ $marble->origin ?? 'Italy' }}</span>
                                <p style="font-size: 0.88rem; color: #555560; line-height: 1.5; margin-bottom: 1rem;">
                                    {{ Str::limit(strip_tags($marble->description ?? 'Premium imported marble slab featuring natural veining and high gloss luster.'), 95) }}
                                </p>
                                <div class="slab-item-actions">
                                    <a href="{{ route('products.show', $marble->slug) }}" class="btn btn-sm" style="flex: 1; background: #151518; color: #ffffff; text-align: center; padding: 0.5rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;">
                                        View Slab
                                    </a>
                                    <a href="{{ route('enquiry') }}?stone={{ urlencode($marble->name) }}&space={{ urlencode($spaceData['title']) }}" class="btn btn-sm" style="background: rgba(197, 168, 128, 0.15); color: #8a6d3b; border: 1px solid rgba(197, 168, 128, 0.35); padding: 0.5rem 0.75rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem;" title="Get Quote">
                                        Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #71717a;">
                            Explore our comprehensive catalogue for Italian marble varieties.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Execution Photo Gallery -->
            @if(!empty($galleryImages) && count($galleryImages) > 0)
                <div style="margin-bottom: 4rem;">
                    <div class="text-center" style="max-width: 680px; margin: 0 auto 2.5rem;">
                        <span style="color: #8a6d3b; font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">REAL INSTALLATIONS</span>
                        <h2 style="font-size: clamp(1.6rem, 2.8vw, 2.2rem); color: #121214 !important; font-weight: 700; margin-top: 0.35rem;">Architectural Projects & Real Photos</h2>
                        <p style="color: #666671; font-size: 0.98rem; margin-top: 0.5rem;">Installed in luxury residential villas, penthouses, commercial headquarters, and hospitality suites across India.</p>
                    </div>

                    <div class="gallery-grid">
                        @foreach($galleryImages as $img)
                            <div class="gallery-tile">
                                <img src="{{ asset('uploads/gallery/' . $img['file']) }}" alt="{{ $img['title'] }}" loading="lazy">
                                <div class="gallery-tile-caption">
                                    {{ $img['title'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Design & Technical Guidelines Card -->
            <div class="guideline-card">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                    <div>
                        <span style="color: #8a6d3b; font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">SPECIFICATION NOTES</span>
                        <h3 style="font-size: 1.6rem; color: #121214 !important; font-weight: 700; margin: 0.4rem 0 1.25rem;">Design Principles for {{ $spaceData['title'] }}</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 1.25rem; font-size: 0.95rem; color: #4a4a54; line-height: 1.65;">
                            <div>
                                <strong style="color: #121214; display: block; margin-bottom: 2px;">1. Continuous Vein Mapping & Block Sequencing</strong>
                                <p style="margin: 0;">We supply consecutively cut slabs from the exact same quarry block, allowing seamless pattern flow without jarring color shifts across adjoining rooms.</p>
                            </div>
                            <div>
                                <strong style="color: #121214; display: block; margin-bottom: 2px;">2. Surface Finishing & Slip Index</strong>
                                <p style="margin: 0;">For high-slip zones (bathrooms & outdoor decks), honed, flamed, or acid-washed micro-textures provide optimal traction without compromising stone luster.</p>
                            </div>
                            <div>
                                <strong style="color: #121214; display: block; margin-bottom: 2px;">3. Epoxy Impregnation & Hydrophobic Sealing</strong>
                                <p style="margin: 0;">Every slab processed in our Kishangarh facility receives automated vacuum epoxy penetration, enhancing fracture resistance and shielding against liquid staining.</p>
                            </div>
                        </div>
                    </div>

                    <div id="consultation-form" style="background: #fdfcf9; border: 1px solid rgba(197, 168, 128, 0.3); border-radius: 14px; padding: 2rem;">
                        <h3 style="color: #121214 !important; font-size: 1.3rem; font-weight: 700; margin-bottom: 0.5rem;">Request Consultation for {{ $spaceData['title'] }}</h3>
                        <p style="font-size: 0.88rem; color: #666671; margin-bottom: 1.25rem;">Receive slab photos, quantity estimation, and price quotes tailored to your floor plan.</p>

                        @if(session('success'))
                            <div style="background: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 10px; border-radius: 6px; margin-bottom: 1rem; font-size: 0.88rem;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('application.consultation.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="space" value="{{ $spaceData['title'] }}">
                            <input type="hidden" name="source" value="Application - {{ $spaceData['title'] }}">

                            <div class="form-group" style="margin-bottom: 0.85rem;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Full Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" required style="padding: 0.6rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Phone / WhatsApp *</label>
                                    <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required style="padding: 0.6rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">City</label>
                                    <input type="text" name="city" class="form-control" placeholder="Project City" style="padding: 0.6rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 0.85rem;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Estimated Sq. Ft. Required</label>
                                <input type="text" name="area_sqft" class="form-control" placeholder="e.g. 2,000 sq. ft." style="padding: 0.6rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>

                            <div class="form-group" style="margin-bottom: 1.25rem;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Specific Stone Preference or Message</label>
                                <textarea name="message" class="form-control" rows="2" placeholder="e.g. Looking for white Statuario with bold grey veins for this space" style="padding: 0.6rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%; background: #121214; border-color: #121214; color: #ffffff; padding: 0.75rem; border-radius: 6px; font-weight: 700;">
                                Submit Consultation Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Other Application Spaces Links -->
            <div style="border-top: 1px solid rgba(15,15,17,0.08); padding-top: 3.5rem;">
                <h3 style="font-size: 1.4rem; color: #121214 !important; font-weight: 700; margin-bottom: 1.5rem; text-align: center;">Explore Other Architectural Spaces</h3>
                
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.75rem;">
                    @php
                        $otherSpaces = [
                            'flooring' => 'Italian Marble Flooring',
                            'living-room' => 'Living Room & Accent Walls',
                            'lobby' => 'Grand Lobby & Foyers',
                            'outdoor-travertine' => 'Outdoor Travertine & Facades',
                            'kitchen' => 'Kitchen Waterfall Islands',
                            'bathroom-marble-design' => 'Luxury Bathrooms & Vanities'
                        ];
                    @endphp
                    @foreach($otherSpaces as $sSlug => $sTitle)
                        @if($sSlug !== $spaceData['slug'])
                            <a href="{{ route('application.show', $sSlug) }}" class="btn" style="background: #ffffff; border: 1px solid rgba(15,15,17,0.1); color: #27272a; padding: 0.65rem 1.25rem; border-radius: 999px; font-weight: 600; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                                <i data-lucide="layers" style="width: 14px; height: 14px; color: var(--accent-gold);"></i>
                                {{ $sTitle }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@endsection
