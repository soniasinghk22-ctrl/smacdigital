@extends('layouts.app')

@section('title', ($productsPage->metatitle ?? 'Imported Marble Slabs & Natural Stone Catalog | Stone Hub India'))
@section('meta_description', ($productsPage->metadescription ?? 'Explore our complete catalog of 100+ premium imported marble slabs, Italian marble, onyx, travertine, and quartzites in Kishangarh.'))
@section('meta_keywords', ($productsPage->metakeywords ?? 'imported marble slabs, italian marble kishangarh, marble slab catalog, natural stone gallery'))

@section('styles')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.add('stonehub-body', 'products-catalog-body');
    });
</script>
<style>
    .products-catalog-page { background: #f6f5f2; }

    .catalog-hero {
        background: linear-gradient(135deg, #101013 0%, #1f1f26 100%);
        padding: 5rem 0 3.5rem;
        color: #fff;
        text-align: center;
        position: relative;
    }

    .catalog-hero h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 2.75rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        margin-bottom: 0.75rem;
        color: #ffffff;
    }

    .catalog-hero p {
        max-width: 680px;
        margin: 0 auto 1.5rem;
        font-size: 1.05rem;
        color: rgba(255, 255, 255, 0.75);
        line-height: 1.6;
    }

    .catalog-filter-bar {
        background: #ffffff;
        border-bottom: 1px solid rgba(15, 15, 17, 0.08);
        padding: 1.25rem 0;
        position: sticky;
        top: 80px;
        z-index: 30;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .filter-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-pills {
        display: flex;
        gap: 0.5rem;
        overflow-x: auto;
        padding-bottom: 4px;
        scrollbar-width: none;
    }
    .filter-pills::-webkit-scrollbar { display: none; }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.45rem 1rem;
        background: #f1efea;
        color: #333;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }

    .filter-pill:hover, .filter-pill.active {
        background: #151518;
        color: #ffffff;
        border-color: #151518;
    }

    .search-box {
        position: relative;
        min-width: 260px;
    }

    .search-box input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.25rem;
        border-radius: 999px;
        border: 1px solid #dcd7ce;
        background: #faf8f5;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .search-box input:focus {
        border-color: #c5a880;
        background: #fff;
    }

    .search-box i {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: #8c887e;
        width: 15px;
        height: 15px;
    }

    .catalog-main {
        padding: 3.5rem 0 5rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    @media (max-width: 1024px) {
        .products-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .products-grid { grid-template-columns: 1fr; }
    }

    .marble-card {
        background: #ffffff;
        border: 1px solid rgba(15, 15, 17, 0.08);
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 24px rgba(15, 15, 17, 0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .marble-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(15, 15, 17, 0.08);
        border-color: rgba(197, 168, 128, 0.4);
    }

    .marble-media {
        height: 250px;
        position: relative;
        overflow: hidden;
        background: #ebe8e2;
    }

    .marble-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .marble-card:hover .marble-media img {
        transform: scale(1.06);
    }

    .origin-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(15, 15, 18, 0.8);
        backdrop-filter: blur(8px);
        color: #ffffff;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .marble-info {
        padding: 1.4rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .marble-info h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 750;
        margin: 0 0 0.4rem;
        color: #121214;
    }

    .marble-meta {
        font-size: 0.85rem;
        color: #73716b;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.45;
    }

    .marble-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.35rem;
        margin-top: auto;
        padding-top: 0.75rem;
        border-top: 1px dashed #e6e2da;
    }

    .tag-chip {
        font-size: 0.72rem;
        padding: 0.2rem 0.55rem;
        background: #f7f5f0;
        color: #555;
        border-radius: 4px;
        font-weight: 600;
    }

    .card-footer-cta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1rem;
        font-size: 0.88rem;
        font-weight: 700;
        color: #c5a880;
    }

    .pagination-wrapper {
        margin-top: 3.5rem;
        display: flex;
        justify-content: center;
    }
</style>
@endsection

@section('content')
<div class="products-catalog-page">
    <div class="catalog-hero">
        <div class="container">
            <span class="badge badge-gold" style="background: rgba(197, 168, 128, 0.2); color: #c5a880; padding: 0.35rem 0.9rem; border-radius: 999px; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 0.85rem;">Master Stone Catalog</span>
            <h1>Explore 100+ Premium Imported Marble Slabs</h1>
            <p>Direct from heritage quarries across Italy, Spain, Turkey, Greece, and Brazil. Precision calibrated and handselected for luxury architecture and interiors.</p>
        </div>
    </div>

    <div class="catalog-filter-bar">
        <div class="container">
            <div class="filter-wrapper">
                <div class="filter-pills">
                    <a href="{{ route('products.index') }}" class="filter-pill {{ !request('collection') ? 'active' : '' }}">All Slabs ({{ \App\Models\Marble::where('status', true)->count() }})</a>
                    @foreach($collections as $col)
                    <a href="{{ route('products.index', ['collection' => $col->slug]) }}" class="filter-pill {{ request('collection') === $col->slug ? 'active' : '' }}">
                        {{ $col->name }}
                    </a>
                    @endforeach
                </div>
                <form action="{{ route('products.index') }}" method="GET" class="search-box">
                    @if(request('collection'))
                        <input type="hidden" name="collection" value="{{ request('collection') }}">
                    @endif
                    <i data-lucide="search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search marble by name, origin...">
                </form>
            </div>
        </div>
    </div>

    <div class="catalog-main">
        <div class="container">
            <div class="products-grid">
                @forelse($marbles as $marble)
                <a href="{{ route('products.show', $marble->slug) }}" class="marble-card">
                    <div class="marble-media">
                        <img src="{{ site_image($marble->image) }}" alt="{{ $marble->name }}" loading="lazy" onerror="this.src='/uploads/category/imported-marble.jpg'">
                        <span class="origin-badge">{{ $marble->origin ?? 'Imported' }}</span>
                    </div>
                    <div class="marble-info">
                        <h3>{{ $marble->name }}</h3>
                        <p class="marble-meta">{{ strip_tags($marble->metadescription ?? 'Handpicked luxury imported marble slab with high structural integrity and exquisite veining.') }}</p>
                        
                        <div class="marble-tags">
                            @foreach($marble->collections->take(3) as $c)
                            <span class="tag-chip">{{ $c->name }}</span>
                            @endforeach
                            @if(!empty($marble->thickness))
                            <span class="tag-chip">{{ Str::limit($marble->thickness, 12) }}</span>
                            @endif
                        </div>

                        <div class="card-footer-cta">
                            <span>View Slab Details</span>
                            <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                        </div>
                    </div>
                </a>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem; background: #fff; border-radius: 16px;">
                    <i data-lucide="search-x" style="width: 48px; height: 48px; color: #999; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.4rem; color: #151518; margin-bottom: 0.5rem;">No marble slabs found</h3>
                    <p style="color: #666; margin-bottom: 1.5rem;">Try adjusting your search query or collection filter.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-dark" style="display: inline-block; padding: 0.65rem 1.5rem; background: #151518; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;">Reset Filters</a>
                </div>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                {{ $marbles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
