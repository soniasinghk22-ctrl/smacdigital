@extends('layouts.app')

@section('title', ($homePage->metatitle ?? 'Premium Imported Marble & Slabs | Stone Hub India'))
@section('meta_description', ($homePage->metadescription ?? 'Stone Hub India is India\'s premier importer of luxury natural stones, including Statuario marble, exotic quartzite, Onyx, and Travertine slabs.'))
@section('meta_keywords', ($homePage->metakeywords ?? 'imported marble, luxury quartzite slabs, statuario marble, onyx slabs, stone hub india'))

@section('body_class', 'homepage-active')

@section('styles')
    <!-- Inject Custom Stylesheet for Homepage Redesign -->
    <link rel="stylesheet" href="{{ asset('assets/css/homepage-redesign.css') }}">
    <script>
        // Keep homepage marker classes in sync
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('stonehub-body', 'homepage-active');
        });
    </script>
@endsection

@section('schema')
@if(!empty($site['home_schema_markup']))
    {!! $site['home_schema_markup'] !!}
@else
    <script type="application/ld+json">
    {
      "{{ '@' }}context": "https://schema.org",
      "{{ '@graph' }}": [
        {
          "{{ '@type' }}": "HomeAndConstructionBusiness",
          "{{ '@id' }}": "{{ route('home') }}/#organization",
          "name": "{{ $site['site_name'] ?? 'Stone Hub India' }}",
          "url": "{{ route('home') }}",
          "logo": {
            "{{ '@type' }}": "ImageObject",
            "{{ '@id' }}": "{{ route('home') }}/#logo",
            "url": "{{ !empty($site['logo_path']) ? site_image($site['logo_path']) : asset('assets/images/logo.png') }}",
            "caption": "{{ $site['site_name'] ?? 'Stone Hub India' }}"
          },
          "telephone": "{{ $site['phone'] ?? '+919672777749' }}",
          "address": {
            "{{ '@type' }}": "PostalAddress",
            "streetAddress": "{{ $site['address'] ?? 'Plot No. 12, Industrial Area, Makrana Road, Kishangarh, Rajasthan - 305801' }}",
            "addressLocality": "Kishangarh",
            "addressRegion": "Rajasthan",
            "postalCode": "305801",
            "addressCountry": "IN"
          }
        },
        {
          "{{ '@type' }}": "WebSite",
          "{{ '@id' }}": "{{ route('home') }}/#website",
          "url": "{{ route('home') }}",
          "name": "{{ $site['site_name'] ?? 'Stone Hub India' }}",
          "publisher": {
            "{{ '@id' }}": "{{ route('home') }}/#organization"
          }
        }
      ]
    }
    </script>
@endif
@endsection

@section('content')

    <!-- Cinematic Hero Section -->
    <section class="stonehub-hero">
        <div class="stonehub-hero-slider">
            @if(isset($slides) && $slides->count() > 0)
                @foreach($slides as $index => $slide)
                    <div class="stonehub-hero-slide @if($index === 0) active @endif">
                        @if($slide->image_path)
                            <img src="{{ site_image($slide->image_path) }}" alt="{{ $slide->title }}" class="stonehub-hero-image">
                        @else
                            <div class="stonehub-hero-image" style="background: linear-gradient(135deg, #151518 0%, #0b0b0c 100%); width:100%; height:100%;"></div>
                        @endif
                        <div class="stonehub-hero-overlay"></div>
                        <div class="stonehub-hero-container">
                            <div class="stonehub-hero-content">
                                <span class="stonehub-hero-badge">
                                    <i data-lucide="gem" style="width: 14px; height: 14px;"></i>
                                    {{ $pageContents['home']['hero']['trust_badge'] ?? 'PREMIER IMPORTERS & CURATORS' }}
                                </span>
                                <h1 class="stonehub-hero-title">{{ $slide->title }}</h1>
                                <p class="stonehub-hero-subtitle">{{ $slide->subtitle }}</p>
                                <div class="stonehub-hero-buttons">
                                    <a href="{{ route('contact') }}" class="stonehub-hero-btn primary">
                                        {{ $slide->button_text ?: 'Book Showroom Tour' }}
                                        <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
                                    </a>
                                    @php
                                        $heroSecondaryLabel = $pageContents['home']['hero']['secondary_cta_label'] ?? 'Contact Us';
                                    @endphp
                                    <a href="{{ route('contact') }}" class="stonehub-hero-btn secondary">
                                        {{ $heroSecondaryLabel }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback slide -->
                <div class="stonehub-hero-slide active">
                    <div class="stonehub-hero-image" style="background: linear-gradient(135deg, #151518 0%, #0b0b0c 100%); width:100%; height:100%;"></div>
                    <div class="stonehub-hero-overlay"></div>
                    <div class="stonehub-hero-container">
                        <div class="stonehub-hero-content">
                            <span class="stonehub-hero-badge">
                                <i data-lucide="gem" style="width: 14px; height: 14px;"></i>
                                PREMIER IMPORTERS & CURATORS
                            </span>
                            <h1 class="stonehub-hero-title">CURATORS OF FINEST NATURAL STONE SLABS</h1>
                            <p class="stonehub-hero-subtitle">Handpicked marble, exotic quartzite, Onyx, and travertine sourced from Italy, Spain, Brazil, and Greece.</p>
                            <div class="stonehub-hero-buttons">
                                <a href="{{ route('contact') }}" class="stonehub-hero-btn primary">
                                    Book Showroom Tour
                                    <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
                                </a>
                                <a href="{{ route('contact') }}" class="stonehub-hero-btn secondary">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Slider Dots -->
        @if(isset($slides) && $slides->count() > 1)
            <div class="stonehub-hero-dots">
                @foreach($slides as $index => $slide)
                    <span class="stonehub-hero-dot @if($index === 0) active @endif" onclick="setHeroSlide({{ $index }})"></span>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Quick Actions Strip -->
    <div class="stonehub-quick-strip">
        <div class="stonehub-quick-grid">
            <a href="{{ route('contact') }}" class="stonehub-quick-item">
                <i data-lucide="building-2"></i>
                <span>{{ $pageContents['home']['quick_actions']['item1'] ?? 'Book Showroom Tour' }}</span>
            </a>
            <a href="{{ route('contact') }}" class="stonehub-quick-item">
                <i data-lucide="layers"></i>
                <span>{{ $pageContents['home']['quick_actions']['item2'] ?? 'Explore Slab Categories' }}</span>
            </a>
            <a href="{{ route('contact') }}" class="stonehub-quick-item">
                <i data-lucide="calculator"></i>
                <span>{{ $pageContents['home']['quick_actions']['item3'] ?? 'Request Quote Estimate' }}</span>
            </a>
            <a href="{{ route('contact') }}" class="stonehub-quick-item">
                <i data-lucide="video"></i>
                <span>{{ $pageContents['home']['quick_actions']['item4'] ?? 'Virtual Video Consult' }}</span>
            </a>
        </div>
    </div>

    <!-- Finder Widget Section -->
    <section class="stonehub-finder reveal-on-scroll">
        <div class="container stonehub-finder-inner">
            <div class="stonehub-finder-card">
                <div class="stonehub-finder-head">
                    <h3>{{ $pageContents['home']['finder']['title'] ?? 'I am looking for' }}</h3>
                    <p>{{ $pageContents['home']['finder']['description'] ?? 'Find the perfect match for your design projects based on stone category and applications.' }}</p>
                </div>
                <form id="stonehub-finder-form" action="{{ route('collections') }}" method="get" class="stonehub-finder-form">
                    <div class="stonehub-finder-field">
                        <label>Select Stone Category</label>
                        <select name="category" id="stonehub-finder-category">
                            @if(isset($globalCollections) && $globalCollections->count() > 0)
                                @foreach($globalCollections as $col)
                                    <option value="{{ $col->slug }}">{{ $col->name }}</option>
                                @endforeach
                            @else
                                <option value="italian-marble">Italian Marble</option>
                                <option value="imported-marble">Imported Marble</option>
                                <option value="quartzite">Exotic Quartzite</option>
                                <option value="onyx">Translucent Onyx</option>
                                <option value="travertine">Classic Travertine</option>
                                <option value="white-marble">White & Light Marble</option>
                                <option value="beige-marble">Beige & Cream Marble</option>
                                <option value="grey-marble">Grey & Silver Marble</option>
                                <option value="black-marble">Black & Dark Marble</option>
                                <option value="brown-marble">Brown & Earth Tones</option>
                                <option value="exotic-colored-marble">Exotic & Rare Colors</option>
                                <option value="bellezza">Bellezza Collection</option>
                                <option value="migliore">Migliore Collection</option>
                                <option value="forte">Forte Collection</option>
                                <option value="amore">Amore Collection</option>
                                <option value="spazio">Spazio Collection</option>
                                <option value="giovane">Giovane Collection</option>
                                <option value="lontano">Lontano Collection</option>
                            @endif
                        </select>
                    </div>
                    <div class="stonehub-finder-field">
                        <label>Select Application Area</label>
                        <select name="application">
                            @php
                                $treatmentsOpt = explode(',', $pageContents['home']['finder']['treatment_types'] ?? 'Living Room Wall,Kitchen Island Countertop,Bathroom Vanity,Flooring,Exterior Facade');
                            @endphp
                            @foreach($treatmentsOpt as $tr)
                                <option value="{{ trim($tr) }}">{{ trim($tr) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="stonehub-finder-submit">
                        <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                        <span>{{ $pageContents['home']['finder']['cta_label'] ?? 'Explore Ideal Slabs' }}</span>
                    </button>
                </form>
                <script>
                    document.getElementById('stonehub-finder-form')?.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var slug = document.getElementById('stonehub-finder-category')?.value || 'italian-marble';
                        window.location.href = '{{ url('/collections') }}/' + encodeURIComponent(slug);
                    });
                </script>
            </div>
        </div>
    </section>

    <!-- Instagram Reels Showcase Section (Controlled via Admin) -->
    <section class="stonehub-reels" id="specialties">
        <div class="stonehub-reels-header reveal-on-scroll">
            <div class="stonehub-reels-badge">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                <span>{{ $pageContents['home']['reels']['badge'] ?? 'INSTAGRAM REELS' }}</span>
            </div>
            <h2 style="font-family: 'Cinzel', serif; font-size: 2.3rem; margin: 0 0 1rem 0; color: var(--obsidian, #0f0f11); letter-spacing: -0.5px;">
                {{ $pageContents['home']['reels']['title'] ?? 'Experience Stone In Motion' }}
            </h2>
            <p style="color: var(--text-muted, #64748b); font-size: 1.05rem; line-height: 1.6; margin: 0;">
                {{ $pageContents['home']['reels']['subtitle'] ?? 'Follow our live stockyard unboxings, curated quarry tours, and bespoke architectural installations in action.' }}
            </p>
        </div>

        <div class="stonehub-reels-carousel reveal-on-scroll" data-reels-carousel data-autoplay="4500">
            <button type="button" class="stonehub-cat-nav stonehub-cat-prev" aria-label="Previous Reels">
                <i data-lucide="chevron-left" style="width: 22px; height: 22px;"></i>
            </button>

            <div class="stonehub-reels-viewport">
                <div class="stonehub-reels-track">
                    @php
                        $defaultReels = [
                            1 => [
                                'title' => 'Patagonia Quartzite Translucent Slabs Unboxing',
                                'handle' => '@stonehubindia',
                                'views' => '42.8K views',
                                'link' => 'https://www.instagram.com/reel/C7xYZa12345/',
                                'thumb' => 'uploads/collection/exotic_quartzite_patagonia_island.jpg'
                            ],
                            2 => [
                                'title' => 'Italian Statuario Extra Block Slicing in Carrara',
                                'handle' => '@stonehubindia',
                                'views' => '28.3K views',
                                'link' => 'https://www.instagram.com/reel/C8aBCd98765/',
                                'thumb' => 'uploads/collection/italian_marble_statuario_salon.jpg'
                            ],
                            3 => [
                                'title' => 'Translucent Onyx Master Backlit Glow Showcase',
                                'handle' => '@stonehubindia',
                                'views' => '56.1K views',
                                'link' => 'https://www.instagram.com/reel/C9cDEf54321/',
                                'thumb' => 'uploads/collection/translucent_onyx_backlit_lounge.jpg'
                            ],
                            4 => [
                                'title' => 'Roman Classic Travertine Villa Terrace Reveal',
                                'handle' => '@stonehubindia',
                                'views' => '19.4K views',
                                'link' => 'https://www.instagram.com/reel/C0eFGh11223/',
                                'thumb' => 'uploads/collection/classic_travertine_villa_terrace.jpg'
                            ],
                            5 => [
                                'title' => 'Bellezza Signature Bookmatch Wall Installation',
                                'handle' => '@stonehubindia',
                                'views' => '33.7K views',
                                'link' => 'https://www.instagram.com/reel/C1gHIj44556/',
                                'thumb' => 'uploads/collection/bellezza_luxury_lounge.jpg'
                            ],
                            6 => [
                                'title' => 'Migliore Grand Villa Entryway Surface Tour',
                                'handle' => '@stonehubindia',
                                'views' => '25.9K views',
                                'link' => 'https://www.instagram.com/reel/C2iJKl77889/',
                                'thumb' => 'uploads/collection/migliore_grand_dining_hall.jpg'
                            ],
                        ];
                    @endphp

                    @for($i = 1; $i <= 6; $i++)
                        @php
                            $rTitle = $pageContents['home']['reel'.$i]['title'] ?? $defaultReels[$i]['title'];
                            $rHandle = $pageContents['home']['reel'.$i]['handle'] ?? $defaultReels[$i]['handle'];
                            $rViews = $pageContents['home']['reel'.$i]['views'] ?? $defaultReels[$i]['views'];
                            $rLink = $pageContents['home']['reel'.$i]['link'] ?? $defaultReels[$i]['link'];
                            $rCustomThumb = trim((string) ($pageContents['home']['reel'.$i]['thumb'] ?? ''));
                            $rEmbedUrl = instagram_reel_embed_url($rLink);
                            $rFallbackImg = site_image($defaultReels[$i]['thumb']);

                            // Auto thumbnail: 1) Admin custom cover -> 2) Auto Instagram Reel CDN thumbnail -> 3) Curated fallback slab
                            if (!empty($rCustomThumb)) {
                                $rImgUrl = site_image($rCustomThumb);
                            } else {
                                $rImgUrl = instagram_reel_thumbnail_url($rLink, $defaultReels[$i]['thumb']);
                            }
                        @endphp
                        <div class="stonehub-reel-card" onclick="openHomeReelModal('{{ $rEmbedUrl }}', '{{ addslashes($rTitle) }}', '{{ $rLink }}', '{{ $rHandle }}')">
                            <img class="stonehub-reel-poster" src="{{ $rImgUrl }}" alt="{{ $rTitle }}" loading="lazy" referrerpolicy="no-referrer" onerror="if (this.src !== '{{ $rFallbackImg }}') this.src='{{ $rFallbackImg }}';">
                            <div class="stonehub-reel-gradient"></div>

                            <div class="stonehub-reel-top">
                                <span class="stonehub-reel-handle-pill">
                                    <svg viewBox="0 0 24 24" width="13" height="13" fill="currentColor">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    {{ $rHandle }}
                                </span>
                                @if(!empty($rViews))
                                    <span class="stonehub-reel-views-pill">
                                        <i data-lucide="eye" style="width:12px; height:12px;"></i>
                                        {{ $rViews }}
                                    </span>
                                @endif
                            </div>

                            <div class="stonehub-reel-play-btn" aria-label="Play Reel">
                                <i data-lucide="play" style="width: 24px; height: 24px; fill: currentColor; margin-left: 3px;"></i>
                            </div>

                            <div class="stonehub-reel-bottom">
                                <h3 class="stonehub-reel-title">{{ $rTitle }}</h3>
                                <span class="stonehub-reel-action">
                                    Watch Reel <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                                </span>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <button type="button" class="stonehub-cat-nav stonehub-cat-next" aria-label="Next Reels">
                <i data-lucide="chevron-right" style="width: 22px; height: 22px;"></i>
            </button>
        </div>

        <div class="stonehub-reels-footer reveal-on-scroll">
            <a href="{{ $site['social_instagram'] ?? $pageContents['home']['reels']['profile_url'] ?? 'https://www.instagram.com/stonehubindia/' }}" target="_blank" rel="noopener" class="stonehub-reels-follow-btn">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                Follow {{ $pageContents['home']['reels']['handle'] ?? '@stonehubindia' }} on Instagram
            </a>
        </div>
    </section>

    <!-- About Curators Section -->
    <section class="stonehub-about">
        <div class="stonehub-about-grid">
            <div class="stonehub-about-image-wrapper reveal-on-scroll">
                @if(!empty($pageContents['home']['about_doctor']['image']))
                    <img src="{{ site_image($pageContents['home']['about_doctor']['image']) }}" alt="Showroom experience center">
                @else
                    <div style="background: linear-gradient(135deg, #1f1f24 0%, #0f0f11 100%); width:100%; height:100%;"></div>
                @endif
                <div class="stonehub-about-experience-badge">
                    <span class="num">15+</span>
                    <span class="txt">Years Curation</span>
                </div>
            </div>
            
            <div class="reveal-on-scroll">
                <span class="stonehub-about-subtitle">CREATING ART FROM NATURE</span>
                <h2 class="stonehub-about-title">{{ $pageContents['home']['about_doctor']['title'] ?? 'Crafting Architectural Masterpieces Since 2012' }}</h2>
                <p class="stonehub-about-text">
                    {{ $pageContents['home']['about_doctor']['intro_text'] ?? 'Stone Hub India is a premier curator and importer of luxury natural stones. Sourcing directly from exclusive quarries in Carrara (Italy), Drama (Greece), and Espirito Santo (Brazil), we provide architectural surfaces that redefine luxury residential and commercial design.' }}
                </p>
                <div class="stonehub-about-quote">
                    "{{ $pageContents['home']['about_doctor']['philosophy'] ?? 'Providing architects, interior designers, and luxury homeowners with the finest quality natural stone slabs, hand-selected block by block.' }}"
                </div>
                
                <!-- Stats Strip -->
                <div class="stonehub-stats-row">
                    <div class="stonehub-stat-item">
                        <h4>{{ $pageContents['home']['about_doctor']['stat1_value'] ?? '40+' }}</h4>
                        <p>{{ $pageContents['home']['about_doctor']['stat1_label'] ?? 'Global Quarries' }}</p>
                    </div>
                    <div class="stonehub-stat-item">
                        <h4>{{ $pageContents['home']['about_doctor']['stat2_value'] ?? '10k+' }}</h4>
                        <p>{{ $pageContents['home']['about_doctor']['stat2_label'] ?? 'Slabs in Stock' }}</p>
                    </div>
                    <div class="stonehub-stat-item">
                        <h4>{{ $pageContents['home']['about_doctor']['stat3_value'] ?? '1,200+' }}</h4>
                        <p>{{ $pageContents['home']['about_doctor']['stat3_label'] ?? 'Bespoke Projects' }}</p>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="stonehub-hero-btn primary" style="margin-top: 1.75rem; display: inline-flex;">
                    About Our Curators
                    <i data-lucide="arrow-right" style="width:16px;height:16px;"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Slabs Featured Collection -->
    <section class="stonehub-slabs-section">
        <div class="stonehub-section-bg" aria-hidden="true">
            <img src="{{ site_image($pageContents['home']['slabs']['bg_image'] ?? 'uploads/pages/about-slabs.webp') }}" alt="" loading="lazy">
        </div>
        <div class="stonehub-section-bg-overlay" aria-hidden="true"></div>

        <div class="stonehub-section-header dark reveal-on-scroll">
            <h2>Signature Slabs Showcase</h2>
            <p>Walk through our standing gallery of highly exclusive bookmatched marble and translucent quartzite slabs.</p>
        </div>

        <div class="stonehub-slabs-carousel reveal-on-scroll" data-slabs-carousel data-autoplay="4000">
            <button type="button" class="stonehub-cat-nav stonehub-cat-prev" aria-label="Previous slabs">
                <i data-lucide="chevron-left" style="width: 22px; height: 22px;"></i>
            </button>

            <div class="stonehub-categories-viewport">
                <div class="stonehub-slabs-track">
                    @php
                        $homeMarbles = collect($globalMarbles ?? [])->take(8);
                    @endphp
                    @if($homeMarbles->count() > 0)
                        @foreach($homeMarbles as $gm)
                            <div class="stonehub-slab-card">
                                <div class="stonehub-slab-image">
                                    @if($gm->image)
                                        <img src="{{ site_image($gm->image) }}" alt="{{ $gm->name }}">
                                    @else
                                        <div style="background: linear-gradient(135deg, #1f1f24 0%, #0f0f11 100%); width:100%; height:100%;"></div>
                                    @endif
                                    <div class="stonehub-slab-overlay" aria-hidden="true"></div>
                                </div>
                                <div class="stonehub-slab-details">
                                    <h3>{{ $gm->name }}</h3>
                                    <p>{{ Str::limit(strip_tags($gm->description ?? ''), 110) }}</p>
                                    <a href="{{ route('products.show', $gm->slug) }}" class="stonehub-slab-cta">
                                        View More
                                        <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @php
                            $slabFallbacks = [
                                ['name' => 'Statuario White Marble', 'desc' => 'Pure white background with thick elegant grey veins from Carrara, Italy.', 'img' => 'uploads/treatments/statuario.jpg', 'slug' => 'statuario-white-marble'],
                                ['name' => 'Patagonia Quartzite', 'desc' => 'Crystalline quartz shards and metallic veins from Brazil, backlit ready.', 'img' => 'uploads/treatments/patagonia.jpg', 'slug' => 'patagonia-exotic-quartzite'],
                                ['name' => 'Blue Roma Quartzite', 'desc' => 'Exotic blue-grey quartzite crossed by intense coppery-gold vein nets.', 'img' => 'uploads/treatments/blue-roma.jpg', 'slug' => 'blue-roma-quartzite'],
                                ['name' => 'Pink Onyx Premium', 'desc' => 'Artistic pink onyx with translucent cloud-like rose structures.', 'img' => 'uploads/treatments/pink-onyx.jpg', 'slug' => 'pink-onyx-premium'],
                            ];
                        @endphp
                        @foreach($slabFallbacks as $sf)
                            <div class="stonehub-slab-card">
                                <div class="stonehub-slab-image">
                                    <img src="{{ site_image($sf['img']) }}" alt="{{ $sf['name'] }}">
                                    <div class="stonehub-slab-overlay" aria-hidden="true"></div>
                                </div>
                                <div class="stonehub-slab-details">
                                    <h3>{{ $sf['name'] }}</h3>
                                    <p>{{ $sf['desc'] }}</p>
                                    <a href="{{ route('products.show', $sf['slug']) }}" class="stonehub-slab-cta">
                                        View More
                                        <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <button type="button" class="stonehub-cat-nav stonehub-cat-next" aria-label="Next slabs">
                <i data-lucide="chevron-right" style="width: 22px; height: 22px;"></i>
            </button>
        </div>
    </section>

    <!-- Why Choose Us Section (Curation Standard) -->
    <section class="stonehub-why">
        <div class="stonehub-section-bg" aria-hidden="true">
            <img src="{{ site_image($pageContents['home']['why_choose_us']['bg_image'] ?? 'uploads/pages/about-yard.webp') }}" alt="" loading="lazy">
        </div>
        <div class="stonehub-section-bg-overlay" aria-hidden="true"></div>

        <div class="stonehub-section-header dark reveal-on-scroll">
            <h2>{{ $pageContents['home']['why_choose_us']['title'] ?? 'The Curation Standard' }}</h2>
            <p>{{ $pageContents['home']['why_choose_us']['subtitle'] ?? 'Uncompromising checks and balances that make us India\'s first choice for luxury stone.' }}</p>
        </div>
        
        <div class="stonehub-why-grid">
            @php
                $reasons = [
                    ['title' => $pageContents['home']['why_choose']['r1_title'] ?? 'Direct Quarry Sourcing', 'desc' => $pageContents['home']['why_choose']['r1_desc'] ?? 'We visit quarries globally to handpick only the top 5% of marble blocks.', 'icon' => 'gem'],
                    ['title' => $pageContents['home']['why_choose']['r2_title'] ?? 'Bookmatched Precision', 'desc' => $pageContents['home']['why_choose']['r2_desc'] ?? 'Perfect mirror-image matching for dramatic feature walls.', 'icon' => 'combine'],
                    ['title' => $pageContents['home']['why_choose']['r3_title'] ?? 'Italian Reinforcing Mesh', 'desc' => $pageContents['home']['why_choose']['r3_desc'] ?? 'Italian-grade epoxy and structural mesh backing for high-impact durability.', 'icon' => 'layers-3'],
                    ['title' => $pageContents['home']['why_choose']['r4_title'] ?? 'Bespoke Custom Cutting', 'desc' => $pageContents['home']['why_choose']['r4_desc'] ?? 'Precise waterjet and bridge saw cutting to your exact specifications.', 'icon' => 'scissors'],
                    ['title' => $pageContents['home']['why_choose']['r5_title'] ?? 'Translucency Mapping', 'desc' => $pageContents['home']['why_choose']['r5_desc'] ?? 'Light-transmission testing for high-end backlit applications.', 'icon' => 'sun'],
                    ['title' => $pageContents['home']['why_choose']['r6_title'] ?? 'Showroom Slab Gallery', 'desc' => $pageContents['home']['why_choose']['r6_desc'] ?? 'Walk through full-size standing slabs to experience the final scale.', 'icon' => 'columns-4'],
                ];
            @endphp
            @foreach($reasons as $reason)
                <div class="stonehub-why-card reveal-on-scroll">
                    <div class="stonehub-why-icon">
                        <i data-lucide="{{ $reason['icon'] }}"></i>
                    </div>
                    <h3>{{ $reason['title'] }}</h3>
                    <p>{{ $reason['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Interactive Process Timeline Section -->
    <section class="stonehub-process">
        <div class="stonehub-section-header reveal-on-scroll">
            <h2>The Slab Journey</h2>
            <p>From deep geological deposits to bespoke surface installations in your home.</p>
        </div>
        
        <div class="stonehub-process-timeline reveal-on-scroll">
            <div class="stonehub-process-timeline-progress"></div>
            <div class="stonehub-process-grid">
                <div class="stonehub-process-step">
                    <div class="stonehub-process-circle">1</div>
                    <h3>Quarry Sourcing</h3>
                    <p>Blocks inspected and verified block by block at local quarries in Italy and Brazil.</p>
                </div>
                <div class="stonehub-process-step">
                    <div class="stonehub-process-circle">2</div>
                    <h3>Gangsaw Processing</h3>
                    <p>Precision slab cutting using top-tier diamond segment gang saws.</p>
                </div>
                <div class="stonehub-process-step">
                    <div class="stonehub-process-circle">3</div>
                    <h3>Resin & Polishing</h3>
                    <p>Epoxy reinforcement followed by high-gloss diamond wheel polishing.</p>
                </div>
                <div class="stonehub-process-step">
                    <div class="stonehub-process-circle">4</div>
                    <h3>Bespoke Fitting</h3>
                    <p>Slab delivery, bookmatch layout mapping, and final install execution.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Before-After Slab Matching Section -->
    <section class="stonehub-before-after reveal-on-scroll">
        <div class="stonehub-section-header">
            <h2>The Bookmatching Effect</h2>
            <p>Slide the bar horizontally to visualize the majestic bookmatching alignment of natural Statuario marble slabs.</p>
        </div>
        
        <div class="stonehub-slider-wrapper">
            <!-- Left (Before - Unmatched slab block) -->
            <div class="stonehub-slider-img stonehub-slider-before">
                <img src="{{ site_image('uploads/treatments/statuario.jpg') }}" alt="Single Slab View">
                <span class="stonehub-slider-label before">Single Slab</span>
            </div>
            
            <!-- Right (After - Bookmatched slab block) -->
            <div class="stonehub-slider-img stonehub-slider-after">
                <img src="{{ site_image('uploads/hero/slide2.jpg') }}" alt="Bookmatched Slab View" style="transform: scaleX(-1);">
                <span class="stonehub-slider-label after">Bookmatched Mural</span>
            </div>
            
            <!-- Handle -->
            <div class="stonehub-slider-handle"></div>
            <div class="stonehub-slider-button">
                <i data-lucide="arrow-left-right" style="width:18px;height:18px;"></i>
            </div>
        </div>
    </section>

    <!-- Testimonials Carousel Section -->
    <section class="stonehub-testimonials">
        <div class="stonehub-section-header reveal-on-scroll">
            <h2>{{ $pageContents['home']['testimonials']['title'] ?? 'Architect & Designer Perspectives' }}</h2>
            <p>{{ $pageContents['home']['testimonials']['subtitle'] ?? 'Collaborating with elite visionaries to create bespoke luxury estates.' }}</p>
        </div>
        
        <div class="stonehub-testimonial-track reveal-on-scroll">
            @if(isset($testimonials) && $testimonials->count() > 0)
                @foreach($testimonials as $test)
                    <div class="stonehub-testimonial-card">
                        <div>
                            <div class="stonehub-testimonial-stars">
                                @for($i = 0; $i < $test->rating; $i++)★@endfor
                            </div>
                            <div class="stonehub-testimonial-content">
                                "{{ $test->content }}"
                            </div>
                        </div>
                        <div class="stonehub-testimonial-author">
                            <div class="stonehub-testimonial-avatar">
                                @if($test->avatar_path)
                                    <img src="{{ site_image($test->avatar_path) }}" alt="{{ $test->name }}">
                                @else
                                    {{ substr($test->name, 0, 2) }}
                                @endif
                            </div>
                            <div class="stonehub-testimonial-info">
                                <h4>{{ $test->name }}</h4>
                                <p>{{ $test->role }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback testimonials -->
                @php
                    $testFallbacks = [
                        ['name' => 'Sanjay Mehta', 'role' => 'Lead Architect, Studio Vista', 'content' => 'Stone Hub India has provided some of the most exquisite bookmatched marble slabs we\'ve used in our high-end residential projects.'],
                        ['name' => 'Ananya Goel', 'role' => 'Principal Designer, Alabaster Space', 'content' => 'Their collection of exotic quartzite is unmatched. The Patagonia slab we backlit for our penthouse client became the focal point.'],
                    ];
                @endphp
                @foreach($testFallbacks as $tf)
                    <div class="stonehub-testimonial-card">
                        <div>
                            <div class="stonehub-testimonial-stars">★★★★★</div>
                            <div class="stonehub-testimonial-content">"{{ $tf['content'] }}"</div>
                        </div>
                        <div class="stonehub-testimonial-author">
                            <div class="stonehub-testimonial-avatar">{{ substr($tf['name'], 0, 2) }}</div>
                            <div class="stonehub-testimonial-info">
                                <h4>{{ $tf['name'] }}</h4>
                                <p>{{ $tf['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div style="text-align: center; margin-top: 2.5rem;" class="reveal-on-scroll">
            <a href="{{ route('testimonials') }}" class="stonehub-hero-btn secondary">View All Testimonials</a>
        </div>
    </section>

    <!-- Cinematic Video Presentations -->
    <section class="stonehub-slabs-section stonehub-videos" id="geological-videos">
        <div class="stonehub-section-bg" aria-hidden="true">
            <img src="{{ site_image($pageContents['home']['videos']['bg_image'] ?? 'uploads/pages/hero-showroom.webp') }}" alt="" loading="lazy">
        </div>
        <div class="stonehub-section-bg-overlay" aria-hidden="true"></div>

        <div class="stonehub-section-header dark reveal-on-scroll">
            <h2>{{ $pageContents['home']['videos']['title'] ?? 'Geological Art In Motion' }}</h2>
            <p>{{ $pageContents['home']['videos']['subtitle'] ?? 'Watch educational video presentations by our curators detailing sourcing standards and layout design advice.' }}</p>
        </div>
        
        <div class="stonehub-videos-wrap reveal-on-scroll">
            <div class="stonehub-videos-grid">
                @php
                    $videos = [
                        [
                            'title' => $pageContents['home']['video1']['title'] ?? 'Showroom Tour & Exotic Slab Reveal',
                            'duration' => $pageContents['home']['video1']['duration'] ?? '05:14',
                            'link' => $pageContents['home']['video1']['link'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                            'thumb' => $pageContents['home']['video1']['thumb'] ?? '',
                            'fallback' => 'uploads/about/showroom.jpg'
                        ],
                        [
                            'title' => $pageContents['home']['video2']['title'] ?? 'Statuario vs Calacatta: Sourcing Guide',
                            'duration' => $pageContents['home']['video2']['duration'] ?? '03:45',
                            'link' => $pageContents['home']['video2']['link'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                            'thumb' => $pageContents['home']['video2']['thumb'] ?? '',
                            'fallback' => 'uploads/treatments/statuario.jpg'
                        ],
                        [
                            'title' => $pageContents['home']['video3']['title'] ?? 'Installing Bookmatched Marble Walls',
                            'duration' => $pageContents['home']['video3']['duration'] ?? '08:12',
                            'link' => $pageContents['home']['video3']['link'] ?? 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                            'thumb' => $pageContents['home']['video3']['thumb'] ?? '',
                            'fallback' => 'uploads/treatments/patagonia.jpg'
                        ],
                    ];
                @endphp
                @foreach($videos as $vid)
                    @php
                        $videoLink = trim((string) ($vid['link'] ?? ''));
                        $ytId = youtube_video_id($videoLink);
                        $embedUrl = $ytId ? "https://www.youtube.com/embed/{$ytId}?autoplay=1&rel=0" : '';
                        
                        // Resolve thumbnail: 1) Admin custom upload/path -> 2) YouTube HQ Thumbnail -> 3) Local fallback slab
                        $customThumb = trim((string) ($vid['thumb'] ?? ''));
                        if (!empty($customThumb)) {
                            $thumbSrc = site_image($customThumb);
                        } elseif ($ytId) {
                            $thumbSrc = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                        } else {
                            $thumbSrc = site_image($vid['fallback']);
                        }
                    @endphp
                    <div class="stonehub-video-card" onclick="openHomeVideoModal('{{ $embedUrl }}', '{{ addslashes($vid['title']) }}', '{{ $videoLink }}')" style="cursor: pointer;">
                        <div class="stonehub-video-thumb">
                            <img src="{{ $thumbSrc }}" alt="{{ $vid['title'] }}" loading="lazy">
                            <div class="stonehub-video-overlay" aria-hidden="true"></div>
                            <div class="stonehub-video-play">
                                <i data-lucide="play" style="width:20px;height:20px;fill:currentColor;"></i>
                            </div>
                            <span class="stonehub-video-duration">{{ $vid['duration'] }}</span>
                        </div>
                        <div class="stonehub-video-body">
                            <h3>{{ $vid['title'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Design Journals (Blogs) -->
    <section class="stonehub-blogs">
        <div class="stonehub-section-header reveal-on-scroll">
            <h2>{{ $pageContents['home']['blogs']['title'] ?? 'Design Journals & Stone Guides' }}</h2>
            <p>{{ $pageContents['home']['blogs']['subtitle'] ?? 'Unveiling stone design concepts, maintenance guides, and selection blueprints.' }}</p>
        </div>
        
        <div class="stonehub-blogs-grid">
            @if(isset($blogs) && $blogs->count() > 0)
                @foreach($blogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}" class="stonehub-blog-card reveal-on-scroll">
                        <div class="stonehub-blog-image">
                            @if($blog->image_path)
                                <img src="{{ site_image($blog->image_path) }}" alt="{{ $blog->title }}">
                            @else
                                <div style="background: linear-gradient(135deg, #1f1f24 0%, #0f0f11 100%); width:100%; height:100%;"></div>
                            @endif
                        </div>
                        <div class="stonehub-blog-content">
                            <div>
                                <span class="stonehub-blog-tag">{{ $blog->category }}</span>
                                <h3 class="stonehub-blog-title">{{ $blog->title }}</h3>
                                <p class="stonehub-blog-summary">{{ $blog->summary }}</p>
                            </div>
                            <span class="stonehub-blog-link">
                                Read Journal
                                <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            @else
                <!-- Fallback blogs -->
                @php
                    $blogFallbacks = [
                        ['title' => 'Natural Stone Selection Blueprint', 'cat' => 'Design Guide', 'summary' => 'How architects and homeowners choose between marble, quartzite, and granite.', 'img' => 'uploads/blogs/guide1.jpg'],
                        ['title' => 'The Art of Backlighting Onyx Slabs', 'cat' => 'Technical Guide', 'summary' => 'Step-by-step setup for dramatic backlit walls and structural features.', 'img' => 'uploads/blogs/guide2.jpg'],
                        ['title' => 'Maintaining Italian White Marble', 'cat' => 'Maintenance', 'summary' => 'Best practices to preserve the pristine polished surface of luxury white marble.', 'img' => 'uploads/blogs/guide3.jpg'],
                    ];
                @endphp
                @foreach($blogFallbacks as $bf)
                    <a href="{{ route('blog') }}" class="stonehub-blog-card reveal-on-scroll">
                        <div class="stonehub-blog-image">
                            <img src="{{ site_image($bf['img']) }}" alt="{{ $bf['title'] }}">
                        </div>
                        <div class="stonehub-blog-content">
                            <div>
                                <span class="stonehub-blog-tag">{{ $bf['cat'] }}</span>
                                <h3 class="stonehub-blog-title">{{ $bf['title'] }}</h3>
                                <p class="stonehub-blog-summary">{{ $bf['summary'] }}</p>
                            </div>
                            <span class="stonehub-blog-link">
                                Read Journal
                                <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
        
        <div style="text-align: center; margin-top: 4rem;" class="reveal-on-scroll">
            <a href="{{ route('blog') }}" class="stonehub-hero-btn secondary" style="color: var(--obsidian); border-color: var(--obsidian);">
                {{ $pageContents['home']['blogs']['cta_label'] ?? 'Read All Journals' }}
            </a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="stonehub-faq">
        <div class="stonehub-section-header reveal-on-scroll">
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about sourcing, shipping, cutting, and installing luxury slabs.</p>
        </div>
        
        <div class="stonehub-faq-wrapper reveal-on-scroll">
            <div class="stonehub-faq-item">
                <button class="stonehub-faq-header">
                    <span>How can I see full-size standing slabs?</span>
                    <i data-lucide="plus" class="stonehub-faq-icon"></i>
                </button>
                <div class="stonehub-faq-body">
                    <div class="stonehub-faq-content">
                        You can visit our experience centers and stockyards in Kishangarh, Rajasthan. We display full-sized standing slabs so you can visualize the entire vein map and crystallization before purchasing.
                    </div>
                </div>
            </div>
            <div class="stonehub-faq-item">
                <button class="stonehub-faq-header">
                    <span>What is bookmatching?</span>
                    <i data-lucide="plus" class="stonehub-faq-icon"></i>
                </button>
                <div class="stonehub-faq-body">
                    <div class="stonehub-faq-content">
                        Bookmatching is the practice of matching two or more stone slabs so that their adjacent surfaces mirror each other, creating a dramatic, symmetrical abstract pattern resembling an open book.
                    </div>
                </div>
            </div>
            <div class="stonehub-faq-item">
                <button class="stonehub-faq-header">
                    <span>Do you offer custom bridge-saw cutting?</span>
                    <i data-lucide="plus" class="stonehub-faq-icon"></i>
                </button>
                <div class="stonehub-faq-body">
                    <div class="stonehub-faq-content">
                        Yes, we have state-of-the-art waterjet cutting and bridge saws. Architects can submit exact technical layouts, and we will perform custom cuts and edge profiles to secure a perfect fit on site.
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 2.5rem;" class="reveal-on-scroll">
            <a href="{{ route('faq') }}" class="stonehub-hero-btn secondary" style="color: var(--obsidian); border-color: var(--obsidian);">View All FAQs</a>
        </div>
    </section>

    <!-- Call To Action (Form) -->
    <section class="stonehub-cta">
        <div class="stonehub-cta-media" aria-hidden="true">
            <img src="{{ asset($pageContents['home']['cta']['bg_image'] ?? 'assets/images/pages/about-lobby.webp') }}" alt="" loading="lazy">
        </div>
        <div class="stonehub-cta-overlay" aria-hidden="true"></div>
        <div class="stonehub-cta-container reveal-on-scroll">
            <h2>{{ $pageContents['home']['cta']['title'] ?? 'Curate Your Space' }}</h2>
            <p>{{ $pageContents['home']['cta']['subtitle'] ?? 'Connect with our stone specialists to receive bespoke slab recommendations, bookmatch layouts, and customized price estimates for your project.' }}</p>
            
            <form action="{{ route('contact.submit') }}" method="POST" class="stonehub-cta-form">
                @csrf
                <input type="text" name="name" placeholder="Your Full Name" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="hidden" name="source" value="Homepage Curation Form">
                <button type="submit">{{ $pageContents['home']['cta']['btn_label'] ?? 'Request Catalogue' }}</button>
            </form>
        </div>
    </section>

    <!-- Video Player Lightbox Modal -->
    <div id="stonehub-video-modal" class="stonehub-video-modal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(10,10,12,0.92); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:1.5rem; opacity:0; transition:opacity 0.3s ease;">
        <div class="stonehub-video-modal-dialog" style="position:relative; width:100%; max-width:960px; background:#121216; border:1px solid rgba(197,168,128,0.3); border-radius:12px; overflow:hidden; box-shadow:0 25px 50px -12px rgba(0,0,0,0.8); transform:scale(0.95); transition:transform 0.3s ease;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:1rem 1.5rem; border-bottom:1px solid rgba(255,255,255,0.08); background:#18181f;">
                <h3 id="video-modal-title" style="margin:0; font-size:1.1rem; color:#fff; font-weight:600; font-family:'Cinzel', serif; letter-spacing:0.5px;">Video Presentation</h3>
                <button type="button" onclick="closeHomeVideoModal()" style="background:none; border:none; color:#a1a1aa; font-size:1.8rem; cursor:pointer; line-height:1; padding:0; display:flex; align-items:center;" aria-label="Close Video">&times;</button>
            </div>
            <div style="position:relative; width:100%; padding-bottom:56.25%; background:#000;">
                <iframe id="video-modal-iframe" src="" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem 1.5rem; background:#18181f; border-top:1px solid rgba(255,255,255,0.08);">
                <span style="font-size:0.8rem; color:#a1a1aa;">Stone Hub India &bull; Curators of Fine Natural Stone</span>
                <a id="video-modal-direct-link" href="#" target="_blank" rel="noopener" style="font-size:0.82rem; color:var(--gold, #c5a880); text-decoration:none; display:flex; align-items:center; gap:4px;">
                    Watch on YouTube &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Instagram Reel Player Lightbox Modal -->
    <div id="stonehub-reel-modal" class="stonehub-reel-modal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(10,10,12,0.92); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:1rem; opacity:0; transition:opacity 0.3s ease;">
        <div class="stonehub-reel-modal-dialog" style="position:relative; width:100%; max-width:440px; background:#121216; border:1px solid rgba(197,168,128,0.3); border-radius:16px; overflow:hidden; box-shadow:0 25px 60px -12px rgba(0,0,0,0.9); transform:scale(0.95); transition:transform 0.3s ease; display:flex; flex-direction:column;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:0.9rem 1.25rem; border-bottom:1px solid rgba(255,255,255,0.08); background:#18181f;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <span style="display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:50%; background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color:#fff;">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </span>
                    <h3 id="reel-modal-title" style="margin:0; font-size:0.95rem; color:#fff; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:260px;">Instagram Reel</h3>
                </div>
                <button type="button" onclick="closeHomeReelModal()" style="background:none; border:none; color:#a1a1aa; font-size:1.8rem; cursor:pointer; line-height:1; padding:0; display:flex; align-items:center;" aria-label="Close Reel">&times;</button>
            </div>
            
            <div style="position:relative; width:100%; height:600px; max-height:72vh; background:#000;">
                <iframe id="reel-modal-iframe" src="" style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;" allowtransparency="true" allowfullscreen="true" frameborder="0" scrolling="no"></iframe>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center; padding:0.75rem 1.25rem; background:#18181f; border-top:1px solid rgba(255,255,255,0.08);">
                <span id="reel-modal-handle" style="font-size:0.8rem; color:#a1a1aa; font-weight:500;">@stonehubindia</span>
                <a id="reel-modal-direct-link" href="#" target="_blank" rel="noopener" style="font-size:0.82rem; color:var(--gold, #c5a880); text-decoration:none; display:flex; align-items:center; gap:4px; font-weight:600;">
                    Watch on Instagram &rarr;
                </a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Inject Custom Javascript for Homepage Redesign -->
    <script src="{{ asset('assets/js/homepage-redesign.js') }}"></script>
    <script>
        function openHomeVideoModal(embedUrl, title, directUrl) {
            const modal = document.getElementById('stonehub-video-modal');
            const iframe = document.getElementById('video-modal-iframe');
            const titleEl = document.getElementById('video-modal-title');
            const directLink = document.getElementById('video-modal-direct-link');
            
            if (embedUrl) {
                iframe.src = embedUrl;
                if (titleEl) titleEl.innerText = title || 'Video Presentation';
                if (directLink) directLink.href = directUrl || '#';
                modal.style.display = 'flex';
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.querySelector('.stonehub-video-modal-dialog').style.transform = 'scale(1)';
                }, 10);
                document.body.style.overflow = 'hidden';
            } else if (directUrl) {
                window.open(directUrl, '_blank');
            }
        }

        function closeHomeVideoModal() {
            const modal = document.getElementById('stonehub-video-modal');
            const iframe = document.getElementById('video-modal-iframe');
            if (!modal) return;
            modal.style.opacity = '0';
            const dialog = modal.querySelector('.stonehub-video-modal-dialog');
            if (dialog) dialog.style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.style.display = 'none';
                if (iframe) iframe.src = '';
                document.body.style.overflow = '';
            }, 300);
        }

        function openHomeReelModal(embedUrl, title, directUrl, handle) {
            const modal = document.getElementById('stonehub-reel-modal');
            const iframe = document.getElementById('reel-modal-iframe');
            const titleEl = document.getElementById('reel-modal-title');
            const directLink = document.getElementById('reel-modal-direct-link');
            const handleEl = document.getElementById('reel-modal-handle');
            
            if (embedUrl) {
                iframe.src = embedUrl;
                if (titleEl) titleEl.innerText = title || 'Instagram Reel';
                if (directLink) directLink.href = directUrl || '#';
                if (handleEl) handleEl.innerText = handle || '@stonehubindia';
                modal.style.display = 'flex';
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modal.querySelector('.stonehub-reel-modal-dialog').style.transform = 'scale(1)';
                }, 10);
                document.body.style.overflow = 'hidden';
            } else if (directUrl) {
                window.open(directUrl, '_blank');
            }
        }

        function closeHomeReelModal() {
            const modal = document.getElementById('stonehub-reel-modal');
            const iframe = document.getElementById('reel-modal-iframe');
            if (!modal) return;
            modal.style.opacity = '0';
            const dialog = modal.querySelector('.stonehub-reel-modal-dialog');
            if (dialog) dialog.style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.style.display = 'none';
                if (iframe) iframe.src = '';
                document.body.style.overflow = '';
            }, 300);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const vModal = document.getElementById('stonehub-video-modal');
                if (vModal && vModal.style.display === 'flex') {
                    closeHomeVideoModal();
                }
                const rModal = document.getElementById('stonehub-reel-modal');
                if (rModal && rModal.style.display === 'flex') {
                    closeHomeReelModal();
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const vModal = document.getElementById('stonehub-video-modal');
            if (vModal) {
                vModal.addEventListener('click', function(e) {
                    if (e.target === vModal) closeHomeVideoModal();
                });
            }
            const rModal = document.getElementById('stonehub-reel-modal');
            if (rModal) {
                rModal.addEventListener('click', function(e) {
                    if (e.target === rModal) closeHomeReelModal();
                });
            }
        });
    </script>
@endsection
