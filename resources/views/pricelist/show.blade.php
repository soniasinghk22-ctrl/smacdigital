@extends('layouts.app')

@section('title', $item['name'] . ' | Price, Supplier & Manufacturer in India | Stone Hub India')
@section('meta_description', $item['name'] . ' available at Stone Hub India, Kishangarh. Current indicative rate: ' . $item['price'] . '. Request live slab photos, bookmatch layouts, and project quotation.')
@section('meta_keywords', strtolower($item['name']) . ', italian marble, imported marble kishangarh, marble price list, stone hub india')

@section('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@type' }}": "Product",
  "name": "{{ $item['name'] }}",
  "image": "{{ site_image($item['image']) }}",
  "description": "{{ $item['name'] }} imported marble slabs supplied by Stone Hub India from Kishangarh.",
  "brand": {
    "{{ '@type' }}": "Brand",
    "name": "Stone Hub India"
  },
  "offers": {
    "{{ '@type' }}": "Offer",
    "priceCurrency": "INR",
    "availability": "https://schema.org/InStock",
    "url": "{{ route('imported-marble.show', $item['slug']) }}"
  }
}
</script>
@endsection

@section('styles')
<style>
    .marble-detail-page { background: #f4f2ed; }
    .marble-detail-main { padding: 3rem 0 4rem; }
    .marble-detail-grid {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 2rem;
        align-items: start;
    }
    .marble-visual {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.06);
        border-radius: 18px;
        padding: 0.85rem;
        box-shadow: 0 12px 30px rgba(15,15,17,0.05);
        position: sticky;
        top: 100px;
    }
    .marble-visual img {
        width: 100%;
        height: 460px;
        object-fit: cover;
        border-radius: 14px;
        display: block;
        background: #ebe8e2;
    }
    .marble-panel h1 {
        font-family: 'Outfit', sans-serif !important;
        font-size: clamp(1.7rem, 3vw, 2.3rem) !important;
        color: #121214 !important;
        margin: 0 0 0.75rem !important;
        font-weight: 780 !important;
        letter-spacing: -0.02em;
    }
    .marble-price-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        background: rgba(197,168,128,0.16);
        color: #8a6d3b !important;
        border: 1px solid rgba(197,168,128,0.35);
        border-radius: 999px;
        padding: 0.55rem 1rem;
        font-weight: 750;
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
    }
    .marble-panel .lead {
        color: #4a4a52 !important;
        font-size: 1.05rem;
        line-height: 1.7;
        margin: 0 0 1.5rem;
    }
    .detail-block {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.06);
        border-radius: 16px;
        padding: 1.35rem 1.45rem;
        box-shadow: 0 8px 24px rgba(15,15,17,0.04);
        margin-bottom: 1rem;
    }
    .detail-block h2 {
        font-size: 1.1rem !important;
        margin: 0 0 0.85rem !important;
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 720 !important;
    }
    .detail-block ul {
        margin: 0;
        padding-left: 1.15rem;
        color: #4a4a52 !important;
        line-height: 1.7;
    }
    .detail-block li { margin-bottom: 0.4rem; }
    .detail-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }
    .detail-actions .btn {
        border-radius: 12px;
        font-weight: 700;
        padding: 0.85rem 1.25rem;
    }
    .related-section { padding: 0 0 4rem; }
    .related-section h2 {
        font-family: 'Outfit', sans-serif !important;
        color: #121214 !important;
        font-size: 1.6rem !important;
        margin: 0 0 1.35rem !important;
    }
    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.1rem;
    }
    .related-card {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.06);
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        box-shadow: 0 8px 22px rgba(15,15,17,0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 28px rgba(15,15,17,0.08);
    }
    .related-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
        background: #ebe8e2;
    }
    .related-card .meta {
        padding: 0.9rem 1rem 1.05rem;
    }
    .related-card h3 {
        margin: 0 0 0.35rem !important;
        font-size: 0.95rem !important;
        color: #151518 !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 700 !important;
    }
    .related-card span {
        color: #8a6d3b !important;
        font-size: 0.86rem;
        font-weight: 650;
    }
    .inquiry-mini label {
        display: block;
        font-size: 0.84rem;
        font-weight: 600;
        color: #5f5f68 !important;
        margin-bottom: 0.35rem;
    }
    .inquiry-mini .form-control {
        background: #f7f6f3 !important;
        border: 1px solid rgba(15,15,17,0.1) !important;
        border-radius: 10px !important;
        color: #151518 !important;
        margin-bottom: 0.85rem;
    }
    @media (max-width: 991px) {
        .marble-detail-grid,
        .related-grid { grid-template-columns: 1fr 1fr; }
        .marble-visual { position: static; }
        .marble-visual img { height: 320px; }
    }
    @media (max-width: 640px) {
        .related-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
@php
    $name = $item['name'];
    $nameLower = Str::lower($name);
@endphp
<div class="marble-detail-page">
    <section class="page-hero" style="min-height: 360px;">
        <div class="page-hero-media">
            <img src="{{ site_image($item['image']) }}" alt="{{ $name }}" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">IMPORTED MARBLE</span>
            <h1>{{ $name }}</h1>
            <p>Premium imported marble slabs available for flooring, cladding, and luxury interiors.</p>
        </div>
    </section>

    <div class="product-breadcrumb-bar">
        <div class="container">
            <nav class="product-breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span style="margin: 0 8px;">/</span>
                <a href="{{ route('pricelist') }}">Italian Marble Price List</a>
                <span style="margin: 0 8px;">/</span>
                <span style="color: #8a6d3b;">{{ $name }}</span>
            </nav>
        </div>
    </div>

    <section class="marble-detail-main">
        <div class="container marble-detail-grid">
            <div class="marble-visual">
                <img src="{{ site_image($item['image']) }}" alt="{{ $name }} slab">
            </div>

            <div class="marble-panel">
                <h1>{{ $name }}</h1>
                <div class="marble-price-pill">
                    <i data-lucide="tag" style="width:16px;height:16px;"></i>
                    {{ $item['price'] }}
                </div>
                <p class="lead">
                    {{ $name }} is a premium imported marble available at Stone Hub India’s Kishangarh experience center.
                    Ideal for luxury residences and commercial interiors, this stone is supplied in polished slab formats with curated block selection.
                </p>

                <div class="detail-block">
                    <h2>Origin and Appearance</h2>
                    <ul>
                        <li>{{ $name }} is an exceptional imported marble curated by Stone Hub India for high-end interior projects.</li>
                        <li>Preferred for its finish quality, durability, and distinctive surface character.</li>
                        <li>Typical slab thickness ranges from 15–20 mm depending on selection and processing.</li>
                        <li>Multiple vein maps and lot selections are available subject to current stockyard inventory.</li>
                    </ul>
                </div>

                <div class="detail-block">
                    <h2>Best Suited For</h2>
                    <ul>
                        <li>Flooring, wall cladding, countertops, lobbies, and feature walls.</li>
                        <li>Residential and commercial projects requiring premium imported stone aesthetics.</li>
                        <li>Bookmatched feature elevations where consecutive slabs are available.</li>
                    </ul>
                </div>

                <div class="detail-block">
                    <h2>Pros of Imported Italian Marble</h2>
                    <ul>
                        <li>High luster and refined polished finish.</li>
                        <li>Superior visual depth with distinctive natural veining.</li>
                        <li>Wide variety of colors and patterns for design flexibility.</li>
                        <li>Standard processing around 18–20 mm for structural reliability.</li>
                    </ul>
                </div>

                <div class="detail-actions">
                    <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text={{ urlencode('Hi Stone Hub India, I want details and live photos for ' . $name . ' (' . $item['price'] . ').') }}" class="btn btn-primary" target="_blank" rel="noopener">Get Quote on WhatsApp</a>
                    <a href="{{ route('pricelist') }}" class="btn" style="background:#fff;border:1px solid rgba(15,15,17,0.12);color:#151518;">Back to Price List</a>
                </div>

                <div class="detail-block inquiry-mini" style="margin-top: 1.35rem;">
                    <h2>Send Enquiry</h2>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="Imported Marble Enquiry: {{ $name }}">
                        <label>Your Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        <label>Phone Number</label>
                        <input type="tel" name="phone" class="form-control" placeholder="10-digit mobile number" pattern="[0-9]{10}" required>
                        <label>Project Details</label>
                        <textarea name="message" class="form-control" rows="3" placeholder="Share required sqft, thickness, or finish details for {{ $name }}..."></textarea>
                        <button type="submit" class="btn btn-primary" style="width:100%;border-radius:12px;font-weight:750;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($related))
        <section class="related-section">
            <div class="container">
                <h2>More Italian Marbles</h2>
                <div class="related-grid">
                    @foreach($related as $rel)
                        <a class="related-card" href="{{ route('imported-marble.show', $rel['slug']) }}">
                            <img src="{{ site_image($rel['image']) }}" alt="{{ $rel['name'] }}" loading="lazy">
                            <div class="meta">
                                <h3>{{ $rel['name'] }}</h3>
                                <span>{{ $rel['price'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
