import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");

function asset(fromDir, file) {
  const depth = fromDir === "." ? "" : "../".repeat(fromDir.split("/").filter(Boolean).length);
  return `${depth}${file}`;
}

function nav(fromDir, active) {
  const a = (href, label, key) =>
    `<li><a href="${asset(fromDir, href)}"${active === key ? ' aria-current="page"' : ""}>${label}</a></li>`;
  const p = asset(fromDir, "");
  return `
  <header class="site-header is-stuck page-header" data-header>
    <div class="wrap header-bar">
      <a class="logo" href="${p}index.html" aria-label="SMAC Digital, home">
        <img src="${asset(fromDir, "assets/brand/logo-white.png")}" width="150" height="43" alt="SMAC Digital">
      </a>
      <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-nav-toggle>
        <span class="nav-toggle-lines" aria-hidden="true"></span>
        <span class="visually-hidden">Menu</span>
      </button>
      <nav class="site-nav" id="site-nav" data-nav aria-label="Primary">
        <ul class="nav-list">
          ${a("index.html", "Home", "home")}
          ${a("about-us.html", "About", "about")}
          <li class="has-mega">
            <button class="nav-parent" type="button" aria-expanded="false" aria-controls="services-menu" data-mega-toggle>Services</button>
            <div class="mega" id="services-menu">
              <div class="mega-inner">
                <aside class="mega-intro">
                  <p class="mega-intro-kicker">Services</p>
                  <h3>Pick a lane.<br>We'll map the rest.</h3>
                  <p>SEO, social, content, and product builds — planned as one growth system.</p>
                  <a class="mega-all" href="${asset(fromDir, "services.html")}">
                    Browse all services
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  </a>
                </aside>
                <div class="mega-grid">
                  <div class="mega-col">
                    <p class="mega-label"><span>01</span> Digital marketing</p>
                    <a class="mega-item" href="${asset(fromDir, "services/search-engine-optimization.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Search Engine Optimization</strong><em>Earn a stronger place in search.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/social-media-marketing.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="16.5" cy="7.5" r="0.8" fill="currentColor"/></svg></span><span><strong>Social Media Marketing</strong><em>Show up where the audience already spends time.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/lead-generation.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 16.5 9 11l3 3 8-8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 6h6v6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Lead Generation</strong><em>Campaigns judged by the inquiries they create.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/inbound-marketing.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 4v10" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 11l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 19h14" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Inbound Marketing</strong><em>Bring the right people in.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/digital-media-planning.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9.5h17M8 5v4.5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg></span><span><strong>Digital Media Planning</strong><em>Decide where attention and budget should work.</em></span></a>
                  </div>
                  <div class="mega-col">
                    <p class="mega-label"><span>02</span> Content and reputation</p>
                    <a class="mega-item" href="${asset(fromDir, "services/content-marketing.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 4.5h9.5L19 8v11.5H6z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M15 4.5V8h4M8.5 12h7M8.5 15.5h5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Content Marketing</strong><em>Give the brand something worth finding.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/video-marketing.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="6" width="12" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M15.5 10.5 20.5 8v8l-5-2.5z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Video Marketing</strong><em>Show the product in motion, then place the films.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/influencer-marketing.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="9" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M4.5 18.5c.8-2.4 2.4-3.5 4.5-3.5s3.7 1.1 4.5 3.5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="16.5" cy="9.5" r="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M16 15c1.6.2 2.8 1 3.5 3" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Influencer Marketing</strong><em>Put the brand with people the audience already trusts.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/online-reputation-management.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.8 14.2 9l5.5.4-4.2 3.5 1.3 5.3L12 15.4 7.2 18.2 8.5 13 4.3 9.4 9.8 9z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span><span><strong>Online Reputation Management</strong><em>Shape what people find about the brand.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/social-media-analytics.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 19V5M4 19h16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M8 15v-3M12 15V8M16 15v-5" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Social Media Analytics</strong><em>See which activity earns its place.</em></span></a>
                  </div>
                  <div class="mega-col">
                    <p class="mega-label"><span>03</span> Websites and products</p>
                    <a class="mega-item" href="${asset(fromDir, "services/website-design-and-development.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Website Design and Development</strong><em>A site that answers a marketing problem.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/mobile-application-development.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="8" y="3.5" width="8" height="17" rx="2" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M11 18.2h2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Mobile Application Development</strong><em>Meet people on the device they already use.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/marketing-automation.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Marketing Automation</strong><em>Let email and social follow-up keep moving.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/sentiment-analysis.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 14.2c.9 1.2 2.1 1.8 3.5 1.8s2.6-.6 3.5-1.8M9 10h.1M15 10h.1" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>Sentiment Analysis</strong><em>Read how people talk about the brand.</em></span></a>
                    <a class="mega-item" href="${asset(fromDir, "services/devops-services.html")}"><span class="mega-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 16.5a3.2 3.2 0 0 1 .4-6.3A4.2 4.2 0 0 1 15.6 8 3.4 3.4 0 0 1 18 14.5H7" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span><span><strong>DevOps Services</strong><em>Keep the product shipping and stable.</em></span></a>
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
                    <a class="drop-portfolio-cta" href="${asset(fromDir, "portfolios.html")}">
                      Explore Our Portfolio
                      <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                  </header>
                  <div class="drop-portfolio-grid">
                    <a class="drop-card" href="${asset(fromDir, "portfolios.html")}#shree-rakhi"><img src="${asset(fromDir, "assets/work/shree-rakhi.jpg")}" alt="" width="480" height="320" loading="lazy"><span>Shree Rakhi</span></a>
                    <a class="drop-card" href="${asset(fromDir, "portfolios.html")}#rhl"><img src="${asset(fromDir, "assets/work/rhl-preview.jpg")}" alt="" width="480" height="320" loading="lazy"><span>Rajasthan Hospital</span></a>
                    <a class="drop-card" href="${asset(fromDir, "portfolios.html")}#stone-hub"><img src="${asset(fromDir, "assets/work/stone-hub.jpg")}" alt="" width="480" height="320" loading="lazy"><span>Stone Hub India</span></a>
                    <a class="drop-card" href="${asset(fromDir, "portfolios.html")}#kalavaati"><img src="${asset(fromDir, "assets/work/kalavaati.jpg")}" alt="" width="480" height="320" loading="lazy"><span>Kalavaati</span></a>
                  </div>
                </div>
                <aside class="drop-portfolio-side">
                  <p class="drop-side-kicker">Featured Case Studies</p>
                  <a class="drop-side-card" href="${asset(fromDir, "portfolios.html")}#cases">
                    <img src="${asset(fromDir, "assets/cases/case-1.jpg")}" alt="" width="420" height="260" loading="lazy">
                    <strong>Don't know what customers want, do you want?</strong>
                    <span>Read case studies</span>
                  </a>
                  <div class="drop-side-links">
                    <a href="${asset(fromDir, "testimonials.html")}">Testimonials</a>
                    <a href="${asset(fromDir, "portfolios.html")}">All projects</a>
                  </div>
                </aside>
              </div>
            </div>
          </li>
          ${a("testimonials.html", "Testimonials", "testimonials")}
          ${a("blog.html", "Blog", "blog")}
          ${a("contact.html", "Contact", "contact")}
        </ul>
        <a class="btn btn-primary nav-cta" href="${asset(fromDir, "contact.html")}">Let's Talk</a>
      </nav>
    </div>
  </header>`;
}

function footer(fromDir) {
  const p = (f) => asset(fromDir, f);
  return `
  <footer class="site-footer">
    <div class="footer-glow" aria-hidden="true"></div>
    <div class="wrap footer-grid">
      <div class="footer-brand footer-area-brand">
        <a class="logo" href="${p("index.html")}" aria-label="SMAC Digital, home">
          <img src="${p("assets/brand/logo-white.png")}" width="180" height="52" alt="SMAC Digital">
        </a>
        <p class="footer-mark">Social · Mobile · Analytics · Cloud</p>
        <p class="footer-blurb">Performance-driven digital marketing across India and the US.</p>
        <img class="partner-badge" src="${p("assets/brand/google-partner.png")}" alt="Google Partner" width="130" height="52">
      </div>
      <div class="footer-col footer-area-services">
        <h2>Our Services</h2>
        <ul>
          <li><a href="${p("services/marketing-automation.html")}">Marketing Automation</a></li>
          <li><a href="${p("services/inbound-marketing.html")}">Inbound Marketing</a></li>
          <li><a href="${p("services/social-media-marketing.html")}">Social Media Marketing</a></li>
          <li><a href="${p("services/search-engine-optimization.html")}">Search Engine Optimization</a></li>
          <li><a href="${p("services/video-marketing.html")}">Video Marketing</a></li>
          <li><a href="${p("services/website-design-and-development.html")}">Website Design &amp; Development</a></li>
          <li><a href="${p("services/mobile-application-development.html")}">Mobile App Development</a></li>
          <li><a href="${p("services/lead-generation.html")}">Lead Generation</a></li>
        </ul>
      </div>
      <div class="footer-col footer-area-links">
        <h2>Quick Links</h2>
        <ul>
          <li><a href="${p("about-us.html")}">About</a></li>
          <li><a href="${p("portfolios.html")}">Portfolio</a></li>
          <li><a href="${p("testimonials.html")}">Testimonials</a></li>
          <li><a href="${p("blog.html")}">Blog</a></li>
          <li><a href="${p("contact.html")}">Contact</a></li>
          <li><a href="${p("events.html")}">Events</a></li>
          <li><a href="${p("career.html")}">Career</a></li>
        </ul>
      </div>
      <div class="footer-col footer-subscribe footer-area-subscribe">
        <h2>Subscription</h2>
        <p>Get a free digital audit note in your inbox.</p>
        <form class="footer-sub-form" action="${p("contact.html")}" method="get">
          <label class="visually-hidden" for="footer-email">E-mail</label>
          <input id="footer-email" name="email" type="email" placeholder="E-mail" autocomplete="email" required>
          <button type="submit" aria-label="Go to contact">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M8.3 4.7 15.6 12l-7.3 7.3 1.4 1.4L18.4 12 9.7 3.3z"/></svg>
          </button>
        </form>
      </div>
      <div class="footer-office footer-area-india">
        <h2><span class="footer-flag" aria-hidden="true"><svg viewBox="0 0 36 24"><rect width="36" height="8" fill="#FF9933"/><rect y="8" width="36" height="8" fill="#fff"/><rect y="16" width="36" height="8" fill="#138808"/><circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" stroke-width="0.7"/><circle cx="18" cy="12" r="0.55" fill="#000080"/></svg></span> India</h2>
        <address><strong>Jaipur</strong><span>Anukampa Point, Mansarovar, Jaipur 302020</span><a href="tel:+919829069519">+91 98290 69519</a></address>
        <address><strong>Kolkata</strong><span>Mukundapur, Kolkata 700099</span><a href="tel:+919831132254">+91 98311 32254</a></address>
        <address><strong>Pune</strong><a href="tel:+919582792638">+91 95827 92638</a></address>
      </div>
      <div class="footer-office footer-area-usa">
        <h2><span class="footer-flag" aria-hidden="true"><svg viewBox="0 0 36 24"><rect width="36" height="24" fill="#B22234"/><path d="M0 2.77h36M0 5.54h36M0 8.31h36M0 11.08h36M0 13.85h36M0 16.62h36M0 19.38h36" stroke="#fff" stroke-width="1.85"/><rect width="14.4" height="12.92" fill="#3C3B6E"/></svg></span> USA</h2>
        <address><span>1507 E Flower Street, Gilbert AZ 85298</span></address>
      </div>
      <div class="footer-career footer-area-career">
        <h2>For career-related enquiries, please contact:</h2>
        <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
        <a href="tel:+919582792638">+91 95827 92638</a>
        <a class="btn btn-primary" href="${p("career.html")}" style="margin-top:1rem;width:fit-content">Open roles</a>
      </div>
    </div>
    <div class="wrap footer-base">
      <p>© 2026 SMAC Digital. All rights reserved.</p>
      <nav class="footer-legal" aria-label="Footer links">
        <a href="${p("contact.html")}">Contact</a>
        <a href="${p("blog.html")}">Blog</a>
        <a href="${p("portfolios.html")}">Portfolios</a>
        <a href="${p("testimonials.html")}">Testimonials</a>
        <a href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">WhatsApp</a>
      </nav>
    </div>
  </footer>
  <a class="whatsapp" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp SMAC Digital">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg>
  </a>`;
}

function page({ file, fromDir, active, title, description, body }) {
  const css = asset(fromDir, "style.css");
  const js = asset(fromDir, "script.js");
  return `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${title}</title>
  <meta name="description" content="${description}">
  <link rel="icon" href="${asset(fromDir, "assets/brand/favicon.ico")}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="${css}">
</head>
<body class="page-body" id="top">
  <a class="skip-link" href="#main">Skip to content</a>
  ${nav(fromDir, active)}
  <main id="main">
    ${body}
  </main>
  ${footer(fromDir)}
  <script src="${js}"></script>
</body>
</html>
`;
}

function hero({ eyebrow, title, outline, lead, ctaHref, ctaLabel, tone = "red" }) {
  return `
    <section class="page-hero page-hero-${tone}">
      <div class="page-hero-glow" aria-hidden="true"></div>
      <div class="wrap page-hero-inner">
        <p class="page-eyebrow">${eyebrow}</p>
        <h1>${title}${outline ? `<br><em>${outline}</em>` : ""}</h1>
        <p class="page-lede">${lead}</p>
        ${ctaHref ? `<div class="page-hero-actions"><a class="btn btn-white" href="${ctaHref}">${ctaLabel}</a><a class="btn btn-maroon" href="contact.html">Get a free consultation</a></div>` : ""}
      </div>
    </section>`;
}

const services = [
  {
    slug: "search-engine-optimization",
    title: "Search Engine Optimization",
    short: "Earn a stronger place in search.",
    image: "assets/services/seo.jpg",
    lead: "SEO is the collection of tools and best practices that help a website rank higher in search — and convert that traffic into business.",
    blocks: [
      { h: "Onsite SEO", p: "Title tags, meta descriptions, internal links, header structure, image alt text, and content clarity so search engines and people understand the page." },
      { h: "Offsite SEO", p: "Quality link building with organic, white-hat approaches. Avoid low-quality spam that can hurt long-term rankings." },
      { h: "How SMAC helps", p: "We build SEO strategy around your short and long-term goals, geography, and quality traffic — not shortcuts that fade when algorithms change." }
    ]
  },
  {
    slug: "social-media-marketing",
    title: "Social Media Marketing",
    short: "Show up where the audience already spends time.",
    image: "assets/services/social.jpg",
    lead: "Social media marketing builds brand presence, conversation, and conversion on the platforms your buyers already use.",
    blocks: [
      { h: "Strategy first", p: "Without a strategy, posts are noise. We map audience, message, and channel before creative ships." },
      { h: "Content and community", p: "Creative that earns attention, plus replies and reputation work that keep the brand human." },
      { h: "Performance loops", p: "Creative, targeting, and measurement stay connected so spend follows what actually works." }
    ]
  },
  {
    slug: "marketing-automation",
    title: "Marketing Automation",
    short: "Let email and social follow-up keep moving.",
    image: "assets/services/automation.jpg",
    lead: "Marketing automation takes on repetitive email and social follow-up so teams can focus on strategy and creative.",
    blocks: [
      { h: "Journeys that move", p: "Welcome, nurture, and re-engagement flows tied to real product and sales stages." },
      { h: "Lead hygiene", p: "Cleaner lists, clearer scoring, and handoff rules that sales can trust." },
      { h: "Measurement", p: "Open, click, and conversion signals that inform the next campaign — not vanity dashboards." }
    ]
  },
  {
    slug: "inbound-marketing",
    title: "Inbound Marketing",
    short: "Bring the right people in.",
    image: "assets/services/inbound.jpg",
    lead: "Inbound marketing attracts people who are already looking for what you offer — through content, SEO, and conversion paths.",
    blocks: [
      { h: "Attract", p: "Content and search that meet intent early in the journey." },
      { h: "Convert", p: "Landing pages, offers, and forms that turn interest into enquiries." },
      { h: "Close and delight", p: "Nurture that helps sales close — and keeps customers engaged after." }
    ]
  },
  {
    slug: "video-marketing",
    title: "Video Marketing",
    short: "Show the product in motion, then place the films.",
    image: "assets/services/video.jpg",
    lead: "Video marketing explains, demonstrates, and places films where attention already exists.",
    blocks: [
      { h: "Story and format", p: "Short-form, explainers, and brand films matched to platform behaviour." },
      { h: "Production with purpose", p: "Creative that serves a funnel step — awareness, consideration, or conversion." },
      { h: "Distribution", p: "Placement and amplification so the film does not sit unused on a drive." }
    ]
  },
  {
    slug: "website-design-and-development",
    title: "Website Design and Development",
    short: "A site that answers a marketing problem.",
    image: "assets/services/website.jpg",
    lead: "Web design and development for brands that need clarity, speed, and a clear path to enquiry.",
    blocks: [
      { h: "Structure", p: "Information architecture around services, proof, and contact — not decorative pages." },
      { h: "Design system", p: "Brand-true UI that stays usable on mobile and desktop." },
      { h: "Build and ship", p: "Performant front-ends with room for SEO, analytics, and CRM hooks." }
    ]
  },
  {
    slug: "mobile-application-development",
    title: "Mobile Application Development",
    short: "Meet people on the device they already use.",
    image: "assets/services/mobile.jpg",
    lead: "Mobile app development for products that need to live in the pocket — with UX that respects attention.",
    blocks: [
      { h: "Product clarity", p: "Scope the jobs-to-be-done before features pile up." },
      { h: "UX and UI", p: "Flows that feel native, fast, and trustworthy." },
      { h: "Delivery", p: "Build, test, and release paths that keep the product shipping." }
    ]
  },
  {
    slug: "digital-media-planning",
    title: "Digital Media Planning",
    short: "Decide where attention and budget should work.",
    image: "assets/services/media.jpg",
    lead: "Digital media planning decides where attention and budget go — and how results are judged.",
    blocks: [
      { h: "Channel mix", p: "Search, social, and display chosen for the audience, not habit." },
      { h: "Budget logic", p: "Spend tied to funnel stage and expected cost per outcome." },
      { h: "Always-on review", p: "Creative and placement changes when the data says so." }
    ]
  },
  {
    slug: "lead-generation",
    title: "Lead Generation",
    short: "Campaigns judged by the inquiries they create.",
    image: "assets/services/inbound.jpg",
    lead: "Lead generation campaigns judged by the quality of inquiries they create — not vanity clicks.",
    blocks: [
      { h: "Offer and landing", p: "Clear value exchange and pages built to convert." },
      { h: "Acquisition", p: "Paid and organic channels that find the right people." },
      { h: "Handoff", p: "Leads routed with context so sales can act fast." }
    ]
  },
  {
    slug: "content-marketing",
    title: "Content Marketing",
    short: "Give the brand something worth finding.",
    image: "assets/services/inbound.jpg",
    lead: "Content marketing gives the brand something worth finding — articles, guides, and assets that earn trust.",
    blocks: [
      { h: "Editorial plan", p: "Topics mapped to buyer questions and search demand." },
      { h: "Production", p: "Writing and design that stay on-brand and publishable." },
      { h: "Distribution", p: "Owned, earned, and paid paths so content does not die on the site." }
    ]
  },
  {
    slug: "influencer-marketing",
    title: "Influencer Marketing",
    short: "Put the brand with people the audience already trusts.",
    image: "assets/services/social.jpg",
    lead: "Influencer marketing puts the brand beside voices the audience already trusts.",
    blocks: [
      { h: "Creator fit", p: "Partners chosen for audience and credibility, not follower count alone." },
      { h: "Briefs that work", p: "Clear creative freedom with brand guardrails." },
      { h: "Proof", p: "Tracking that connects creator work to traffic, leads, or sales." }
    ]
  },
  {
    slug: "online-reputation-management",
    title: "Online Reputation Management",
    short: "Shape what people find about the brand.",
    image: "assets/services/social.jpg",
    lead: "Online reputation management shapes what people find — and how issues are handled in public.",
    blocks: [
      { h: "Listen", p: "Monitor mentions, reviews, and search results that affect trust." },
      { h: "Respond", p: "Clear ownership of replies and escalation paths." },
      { h: "Strengthen", p: "Positive proof and content that outweighs noise over time." }
    ]
  },
  {
    slug: "social-media-analytics",
    title: "Social Media Analytics",
    short: "See which activity earns its place.",
    image: "assets/services/seo.jpg",
    lead: "Social media analytics shows which activity earns its place — so teams stop guessing.",
    blocks: [
      { h: "KPI design", p: "Metrics tied to awareness, engagement, and conversion — not vanity alone." },
      { h: "Reporting", p: "Clear views for creative, media, and leadership." },
      { h: "Action", p: "Recommendations that change the next week of work." }
    ]
  },
  {
    slug: "sentiment-analysis",
    title: "Sentiment Analysis",
    short: "Read how people talk about the brand.",
    image: "assets/services/seo.jpg",
    lead: "Sentiment analysis reads how people talk about the brand across channels.",
    blocks: [
      { h: "Signal collection", p: "Reviews, social, and support themes gathered in one view." },
      { h: "Interpretation", p: "Positive, negative, and neutral patterns that matter to product and marketing." },
      { h: "Response", p: "Insights that feed creative, CX, and reputation work." }
    ]
  },
  {
    slug: "devops-services",
    title: "DevOps Services",
    short: "Keep the product shipping and stable.",
    image: "assets/services/website.jpg",
    lead: "DevOps services keep products shipping and stable — pipelines, environments, and monitoring.",
    blocks: [
      { h: "CI/CD", p: "Release paths that reduce risk and speed delivery." },
      { h: "Reliability", p: "Monitoring and response habits that protect uptime." },
      { h: "Collaboration", p: "Dev and ops aligned around one shipping rhythm." }
    ]
  }
];

const projects = [
  { id: "shree-rakhi", name: "Shree Rakhi", tag: "Rakhi manufacturer & wholesaler", img: "assets/work/shree-rakhi.jpg", url: "https://smacdemo.in/shree-rakhi-new/", challenge: "A wholesale rakhi house needed a digital storefront dealers could use to browse collections and raise wholesale enquiries.", did: "Website design and development for categories, licensed lines, and a clear path to the wholesale desk.", outcome: "A live wholesale site presenting the catalogue and dealer journey end to end." },
  { id: "rhl", name: "Rajasthan Hospital", tag: "Multispecialty hospital", img: "assets/work/rhl-preview.jpg", url: "https://smacdemo.in/rhl/", challenge: "A hospital needed a clearer digital front door for departments, doctors, and patient contact.", did: "Website structure around specialities, services, and appointment-led contact paths.", outcome: "A live hospital site that presents care offerings without burying the enquiry route." },
  { id: "stone-hub", name: "Stone Hub India", tag: "Imported marble & slabs", img: "assets/work/stone-hub.jpg", url: "https://www.stonehubindia.com/", challenge: "A stone curator needed digital reach that could bring enquiries from beyond a single city.", did: "Website and digital marketing focused on collections, applications, and catalogue requests.", outcome: "From their published testimonial: contracts rose by about one-third, with new clients found digitally from across India." },
  { id: "kalavaati", name: "Kalavaati", tag: "Indian art & craft", img: "assets/work/kalavaati.jpg", url: "https://kalavaati.com/", challenge: "A craft brand needed digital storytelling that felt as considered as the work on the shelf.", did: "Ecommerce-ready site work that puts craft, material, and collection browsing first.", outcome: "A digital home that presents handmade collections with room to sell and scale." },
  { id: "aashiyana", name: "Aashiyana Luxury Cottages", tag: "Resorts", img: "assets/work/aashiyana.jpg", url: "https://www.aashiyanacottage.com/", challenge: "A resort brand needed guests to feel the stay before they book.", did: "Website experience around rooms, amenities, and enquiry.", outcome: "A booking-led digital front that matches the property tone." },
  { id: "navvi", name: "Navvi", tag: "Indian ethnic fashion", img: "assets/work/navvi.jpg", url: "https://navvi.in/", challenge: "A fashion label needed a sharper digital shelf for ethnic wear.", did: "Site and merchandising paths for collections and discovery.", outcome: "A storefront that lets product lead the story." },
  { id: "ashoka", name: "Ashoka Holidays", tag: "Indian travel company", img: "assets/work/ashoka.jpg", url: "https://ashokaholidays.com/", challenge: "A travel company needed clearer trip discovery and enquiry.", did: "Website structure for destinations, packages, and contact.", outcome: "A travel site that makes next-step booking feel obvious." },
  { id: "dmaasa", name: "Dmaasa", tag: "Brand site", img: "assets/work/dmaasa-preview.jpg", url: "https://dmaasa.in/", challenge: "The brand needed a digital presence that matched its offering.", did: "Website design and development around core services and proof.", outcome: "A live site with a clear path to talk to the team." },
  { id: "tenderfold", name: "Tenderfold", tag: "Brand site", img: "assets/work/tenderfold-preview.jpg", url: "https://www.tenderfold.in/", challenge: "A growing brand needed a trustworthy web presence.", did: "Site craft that presents product and contact with clarity.", outcome: "A polished digital front door for the business." },
  { id: "dmb", name: "DMB Sweets", tag: "Heritage sweets, snacks & restaurant", img: "assets/work/dmb.jpg", url: "https://dmbsweets.com/", challenge: "A heritage sweet house and restaurant chain in Jaipur needed an engaging digital presence to present sweets, snacks, and catering services.", did: "Website design and development structuring festival collections, catering, and online inquiries.", outcome: "A high-conversion digital presence that strengthened brand recall and streamlined festive and bulk orders." },
  { id: "intex", name: "Intex Technologies", tag: "Consumer electronics & mobile", img: "assets/work/intex.jpg", url: "https://www.intex.in/", challenge: "A major consumer electronics and IT hardware brand required performance marketing to reach high-intent consumer segments nationwide.", did: "Search engine marketing, campaign landing pages, and audience targeting for consumer electronics lines.", outcome: "Expanded brand visibility, increased product page engagement, and measurable growth in qualified leads." },
  { id: "tumbledry", name: "Tumbledry", tag: "Laundry & dry cleaning chain", img: "assets/work/tumbledry.jpg", url: "https://tumbledry.in/", challenge: "India’s largest dry cleaning and laundry chain needed rapid multi-city brand discovery and localized customer acquisition.", did: "Scalable localized SEO, Google Search marketing, and customer acquisition campaigns across metro territories.", outcome: "From their published testimonial: over 12 months of sustained partnership driving competitor differentiation and multi-city store expansion." },
  { id: "livpure-uae", name: "Livpure UAE", tag: "Water purification & appliances (UAE)", img: "assets/work/livpure-uae.jpg", url: "https://www.livpure.com/", challenge: "Livpure needed an authoritative digital footprint to capture consumer demand and regional distributor interest across the UAE.", did: "Regional digital media planning, localized landing pages, and search visibility tailored to GCC search behavior.", outcome: "Targeted online reach and steady distributor and homeowner inquiries across regional emirates." },
  { id: "global-sales", name: "Global Sales Web", tag: "B2B sales & trade platform", img: "assets/work/global-sales.jpg", url: "https://globalsalesweb.com/", challenge: "A B2B global sales platform needed an intuitive web structure to connect verified international buyers with Indian manufacturers.", did: "Web portal architecture, category taxonomies, and clear conversion paths for trade inquiries.", outcome: "A dependable B2B platform facilitating international buyer discovery and trade inquiries." },
  { id: "livpure", name: "Livpure", tag: "Water purifiers & smart appliances", img: "assets/work/livpure.jpg", url: "https://www.livpure.com/", challenge: "A household brand in water purification and wellness appliances needed comprehensive search dominance across key product lines.", did: "Technical SEO architecture, on-page optimization, and full-funnel search campaigns across purification and sleep verticals.", outcome: "Competitive organic rankings and steady month-over-month growth in product exploration." },
  { id: "g-k-ratnam", name: "G K Ratnam", tag: "Fine jewellery & certified gemstones", img: "assets/work/g-k-ratnam.jpg", url: "https://gkratnam.com/", challenge: "A luxury gemstone and jewelry brand required a digital showcase that communicated timeless craftsmanship and certified authenticity.", did: "Refined catalogue web experience, bespoke gemstone galleries, and high-trust product showcases.", outcome: "Heightened brand positioning and qualified inquiries from bridal and fine jewelry buyers nationwide." },
  { id: "drsumitz", name: "SumitZ Clinics", tag: "Orthopaedic & physiotherapy healthcare", img: "assets/work/drsumitz.jpg", url: "https://drsumitz.com/", challenge: "A multi-branch orthopaedic and physiotherapy clinic needed to help patients in acute discomfort quickly identify treatment options and book consultations.", did: "Patient-focused web design, condition-specific treatment pages, and direct doctor appointment booking funnels.", outcome: "A clear healthcare front door leading to higher appointment bookings across clinic branches." },
  { id: "tirupaticollege", name: "Tirupati College", tag: "Higher education institution", img: "assets/work/tirupaticollege.jpg", url: "http://tirupaticollege.org/", challenge: "A leading higher education college needed a comprehensive academic portal for degree courses, admissions, faculty, and student services.", did: "Structured academic web layout, departmental directories, and clear online admission inquiry forms.", outcome: "An accessible educational hub supporting higher student inquiries and streamlined admissions communication." },
  { id: "homeopathy", name: "Homeopathy Clinic", tag: "Classical homeopathy & holistic wellness", img: "assets/work/homeopathy.jpg", url: "assets/work/homeopathy-big.jpg", challenge: "A holistic homeopathic practice needed to educate patients on root-cause healing and offer transparent consultation avenues.", did: "Content-first healthcare web layout, disease awareness sections, and easy appointment request pathways.", outcome: "A welcoming digital presence building patient trust and steady consultation requests for chronic ailments." },
  { id: "navpacknprint", name: "Navpack & Print", tag: "Packaging & commercial printing", img: "assets/work/navpacknprint.jpg", url: "https://navpacknprint.com/", challenge: "An industrial packaging manufacturer needed to display its printing capabilities, certifications, and product packaging lines to corporate buyers.", did: "B2B capabilities showcase, machinery portfolio layout, and instant quote request workflows.", outcome: "Enhanced industrial authority and qualified packaging inquiry volume from enterprise and FMCG clients." },
  { id: "oppalius", name: "Oppalius", tag: "Luxury jewellery & lifestyle", img: "assets/work/oppalius.jpg", url: "assets/work/oppalius-big.jpg", challenge: "A high-end diamond and luxury jewelry designer required a web presence that echoed understated elegance and artistic design.", did: "Minimalist editorial web design, high-resolution product showcases, and private viewing inquiry routes.", outcome: "An exclusive digital showcase attracting connoisseurs looking for bespoke luxury jewelry." },
  { id: "pallavimakeupartist", name: "Pallavi Makeup Artist", tag: "Bridal & celebrity makeover studio", img: "assets/work/pallavimakeupartist.jpg", url: "https://pallavimakeupartist.com/", challenge: "A bridal makeup artist needed a visually stunning portfolio to highlight bridal looks, studio services, and client transformations.", did: "Visual-first gallery web experience, client reviews, and direct WhatsApp and phone booking links.", outcome: "Stronger social proof and consistent bridal booking inquiries across wedding seasons." },
  { id: "promasterfilings", name: "ProMaster Filings", tag: "Corporate filings & legal compliance", img: "assets/work/promasterfilings.jpg", url: "https://promasterfilings.com/", challenge: "A legal and corporate compliance consultancy needed to simplify complex incorporation, tax, and trademark procedures for startup founders.", did: "Clean service hierarchy, package pricing presentations, and clear lead capture forms.", outcome: "Reduced client inquiry friction and predictable inbound leads for company registration and tax compliance." },
  { id: "saisravanthi", name: "Sai Sravanthi", tag: "Designer textiles & ethnic fashion", img: "assets/work/saisravanthi.jpg", url: "assets/work/saisravanthi-big.jpg", challenge: "A boutique couture and textile label needed to bring traditional handcrafted fabrics and designer sarees to modern buyers online.", did: "Artistic lookbook web layouts, collection galleries, and direct designer consultation paths.", outcome: "Broader digital reach beyond local boutiques and consistent client inquiries for bespoke designer outfits." },
  { id: "samriddhigroup", name: "Samriddhi Group", tag: "Real estate builders & developers", img: "assets/work/samriddhigroup.jpg", url: "https://samriddhigroup.com/", challenge: "A real estate developer required a modern property showcase for residential townships, layout plans, and lifestyle amenities.", did: "Interactive project presentation pages, architectural renders, and site-visit consultation booking modules.", outcome: "Increased prospective homebuyer trust and a steady stream of qualified site-visit registrations." },
  { id: "thegifterysolutions", name: "The Giftery Solutions", tag: "Bespoke corporate gifting", img: "assets/work/thegifterysolutions.jpg", url: "assets/work/thegifterysolutions-big.jpg", challenge: "A premium gifting company needed an inspiring digital catalogue to present curated gift hampers to corporate HR teams and event planners.", did: "Occasion-based product categorization, bespoke hamper showcase, and quick bulk quote request tools.", outcome: "A professional gifting storefront leading to consistent enterprise orders and repeat festive contracts." },
  { id: "usam", name: "USAM CAD Soft", tag: "CAD software & engineering solutions", img: "assets/work/usam.jpg", url: "https://usam.in/", challenge: "An engineering technology provider needed a well-structured site to detail specialized CAD, BIM, and PLM software solutions and training.", did: "Enterprise software cataloging, vendor solution overviews, and consultation demo inquiry forms.", outcome: "Clear software positioning and steady inbound demo requests from engineering and architectural firms." },
  { id: "oohmexicano", name: "OohMexicano", tag: "Mexican restaurant & quick-service dining", img: "assets/work/oohmexicano.jpg", url: "assets/work/oohmexicano-big.jpg", challenge: "A festive Mexican dining brand needed an energetic digital space to showcase its authentic menu, dining atmosphere, and party catering.", did: "Appetizing menu showcase, location and timing details, and direct table reservation and party booking links.", outcome: "Increased footfall, stronger local recognition, and higher party and catering bookings." }
];

// --- Write pages.css append is separate; pages use style.css classes we'll add ---

function write(rel, html) {
  const full = path.join(root, rel);
  fs.mkdirSync(path.dirname(full), { recursive: true });
  fs.writeFileSync(full, html, "utf8");
  console.log("wrote", rel);
}

// ABOUT
write("about-us.html", page({
  file: "about-us.html", fromDir: ".", active: "about",
  title: "About Us | SMAC Digital",
  description: "SMAC Digital is a performance-driven digital marketing agency. SMAC stands for Social, Mobile, Analytics, and Cloud.",
  body: `
    ${hero({ eyebrow: "About SMAC", title: "A performance-driven", outline: "digital marketing agency.", lead: "SMAC gives you the opportunity to create your niche in the global marketplace through targeted marketing and communication strategies. Our ultimate goal is to make consumers associate your brand with a smile.", ctaHref: "contact.html", ctaLabel: "Talk to us", tone: "navy" }).replace('href="contact.html"', 'href="contact.html"')}
    <section class="page-section">
      <div class="wrap page-split">
        <div>
          <p class="page-eyebrow dark">Who we are</p>
          <h2>Social · Mobile · Analytics · Cloud</h2>
          <p>SMAC defines as S-Social, M-Mobile, A-Analytics and C-Cloud — four elements changing the digital world. We adopted this name to become the front face of growth in digital marketing.</p>
          <p>We commit to performance and aim to over-deliver every time. We adapt to the strengths and weaknesses of each business. We are digital transformers who create perception that drives brand adaptability in the consumer mindset.</p>
        </div>
        <div class="page-stat-stack">
          <div><strong>$2M+</strong><span>Monthly online sales</span></div>
          <div><strong>400%+</strong><span>Traffic growth</span></div>
          <div><strong>1000+</strong><span>Keywords ranking in a month</span></div>
          <div><strong>30k+</strong><span>Dealer acquisition</span></div>
        </div>
      </div>
    </section>
    <section class="page-section page-section-tint">
      <div class="wrap">
        <p class="page-eyebrow dark">How we work</p>
        <h2>Beyond a marketing agency</h2>
        <div class="page-card-grid">
          <article class="page-card"><h3>Association</h3><p>For a successful brand, you need a sense of association. Creating identity through cognizance is our primary goal.</p></article>
          <article class="page-card"><h3>Full stack growth</h3><p>Marketing automation, inbound, social, SEO, video, websites, and mobile apps — planned as one system.</p></article>
          <article class="page-card"><h3>Amplification</h3><p>We ride digital amplification to boost growth — with measurement that keeps teams honest.</p></article>
        </div>
        <div class="page-cta-row">
          <a class="btn btn-primary" href="services.html">Explore services</a>
          <a class="btn btn-navy" href="portfolios.html">See the work</a>
        </div>
      </div>
    </section>`
}));

// SERVICES HUB
write("services.html", page({
  file: "services.html", fromDir: ".", active: "services",
  title: "Digital Marketing Services | SMAC Digital",
  description: "SEO, social media, inbound, websites, apps, video, automation, and more from SMAC Digital.",
  body: `
    ${hero({ eyebrow: "Services", title: "Digital marketing", outline: "services that ship.", lead: "Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system.", ctaHref: "contact.html", ctaLabel: "Start a brief", tone: "red" })}
    <section class="page-section">
      <div class="wrap page-service-grid">
        ${services.map((s) => `
          <a class="page-service-card" href="services/${s.slug}.html">
            <img src="${s.image}" alt="" width="640" height="400" loading="lazy">
            <div>
              <h2>${s.title}</h2>
              <p>${s.short}</p>
              <span>Explore</span>
            </div>
          </a>`).join("")}
      </div>
    </section>`
}));

// SERVICE DETAIL PAGES
for (const s of services) {
  write(`services/${s.slug}.html`, page({
    file: `services/${s.slug}.html`, fromDir: "services", active: "services",
    title: `${s.title} | SMAC Digital`,
    description: s.lead,
    body: `
      <section class="page-hero page-hero-red page-hero-service">
        <div class="page-hero-glow" aria-hidden="true"></div>
        <div class="wrap page-hero-inner page-hero-split">
          <div>
            <p class="page-eyebrow"><a href="../services.html">Services</a> / ${s.title}</p>
            <h1>${s.title}</h1>
            <p class="page-lede">${s.lead}</p>
            <div class="page-hero-actions">
              <a class="btn btn-white" href="../contact.html">Request a proposal</a>
              <a class="btn btn-maroon" href="../portfolios.html">See related work</a>
            </div>
          </div>
          <div class="page-hero-media">
            <img src="../${s.image}" alt="" width="720" height="520">
          </div>
        </div>
      </section>
      <section class="page-section">
        <div class="wrap page-blocks">
          ${s.blocks.map((b, i) => `
            <article class="page-block">
              <span class="page-block-num">${String(i + 1).padStart(2, "0")}</span>
              <h2>${b.h}</h2>
              <p>${b.p}</p>
            </article>`).join("")}
        </div>
      </section>
      <section class="page-band">
        <div class="wrap page-band-inner">
          <h2>Ready to grow with ${s.title}?</h2>
          <p>Tell us what you are building. We'll reply with a clear next step.</p>
          <a class="btn btn-white" href="../contact.html">Get a free consultation</a>
        </div>
      </section>`
  }));
}

// PORTFOLIO
write("portfolios.html", page({
  file: "portfolios.html", fromDir: ".", active: "portfolio",
  title: "Portfolio | SMAC Digital",
  description: "Selected client work from SMAC Digital — websites and growth projects across India.",
  body: `
    ${hero({ eyebrow: "Portfolio", title: "Selected", outline: "client work.", lead: "Partners in growth — browse brands below to see the brief, the work, and what clients said publicly.", ctaHref: "contact.html", ctaLabel: "Start a project", tone: "dark" })}
    <section class="page-section" id="cases">
      <div class="wrap">
        <div class="page-portfolio-grid">
          ${projects.map((p) => `
            <article class="page-project" id="${p.id}">
              <a class="page-project-media" href="${p.url}" target="_blank" rel="noopener noreferrer">
                <img src="${p.img}" alt="${p.name}" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">${p.tag}</p>
                <h2>${p.name}</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>${p.challenge}</p></div>
                  <div><h3>What we did</h3><p>${p.did}</p></div>
                  <div><h3>Outcome</h3><p>${p.outcome}</p></div>
                </div>
                <a class="btn btn-primary" href="${p.url}" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>`).join("")}
        </div>
      </div>
    </section>`
}));

// TESTIMONIALS
write("testimonials.html", page({
  file: "testimonials.html", fromDir: ".", active: "testimonials",
  title: "Testimonials | SMAC Digital",
  description: "Words from SMAC Digital customers including Stone Hub India, Tumbledry, and Belearno.",
  body: `
    ${hero({ eyebrow: "Testimonials", title: "Words from", outline: "our customers.", lead: "These cases are perfectly simple and easy to distinguish — real partners, real outcomes.", ctaHref: "contact.html", ctaLabel: "Become a partner", tone: "navy" })}
    <section class="page-section">
      <div class="wrap page-quote-grid">
        <figure class="page-quote">
          <blockquote>“Our contracts have gone higher by about one-third of what we were getting before we took the services from SMAC Digital. They helped us a lot in finding more new clients from all over India digitally through their great website setup and digital marketing strategy.”</blockquote>
          <figcaption>Stone Hub India</figcaption>
        </figure>
        <figure class="page-quote">
          <blockquote>“It's been 12 months of our association with SMAC Digital. Their partnership, service delivery and quality control have made us stand out among our competitors, and are some of the key reasons for our expansion.”</blockquote>
          <figcaption>Tumbledry</figcaption>
        </figure>
        <figure class="page-quote">
          <blockquote>“Online learning and quizzing is on its zenith now and because of SMAC Digital, the students enrolled in our online learning platform Belearno are finding our website handy for their use.”</blockquote>
          <figcaption>Belearno</figcaption>
        </figure>
        <figure class="page-quote">
          <blockquote>“SMAC Digital gave our interior designing business exposure to the world of the internet. They gave us steady growth by making our website greatly influential.”</blockquote>
          <figcaption>Casa Interno</figcaption>
        </figure>
      </div>
    </section>`
}));

// BLOG
write("blog.html", page({
  file: "blog.html", fromDir: ".", active: "blog",
  title: "Blog | SMAC Digital",
  description: "Exploring trends and sharing perspectives from SMAC Digital.",
  body: `
    ${hero({ eyebrow: "Blog", title: "Exploring trends,", outline: "sharing perspectives.", lead: "Notes on lead generation, apps, ecommerce, and growth from the SMAC Digital team.", ctaHref: "contact.html", ctaLabel: "Ask us anything", tone: "red" })}
    <section class="page-section">
      <div class="wrap page-blog-list">
        <a class="page-blog-item" href="https://www.smacdigital.com/blogs/from-wholesaler-to-d2c-how-home-decor-handicraft-manufacturers-can-double-margins-and-build-long-term-brand-value-with-shopify" target="_blank" rel="noopener noreferrer">
          <time datetime="2026-10-16">16 Oct 2026</time>
          <h2>From Wholesaler to D2C: How Home Decor &amp; Handicraft Manufacturers Can Double Margins with Shopify</h2>
        </a>
        <a class="page-blog-item" href="https://www.smacdigital.com/blogs/how-to-choose-the-best-mobile-app-development-company-in-jaipur-for-your-business-smac-digital" target="_blank" rel="noopener noreferrer">
          <time datetime="2026-10-10">10 Oct 2026</time>
          <h2>How to Choose the Best Mobile App Development Company in Jaipur for Your Business</h2>
        </a>
        <a class="page-blog-item" href="https://www.smacdigital.com/blogs/lead-generation-agency-how-smac-digital-helps-businesses-generate-high-quality-leads" target="_blank" rel="noopener noreferrer">
          <time datetime="2026-09-26">26 Sep 2026</time>
          <h2>Lead Generation Agency: How SMAC Digital Helps Businesses Generate High-Quality Leads</h2>
        </a>
      </div>
    </section>`
}));

// CONTACT
write("contact.html", page({
  file: "contact.html", fromDir: ".", active: "contact",
  title: "Contact Us | SMAC Digital",
  description: "Ask for a digital audit and growth plan. Offices in Jaipur, Kolkata, Pune, and the US.",
  body: `
    ${hero({ eyebrow: "Contact", title: "Ask for a digital audit", outline: "and a growth plan.", lead: "Tell us what you are building. Reach Rahul in Pune, Jitendra in Jaipur, or Deep in Kolkata — or use the form on the homepage.", ctaHref: "index.html#contact", ctaLabel: "Open the brief form", tone: "dark" })}
    <section class="page-section">
      <div class="wrap page-contact-grid">
        <article class="page-contact-card">
          <h2>Pune</h2>
          <p>Rahul Swami</p>
          <a href="tel:+919582792638">+91 95827 92638</a>
          <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
        </article>
        <article class="page-contact-card">
          <h2>Jaipur</h2>
          <p>Jitendra Swami · Business enquiries</p>
          <p>Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur 302020</p>
          <a href="tel:+919829069519">+91 98290 69519</a>
          <a href="mailto:Jitendra@smacdigital.com">Jitendra@smacdigital.com</a>
        </article>
        <article class="page-contact-card">
          <h2>Kolkata</h2>
          <p>Deep Chakravarty · Business enquiries</p>
          <p>Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</p>
          <a href="tel:+919831132254">+91 98311 32254</a>
          <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a>
        </article>
        <article class="page-contact-card">
          <h2>United States</h2>
          <p>1507 E Flower Street, Gilbert AZ 85298</p>
        </article>
      </div>
    </section>`
}));

// CAREER
write("career.html", page({
  file: "career.html", fromDir: ".", active: "career",
  title: "Careers | SMAC Digital",
  description: "Join SMAC Digital. Career enquiries for digital marketing, design, and development roles.",
  body: `
    ${hero({ eyebrow: "Careers", title: "Build with a team", outline: "that ships growth.", lead: "We're always interested in marketers, designers, and builders who care about performance. Career content on the live site is light — reach out and tell us how you want to contribute.", ctaHref: "mailto:rahul@smacdigital.com", ctaLabel: "Email careers", tone: "red" })}
    <section class="page-section">
      <div class="wrap page-split">
        <div>
          <h2>Open conversations</h2>
          <p>Roles often span SEO, social, content, paid media, web, and product. Send a short note with your focus, portfolio or LinkedIn, and preferred city (Jaipur, Kolkata, Pune, or remote-friendly).</p>
          <div class="page-cta-row">
            <a class="btn btn-primary" href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
            <a class="btn btn-navy" href="tel:+919582792638">+91 95827 92638</a>
          </div>
        </div>
        <div class="page-card-grid single">
          <article class="page-card"><h3>What we look for</h3><p>Clear thinking, craft pride, and comfort measuring what shipped. Agency pace with client empathy.</p></article>
          <article class="page-card"><h3>How to apply</h3><p>Email with subject “Career — [your role interest]”. We'll reply when there's a fit.</p></article>
        </div>
      </div>
    </section>`
}));

// EVENTS
write("events.html", page({
  file: "events.html", fromDir: ".", active: "events",
  title: "Events | SMAC Digital",
  description: "SMAC Digital events, workshops, and community sessions.",
  body: `
    ${hero({ eyebrow: "Events", title: "Workshops,", outline: "sessions, and community.", lead: "When SMAC hosts or joins industry sessions, details will land here. Meanwhile, ask us about private workshops for your team.", ctaHref: "contact.html", ctaLabel: "Host a session", tone: "navy" })}
    <section class="page-section">
      <div class="wrap">
        <article class="page-empty-card">
          <h2>No public events listed right now</h2>
          <p>Check back soon, or contact us to discuss a private digital marketing workshop for your organisation.</p>
          <a class="btn btn-primary" href="contact.html">Contact SMAC</a>
        </article>
      </div>
    </section>`
}));

console.log("done");
