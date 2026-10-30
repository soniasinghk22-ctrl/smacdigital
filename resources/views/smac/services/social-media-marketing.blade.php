@extends('smac.layout')

@section('title', $page->metatitle ?? 'Social Media Marketing Agency in India- SMAC DIGITAL')
@section('meta_description', $page->metadescription ?? 'As a top social media agency in India, we elevate brands by building community and engagement through our best social media marketing services.')
@section('meta_keywords', $page->metakeywords ?? 'social media marketing, social media advertising, social media optimization, Social Media Marketing Agency in India, Social Media Advertising Agency India, social media agency, Social Media Management, Social Media Marketing, Social Media Agency India')

@section('content')


    <section class="hero inner-hero" aria-labelledby="svc-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="svc-hero-title">
          <span>Social Media</span><br>
          <em>Marketing</em>
        </h1>
        <p class="lede">Social media marketing is the use of social media platforms in a manner so that audiences are created for brand awareness, increase in sales, and to boost web traffic.</p>
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
          <img src="/assets/services/overview-social.jpg" alt="" width="1400" height="1050" loading="lazy">
          <figcaption>Social that compounds</figcaption>
        </figure>
        <div class="svc-intro-content">
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
          <div class="svc-intro-copy"><p>Social media marketing is the use of social media platforms in a manner so that audiences are created for brand awareness; increase in sales, and to boost web traffic.</p><p>At the very first stage, there is a need to understand the strategy to be followed for future growth. The very first thing you need to understand is your business goal, and how social media is helping you to achieve that goal.</p></div>
        </div>
      </div>
    </section>

    
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">01</p>
          <h2>Strategy first</h2>
          <p>Like some of the businesses require social media only for brand awareness while others request it for driving website traffic. It would help if you focused on the following points –</p>
          <ul class="svc-check-list"><li>Which social media platform you want to focus on, and why?</li><li>What type of content do you want to share on social media?</li><li>What are your Social Media strategy and social media marketing plan?</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media">
          <img src="/assets/services/topic-strategy.jpg" alt="Social media strategy planning" width="1200" height="800" loading="eager" decoding="async">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">02</p>
          <h2>Planning &amp; Publishing</h2>
          <p>Social media marketing, in the case of small business, begins with the presence on social media, and the same should be consistent throughout the year. Though it sounds easy, publishing on social media could be a tricky task. There is a need for proper content planning with publishing the content and reviewing the result of the same. Here an expert will help you to gain the best from the use of social media.</p>
          
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-planning.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">03</p>
          <h2>Audience Engagement</h2>
          <p>With the growth of businesses and social media, there will begin a conversation on your pages made on social media. Your audience engagement is one of the underlying phenomena of social media marketing, which will decide the success or failure of your planning.</p>
          
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-engagement.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">04</p>
          <h2>Analytics &amp; Reporting</h2>
          <p>Analytics will provide you a basic idea on how social media marketing is performing and its performance is impacting the overgrowth of your company. Many analytical tools will give you an insight into your progress on social media. These analyses need to be correctly reported and evaluated at regular intervals.</p>
          
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-analytics.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">05</p>
          <h2>Advertising</h2>
          <p>If you invest your funds wisely, you could grow your social media manifolds. The social media advertising platform is immensely powerful and could help you to grow in your business. Here the essential thing needed to understand is the rationality behind spending. Therefore if you are spending a certain amount of money, always go for a cost-benefit analysis to get an overview.</p>
          
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/smm-ads.jpg" alt="Social media advertising and performance dashboards" width="720" height="520" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">06</p>
          <h2>SMAC Social media metrics</h2>
          <p>Social Media Metrics is a tool that provides data on the success of your post and how it has impacted the audience and customers. These metrics may consist of data on the level of engagement, like, follow and similar interactions made on the platform. The primary metrics to be tracked is as follows –</p>
          <ul class="svc-check-list"><li><strong>Engagement:</strong> click, comments, likes, and replies for the social media post — plus saved and pinned actions.</li><li><strong>Followers:</strong> number of people following your social media page.</li><li><strong>Impression:</strong> number of times the social media page is seen, or members have clicked on it.</li><li><strong>Reach &amp; Video visit:</strong> reach of viewers and video visits made by clients.</li><li><strong>Profile visit, reports, tags:</strong> how many clients found your profile engaging, and how many tagged your creative.</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-metrics.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>

    
    <section class="svc-process">
      <div class="wrap">
        <header class="svc-process-head">
          <p class="page-eyebrow dark">Engagement</p>
          <h2>A clear path from brief to results</h2>
          <p class="svc-process-lead">The same disciplined rhythm we use across SMAC Digital engagements — adapted for Social Media Marketing.</p>
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
        <h2>SMAC Digital will help you with your social media marketing goals</h2>
        <div class="svc-why-grid">
          
            <article class="svc-why-card">
              <span>01</span>
              <h3>More receptive messaging</h3>
              <p>The consumer will be more receptive to your messages when you opt to market it through social media.</p>
            </article>
            <article class="svc-why-card">
              <span>02</span>
              <h3>Brand recognition</h3>
              <p>Social Media Marketing helps in creating brand recognition.</p>
            </article>
            <article class="svc-why-card">
              <span>03</span>
              <h3>Inbound traffic</h3>
              <p>Social Media Marketing helps to increase inbound traffic.</p>
            </article>
            <article class="svc-why-card">
              <span>04</span>
              <h3>Beyond geography</h3>
              <p>Social Media channels help you to reach customers beyond geographical limitations.</p>
            </article>
            <article class="svc-why-card">
              <span>05</span>
              <h3>Targeting &amp; retargeting</h3>
              <p>Social Media Advertising helps in targeting and retargeting customers.</p>
            </article>
            <article class="svc-why-card">
              <span>06</span>
              <h3>Search &amp; loyalty</h3>
              <p>Social Media Marketing helps in improving search engine ranking and brand loyalty — with high conversion from visitors to leads and customers.</p>
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
          <p class="svc-explore-lead">Pair social campaigns with analytics, creators, and content that keep momentum going.</p>
        </header>
        <div class="svc-related">
          <a href="{{ url('/services/influencer-marketing') }}">
            <img class="svc-related-media" src="/assets/services/topic-network.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">01</span>
            <strong>Influencer Marketing</strong>
            <span>Partners the audience already trusts.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/social-media-analytics') }}">
            <img class="svc-related-media" src="/assets/services/topic-analytics.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">02</span>
            <strong>Social Media Analytics</strong>
            <span>See what earns its place.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/content-marketing') }}">
            <img class="svc-related-media" src="/assets/services/topic-content.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">03</span>
            <strong>Content Marketing</strong>
            <span>Something worth finding.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="smm-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="smm-cta-title">
            Own the feed.
            <em>Convert attention.</em>
          </h2>
          <p>Build social presence that earns engagement and demand — with content, community, and paid amplification aligned to your brand goals.</p>
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
