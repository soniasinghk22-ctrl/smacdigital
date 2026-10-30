@extends('smac.layout')

@section('title', $page->metatitle ?? 'DevOps Services & Cloud Engineering | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'DevOps combines culture, practices, and tools so your organization ships applications and services at high velocity with automation and reliability.')
@section('meta_keywords', $page->metakeywords ?? 'DevOps Services, Cloud Engineering, CI/CD, Infrastructure as Code, SMAC Digital DevOps')

@section('content')


    <section class="hero inner-hero" aria-labelledby="svc-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="svc-hero-title">
          <span>DevOps</span><br>
          <em>Services</em>
        </h1>
        <p class="lede">DevOps combines culture, practices, and tools so your organization ships applications and services at high velocity with automation and reliability.</p>
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
          <img src="/assets/services/topic-code.jpg" alt="" width="900" height="1100" loading="lazy">
          <figcaption>Ship with confidence</figcaption>
        </figure>
        <div class="svc-intro-content">
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
          <div class="svc-intro-copy"><p>DevOps is a combination of cultural philosophies, practices, and tools that increases an organization’s ability to deliver applications and services at high velocity.</p><p>SMAC Digital offers robust DevOps services tailored to automate and streamline your development and deployment pipeline.</p></div>
        </div>
      </div>
    </section>

    
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">01</p>
          <h2>DevOps Strategy &amp; Planning</h2>
          <p>We begin by understanding your infrastructure and delivery pipeline. Our strategy focuses on faster delivery, reduced failure rates, and automated deployment cycles. We work with your team to define goals, select tools, and create roadmaps that align with your business objectives.</p>
          <ul class="svc-check-list"><li>Assessment of current IT setup</li><li>Goal setting and KPIs</li><li>Roadmap creation and timeline planning</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-code.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">02</p>
          <h2>CI/CD Pipeline Automation</h2>
          <p>Automated CI/CD pipelines ensure that your code is tested and deployed quickly and consistently. We implement modern tools such as Jenkins, GitHub Actions, and GitLab CI to enable seamless code integration and faster delivery cycles.</p>
          <ul class="svc-check-list"><li>Continuous Integration with automated testing</li><li>Deployment automation to staging and production</li><li>Rollback and version control mechanisms</li></ul>
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
          <h2>Containerization &amp; Orchestration</h2>
          <p>Leverage containers to build lightweight, portable, and consistent environments for development and production. SMAC Digital uses Docker for containerization and Kubernetes for orchestration, enabling easy scaling and high availability.</p>
          <ul class="svc-check-list"><li>Docker-based containerization</li><li>Kubernetes cluster setup and management</li><li>Helm chart deployments and auto-scaling</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-dashboard.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">04</p>
          <h2>Monitoring &amp; Logging</h2>
          <p>Our monitoring services ensure real-time visibility into your application performance and infrastructure health. We integrate tools like Prometheus, Grafana, and ELK Stack to deliver accurate insights for proactive decision-making.</p>
          <ul class="svc-check-list"><li>Real-time application monitoring</li><li>Log aggregation and visualization</li><li>Alerting and incident management</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-network.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long ">
      <div class="wrap svc-long-inner ">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">05</p>
          <h2>DevOps Tools We Use</h2>
          
          <ul class="svc-check-list"><li><strong>CI/CD:</strong> Jenkins, GitHub Actions, GitLab CI, CircleCI</li><li><strong>Containers:</strong> Docker, Podman</li><li><strong>Orchestration:</strong> Kubernetes, OpenShift</li><li><strong>IaC:</strong> Terraform, Ansible, CloudFormation</li><li><strong>Monitoring:</strong> Prometheus, Grafana, Datadog</li><li><strong>Security:</strong> SonarQube, Snyk, Vault</li><li><strong>Cloud:</strong> AWS, Azure, GCP</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-team.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>
    <section class="svc-long svc-long-tint">
      <div class="wrap svc-long-inner is-flip">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">06</p>
          <h2>Why Choose SMAC Digital for DevOps?</h2>
          <p>Partner with SMAC Digital and bring speed, reliability, and efficiency to your software development lifecycle. Our expert team ensures that your DevOps transformation is smooth, agile, and fully customized to your business needs.</p><p>Contact us today to elevate your infrastructure with DevOps best practices and automation.</p>
          <ul class="svc-check-list"><li>Faster time to market</li><li>Reliable and secure delivery pipelines</li><li>Scalable and flexible infrastructure</li><li>24/7 support and proactive monitoring</li><li>Experience across multiple industries</li></ul>
        </div>
        <div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="/assets/services/topic-office.jpg" alt="" width="1200" height="800" loading="lazy">
        </div>
      </div>
    </section>

    
    <section class="svc-process">
      <div class="wrap">
        <header class="svc-process-head">
          <p class="page-eyebrow dark">Engagement</p>
          <h2>A clear path from brief to results</h2>
          <p class="svc-process-lead">The same disciplined rhythm we use across SMAC Digital engagements — adapted for DevOps Services.</p>
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
        <h2>Why Choose SMAC Digital for DevOps?</h2>
        <div class="svc-why-grid">
          
            <article class="svc-why-card">
              <span>01</span>
              <h3>Faster time to market</h3>
              <p>Partner with SMAC Digital and bring speed, reliability, and efficiency to your software development lifecycle.</p>
            </article>
            <article class="svc-why-card">
              <span>02</span>
              <h3>Reliable pipelines</h3>
              <p>Our expert team ensures reliable and secure delivery pipelines with scalable and flexible infrastructure.</p>
            </article>
            <article class="svc-why-card">
              <span>03</span>
              <h3>Always-on support</h3>
              <p>We provide 24/7 support and proactive monitoring with experience across multiple industries.</p>
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
          <p class="svc-explore-lead">Keep delivery reliable while web, apps, and growth teams ship faster with less friction.</p>
        </header>
        <div class="svc-related">
          <a href="{{ url('/services/website-design-and-development') }}">
            <img class="svc-related-media" src="/assets/services/website.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">01</span>
            <strong>Website Design &amp; Development</strong>
            <span>Frontends your pipeline ships.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/mobile-application-development') }}">
            <img class="svc-related-media" src="/assets/services/mobile.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">02</span>
            <strong>Mobile Application Development</strong>
            <span>Apps in the release cycle.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
          <a href="{{ url('/services/search-engine-optimization') }}">
            <img class="svc-related-media" src="/assets/services/seo.jpg" alt="" width="720" height="420" loading="lazy">
            <span class="svc-related-index">03</span>
            <strong>Search Engine Optimization</strong>
            <span>Performance users and Google see.</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="devops-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="devops-cta-title">
            Ship with confidence.
            <em>Operate with speed.</em>
          </h2>
          <p>Modernize delivery with DevOps practices that improve reliability, release cadence, and collaboration across your product teams.</p>
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
