@extends('layouts.app')

@section('title', !empty(trim($blog->metatitle ?? '')) ? $blog->metatitle : ($blog->title . ' | ' . ($site['site_name'] ?? 'Stone Hub India')))
@section('meta_description', !empty(trim($blog->metadescription ?? '')) ? $blog->metadescription : ($blog->summary ?? ($site['site_meta_description'] ?? '')))
@section('meta_keywords', !empty(trim($blog->metakeywords ?? '')) ? $blog->metakeywords : ($site['site_meta_keywords'] ?? ''))
@section('og_image', !empty($blog->image_path) ? site_image($blog->image_path) : '')

@section('schema')
    @if(!empty($blog->schema_markup))
        {!! $blog->schema_markup !!}
    @else
        <script type="application/ld+json">
        {
          "{{ '@' }}context": "https://schema.org",
          "{{ '@graph' }}": [
            {
              "{{ '@type' }}": "BlogPosting",
              "{{ '@id' }}": "{{ route('blog.show', $blog->slug) }}/#post",
              "headline": "{{ $blog->title }}",
              "description": "{{ $blog->summary }}",
              "datePublished": "{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}",
              "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
              "mainEntityOfPage": "{{ route('blog.show', $blog->slug) }}",
              "image": "{{ $blog->image_path ? site_image($blog->image_path) : asset('assets/images/blog-default.jpg') }}",
              "author": {
                "{{ '@type' }}": "Organization",
                "name": "Stone Hub Curator Team",
                "url": "{{ route('home') }}"
              },
              "publisher": {
                "{{ '@type' }}": "Organization",
                "{{ '@id' }}": "{{ route('home') }}/#organization",
                "name": "{{ $site['site_name'] ?? 'Stone Hub India' }}",
                "url": "{{ route('home') }}"
              }
            }
          ]
        }
        </script>
    @endif
@endsection

@section('content')

    <header class="blog-article-header" style="padding: 100px 0 40px; background: #f4f2ed; text-align: center; border-bottom: 1px solid rgba(15,15,17,0.06);">
        <div class="container">
            <span style="color: #8a6d3b; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 0.85rem;">{{ $blog->category ?? 'Stone Curation' }}</span>
            <h1 style="margin-top: 10px; font-size: clamp(1.8rem, 3vw, 2.6rem); color: #121214 !important; font-family: 'Outfit', sans-serif !important; font-weight: 750;">{{ $blog->title }}</h1>
            <div class="blog-article-meta" style="margin-top: 15px; color: #666671; font-size: 0.9rem;">
                <span>Published on</span>
                <span>•</span>
                <span>{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
            </div>
        </div>
    </header>

    <article class="blog-article-body" style="max-width: 800px; margin: 40px auto; padding: 0 20px 4rem; line-height: 1.8; color: #4a4a52; background-color: transparent;">
        @if($blog->image_path)
            <div style="margin-bottom: 30px; border-radius: 16px; overflow: hidden; border: 1px solid rgba(15,15,17,0.06); box-shadow: 0 10px 28px rgba(15,15,17,0.06);">
                <img src="{{ site_image($blog->image_path) }}" alt="{{ $blog->title }}" style="width: 100%; height: auto; max-height: 450px; object-fit: cover;">
            </div>
        @endif
        
        <div class="blog-content animate-on-scroll" style="font-size: 1.08rem; color: #3a3a42;">
            {!! $blog->content !!}
        </div>

        <div style="background-color: #fff; padding: 2rem; border-radius: 14px; border-left: 4px solid var(--accent-gold); margin: 3rem 0; border-top: 1px solid rgba(15,15,17,0.06); border-right: 1px solid rgba(15,15,17,0.06); border-bottom: 1px solid rgba(15,15,17,0.06); box-shadow: 0 8px 24px rgba(15,15,17,0.04);">
            <h3 style="margin-bottom:0.5rem; color: #121214 !important; font-family: 'Outfit', sans-serif !important; font-size: 1.25rem;">Get Our Premium Stone Catalogue</h3>
            <p style="font-size:0.95rem; color:#5f5f68; margin-bottom:1.5rem;">Explore our comprehensive collection of Italian marble, quartzite, onyx, and travertine with detailed specifications and sizing.</p>
            <button onclick="openDialog('callback-dialog');" class="btn btn-primary" style="background: var(--accent-gold); border-color: var(--accent-gold); color: #0b0b0c; font-weight: bold;">Request Catalogue</button>
        </div>
    </article>

@endsection
