@extends('smac.layout')

@section('title', $page->metatitle ?? 'Marketing Automation Services in Jaipur | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Smac Digital is a marketing automation service agency in Jaipur providing a range of marketing with integrations, consultation, and implementation')
@section('meta_keywords', $page->metakeywords ?? 'Marketing Automation, Marketing Automation Services in Jaipur, Marketing automation agency, marketing automation services, Marketing Automation Implementation Services Provider')

@section('content')


    <section class="hero inner-hero" aria-labelledby="svc-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="svc-hero-title">
          <span>Marketing</span><br>
          <em>Automation</em>
        </h1>
        <p class="lede">In digital marketing, software is used for repetitive marketing functions like email marketing and social media marketing. These automation tools make the work easier and provide customised service to the customer.</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url('/contact') }}">Make a Call Now</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="{{ url('/contact') }}">Get a free consultation</a>
        </div>
      </div>
    </section>

    
    <section class="svc-pillars" aria-label="How we work">
      <div class="svc-pillars-pattern" aria-hidden="true"></div>
      <div class="wrap">
        <header class="svc-pillars-head">
          <div>
            <p class="pill">How we work</p>
            <h2>Four moves. One outcome.</h2>
          </div>
          <p>A tight rhythm from brief to growth — strategy, delivery, proof, and iteration without the fluff.</p>
        </header>
        <ul class="svc-pillars-grid" role="list">
          
            <li class="svc-pillar">
              <span class="svc-pillar-num">01</span>
              <strong>Strategy</strong>
              <p>Goals first — then tactics that fit the brand.</p>
            </li>
            <li class="svc-pillar">
              <span class="svc-pillar-num">02</span>
              <strong>Execution</strong>
              <p>Hands-on delivery across creative, media, and tech.</p>
            </li>
            <li class="svc-pillar">
              <span class="svc-pillar-num">03</span>
              <strong>Measurement</strong>
              <p>Clear reporting so you know what moved the needle.</p>
            </li>
            <li class="svc-pillar">
              <span class="svc-pillar-num">04</span>
              <strong>Growth</strong>
              <p>Iterate toward quality traffic and real leads.</p>
            </li>
        </ul>
      </div>
    </section>

    <section class="svc-intro-band">
      <div class="wrap svc-intro-grid">
        <figure class="svc-intro-media">
          <img src="/assets/services/automation.jpg" alt="" width="900" height="1100" loading="lazy">
          <figcaption>Journeys that nurture</figcaption>
        </figure>
        <div class="svc-intro-content">
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
          <div class="svc-intro-copy"><p>In digital marketing, much software is used for repetitive marketing functions like email marketing, social media marketing, etc. These automation software not only make the work easier but also provide a customised service to the customer. With a rise in the digital marketing era, investment in marketing automation has been doubled.</p><p>At SMAC Digital we provide marketing automation services, namely email marketing, social media posting, ad campaigns, and many more, in an efficient and customised manner, as per the client's requirements.</p></div>
        </div>
      </div>
    </section>

    
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">01</p>
          <h2>What is Marketing Automation?</h2>
          <p>Marketing automation is the software that helps in the mechanization of the redundant marketing process. Some of the repetitive tasks which are done automated to save time are as follows –</p>
          <ul class="svc-check-list"><li>Manual creation of email</li><li>SMS messaging</li><li>Social media post dissemination</li><li>Widget content of the website</li><li>Advertisement placement online</li><li>Data management and analysis</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-dashboard.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">02</p>
          <h2>Why is marketing automation essential?</h2>
          <p>In general, companies that use marketing automation witness more traffic on their website. This traffic brings more buyers and higher retention and loyalty of customers. It will provide a personalized one to one connection, and most of the users have witnessed a sound increase in their sales with it.</p>
          <ul class="svc-check-list"><li><strong>Time-saving:</strong> campaigns could be framed ahead of time and customized posts scheduled for the audience.</li><li><strong>Increase productivity:</strong> frees the marketing team from repetitive tasks for more productive work.</li><li><strong>Multi-channel campaign management:</strong> keeps track of campaigns across platforms in one channelized form.</li><li><strong>Personalization:</strong> personalized services that improve business efficiency.</li><li><strong>Consistent voice tone:</strong> unifies the marketing tone of your campaign.</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-laptop.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">03</p>
          <h2>Myths about marketing automation</h2>
          <p>There are a few myths associated with marketing automation due to its fully automated function.</p>
          <ul class="svc-check-list"><li><strong>Myth #1:</strong> Marketing automation is all about bulk email — it also applies to lead generation, social media, and management activities.</li><li><strong>Myth #2:</strong> Marketing Automation is all about spam — messages without customization feel like spam; we focus on personalized delivery.</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-growth.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>

    
    <section class="svc-process">
      <div class="wrap">
        <header class="svc-process-head">
          <p class="page-eyebrow dark">Engagement</p>
          <h2>A clear path from brief to results</h2>
          <p class="svc-process-lead">The same disciplined rhythm we use across SMAC Digital engagements — adapted for Marketing Automation.</p>
        </header>
        <ol class="svc-process-track">
          
            <li>
              <span class="svc-process-step">01</span>
              <h3>Discover</h3>
              <p>Audit the current footprint, keywords, and competitors.</p>
            </li>
            <li>
              <span class="svc-process-step">02</span>
              <h3>Plan</h3>
              <p>Build a roadmap tied to short- and long-term business goals.</p>
            </li>
            <li>
              <span class="svc-process-step">03</span>
              <h3>Build</h3>
              <p>Ship on-page, content, and offsite work with white-hat craft.</p>
            </li>
            <li>
              <span class="svc-process-step">04</span>
              <h3>Grow</h3>
              <p>Track rankings, traffic quality, and leads — then refine.</p>
            </li>
        </ol>
      </div>
    </section>

    
    <section class="svc-why">
      <div class="wrap">
        <p class="page-eyebrow">Why SMAC Digital</p>
        <h2>How SMAC DIGITAL will help you with Marketing Automation</h2>
        <div class="svc-why-grid">
          
            <article class="svc-why-card">
              <span>01</span>
              <h3>Encourage opt-ins</h3>
              <p>We help you receive quality traffic from search or social media so that the marketing automation list could be prepared. We provide quality content so visitors get engaged and organic traffic could be fetched.</p>
            </article>
            <article class="svc-why-card">
              <span>02</span>
              <h3>Deliver your opt-in promise</h3>
              <p>When the user subscribes, we begin the requisite conversation — e-book, newsletter or other content — so subscribers convert into quality leads.</p>
            </article>
            <article class="svc-why-card">
              <span>03</span>
              <h3>Identify motivated subscribers</h3>
              <p>We analyze to identify motivated subscribers, categorize warm and cold leads, and prepare different strategies so warm leads convert into customers.</p>
            </article>
            <article class="svc-why-card">
              <span>04</span>
              <h3>Warm leads to sales</h3>
              <p>After segmentation, we provide warm leads to your sales team and notify staff for quick follow up.</p>
            </article>
            <article class="svc-why-card">
              <span>05</span>
              <h3>Warm-up cold leads</h3>
              <p>We gradually warm up cold subscribers with a separate strategy so they can be converted into warm leads.</p>
            </article>
        </div>
      </div>
    </section>

    <section class="svc-roi-band">
      <div class="wrap svc-roi-inner">
        <div>
          <p class="page-eyebrow">Results</p>
          <h2>We work with you to improve your business's bottom line and generate positive ROI so that you can scale it up.</h2>
          <p>Therefore, if you are looking for the best services for boosting your presence online and converting visitors into quality leads, contact us today.</p>
        </div>
        <a class="btn btn-white" href="{{ url('/contact') }}">Make a Call Now</a>
      </div>
    </section>

        <section class="page-section page-section-tint svc-explore" aria-labelledby="svc-explore-title">
      <div class="wrap">
        <header class="svc-explore-head">
          <p class="page-eyebrow dark">Next step</p>
          <h2 id="svc-explore-title">Explore more services</h2>
          <p class="svc-explore-lead">Tie automation to inbound, CRM-ready lead gen, and content journeys that nurture at scale.</p>
        </header>
        <div class="svc-related">
          <a href="{{ url('/services/inbound-marketing') }}">
            <img class="svc-related-media" src="/assets/services/inbound.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">01</span>
            <strong>Inbound Marketing</strong>
            <span>Attract, engage, delight.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/lead-generation') }}">
            <img class="svc-related-media" src="/assets/services/topic-growth.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">02</span>
            <strong>Lead Generation</strong>
            <span>Qualified inquiries.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/content-marketing') }}">
            <img class="svc-related-media" src="/assets/services/topic-content.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">03</span>
            <strong>Content Marketing</strong>
            <span>Fuel for nurture.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="automation-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="automation-cta-title">
            Automate the busywork.
            <em>Accelerate pipeline.</em>
          </h2>
          <p>Connect your stack, nurture leads, and trigger journeys that keep prospects moving — with automation built for measurable growth.</p>
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
