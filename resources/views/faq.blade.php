@extends('layouts.app')

@section('title', ($faqPage->metatitle ?? ('Frequently Asked Questions | ' . ($site['site_name'] ?? 'Stone Hub India'))))
@section('meta_description', ($faqPage->metadescription ?? 'Find answers to frequently asked questions about imported marble collections, quartzite slabs, delivery logistics, custom bookmatching, and stockyard processing at Stone Hub India.'))
@section('meta_keywords', ($faqPage->metakeywords ?? 'imported marble faq, quartzite slabs query, stone hub india support'))

@section('schema')
@if(!empty($faqPage->schema_markup))
    {!! $faqPage->schema_markup !!}
@else
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@graph' }}": [
    {
      "{{ '@type' }}": "FAQPage",
      "{{ '@id' }}": "{{ route('faq') }}/#faq",
      "mainEntity": [
        {
          "{{ '@type' }}": "Question",
          "name": "How do you ensure the quality of imported marble slabs?",
          "acceptedAnswer": {
            "{{ '@type' }}": "Answer",
            "text": "We visit international quarries block-by-block and hand-select only the top 5% of slabs based on structural integrity, color consistency, and vein clarity."
          }
        },
        {
          "{{ '@type' }}": "Question",
          "name": "What is the typical thickness of your marble and quartzite slabs?",
          "acceptedAnswer": {
            "{{ '@type' }}": "Answer",
            "text": "Our standard imported marble slabs are processed to 18mm thickness, while exotic quartzites are available in 20mm thickness, ensuring maximum structural strength and durability."
          }
        },
        {
          "{{ '@type' }}": "Question",
          "name": "Where is your stockyard located? Can we view slabs in person?",
          "acceptedAnswer": {
            "{{ '@type' }}": "Answer",
            "text": "Yes, our experience center and stockyards are located in Kishangarh, Rajasthan (India's premier marble hub). We welcome architects, interior designers, and homeowners to inspect slabs block-by-block."
          }
        },
        {
          "{{ '@type' }}": "Question",
          "name": "Do you provide custom bookmatching for signature accent walls?",
          "acceptedAnswer": {
            "{{ '@type' }}": "Answer",
            "text": "Yes, we specialize in high-precision bookmatching where consecutive slab cuts are mirror-polished to form spectacular, symmetric feature murals."
          }
        }
      ]
    }
  ]
}
</script>
@endif
@endsection

@section('styles')
<style>
    .faq-page-wrap { background: #f4f2ed; }
    .faq-section { background: #f4f2ed; padding: 4rem 0 5rem; }
    .faq-item {
        background: #fff;
        border: 1px solid rgba(15,15,17,0.07);
        border-radius: 14px;
        padding: 1.35rem 1.5rem;
        box-shadow: 0 8px 24px rgba(15,15,17,0.04);
    }
    .faq-item h3 {
        color: #121214 !important;
        font-size: 1.12rem !important;
        font-family: 'Outfit', sans-serif !important;
        font-weight: 700 !important;
        margin: 0 0 0.65rem !important;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        line-height: 1.4;
    }
    .faq-item p {
        color: #5f5f68 !important;
        font-size: 0.95rem;
        line-height: 1.65;
        margin: 0 0 0 30px;
    }
</style>
@endsection

@section('content')
<div class="faq-page-wrap">
    @if(!empty($faqPage) && !empty($faqPage->description) && trim(strip_tags($faqPage->description)) !== '')
        <section class="section" style="padding: 6rem 0; background: #f4f2ed;">
            <div class="container animate-on-scroll" style="max-width: 900px; margin: 0 auto;">
                <div class="blog-content" style="line-height: 1.8; font-size: 1.05rem; color: #4a4a52;">
                    {!! $faqPage->description !!}
                </div>
            </div>
        </section>
    @else

    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-faq.webp') }}" alt="Premium marble slabs FAQ" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">KNOWLEDGE HUB</span>
            <h1>Frequently Asked Questions</h1>
            <p>Everything you need to know about global quarry sourcing, slab processing, delivery logistics, and design integration.</p>
        </div>
    </section>

    <section class="faq-section">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <div class="faq-accordion" style="display: grid; gap: 1rem;">
                <div class="faq-item">
                    <h3>
                        <i data-lucide="help-circle" style="color: var(--accent-gold); width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
                        How do you ensure the quality of imported marble slabs?
                    </h3>
                    <p>We visit international quarries block-by-block and hand-select only the top 5% of slabs based on structural integrity, color consistency, and vein clarity.</p>
                </div>
                <div class="faq-item">
                    <h3>
                        <i data-lucide="help-circle" style="color: var(--accent-gold); width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
                        What is the typical thickness of your marble and quartzite slabs?
                    </h3>
                    <p>Our standard imported marble slabs are processed to 18mm thickness, while exotic quartzites are available in 20mm thickness, ensuring maximum structural strength and durability.</p>
                </div>
                <div class="faq-item">
                    <h3>
                        <i data-lucide="help-circle" style="color: var(--accent-gold); width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
                        Where is your stockyard located? Can we view slabs in person?
                    </h3>
                    <p>Yes, our experience center and stockyards are located in Kishangarh, Rajasthan (India's premier marble hub). We welcome architects, interior designers, and homeowners to inspect slabs block-by-block.</p>
                </div>
                <div class="faq-item">
                    <h3>
                        <i data-lucide="help-circle" style="color: var(--accent-gold); width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
                        Do you provide custom bookmatching for signature accent walls?
                    </h3>
                    <p>Yes, we specialize in high-precision bookmatching where consecutive slab cuts are mirror-polished to form spectacular, symmetric feature murals.</p>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
