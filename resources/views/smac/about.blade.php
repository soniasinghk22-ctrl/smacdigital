@extends('smac.layout')

@section('title', $page->metatitle ?? 'About Us | Best Digital Marketing Agency in India | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Learn about SMAC Digital, a pioneer digital marketing company in Jaipur, Pune, and Kolkata driving results through Social, Mobile, Analytics, and Cloud.')
@section('meta_keywords', $page->metakeywords ?? 'About SMAC Digital, Digital Marketing Agency Jaipur, Marketing Team')

@section('content')

    
    
    <section class="hero inner-hero" aria-labelledby="about-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">About SMAC</p>
        <h1 id="about-hero-title">
          <span>A performance-driven</span><br>
          <em>digital marketing agency.</em>
        </h1>
        <p class="lede">SMAC gives you the opportunity to create your niche in the global marketplace through targeted marketing and communication strategies. Our ultimate goal is to make consumers associate your brand with a smile.</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url('/contact') }}">Talk to us</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="{{ url('/contact') }}">Get a free consultation</a>
        </div>
      </div>
    </section>
    <section class="about-who" aria-labelledby="who-title">
      <div class="about-who-bg" aria-hidden="true"></div>
      <div class="wrap about-who-grid">
        <div class="about-who-copy">
          <p class="page-eyebrow dark">Who we are</p>
          <h2 id="who-title">Social · Mobile · Analytics · Cloud</h2>
          <p>SMAC defines as S-Social, M-Mobile, A-Analytics and C-Cloud — four elements changing the digital world. We adopted this name to become the front face of growth in digital marketing.</p>
          <p>We commit to performance and aim to over-deliver every time. We adapt to the strengths and weaknesses of each business. We are digital transformers who create perception that drives brand adaptability in the consumer mindset.</p>
        </div>
        <aside class="about-who-metrics" aria-label="Company results">
          <article class="about-metric about-metric-lg">
            <strong>$2M+</strong>
            <span>Monthly online sales</span>
          </article>
          <article class="about-metric">
            <strong>400%+</strong>
            <span>Traffic growth</span>
          </article>
          <article class="about-metric">
            <strong>1000+</strong>
            <span>Keywords ranking in a month</span>
          </article>
          <article class="about-metric">
            <strong>30k+</strong>
            <span>Dealer acquisition</span>
          </article>
        </aside>
      </div>
    </section>
    <section class="about-vm" aria-labelledby="vision-title">
      <div class="wrap about-vm-row">
        <div class="about-vm-media">
          <img src="assets/work/stone-hub.jpg" alt="Brand work from SMAC Digital partners" width="720" height="520" loading="lazy">
        </div>
        <div class="about-vm-copy">
          <p class="page-eyebrow dark">Vision</p>
          <h2 id="vision-title">Make every brand feel inevitable in its market.</h2>
          <p>We see a digital world where ambitious businesses do not fight for attention with noise — they earn it with clarity, craft, and measurable growth. SMAC exists to turn strategy, creativity, and technology into one performance system.</p>
          <p>Our vision is simple: consumers should associate your brand with a smile — and your dashboard with results that justify every rupee and dollar invested.</p>
        </div>
      </div>
    </section>

    <section class="about-vm about-vm-tint" aria-labelledby="mission-title">
      <div class="wrap about-vm-row is-flip">
        <div class="about-vm-media">
          <img src="assets/services/website.jpg" alt="Digital product and marketing craft" width="720" height="520" loading="lazy">
        </div>
        <div class="about-vm-copy">
          <p class="page-eyebrow dark">Mission</p>
          <h2 id="mission-title">Help businesses create their niche in the global marketplace.</h2>
          <p>We combine targeted marketing and communication strategies across Social, Mobile, Analytics, and Cloud — so brands reach the right audience and convert attention into revenue.</p>
          <ul class="about-vm-list">
            <li>Plan campaigns and product experiences as one growth system</li>
            <li>Ship work that can be measured — traffic quality, leads, and sales</li>
            <li>Stay close to Google’s ecosystem as a Partner while keeping craft honest</li>
            <li>Serve teams across India and the US with the same performance standard</li>
          </ul>
        </div>
      </div>
    </section>

    <section class="page-section" aria-labelledby="work-title">
      <div class="wrap">
        <p class="page-eyebrow dark">How we work</p>
        <h2 id="work-title">Beyond a marketing agency</h2>
        <p class="about-section-lead">We adapt to the strengths and weaknesses of each business. The goal is brand adaptability in the consumer mindset — not vanity metrics.</p>
        <div class="page-card-grid about-work-grid">
          <article class="page-card">
            <span class="about-step">01</span>
            <h3>Association</h3>
            <p>For a successful brand, you need a sense of association. Creating identity through cognizance is our primary goal.</p>
          </article>
          <article class="page-card">
            <span class="about-step">02</span>
            <h3>Full stack growth</h3>
            <p>Marketing automation, inbound, social, SEO, video, websites, and mobile apps — planned as one system.</p>
          </article>
          <article class="page-card">
            <span class="about-step">03</span>
            <h3>Amplification</h3>
            <p>We ride digital amplification to boost growth — with measurement that keeps teams honest.</p>
          </article>
        </div>
      </div>
    </section>

    <section class="about-presence" aria-labelledby="presence-title">
      <div class="about-presence-pattern" aria-hidden="true"></div>
      <div class="wrap">
        <header class="about-presence-head">
          <p class="page-eyebrow">Presence</p>
          <h2 id="presence-title">Built across India. Connected to the US.</h2>
          <p>Teams in Pune, Jaipur, and Kolkata — with a US desk in Gilbert, Arizona — so briefs move across time zones without losing ownership.</p>
        </header>
        <ul class="about-office-grid" role="list">
          <li>
            <strong>Pune</strong>
            <span>Business enquiries</span>
            <a href="tel:+919582792638">+91 95827 92638</a>
          </li>
          <li>
            <strong>Jaipur</strong>
            <span>Anukampa Point, Mansarovar</span>
            <a href="tel:+919829069519">+91 98290 69519</a>
          </li>
          <li>
            <strong>Kolkata</strong>
            <span>Mukundapur, Kolkata 700099</span>
            <a href="tel:+919831132254">+91 98311 32254</a>
          </li>
          <li>
            <strong>USA</strong>
            <span>Gilbert, Arizona 85298</span>
            <a href="{{ url('/contact') }}">Start a brief</a>
          </li>
        </ul>
      </div>
    </section>

    <section class="about-team" aria-labelledby="team-title">
      <div class="about-team-bg" aria-hidden="true"></div>
      <div class="wrap">
        <header class="about-team-head">
          <p class="page-eyebrow">Team</p>
          <h2 id="team-title">Talk to the people who run the brief.</h2>
          <p>Business enquiries across Pune, Jaipur, and Kolkata — the same team that owns delivery from kickoff to reporting.</p>
        </header>
        <ul class="about-team-grid" role="list">
          <li class="about-team-card">
            <div class="about-team-top">
              <img src="assets/people/rahul-swami.png" width="88" height="88" alt="Rahul Swami" loading="lazy">
              <div>
                <h3>Rahul Swami</h3>
                <p class="about-team-role">For Business Enquiries · Pune</p>
              </div>
            </div>
            <p class="about-team-address">4th Floor, Krishna Avenue, Above Dominos, Opposite D MART, Near Sadanand Hotel, Baner Road, Baner, Pune, Maharashtra 411045</p>
            <div class="about-team-links">
              <a href="tel:+919582792638">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>
                +91 95827 92638
              </a>
              <a href="mailto:rahul@smacdigital.com">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/></svg>
                rahul@smacdigital.com
              </a>
            </div>
          </li>
          <li class="about-team-card">
            <div class="about-team-top">
              <img src="assets/people/jitendra-swami.png" width="88" height="88" alt="Jitendra Swami" loading="lazy">
              <div>
                <h3>Jitendra Swami</h3>
                <p class="about-team-role">For Business Enquiries · Jaipur</p>
              </div>
            </div>
            <p class="about-team-address">Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur, Rajasthan 302020</p>
            <div class="about-team-links">
              <a href="tel:+919829069519">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>
                +91 98290 69519
              </a>
              <a href="mailto:Jitendra@smacdigital.com">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/></svg>
                Jitendra@smacdigital.com
              </a>
            </div>
          </li>
          <li class="about-team-card">
            <div class="about-team-top">
              <img src="assets/people/deep-chakravarty.png" width="88" height="88" alt="Deep Chakravarty" loading="lazy">
              <div>
                <h3>Deep Chakravarty</h3>
                <p class="about-team-role">For Business Enquiries · Kolkata</p>
              </div>
            </div>
            <p class="about-team-address">Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</p>
            <div class="about-team-links">
              <a href="tel:+919831132254">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>
                +91 98311 32254
              </a>
              <a href="mailto:deep@smacdigital.com">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/></svg>
                deep@smacdigital.com
              </a>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <section class="about-partner" aria-labelledby="partner-title">
      <div class="wrap about-partner-inner">
        <img src="assets/brand/google-partner.png" width="140" height="56" alt="Google Partner">
        <div>
          <p class="page-eyebrow dark">Ecosystem</p>
          <h2 id="partner-title">Google Partner, performance mindset.</h2>
          <p>We plan, buy, and measure inside the platforms brands already trust — then connect that media to websites, apps, content, and CRM follow-up.</p>
        </div>
        <a class="btn btn-primary" href="{{ url('/services') }}">Explore services</a>
      </div>
    </section>

    <section class="about-faq" aria-labelledby="faq-title">
      <div class="wrap about-faq-grid">
        <div class="about-faq-intro">
          <p class="page-eyebrow dark">FAQ</p>
          <h2 id="faq-title">Questions teams ask before they start.</h2>
          <p>Straight answers about how SMAC Digital works — so you know what to expect before the first workshop.</p>
          <a class="btn btn-navy" href="{{ url('/contact') }}">Still unsure? Talk to us</a>
        </div>
        <div class="about-faq-list">
          <details class="about-faq-item" open>
            <summary>What does SMAC stand for?</summary>
            <p>SMAC stands for Social, Mobile, Analytics, and Cloud — four elements shaping digital growth. We named the agency around them so strategy, media, and product work stay connected.</p>
          </details>
          <details class="about-faq-item">
            <summary>Which services do you typically combine?</summary>
            <p>Most engagements mix SEO, social, content, lead generation, and website or app work. We plan them as one system so traffic, creative, and conversion share the same goals.</p>
          </details>
          <details class="about-faq-item">
            <summary>Do you work with national and international brands?</summary>
            <p>Yes. We support businesses across India and international clients from our US desk. Geography changes the plan — national and international SEO, media, and messaging are not the same playbook.</p>
          </details>
          <details class="about-faq-item">
            <summary>How do you measure success?</summary>
            <p>By outcomes that matter to the business: quality traffic, inquiries, dealer acquisition, and online sales — not vanity impressions alone. Reporting stays tied to the brief you approve.</p>
          </details>
          <details class="about-faq-item">
            <summary>How do we get started?</summary>
            <p>Share your goals through Contact or WhatsApp. We map a clear next step — often a digital audit and growth plan — before recommending a full engagement.</p>
          </details>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="about-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="about-cta-title">
            Improve the bottom line.
            <em>Generate positive ROI.</em>
          </h2>
          <p>Partner with a team that blends strategy, creative, and media to grow brands with measurable outcomes across India and beyond.</p>
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
  
@endsection
