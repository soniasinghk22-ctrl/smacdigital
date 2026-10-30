import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..", "services");

const introImage = {
  "social-media-marketing.html": ["social.jpg", "Social that compounds"],
  "content-marketing.html": ["topic-content.jpg", "Content with a job"],
  "video-marketing.html": ["video.jpg", "Stories that stick"],
  "influencer-marketing.html": ["topic-network.jpg", "Creators with reach"],
  "lead-generation.html": ["topic-growth.jpg", "Pipeline, not vanity"],
  "marketing-automation.html": ["automation.jpg", "Journeys that nurture"],
  "inbound-marketing.html": ["inbound.jpg", "Attract. Convert. Delight."],
  "website-design-and-development.html": ["website.jpg", "Sites built to convert"],
  "mobile-application-development.html": ["mobile.jpg", "Product-ready apps"],
  "digital-media-planning.html": ["media.jpg", "Spend with intent"],
  "online-reputation-management.html": ["topic-brand.jpg", "Protect the brand"],
  "social-media-analytics.html": ["topic-analytics.jpg", "Signal over noise"],
  "sentiment-analysis.html": ["topic-engagement.jpg", "Read the room"],
  "devops-services.html": ["topic-code.jpg", "Ship with confidence"],
};

let n = 0;

for (const file of fs.readdirSync(root).filter((f) => f.endsWith(".html"))) {
  const fp = path.join(root, file);
  let html = fs.readFileSync(fp, "utf8");
  let changed = false;

  const pillarsRe =
    /<section class="svc-pillars" aria-label="How we work">\s*<div class="wrap">\s*<ul class="svc-pillars-grid" role="list">([\s\S]*?)<\/ul>\s*<\/div>\s*<\/section>/i;

  if (pillarsRe.test(html)) {
    html = html.replace(pillarsRe, (_, list) => {
      return `<section class="svc-pillars" aria-label="How we work">
      <div class="svc-pillars-pattern" aria-hidden="true"></div>
      <div class="wrap">
        <header class="svc-pillars-head">
          <div>
            <p class="pill">How we work</p>
            <h2>Four moves. One outcome.</h2>
          </div>
          <p>A tight rhythm from brief to growth — strategy, delivery, proof, and iteration without the fluff.</p>
        </header>
        <ul class="svc-pillars-grid" role="list">${list}</ul>
      </div>
    </section>`;
    });
    changed = true;
  }

  const introRe =
    /<section class="svc-intro-band">\s*<div class="wrap svc-intro-grid">\s*<div>\s*<p class="page-eyebrow dark">Overview<\/p>\s*<h2>What this service covers<\/h2>\s*<\/div>\s*<div class="svc-intro-copy">([\s\S]*?)<\/div>\s*<\/div>\s*<\/section>/i;

  if (introRe.test(html)) {
    const [img, caption] = introImage[file] || ["topic-meeting.jpg", "Built for results"];
    html = html.replace(introRe, (_, copy) => {
      return `<section class="svc-intro-band">
      <div class="wrap svc-intro-grid">
        <figure class="svc-intro-media">
          <img src="../assets/services/${img}" alt="" width="900" height="1100" loading="lazy">
          <figcaption>${caption}</figcaption>
        </figure>
        <div class="svc-intro-content">
          <p class="page-eyebrow dark">Overview</p>
          <h2>What this service covers</h2>
          <div class="svc-intro-copy">${copy.trim()}</div>
        </div>
      </div>
    </section>`;
    });
    changed = true;
  }

  if (changed) {
    fs.writeFileSync(fp, html);
    n++;
    console.log("upgraded", file);
  }
}

console.log("Done.", n);
