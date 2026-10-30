import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..", "services");

const leadByPage = {
  "social-media-marketing.html": "Pair social campaigns with analytics, creators, and content that keep momentum going.",
  "content-marketing.html": "Connect content to SEO, social, and inbound systems so every asset earns traffic and leads.",
  "search-engine-optimization.html": "Support SEO with content, technical builds, and paid channels that compound organic growth.",
  "video-marketing.html": "Distribute video through social, creators, and content programs built for attention and conversion.",
  "influencer-marketing.html": "Extend creator partnerships with social, content, and analytics that prove what resonates.",
  "lead-generation.html": "Feed your pipeline with inbound, SEO, and media tactics that qualify demand before sales.",
  "marketing-automation.html": "Tie automation to inbound, CRM-ready lead gen, and content journeys that nurture at scale.",
  "inbound-marketing.html": "Align inbound with SEO, content, and automation so attraction turns into pipeline.",
  "website-design-and-development.html": "Pair your site with SEO, DevOps, and content so design, speed, and discovery work together.",
  "mobile-application-development.html": "Support product launches with DevOps, UX-led web, and growth channels that drive adoption.",
  "digital-media-planning.html": "Connect media plans to social, video, and lead gen so spend maps cleanly to outcomes.",
  "online-reputation-management.html": "Protect reputation alongside social listening, content, and analytics that surface risk early.",
  "social-media-analytics.html": "Turn insights into action with social, content, and influencer programs guided by the data.",
  "sentiment-analysis.html": "Use sentiment signals to sharpen social, ORM, and content decisions with clearer context.",
  "devops-services.html": "Keep delivery reliable while web, apps, and growth teams ship faster with less friction.",
};

let updated = 0;

for (const file of fs.readdirSync(root).filter((f) => f.endsWith(".html"))) {
  const full = path.join(root, file);
  let html = fs.readFileSync(full, "utf8");
  if (!html.includes('class="svc-related"') && !html.includes("class='svc-related'")) continue;

  const lead =
    leadByPage[file] ||
    "Continue with related capabilities that pair well with this offer.";

  html = html.replace(
    /<section class="page-section page-section-tint">\s*<div class="wrap">\s*<p class="page-eyebrow dark">Next step<\/p>\s*<h2>Explore more services<\/h2>\s*<div class="svc-related">([\s\S]*?)<\/div>\s*<\/div>\s*<\/section>/i,
    (_, inner) => {
      // Parse existing anchors
      const anchors = [...inner.matchAll(/<a href="([^"]+)">\s*<strong>([\s\S]*?)<\/strong>\s*<span>([\s\S]*?)<\/span>\s*<\/a>/gi)];
      if (!anchors.length) return _;

      const cards = anchors
        .map((m, i) => {
          const idx = String(i + 1).padStart(2, "0");
          return `          <a href="${m[1]}">
            <span class="svc-related-index">${idx}</span>
            <strong>${m[2].trim()}</strong>
            <span>${m[3].trim()}</span>
            <em class="svc-related-go" aria-hidden="true">→</em>
          </a>`;
        })
        .join("\n");

      return `    <section class="page-section page-section-tint svc-explore" aria-labelledby="svc-explore-title">
      <div class="wrap">
        <header class="svc-explore-head">
          <p class="page-eyebrow dark">Next step</p>
          <h2 id="svc-explore-title">Explore more services</h2>
          <p class="svc-explore-lead">${lead}</p>
        </header>
        <div class="svc-related">
${cards}
        </div>
      </div>
    </section>`;
    }
  );

  fs.writeFileSync(full, html);
  updated += 1;
  console.log("improved", file);
}

console.log(`Done. Updated ${updated} pages.`);
