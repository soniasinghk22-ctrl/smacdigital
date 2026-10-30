@extends('layouts.app')

@section('title', ($marble->metatitle ?? $marble->name . ' | Premium Imported Marble Slabs | Stone Hub India'))
@section('meta_description', ($marble->metadescription ?? 'Explore ' . $marble->name . ' characteristics, thickness, and finishes. Sourced directly from premium quarries and imported to Kishangarh and Delhi.'))
@section('meta_keywords', ($marble->metakeywords ?? $marble->name . ', imported marble, premium natural stone, stone hub india'))

@section('styles')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('stonehub-body', 'product-detail-body');
    });
</script>
<style>
    .product-detail-page { background: #f6f5f2; color: #151518; }

    .product-detail-page .page-hero {
        min-height: 460px;
    }

    .product-detail-page .page-hero h1 {
        color: #ffffff !important;
    }

    .product-hero-meta {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        margin-top: 1rem;
        color: rgba(255, 255, 255, 0.88) !important;
        font-size: 0.88rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .product-hero-meta span {
        color: var(--accent-gold, #C5A880) !important;
    }

    .product-breadcrumb-bar {
        background: #fff;
        border-bottom: 1px solid rgba(15, 15, 17, 0.06);
        padding: 0.85rem 0;
    }

    .product-breadcrumb {
        font-size: 0.85rem;
        color: #6b6b75 !important;
        margin: 0;
        text-align: left;
    }

    .product-breadcrumb a {
        color: inherit !important;
        text-decoration: none;
    }

    .product-breadcrumb a:hover { color: #8a6d3b !important; }

    .product-main {
        padding: 3rem 0 2rem;
        background: #f6f5f2;
    }

    .product-layout {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 2.25rem;
        align-items: start;
    }

    .product-gallery {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 18px;
        padding: 0.85rem;
        box-shadow: 0 12px 30px rgba(15, 15, 17, 0.05);
        position: sticky;
        top: 100px;
    }

    .product-main-image {
        width: 100%;
        height: 430px;
        border-radius: 14px;
        overflow: hidden;
        background: #ebe8e2;
    }

    .product-main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: opacity 0.25s ease;
    }

    .gallery-thumbs {
        display: flex;
        gap: 0.65rem;
        margin-top: 0.85rem;
        overflow-x: auto;
        padding-bottom: 0.2rem;
    }

    .gallery-thumb-item {
        flex: 0 0 78px;
        height: 58px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        opacity: 0.65;
        transition: all 0.25s ease;
    }

    .gallery-thumb-item.active,
    .gallery-thumb-item:hover {
        opacity: 1;
        border-color: var(--accent-gold, #C5A880);
    }

    .gallery-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .product-panel h2,
    .product-panel h3 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 700 !important;
    }

    .product-panel h2 {
        font-size: 1.55rem !important;
        margin: 0 0 0.9rem !important;
        padding-bottom: 0.55rem;
        border-bottom: 1px solid rgba(15, 15, 17, 0.08);
    }

    .product-desc {
        color: #5c5c66 !important;
        line-height: 1.75 !important;
        font-size: 1.02rem !important;
        margin-bottom: 1.75rem;
    }

    .spec-card,
    .inquiry-card,
    .visualizer-card,
    .usage-card,
    .related-card {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 16px;
        box-shadow: 0 10px 28px rgba(15, 15, 17, 0.04);
    }

    .spec-card {
        padding: 1.5rem;
        margin-bottom: 0;
    }

    .spec-card h3 {
        font-size: 1.1rem !important;
        margin: 0 0 1rem !important;
        display: flex;
        align-items: center;
        gap: 0.45rem;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.1rem;
    }

    .spec-grid span {
        display: block;
        font-size: 0.78rem;
        color: #8a8a96 !important;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .spec-grid strong {
        display: block;
        margin-top: 0.2rem;
        color: #151518 !important;
        font-size: 0.98rem;
        font-weight: 650;
    }

    .inquiry-section {
        padding: 0 0 4rem;
        background: #f6f5f2;
    }

    .inquiry-card {
        padding: 2rem 2.25rem 2.15rem;
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        box-shadow: 0 14px 36px rgba(15, 15, 17, 0.06);
        position: relative;
        overflow: hidden;
    }

    .inquiry-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, var(--accent-gold, #C5A880), #8a6d3b);
    }

    .inquiry-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        padding-left: 0.35rem;
    }

    .inquiry-head h3 {
        font-size: clamp(1.35rem, 2.2vw, 1.7rem) !important;
        margin: 0 0 0.4rem !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 750 !important;
        letter-spacing: -0.02em;
    }

    .inquiry-head > div > p {
        color: #5f5f68 !important;
        font-size: 0.95rem !important;
        margin: 0 !important;
        line-height: 1.55;
        max-width: 520px;
    }

    .inquiry-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: rgba(197, 168, 128, 0.14);
        color: #8a6d3b !important;
        border: 1px solid rgba(197, 168, 128, 0.3);
        border-radius: 999px;
        padding: 0.45rem 0.85rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .inquiry-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem 1.15rem;
        padding-left: 0.35rem;
    }

    .inquiry-form-grid .form-group.full {
        grid-column: 1 / -1;
    }

    .inquiry-card label {
        color: #5f5f68 !important;
        font-size: 0.84rem !important;
        font-weight: 600;
        margin-bottom: 0.4rem;
        display: block;
    }

    .inquiry-card .form-control {
        background: #f7f6f3 !important;
        border: 1px solid rgba(15, 15, 17, 0.1) !important;
        color: #151518 !important;
        border-radius: 12px !important;
        padding: 0.85rem 1rem !important;
        min-height: 48px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .inquiry-card .form-control:focus {
        background: #fff !important;
        border-color: rgba(197, 168, 128, 0.75) !important;
        box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.16) !important;
        outline: none;
    }

    .inquiry-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 0.35rem;
    }

    .inquiry-card .btn-primary {
        width: auto;
        min-width: 260px;
        border-radius: 12px;
        background: var(--accent-gold, #C5A880);
        border-color: var(--accent-gold, #C5A880);
        color: #0b0b0c !important;
        font-weight: 750;
        padding: 0.9rem 1.4rem;
        font-size: 0.95rem;
    }

    .inquiry-note {
        color: #6f6f78 !important;
        font-size: 0.82rem !important;
        margin: 0;
        line-height: 1.45;
    }

    .product-section {
        padding: 4rem 0;
        background: #f6f5f2;
    }

    .product-section.alt {
        background: #fff;
        border-top: 1px solid rgba(15, 15, 17, 0.05);
        border-bottom: 1px solid rgba(15, 15, 17, 0.05);
    }

    .section-heading {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .section-heading .eyebrow {
        color: #8a6d3b !important;
        font-weight: 650;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        font-size: 0.8rem;
    }

    .section-heading h2 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: clamp(1.7rem, 3vw, 2.15rem) !important;
        font-weight: 800 !important;
        margin: 0.45rem 0 0.55rem !important;
    }

    .section-heading p {
        color: #6b6b75 !important;
        max-width: 620px;
        margin: 0 auto;
        line-height: 1.65;
        font-size: 0.95rem;
    }

    .visualizer-grid {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 1.75rem;
        align-items: stretch;
    }

    .visualizer-stage {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 16px;
        overflow: hidden;
        min-height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        box-shadow: 0 10px 28px rgba(15, 15, 17, 0.04);
    }

    .visualizer-stage h4 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        margin: 0 0 0.4rem !important;
    }

    .visualizer-stage p {
        color: #6b6b75 !important;
        font-size: 0.9rem !important;
        max-width: 320px;
        margin: 0 auto;
    }

    .visualizer-options h3 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        margin: 0 0 1.1rem !important;
        font-size: 1.2rem !important;
    }

    .room-selector-btn {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.1);
        border-radius: 12px;
        padding: 0.85rem;
        color: #5c5c66;
        text-align: left;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .room-selector-btn strong {
        display: block;
        color: #151518;
        font-size: 0.95rem;
        margin-bottom: 0.15rem;
    }

    .room-selector-btn span {
        font-size: 0.75rem;
        color: #8a8a96;
    }

    .room-selector-btn:hover,
    .room-selector-btn.active {
        border-color: var(--accent-gold, #C5A880);
        background: rgba(197, 168, 128, 0.08);
        color: #151518;
    }

    .usage-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.15rem;
    }

    .usage-card {
        padding: 1.75rem 1.25rem;
        text-align: center;
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .usage-card:hover {
        transform: translateY(-5px);
        border-color: rgba(197, 168, 128, 0.35);
    }

    .usage-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(197, 168, 128, 0.12);
        color: #8a6d3b;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .usage-card h3 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 1.05rem !important;
        margin: 0 0 0.45rem !important;
    }

    .usage-card p {
        color: #6b6b75 !important;
        font-size: 0.86rem !important;
        line-height: 1.55 !important;
        margin: 0 !important;
    }

    .related-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .related-head h2 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 2rem !important;
        margin: 0.35rem 0 0 !important;
        font-weight: 800 !important;
    }

    .related-head a {
        color: #8a6d3b !important;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .related-card {
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .related-card:hover {
        transform: translateY(-5px);
        border-color: rgba(197, 168, 128, 0.35);
    }

    .related-card-media {
        height: 170px;
        overflow: hidden;
        background: #ebe8e2;
    }

    .related-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.45s ease;
    }

    .related-card:hover .related-card-media img {
        transform: scale(1.05);
    }

    .related-card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        gap: 0.45rem;
    }

    .related-card-body h3 {
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 1.05rem !important;
        margin: 0 !important;
    }

    .related-card-body .origin {
        color: #8a6d3b !important;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 650;
    }

    .related-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.55rem;
        margin-top: auto;
        padding-top: 0.85rem;
        border-top: 1px solid rgba(15, 15, 17, 0.06);
    }

    .related-actions .btn {
        text-align: center;
        justify-content: center;
        border-radius: 10px;
        padding: 0.55rem 0.7rem;
        font-size: 0.84rem;
        font-weight: 600;
    }

    .related-actions .btn-details {
        background: transparent;
        border: 1px solid rgba(15, 15, 17, 0.14);
        color: #151518 !important;
        text-decoration: none;
    }

    .related-actions .btn-inquire {
        background: var(--accent-gold, #C5A880);
        border: 1px solid var(--accent-gold, #C5A880);
        color: #0b0b0c !important;
    }

    .ai-pulse-ring {
        width: 56px;
        height: 56px;
        border: 3px solid var(--accent-gold, #C5A880);
        border-top-color: transparent;
        border-radius: 50%;
        margin: 0 auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @media (max-width: 991px) {
        .product-layout,
        .visualizer-grid {
            grid-template-columns: 1fr;
        }
        .product-gallery {
            position: static;
        }
        .product-main-image {
            height: 320px;
        }
        .usage-grid {
            grid-template-columns: 1fr 1fr;
        }
        .inquiry-card {
            padding: 1.5rem 1.35rem 1.4rem;
        }
        .inquiry-form-grid {
            grid-template-columns: 1fr;
        }
        .inquiry-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .inquiry-card .btn-primary {
            width: 100%;
            min-width: 0;
        }
    }

    @media (max-width: 640px) {
        .usage-grid,
        .spec-grid {
            grid-template-columns: 1fr;
        }
        .product-detail-page .page-hero {
            min-height: 380px;
            padding-top: 7.5rem;
        }
        .inquiry-head {
            margin-bottom: 1.15rem;
        }
    }
</style>
@endsection

@section('schema')
@if(!empty($marble->schema_markup))
    {!! $marble->schema_markup !!}
@else
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@type' }}": "Product",
  "name": "{{ $marble->name }}",
  "image": "{{ site_image($marble->image) }}",
  "description": "{{ strip_tags($marble->description) }}",
  "offers": {
    "{{ '@type' }}": "AggregateOffer",
    "priceCurrency": "INR",
    "lowPrice": "350",
    "highPrice": "2500",
    "offerCount": "10"
  },
  "additionalProperty": [
    {
      "{{ '@type' }}": "PropertyValue",
      "name": "Origin",
      "value": "{{ $marble->origin ?? 'Imported' }}"
    },
    {
      "{{ '@type' }}": "PropertyValue",
      "name": "Thickness",
      "value": "{{ $marble->thickness ?? '18mm' }}"
    },
    {
      "{{ '@type' }}": "PropertyValue",
      "name": "Finishes",
      "value": "{{ $marble->finishes ?? 'Polished' }}"
    }
  ]
}
</script>
@endif
@endsection

@section('content')
<div class="product-detail-page">
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ site_image($marble->image) }}" alt="{{ $marble->name }}" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">STONE HUB INDIA CURATION</span>
            <h1>{{ $marble->name }}</h1>
            <p>{{ Str::limit(strip_tags($marble->description ?? 'Premium imported natural stone slab curated for luxury interiors.'), 160) }}</p>
            <div class="product-hero-meta">
                <span>{{ $marble->origin ?? 'Imported' }}</span>
                @if(!empty($marble->thickness))
                    <span aria-hidden="true">·</span>
                    <span>{{ $marble->thickness }}</span>
                @endif
                @if(!empty($marble->finishes))
                    <span aria-hidden="true">·</span>
                    <span>{{ $marble->finishes }}</span>
                @endif
            </div>
        </div>
    </section>

    <div class="product-breadcrumb-bar">
        <div class="container">
            <nav class="product-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span style="margin: 0 8px;">/</span>
                <a href="{{ route('collections') }}">Collections</a>
                <span style="margin: 0 8px;">/</span>
                <span style="color: #8a6d3b;">{{ $marble->name }}</span>
            </nav>
        </div>
    </div>

    <section class="product-main">
        <div class="container product-layout">
            <div>
                <div class="product-gallery">
                    <div class="product-main-image">
                        <img id="main-slab-img" src="{{ site_image($marble->image) }}" alt="{{ $marble->name }}">
                    </div>
                    @php
                        $galleryImages = json_decode($marble->gallery ?? '[]', true) ?: [];
                        $allImages = collect(array_merge([$marble->image], $galleryImages))
                            ->filter()
                            ->unique()
                            ->filter(function ($path) {
                                if (preg_match('#^https?://#i', $path)) {
                                    return true;
                                }
                                return is_file(public_path(ltrim($path, '/')));
                            })
                            ->values()
                            ->all();
                    @endphp
                    @if(count($allImages) > 1)
                        <div class="gallery-thumbs">
                            @foreach($allImages as $index => $img)
                                <div class="gallery-thumb-item {{ $index === 0 ? 'active' : '' }}" onclick="changeSlabImage('{{ site_image($img) }}', this)">
                                    <img src="{{ site_image($img) }}" alt="{{ $marble->name }} view {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="product-panel">
                <h2>Product Profile</h2>
                <div class="product-desc">{!! $marble->description !!}</div>

                <div class="spec-card">
                    <h3><i data-lucide="layers" style="width: 18px; height: 18px; color: #8a6d3b;"></i> Technical Specifications</h3>
                    <div class="spec-grid">
                        <div>
                            <span>Origin</span>
                            <strong>{{ $marble->origin ?? 'Italian Quarries' }}</strong>
                        </div>
                        <div>
                            <span>Standard Slabs Sizing</span>
                            <strong>{{ $marble->thickness ?? '18mm / 20mm Slabs' }}</strong>
                        </div>
                        <div>
                            <span>Recommended Finishes</span>
                            <strong>{{ $marble->finishes ?? 'Mirror Polished, Honed' }}</strong>
                        </div>
                        <div>
                            <span>Best Suited Spaces</span>
                            <strong>{{ $marble->applications ?? 'Flooring, Feature Wall, Counters' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inquiry-section">
        <div class="container">
            <div class="inquiry-card">
                <div class="inquiry-head">
                    <div>
                        <h3>Inquire About This Block</h3>
                        <p>Receive bookmatch layout photos, video inspections, and specific slab dimensions for {{ $marble->name }} on your phone.</p>
                    </div>
                    <span class="inquiry-badge"><i data-lucide="message-circle" style="width:14px;height:14px;"></i> WhatsApp Response</span>
                </div>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="Marble Page Inquiry: {{ $marble->name }}">
                    <div class="inquiry-form-grid">
                        <div class="form-group">
                            <label>Your Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label>Phone Number (WhatsApp Preferred)</label>
                            <input type="tel" name="phone" class="form-control" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
                        </div>
                        <div class="form-group full">
                            <label>Project Details / Required Sqft</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Specify thickness, dimensions, or layout requirements..."></textarea>
                        </div>
                        @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
                            <div class="form-group full" style="display: flex; justify-content: flex-start;">
                                <div class="g-recaptcha" data-sitekey="{{ $site['recaptcha_site_key'] }}"></div>
                            </div>
                        @endif
                        <div class="form-group full">
                            <div class="inquiry-actions">
                                <button type="submit" class="btn btn-primary">Get Quote & Bookmatch Pics</button>
                                <p class="inquiry-note">Our curator typically responds within a few hours with live block photos and pricing guidance.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="product-section alt">
        <div class="container">
            <div class="section-heading">
                <div class="eyebrow">EXPERIENCE THE EXTRAORDINARY</div>
                <h2>AI Room Visualizer</h2>
                <p>Select an interior space and watch our AI instantly render this exact slab texture onto luxury room surfaces.</p>
            </div>

            <div class="visualizer-grid">
                <div class="visualizer-stage">
                    <div id="visualizer-placeholder" style="text-align: center; padding: 2rem;">
                        <i data-lucide="sparkles" style="width: 42px; height: 42px; color: #8a6d3b; margin-bottom: 0.85rem; display: inline-block;"></i>
                        <h4>Ready to Visualize</h4>
                        <p>Choose a room type on the right and click generate to render a custom luxury interior preview.</p>
                    </div>
                    <div id="visualizer-loader" style="display: none; text-align: center; padding: 2rem;">
                        <div class="ai-pulse-ring"></div>
                        <h4 style="margin-top: 1.25rem;">AI Architect rendering...</h4>
                        <p style="color: #8a6d3b !important; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.8rem !important;">Analyzing vein texture & patterns</p>
                    </div>
                    <img id="visualizer-result-img" src="" alt="AI Room Mockup" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                    <div id="visualizer-actions" style="display: none; position: absolute; bottom: 15px; right: 15px;">
                        <a id="visualizer-download-btn" href="#" download class="btn" style="padding: 0.45rem 0.8rem; font-size: 0.8rem; background: rgba(15,15,17,0.85); border: none; color: #fff; text-decoration: none; border-radius: 8px; display: inline-flex; align-items: center; gap: 4px;">
                            <i data-lucide="download" style="width: 14px; height: 14px;"></i> Download Render
                        </a>
                    </div>
                </div>

                <div class="visualizer-options">
                    <h3>Configure AI Rendering</h3>
                    <div style="margin-bottom: 1.25rem;">
                        <label style="color: #8a8a96; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 0.75rem;">1. Select Room Setting</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.65rem;">
                            <button type="button" class="room-selector-btn active" data-room="living_room">
                                <strong>Living Room</strong>
                                <span>Luxury Flooring</span>
                            </button>
                            <button type="button" class="room-selector-btn" data-room="kitchen">
                                <strong>Kitchen Space</strong>
                                <span>Countertop & Backsplash</span>
                            </button>
                            <button type="button" class="room-selector-btn" data-room="bathroom">
                                <strong>Master Bath</strong>
                                <span>Cladding & Vanity</span>
                            </button>
                            <button type="button" class="room-selector-btn" data-room="lobby">
                                <strong>Grand Lobby</strong>
                                <span>Entrance Flooring</span>
                            </button>
                        </div>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="color: #8a8a96; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em; display: block; margin-bottom: 0.45rem;">2. AI Processing Engine</label>
                        <p style="color: #6b6b75; font-size: 0.86rem; line-height: 1.5; margin: 0;">
                            Powered by Google Imagen 3 with multimodal texture translation. Uses the high-resolution slab image to texture the space.
                        </p>
                    </div>
                    <button type="button" onclick="generateAiVisualization()" class="btn btn-primary" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; font-weight: 700; border-radius: 10px; background: var(--accent-gold, #C5A880); border-color: var(--accent-gold, #C5A880); color: #0b0b0c;">
                        <i data-lucide="sparkles" style="width: 16px; height: 16px;"></i> Generate AI Room Preview
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container">
            <div class="section-heading">
                <div class="eyebrow">VERSATILE APPLICATIONS</div>
                <h2>Recommended Usages</h2>
                <p>Premium natural stones are suitable for multiple spaces, adding luxury and style to your home.</p>
            </div>
            <div class="usage-grid">
                <div class="usage-card">
                    <div class="usage-icon"><i data-lucide="navigation-2" style="width: 20px; height: 20px;"></i></div>
                    <h3>Living Room Flooring</h3>
                    <p>Perfect for grand expanses of high-traffic flooring, giving a bright and reflective premium finish.</p>
                </div>
                <div class="usage-card">
                    <div class="usage-icon"><i data-lucide="layout" style="width: 20px; height: 20px;"></i></div>
                    <h3>Wall Cladding</h3>
                    <p>Create breathtaking feature walls or TV panels with bookmatch slab layouts.</p>
                </div>
                <div class="usage-card">
                    <div class="usage-icon"><i data-lucide="hard-drive" style="width: 20px; height: 20px;"></i></div>
                    <h3>Kitchen Countertops</h3>
                    <p>Highly scratch-resistant and elegant options suitable for kitchen countertops and island tables.</p>
                </div>
                <div class="usage-card">
                    <div class="usage-icon"><i data-lucide="bath" style="width: 20px; height: 20px;"></i></div>
                    <h3>Bathroom Vanity</h3>
                    <p>Adds luxury to bathroom vanity counters, backsplashes, and shower enclosures.</p>
                </div>
            </div>
        </div>
    </section>

    @php
        $relatedMarbles = \App\Models\Marble::where('status', true)
            ->where('id', '!=', $marble->id)
            ->whereHas('collections', function($q) use ($relatedCollections) {
                $q->whereIn('collections.id', $relatedCollections->pluck('id'));
            })
            ->take(4)
            ->get();

        if ($relatedMarbles->isEmpty()) {
            $relatedMarbles = \App\Models\Marble::where('status', true)
                ->where('id', '!=', $marble->id)
                ->take(4)
                ->get();
        }
    @endphp

    @if($relatedMarbles->isNotEmpty())
    <section class="product-section alt">
        <div class="container">
            <div class="related-head">
                <div>
                    <div class="eyebrow" style="color:#8a6d3b;font-weight:650;text-transform:uppercase;letter-spacing:.14em;font-size:.8rem;">RECOMMENDED SELECTIONS</div>
                    <h2>Products You May Like</h2>
                </div>
                <a href="{{ route('collections') }}">
                    View All Slabs <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                </a>
            </div>
            <div class="related-grid">
                @foreach($relatedMarbles as $rm)
                    <article class="related-card">
                        <div class="related-card-media">
                            <img src="{{ site_image($rm->image) }}" alt="{{ $rm->name }}" loading="lazy">
                        </div>
                        <div class="related-card-body">
                            <h3>{{ $rm->name }}</h3>
                            <span class="origin">{{ $rm->origin ?? 'Imported Stone' }}</span>
                            <div class="related-actions">
                                <a href="{{ route('products.show', $rm->slug) }}" class="btn btn-details">Details</a>
                                <button type="button" onclick="openCatalogRequest('{{ $rm->name }}')" class="btn btn-inquire">Inquire</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<script>
    function changeSlabImage(src, thumbElement) {
        const mainImg = document.getElementById('main-slab-img');
        mainImg.style.opacity = 0;
        setTimeout(() => {
            mainImg.src = src;
            mainImg.style.opacity = 1;
        }, 200);

        document.querySelectorAll('.gallery-thumb-item').forEach(item => item.classList.remove('active'));
        thumbElement.classList.add('active');
    }

    let activeRoom = 'living_room';

    document.querySelectorAll('.room-selector-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.room-selector-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeRoom = this.dataset.room;
        });
    });

    function generateAiVisualization() {
        const placeholder = document.getElementById('visualizer-placeholder');
        const loader = document.getElementById('visualizer-loader');
        const resultImg = document.getElementById('visualizer-result-img');
        const actions = document.getElementById('visualizer-actions');
        const downloadBtn = document.getElementById('visualizer-download-btn');

        placeholder.style.display = 'none';
        resultImg.style.display = 'none';
        actions.style.display = 'none';
        loader.style.display = 'block';

        fetch("{{ route('products.visualize', $marble->slug) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ room_type: activeRoom })
        })
        .then(res => res.json())
        .then(data => {
            loader.style.display = 'none';
            if (data.success) {
                resultImg.src = data.url;
                resultImg.style.display = 'block';
                actions.style.display = 'flex';
                downloadBtn.href = data.url;
            } else {
                placeholder.style.display = 'block';
                alert(data.error || 'Failed to generate visualizer image. Please try again.');
            }
        })
        .catch(err => {
            loader.style.display = 'none';
            placeholder.style.display = 'block';
            console.error(err);
            alert('An error occurred during AI image generation.');
        });
    }
</script>
@endsection
