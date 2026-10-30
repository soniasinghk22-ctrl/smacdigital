import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..", "services");

const byHref = {
  "influencer-marketing.html": "topic-network.jpg",
  "social-media-analytics.html": "topic-analytics.jpg",
  "content-marketing.html": "topic-content.jpg",
  "search-engine-optimization.html": "seo.jpg",
  "social-media-marketing.html": "social.jpg",
  "inbound-marketing.html": "inbound.jpg",
  "video-marketing.html": "video.jpg",
  "website-design-and-development.html": "website.jpg",
  "mobile-application-development.html": "mobile.jpg",
  "digital-media-planning.html": "media.jpg",
  "marketing-automation.html": "automation.jpg",
  "lead-generation.html": "topic-growth.jpg",
  "devops-services.html": "topic-code.jpg",
  "online-reputation-management.html": "topic-brand.jpg",
  "sentiment-analysis.html": "topic-engagement.jpg",
};

const imgTag = (file) =>
  `<img class="svc-related-media" src="../assets/services/${file}" alt="" width="720" height="420" loading="lazy">\n            `;

let updated = 0;

for (const file of fs.readdirSync(root).filter((f) => f.endsWith(".html"))) {
  const fp = path.join(root, file);
  let html = fs.readFileSync(fp, "utf8");
  if (!html.includes('class="svc-related"')) continue;

  const next = html.replace(
    /<div class="svc-related">([\s\S]*?)<\/div>\s*<\/div>\s*<\/section>/i,
    (block, inner) => {
      const cards = inner.replace(
        /<a href="([^"]+)">\s*(?:<img class="svc-related-media"[^>]*>\s*)?/g,
        (m, href) => {
          const base = href.split("/").pop();
          const img = byHref[base] || "topic-meeting.jpg";
          return `<a href="${href}">\n            ${imgTag(img)}`;
        }
      );
      return block.replace(inner, cards);
    }
  );

  if (next !== html) {
    fs.writeFileSync(fp, next);
    updated++;
    console.log("fixed", file);
  }
}

console.log("Done.", updated);
