@extends('layouts.app')

@section('title', ($blogsPage->metatitle ?? 'Design Journals & Stone Guides | Stone Hub India'))
@section('meta_description', ($blogsPage->metadescription ?? 'Explore our curation journals and guides on luxury marble selection, stone restoration, interior trends, and premium quartzite architecture.'))
@section('meta_keywords', ($blogsPage->metakeywords ?? 'stone journals, marble guides, interior stone design, imported marble architecture'))

@section('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@graph' }}": [
    {
      "{{ '@type' }}": "Blog",
      "{{ '@id' }}": "{{ route('blog') }}/#blog",
      "url": "{{ route('blog') }}",
      "name": "Design Journals & Stone Guides | Stone Hub India",
      "description": "Explore our curation journals and guides on luxury marble selection, stone restoration, interior trends, and premium quartzite architecture.",
      "publisher": {
        "{{ '@type' }}": "Organization",
        "{{ '@id' }}": "{{ route('home') }}/#organization"
      }
    }
  ]
}
</script>
@endsection

@section('content')

<section class="page-hero">
    <div class="page-hero-media">
        <img src="{{ asset('assets/images/pages/hero-blog.webp') }}" alt="Stone design journal imagery" loading="eager">
    </div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
        <span class="page-hero-eyebrow">DESIGN JOURNALS</span>
        <h1>Stone Curation & Design Journal</h1>
        <p>Articles, selection guides, maintenance tips, and luxury design trends from our natural stone experts.</p>
    </div>
</section>

<!-- Blog Grid -->
<section class="section" style="background: #f4f2ed; padding: 4rem 0 5rem;">
    <div class="container blog-grid animate-on-scroll" id="blogs-wrapper">
        @forelse($blogs as $blog)
            @include('blog.partials.card', ['blog' => $blog])
        @empty
            <div class="text-center" id="empty-blogs-msg" style="grid-column: 1 / -1; padding: 40px; color: #666671;">
                <p>No design journals found at the moment. Please check back later.</p>
            </div>
        @endforelse
    </div>
    
    <div id="blogs-loading" style="text-align: center; display: none; padding: 3rem 1rem 1rem 1rem;">
        <span style="color: #8a6d3b; font-weight: 600; font-size: 1.1rem; letter-spacing: 1px;">Loading more design journals...</span>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let nextPageUrl = "{{ $blogs->nextPageUrl() }}";
    let loading = false;
    
    const wrapper = document.getElementById('blogs-wrapper');
    const loader = document.getElementById('blogs-loading');
 
    window.addEventListener('scroll', function() {
        if (!nextPageUrl || loading) return;
        
        // If scroll reaches near bottom of the viewport
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 800) {
            loading = true;
            loader.style.display = 'block';
 
            fetch(nextPageUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(res => {
                nextPageUrl = res.next_page;
                
                // Append new card elements
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = res.html;
                
                // Append children one by one
                while (tempDiv.firstChild) {
                    wrapper.appendChild(tempDiv.firstChild);
                }
                
                // Re-initialize lucide icons for newly loaded content if lucide is present
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
 
                loading = false;
                loader.style.display = 'none';
            })
            .catch(err => {
                console.error('Error loading page:', err);
                loading = false;
                loader.style.display = 'none';
            });
        }
    });
});
</script>

@endsection
