@extends('layouts.app')

@section('title', ($infraPage->metatitle ?? 'Factory Infrastructure & Processing | Stone Hub India'))
@section('meta_description', ($infraPage->metadescription ?? 'Explore Stone Hub India industrial infrastructure in Kishangarh. Premium processing gang saws, automated slab polishing lines, and over 2 million sqft of standing inventory.'))
@section('meta_keywords', ($infraPage->metakeywords ?? 'marble factory kishangarh, stone processing equipment, imported marble stockyard, stone hub india infrastructure'))

@section('styles')
<style>
    .infra-page { background: #f4f2ed; }

    .infra-section {
        padding: 4.5rem 0;
        background: #f4f2ed;
    }

    .infra-section.alt { background: #fff; }

    .infra-split {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 3rem;
        align-items: center;
    }

    .infra-split.reverse { direction: rtl; }
    .infra-split.reverse > * { direction: ltr; }

    .infra-eyebrow {
        color: #8a6d3b;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        display: block;
        margin-bottom: 0.55rem;
    }

    .infra-split h2 {
        margin: 0 0 1rem !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: clamp(1.7rem, 2.4vw, 2.2rem) !important;
        font-weight: 750 !important;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }

    .infra-split p,
    .infra-copy p {
        color: #5f5f68 !important;
        line-height: 1.75;
        margin: 0 0 1.1rem;
        font-size: 1rem;
    }

    .infra-checklist {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.7rem;
        margin-top: 0.5rem;
    }

    .infra-checklist span {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        color: #2f2f36 !important;
        font-weight: 600;
        font-size: 0.92rem;
    }

    .infra-media {
        border-radius: 20px;
        overflow: hidden;
        height: 360px;
        border: 1px solid rgba(15, 15, 17, 0.06);
        box-shadow: 0 14px 36px rgba(15, 15, 17, 0.07);
        background: #ece9e3;
    }

    .infra-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.55s ease;
    }

    .infra-media:hover img { transform: scale(1.06); }

    .infra-steps {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 1rem;
    }

    .infra-steps li {
        display: flex;
        gap: 0.85rem;
        align-items: flex-start;
    }

    .infra-steps .num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(197, 168, 128, 0.18);
        color: #7a5f33;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        font-weight: 750;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .infra-steps strong {
        display: block;
        color: #121214 !important;
        margin-bottom: 0.2rem;
        font-size: 1rem;
    }

    .infra-steps p {
        margin: 0 !important;
        font-size: 0.9rem !important;
        color: #666671 !important;
    }

    .infra-note {
        background: #f7f6f3;
        border: 1px solid rgba(15, 15, 17, 0.06);
        border-radius: 14px;
        padding: 1.15rem 1.25rem;
        margin-top: 1rem;
    }

    .infra-note h4 {
        margin: 0 0 0.4rem !important;
        color: #121214 !important;
        font-size: 1.02rem !important;
        font-family: 'Outfit', sans-serif !important;
    }

    .infra-gallery-wrap {
        padding: 4.5rem 0 5rem;
        background: #fff;
        border-top: 1px solid rgba(15, 15, 17, 0.05);
    }

    .infra-gallery-head {
        text-align: center;
        max-width: 640px;
        margin: 0 auto 2.25rem;
    }

    .infra-gallery-head h2 {
        margin: 0 0 0.55rem !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: clamp(1.7rem, 2.4vw, 2.15rem) !important;
        font-weight: 750 !important;
    }

    .infra-gallery-head p {
        margin: 0;
        color: #666671 !important;
        font-size: 0.98rem;
        line-height: 1.6;
    }

    .infra-tabs {
        display: flex;
        justify-content: center;
        gap: 0.6rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .infra-tab {
        border: 1px solid rgba(15, 15, 17, 0.1);
        background: #f7f6f3;
        color: #3a3a42;
        border-radius: 999px;
        padding: 0.55rem 1.1rem;
        font-size: 0.88rem;
        font-weight: 650;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'Outfit', sans-serif;
    }

    .infra-tab.is-active,
    .infra-tab:hover {
        background: #121214;
        border-color: #121214;
        color: #fff;
    }

    .infra-gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    .infra-zoom-card {
        position: relative;
        display: block;
        border-radius: 16px;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        background: #ece9e3;
        border: 1px solid rgba(15, 15, 17, 0.06);
        box-shadow: 0 8px 24px rgba(15, 15, 17, 0.05);
        cursor: zoom-in;
    }

    .infra-zoom-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.55s ease;
    }

    .infra-zoom-card:hover img { transform: scale(1.1); }

    .infra-zoom-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(12, 12, 14, 0.35), transparent 45%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .infra-zoom-card:hover::after { opacity: 1; }

    .infra-zoom-card .zoom-hint {
        position: absolute;
        right: 12px;
        bottom: 12px;
        z-index: 1;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        color: #7a5f33;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(6px);
        transition: all 0.25s ease;
    }

    .infra-zoom-card:hover .zoom-hint {
        opacity: 1;
        transform: translateY(0);
    }

    .infra-lightbox {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(10, 10, 12, 0.88);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .infra-lightbox.is-open { display: flex; }

    .infra-lightbox img {
        max-width: min(1100px, 94vw);
        max-height: 86vh;
        border-radius: 12px;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
        object-fit: contain;
    }

    .infra-lightbox-close {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        font-size: 1.4rem;
        cursor: pointer;
    }

    .infra-cta {
        background: linear-gradient(135deg, #f7f6f3 0%, #efeae2 100%);
        border-top: 1px solid rgba(15, 15, 17, 0.06);
        padding: 4.5rem 0;
        text-align: center;
    }

    .infra-cta h2 {
        margin: 0 0 0.75rem !important;
        color: #121214 !important;
        font-family: 'Outfit', sans-serif !important;
        font-size: clamp(1.6rem, 2.2vw, 2.1rem) !important;
    }

    .infra-cta p {
        margin: 0 auto 1.5rem;
        max-width: 560px;
        color: #5f5f68 !important;
        line-height: 1.65;
    }

    .infra-cta .btn-row {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    @media (max-width: 991px) {
        .infra-split,
        .infra-split.reverse {
            grid-template-columns: 1fr;
            direction: ltr;
        }
        .infra-gallery {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .infra-media { height: 280px; }
    }

    @media (max-width: 640px) {
        .infra-gallery { grid-template-columns: 1fr; }
        .infra-checklist { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
@php
    $processingImages = [
        'assets/images/infra/infra-01.jpg',
        'assets/images/infra/infra-02.jpg',
        'assets/images/infra/infra-03.jpg',
        'assets/images/infra/infra-04.jpg',
        'assets/images/infra/infra-05.jpg',
        'assets/images/infra/infra-06.jpg',
        'assets/images/infra/infra-07.jpg',
        'assets/images/infra/infra-08.jpg',
        'assets/images/infra/infra-09.jpg',
    ];
    $stockyardImages = [
        'assets/images/infra/infra-10.jpg',
        'assets/images/infra/infra-11.jpg',
        'assets/images/infra/infra-12.jpg',
        'assets/images/infra/infra-13.jpg',
        'assets/images/infra/infra-14.jpg',
        'assets/images/infra/infra-15.jpg',
        'assets/images/infra/infra-16.jpg',
        'assets/images/infra/infra-17.jpg',
        'assets/images/infra/infra-18.jpg',
    ];
@endphp

<div class="infra-page">
    @if(!empty($infraPage) && !empty($infraPage->description) && trim(strip_tags($infraPage->description)) !== '')
        <section class="section" style="padding: 6rem 0; background: #f4f2ed;">
            <div class="container animate-on-scroll" style="max-width: 900px; margin: 0 auto;">
                <div class="blog-content" style="line-height: 1.8; font-size: 1.05rem; color: #4a4a52;">
                    {!! $infraPage->description !!}
                </div>
            </div>
        </section>
    @else

    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/infra/infra-hero.jpg') }}" alt="Stone Hub India factory and processing yard" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">WORLD-CLASS INDUSTRIAL CAPABILITY</span>
            <h1>Our Infrastructure</h1>
            <p>Stone Hub India operates one of the most advanced natural stone processing facilities in Kishangarh, Rajasthan, matching Italian standard processing benchmarks.</p>
        </div>
    </section>

    <section class="infra-section">
        <div class="container infra-split">
            <div class="infra-copy animate-on-scroll">
                <span class="infra-eyebrow">01. Global Quarry Sourcing</span>
                <h2>Direct Sourcing from 12+ Countries</h2>
                <p>Our curators travel directly to quarries across Italy, Greece, Turkey, Spain, and Brazil to inspect standing blocks. We look for unique vein density, crystal structures, and durability factors to ensure that only premium raw blocks are shipped to our Kishangarh factory.</p>
                <div class="infra-checklist">
                    <span><i data-lucide="check" style="width:16px;height:16px;color:#8a6d3b;"></i> Carrara (Italy)</span>
                    <span><i data-lucide="check" style="width:16px;height:16px;color:#8a6d3b;"></i> Drama (Greece)</span>
                    <span><i data-lucide="check" style="width:16px;height:16px;color:#8a6d3b;"></i> Mugla (Turkey)</span>
                    <span><i data-lucide="check" style="width:16px;height:16px;color:#8a6d3b;"></i> Espirito Santo (Brazil)</span>
                </div>
            </div>
            <div class="infra-media animate-on-scroll">
                <img src="{{ asset('assets/images/infra/infra-04.jpg') }}" alt="Imported marble block sourcing" loading="lazy">
            </div>
        </div>
    </section>

    <section class="infra-section alt">
        <div class="container infra-split reverse">
            <div class="infra-media animate-on-scroll">
                <img src="{{ asset('assets/images/infra/infra-01.jpg') }}" alt="Kishangarh processing plant" loading="lazy">
            </div>
            <div class="infra-copy animate-on-scroll">
                <span class="infra-eyebrow">02. Kishangarh Processing Hub</span>
                <h2>Italian Slabs Processing Technology</h2>
                <p>Once blocks arrive at our state-of-the-art processing facility in Kishangarh, they undergo rigorous cutting and reinforced treatments:</p>
                <ul class="infra-steps">
                    <li>
                        <span class="num">1</span>
                        <div>
                            <strong>Computerized Gang Saws</strong>
                            <p>Accurate, thin cutting with wire saws to ensure constant thickness variations under 0.5mm.</p>
                        </div>
                    </li>
                    <li>
                        <span class="num">2</span>
                        <div>
                            <strong>Automated Epoxy Resin Lines</strong>
                            <p>Reinforcement grids and premium grade epoxy polymers baked under warm infrared chambers to double strength.</p>
                        </div>
                    </li>
                    <li>
                        <span class="num">3</span>
                        <div>
                            <strong>36-Head Automated Polishing</strong>
                            <p>Diamond polishing heads progressively grit-polished to deliver a perfect, mirror-like gloss factor.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="infra-section">
        <div class="container infra-split">
            <div class="infra-copy animate-on-scroll">
                <span class="infra-eyebrow">03. Stockyard & Inventory</span>
                <h2>Over 2 Million Sqft of Instant Stock</h2>
                <p>With stockyards spanning acres in Rajasthan, we keep a vast inventory of standing, bookmatched slabs ready for immediate inspection and shipping. Builders, architects, and luxury property developers can rely on us to deliver large-scale project materials immediately.</p>
                <div class="infra-note">
                    <h4>Safe Packaging & Shipping</h4>
                    <p style="margin:0;">Slabs are packed in bespoke heavy-duty timber A-frames and loaded using heavy gantry cranes. We offer fully-insured transit to ensure your stone arrives without micro-fractures directly to your site.</p>
                </div>
            </div>
            <div class="infra-media animate-on-scroll">
                <img src="{{ asset('assets/images/infra/infra-12.jpg') }}" alt="Stone Hub India stockyard" loading="lazy">
            </div>
        </div>
    </section>

    <section class="infra-gallery-wrap" id="infra-gallery">
        <div class="container">
            <div class="infra-gallery-head animate-on-scroll">
                <span class="infra-eyebrow" style="text-align:center;">Facility Gallery</span>
                <h2>Processing Unit & Stock Yard</h2>
                <p>Photos from our Kishangarh facility — hover to zoom, click to view full size.</p>
            </div>

            <div class="infra-tabs">
                <button type="button" class="infra-tab is-active" data-gallery="processing">Processing Unit</button>
                <button type="button" class="infra-tab" data-gallery="stockyard">Stock Yard</button>
            </div>

            <div class="infra-gallery" id="gallery-processing">
                @foreach($processingImages as $img)
                    <a href="{{ asset($img) }}" class="infra-zoom-card" data-lightbox="infra">
                        <img src="{{ asset($img) }}" alt="Stone Hub India processing unit" loading="lazy">
                        <span class="zoom-hint"><i data-lucide="zoom-in" style="width:16px;height:16px;"></i></span>
                    </a>
                @endforeach
            </div>

            <div class="infra-gallery" id="gallery-stockyard" style="display:none;">
                @foreach($stockyardImages as $img)
                    <a href="{{ asset($img) }}" class="infra-zoom-card" data-lightbox="infra">
                        <img src="{{ asset($img) }}" alt="Stone Hub India stock yard" loading="lazy">
                        <span class="zoom-hint"><i data-lucide="zoom-in" style="width:16px;height:16px;"></i></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="infra-cta">
        <div class="container animate-on-scroll">
            <h2>Experience Curation Quality Live</h2>
            <p>Get in touch with our factory representatives to receive live block photos or request a guided tour.</p>
            <div class="btn-row">
                <button onclick="openDialog('callback-dialog');" class="btn btn-primary">Request Live Photos</button>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Locate Showroom</a>
            </div>
        </div>
    </section>
    @endif
</div>

<div class="infra-lightbox" id="infra-lightbox" aria-hidden="true">
    <button type="button" class="infra-lightbox-close" id="infra-lightbox-close" aria-label="Close">&times;</button>
    <img src="" alt="Infrastructure preview" id="infra-lightbox-img">
</div>

<script>
(() => {
    const tabs = document.querySelectorAll('.infra-tab');
    const processing = document.getElementById('gallery-processing');
    const stockyard = document.getElementById('gallery-stockyard');
    const lightbox = document.getElementById('infra-lightbox');
    const lightboxImg = document.getElementById('infra-lightbox-img');
    const closeBtn = document.getElementById('infra-lightbox-close');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('is-active'));
            tab.classList.add('is-active');
            const target = tab.getAttribute('data-gallery');
            if (processing) processing.style.display = target === 'processing' ? 'grid' : 'none';
            if (stockyard) stockyard.style.display = target === 'stockyard' ? 'grid' : 'none';
        });
    });

    document.querySelectorAll('[data-lightbox="infra"]').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (!lightbox || !lightboxImg) return;
            lightboxImg.src = link.getAttribute('href');
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
        });
    });

    const closeLightbox = () => {
        if (!lightbox) return;
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        if (lightboxImg) lightboxImg.src = '';
    };

    closeBtn?.addEventListener('click', closeLightbox);
    lightbox?.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
})();
</script>
@endsection
