@extends('smac.layout')

@section('title', $blog->metatitle ?: ($blog->title . ' | SMAC Digital'))
@section('meta_description', $blog->metadescription ?: (Str::limit(strip_tags($blog->summary ?: $blog->content), 160)))
@section('meta_keywords', $blog->metakeywords ?: ($blog->category . ', SMAC Digital, Digital Marketing'))
@section('og_type', 'article')
@section('og_image', $blog->image_path ? asset($blog->image_path) : asset('assets/blog/d2c-shopify.png'))

@section('extra_head')
@if(!empty($blog->schema_markup))
  {!! $blog->schema_markup !!}
@else
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BlogPosting",
  "headline": "{{ addslashes($blog->title) }}",
  "description": "{{ addslashes(Str::limit(strip_tags($blog->summary ?: $blog->content), 160)) }}",
  "image": "{{ $blog->image_path ? asset($blog->image_path) : asset('assets/blog/d2c-shopify.png') }}",
  "datePublished": "{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}",
  "dateModified": "{{ $blog->updated_at ? $blog->updated_at->toIso8601String() : $blog->created_at->toIso8601String() }}",
  "author": {
    "@@type": "Organization",
    "name": "SMAC Digital",
    "url": "{{ url('/') }}"
  },
  "publisher": {
    "@@type": "Organization",
    "name": "SMAC Digital",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ asset('assets/brand/logo-white.png') }}"
    }
  },
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ url()->current() }}"
  }
}
</script>
@endif
@endsection

@section('content')
<section class="hero inner-hero blog-detail-hero" aria-labelledby="post-title">
  <div class="hero-stage" aria-hidden="true">
    <div class="hero-grid"></div>
  </div>
  <div class="wrap hero-copy">
    <p class="pill">{{ $blog->category ?? 'Digital Marketing' }}</p>
    <h1 id="post-title">{{ $blog->title }}</h1>
    <p class="lede blog-detail-meta">
      <time datetime="{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : '' }}">{{ $blog->published_at ? $blog->published_at->format('d M Y') : '' }}</time>
      <span aria-hidden="true">&middot;</span>
      <span>By SMAC Digital</span>
    </p>
    <div class="hero-actions">
      <a class="btn btn-white" href="{{ url('/blog') }}">All posts</a>
      <span class="or" aria-hidden="true">or</span>
      <button type="button" class="btn btn-black" data-open-lead-modal>Get a free consultation</button>
    </div>
  </div>
</section>

<article class="page-section blog-detail">
  <div class="wrap blog-detail-inner">
    @if(!empty($blog->image_path))
    <figure class="blog-detail-cover media-reveal">
      <img src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}" width="1200" height="720" loading="eager" onerror="this.onerror=null;this.src='{{ asset('assets/blog/d2c-shopify.png') }}';">
    </figure>
    @endif

    <div class="blog-detail-body">
      {!! $blog->content !!}

      <div class="blog-detail-foot">
        <a class="btn btn-primary" href="{{ url('/blog') }}">← Back to blog</a>
        <a class="btn btn-navy" href="{{ url('/contact') }}">Talk to our team</a>
      </div>
    </div>
  </div>
</article>

@if(isset($relatedBlogs) && $relatedBlogs->isNotEmpty())
<section class="page-section page-section-tint">
  <div class="wrap">
    <header class="page-blog-head">
      <p class="page-eyebrow dark">Related reading</p>
      <h2>More from SMAC Digital</h2>
    </header>
    <div class="page-blog-grid">
      @foreach($relatedBlogs as $rel)
      <a class="page-blog-card" href="{{ url('/blogs/' . $rel->slug) }}">
        <span class="page-blog-card-media">
          <img src="{{ $rel->image_path ? asset($rel->image_path) : asset('assets/blog/d2c-shopify.png') }}" alt="{{ $rel->title }}" width="640" height="400" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('assets/blog/d2c-shopify.png') }}';">
        </span>
        <span class="page-blog-card-body">
          <span class="page-blog-card-meta">
            <em>{{ $rel->category ?? 'Digital Marketing' }}</em>
            <time datetime="{{ $rel->published_at ? $rel->published_at->format('Y-m-d') : '' }}">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</time>
          </span>
          <strong>{{ $rel->title }}</strong>
          <span class="page-blog-card-excerpt">{{ Str::limit(strip_tags($rel->summary ?: $rel->content), 140) }}</span>
          <span class="page-blog-card-go">Read article →</span>
        </span>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- Bottom CTA Banner matching SMAC Digital Single Blog Design -->
<section class="about-cta about-cta--red" aria-labelledby="post-cta-title">
  <div class="about-cta-pattern" aria-hidden="true"></div>
  <div class="wrap about-cta-inner">
    <div class="about-cta-copy">
      <p class="pill">Next step</p>
      <h2 id="post-cta-title">
        Ready to put this into practice?
        <em>Let's talk growth.</em>
      </h2>
      <p>SMAC Digital helps brands turn strategy into pipeline — SEO, social, content, and performance under one roof.</p>
      <div class="about-cta-actions">
        <a class="btn btn-white" href="{{ url('/contact') }}">Get a free consultation</a>
        <span class="or" aria-hidden="true">or</span>
        <a class="btn btn-black" href="{{ url('/portfolios') }}">See the work</a>
      </div>
    </div>
    <aside class="about-cta-panel about-cta-panel--creative">
      <div class="about-cta-panel-glow" aria-hidden="true"></div>
      <div class="about-cta-panel-top">
        <span class="about-cta-live"><i></i> Available now</span>
        <p class="about-cta-kicker">Prefer a direct call?</p>
      </div>
      <div class="about-cta-phones">
        <a class="about-cta-phone" href="tel:{{ preg_replace('/[^0-9+]/', '', $parameters['phone_delhi'] ?? $parameters['whatsapp_number'] ?? '+919582792638') }}">
          <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
          <span>
            <small>Delhi NCR</small>
            <strong>{{ $parameters['phone_delhi'] ?? '+91 95827 92638' }}</strong>
          </span>
        </a>
        <a class="about-cta-phone" href="tel:{{ preg_replace('/[^0-9+]/', '', $parameters['phone_jaipur'] ?? $parameters['primary_phone'] ?? '+919829069519') }}">
          <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
          <span>
            <small>Jaipur</small>
            <strong>{{ $parameters['phone_jaipur'] ?? '+91 98290 69519' }}</strong>
          </span>
        </a>
      </div>
      <a class="about-cta-wa" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $parameters['whatsapp_number'] ?? '919582792638') }}" target="_blank" rel="noopener noreferrer">
        <span class="about-cta-wa-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg></span>
        <span>
          <strong>WhatsApp the team</strong>
          <small>Usually replies in minutes</small>
        </span>
      </a>
    </aside>
  </div>
</section>
@endsection
