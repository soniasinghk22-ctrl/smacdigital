import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.join(__dirname, "..");
const servicesDir = path.join(root, "services");

const pool = [
  "topic-strategy.jpg",
  "topic-planning.jpg",
  "topic-engagement.jpg",
  "topic-analytics.jpg",
  "topic-metrics.jpg",
  "topic-team.jpg",
  "topic-laptop.jpg",
  "topic-meeting.jpg",
  "topic-content.jpg",
  "topic-mobile.jpg",
  "topic-video.jpg",
  "topic-dashboard.jpg",
  "topic-brand.jpg",
  "topic-code.jpg",
  "topic-growth.jpg",
  "topic-network.jpg",
  "topic-office.jpg",
];

const pageDefaults = {
  "website-design-and-development.html": [
    "topic-laptop.jpg",
    "topic-meeting.jpg",
    "topic-code.jpg",
    "topic-brand.jpg",
  ],
  "content-marketing.html": [
    "topic-content.jpg",
    "topic-strategy.jpg",
    "topic-planning.jpg",
    "topic-team.jpg",
  ],
  "video-marketing.html": [
    "topic-video.jpg",
    "topic-brand.jpg",
    "topic-engagement.jpg",
    "topic-analytics.jpg",
    "topic-content.jpg",
    "topic-growth.jpg",
    "topic-meeting.jpg",
  ],
  "mobile-application-development.html": [
    "topic-mobile.jpg",
    "topic-laptop.jpg",
    "topic-code.jpg",
    "topic-team.jpg",
    "topic-planning.jpg",
    "topic-dashboard.jpg",
    "topic-growth.jpg",
    "topic-office.jpg",
  ],
  "devops-services.html": [
    "topic-code.jpg",
    "topic-laptop.jpg",
    "topic-dashboard.jpg",
    "topic-network.jpg",
    "topic-team.jpg",
    "topic-office.jpg",
  ],
  "digital-media-planning.html": [
    "topic-planning.jpg",
    "topic-meeting.jpg",
    "topic-analytics.jpg",
    "topic-brand.jpg",
  ],
  "inbound-marketing.html": ["topic-growth.jpg", "topic-content.jpg"],
  "influencer-marketing.html": [
    "topic-network.jpg",
    "topic-brand.jpg",
    "topic-engagement.jpg",
    "topic-meeting.jpg",
    "topic-content.jpg",
    "topic-analytics.jpg",
    "topic-growth.jpg",
    "topic-team.jpg",
  ],
  "lead-generation.html": [
    "topic-growth.jpg",
    "topic-dashboard.jpg",
    "topic-meeting.jpg",
    "topic-analytics.jpg",
    "topic-strategy.jpg",
  ],
  "marketing-automation.html": [
    "topic-dashboard.jpg",
    "topic-laptop.jpg",
    "topic-growth.jpg",
  ],
  "online-reputation-management.html": [
    "topic-brand.jpg",
    "topic-network.jpg",
    "topic-engagement.jpg",
    "topic-analytics.jpg",
    "topic-meeting.jpg",
    "topic-content.jpg",
    "topic-metrics.jpg",
    "topic-team.jpg",
    "topic-office.jpg",
    "topic-strategy.jpg",
  ],
  "sentiment-analysis.html": [
    "topic-analytics.jpg",
    "topic-dashboard.jpg",
    "topic-engagement.jpg",
    "topic-metrics.jpg",
    "topic-team.jpg",
  ],
  "social-media-analytics.html": ["topic-analytics.jpg", "topic-dashboard.jpg"],
};

const mediaBlock = (img) =>
  `<div class="svc-long-panel svc-long-panel--media" aria-hidden="true">
          <img src="../assets/services/${img}" alt="" width="1200" height="800" loading="lazy">
        </div>`;

const anyPanelRe =
  /<div class="svc-long-panel(?:\s+svc-long-panel--media)?"[^>]*aria-hidden="true">[\s\S]*?<\/div>/g;

let total = 0;
for (const file of fs.readdirSync(servicesDir).filter((f) => f.endsWith(".html"))) {
  if (file === "social-media-marketing.html") continue;
  if (file === "search-engine-optimization.html") continue;
  const fp = path.join(servicesDir, file);
  let html = fs.readFileSync(fp, "utf8");
  const list = pageDefaults[file] || pool;
  let i = 0;
  const next = html.replace(anyPanelRe, () => {
    const img = list[i % list.length];
    i++;
    total++;
    return mediaBlock(img);
  });
  if (next !== html) {
    fs.writeFileSync(fp, next);
    console.log(`${file}: ${i} panels`);
  }
}
console.log("total", total);
