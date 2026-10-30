import fs from "fs";

let h = fs.readFileSync("index.html", "utf8");

const map = [
  ['href="#about"', 'href="about-us.html"'],
  ['href="#work"', 'href="portfolios.html"'],
  ['href="#case-studies"', 'href="portfolios.html#cases"'],
  ['href="#testimonials"', 'href="testimonials.html"'],
  ['href="#insights"', 'href="blog.html"'],
  ['href="#contact"', 'href="contact.html"'],
  ['href="#partners"', 'href="about-us.html"'],
  ['href="https://www.smacdigital.com/service" target="_blank" rel="noopener noreferrer"', 'href="services.html"'],
  ['href="https://www.smacdigital.com/services/search-engine-optimization" target="_blank" rel="noopener noreferrer"', 'href="services/search-engine-optimization.html"'],
  ['href="https://www.smacdigital.com/services/social-media-marketing" target="_blank" rel="noopener noreferrer"', 'href="services/social-media-marketing.html"'],
  ['href="https://www.smacdigital.com/services/lead-generation" target="_blank" rel="noopener noreferrer"', 'href="services/lead-generation.html"'],
  ['href="https://www.smacdigital.com/services/inbound-marketing" target="_blank" rel="noopener noreferrer"', 'href="services/inbound-marketing.html"'],
  ['href="https://www.smacdigital.com/services/digital-media-planning" target="_blank" rel="noopener noreferrer"', 'href="services/digital-media-planning.html"'],
  ['href="https://www.smacdigital.com/services/content-marketing-services" target="_blank" rel="noopener noreferrer"', 'href="services/content-marketing.html"'],
  ['href="https://www.smacdigital.com/services/video-marketing" target="_blank" rel="noopener noreferrer"', 'href="services/video-marketing.html"'],
  ['href="https://www.smacdigital.com/services/influencer-marketing" target="_blank" rel="noopener noreferrer"', 'href="services/influencer-marketing.html"'],
  ['href="https://www.smacdigital.com/services/online-reputation-management" target="_blank" rel="noopener noreferrer"', 'href="services/online-reputation-management.html"'],
  ['href="https://www.smacdigital.com/services/social-media-analytics" target="_blank" rel="noopener noreferrer"', 'href="services/social-media-analytics.html"'],
  ['href="https://www.smacdigital.com/services/website-design-and-development" target="_blank" rel="noopener noreferrer"', 'href="services/website-design-and-development.html"'],
  ['href="https://www.smacdigital.com/services/mobile-application-development" target="_blank" rel="noopener noreferrer"', 'href="services/mobile-application-development.html"'],
  ['href="https://www.smacdigital.com/services/marketing-automation" target="_blank" rel="noopener noreferrer"', 'href="services/marketing-automation.html"'],
  ['href="https://www.smacdigital.com/services/sentiment-analysis" target="_blank" rel="noopener noreferrer"', 'href="services/sentiment-analysis.html"'],
  ['href="https://www.smacdigital.com/services/devops-services" target="_blank" rel="noopener noreferrer"', 'href="services/devops-services.html"'],
  ['href="https://www.smacdigital.com/portfolios" target="_blank" rel="noopener noreferrer"', 'href="portfolios.html"'],
  ['href="https://www.smacdigital.com/testimonials" target="_blank" rel="noopener noreferrer"', 'href="testimonials.html"'],
  ['href="https://www.smacdigital.com/blogs" target="_blank" rel="noopener noreferrer"', 'href="blog.html"'],
  ['href="https://www.smacdigital.com/about-us" target="_blank" rel="noopener noreferrer"', 'href="about-us.html"'],
  ['href="https://www.smacdigital.com/career" target="_blank" rel="noopener noreferrer"', 'href="career.html"'],
  ['href="https://www.smacdigital.com/events" target="_blank" rel="noopener noreferrer"', 'href="events.html"'],
  ['href="https://www.smacdigital.com/contact-us" target="_blank" rel="noopener noreferrer"', 'href="contact.html"'],
];

for (const [a, b] of map) h = h.split(a).join(b);

// Portfolio dropdown CTA on home should stay on-page work OR go to portfolio — use portfolios.html
h = h.replace(
  'href="portfolios.html" data-nav-link>\n                      Explore Our Portfolio',
  'href="portfolios.html">\n                      Explore Our Portfolio'
);

// Keep homepage contact form section usable: restore hero CTA that should scroll to form
// Don't restore all #contact — contact.html is fine for nav; form is on index — add index.html#contact for form CTAs carefully
h = h.replaceAll('href="contact.html">Get a free consultation</a>', 'href="index.html#contact">Get a free consultation</a>');
// On homepage itself index.html#contact is odd — fix to #contact for same-page
h = h.replaceAll('href="index.html#contact"', 'href="#contact"');

fs.writeFileSync("index.html", h);
console.log("index rewired");
