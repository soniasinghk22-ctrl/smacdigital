<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', $seo['title'] ?? ($page->metatitle ?? 'Best Performing Digital Marketing Agency in India | SMAC Digital'))</title>
  <meta name="description" content="@yield('meta_description', $seo['description'] ?? ($page->metadescription ?? 'Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers. Get quotes for customized SEO, Social Media, and Online ADS proposal for your brand now.'))">
  <meta name="keywords" content="@yield('meta_keywords', $seo['keywords'] ?? ($page->metakeywords ?? 'Best Digital Marketing Agency in India, Social Media Marketing in India, SMAC Digital'))">
  <link rel="canonical" href="@yield('canonical', url()->current())">
  
  <!-- Open Graph -->
  <meta property="og:title" content="@yield('title', $seo['title'] ?? ($page->metatitle ?? 'Best Performing Digital Marketing Agency in India | SMAC Digital'))">
  <meta property="og:description" content="@yield('meta_description', $seo['description'] ?? ($page->metadescription ?? 'Performance-driven digital marketing agency across India and the US.'))">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:site_name" content="{{ $parameters['site_name'] ?? 'SMAC Digital' }}">
  <meta property="og:locale" content="en-IN">
  <meta property="og:image" content="@yield('og_image', asset($parameters['logo_path'] ?? 'assets/brand/logo-white.png'))">

  <link rel="icon" href="{{ asset($parameters['favicon_path'] ?? 'assets/brand/favicon.ico') }}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}?v={{ file_exists(public_path('style.css')) ? filemtime(public_path('style.css')) : time() }}">

  @if(!empty($page->schema_markup))
    {!! $page->schema_markup !!}
  @else
  <script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "ProfessionalService",
    "name": "{{ $parameters['site_name'] ?? 'SMAC Digital' }}",
    "url": "{{ url('/') }}",
    "image": "{{ asset($parameters['logo_path'] ?? 'assets/brand/logo-white.png') }}",
    "description": "Performance-driven digital marketing agency. SMAC stands for Social, Mobile, Analytics, and Cloud.",
    "email": "{{ $parameters['primary_email'] ?? 'Jitendra@smacdigital.com' }}",
    "telephone": "{{ $parameters['primary_phone'] ?? '+91-9829069519' }}",
    "areaServed": "IN",
    "sameAs": [
      "{{ $parameters['social_facebook'] ?? 'https://www.facebook.com/smacdigi' }}",
      "{{ $parameters['social_linkedin'] ?? 'https://www.linkedin.com/company/smac-digital-pvt-ltd' }}",
      "{{ $parameters['social_twitter'] ?? 'https://twitter.com/DigitalSmac' }}",
      "{{ $parameters['social_instagram'] ?? 'https://www.instagram.com/smacdigital/' }}"
    ],
    "address": [
      {
        "@@type": "PostalAddress",
        "streetAddress": "Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar",
        "addressLocality": "Jaipur",
        "addressRegion": "Rajasthan",
        "postalCode": "302020",
        "addressCountry": "IN"
      },
      {
        "@@type": "PostalAddress",
        "streetAddress": "Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur",
        "addressLocality": "Kolkata",
        "postalCode": "700099",
        "addressCountry": "IN"
      }
    ]
  }
  </script>
  @endif

  @yield('extra_head')
</head>
<body class="@yield('body_class', 'page-body')" id="top">
  <a class="skip-link" href="#main">Skip to content</a>

  <header class="site-header" data-header>
    <div class="wrap header-bar">
      <a class="logo" href="{{ url('/') }}" aria-label="SMAC Digital, home">
        <img src="{{ asset($parameters['logo_path'] ?? 'assets/brand/logo-white.png') }}" width="150" height="43" alt="{{ $parameters['site_name'] ?? 'SMAC Digital' }}">
      </a>

      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
        <span class="nav-toggle-lines" aria-hidden="true"></span>
        <span class="visually-hidden">Menu</span>
      </button>

      <nav class="site-nav" id="site-nav" data-nav aria-label="Primary">
        <ul class="nav-list">
          @if(isset($headerMenus) && $headerMenus->isNotEmpty())
            @foreach($headerMenus as $mItem)
              @if(strtolower($mItem->title) === 'services')
                <li class="has-mega">
                  <button class="nav-parent" type="button" aria-expanded="false" aria-controls="services-menu" data-mega-toggle>{{ $mItem->title }}</button>
                  <div class="mega" id="services-menu">
                    <div class="mega-inner">
                      <aside class="mega-intro">
                        <p class="mega-intro-kicker">{{ $servicesContents['hero']['badge'] ?? 'Services' }}</p>
                        <h3>{!! $servicesContents['hero']['title'] ?? 'Pick a lane.<br>We’ll map the rest.' !!}</h3>
                        <p>{{ $servicesContents['hero']['subtitle'] ?? 'SEO, social, content, and product builds — planned as one growth system.' }}</p>
                        <a class="mega-all" href="{{ url('/services') }}">
                          Browse all services
                          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                      </aside>

                      <div class="mega-grid">
                        @if(isset($megaServices) && $megaServices->isNotEmpty())
                          @foreach($megaServices as $groupName => $groupItems)
                            <div class="mega-col">
                              <p class="mega-label">{{ $groupName }}</p>
                              @foreach($groupItems as $sItem)
                                <a class="mega-item" href="{{ url($sItem->url) }}">
                                  <span class="mega-ico" aria-hidden="true">
                                    {!! service_icon($sItem->icon, $sItem->url ?? $sItem->title) !!}
                                  </span>
                                  <span><strong>{{ $sItem->title }}</strong><em>{{ $sItem->description }}</em></span>
                                </a>
                              @endforeach
                            </div>
                          @endforeach
                        @else
                          <div class="mega-col">
                            <p class="mega-label"><span>01</span> Digital marketing</p>
                            <a class="mega-item" href="{{ url('/services/search-engine-optimization') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Search Engine Optimization</strong><em>Earn a stronger place in search.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/social-media-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="7.5" r="0.8" fill="currentColor"/></svg></span><span><strong>Social Media Marketing</strong><em>Show up where the audience already spends time.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/lead-generation') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 16.5 9 11l3 3 8-8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 6h6v6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Lead Generation</strong><em>Campaigns judged by the inquiries they create.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/inbound-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 4v10" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 11l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 19h14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Inbound Marketing</strong><em>Bring the right people in.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/digital-media-planning') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9.5h17M8 5v4.5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></span><span><strong>Digital Media Planning</strong><em>Decide where attention and budget should work.</em></span></a>
                          </div>
                          <div class="mega-col">
                            <p class="mega-label"><span>02</span> Content and reputation</p>
                            <a class="mega-item" href="{{ url('/services/content-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 4.5h9.5L19 8v11.5H6z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M15 4.5V8h4M8.5 12h7M8.5 15.5h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Content Marketing</strong><em>Give the brand something worth finding.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/video-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="6" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M15.5 10.5 20.5 8v8l-5-2.5z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Video Marketing</strong><em>Show the product in motion, then place the films.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/influencer-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="9" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M4.5 18.5c.8-2.4 2.4-3.5 4.5-3.5s3.7 1.1 4.5 3.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="16.5" cy="9.5" r="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 15c1.6.2 2.8 1 3.5 3" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Influencer Marketing</strong><em>Put the brand with people the audience already trusts.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/online-reputation-management') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.8 14.2 9l5.5.4-4.2 3.5 1.3 5.3L12 15.4 7.2 18.2 8.5 13 4.3 9.4 9.8 9z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Online Reputation Management</strong><em>Shape what people find about the brand.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/social-media-analytics') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 19V5M4 19h16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 15v-3M12 15V8M16 15v-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Social Media Analytics</strong><em>See which activity earns its place.</em></span></a>
                          </div>
                          <div class="mega-col">
                            <p class="mega-label"><span>03</span> Websites and products</p>
                            <a class="mega-item" href="{{ url('/services/website-design-and-development') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Website Design and Development</strong><em>A site that answers a marketing problem.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/mobile-application-development') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="8" y="3.5" width="8" height="17" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M11 18.2h2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Mobile Application Development</strong><em>Meet people on the device they already use.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/marketing-automation') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Marketing Automation</strong><em>Let email and social follow-up keep moving.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/sentiment-analysis') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 14.2c.9 1.2 2.1 1.8 3.5 1.8s2.6-.6 3.5-1.8M9 10h.1M15 10h.1" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Sentiment Analysis</strong><em>Read how people talk about the brand.</em></span></a>
                            <a class="mega-item" href="{{ url('/services/devops-services') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 16.5a3.2 3.2 0 0 1 .4-6.3A4.2 4.2 0 0 1 15.6 8 3.4 3.4 0 0 1 18 14.5H7" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>DevOps Services</strong><em>Keep the product shipping and stable.</em></span></a>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </li>
              @elseif(strtolower($mItem->title) === 'portfolio')
                <li class="has-drop">
                  <button class="nav-parent" type="button" aria-expanded="false" aria-controls="portfolio-menu" data-drop-toggle>{{ $mItem->title }}</button>
                  <div class="drop drop-portfolio" id="portfolio-menu">
                    <div class="drop-portfolio-inner">
                      <div class="drop-portfolio-main">
                        <header class="drop-portfolio-head">
                          <div>
                            <h3>Featured Projects</h3>
                            <p>Explore our portfolio of high-impact digital solutions designed to drive engagement and deliver measurable growth.</p>
                          </div>
                          <a class="drop-portfolio-cta" href="{{ url('/portfolios') }}" data-nav-link>
                            Explore Our Portfolio
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                          </a>
                        </header>
                        <div class="drop-portfolio-grid">
                          <a class="drop-card" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/work/shree-rakhi.jpg') }}" alt="Shree Rakhi gift set display" width="480" height="320" loading="lazy">
                            <span>Shree Rakhi</span>
                          </a>
                          <a class="drop-card" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/work/rhl-preview.jpg') }}" alt="Rajasthan Hospital campus" width="480" height="320" loading="lazy">
                            <span>Rajasthan Hospital</span>
                          </a>
                          <a class="drop-card" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/work/stone-hub.jpg') }}" alt="Stone Hub India showroom" width="480" height="320" loading="lazy">
                            <span>Stone Hub India</span>
                          </a>
                          <a class="drop-card" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/work/kalavaati.jpg') }}" alt="Kalavaati handcrafted ceramics" width="480" height="320" loading="lazy">
                            <span>Kalavaati</span>
                          </a>
                        </div>
                      </div>
                      <aside class="drop-portfolio-side">
                        <p class="drop-side-kicker">Featured Case Studies</p>
                        <a class="drop-side-card" href="{{ url('/portfolios#cases') }}" data-nav-link>
                          <img src="{{ asset('assets/cases/case-1.jpg') }}" alt="" width="420" height="260" loading="lazy">
                          <strong>Don't know what customers want, do you want?</strong>
                          <span>Read case studies</span>
                        </a>
                        <div class="drop-side-links">
                          <a href="{{ url('/testimonials') }}" data-nav-link>Testimonials</a>
                          <a href="{{ url('/portfolios') }}" data-nav-link>All projects</a>
                        </div>
                      </aside>
                    </div>
                  </div>
                </li>
              @else
                <li><a href="{{ url($mItem->url) }}" @if(Request::is(ltrim($mItem->url, '/') . '*')) aria-current="page" @endif data-nav-link>{{ $mItem->title }}</a></li>
              @endif
            @endforeach
          @else
            <li><a href="{{ url('/') }}" @if(Request::is('/')) aria-current="page" @endif data-nav-link>Home</a></li>
            <li><a href="{{ url('/about-us') }}" @if(Request::is('about-us*')) aria-current="page" @endif data-nav-link>About</a></li>
            <li class="has-mega">
              <button class="nav-parent" type="button" aria-expanded="false" aria-controls="services-menu" data-mega-toggle>Services</button>
              <div class="mega" id="services-menu">
                <div class="mega-inner">
                  <aside class="mega-intro">
                    <p class="mega-intro-kicker">Services</p>
                    <h3>Pick a lane.<br>We’ll map the rest.</h3>
                    <p>SEO, social, content, and product builds — planned as one growth system.</p>
                    <a class="mega-all" href="{{ url('/services') }}">
                      Browse all services
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                  </aside>

                  <div class="mega-grid">
                    <div class="mega-col">
                      <p class="mega-label"><span>01</span> Digital marketing</p>
                      <a class="mega-item" href="{{ url('/services/search-engine-optimization') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Search Engine Optimization</strong><em>Earn a stronger place in search.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/social-media-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="7.5" r="0.8" fill="currentColor"/></svg></span><span><strong>Social Media Marketing</strong><em>Show up where the audience already spends time.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/lead-generation') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 16.5 9 11l3 3 8-8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 6h6v6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Lead Generation</strong><em>Campaigns judged by the inquiries they create.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/inbound-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 4v10" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 11l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 19h14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Inbound Marketing</strong><em>Bring the right people in.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/digital-media-planning') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9.5h17M8 5v4.5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></span><span><strong>Digital Media Planning</strong><em>Decide where attention and budget should work.</em></span></a>
                    </div>

                    <div class="mega-col">
                      <p class="mega-label"><span>02</span> Content and reputation</p>
                      <a class="mega-item" href="{{ url('/services/content-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 4.5h9.5L19 8v11.5H6z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M15 4.5V8h4M8.5 12h7M8.5 15.5h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Content Marketing</strong><em>Give the brand something worth finding.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/video-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="6" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M15.5 10.5 20.5 8v8l-5-2.5z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Video Marketing</strong><em>Show the product in motion, then place the films.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/influencer-marketing') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="9" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M4.5 18.5c.8-2.4 2.4-3.5 4.5-3.5s3.7 1.1 4.5 3.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="16.5" cy="9.5" r="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 15c1.6.2 2.8 1 3.5 3" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Influencer Marketing</strong><em>Put the brand with people the audience already trusts.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/online-reputation-management') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.8 14.2 9l5.5.4-4.2 3.5 1.3 5.3L12 15.4 7.2 18.2 8.5 13 4.3 9.4 9.8 9z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Online Reputation Management</strong><em>Shape what people find about the brand.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/social-media-analytics') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 19V5M4 19h16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 15v-3M12 15V8M16 15v-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Social Media Analytics</strong><em>See which activity earns its place.</em></span></a>
                    </div>

                    <div class="mega-col">
                      <p class="mega-label"><span>03</span> Websites and products</p>
                      <a class="mega-item" href="{{ url('/services/website-design-and-development') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Website Design and Development</strong><em>A site that answers a marketing problem.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/mobile-application-development') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="8" y="3.5" width="8" height="17" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M11 18.2h2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Mobile Application Development</strong><em>Meet people on the device they already use.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/marketing-automation') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Marketing Automation</strong><em>Let email and social follow-up keep moving.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/sentiment-analysis') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 14.2c.9 1.2 2.1 1.8 3.5 1.8s2.6-.6 3.5-1.8M9 10h.1M15 10h.1" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Sentiment Analysis</strong><em>Read how people talk about the brand.</em></span></a>
                      <a class="mega-item" href="{{ url('/services/devops-services') }}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 16.5a3.2 3.2 0 0 1 .4-6.3A4.2 4.2 0 0 1 15.6 8 3.4 3.4 0 0 1 18 14.5H7" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>DevOps Services</strong><em>Keep the product shipping and stable.</em></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="has-drop">
              <button class="nav-parent" type="button" aria-expanded="false" aria-controls="portfolio-menu" data-drop-toggle>Portfolio</button>
              <div class="drop drop-portfolio" id="portfolio-menu">
                <div class="drop-portfolio-inner">
                  <div class="drop-portfolio-main">
                    <header class="drop-portfolio-head">
                      <div>
                        <h3>Featured Projects</h3>
                        <p>Explore our portfolio of high-impact digital solutions designed to drive engagement and deliver measurable growth.</p>
                      </div>
                      <a class="drop-portfolio-cta" href="{{ url('/portfolios') }}" data-nav-link>
                        Explore Our Portfolio
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                      </a>
                    </header>
                    <div class="drop-portfolio-grid">
                      <a class="drop-card" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/work/shree-rakhi.jpg') }}" alt="Shree Rakhi gift set display" width="480" height="320" loading="lazy">
                        <span>Shree Rakhi</span>
                      </a>
                      <a class="drop-card" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/work/rhl-preview.jpg') }}" alt="Rajasthan Hospital campus" width="480" height="320" loading="lazy">
                        <span>Rajasthan Hospital</span>
                      </a>
                      <a class="drop-card" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/work/stone-hub.jpg') }}" alt="Stone Hub India showroom" width="480" height="320" loading="lazy">
                        <span>Stone Hub India</span>
                      </a>
                      <a class="drop-card" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('assets/work/kalavaati.jpg') }}" alt="Kalavaati handcrafted ceramics" width="480" height="320" loading="lazy">
                        <span>Kalavaati</span>
                      </a>
                    </div>
                  </div>
                  <aside class="drop-portfolio-side">
                    <p class="drop-side-kicker">Featured Case Studies</p>
                    <a class="drop-side-card" href="{{ url('/portfolios#cases') }}" data-nav-link>
                      <img src="{{ asset('assets/cases/case-1.jpg') }}" alt="" width="420" height="260" loading="lazy">
                      <strong>Don't know what customers want, do you want?</strong>
                      <span>Read case studies</span>
                    </a>
                    <div class="drop-side-links">
                      <a href="{{ url('/testimonials') }}" data-nav-link>Testimonials</a>
                      <a href="{{ url('/portfolios') }}" data-nav-link>All projects</a>
                    </div>
                  </aside>
                </div>
              </div>
            </li>

            <li><a href="{{ url('/testimonials') }}" @if(Request::is('testimonials*')) aria-current="page" @endif data-nav-link>Testimonials</a></li>
            <li><a href="{{ url('/blog') }}" @if(Request::is('blog*') || Request::is('blogs*')) aria-current="page" @endif data-nav-link>Blog</a></li>
            <li><a href="{{ url('/contact') }}" @if(Request::is('contact*')) aria-current="page" @endif data-nav-link>Contact</a></li>
          @endif
        </ul>
        <a class="btn btn-primary nav-cta" href="{{ url($headerContents['cta']['url'] ?? '/contact') }}">{{ $headerContents['cta']['label'] ?? "Let's Talk" }}</a>
      </nav>
    </div>
  </header>

  <main id="main">
    @yield('content')
  </main>

  <footer class="site-footer">
    <div class="footer-glow" aria-hidden="true"></div>
    <div class="wrap footer-grid">
      <div class="footer-brand footer-area-brand">
        <a class="logo" href="{{ url('/') }}" aria-label="SMAC Digital, home">
          <img src="{{ asset($parameters['logo_path'] ?? 'assets/brand/logo-white.png') }}" width="180" height="52" alt="{{ $parameters['site_name'] ?? 'SMAC Digital' }}">
        </a>
        <p class="footer-mark">Social · Mobile · Analytics · Cloud</p>
        <p class="footer-blurb">{{ $parameters['site_tagline'] ?? 'Performance-driven digital marketing across India and the US.' }}</p>
        <img class="partner-badge" src="{{ asset('assets/brand/google-partner.png') }}" alt="Google Partner" width="130" height="52">
      </div>

      <div class="footer-col footer-area-services">
        <h2>{{ $footerContents['headings']['col1'] ?? 'Our Services' }}</h2>
        <ul>
          @if(isset($footerMenus['footer_col1']) && $footerMenus['footer_col1']->isNotEmpty())
            @foreach($footerMenus['footer_col1'] as $fItem)
              <li><a href="{{ url($fItem->url) }}">{{ $fItem->title }}</a></li>
            @endforeach
          @else
            <li><a href="{{ url('/services/marketing-automation') }}">Marketing Automation</a></li>
            <li><a href="{{ url('/services/inbound-marketing') }}">Inbound Marketing</a></li>
            <li><a href="{{ url('/services/social-media-marketing') }}">Social Media Marketing</a></li>
            <li><a href="{{ url('/services/search-engine-optimization') }}">Search Engine Optimization</a></li>
            <li><a href="{{ url('/services/video-marketing') }}">Video Marketing</a></li>
            <li><a href="{{ url('/services/website-design-and-development') }}">Website Design &amp; Development</a></li>
            <li><a href="{{ url('/services/mobile-application-development') }}">Mobile App Development</a></li>
            <li><a href="{{ url('/services/digital-media-planning') }}">Digital Media Planning</a></li>
            <li><a href="{{ url('/services/lead-generation') }}">Lead Generation</a></li>
            <li><a href="{{ url('/services/content-marketing') }}">Content Marketing</a></li>
          @endif
        </ul>
      </div>

      <div class="footer-col footer-area-links">
        <h2>{{ $footerContents['headings']['col2'] ?? 'Quick Links' }}</h2>
        <ul>
          @if(isset($footerMenus['footer_col2']) && $footerMenus['footer_col2']->isNotEmpty())
            @foreach($footerMenus['footer_col2'] as $fItem)
              <li><a href="{{ url($fItem->url) }}">{{ $fItem->title }}</a></li>
            @endforeach
          @else
            <li><a href="{{ url('/about-us') }}">About</a></li>
            <li><a href="{{ url('/portfolios') }}">Portfolio</a></li>
            <li><a href="{{ url('/portfolios#cases') }}">Case studies</a></li>
            <li><a href="{{ url('/testimonials') }}">Testimonials</a></li>
            <li><a href="{{ url('/blog') }}">Blog</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
            <li><a href="{{ url('/events') }}">Events</a></li>
            <li><a href="{{ url('/career') }}">Career</a></li>
          @endif
        </ul>
      </div>

      <div class="footer-col footer-subscribe footer-area-subscribe">
        <h2>Subscription</h2>
        <p>Get a free digital audit note in your inbox.</p>
        <form class="footer-sub-form" action="{{ url('/contact') }}" method="get">
          <label class="visually-hidden" for="footer-email">E-mail</label>
          <input id="footer-email" name="email" type="email" placeholder="E-mail" autocomplete="email" required>
          <button type="submit" aria-label="Continue to contact form">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M8.3 4.7 15.6 12l-7.3 7.3 1.4 1.4L18.4 12 9.7 3.3z"/></svg>
          </button>
        </form>
      </div>

      <div class="footer-office footer-area-india">
        <h2>
          <span class="footer-flag" aria-hidden="true">
            <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="8" fill="#FF9933"/><rect y="8" width="36" height="8" fill="#fff"/><rect y="16" width="36" height="8" fill="#138808"/><circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" stroke-width="0.7"/><circle cx="18" cy="12" r="0.55" fill="#000080"/></svg>
          </span>
          India
        </h2>
        <address>
          <strong>Jaipur</strong>
          <span>Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur 302020</span>
          <a href="tel:{{ preg_replace('/[^\d+]/', '', $parameters['primary_phone'] ?? '+919829069519') }}">{{ $parameters['primary_phone'] ?? '+91 98290 69519' }}</a>
          <a href="mailto:{{ $parameters['primary_email'] ?? 'Jitendra@smacdigital.com' }}">{{ $parameters['primary_email'] ?? 'Jitendra@smacdigital.com' }}</a>
        </address>
        <address>
          <strong>Kolkata</strong>
          <span>Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</span>
          <a href="tel:+919831132254">+91 98311 32254</a>
          <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a>
        </address>
        <address>
          <strong>Pune</strong>
          <a href="tel:+919582792638">+91 95827 92638</a>
          <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
        </address>
      </div>

      <div class="footer-office footer-area-usa">
        <h2>
          <span class="footer-flag" aria-hidden="true">
            <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="24" fill="#B22234"/><path d="M0 2.77h36M0 5.54h36M0 8.31h36M0 11.08h36M0 13.85h36M0 16.62h36M0 19.38h36" stroke="#fff" stroke-width="1.85"/><rect width="14.4" height="12.92" fill="#3C3B6E"/></svg>
          </span>
          USA
        </h2>
        <address>
          <span>1507 E Flower Street, Gilbert AZ 85298</span>
          <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
        </address>
      </div>

      <div class="footer-career footer-area-career">
        <h2>For career-related enquiries, please contact:</h2>
        <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
        <a href="tel:+919582792638">+91 95827 92638</a>
        <ul class="socials" aria-label="Social links">
          <li><a href="{{ $parameters['social_facebook'] ?? 'https://www.facebook.com/smacdigi' }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.2 8.5V6.9c0-.7.4-.9 1.1-.9H17V3.4h-2C12.4 3.4 11 4.7 11 7v1.5H9v2.6h2V21h3.2v-9.9h2.2l.3-2.6h-2.5z"/></svg></a></li>
          <li><a href="{{ $parameters['social_instagram'] ?? 'https://www.instagram.com/smacdigital/' }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6Zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2Zm6-9.3a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0ZM21.4 12c0-1.2 0-2.2-.1-3.2-.1-1-.3-1.9-.8-2.7a4.6 4.6 0 0 0-1.6-1.6c-.8-.5-1.7-.7-2.7-.8-1-.1-2-.1-4.2-.1s-3.2 0-4.2.1c-1 .1-1.9.3-2.7.8a4.6 4.6 0 0 0-1.6 1.6c-.5.8-.7 1.7-.8 2.7-.1 1-.1 2-.1 3.2s0 2.2.1 3.2c.1 1 .3 1.9.8 2.7.4.7 1 1.2 1.6 1.6.8.5 1.7.7 2.7.8 1 .1 2 .1 4.2.1s3.2 0 4.2-.1c1-.1 1.9-.3 2.7-.8a4.6 4.6 0 0 0 1.6-1.6c.5-.8.7-1.7.8-2.7.1-1 .1-2 .1-3.2Zm-1.6 3.1c0 .9-.1 1.5-.2 1.9-.1.4-.3.7-.6 1-.3.3-.6.5-1 .6-.4.1-1 .2-1.9.2-1.1.1-1.5.1-4.1.1s-3 0-4.1-.1c-.9 0-1.5-.1-1.9-.2-.4-.1-.7-.3-1-.6-.3-.3-.5-.6-.6-1-.1-.4-.2-1-.2-1.9-.1-1.1-.1-1.5-.1-4.1s0-3 .1-4.1c0-.9.1-1.5.2-1.9.1-.4.3-.7.6-1 .3-.3.6-.5 1-.6.4-.1 1-.2 1.9-.2 1.1-.1 1.5-.1 4.1-.1s3 0 4.1.1c.9 0 1.5.1 1.9.2.4.1.7.3 1 .6.3.3.5.6.6 1 .1.4.2 1 .2 1.9.1 1.1.1 1.5.1 4.1s0 3-.1 4.1Z"/></svg></a></li>
          <li><a href="{{ $parameters['social_twitter'] ?? 'https://twitter.com/DigitalSmac' }}" target="_blank" rel="noopener noreferrer" aria-label="X"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.7 10.4 21.3 3h-1.6l-5.7 6.3L9.3 3H3.6l7 9.9L3.6 21h1.6l6.1-6.8L14.7 21h5.7l-7.2-10.6Zm-2.2 2.4-.7-1L6.2 4.5h2.4l4.5 6.2.7 1 5.9 8.2h-2.4l-4.8-6.5Z"/></svg></a></li>
          <li><a href="{{ $parameters['social_linkedin'] ?? 'https://www.linkedin.com/company/smac-digital-pvt-ltd' }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.7 9H3.9v11.3h2.8V9ZM5.3 3.6a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4ZM20.2 13.4c0-3.3-1.8-4.8-4.1-4.8-1.9 0-2.7 1-3.2 1.7V9H10.1c0 1.5 0 11.3 0 11.3h2.8v-6.3c0-.3 0-.7.1-.9.3-.7 1-1.5 2.1-1.5 1.5 0 2.1 1.1 2.1 2.7v6h2.8v-6.9Z"/></svg></a></li>
        </ul>
      </div>
    </div>

    <div class="wrap footer-base">
      <p>{{ $footerContents['bottom']['copyright'] ?? ('© ' . date('Y') . ' ' . ($parameters['site_name'] ?? 'SMAC Digital') . '. All rights reserved.') }}</p>
      <nav class="footer-legal" aria-label="Footer links">
        <a href="{{ url('/contact') }}">Contact</a>
        <a href="{{ url('/blog') }}">Blog</a>
        <a href="{{ url('/portfolios') }}">Portfolios</a>
        <a href="{{ url('/testimonials') }}">Testimonials</a>
        <a href="https://wa.me/{{ $parameters['whatsapp_number'] ?? '919582792638' }}" target="_blank" rel="noopener noreferrer">WhatsApp</a>
      </nav>
    </div>
  </footer>

  <a class="whatsapp" href="https://wa.me/{{ $parameters['whatsapp_number'] ?? '919582792638' }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp SMAC Digital">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg>
  </a>

  <!-- Left Side Sticky CTA Button -->
  <button type="button" class="sticky-left-cta" data-open-lead-modal aria-label="{{ $site['sticky_cta_text'] ?? 'Start A Brief' }} - Open Brief Modal">
    <span class="sticky-cta-pulse" aria-hidden="true"></span>
    <span class="sticky-cta-icon" aria-hidden="true">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
      </svg>
    </span>
    <span class="sticky-cta-label">{{ $site['sticky_cta_text'] ?? 'Start A Brief' }}</span>
    <span class="sticky-cta-arrow" aria-hidden="true">
      <svg viewBox="0 0 20 20" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="7 4 13 10 7 16"></polyline>
      </svg>
    </span>
  </button>

  <!-- Lead Generation / Let's Talk Brief Modal -->
  <div class="lead-modal" id="lead-modal" role="dialog" aria-modal="true" aria-labelledby="modal-form-title" hidden>
    <div class="lead-modal-backdrop" data-modal-close></div>
    <div class="lead-modal-card">
      <div class="lead-modal-head">
        <button class="lead-modal-close" type="button" data-modal-close aria-label="Close brief modal">
          <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
        <p class="lead-form-kicker">START A BRIEF</p>
        <h3 class="lead-form-title" id="modal-form-title">Share a few details. We’ll reply with a clear next step.</h3>
      </div>

      <form class="modal-lead-form" id="modal-lead-form" method="post" action="{{ url('/save-lead') }}" novalidate>
        @csrf
        <input type="hidden" name="landing_url" value="">
        <input type="hidden" name="referrer_url" value="">
        <input type="hidden" name="utm_source" value="">
        <input type="hidden" name="utm_medium" value="">
        <input type="hidden" name="utm_campaign" value="">

        <div class="field-row">
          <div class="field field-float">
            <input id="modal-name" name="name" type="text" autocomplete="name" placeholder=" " required>
            <label for="modal-name">Full name</label>
            <p class="field-error" id="modal-name-error" hidden></p>
          </div>
          <div class="field field-float">
            <input id="modal-email" name="email" type="email" autocomplete="email" placeholder=" " required>
            <label for="modal-email">Business email</label>
            <p class="field-error" id="modal-email-error" hidden></p>
          </div>
        </div>

        <div class="field-row">
          <div class="field field-float">
            <input id="modal-phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder=" " required>
            <label for="modal-phone">Phone number</label>
            <p class="field-error" id="modal-phone-error" hidden></p>
          </div>
          <div class="field field-float">
            <input id="modal-company" name="company" type="text" autocomplete="organization" placeholder=" ">
            <label for="modal-company">Company or website</label>
            <p class="field-error" id="modal-company-error" hidden></p>
          </div>
        </div>

        <div class="field field-dropdown" id="modal-service-field">
          <label class="dropdown-label" for="services-dropdown-trigger">Services of interest</label>
          <div class="modern-dropdown" data-multiselect>
            <button type="button" class="dropdown-trigger" id="services-dropdown-trigger" aria-haspopup="listbox" aria-expanded="false">
              <span class="dropdown-trigger-text" data-placeholder="Select services of interest...">Select services of interest...</span>
              <span class="dropdown-arrow" aria-hidden="true">
                <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="6 9 10 13 14 9"></polyline>
                </svg>
              </span>
            </button>
            <div class="dropdown-panel" role="listbox" aria-multiselectable="true">
              <div class="dropdown-panel-header">
                <span class="dropdown-panel-hint">Select all that apply</span>
                <button type="button" class="dropdown-clear-btn" data-clear-services>Clear all</button>
              </div>
              <div class="dropdown-options">
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Marketing automation">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Marketing automation</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Inbound">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Inbound</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Social media">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Social media</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="SEO">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">SEO</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Video">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Video</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Website">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Website</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Mobile app">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Mobile app</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Media planning">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Media planning</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Lead generation">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Lead generation</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Content">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Content</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Reputation">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Reputation</span>
                </label>
                <label class="dropdown-option">
                  <input type="checkbox" name="service" value="Analytics">
                  <span class="option-custom-check">
                    <svg viewBox="0 0 16 16" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 8.5 6.5 12 13 4"></polyline>
                    </svg>
                  </span>
                  <span class="option-text">Analytics</span>
                </label>
              </div>
            </div>
          </div>
          <p class="field-error" id="modal-service-error" hidden></p>
        </div>

        <div class="field field-float">
          <textarea id="modal-message" name="message" rows="3" placeholder=" " required></textarea>
          <label for="modal-message">Tell us a bit about the business and what needs doing</label>
          <p class="field-error" id="modal-message-error" hidden></p>
        </div>

        <button class="lead-submit" type="submit" data-submit>
          <span>Get a free consultation</span>
          <span class="lead-submit-arrow" aria-hidden="true">
            <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </span>
        </button>

        <p class="form-status" id="modal-form-status" role="status" aria-live="polite"></p>
        <p class="lead-form-privacy">We respect your inbox. No newsletters, no hard sell.</p>
      </form>
    </div>
  </div>

  <script src="{{ asset('script.js') }}"></script>
  @yield('extra_scripts')
</body>
</html>
