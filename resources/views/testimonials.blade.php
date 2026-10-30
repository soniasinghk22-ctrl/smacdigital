@extends('layouts.app')

@section('title', ($testimonialsPage->metatitle ?? 'Client Reviews & Testimonials | Stone Hub India'))
@section('meta_description', ($testimonialsPage->meta_description ?? 'Read reviews and feedback from architects, designers, and luxury homeowners who curated natural stone slabs with Stone Hub India.'))
@section('meta_keywords', ($testimonialsPage->metakeywords ?? 'stone hub reviews, client testimonials, imported marble feedback'))

@section('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@graph' }}": [
    {
      "{{ '@type' }}": "WebPage",
      "{{ '@id' }}": "{{ route('testimonials') }}/#webpage",
      "url": "{{ route('testimonials') }}",
      "name": "Client Testimonials | {{ $site['site_name'] ?? 'Stone Hub India' }}",
      "isPartOf": {
        "{{ '@type' }}": "WebSite",
        "{{ '@id' }}": "{{ route('home') }}/#organization"
      }
    }
  ]
}
</script>
@endsection

@section('styles')
<style>
    .testimonials-page { background: #f4f2ed; }
    .testimonials-section { background: #f4f2ed; padding: 4rem 0 5rem; }
    .testimonial-card {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.07);
        border-radius: 16px;
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        box-shadow: 0 8px 24px rgba(15,15,17,0.04);
        height: 100%;
    }
    .testimonial-card .quote {
        color: #4a4a52 !important;
        font-style: italic;
        line-height: 1.65;
        margin: 0 0 1.35rem;
        flex-grow: 1;
    }
    .testimonial-card h4 {
        font-size: 0.95rem !important;
        color: #121214 !important;
        font-weight: 700 !important;
        margin: 0 !important;
        font-family: 'Outfit', sans-serif !important;
    }
    .testimonials-cta {
        background: linear-gradient(135deg, #f7f6f3 0%, #efeae2 100%);
        padding: 4.5rem 0;
        border-top: 1px solid rgba(15,15,17,0.06);
        text-align: center;
    }
    .testimonials-cta h2 {
        color: #121214 !important;
        font-size: clamp(1.6rem, 2.2vw, 2.1rem) !important;
        font-family: 'Outfit', sans-serif !important;
        margin: 0 0 0.75rem !important;
    }
    .testimonials-cta p {
        color: #5f5f68 !important;
        font-size: 1.05rem;
        line-height: 1.6;
        margin: 0 auto 1.75rem;
        max-width: 560px;
    }
</style>
@endsection

@section('content')
<div class="testimonials-page">
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-testimonials.webp') }}" alt="Luxury stone interiors by Stone Hub India clients" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">CLIENT EXPERIENCES</span>
            <h1>What Our Clients Say</h1>
            <p>Read real feedback from leading architects, interior designers, and luxury homeowners who transformed their spaces with our curated natural stones.</p>
        </div>
    </section>

    <section class="testimonials-section">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.25rem;">
                @forelse($testimonials as $test)
                    <div class="testimonial-card animate-on-scroll">
                        <div style="color: var(--accent-gold); margin-bottom: 0.85rem; font-size: 1.1rem; letter-spacing: 1px;">
                            @for($i = 0; $i < $test->rating; $i++)★@endfor
                        </div>
                        <p class="quote">"{{ $test->content }}"</p>
                        <div style="display: flex; align-items: center; gap: 12px; margin-top: auto; border-top: 1px solid rgba(15,15,17,0.06); padding-top: 1rem;">
                            <div style="width:40px; height:40px; border-radius:50%; background-color:rgba(197,168,128,0.16); display:flex; align-items:center; justify-content:center; color:#8a6d3b; font-weight:bold; overflow:hidden;">
                                @if($test->avatar_path)
                                    <img src="{{ site_image($test->avatar_path) }}" alt="{{ $test->name }}" style="width:100%; height:100%; object-fit:cover;">
                                @else
                                    {{ substr($test->name, 0, 2) }}
                                @endif
                            </div>
                            <div>
                                <h4>{{ $test->name }}</h4>
                                <p style="font-size:0.8rem; color:#8a6d3b; margin: 2px 0 0 0;">{{ $test->role }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align:center; padding: 3rem; color:#666671;">
                        <p>Client reviews will appear here soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="testimonials-cta">
        <div class="container animate-on-scroll">
            <h2>Discover Natural Masterpieces Today</h2>
            <p>Connect with our curators to get your copy of our marble catalogue or to schedule a showroom visit.</p>
            <div style="display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                <button onclick="openDialog('callback-dialog');" class="btn btn-primary" style="background: var(--accent-gold); border-color: var(--accent-gold); color: #0b0b0c; font-weight: 700;">Request Catalogue</button>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Contact Showroom</a>
            </div>
        </div>
    </section>
</div>
@endsection
