@extends('layouts.app')

@section('title', ($collectionsPage->metatitle ?? 'Premium Stone Collections | Stone Hub India'))
@section('meta_description', ($collectionsPage->metadescription ?? 'Explore our premium natural stone collections: Italian Marble, Exotic Quartzite, Translucent Onyx, Classic Travertine, and Signature Stones.'))
@section('meta_keywords', ($collectionsPage->metakeywords ?? 'imported marble, italian marble, quartzite slabs, onyx stone, travertine'))

@section('styles')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('stonehub-body', 'collections-page-body');
    });
</script>
<style>
    .collections-page {
        background: #f6f5f2;
    }

    .collections-grid-section {
        background: #f6f5f2;
        padding: 4.5rem 0 5.5rem;
    }

    .collections-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.75rem;
    }

    .collection-card {
        background: #ffffff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 28px rgba(15, 15, 17, 0.06);
        transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    }

    .collection-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(15, 15, 17, 0.1);
        border-color: rgba(197, 168, 128, 0.35);
    }

    .collection-card-media {
        height: 230px;
        overflow: hidden;
        position: relative;
        background: #ebe8e2;
    }

    .collection-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.55s ease;
    }

    .collection-card:hover .collection-card-media img {
        transform: scale(1.06);
    }

    .collection-card-body {
        padding: 1.6rem 1.6rem 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        gap: 0.85rem;
    }

    .collection-card-title {
        margin: 0 !important;
        color: #151518 !important;
        font-family: 'Outfit', var(--font-heading), sans-serif !important;
        font-size: 1.35rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.02em;
        line-height: 1.25;
    }

    .collection-card-text {
        margin: 0 !important;
        color: #5c5c66 !important;
        font-family: 'Inter', var(--font-body), sans-serif !important;
        font-size: 0.95rem !important;
        line-height: 1.65;
        flex-grow: 1;
    }

    .collection-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.7rem;
        margin-top: 0.35rem;
    }

    .collection-card-actions .btn {
        width: 100%;
        text-align: center;
        justify-content: center;
        border-radius: 10px;
        padding: 0.78rem 0.9rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.25s ease;
    }

    .collection-card-actions .btn-view {
        background: transparent;
        border: 1px solid rgba(15, 15, 17, 0.14);
        color: #151518 !important;
    }

    .collection-card-actions .btn-view:hover {
        border-color: #151518;
        background: #151518;
        color: #fff !important;
    }

    .collection-card-actions .btn-quote {
        background: var(--accent-gold, #C5A880);
        border: 1px solid var(--accent-gold, #C5A880);
        color: #0b0b0c !important;
    }

    .collection-card-actions .btn-quote:hover {
        background: var(--accent-gold-hover, #B4956C);
        border-color: var(--accent-gold-hover, #B4956C);
        color: #0b0b0c !important;
    }

    @media (max-width: 1024px) {
        .collections-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .collections-grid-section {
            padding: 3rem 0 4rem;
        }

        .collections-grid {
            grid-template-columns: 1fr;
            gap: 1.25rem;
        }

        .collection-card-media {
            height: 210px;
        }

        .collection-card-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('schema')
@if(!empty($collectionsPage->schema_markup))
    {!! $collectionsPage->schema_markup !!}
@else
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@graph' }}": [
    {
      "{{ '@type' }}": "WebPage",
      "{{ '@id' }}": "{{ route('collections') }}/#webpage",
      "url": "{{ route('collections') }}",
      "name": "Luxury Natural Stone Slabs Collections | Stone Hub India",
      "description": "Explore the finest natural stone collections sourced from exclusive quarries in Italy, Spain, Brazil, and Turkey.",
      "isPartOf": {
        "{{ '@type' }}": "WebSite",
        "{{ '@id' }}": "{{ route('home') }}/#website"
      },
      "about": [
        @foreach($globalCollections as $index => $gc)
        {
          "{{ '@type' }}": "CollectionPage",
          "name": "{{ $gc->name }}",
          "url": "{{ route('collections.show', $gc->slug) }}"
        }{{ $index < count($globalCollections) - 1 ? ',' : '' }}
        @endforeach
      ]
    }
  ]
}
</script>
@endif
@endsection

@section('content')
<div class="collections-page">
    <!-- Details Hero -->
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-collections.webp') }}" alt="Stone Hub India marble collections" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">CURATED CATEGORIES</span>
            <h1>Our Stone Collections</h1>
            <p>Handpicked global varieties processed using state-of-the-art Italian machinery. Select a collection below to view standing inventory.</p>
        </div>
    </section>

    <!-- Collections Grid -->
    <section class="collections-grid-section">
        <div class="container">
            <div class="collections-grid animate-on-scroll">
                @foreach($collections as $col)
                    <article class="collection-card">
                        @if($col->image)
                            <div class="collection-card-media">
                                <img src="{{ site_image($col->image) }}" alt="{{ $col->name }}" loading="lazy">
                            </div>
                        @endif
                        <div class="collection-card-body">
                            <h3 class="collection-card-title">{{ $col->name }}</h3>
                            <p class="collection-card-text">
                                {{ \Illuminate\Support\Str::limit($col->description, 130) ?: 'Explore our premium hand-selected stone slabs, directly imported from premium quarry regions.' }}
                            </p>
                            <div class="collection-card-actions">
                                <a href="{{ route('collections.show', $col->slug) }}" class="btn btn-view">View Slabs</a>
                                <button type="button" onclick="openCatalogRequest('{{ $col->name }} Collection')" class="btn btn-quote">Request Quote</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
