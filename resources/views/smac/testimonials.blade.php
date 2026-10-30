@extends('smac.layout')

@section('title', $page->metatitle ?? 'Client Testimonials & Reviews | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Read verified client testimonials and case reviews from leading Indian brands that scaled their organic visibility and revenue with SMAC Digital.')
@section('meta_keywords', $page->metakeywords ?? 'Client Testimonials, Customer Reviews, SMAC Digital Ratings, Digital Marketing Case Studies')

@section('content')

    <!-- Inner Hero Section with Creative Proof & Impact Stats -->
    <section class="hero inner-hero" aria-labelledby="testimonials-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Client Stories &amp; Testimonials</p>
        <h1 id="testimonials-hero-title">
          <span>Real partners.</span><br>
          <em>Measurable growth.</em>
        </h1>
        <p class="lede">From national laundry networks and premier educational colleges to luxury marble leaders and couture designers — here is what founders and marketing leaders say about partnering with SMAC Digital.</p>
        
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url('/contact') }}">Start your journey</a>
          <span class="or" aria-hidden="true">or</span>
          <button type="button" class="btn btn-black" data-open-lead-modal>Start a brief</button>
        </div>
      </div>
    </section>

    <!-- Impact Metrics Section in Container -->
    <section class="test-stats-section" aria-label="SMAC Digital Impact Metrics">
      <div class="container wrap">
        <div class="test-stats-row">
          <div class="test-stat-item">
            <span class="test-stat-num">33%+</span>
            <span class="test-stat-label">Average Contract &amp; Leads Lift</span>
          </div>
          <div class="test-stat-item">
            <span class="test-stat-num">12+</span>
            <span class="test-stat-label">Months Average Client Tenure</span>
          </div>
          <div class="test-stat-item">
            <span class="test-stat-num">100%</span>
            <span class="test-stat-label">Agreed Deliverables Fulfilled</span>
          </div>
          <div class="test-stat-item">
            <span class="test-stat-num">5.0 ★</span>
            <span class="test-stat-label">Verified Client Satisfaction</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Grid Section -->
    <section class="page-section" style="padding-top: 3.5rem; padding-bottom: 5rem;">
      <div class="wrap">
        
        @php
          $clientMeta = [
            'Stone Hub India' => ['cat' => 'b2b', 'highlight' => '+33% Contracts Growth', 'service' => 'Web Setup & SEO Strategy'],
            'Tumbledry' => ['cat' => 'retail', 'highlight' => '12+ Months Partnership', 'service' => 'Service Delivery & Expansion'],
            'Belearno' => ['cat' => 'edtech', 'highlight' => 'Handy Platform Experience', 'service' => 'EdTech Web & UX'],
            'Casa Interno' => ['cat' => 'b2b', 'highlight' => 'Steady Business Growth', 'service' => 'Website Influence & Reach'],
            'GK Ratnam' => ['cat' => 'lifestyle', 'highlight' => 'Royal & Classy Web Presence', 'service' => 'Luxury E-Commerce'],
            'Affeem' => ['cat' => 'lifestyle', 'highlight' => 'Customer Base Expansion', 'service' => 'Creative Marketing Plan'],
            'Tirupati College, Jaipur' => ['cat' => 'edtech', 'highlight' => 'Online Admissions Growth', 'service' => 'Digital Presence & Lead Gen'],
            'Smart Home, Jaipur' => ['cat' => 'b2b', 'highlight' => 'Clear Project Showcase', 'service' => 'Real Estate Web Development'],
            'Suman Pasari' => ['cat' => 'lifestyle', 'highlight' => 'Terms & Deliverables Met', 'service' => 'Social Media Campaign'],
            "TiSwa's Kitchen" => ['cat' => 'lifestyle', 'highlight' => 'Majority Targets Achieved', 'service' => 'Themed Restaurant Campaign'],
            "TiSwa’s Kitchen" => ['cat' => 'lifestyle', 'highlight' => 'Majority Targets Achieved', 'service' => 'Themed Restaurant Campaign'],
          ];
        @endphp

        <!-- Creative Filter Toolbar -->
        <div class="test-filter-wrap">
          <div class="test-filter-tabs" role="tablist" aria-label="Filter testimonials by industry">
            <button type="button" class="test-filter-btn is-active" data-filter="all">
              <span>All Stories</span>
              <span class="test-filter-count">{{ count($testimonials) }}</span>
            </button>
            <button type="button" class="test-filter-btn" data-filter="b2b">
              <span>B2B &amp; Architecture</span>
              <span class="test-filter-count">3</span>
            </button>
            <button type="button" class="test-filter-btn" data-filter="edtech">
              <span>Education &amp; EdTech</span>
              <span class="test-filter-count">2</span>
            </button>
            <button type="button" class="test-filter-btn" data-filter="retail">
              <span>Retail &amp; Chains</span>
              <span class="test-filter-count">1</span>
            </button>
            <button type="button" class="test-filter-btn" data-filter="lifestyle">
              <span>Luxury &amp; Lifestyle</span>
              <span class="test-filter-count">4</span>
            </button>
          </div>

          <div class="test-rating-summary">
            <span class="test-stars-gold" aria-hidden="true">
              <svg viewBox="0 0 20 20" width="16" height="16" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              <svg viewBox="0 0 20 20" width="16" height="16" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              <svg viewBox="0 0 20 20" width="16" height="16" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              <svg viewBox="0 0 20 20" width="16" height="16" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
              <svg viewBox="0 0 20 20" width="16" height="16" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </span>
            <span><strong>5.0 / 5.0</strong> Client Rating</span>
          </div>
        </div>

        <!-- Creative Grid -->
        <div class="testimonial-creative-grid" id="testimonial-grid">
          @forelse($testimonials as $test)
            @php
              $meta = $clientMeta[$test->name] ?? ['cat' => 'b2b', 'highlight' => 'Verified Milestone', 'service' => 'Digital Marketing'];
              $avatar = !empty($test->avatar_path) ? $test->avatar_path : null;
              
              $words = preg_split('/\s+/', trim($test->name));
              $initials = count($words) >= 2 
                ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) 
                : strtoupper(substr($test->name, 0, 2));
            @endphp
            
            <article class="testimonial-card-creative" data-category="{{ $meta['cat'] }}">
              <!-- Watermark Quote Mark -->
              <span class="testimonial-card-watermark" aria-hidden="true">
                <svg viewBox="0 0 24 24" width="56" height="56" fill="currentColor">
                  <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
              </span>

              <!-- Top Row: Rating & Verified Badge -->
              <div class="testimonial-card-top">
                <div class="test-stars-row" aria-label="5 out of 5 stars">
                  @for($s = 0; $s < 5; $s++)
                    <svg viewBox="0 0 20 20" width="15" height="15" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                  @endfor
                </div>
                <span class="test-verified-badge">
                  <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                  Verified Partner
                </span>
              </div>

              <!-- Quote Body -->
              <div class="testimonial-quote-body">
                <blockquote>&ldquo;{{ $test->content }}&rdquo;</blockquote>
                <div class="testimonial-highlight-tag">
                  <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                  <span>{{ $meta['highlight'] }}</span>
                </div>
              </div>

              <!-- Client Author Footer -->
              <div class="testimonial-card-client">
                <div class="test-avatar-frame">
                  @if(!empty($avatar))
                    <img src="{{ site_image($avatar) }}" alt="{{ $test->name }}" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="test-avatar-fallback" style="display: none;">{{ $initials }}</div>
                  @else
                    <div class="test-avatar-fallback">{{ $initials }}</div>
                  @endif
                </div>
                <div class="test-client-meta">
                  <h3 class="test-client-name">{{ $test->name }}</h3>
                  <p class="test-client-role">{{ $test->role }}</p>
                </div>
              </div>
            </article>
          @empty
            <p style="grid-column: 1 / -1; text-align: center; color: var(--muted); padding: 3rem 0;">No client testimonials found.</p>
          @endforelse
        </div>

        <!-- Why Industry Leaders Choose SMAC Digital -->
        <div class="test-pillars-wrap">
          <header class="test-pillars-head">
            <p class="page-eyebrow dark"><span aria-hidden="true">&raquo;</span> Why SMAC Digital</p>
            <h2 class="test-pillars-title">
              Built on strategy.<br>
              <em>Sustained by performance.</em>
            </h2>
            <p class="about-section-lead">Every brand collaboration is anchored in tangible commercial outcomes &mdash; blending organic search visibility, high-converting digital architecture, and strategic media campaigns.</p>
          </header>
          <div class="test-pillars-grid">
            <article class="test-pillar-card">
              <span class="test-pillar-step">01 &middot; COMMERCIAL IMPACT</span>
              <h3>Measurable Commercial ROI</h3>
              <p>We tie digital marketing campaigns directly to pipeline volume, qualified business inquiries, and revenue expansion.</p>
            </article>
            <article class="test-pillar-card">
              <span class="test-pillar-step">02 &middot; LONG-TERM TRUST</span>
              <h3>Committed Partnership</h3>
              <p>Transparent communication, reliable turnaround times, and proactive strategic recommendations that stand the test of time.</p>
            </article>
            <article class="test-pillar-card">
              <span class="test-pillar-step">03 &middot; UNIFIED CRAFT</span>
              <h3>Full-Stack Capability</h3>
              <p>Search, Social, Mobile, Analytics, and Cloud &mdash; unified under one roof to give brands a decisive digital advantage.</p>
            </article>
          </div>
        </div>

      </div>
    </section>

    <!-- Bottom Red CTA Banner -->
    <section class="about-cta about-cta--red" aria-labelledby="testimonials-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="testimonials-cta-title">
            Trusted by growing brands.
            <em>Become the next story.</em>
          </h2>
          <p>Hear how teams use SMAC Digital to improve visibility, engagement, and ROI — then start a conversation about your next milestone.</p>
          <div class="about-cta-actions">
            <button type="button" class="btn btn-white" data-open-lead-modal>Get a free consultation</button>
            <span class="or" aria-hidden="true">or</span>
            <a class="btn btn-black" href="{{ url('/portfolios') }}">See our work</a>
          </div>
        </div>
        <aside class="about-cta-panel about-cta-panel--creative">
          <div class="about-cta-panel-glow" aria-hidden="true"></div>
          <div class="about-cta-panel-top">
            <span class="about-cta-live"><i></i> Available now</span>
            <p class="about-cta-kicker">Prefer a direct call?</p>
          </div>
          <div class="about-cta-phones">
            <a class="about-cta-phone" href="tel:+919582792638">
              <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
              <span>
                <small>Delhi NCR</small>
                <strong>+91 95827 92638</strong>
              </span>
            </a>
            <a class="about-cta-phone" href="tel:+919829069519">
              <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
              <span>
                <small>Jaipur</small>
                <strong>+91 98290 69519</strong>
              </span>
            </a>
          </div>
          <a class="about-cta-wa" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
            <span class="about-cta-wa-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg></span>
            <span>
              <strong>WhatsApp the team</strong>
              <small>Usually replies in minutes</small>
            </span>
          </a>
        </aside>
      </div>
    </section>

    <!-- Client-Side Filter Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var filterBtns = document.querySelectorAll('.test-filter-btn');
        var cards = document.querySelectorAll('.testimonial-card-creative');

        filterBtns.forEach(function(btn) {
          btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('is-active'); });
            this.classList.add('is-active');
            var filter = this.getAttribute('data-filter');

            cards.forEach(function(card) {
              var cat = card.getAttribute('data-category');
              if (filter === 'all' || cat === filter) {
                card.style.display = 'flex';
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                setTimeout(function() {
                  card.style.transition = 'opacity 0.28s ease, transform 0.28s ease';
                  card.style.opacity = '1';
                  card.style.transform = 'translateY(0)';
                }, 20);
              } else {
                card.style.display = 'none';
              }
            });
          });
        });
      });
    </script>
@endsection
