@extends('smac.layout')

@section('title', $page->metatitle ?? 'Digital Marketing Services | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system.')
@section('meta_keywords', $page->metakeywords ?? 'Digital Marketing Services, SEO, SMM, Lead Generation, Web Development')

@section('content')

    
    
    <section class="hero inner-hero" aria-labelledby="services-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="services-hero-title">
          <span>Digital marketing</span><br>
          <em>services that ship.</em>
        </h1>
        <p class="lede">Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system.</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url('/contact') }}">Start a brief</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="{{ url('/contact') }}">Get a free consultation</a>
        </div>
      </div>
    </section>
    <section class="page-section">
      <div class="wrap page-service-grid">
        
          <a class="page-service-card" href="{{ url('/services/search-engine-optimization') }}">
            <img src="assets/services/seo.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Search Engine Optimization</h2>
              <p>Earn a stronger place in search.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/social-media-marketing') }}">
            <img src="assets/services/social.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Social Media Marketing</h2>
              <p>Show up where the audience already spends time.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/marketing-automation') }}">
            <img src="assets/services/automation.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Marketing Automation</h2>
              <p>Let email and social follow-up keep moving.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/inbound-marketing') }}">
            <img src="assets/services/inbound.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Inbound Marketing</h2>
              <p>Bring the right people in.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/video-marketing') }}">
            <img src="assets/services/video.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Video Marketing</h2>
              <p>Show the product in motion, then place the films.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/website-design-and-development') }}">
            <img src="assets/services/website.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Website Design and Development</h2>
              <p>A site that answers a marketing problem.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/mobile-application-development') }}">
            <img src="assets/services/mobile.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Mobile Application Development</h2>
              <p>Meet people on the device they already use.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/digital-media-planning') }}">
            <img src="assets/services/media.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Digital Media Planning</h2>
              <p>Decide where attention and budget should work.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/lead-generation') }}">
            <img src="assets/services/inbound.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Lead Generation</h2>
              <p>Campaigns judged by the inquiries they create.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/content-marketing') }}">
            <img src="assets/services/inbound.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Content Marketing</h2>
              <p>Give the brand something worth finding.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/influencer-marketing') }}">
            <img src="assets/services/social.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Influencer Marketing</h2>
              <p>Put the brand with people the audience already trusts.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/online-reputation-management') }}">
            <img src="assets/services/social.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Online Reputation Management</h2>
              <p>Shape what people find about the brand.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/social-media-analytics') }}">
            <img src="assets/services/seo.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Social Media Analytics</h2>
              <p>See which activity earns its place.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/sentiment-analysis') }}">
            <img src="assets/services/seo.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>Sentiment Analysis</h2>
              <p>Read how people talk about the brand.</p>
              <span>Explore</span>
            </div>
          </a>
          <a class="page-service-card" href="{{ url('/services/devops-services') }}">
            <img src="assets/services/website.jpg" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>DevOps Services</h2>
              <p>Keep the product shipping and stable.</p>
              <span>Explore</span>
            </div>
          </a>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="services-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="services-cta-title">
            Pick the right growth stack.
            <em>Scale what works.</em>
          </h2>
          <p>From SEO and social to automation and product builds — explore services built to drive traffic, leads, and revenue for your brand.</p>
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
