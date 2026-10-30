@extends('smac.layout')

@section('title', $page->metatitle ?? 'Best Performing Digital Marketing Agency in India | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers. Get quotes for customized SEO, Social Media, and Online ADS proposal for your brand now.')
@section('meta_keywords', $page->metakeywords ?? 'Best Digital Marketing Agency in India, Social Media Marketing in India, SMAC Digital')

@section('content')
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
        <div class="growth-bars growth-bars-full">
          <span style="--h:22%"></span>
          <span style="--h:34%"></span>
          <span style="--h:28%"></span>
          <span style="--h:46%"></span>
          <span style="--h:40%"></span>
          <span style="--h:58%"></span>
          <span style="--h:52%"></span>
          <span style="--h:68%"></span>
          <span style="--h:62%"></span>
          <span style="--h:78%"></span>
          <span style="--h:72%"></span>
          <span style="--h:88%"></span>
          <span style="--h:82%"></span>
          <span style="--h:96%"></span>
          <span style="--h:90%"></span>
          <span style="--h:100%"></span>
        </div>
        <svg class="growth-line growth-line-full" viewBox="0 0 1200 320" preserveAspectRatio="none" focusable="false">
          <path class="growth-line-path" d="M40 280 C120 270, 180 240, 240 220 S360 190, 420 165 S540 140, 600 120 S720 95, 780 78 S900 55, 960 42 S1100 28, 1160 22"/>
          <circle class="growth-dot" cx="1160" cy="22" r="8"/>
        </svg>
        <div class="seo-rank">
          <div class="seo-search">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M16 16.5 20.5 21" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            <span>seo</span>
          </div>
          <ul class="seo-list">
            <li><em>#3</em><span>digital marketing</span></li>
            <li><em>#2</em><span>lead generation</span></li>
            <li class="is-top"><em>#1</em><span>seo services</span></li>
          </ul>
        </div>
        <div class="dm-orbit">
          <span>Social</span>
          <span>Ads</span>
          <span>Content</span>
          <span>Email</span>
          <span>Analytics</span>
        </div>
        <div class="growth-tags">
          <span>↑ Traffic</span>
          <span>↑ Conversions</span>
          <span>↑ Rankings</span>
          <span>↑ ROI</span>
        </div>
      </div>
      <ul class="social-rail">
        <li>
          <a class="is-mark" href="https://www.facebook.com/smacdigi" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.2 8.5V6.9c0-.7.4-.9 1.1-.9H17V3.4h-2C12.4 3.4 11 4.7 11 7v1.5H9v2.6h2V21h3.2v-9.9h2.2l.3-2.6h-2.5z"/></svg>
          </a>
        </li>
        <li>
          <a href="https://twitter.com/DigitalSmac" target="_blank" rel="noopener noreferrer" aria-label="X">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.7 10.4 21.3 3h-1.6l-5.7 6.3L9.3 3H3.6l7 9.9L3.6 21h1.6l6.1-6.8L14.7 21h5.7l-7.2-10.6Zm-2.2 2.4-.7-1L6.2 4.5h2.4l4.5 6.2.7 1 5.9 8.2h-2.4l-4.8-6.5Z"/></svg>
          </a>
        </li>
        <li>
          <a href="https://www.linkedin.com/company/smac-digital-pvt-ltd" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.7 9H3.9v11.3h2.8V9ZM5.3 3.6a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4ZM20.2 13.4c0-3.3-1.8-4.8-4.1-4.8-1.9 0-2.7 1-3.2 1.7V9H10.1c0 1.5 0 11.3 0 11.3h2.8v-6.3c0-.3 0-.7.1-.9.3-.7 1-1.5 2.1-1.5 1.5 0 2.1 1.1 2.1 2.7v6h2.8v-6.9Z"/></svg>
          </a>
        </li>
        <li>
          <a href="https://www.instagram.com/smacdigital/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6Zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2Zm6-9.3a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0ZM21.4 12c0-1.2 0-2.2-.1-3.2-.1-1-.3-1.9-.8-2.7a4.6 4.6 0 0 0-1.6-1.6c-.8-.5-1.7-.7-2.7-.8-1-.1-2-.1-4.2-.1s-3.2 0-4.2.1c-1 .1-1.9.3-2.7.8a4.6 4.6 0 0 0-1.6 1.6c-.5.8-.7 1.7-.8 2.7-.1 1-.1 2-.1 3.2s0 2.2.1 3.2c.1 1 .3 1.9.8 2.7.4.7 1 1.2 1.6 1.6.8.5 1.7.7 2.7.8 1 .1 2 .1 4.2.1s3.2 0 4.2-.1c1-.1 1.9-.3 2.7-.8a4.6 4.6 0 0 0 1.6-1.6c.5-.8.7-1.7.8-2.7.1-1 .1-2 .1-3.2Zm-1.6 3.1c0 .9-.1 1.5-.2 1.9-.1.4-.3.7-.6 1-.3.3-.6.5-1 .6-.4.1-1 .2-1.9.2-1.1.1-1.5.1-4.1.1s-3 0-4.1-.1c-.9 0-1.5-.1-1.9-.2-.4-.1-.7-.3-1-.6-.3-.3-.5-.6-.6-1-.1-.4-.2-1-.2-1.9-.1-1.1-.1-1.5-.1-4.1s0-3 .1-4.1c0-.9.1-1.5.2-1.9.1-.4.3-.7.6-1 .3-.3.6-.5 1-.6.4-.1 1-.2 1.9-.2 1.1-.1 1.5-.1 4.1-.1s3 0 4.1.1c.9 0 1.5.1 1.9.2.4.1.7.3 1 .6.3.3.5.6.6 1 .1.4.2 1 .2 1.9.1 1.1.1 1.5.1 4.1s0 3-.1 4.1Z"/></svg>
          </a>
        </li>
      </ul>
      <div class="wrap hero-copy">
        <p class="pill">{{ $homeContents['hero']['badge'] ?? 'Social · Mobile · Analytics · Cloud' }}</p>
        <h1 id="hero-title" data-hero-type>
          @php
            $heroTitle = $homeContents['hero']['title'] ?? 'Turn attention into revenue.';
            $words = explode(' ', $heroTitle);
            $half = count($words) > 2 ? ceil(count($words) / 2) : 1;
            $line1 = implode(' ', array_slice($words, 0, $half));
            $line2 = implode(' ', array_slice($words, $half));
          @endphp
          <span class="hero-type-line" data-type="{{ $line1 }}">{{ $line1 }}</span><br>
          <em class="hero-type-line" data-type="{{ $line2 }}">{{ $line2 }}</em>
        </h1>
        <p class="lede">{{ $homeContents['hero']['subtitle'] ?? 'We combine strategy, creativity, technology, and performance marketing to help ambitious businesses reach the right audience and generate meaningful results.' }}</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url($homeContents['hero']['cta1_url'] ?? '/portfolios') }}">{{ $homeContents['hero']['cta1_text'] ?? 'See the work' }}</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-maroon" href="{{ url($homeContents['hero']['cta2_url'] ?? '#contact') }}">{{ $homeContents['hero']['cta2_text'] ?? 'Get a free consultation' }}</a>
        </div>
        <div class="hero-badges">
          <div class="badge-card">
            <img src="{{ asset('assets/brand/google-partner.png') }}" width="120" height="48" alt="Google Partner">
          </div>
          <div class="badge-card badge-stat">
            <strong>{{ $homeContents['hero']['stat1_number'] ?? '$2Million+' }}</strong>
            <span>{{ $homeContents['hero']['stat1_label'] ?? 'Monthly online sales' }}</span>
          </div>
        </div>
      </div>
    </section>

    <section class="logo-strip" aria-label="Clients">
      <div class="wrap logo-strip-head">
        <p>Trusted by brands</p>
      </div>
      <div class="logo-marquee">
        <div class="marquee marquee-a">
          <div class="marquee-track">
            <ul class="logo-row">
              <li><img src="assets/clients/livguard.jpg" alt="Livguard"></li>
              <li><img src="assets/clients/uber.png" alt="Uber"></li>
              <li><img src="assets/clients/zee-news.png" alt="Zee News"></li>
              <li><img src="assets/clients/lg.png" alt="LG"></li>
              <li><img src="assets/clients/flyrobe.jpg" alt="Flyrobe"></li>
              <li><img src="assets/clients/tower.png" alt="Tower"></li>
              <li><img src="assets/clients/navpack.png" alt="Navpack"></li>
              <li><img src="assets/clients/ranthambhore.png" alt="Ranthambhore"></li>
            </ul>
            <ul class="logo-row" aria-hidden="true">
              <li><img src="assets/clients/livguard.jpg" alt=""></li>
              <li><img src="assets/clients/uber.png" alt=""></li>
              <li><img src="assets/clients/zee-news.png" alt=""></li>
              <li><img src="assets/clients/lg.png" alt=""></li>
              <li><img src="assets/clients/flyrobe.jpg" alt=""></li>
              <li><img src="assets/clients/tower.png" alt=""></li>
              <li><img src="assets/clients/navpack.png" alt=""></li>
              <li><img src="assets/clients/ranthambhore.png" alt=""></li>
            </ul>
          </div>
        </div>
        <div class="marquee marquee-b">
          <div class="marquee-track">
            <ul class="logo-row">
              <li><img src="assets/clients/glow.png" alt="Glow"></li>
              <li><img src="assets/clients/igmguru.png" alt="IGM Guru"></li>
              <li><img src="assets/clients/tumbledry.png" alt="Tumbledry"></li>
              <li><img src="assets/clients/sumit.png" alt="Sumit"></li>
              <li><img src="assets/clients/kalavaati.png" alt="Kalavaati"></li>
              <li><img src="assets/clients/ora.png" alt="Ora"></li>
              <li><img src="assets/clients/shree.png" alt="Shree Rakhi"></li>
            </ul>
            <ul class="logo-row" aria-hidden="true">
              <li><img src="assets/clients/glow.png" alt=""></li>
              <li><img src="assets/clients/igmguru.png" alt=""></li>
              <li><img src="assets/clients/tumbledry.png" alt=""></li>
              <li><img src="assets/clients/sumit.png" alt=""></li>
              <li><img src="assets/clients/kalavaati.png" alt=""></li>
              <li><img src="assets/clients/ora.png" alt=""></li>
              <li><img src="assets/clients/shree.png" alt=""></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="services" id="services" aria-labelledby="services-title">
      <div class="services-bg" aria-hidden="true"></div>
      <div class="wrap services-inner">
        <header class="services-top">
          <div class="services-top-copy">
            <p class="services-kicker"><span aria-hidden="true">»</span> Services</p>
            <h2 id="services-title">
              Unlock growth<br><em>for your business.</em>
            </h2>
          </div>
          <a class="services-learn" href="{{ url('/services') }}">
            Learn more
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17 17 7M9 7h8v8" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
        </header>

      </div>

        <div class="svc-list">
          <a class="svc-row" style="--i:0" href="{{ url('/services/marketing-automation') }}">
            <div class="svc-row-title">
              <span class="svc-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
              <h3>Marketing Automation</h3>
            </div>
            <div class="svc-row-frame">
              <span class="svc-row-orbit" aria-hidden="true"></span>
              <div class="svc-row-media">
                <img src="assets/services/automation.jpg" alt="" width="480" height="200" loading="lazy">
              </div>
              <span class="svc-row-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
            <p class="svc-row-copy">Automation takes on repetitive work such as email and social marketing.</p>
          </a>

          <a class="svc-row" style="--i:1" href="{{ url('/services/social-media-marketing') }}">
            <div class="svc-row-title">
              <span class="svc-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="7.5" r="0.8" fill="currentColor"/></svg></span>
              <h3>Social Media Marketing</h3>
            </div>
            <div class="svc-row-frame">
              <span class="svc-row-orbit" aria-hidden="true"></span>
              <div class="svc-row-media">
                <img src="assets/services/social.jpg" alt="" width="480" height="200" loading="lazy">
              </div>
              <span class="svc-row-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
            <p class="svc-row-copy">Use the platforms people already spend time on, so the brand is seen by the audience it wants.</p>
          </a>

          <a class="svc-row" style="--i:2" href="{{ url('/services/search-engine-optimization') }}">
            <div class="svc-row-title">
              <span class="svc-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
              <h3>Search Engine Optimization</h3>
            </div>
            <div class="svc-row-frame">
              <span class="svc-row-orbit" aria-hidden="true"></span>
              <div class="svc-row-media">
                <img src="assets/services/seo.jpg" alt="" width="480" height="200" loading="lazy">
              </div>
              <span class="svc-row-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
            <p class="svc-row-copy">The practices that help a website earn a stronger place in search.</p>
          </a>

          <a class="svc-row" style="--i:3" href="{{ url('/services/website-design-and-development') }}">
            <div class="svc-row-title">
              <span class="svc-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
              <h3>Web &amp; Mobile Development</h3>
            </div>
            <div class="svc-row-frame">
              <span class="svc-row-orbit" aria-hidden="true"></span>
              <div class="svc-row-media">
                <img src="assets/services/website.jpg" alt="" width="480" height="200" loading="lazy">
              </div>
              <span class="svc-row-arrow" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
            <p class="svc-row-copy">A site or app that answers a marketing problem, not decoration alone.</p>
          </a>
        </div>
    </section>

    <section class="results" id="results" aria-labelledby="results-title">
      <div class="wrap">
        <header class="section-head light">
          <p class="eyebrow">Results</p>
          <h2 id="results-title">Results the company<br><em>has published.</em></h2>
          <p class="section-intro">Company-level results from smacdigital.com. They are not a claim about one named client.</p>
        </header>
        <dl class="stat-grid">
          <div class="stat stat-lead">
            <dt>Monthly online sales</dt>
            <dd>$2Million+</dd>
          </div>
          <div class="stat">
            <dt>Property deals</dt>
            <dd data-count="500" data-suffix="+">500+</dd>
          </div>
          <div class="stat">
            <dt>Franchise deals</dt>
            <dd data-count="1500" data-suffix="+">1500+</dd>
          </div>
          <div class="stat">
            <dt>Monthly footfalls</dt>
            <dd>1Million+</dd>
          </div>
          <div class="stat">
            <dt>Dealer acquisition</dt>
            <dd data-count="30000" data-suffix="+">30,000+</dd>
          </div>
          <div class="stat">
            <dt>Traffic growth</dt>
            <dd data-count="400" data-suffix="%+">400%+</dd>
          </div>
          <div class="stat">
            <dt>Keywords ranking within a month</dt>
            <dd data-count="1000" data-suffix="+">1000+</dd>
          </div>
          <div class="stat">
            <dt>Twitter trends, organic</dt>
            <dd>4 Hours+</dd>
          </div>
          <div class="stat">
            <dt>Video views in a single day</dt>
            <dd>6 Lacs+</dd>
          </div>
          <div class="stat">
            <dt>Follower growth in a single day</dt>
            <dd>100K+</dd>
          </div>
        </dl>
      </div>
    </section>

    <section class="about" id="about" aria-labelledby="about-title">
      <div class="wrap about-inner">
        <header class="about-head">
          <p class="eyebrow">About</p>
          <h2 id="about-title">Named for the shift.<br><em>Built to lead it.</em></h2>
          <p class="about-lead">SMAC stands for Social, Mobile, Analytics, and Cloud — four forces reshaping how brands grow. The agency sits at the front of that change.</p>
        </header>
      </div>

      <div class="about-pillars" role="list">
        <article class="about-pillar" role="listitem" style="--p:0">
          <span class="about-pillar-index" aria-hidden="true">01</span>
          <span class="about-pillar-letter" aria-hidden="true">S</span>
          <h3>Social</h3>
          <p>Show up where people already spend attention.</p>
        </article>
        <article class="about-pillar" role="listitem" style="--p:1">
          <span class="about-pillar-index" aria-hidden="true">02</span>
          <span class="about-pillar-letter" aria-hidden="true">M</span>
          <h3>Mobile</h3>
          <p>Meet the audience on the device in their hand.</p>
        </article>
        <article class="about-pillar" role="listitem" style="--p:2">
          <span class="about-pillar-index" aria-hidden="true">03</span>
          <span class="about-pillar-letter" aria-hidden="true">A</span>
          <h3>Analytics</h3>
          <p>Let real signals decide what earns another rupee.</p>
        </article>
        <article class="about-pillar" role="listitem" style="--p:3">
          <span class="about-pillar-index" aria-hidden="true">04</span>
          <span class="about-pillar-letter" aria-hidden="true">C</span>
          <h3>Cloud</h3>
          <p>Keep the product shipping, connected, and ready to scale.</p>
        </article>
      </div>

      <div class="about-promise">
        <span class="about-promise-mark" aria-hidden="true">SMILE</span>
        <div class="wrap about-promise-inner">
          <div class="about-promise-copy">
            <p class="about-kicker">How the work feels<span class="about-cursor" aria-hidden="true"></span></p>
            <h3 class="about-copy-title">Performance first.<br><em>Smile always.</em></h3>
            <p>Performance-led, with a habit of over-delivering on what was agreed. The longer aim is simple: help people associate a brand with a smile — by reading the business clearly, then building the perception that makes it easier to choose.</p>
            <a class="btn btn-primary" href="{{ url('/about-us') }}">About SMAC Digital</a>
          </div>
          <ul class="about-promise-list">
            <li>
              <span class="about-promise-num" aria-hidden="true">01</span>
              <div>
                <strong>Read the business first</strong>
                <p>Strengths, gaps, and the market before a campaign brief.</p>
              </div>
            </li>
            <li>
              <span class="about-promise-num" aria-hidden="true">02</span>
              <div>
                <strong>Over-deliver on the agreement</strong>
                <p>Ship what was promised, then push past the line.</p>
              </div>
            </li>
            <li>
              <span class="about-promise-num" aria-hidden="true">03</span>
              <div>
                <strong>Build perception that converts</strong>
                <p>Make the brand easier to notice, trust, and choose.</p>
              </div>
            </li>
            <li>
              <span class="about-promise-num" aria-hidden="true">04</span>
              <div>
                <strong>Leave people with a smile</strong>
                <p>The lasting measure of whether the work mattered.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="work" id="work" aria-labelledby="work-title">
      <div class="wrap">
        <header class="section-head work-head">
          <p class="eyebrow">Portfolio</p>
          <h2 id="work-title">Selected<br><em>client work.</em></h2>
          <p class="section-intro">Partners in growth — browse the brands below to see the brief, the work, and what clients said publicly.</p>
        </header>
      </div>

      <div class="work-showcase" data-work-showcase>
        <div class="work-tabs-rail">
          <button class="work-tabs-nav work-tabs-prev" type="button" data-work-prev aria-label="Previous clients">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6 9 12l6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
          <div class="work-tabs-viewport" data-work-tabs>
            <div class="work-tabs-track" role="tablist" aria-label="Client portfolio">
              <button class="work-tab is-active" type="button" role="tab" aria-selected="true" aria-label="Shree Rakhi" data-work-tab="0">
                <img src="assets/clients/logos/shree-rakhi-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Rajasthan Hospital" data-work-tab="1">
                <img src="assets/clients/logos/rhl-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Stone Hub India" data-work-tab="2">
                <img src="assets/clients/logos/stonehub-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Kalavaati" data-work-tab="3">
                <img src="assets/clients/logos/kalavaati-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Dmaasa" data-work-tab="4">
                <img src="assets/clients/logos/dmaasa-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Aashiyana Luxury Cottages" data-work-tab="5">
                <img src="assets/clients/logos/aashiyana-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Navvi" data-work-tab="6">
                <img src="assets/clients/logos/navvi-white.png" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Ashoka Holidays" data-work-tab="7">
                <img src="assets/clients/logos/ashoka.svg" alt="" width="120" height="48">
              </button>
              <button class="work-tab" type="button" role="tab" aria-selected="false" aria-label="Tenderfold" data-work-tab="8">
                <img src="assets/clients/logos/tenderfold-white.png" alt="" width="120" height="48">
              </button>
            </div>
          </div>
          <button class="work-tabs-nav work-tabs-next" type="button" data-work-next aria-label="Next clients">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>
        </div>

        <div class="work-panel-shell">
          <div class="work-panel" data-work-panel>
            <article class="work-panel-card is-active" data-work-slide="0">
              <div class="work-panel-media">
                <img src="assets/work/shree-rakhi.jpg" alt="Avyaan Rakhi Bhaiya and Bhabhi gift set display" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Rakhi manufacturer &amp; wholesaler</p>
                <h3>Shree Rakhi</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A wholesale rakhi house needed a digital storefront dealers could use to browse collections and raise wholesale enquiries.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website design and development for categories, licensed lines, and a clear path to the wholesale desk.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live wholesale site presenting the catalogue and dealer journey end to end.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="1" hidden>
              <div class="work-panel-media">
                <img src="assets/work/rhl-preview.jpg" alt="Rajasthan Hospital RHL campus exterior" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Multispecialty hospital</p>
                <h3>Rajasthan Hospital</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A hospital needed a clearer digital front door for departments, doctors, and patient contact.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website structure around specialities, services, and appointment-led contact paths.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live hospital site that presents care offerings without burying the enquiry route.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="2" hidden>
              <div class="work-panel-media">
                <img src="assets/work/stone-hub.jpg" alt="Stone Hub India marble and granite showroom" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Imported marble &amp; slabs</p>
                <h3>Stone Hub India</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A stone curator needed digital reach that could bring enquiries from beyond a single city.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website and digital marketing focused on collections, applications, and catalogue requests.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>From their published testimonial: contracts rose by about one-third, with new clients found digitally from across India.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="3" hidden>
              <div class="work-panel-media">
                <img src="assets/work/kalavaati.jpg" alt="Handcrafted ceramics on display for Kalavaati" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Indian art &amp; craft</p>
                <h3>Kalavaati</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A craft brand needed digital storytelling that felt as considered as the work on the shelf.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Ecommerce-ready site work that puts craft, material, and collection browsing first.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live craft storefront that carries the brand’s handmade character online.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="4" hidden>
              <div class="work-panel-media">
                <img src="assets/work/dmaasa-preview.jpg" alt="Dmaasa hand block print home textiles" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Hand block print home decor</p>
                <h3>Dmaasa</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>An artisan textile brand needed a shop that could carry fabrics, bedding, and living collections clearly.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Ecommerce design and build for category browsing, product discovery, and wholesale enquiries.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live storefront for cotton hand-block printed home decor and related lines.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://dmaasa.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="5" hidden>
              <div class="work-panel-media">
                <img src="assets/work/aashiyana.jpg" alt="Evening view of the Aashiyana Luxury Cottages entrance" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Luxury cottages</p>
                <h3>Aashiyana Luxury Cottages</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A Ranthambhore property needed a digital face that matched the stay and helped guests enquire with confidence.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website work that leads with place, cottages, safari context, and a clear booking path.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live property site that presents the cottages with a warmer first impression.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://www.aashiyanacottage.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="6" hidden>
              <div class="work-panel-media">
                <img src="assets/work/navvi-preview.jpg" alt="Navvi fashion collection preview" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Indian wear &amp; dresses</p>
                <h3>Navvi</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A fashion label needed digital presence that matched the energy of its collections.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Ecommerce-led website work for arrivals, categories, and a cleaner shop journey.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live fashion storefront for women’s wear and related lines.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://navvi.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="7" hidden>
              <div class="work-panel-media">
                <img src="assets/work/ashoka.jpg" alt="Ashoka Holidays destination campaign image" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">India tour packages</p>
                <h3>Ashoka Holidays</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A travel brand needed a destination-led digital presence that could carry packages and enquiry clearly.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website design oriented around destinations, curated tours, and a simple path to talk to the team.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live travel site that puts India holidays and planning up front.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://ashokaholidays.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>

            <article class="work-panel-card" data-work-slide="8" hidden>
              <div class="work-panel-media">
                <img src="assets/work/tenderfold-preview.jpg" alt="Tenderfold laundry service preview" width="900" height="700">
              </div>
              <div class="work-panel-body">
                <p class="work-panel-tag">Premium laundry &amp; dry clean</p>
                <h3>Tenderfold</h3>
                <div class="work-panel-block">
                  <h4>Challenge</h4>
                  <p>A Gurgaon laundry brand needed a digital face for pickup booking, services, and published rates.</p>
                </div>
                <div class="work-panel-grid">
                  <div>
                    <h4>What we did</h4>
                    <p>Website design and development for services, pricing clarity, and doorstep pickup journeys.</p>
                  </div>
                  <div>
                    <h4>Outcome</h4>
                    <p>A live laundry site that makes booking and fabric care options easy to find.</p>
                  </div>
                </div>
                <a class="btn btn-primary" href="https://www.tenderfold.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
          </div>
          <div class="work-showcase-foot">
            <a class="btn btn-white" href="{{ url('/portfolios') }}">All projects</a>
          </div>
        </div>
      </div>
    </section>

    <section class="cases" id="case-studies" aria-labelledby="cases-title">
      <div class="wrap">
        <header class="section-head cases-head">
          <p class="eyebrow">Case studies</p>
          <h2 id="cases-title">Stories from<br><em>the desk.</em></h2>
          <p class="section-intro">Featured on <a href="https://www.smacdigital.com/" target="_blank" rel="noopener noreferrer">smacdigital.com</a> — same titles and imagery, laid out for this homepage.</p>
        </header>

        <div class="case-list">
          <article class="case-card">
            <a class="case-card-link" href="https://www.smacdigital.com/" target="_blank" rel="noopener noreferrer">
              <div class="case-card-media">
                <img src="assets/cases/case-1.jpg" alt="" width="640" height="420">
                <span class="case-card-index" aria-hidden="true">01</span>
              </div>
              <div class="case-card-body">
                <p class="case-card-badge">Business</p>
                <h3>Don't know what customers want, do you want?</h3>
                <span class="case-card-more">Read case study <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              </div>
            </a>
          </article>

          <article class="case-card">
            <a class="case-card-link" href="https://www.smacdigital.com/" target="_blank" rel="noopener noreferrer">
              <div class="case-card-media">
                <img src="assets/cases/case-2.jpg" alt="" width="640" height="420">
                <span class="case-card-index" aria-hidden="true">02</span>
              </div>
              <div class="case-card-body">
                <p class="case-card-badge">Projects</p>
                <h3>Towards effective and future oriented managemant</h3>
                <span class="case-card-more">Read case study <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              </div>
            </a>
          </article>

          <article class="case-card">
            <a class="case-card-link" href="https://www.smacdigital.com/" target="_blank" rel="noopener noreferrer">
              <div class="case-card-media">
                <img src="assets/cases/case-2.jpg" alt="" width="640" height="420">
                <span class="case-card-index" aria-hidden="true">03</span>
              </div>
              <div class="case-card-body">
                <p class="case-card-badge">Projects</p>
                <h3>Towards effective and future oriented managemant</h3>
                <span class="case-card-more">Read case study <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
              </div>
            </a>
          </article>
        </div>
      </div>
    </section>

    <section class="say-section" id="testimonials" aria-labelledby="say-title">
      <div class="say-bg" aria-hidden="true"></div>
      <div class="wrap say-grid">
        <div class="say-intro">
          <p class="say-eyebrow"><span aria-hidden="true">»</span> Our testimonial</p>
          <h2 id="say-title">
            Our Clients Say<br><em>About Services</em>
          </h2>
          <p class="say-lead">Published notes from brands we have worked with — quoted as they appear on SMAC Digital, with no added metrics.</p>
          <a class="btn btn-primary say-cta" href="{{ url('/testimonials') }}">
            Learn more
            <span aria-hidden="true">↗</span>
          </a>
        </div>

        <ul class="say-list" role="list">
          @if(isset($testimonials) && $testimonials->isNotEmpty())
            @foreach($testimonials->take(4) as $t)
            @php
              $avatar = !empty($t->avatar_path) ? $t->avatar_path : (!empty($t->image) ? $t->image : null);
            @endphp
            <li class="say-item">
              @if(!empty($avatar))
                <div class="say-avatar">
                  <img src="{{ site_image($avatar) }}" alt="{{ $t->name }}" width="96" height="96" onerror="this.onerror=null;this.src='{{ asset('assets/people/stone-hub.jpg') }}';">
                </div>
              @else
                @php
                  $words = preg_split('/\s+/', trim($t->name));
                  $initials = count($words) >= 2 ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) : strtoupper(substr($t->name, 0, 2));
                @endphp
                <div class="say-avatar say-avatar-initial" aria-hidden="true"><span>{{ $initials }}</span></div>
              @endif
              <div class="say-body">
                <blockquote>
                  <p>&ldquo;{{ $t->content }}&rdquo;</p>
                </blockquote>
                <p class="say-meta">
                  <span class="say-name">{{ $t->name }}</span>
                </p>
              </div>
            </li>
            @endforeach
          @else
          <li class="say-item">
            <div class="say-avatar">
              <img src="assets/people/stone-hub.jpg" alt="" width="96" height="96">
            </div>
            <div class="say-body">
              <blockquote>
                <p>“Our contracts have gone higher by about one-third of what we were getting before we took the services from SMAC Digital. They helped us a lot in finding more new clients from all over India digitally through their great website setup and digital marketing strategy.”</p>
              </blockquote>
              <p class="say-meta">
                <span class="say-name">Stone Hub India</span>
              </p>
            </div>
          </li>
          <li class="say-item">
            <div class="say-avatar">
              <img src="assets/people/tumbledry.png" alt="" width="96" height="96">
            </div>
            <div class="say-body">
              <blockquote>
                <p>“It’s been 12 months of our association with SMAC Digital. Their partnership, service delivery and quality control have made us stand out among our competitors, and are some of the key reasons for our expansion. We are grateful to them.”</p>
              </blockquote>
              <p class="say-meta">
                <span class="say-name">Tumbledry</span>
              </p>
            </div>
          </li>
          <li class="say-item">
            <div class="say-avatar">
              <img src="assets/people/belearno.png" alt="" width="96" height="96">
            </div>
            <div class="say-body">
              <blockquote>
                <p>“Online learning and quizzing is on its zenith now and because of SMAC Digital, the students enrolled in our online learning platform Belearno are finding our website handy for their use. Thanks a million SMAC Digital for such great service.”</p>
              </blockquote>
              <p class="say-meta">
                <span class="say-name">Belearno</span>
              </p>
            </div>
          </li>
          <li class="say-item">
            <div class="say-avatar say-avatar-initial" aria-hidden="true"><span>CI</span></div>
            <div class="say-body">
              <blockquote>
                <p>“SMAC Digital gave our interior designing business exposure to the world of the internet. They gave us steady growth by making our website greatly influential. We really appreciate what you did.”</p>
              </blockquote>
              <p class="say-meta">
                <span class="say-name">Casa Interno</span>
              </p>
            </div>
          </li>
          @endif
        </ul>
      </div>
    </section>

    <section class="insights" id="insights" aria-labelledby="insights-title">
      <div class="wrap">
        <header class="blog-head">
          <div class="blog-head-copy">
            <p class="blog-eyebrow">Our blog</p>
            <h2 id="insights-title">
              <span class="blog-title-outline">Exploring trends,</span>
              <span class="blog-title-solid">Sharing perspectives.</span>
            </h2>
          </div>
          <a class="blog-all" href="{{ url('/blog') }}">
            <span class="blog-all-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            View all blogs
          </a>
        </header>

        <div class="blog-layout">
          @if(isset($latestBlogs) && $latestBlogs->isNotEmpty())
            @php $featured = $latestBlogs->first(); $rest = $latestBlogs->slice(1, 2); @endphp
            <article class="blog-featured">
              <a href="{{ url('/blogs/' . $featured->slug) }}">
                <img src="{{ $featured->image_path ? asset($featured->image_path) : asset('assets/blog/lead-generation.jpg') }}" alt="{{ $featured->title }}" width="900" height="700" onerror="this.onerror=null;this.src='{{ asset('assets/blog/lead-generation.jpg') }}';">
                <div class="blog-featured-overlay">
                  <h3>{{ $featured->title }}</h3>
                  <p class="blog-meta">
                    <span>
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" fill="currentColor"/></svg>
                      {{ $featured->category ?? 'Lead generation' }}
                    </span>
                    <span>
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2V3h-2v2H9V3Zm12 8H5v8h14Zm0-4v2H5V7Z" fill="currentColor"/></svg>
                      <time datetime="{{ $featured->published_at ? $featured->published_at->format('Y-m-d') : '' }}">{{ $featured->published_at ? $featured->published_at->format('jS M Y') : '' }}</time>
                    </span>
                  </p>
                  <p class="blog-excerpt">{{ Str::limit(strip_tags($featured->summary ?: $featured->content), 150) }}</p>
                </div>
              </a>
            </article>

            <div class="blog-list" role="list">
              @foreach($rest as $bItem)
              <article class="blog-item" role="listitem">
                <a href="{{ url('/blogs/' . $bItem->slug) }}">
                  <h3>{{ $bItem->title }}</h3>
                  <p class="blog-meta">
                    <span>
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" fill="currentColor"/></svg>
                      {{ $bItem->category ?? 'Growth' }}
                    </span>
                    <span>
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2V3h-2v2H9V3Zm12 8H5v8h14Zm0-4v2H5V7Z" fill="currentColor"/></svg>
                      <time datetime="{{ $bItem->published_at ? $bItem->published_at->format('Y-m-d') : '' }}">{{ $bItem->published_at ? $bItem->published_at->format('jS M Y') : '' }}</time>
                    </span>
                  </p>
                  <p class="blog-excerpt">{{ Str::limit(strip_tags($bItem->summary ?: $bItem->content), 140) }}</p>
                </a>
              </article>
              @endforeach
            </div>
          @else
          <article class="blog-featured">
            <a href="{{ url('/blogs/lead-generation-agency-high-quality-leads') }}">
              <img src="{{ asset('assets/blog/lead-generation.jpg') }}" alt="Person at a laptop with Lead Generation on the screen" width="900" height="700">
              <div class="blog-featured-overlay">
                <h3>Lead Generation Agency: How SMAC Digital Helps Businesses Generate High-Quality Leads</h3>
                <p class="blog-meta">
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" fill="currentColor"/></svg>
                    Lead generation
                  </span>
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2V3h-2v2H9V3Zm12 8H5v8h14Zm0-4v2H5V7Z" fill="currentColor"/></svg>
                    <time datetime="2026-09-26">26th Sept 2026</time>
                  </span>
                </p>
                <p class="blog-excerpt">How SMAC Digital combines performance campaigns, SEO, content, and conversion-focused work to attract relevant inquiries — not just more of them.</p>
              </div>
            </a>
          </article>

          <div class="blog-list" role="list">
            <article class="blog-item" role="listitem">
              <a href="{{ url('/blogs/from-wholesaler-to-d2c-shopify') }}">
                <h3>From Wholesaler to D2C: How Home Decor &amp; Handicraft Manufacturers Can Double Margins with Shopify</h3>
                <p class="blog-meta">
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" fill="currentColor"/></svg>
                    Ecommerce
                  </span>
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2V3h-2v2H9V3Zm12 8H5v8h14Zm0-4v2H5V7Z" fill="currentColor"/></svg>
                    <time datetime="2026-10-16">16th Oct 2026</time>
                  </span>
                </p>
                <p class="blog-excerpt">Why manufacturers stuck on thin wholesale margins are shifting to branded Shopify storefronts — and what changes in the unit economics when you sell direct…</p>
              </a>
            </article>
            <article class="blog-item" role="listitem">
              <a href="{{ url('/blogs/mobile-app-development-company-jaipur') }}">
                <h3>How to Choose the Best Mobile App Development Company in Jaipur for Your Business</h3>
                <p class="blog-meta">
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4Z" fill="currentColor"/></svg>
                    App development
                  </span>
                  <span>
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 3v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2V3h-2v2H9V3Zm12 8H5v8h14Zm0-4v2H5V7Z" fill="currentColor"/></svg>
                    <time datetime="2026-10-10">10th Oct 2026</time>
                  </span>
                </p>
                <p class="blog-excerpt">A practical checklist for picking an app partner in Jaipur — covering process, portfolio fit, and delivery habits that matter after the kickoff call…</p>
              </a>
            </article>
          </div>
          @endif
        </div>
      </div>
    </section>

    <section class="contact" id="contact" aria-labelledby="contact-title">
      <div class="contact-glow" aria-hidden="true"></div>
      <div class="wrap contact-grid">
        <div class="contact-copy">
          <p class="contact-eyebrow">Contact</p>
          <h2 id="contact-title">Ask for a digital audit<br><em>and a growth plan.</em></h2>
          <p class="contact-lead">Tell us what you are building. The form posts to SMAC Digital’s lead desk — a success note appears only after the request is accepted.</p>

          <div class="contact-chips" aria-label="Quick actions">
            <a class="contact-chip" href="tel:+919582792638">
              <span class="contact-chip-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M7.5 3.5h3.2l1 4.2-2 1.2a12.5 12.5 0 0 0 5.4 5.4l1.2-2 4.2 1v3.2a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 3.5 5.7a2 2 0 0 1 2-2.2Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
              </span>
              Call Pune
            </a>
            <a class="contact-chip" href="mailto:Jitendra@smacdigital.com">
              <span class="contact-chip-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M4 6.5h16v11H4Zm0 0 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
              </span>
              Email Jaipur
            </a>
            <a class="contact-chip contact-chip-accent" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
              <span class="contact-chip-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M12 3.5a8.2 8.2 0 0 0-7 12.5L4 20.5l4.6-1.2A8.2 8.2 0 1 0 12 3.5Zm-3.2 5.3c.2-.5.4-.5.7-.5h.5c.2 0 .4 0 .5.4l.7 1.7c.1.2 0 .4-.1.6l-.4.5c-.1.2-.1.4.1.7a6.8 6.8 0 0 0 2 2c.3.2.5.2.7.1l.6-.4c.2-.1.4-.1.6 0l1.6.8c.3.2.4.3.4.5v.5c0 .3 0 .5-.3.7a3.3 3.3 0 0 1-1.6.6c-.9 0-3.1-.4-5.1-2.3-1.8-1.7-2.4-3.6-2.5-4.2 0-.5.2-1 .4-1.3Z" fill="currentColor"/></svg>
              </span>
              WhatsApp
            </a>
          </div>

          <ul class="contact-points">
            <li class="contact-card" data-city="pune">
              <span class="contact-card-flag" aria-hidden="true" title="India">
                <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="8" fill="#FF9933"/><rect y="8" width="36" height="8" fill="#fff"/><rect y="16" width="36" height="8" fill="#138808"/><circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" stroke-width="0.7"/><circle cx="18" cy="12" r="0.55" fill="#000080"/></svg>
              </span>
              <div>
                <strong>Pune</strong>
                <span>Rahul Swami</span>
                <a href="tel:+919582792638">+91 95827 92638</a>
                <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-card" data-city="jaipur">
              <span class="contact-card-flag" aria-hidden="true" title="India">
                <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="8" fill="#FF9933"/><rect y="8" width="36" height="8" fill="#fff"/><rect y="16" width="36" height="8" fill="#138808"/><circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" stroke-width="0.7"/><circle cx="18" cy="12" r="0.55" fill="#000080"/></svg>
              </span>
              <div>
                <strong>Jaipur</strong>
                <span>Jitendra Swami · Business enquiries</span>
                <span>Anukampa Point, Mansarovar, Jaipur</span>
                <a href="tel:+919829069519">+91 98290 69519</a>
                <a href="mailto:Jitendra@smacdigital.com">Jitendra@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-card" data-city="kolkata">
              <span class="contact-card-flag" aria-hidden="true" title="India">
                <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="8" fill="#FF9933"/><rect y="8" width="36" height="8" fill="#fff"/><rect y="16" width="36" height="8" fill="#138808"/><circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" stroke-width="0.7"/><circle cx="18" cy="12" r="0.55" fill="#000080"/></svg>
              </span>
              <div>
                <strong>Kolkata</strong>
                <span>Deep Chakravarty · Business enquiries</span>
                <span>Mukundapur, Kolkata 700099</span>
                <a href="tel:+919831132254">+91 98311 32254</a>
                <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-card" data-city="usa">
              <span class="contact-card-flag" aria-hidden="true" title="USA">
                <svg viewBox="0 0 36 24" focusable="false"><rect width="36" height="24" fill="#B22234"/><path d="M0 2.77h36M0 5.54h36M0 8.31h36M0 11.08h36M0 13.85h36M0 16.62h36M0 19.38h36" stroke="#fff" stroke-width="1.85"/><rect width="14.4" height="12.92" fill="#3C3B6E"/><g fill="#fff"><circle cx="1.8" cy="1.6" r="0.45"/><circle cx="4.2" cy="1.6" r="0.45"/><circle cx="6.6" cy="1.6" r="0.45"/><circle cx="9" cy="1.6" r="0.45"/><circle cx="11.4" cy="1.6" r="0.45"/><circle cx="3" cy="3.1" r="0.45"/><circle cx="5.4" cy="3.1" r="0.45"/><circle cx="7.8" cy="3.1" r="0.45"/><circle cx="10.2" cy="3.1" r="0.45"/><circle cx="1.8" cy="4.6" r="0.45"/><circle cx="4.2" cy="4.6" r="0.45"/><circle cx="6.6" cy="4.6" r="0.45"/><circle cx="9" cy="4.6" r="0.45"/><circle cx="11.4" cy="4.6" r="0.45"/><circle cx="3" cy="6.1" r="0.45"/><circle cx="5.4" cy="6.1" r="0.45"/><circle cx="7.8" cy="6.1" r="0.45"/><circle cx="10.2" cy="6.1" r="0.45"/><circle cx="1.8" cy="7.6" r="0.45"/><circle cx="4.2" cy="7.6" r="0.45"/><circle cx="6.6" cy="7.6" r="0.45"/><circle cx="9" cy="7.6" r="0.45"/><circle cx="11.4" cy="7.6" r="0.45"/><circle cx="3" cy="9.1" r="0.45"/><circle cx="5.4" cy="9.1" r="0.45"/><circle cx="7.8" cy="9.1" r="0.45"/><circle cx="10.2" cy="9.1" r="0.45"/><circle cx="1.8" cy="10.6" r="0.45"/><circle cx="4.2" cy="10.6" r="0.45"/><circle cx="6.6" cy="10.6" r="0.45"/><circle cx="9" cy="10.6" r="0.45"/><circle cx="11.4" cy="10.6" r="0.45"/></g></svg>
              </span>
              <div>
                <strong>United States</strong>
                <span>1507 E Flower Street, Gilbert AZ 85298</span>
              </div>
            </li>
          </ul>
        </div>

        <form class="lead-form" id="lead-form" method="post" action="{{ url('/save-lead') }}" novalidate>
          @csrf
          <div class="lead-form-top">
            <p class="lead-form-kicker">Start a brief</p>
            <h3 class="lead-form-title">Share a few details. We’ll reply with a clear next step.</h3>
          </div>

          <input type="hidden" name="landing_url" value="">
          <input type="hidden" name="referrer_url" value="">
          <input type="hidden" name="utm_source" value="">
          <input type="hidden" name="utm_medium" value="">
          <input type="hidden" name="utm_campaign" value="">
          <input type="hidden" name="utm_term" value="">
          <input type="hidden" name="utm_content" value="">
          <input type="hidden" name="utm_id" value="">
          <input type="hidden" name="gclid" value="">
          <input type="hidden" name="fbclid" value="">

          <div class="field field-float">
            <input id="full-name" name="name" type="text" autocomplete="name" placeholder=" " required>
            <label for="full-name">Full name</label>
            <p class="field-error" id="full-name-error" hidden></p>
          </div>
          <div class="field field-float">
            <input id="email" name="email" type="email" autocomplete="email" placeholder=" " required>
            <label for="email">Business email</label>
            <p class="field-error" id="email-error" hidden></p>
          </div>
          <div class="field-row">
            <div class="field field-float">
              <input id="phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder=" " required>
              <label for="phone">Phone number</label>
              <p class="field-error" id="phone-error" hidden></p>
            </div>
            <div class="field field-float">
              <input id="company" name="company" type="text" autocomplete="organization" placeholder=" ">
              <label for="company">Company or website</label>
              <p class="field-error" id="company-error" hidden></p>
            </div>
          </div>
          <fieldset class="field field-services">
            <legend>Services of interest</legend>
            <div class="checks">
              <label class="service-pill"><input type="checkbox" name="service" value="Marketing Automation"><span>Marketing automation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Inbound Marketing"><span>Inbound</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Social Media Marketing"><span>Social media</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Search Engine Optimization"><span>SEO</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Video Marketing"><span>Video</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Website Design and Development"><span>Website</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Mobile Application Development"><span>Mobile app</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Digital Media Planning"><span>Media planning</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Lead Generation"><span>Lead generation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Content Marketing"><span>Content</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Online Reputation Management"><span>Reputation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Social Media Analytics"><span>Analytics</span></label>
            </div>
            <p class="field-error" id="service-error" hidden></p>
          </fieldset>
          <div class="field field-float field-textarea">
            <textarea id="requirements" name="message" rows="4" placeholder=" " required></textarea>
            <label for="requirements">Project requirements</label>
            <p class="field-error" id="requirements-error" hidden></p>
          </div>
          <button class="lead-submit" type="submit" data-submit>
            <span>Get a free consultation</span>
            <span class="lead-submit-arrow" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
          </button>
          <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
          <p class="form-fallback">Prefer the existing contact page? <a href="{{ url('/contact') }}">Continue on smacdigital.com</a>.</p>
        </form>
      </div>
    </section>

    <section class="partners" id="partners" aria-labelledby="partners-title">
      <div class="partners-glow" aria-hidden="true"></div>
      <div class="wrap">
        <header class="partners-head">
          <div>
            <p class="partners-eyebrow">Ecosystem</p>
            <h2 id="partners-title">Our working<br><em>partners.</em></h2>
          </div>
          <p class="partners-lead">The platforms we plan, build, and advertise with — from media buying and CRM to commerce and creative tooling.</p>
        </header>

        <ul class="partners-grid" role="list">
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Meta">
              <svg viewBox="0 0 40 24" aria-hidden="true"><path fill="#0866FF" d="M20 19.8c-2.9 2.9-6.1 4.4-8.7 4.4-1.8 0-3-.9-3-2.7 0-2.2 1.2-4.8 3-8.2C13.2 9.6 15.1 7.6 16.9 7.6c.8 0 1.5.4 2.4 1.5L20 10.4l.7-1.3c.9-1.1 1.6-1.5 2.4-1.5 1.8 0 3.7 2 5.6 5.7 1.8 3.4 3 6 3 8.2 0 1.8-1.2 2.7-3 2.7-2.6 0-5.8-1.5-8.7-4.4Z"/></svg>
              <span>Meta</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Adobe">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="#EB1000" d="M13.1 2.2 23 21.8h-5.1l-2-4.4H8.1l-2 4.4H1L10.9 2.2h2.2Zm-1.1 5.8L9.3 14h5.4l-2.7-6Z"/></svg>
              <span class="is-adobe">Adobe</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="HubSpot">
              <span>HubSp</span>
              <svg class="is-hub" viewBox="0 0 22 22" aria-hidden="true"><circle cx="11" cy="12.2" r="5.2" fill="#FF7A59"/><circle cx="11" cy="12.2" r="2.1" fill="#fff"/><circle cx="16.8" cy="4.6" r="2.3" fill="#FF7A59"/><path fill="#FF7A59" d="m14.4 6.9-1.6 1.6a5.8 5.8 0 0 1 1.7 2.3l1.9-1a3.9 3.9 0 0 0-2-2.9Z"/></svg>
              <span>t</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Google Ads">
              <svg viewBox="0 0 30 24" aria-hidden="true"><path fill="#FBBC04" d="m8.2 19.8 7.6-16.2A1.9 1.9 0 0 1 19.1 3l7.6 16.2a1.9 1.9 0 0 1-1.7 2.8H9.9a1.9 1.9 0 0 1-1.7-2.2Z"/><path fill="#4285F4" d="M8.2 19.8 1.2 4.8A1.9 1.9 0 0 1 2.9 2l16.2 3.6-10.9 14.2Z"/><circle cx="22.6" cy="20.2" r="3.4" fill="#34A853"/></svg>
              <span class="is-muted">Google Ads</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="LinkedIn Ads">
              <span>Linked</span>
              <span class="partner-in" aria-hidden="true">in</span>
              <span class="is-muted">ads</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Bitrix24">
              <span class="is-bitrix">Bitrix</span>
              <span class="is-bitrix-num">24</span>
              <svg class="is-clock" viewBox="0 0 22 22" aria-hidden="true"><circle cx="11" cy="11" r="8.4" fill="none" stroke="#2FC6F6" stroke-width="2"/><circle cx="11" cy="11" r="2" fill="#FF5752"/><path d="M11 6.6V11l3.4 1.9" fill="none" stroke="#525C69" stroke-width="1.7" stroke-linecap="round"/></svg>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Shopify">
              <svg viewBox="0 0 22 24" aria-hidden="true"><path fill="#95BF47" d="M4.1 5.1 2.6 21.4c0 .4.2.6.6.7l9.1 1.6c.4.1.7-.1.8-.5L17.6 3.3c0-.3-.2-.5-.5-.5h-3.6S13.1.2 12.2.2c-.9 0-3.9 1.1-5.1 2.6H4.6c-.3 0-.5.2-.5.5v1.8Zm7.1-1.4c-.5.9-1 2.1-1 2.1H6.9c.9-1.2 2.8-2.3 3.9-2.7.2.2.3.4.4.6Z"/><path fill="#5E8E3E" d="M11.2 3.7c-.1-.2-.2-.4-.4-.6h.3c.9 0 1.3 2.6 1.3 2.6h-1.6s.5-1.2 1-2.1c-.2.1-.4.1-.6.1Z"/></svg>
              <span class="is-shopify">shopify</span>
            </span>
          </li>
          <li class="partner-cell">
            <span class="partner-logo" aria-label="Envato">
              <svg viewBox="0 0 18 24" aria-hidden="true"><path fill="#82B541" d="M9.3 1.7C6.5 6.1 2.5 12 1.3 17c-.6 2.5.5 5.1 2.8 6.1 2 .9 4.3.3 5.6-1.4 2.1-2.8 2.5-6.7 1.6-11.1-.5 2.8-1.6 5.1-3.2 6.2C11.2 11.9 12.9 6.7 12.9 3.5c0-1.4-.5-2.2-1.4-2.2-.8 0-1.6.7-2.2 1.4Z"/></svg>
              <span class="is-envato">envato</span>
            </span>
          </li>
        </ul>
      </div>
    </section>
  
@endsection
