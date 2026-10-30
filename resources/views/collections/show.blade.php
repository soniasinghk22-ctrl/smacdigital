@extends('layouts.app')

@section('title', ($collection->metatitle ?? $collection->name . ' | Premium Stone Collections | Stone Hub India'))
@section('meta_description', ($collection->metadescription ?? 'Explore ' . $collection->name . ' range. Browse premium imported marble slabs handselected from global quarries.'))
@section('meta_keywords', ($collection->metakeywords ?? $collection->name . ', imported marble collections, stone hub india'))

@section('styles')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('stonehub-body', 'collection-detail-body');
    });
</script>
<style>
    .collection-detail-page { background: #f4f2ed; }

    .collection-detail-main {
        background: #f4f2ed;
        padding: 3rem 0 5rem;
    }

    .collection-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 1.75rem;
        align-items: start;
    }

    .blocks-panel {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 22px;
        padding: 1.5rem;
        box-shadow: 0 8px 24px rgba(15, 15, 17, 0.04);
    }

    .collection-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
        margin-bottom: 1.35rem;
    }

    .toolbar-copy {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        flex-wrap: wrap;
    }

    .collection-toolbar h2 {
        margin: 0 !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 1.45rem !important;
        font-weight: 750 !important;
        letter-spacing: -0.02em;
    }

    .collection-toolbar p {
        margin: 0.2rem 0 0 !important;
        color: #6f6f78 !important;
        font-size: 0.88rem !important;
    }

    .slab-count {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: rgba(197, 168, 128, 0.14);
        color: #8a6d3b !important;
        border: 1px solid rgba(197, 168, 128, 0.28);
        border-radius: 999px;
        padding: 0.35rem 0.75rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.02em;
        white-space: nowrap;
    }

    .collection-filters {
        display: flex;
        gap: 0.65rem;
        flex-wrap: wrap;
        width: min(100%, 420px);
    }

    .filter-search {
        position: relative;
        flex: 1 1 210px;
    }

    .filter-search i,
    .filter-search svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: #9a9aa3;
        pointer-events: none;
        z-index: 1;
    }

    .collection-filters input,
    .collection-filters select {
        width: 100%;
        background: #f7f6f3;
        border: 1px solid rgba(15, 15, 17, 0.08);
        border-radius: 12px;
        padding: 0.78rem 0.9rem;
        color: #151518;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .collection-filters input {
        padding-left: 2.2rem;
    }

    .collection-filters select {
        flex: 0 0 150px;
        width: auto;
        cursor: pointer;
    }

    .collection-filters input:focus,
    .collection-filters select:focus {
        background: #fff;
        border-color: rgba(197, 168, 128, 0.75);
        box-shadow: 0 0 0 3px rgba(197, 168, 128, 0.16);
    }

    .slabs-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.15rem;
    }

    .slab-card {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.07);
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .slab-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(15, 15, 17, 0.09);
        border-color: rgba(197, 168, 128, 0.4);
    }

    .slab-card-media {
        height: 240px;
        overflow: hidden;
        position: relative;
        background: linear-gradient(145deg, #ece9e3, #ddd8cf);
    }

    .slab-card-media::after {
        content: '';
        position: absolute;
        inset: auto 0 0 0;
        height: 42%;
        background: linear-gradient(to top, rgba(12, 12, 14, 0.45), transparent);
        pointer-events: none;
    }

    .slab-card-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.55s ease;
    }

    .slab-card:hover .slab-card-media img {
        transform: scale(1.06);
    }

    .slab-origin {
        position: absolute;
        left: 12px;
        bottom: 12px;
        z-index: 1;
        background: rgba(255, 255, 255, 0.95);
        color: #8a6d3b;
        font-size: 0.7rem;
        font-weight: 750;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 0.32rem 0.65rem;
        border-radius: 999px;
        border: 1px solid rgba(197, 168, 128, 0.35);
    }

    .slab-card-body {
        padding: 1.15rem 1.2rem 1.2rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        gap: 0.65rem;
    }

    .slab-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .slab-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: #f5f3ef;
        color: #5f5f68 !important;
        border-radius: 999px;
        padding: 0.28rem 0.6rem;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .slab-card-body h3 {
        margin: 0 !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 1.12rem !important;
        font-weight: 750 !important;
        letter-spacing: -0.015em;
        line-height: 1.3;
    }

    .slab-card-body p {
        margin: 0 !important;
        color: #666671 !important;
        font-size: 0.88rem !important;
        line-height: 1.55 !important;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .slab-actions {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 0.55rem;
        margin-top: 0.2rem;
    }

    .slab-actions .btn-slab,
    .slab-actions .btn-quote {
        text-align: center;
        justify-content: center;
        border-radius: 11px;
        padding: 0.72rem 0.7rem;
        font-weight: 650;
        font-size: 0.84rem;
        text-decoration: none;
        transition: all 0.22s ease;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .slab-actions .btn-slab {
        background: #121214;
        color: #fff !important;
    }

    .slab-actions .btn-slab:hover {
        background: #2a2a30;
    }

    .slab-actions .btn-quote {
        background: rgba(197, 168, 128, 0.16);
        border-color: rgba(197, 168, 128, 0.4);
        color: #7a5f33 !important;
    }

    .slab-actions .btn-quote:hover {
        background: var(--accent-gold, #C5A880);
        border-color: var(--accent-gold, #C5A880);
        color: #0b0b0c !important;
    }

    .collection-sidebar {
        position: sticky;
        top: 100px;
        display: grid;
        gap: 1rem;
    }

    .side-card {
        background: #fff;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 20px;
        padding: 1.25rem;
        box-shadow: 0 8px 24px rgba(15, 15, 17, 0.035);
    }

    .side-card h3 {
        margin: 0 0 0.95rem !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: 1rem !important;
        font-weight: 750 !important;
        letter-spacing: -0.01em;
    }

    .side-card p {
        color: #6f6f78 !important;
        font-size: 0.86rem !important;
        line-height: 1.55 !important;
        margin: 0 0 0.95rem !important;
    }

    .side-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 0.4rem;
    }

    .side-links a {
        color: #555560 !important;
        text-decoration: none;
        font-size: 0.88rem;
        display: flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 0.7rem;
        border-radius: 11px;
        border: 1px solid transparent;
        background: #f7f6f3;
        transition: all 0.2s ease;
    }

    .side-links a:hover {
        color: #7a5f33 !important;
        border-color: rgba(197, 168, 128, 0.35);
        background: rgba(197, 168, 128, 0.1);
    }

    .side-links a.is-active {
        color: #7a5f33 !important;
        font-weight: 700;
        background: rgba(197, 168, 128, 0.16);
        border-color: rgba(197, 168, 128, 0.4);
    }

    .side-card .form-control {
        background: #f7f6f3 !important;
        border: 1px solid rgba(15, 15, 17, 0.08) !important;
        color: #151518 !important;
        border-radius: 11px !important;
        padding: 0.72rem 0.85rem !important;
        font-size: 0.88rem !important;
    }

    .side-card .btn-primary {
        width: 100%;
        border-radius: 11px;
        background: var(--accent-gold, #C5A880);
        border-color: var(--accent-gold, #C5A880);
        color: #0b0b0c !important;
        font-weight: 750;
        padding: 0.78rem 1rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        color: #6f6f78;
        background: #faf9f7;
        border-radius: 16px;
        border: 1px dashed rgba(15, 15, 17, 0.12);
    }

    .empty-state h3 {
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        margin: 0.75rem 0 0.35rem !important;
    }

    @media (max-width: 1100px) {
        .slabs-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 991px) {
        .collection-layout {
            grid-template-columns: 1fr;
        }
        .collection-sidebar {
            position: static;
        }
        .collection-filters {
            width: 100%;
        }
        .collection-filters select {
            flex: 1 1 140px;
        }
    }
</style>
@endsection

@section('schema')
@if(!empty($collection->schema_markup))
    {!! $collection->schema_markup !!}
@else
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@type' }}": "ItemList",
  "name": "{{ $collection->name }}",
  "description": "{{ strip_tags($collection->description) }}",
  "url": "{{ route('collections.show', $collection->slug) }}",
  "numberOfItems": "{{ count($marbles) }}"
}
</script>
@endif
@endsection

@section('content')
<div class="collection-detail-page">
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ site_image($collection->image) }}" alt="{{ $collection->name }}" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">STONE HUB INDIA CURATION</span>
            <h1>{{ $collection->name }}</h1>
            <p>{{ strip_tags($collection->description) }}</p>
        </div>
    </section>

    <section class="collection-detail-main">
        <div class="container collection-layout">
            <div class="blocks-panel">
                <div class="collection-toolbar">
                    <div class="toolbar-copy">
                        <div>
                            <h2>Available Standing Blocks</h2>
                            <p>Inspect our currently standing bookmatched slab sets.</p>
                        </div>
                        <span class="slab-count" id="slab-count">{{ count($marbles) }} {{ Str::plural('slab', count($marbles)) }}</span>
                    </div>
                    <div class="collection-filters">
                        <div class="filter-search">
                            <i data-lucide="search"></i>
                            <input type="text" id="slab-search" onkeyup="filterSlabs()" placeholder="Search slabs by name...">
                        </div>
                        <select id="space-filter" onchange="filterSlabs()">
                            <option value="">All Spaces</option>
                            <option value="flooring">Flooring</option>
                            <option value="wall">Walls / Mural</option>
                            <option value="countertop">Countertops</option>
                            <option value="bathroom">Bathrooms</option>
                        </select>
                    </div>
                </div>

                @if(count($marbles) > 0)
                    <div id="slabs-grid" class="slabs-grid">
                        @foreach($marbles as $m)
                            <article class="slab-card" data-name="{{ strtolower($m->name) }}" data-applications="{{ strtolower($m->applications ?? '') }}">
                                <div class="slab-card-media">
                                    <img src="{{ site_image($m->image) }}" alt="{{ $m->name }}" loading="lazy">
                                    <span class="slab-origin">{{ $m->origin ?? 'Imported' }}</span>
                                </div>
                                <div class="slab-card-body">
                                    <div class="slab-meta">
                                        <span class="slab-chip">{{ $m->thickness ?? '20mm' }}</span>
                                        <span class="slab-chip">{{ $m->finishes ?? 'Bookmatched' }}</span>
                                        <span class="slab-chip">In stock</span>
                                    </div>
                                    <h3>{{ $m->name }}</h3>
                                    <p>{{ Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags(str_replace(['</p>', '</li>', '</h3>', '<br>', '<br/>', '<br />'], ' ', $m->description ?? '')))), 110) }}</p>
                                    <div class="slab-actions">
                                        <a href="{{ route('products.show', $m->slug) }}" class="btn-slab">View Details</a>
                                        <a href="{{ route('contact') }}?product={{ urlencode($m->name) }}" class="btn-quote">Request Quote</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div id="no-slabs-found" class="empty-state" style="display: none; margin-top: 1rem;">
                        <i data-lucide="search-slash" style="width: 42px; height: 42px; margin: 0 auto; display: block; opacity: 0.5;"></i>
                        <h3>No marble slabs match your filters</h3>
                        <p>Try searching for a different stone type or reset filters.</p>
                    </div>
                @else
                    <div class="empty-state">
                        <i data-lucide="layers-2" style="width: 42px; height: 42px; margin: 0 auto; display: block; opacity: 0.5;"></i>
                        <h3>No marble blocks loaded yet</h3>
                        <p>Check back shortly or request a custom query from our showrooms.</p>
                    </div>
                @endif
            </div>

            <aside class="collection-sidebar">
                <div class="side-card">
                    <h3>Other Collections</h3>
                    <ul class="side-links">
                        @foreach($globalCollections as $c)
                            <li>
                                <a href="{{ route('collections.show', $c->slug) }}" class="{{ $c->id === $collection->id ? 'is-active' : '' }}">
                                    <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
                                    {{ $c->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="side-card">
                    <h3>Request Catalogues</h3>
                    <p>Get the PDF catalogue and specific block prices for the {{ $collection->name }} collection.</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="source" value="Collection Page Catalogue Request: {{ $collection->name }}">
                        <div class="form-group" style="margin-bottom: 0.85rem;">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0.85rem;">
                            <input type="tel" name="phone" class="form-control" placeholder="WhatsApp Number" pattern="[0-9]{10}" required>
                        </div>
                        @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
                            <div class="form-group" style="margin-bottom: 0.85rem; display: flex; justify-content: center;">
                                <div class="g-recaptcha" data-sitekey="{{ $site['recaptcha_site_key'] }}"></div>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary btn-sm">Get Collection PDF</button>
                    </form>
                </div>
            </aside>
        </div>
    </section>
</div>

<script>
    function filterSlabs() {
        const query = document.getElementById('slab-search').value.toLowerCase().trim();
        const space = document.getElementById('space-filter').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.slab-card');
        let matchCount = 0;

        cards.forEach(card => {
            const name = card.getAttribute('data-name') || '';
            const apps = card.getAttribute('data-applications') || '';
            const matchesSearch = query === '' || name.includes(query);
            const matchesSpace = space === '' || apps.includes(space);

            if (matchesSearch && matchesSpace) {
                card.style.display = 'flex';
                matchCount++;
            } else {
                card.style.display = 'none';
            }
        });

        const countEl = document.getElementById('slab-count');
        if (countEl) {
            countEl.textContent = matchCount + (matchCount === 1 ? ' slab' : ' slabs');
        }

        const noFound = document.getElementById('no-slabs-found');
        const grid = document.getElementById('slabs-grid');
        if (noFound) {
            noFound.style.display = (matchCount === 0 && grid) ? 'block' : 'none';
        }
        if (grid) {
            grid.style.display = matchCount === 0 ? 'none' : 'grid';
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        const params = new URLSearchParams(window.location.search);
        const spaceParam = params.get('space');
        if (spaceParam) {
            const select = document.getElementById('space-filter');
            if (select) {
                select.value = spaceParam.toLowerCase();
                filterSlabs();
            }
        }
    });
</script>
@endsection
