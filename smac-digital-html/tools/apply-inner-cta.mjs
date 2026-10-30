import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");

const phoneSvg = `<svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg>`;
const waSvg = `<svg viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg>`;

const copyByPage = {
  "about-us.html": {
    id: "about-cta-title",
    line1: "Improve the bottom line.",
    line2: "Generate positive ROI.",
    body: "Partner with a team that blends strategy, creative, and media to grow brands with measurable outcomes across India and beyond.",
  },
  "services.html": {
    id: "services-cta-title",
    line1: "Pick the right growth stack.",
    line2: "Scale what works.",
    body: "From SEO and social to automation and product builds — explore services built to drive traffic, leads, and revenue for your brand.",
  },
  "portfolios.html": {
    id: "portfolio-cta-title",
    line1: "See results in action.",
    line2: "Build your next win.",
    body: "Review the campaigns and digital products we’ve delivered — then let’s map a plan that fits your goals, market, and budget.",
  },
  "testimonials.html": {
    id: "testimonials-cta-title",
    line1: "Trusted by growing brands.",
    line2: "Become the next story.",
    body: "Hear how teams use SMAC Digital to improve visibility, engagement, and ROI — then start a conversation about your next milestone.",
  },
  "blog.html": {
    id: "blog-cta-title",
    line1: "Ideas that drive action.",
    line2: "Turn insight into growth.",
    body: "Use our playbooks and updates to sharpen your marketing — or talk to our team when you’re ready to execute with confidence.",
  },
  "contact.html": {
    id: "contact-cta-title",
    line1: "Ready when you are.",
    line2: "Let’s talk strategy.",
    body: "Share your goals and challenges — we’ll respond with clear next steps, timelines, and a practical path to stronger digital results.",
  },
  "career.html": {
    id: "career-cta-title",
    line1: "Build with ambitious teams.",
    line2: "Grow your craft here.",
    body: "Join a performance-driven digital agency where strategy, creativity, and ownership matter — explore roles or reach out to our team.",
  },
  "events.html": {
    id: "events-cta-title",
    line1: "Meet us in the room.",
    line2: "Continue the conversation.",
    body: "Whether you caught us at an event or want to host one together — let’s connect and explore how SMAC Digital can support your brand.",
  },
  "services/search-engine-optimization.html": {
    id: "seo-cta-title",
    line1: "Improve the bottom line.",
    line2: "Generate positive ROI.",
    body: "We work with you to scale with a performance-driven partner — strategy, creative, and media measured against real business outcomes.",
  },
  "services/social-media-marketing.html": {
    id: "smm-cta-title",
    line1: "Own the feed.",
    line2: "Convert attention.",
    body: "Build social presence that earns engagement and demand — with content, community, and paid amplification aligned to your brand goals.",
  },
  "services/marketing-automation.html": {
    id: "automation-cta-title",
    line1: "Automate the busywork.",
    line2: "Accelerate pipeline.",
    body: "Connect your stack, nurture leads, and trigger journeys that keep prospects moving — with automation built for measurable growth.",
  },
  "services/inbound-marketing.html": {
    id: "inbound-cta-title",
    line1: "Attract the right buyers.",
    line2: "Nurture to close.",
    body: "Combine content, SEO, and conversion paths so qualified demand finds you — then guide them with inbound systems that convert.",
  },
  "services/video-marketing.html": {
    id: "video-cta-title",
    line1: "Tell it on camera.",
    line2: "Make it convert.",
    body: "From brand films to performance creatives — use video that captures attention and supports campaigns that drive real business results.",
  },
  "services/website-design-and-development.html": {
    id: "web-cta-title",
    line1: "Design for clarity.",
    line2: "Build for growth.",
    body: "Launch fast, usable websites engineered for SEO, speed, and conversion — so your digital home works as hard as your marketing.",
  },
  "services/mobile-application-development.html": {
    id: "app-cta-title",
    line1: "Ship useful products.",
    line2: "Keep users coming back.",
    body: "Plan, design, and develop mobile experiences that solve real jobs — with performance, UX, and iteration built into the process.",
  },
  "services/digital-media-planning.html": {
    id: "media-cta-title",
    line1: "Plan every rupee.",
    line2: "Maximize media ROI.",
    body: "Get media plans grounded in audience insight and channel fit — so your spend reaches the right people with measurable efficiency.",
  },
  "services/lead-generation.html": {
    id: "leads-cta-title",
    line1: "Fill the pipeline.",
    line2: "Qualify what matters.",
    body: "Generate and nurture leads with campaigns built for volume and quality — so sales gets conversations worth closing.",
  },
  "services/content-marketing.html": {
    id: "content-cta-title",
    line1: "Create with purpose.",
    line2: "Compound your reach.",
    body: "Publish content that educates, ranks, and converts — with editorial systems that keep your brand consistent and discoverable.",
  },
  "services/influencer-marketing.html": {
    id: "influencer-cta-title",
    line1: "Partner with voices.",
    line2: "Earn real trust.",
    body: "Activate creators who fit your audience and offer — with campaigns measured on engagement, traffic, and brand lift that matters.",
  },
  "services/online-reputation-management.html": {
    id: "orm-cta-title",
    line1: "Protect the narrative.",
    line2: "Strengthen trust.",
    body: "Monitor, respond, and shape how your brand shows up online — so reputation becomes a growth asset, not a risk.",
  },
  "services/social-media-analytics.html": {
    id: "analytics-cta-title",
    line1: "Measure what moves.",
    line2: "Optimize with clarity.",
    body: "Turn social data into decisions — track performance, audience signals, and creative winners so every campaign gets sharper.",
  },
  "services/sentiment-analysis.html": {
    id: "sentiment-cta-title",
    line1: "Listen at scale.",
    line2: "Act with context.",
    body: "Understand how audiences feel about your brand and category — then use sentiment insight to guide messaging and response.",
  },
  "services/devops-services.html": {
    id: "devops-cta-title",
    line1: "Ship with confidence.",
    line2: "Operate with speed.",
    body: "Modernize delivery with DevOps practices that improve reliability, release cadence, and collaboration across your product teams.",
  },
};

function buildCta({ id, line1, line2, body }, prefix) {
  const contact = `${prefix}contact.html`;
  const portfolio = `${prefix}portfolios.html`;
  return `
    <section class="about-cta about-cta--red" aria-labelledby="${id}">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="${id}">
            ${line1}
            <em>${line2}</em>
          </h2>
          <p>${body}</p>
          <div class="about-cta-actions">
            <a class="btn btn-white" href="${contact}">Get a free consultation</a>
            <span class="or" aria-hidden="true">or</span>
            <a class="btn btn-black" href="${portfolio}">See the work</a>
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
              <span class="about-cta-phone-ico" aria-hidden="true">${phoneSvg}</span>
              <span>
                <small>Delhi NCR</small>
                <strong>+91 95827 92638</strong>
              </span>
            </a>
            <a class="about-cta-phone" href="tel:+919829069519">
              <span class="about-cta-phone-ico" aria-hidden="true">${phoneSvg}</span>
              <span>
                <small>Jaipur</small>
                <strong>+91 98290 69519</strong>
              </span>
            </a>
          </div>
          <a class="about-cta-wa" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
            <span class="about-cta-wa-ico" aria-hidden="true">${waSvg}</span>
            <span>
              <strong>WhatsApp the team</strong>
              <small>Usually replies in minutes</small>
            </span>
          </a>
        </aside>
      </div>
    </section>`;
}

function listHtmlFiles(dir, base = "") {
  const out = [];
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    if (entry.name.startsWith(".")) continue;
    const rel = path.join(base, entry.name).replaceAll("\\", "/");
    const full = path.join(dir, entry.name);
    if (entry.isDirectory()) {
      if (entry.name === "tools" || entry.name === "assets" || entry.name === "node_modules") continue;
      out.push(...listHtmlFiles(full, rel));
    } else if (entry.name.endsWith(".html")) {
      out.push(rel);
    }
  }
  return out;
}

const files = listHtmlFiles(root).filter((f) => f !== "index.html" && !f.startsWith("tools/"));
let updated = 0;

for (const rel of files) {
  const full = path.join(root, rel);
  let html = fs.readFileSync(full, "utf8");
  const isService = rel.startsWith("services/");
  const prefix = isService ? "../" : "";
  const copy = copyByPage[rel] || {
    id: `${path.basename(rel, ".html")}-cta-title`,
    line1: "Improve the bottom line.",
    line2: "Generate positive ROI.",
    body: "We work with you to scale with a performance-driven partner — strategy, creative, and media measured against real business outcomes.",
  };

  const cta = buildCta(copy, prefix);

  // Remove any existing red/black CTA blocks before footer
  html = html.replace(/\s*<section class="about-cta[\s\S]*?<\/section>(?=\s*<\/main>)/i, "");

  if (!/<\/main>/i.test(html)) {
    console.warn("skip (no main):", rel);
    continue;
  }

  html = html.replace(/<\/main>/i, `${cta}\n  </main>`);
  fs.writeFileSync(full, html);
  updated += 1;
  console.log("updated", rel);
}

console.log(`Done. Updated ${updated} internal pages.`);
