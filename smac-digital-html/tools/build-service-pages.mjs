import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");

const pack = [
  ...JSON.parse(fs.readFileSync(path.join(__dirname, "service-content.json"), "utf8")),
  ...JSON.parse(fs.readFileSync(path.join(__dirname, "service-content-rest.json"), "utf8")),
];

function esc(s) {
  return String(s || "")
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;");
}

/** Bold the label before the first colon when present (matches live smacdigital.com). */
function formatBullet(b) {
  const text = String(b || "");
  const idx = text.indexOf(":");
  if (idx > 0 && idx < 48) {
    return `<li><strong>${esc(text.slice(0, idx))}:</strong>${esc(text.slice(idx + 1))}</li>`;
  }
  return `<li>${esc(text)}</li>`;
}

function sectionHtml(sec, i) {
  const odd = i % 2 === 1;
  const bullets = (sec.bullets || []).map(formatBullet).join("");
  const paras = (sec.paragraphs || []).map((p) => `<p>${esc(p)}</p>`).join("");
  return `
    <section class="svc-long ${odd ? "svc-long-tint" : ""}">
      <div class="wrap svc-long-inner ${odd ? "is-flip" : ""}">
        <div class="svc-long-copy">
          <p class="page-eyebrow dark">${String(i + 1).padStart(2, "0")}</p>
          <h2>${esc(sec.heading)}</h2>
          ${paras}
          ${bullets ? `<ul class="svc-check-list">${bullets}</ul>` : ""}
        </div>
        <div class="svc-long-panel" aria-hidden="true">
          <span class="svc-long-mark">${String(i + 1).padStart(2, "0")}</span>
          <p>${esc(sec.heading)}</p>
        </div>
      </div>
    </section>`;
}

function pillarsHtml(svc) {
  const defaults = [
    { k: "01", t: "Strategy", d: "Goals first — then tactics that fit the brand." },
    { k: "02", t: "Execution", d: "Hands-on delivery across creative, media, and tech." },
    { k: "03", t: "Measurement", d: "Clear reporting so you know what moved the needle." },
    { k: "04", t: "Growth", d: "Iterate toward quality traffic and real leads." },
  ];
  const items = svc.pillars || defaults;
  return `
    <section class="svc-pillars" aria-label="How we work">
      <div class="wrap">
        <ul class="svc-pillars-grid" role="list">
          ${items
            .map(
              (p) => `
            <li class="svc-pillar">
              <span class="svc-pillar-num">${esc(p.k)}</span>
              <strong>${esc(p.t)}</strong>
              <p>${esc(p.d)}</p>
            </li>`
            )
            .join("")}
        </ul>
      </div>
    </section>`;
}

function processHtml(svc) {
  const steps = svc.process || [
    { t: "Discover", d: "Audit the current footprint, keywords, and competitors." },
    { t: "Plan", d: "Build a roadmap tied to short- and long-term business goals." },
    { t: "Build", d: "Ship on-page, content, and offsite work with white-hat craft." },
    { t: "Grow", d: "Track rankings, traffic quality, and leads — then refine." },
  ];
  return `
    <section class="svc-process">
      <div class="wrap">
        <header class="svc-process-head">
          <p class="page-eyebrow dark">Engagement</p>
          <h2>A clear path from brief to results</h2>
          <p class="svc-process-lead">The same disciplined rhythm we use across SMAC Digital engagements — adapted for ${esc(svc.title)}.</p>
        </header>
        <ol class="svc-process-track">
          ${steps
            .map(
              (s, i) => `
            <li>
              <span class="svc-process-step">${String(i + 1).padStart(2, "0")}</span>
              <h3>${esc(s.t)}</h3>
              <p>${esc(s.d)}</p>
            </li>`
            )
            .join("")}
        </ol>
      </div>
    </section>`;
}

function bodyFor(svc) {
  const intro = (svc.intro || []).map((p) => `<p>${esc(p)}</p>`).join("");
  const sections = (svc.sections || []).map(sectionHtml).join("");
  const why = svc.why || [];
  const whyTitle = svc.whyTitle || "How SMAC Digital will help";
  const whyHtml = why.length
    ? `
    <section class="svc-why">
      <div class="wrap">
        <p class="page-eyebrow">Why SMAC Digital</p>
        <h2>${esc(whyTitle)}</h2>
        <div class="svc-why-grid">
          ${why
            .map((w, i) => {
              const title = typeof w === "string" ? w : w.title;
              const text = typeof w === "string" ? "" : w.text || "";
              return `
            <article class="svc-why-card">
              <span>${String(i + 1).padStart(2, "0")}</span>
              <h3>${esc(title)}</h3>
              ${text ? `<p>${esc(text)}</p>` : ""}
            </article>`;
            })
            .join("")}
        </div>
      </div>
    </section>`
    : "";

  const related = (svc.related || [])
    .map(
      (r) =>
        `<a href="${esc(r.slug)}.html"><strong>${esc(r.title)}</strong><span>${esc(r.short || "Learn more")}</span></a>`
    )
    .join("");

  const ctaH = svc.ctaTitle ||
    "We work with you to improve your business's bottom line and generate positive ROI so that you can scale it up.";
  const ctaP = svc.ctaText ||
    "Therefore, if you are looking for the best services for boosting your presence online and converting visitors into quality leads, contact us today.";

  const words = String(svc.title || "").trim().split(/\s+/);
  const line2 = words.length > 1 ? words.slice(-1).join(" ") : words[0] || "";
  const line1 = words.length > 1 ? words.slice(0, -1).join(" ") : "Our service";
  const lede = esc(svc.lede || (svc.intro && svc.intro[0]) || "");

  return `
    <section class="hero inner-hero" aria-labelledby="svc-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Services</p>
        <h1 id="svc-hero-title">
          <span>${esc(line1)}</span><br>
          <em>${esc(line2)}</em>
        </h1>
        <p class="lede">${lede}</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="../contact.html">Make a Call Now</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="../contact.html">Get a free consultation</a>
        </div>
      </div>
    </section>

    ${pillarsHtml(svc)}

    <section class="svc-intro-band">
      <div class="wrap svc-intro-grid">
        <div>
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
        </div>
        <div class="svc-intro-copy">${intro}</div>
      </div>
    </section>

    ${sections}

    ${processHtml(svc)}

    ${whyHtml}

    <section class="svc-roi-band">
      <div class="wrap svc-roi-inner">
        <div>
          <p class="page-eyebrow">Results</p>
          <h2>${esc(ctaH)}</h2>
          <p>${esc(ctaP)}</p>
        </div>
        <a class="btn btn-white" href="../contact.html">Make a Call Now</a>
      </div>
    </section>

    <section class="page-section page-section-tint">
      <div class="wrap">
        <p class="page-eyebrow dark">Next step</p>
        <h2>Explore more services</h2>
        <div class="svc-related">${related}</div>
      </div>
    </section>

    <section class="page-band">
      <div class="wrap page-band-inner">
        <h2>Looking for the best ${esc(svc.title)} support?</h2>
        <p>Contact SMAC Digital today — we’ll map a clear next step for your brand.</p>
        <a class="btn btn-white" href="../contact.html">Get a free consultation</a>
      </div>
    </section>`;
}

const shellSample = fs.readFileSync(
  path.join(root, "services/search-engine-optimization.html"),
  "utf8"
);
const mainOpen = '<main id="main">';
const mainClose = "</main>";
const headEnd = shellSample.indexOf(mainOpen);
const footStart = shellSample.indexOf(mainClose);
if (headEnd < 0 || footStart < 0) throw new Error("Could not find main landmarks in shell");
const head = shellSample.slice(0, headEnd + mainOpen.length);
const foot = shellSample.slice(footStart);

const customSlugs = new Set(["search-engine-optimization"]);

for (const svc of pack) {
  if (customSlugs.has(svc.slug)) {
    console.log("skip custom", svc.slug);
    continue;
  }
  const title = `${svc.title} | SMAC Digital`;
  const rawDesc = svc.lede || svc.intro?.[0] || svc.title;
  const desc = esc(String(rawDesc).slice(0, 155));
  let html = head.replace(
    /<header class="site-header[^"]*" data-header>/,
    '<header class="site-header" data-header>'
  );
  html = html.replace(/<title>[\s\S]*?<\/title>/, `<title>${esc(title)}</title>`);
  html = html.replace(
    /<meta name="description" content="[\s\S]*?">/,
    `<meta name="description" content="${desc}">`
  );
  html = `${html}\n${bodyFor(svc)}\n  ${foot}`;
  fs.writeFileSync(path.join(root, "services", `${svc.slug}.html`), html, "utf8");
  console.log("wrote", svc.slug);
}

console.log("done", pack.length, "service pages");
