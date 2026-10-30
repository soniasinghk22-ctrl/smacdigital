@extends('layouts.app')

@section('title', ($aboutPage->metatitle ?? 'Leading Imported Marble Supplier | Stone Hub India'))
@section('meta_description', ($aboutPage->metadescription ?? 'Learn about Stone Hub India, an ISO:2015 certified imported marble supplier based in Kishangarh, Rajasthan. Discover our mission, values, and premium collections.'))
@section('meta_keywords', ($aboutPage->metakeywords ?? 'about stone hub, imported marble kishangarh, italian marble supplier, best marble kishangarh'))

@section('styles')
    <!-- Inject Custom Stylesheet for Premium Themes -->
    <link rel="stylesheet" href="{{ asset('assets/css/homepage-redesign.css') }}">
    <script>
        // Inject page marker classes into body dynamically
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('stonehub-body', 'homepage-active');
        });
    </script>
    <style>
        /* Specific Styles for About Page Layout */
        .about-hero {
            /* uses shared .page-hero */
        }
        .about-hero h1 {
            font-family: var(--primary-font, 'Outfit', sans-serif);
        }
        .about-hero p {
            color: rgba(255, 255, 255, 0.88);
            font-size: 1.15rem;
            max-width: 650px;
            margin: 0 auto;
        }
        .about-section {
            padding: 8rem 0;
            background: var(--white);
        }
        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 4%;
        }
        .split-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            margin-bottom: 8rem;
        }
        .split-grid.reverse {
            grid-template-columns: 1.1fr 0.9fr;
        }
        .about-visual-box {
            position: relative;
            border-radius: var(--radius-premium);
            overflow: hidden;
            height: 480px;
            box-shadow: var(--shadow-premium);
        }
        .about-visual-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .narrative-title {
            font-family: var(--primary-font);
            font-size: 2.2rem;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--obsidian);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        .narrative-text {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #4a4a52;
            margin-bottom: 1.5rem;
        }
        .bullet-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }
        .bullet-list li {
            position: relative;
            padding-left: 2rem;
            font-size: 1.05rem;
            line-height: 1.6;
            margin-bottom: 1.25rem;
            color: #4a4a52;
        }
        .bullet-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--bronze-gold);
            font-weight: bold;
            font-size: 1.1rem;
        }
        .values-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            margin-bottom: 8rem;
        }
        .value-card {
            background: var(--alabaster);
            border: 1px solid rgba(228, 228, 231, 0.5);
            border-radius: var(--radius-premium);
            padding: 2rem;
            transition: transform 0.3s ease;
        }
        .value-card:hover {
            transform: translateY(-5px);
        }
        .value-num {
            font-family: var(--primary-font);
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--bronze-gold);
            margin-bottom: 1rem;
        }
        .value-card h3 {
            font-family: var(--primary-font);
            font-weight: 700;
            font-size: 1.2rem;
            text-transform: uppercase;
            color: var(--obsidian);
            margin-bottom: 0.75rem;
        }
        .value-card p {
            font-size: 0.9rem;
            color: #71717a;
            line-height: 1.5;
            margin: 0;
        }
        @media (max-width: 991px) {
            .split-grid, .split-grid.reverse {
                grid-template-columns: 1fr;
                gap: 3rem;
                margin-bottom: 6rem;
            }
            .about-visual-box {
                height: 380px;
            }
            .values-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 600px) {
            .values-grid {
                grid-template-columns: 1fr;
            }
            .about-hero h1 {
                font-size: 2.5rem;
            }
        }
    </style>
@endsection

@section('content')
    @if(!empty($aboutPage) && !empty($aboutPage->description) && trim(strip_tags($aboutPage->description)) !== '')
        <section class="section" style="padding: 6rem 0; background: var(--obsidian); color: var(--text-light-muted);">
            <div class="container animate-on-scroll" style="max-width: 900px; margin: 0 auto;">
                <div class="blog-content" style="line-height: 1.8; font-size: 1.05rem; color: #d1d5db;">
                    {!! $aboutPage->description !!}
                </div>
            </div>
        </section>
    @else

    <!-- Premium Hero Section -->
    <section class="page-hero about-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-about.webp') }}" alt="Premium Italian marble slabs at Stone Hub India" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">
                <i data-lucide="info" style="width: 14px; height: 14px;"></i>
                OUR STORY & LEGACY
            </span>
            <h1>ABOUT STONE HUB INDIA</h1>
            <p>ISO:2015 Certified Importers of the World's Finest Natural Stones</p>
        </div>
    </section>

    <!-- Company Story Section -->
    <section class="about-section">
        <div class="about-container">
            <div class="split-grid reveal-on-scroll">
                <div>
                    <span class="stonehub-about-subtitle">Pioneers of Curation</span>
                    <h2 class="narrative-title">WHO WE ARE</h2>
                    <p class="narrative-text">
                        One of the leading manufacturers and suppliers of Imported Marble throughout India, Stone Hub India is engaged in importing the finest quality blocks from all corners of the globe. We are proud to be the fastest-growing company in Kishangarh. Our core aim is to provide our end customers with natural artistic beauty—a unique, timeless gift of geological creation.
                    </p>
                    <p class="narrative-text">
                        We provide one of the largest collections of the world’s finest stones. Our collection comprises of more than 300 varieties of marble from the best quarries of Italy, Spain, Greece & Turkey. We are currently processing over 30 premium colors of marble.
                    </p>
                </div>
                <div class="about-visual-box">
                    <img src="{{ asset('assets/images/pages/hero-showroom.webp') }}" alt="Stone Hub India Showroom Gallery" loading="lazy">
                </div>
            </div>

            <!-- Core Values -->
            <div class="reveal-on-scroll">
                <div class="stonehub-section-header" style="margin-bottom: 3.5rem;">
                    <h2>OUR CORE VALUES</h2>
                    <p>The philosophical foundations driving our daily curation, operations, and partnerships.</p>
                </div>
                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-num">01</div>
                        <h3>Passion & Drive</h3>
                        <p>Working with passion and determination to win and achieve our architectural goals.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-num">02</div>
                        <h3>Global Unity</h3>
                        <p>Collaborating, creating, and contributing globally to bring high-end stone options to India.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-num">03</div>
                        <h3>Long-Term Trust</h3>
                        <p>Building long-lasting relationships with our valued customers, employees, and community.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-num">04</div>
                        <h3>Premium Pricing</h3>
                        <p>Providing our customers with the best quality products at the most competitive price margins.</p>
                    </div>
                </div>
            </div>

            <!-- Kishangarh Market & Slabs processing -->
            <div class="split-grid reverse reveal-on-scroll">
                <div class="about-visual-box">
                    <img src="{{ asset('assets/images/pages/about-slabs.webp') }}" alt="Premium bookmatched marble slabs" loading="lazy">
                </div>
                <div>
                    <span class="stonehub-about-subtitle">Asia's Marble Capital</span>
                    <h2 class="narrative-title">ABOUT KISHANGARH</h2>
                    <p class="narrative-text">
                        Kishangarh is Asia’s largest marble market. Everything you have in your mind about marble selection will change when you visit the endless stock arrays at Stone Hub India. 
                    </p>
                    <p class="narrative-text">
                        Our Marble has got the highest value of design, texture, finish & gloss which adds to great architectural structures like luxury hotels, commercial offices, fashion showrooms, grand farmhouses, and bespoke residential villa projects.
                    </p>
                </div>
            </div>

            <!-- Team & Services -->
            <div class="split-grid reveal-on-scroll">
                <div>
                    <span class="stonehub-about-subtitle">Expert Craftsmanship</span>
                    <h2 class="narrative-title">SERVICES & PRODUCTS</h2>
                    <p class="narrative-text">
                        As a top-quality imported marble supplier in Kishangarh, our units are equipped with cutting-edge modern technology. We work on a wide variety of finishes including natural cleft, sawn-cut, fine hand-cut, calibrated, non-calibrated, sandblasted, honed, and high-gloss mirror polished stone mosaics.
                    </p>
                    <p class="narrative-text">
                        We also offer specialty elements like cobbles, pavers, edge curbs, sandstone compositions, and custom layouts for gardens and luxury landscaping design.
                    </p>
                </div>
                <div class="about-visual-box">
                    <img src="{{ asset('assets/images/pages/about-lobby.webp') }}" alt="Luxury lobby marble application" loading="lazy">
                </div>
            </div>

            <div class="split-grid reverse reveal-on-scroll">
                <div class="about-visual-box">
                    <img src="{{ asset('assets/images/pages/about-yard.webp') }}" alt="Stone Hub India stockyard" loading="lazy">
                </div>
                <div>
                    <span class="stonehub-about-subtitle">Our Team</span>
                    <h2 class="narrative-title">THE STONE HUB TEAM</h2>
                    <p class="narrative-text">
                        We are supported by a team of highly qualified, hard-working professionals. Our team is focused on the constant development and improvement of our range, recruiting technical experts, machine operators, quality analysts, packaging personnel, and sales executives.
                    </p>
                </div>
            </div>

            <!-- Our Aims & Mission -->
            <div class="reveal-on-scroll" style="background: var(--alabaster); border-radius: var(--radius-premium); padding: 4rem; border: 1px solid rgba(228, 228, 231, 0.6); margin-bottom: 4rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;">
                    <div>
                        <h3 class="narrative-title" style="font-size: 1.8rem;">OUR AIM</h3>
                        <ul class="bullet-list" style="margin: 0;">
                            <li>Provide high quality & affordable finest natural stones.</li>
                            <li>Create and cultivate long-term relations with clients.</li>
                            <li>Respond immediately to the changing design needs of architects.</li>
                            <li>Achieve complete customer satisfaction and improve our services continuously.</li>
                            <li>Maintain professional relationships by encouraging transparent communication.</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="narrative-title" style="font-size: 1.8rem;">OUR MISSION</h3>
                        <p class="narrative-text" style="color: #4a4a52;">
                            At Stone Hub India, our objective is a commitment to the highest quality providence of the finest marble for superior customer service. 
                        </p>
                        <p class="narrative-text" style="color: #4a4a52; font-style: italic;">
                            Client satisfaction is our main focus to enlighten their way in such a way to strengthen their minds for their satisfaction & a better client relation.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Final Call to Action -->
    <section class="stonehub-cta" style="padding: 8rem 0;">
        <div class="stonehub-cta-container reveal-on-scroll">
            <h2>Experience Immersive Luxury</h2>
            <p>Plan a visit to our Kishangarh Experience Center or request a custom catalogue sent to your email.</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; margin-top: 2.5rem;">
                <button onclick="openDialog('callback-dialog');" class="stonehub-hero-btn primary">Request CallBack</button>
                <a href="{{ route('contact') }}" class="stonehub-hero-btn secondary" style="border-color: rgba(255,255,255,0.3); color: white;">Find Showroom</a>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('scripts')
    <!-- Inject Custom Javascript for Interactive Animation Handles -->
    <script src="{{ asset('assets/js/homepage-redesign.js') }}"></script>
@endsection
