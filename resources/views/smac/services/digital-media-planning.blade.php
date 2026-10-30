@extends('smac.layout')

@section('title', $page->metatitle ?? 'Digital Media Planning Services | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Digital media planning strategies maximize the impact of your online advertising campaigns, Creative Advertising, leading to an increase in lead acquisition and sales. Smac Digital explains how to plan these services')
@section('meta_keywords', $page->metakeywords ?? 'Digital Media Planning Services, Creative Advertising Agency, Smac Digital,search engine marketing agency, search engine marketing services, sem, search engine marketing, sem services, paid media, sem marketing')

@section('content')


    <section class="hero inner-hero" aria-labelledby="svc-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="svc-hero-title">
          <span>Digital Media</span><br>
          <em>Planning</em>
        </h1>
        <p class="lede">A well-crafted digital media plan keeps short- and long-term growth on track when campaigns need structure, review, and measurable KPIs.</p>
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
          <img src="/assets/services/media.jpg" alt="" width="900" height="1100" loading="lazy">
          <figcaption>Spend with intent</figcaption>
        </figure>
        <div class="svc-intro-content">
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
          <div class="svc-intro-copy"><p>So now you know the importance of your online presence and you hired a digital marketing agency to help your business grow. And the digital marketing agency is helping you with your online presence. Is everything going right? Well in beginning you will see the difference with many new customers getting added to the customer base but with time maybe this pace gets slow or even stop. So what happens?</p><p>Well, your digital marketing agency lacks short term and long term plan which has hampered your growth as customers do not found it new and interesting anymore. You not only need a digital marketing presence but also a well-crafted digital marketing plan which needed to be prepared and reviewed in a manner that provides optimal benefit to the client's business. Your success story begins with the right plan. And SMAC digital, we make sure that your business should get boom with the right digital plan.</p></div>
        </div>
      </div>
    </section>

    
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">01</p>
          <h2>How SMAC DIGITAL help you with the structural design for digital marketing ?</h2>
          <p>Planning a digital marketing plan is the backbone of all your success and therefore needed utmost expertise in design the plan. Following basic steps could give you an idea of how the digital marketing plan should be designed.</p>
          <ul class="svc-check-list"><li><strong>1. Situational Analysis :</strong> SMAC digital begins with the basics and tries to understand the environment in which the company is working. Our situational analysis helps us to create the best plan for your business with the application of the right management tools. At the very first stage SWOT analysis needed to be done with internal and external analysis of the firm. It will give an idea of strength, weakness, opportunity, and threats of the company. This will give a proper idea of the ecosystem of the company and a digital plan can be made accordingly.</li><li><strong>2. Digital Marketing Goals :</strong> We set the best digital marketing goal for your business so that your objectives could be achieved within the time limit in the most organic and long term manner. After knowing the ecosystem of the surrounding it is imperatively important to understand the goals of the company as what you want to achieve with the digital marketing plan.</li><li><strong>3. Define the market strategy :</strong> SMAC digital the best digital marketing agency makes sure that your goals should be achieved most sustainably. We create a proper digital marketing strategy to deliver the best possible result for you. Our strategy is long term and goal-oriented making sure that your business gets the right pace from it.</li><li><strong>4. We achieve your set goals :</strong> Your goals are our target and we are determining to achieve them with the right kind of strategy. We have the caliber and expertise to achieve best and we want to deliver the same for your business. So let's collaborate and witness the success.</li><li><strong>5. We work On Detailed Plan :</strong> SMAC digital, the best digital marketing agency, works on a detailed plan to deliver the best value to our clients. After the proper idea of digital marketing goal the next level plan should be to achieve them.</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-planning.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">02</p>
          <h2>Marketing strategy</h2>
          
          <ul class="svc-check-list"><li><strong>Segmenting the Target Audience :</strong> The very first thing you need to know is your target audiences with their taste and preferences. A buyer persona needed to be created exclusively for each segment of the audience.</li><li><strong>Positioning :</strong> There should be a clear idea of the value proposition and its entail at first instance. You should give them an idea of why should they choose you instead of your competitors.</li><li><strong>Content Strategy :</strong> Content strategy includes creation, distribution, and management of content. Content marketing also needs a kind of specific plan for better results with contents. These plans include:</li><li>• Keyword research</li><li>• Content calendar</li><li>• Social Posting</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-meeting.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">03</p>
          <h2>What makes us best among the crowd?</h2>
          <p>A best digital marketing agency makes sure that clients get the best result within the time frame in the most sustainable manner and we follow the same path to boost your business.</p>
          <ul class="svc-check-list"><li><strong>1. We work on Digital Strategy &amp; tactics :</strong> SMAC Digital best digital marketing agency makes sure that all your goals get achieved in time. Based on the strategy the next step involved structuring digital strategy and tactics. The different strategies include email marketing and CRM; social media web optimization, SEO strategies, and media advertisement. There is an imperative need to use the marketing automation tools so that you could automate your marketing campaign.</li><li>2. Measuring the result &amp; KPI at regular Interval : SMAC Digital makes sure that its all result get measured and keep on reviewing at regular interval. Designing and implementing the marketing strategy is only the work half done. The next step involves analyzing the results. KPI is the main tool used to measure the result. With the high evolution in the digital world, it is imperatively important that one should keep on measuring the result and KPI of the strategy implemented.</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-analytics.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">04</p>
          <h2>Come and collaborate with us to witness the change</h2>
          <p>While creating the digital marketing plan it is some of the basic steps needed to be followed. An expert digital marketing team will use these basic steps with its advanced and creative inputs to create a digital marketing plan which will boost your business manifolds. Therefore always choose an expert digital marketing team for the creation and implementation of a digital marketing plan.</p><p>SMAC DIGITAL is the best digital marketing company in Jaipur which provides expert solutions to its clients. With the ongoing experience, we have excelled in designing the website to boost a client's online presence. We have an expert team of web and graphics designers who work on the principle of functionality, usability, and visualization, at best.</p>
          
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-brand.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>

    
    <section class="svc-process">
      <div class="wrap">
        <header class="svc-process-head">
          <p class="page-eyebrow dark">Engagement</p>
          <h2>A clear path from brief to results</h2>
          <p class="svc-process-lead">The same disciplined rhythm we use across SMAC Digital engagements — adapted for Digital Media Planning.</p>
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
        <h2>What makes us best among the crowd?</h2>
        <div class="svc-why-grid">
          
            <article class="svc-why-card">
              <span>01</span>
              <h3>Digital strategy and tactics</h3>
              <p>SMAC Digital best digital marketing agency makes sure that all your goals get achieved in time. Based on the strategy the next step involved structuring digital strategy and tactics. The different strategies include email marketing and CRM; social media web optimization, SEO strategies, and media advertisement. There is an imperative need to use the marketing automation tools so that you could automate your marketing campaign.</p>
            </article>
            <article class="svc-why-card">
              <span>02</span>
              <h3>Measuring results and KPIs</h3>
              <p>SMAC Digital makes sure that its all result get measured and keep on reviewing at regular interval. Designing and implementing the marketing strategy is only the work half done. The next step involves analyzing the results. KPI is the main tool used to measure the result. With the high evolution in the digital world, it is imperatively important that one should keep on measuring the result and KPI of the strategy implemented.</p>
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
          <p class="svc-explore-lead">Connect media plans to social, video, and lead gen so spend maps cleanly to outcomes.</p>
        </header>
        <div class="svc-related">
          <a href="{{ url('/services/content-marketing') }}">
            <img class="svc-related-media" src="/assets/services/topic-content.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">01</span>
            <strong>Content Marketing</strong>
            <span>Fuel for the plan.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/social-media-marketing') }}">
            <img class="svc-related-media" src="/assets/services/social.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">02</span>
            <strong>Social Media Marketing</strong>
            <span>Channel execution.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/search-engine-optimization') }}">
            <img class="svc-related-media" src="/assets/services/seo.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">03</span>
            <strong>Search Engine Optimization</strong>
            <span>Organic visibility.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="media-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="media-cta-title">
            Plan every rupee.
            <em>Maximize media ROI.</em>
          </h2>
          <p>Get media plans grounded in audience insight and channel fit — so your spend reaches the right people with measurable efficiency.</p>
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
