/**
 * Apply About-style inner hero + transparent header to all internal pages.
 */
import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");

const pages = [
  {
    file: "services.html",
    pill: "Services",
    line1: "Digital marketing",
    line2: "services that ship.",
    lede: "Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system.",
    primary: { href: "contact.html", label: "Start a brief" },
  },
  {
    file: "portfolios.html",
    pill: "Portfolio",
    line1: "Selected",
    line2: "client work.",
    lede: "Partners in growth — browse brands below to see the brief, the work, and what clients said publicly.",
    primary: { href: "contact.html", label: "Start a project" },
  },
  {
    file: "testimonials.html",
    pill: "Testimonials",
    line1: "Words from",
    line2: "our customers.",
    lede: "These cases are perfectly simple and easy to distinguish — real partners, real outcomes.",
    primary: { href: "contact.html", label: "Become a partner" },
  },
  {
    file: "blog.html",
    pill: "Blog",
    line1: "Exploring trends,",
    line2: "sharing perspectives.",
    lede: "Notes on lead generation, apps, ecommerce, and growth from the SMAC Digital team.",
    primary: { href: "contact.html", label: "Ask us anything" },
  },
  {
    file: "contact.html",
    pill: "Contact",
    line1: "Ask for a digital audit",
    line2: "and a growth plan.",
    lede: "Tell us what you are building. Reach Rahul in Pune, Jitendra in Jaipur, or Deep in Kolkata — or use the form on the homepage.",
    primary: { href: "index.html#contact", label: "Open the brief form" },
  },
  {
    file: "career.html",
    pill: "Careers",
    line1: "Build with a team",
    line2: "that ships growth.",
    lede: "We're always interested in marketers, designers, and builders who care about performance.",
    primary: { href: "mailto:rahul@smacdigital.com", label: "Email careers" },
  },
  {
    file: "events.html",
    pill: "Events",
    line1: "Workshops,",
    line2: "sessions, and community.",
    lede: "When SMAC hosts or joins industry sessions, details will land here. Meanwhile, ask us about private workshops for your team.",
    primary: { href: "contact.html", label: "Host a session" },
  },
];

function heroHtml({ pill, line1, line2, lede, primary, id }) {
  const contactHref = primary.href.startsWith("../") ? "../contact.html" : "contact.html";
  return `
    <section class="hero inner-hero" aria-labelledby="${id}">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">${pill}</p>
        <h1 id="${id}">
          <span>${line1}</span><br>
          <em>${line2}</em>
        </h1>
        <p class="lede">${lede}</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="${primary.href}">${primary.label}</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="${contactHref}">Get a free consultation</a>
        </div>
      </div>
    </section>`;
}

function fixHeader(html) {
  return html.replace(
    /<header class="site-header[^"]*" data-header>/,
    '<header class="site-header" data-header>'
  );
}

function replaceHero(html, nextHero) {
  const re =
    /<section class="page-hero[\s\S]*?<\/section>|<section class="hero (?:about-hero|inner-hero)"[\s\S]*?<\/section>/;
  if (!re.test(html)) throw new Error("No hero section found");
  return html.replace(re, nextHero.trim());
}

for (const page of pages) {
  const fp = path.join(root, page.file);
  let html = fs.readFileSync(fp, "utf8");
  html = fixHeader(html);
  const id = `${path.basename(page.file, ".html")}-hero-title`;
  html = replaceHero(html, heroHtml({ ...page, id }));
  fs.writeFileSync(fp, html, "utf8");
  console.log("updated", page.file);
}

console.log("done static pages");
