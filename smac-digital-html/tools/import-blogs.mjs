import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";
import https from "https";
import http from "http";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");
const blogsDir = path.join(root, "blogs");
const assetsDir = path.join(root, "assets", "blog");
const blogHtmlPath = path.join(root, "blog.html");

fs.mkdirSync(blogsDir, { recursive: true });
fs.mkdirSync(assetsDir, { recursive: true });

const posts = [
  {
    slug: "from-wholesaler-to-d2c-shopify",
    source: "from-wholesaler-to-d2c-how-home-decor-handicraft-manufacturers-can-double-margins-and-build-long-term-brand-value-with-shopify",
    date: "2026-10-16",
    dateLabel: "16 Oct 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/934673269_16_10_2026_12_16_41.png",
    imgLocal: "d2c-shopify.png",
    tag: "Ecommerce",
  },
  {
    slug: "mobile-app-development-company-jaipur",
    source: "how-to-choose-the-best-mobile-app-development-company-in-jaipur-for-your-business-smac-digital",
    date: "2026-10-10",
    dateLabel: "10 Oct 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/644024280_10_10_2026_01_01_47.jpg",
    imgLocal: "mobile-app-jaipur.jpg",
    tag: "Mobile apps",
  },
  {
    slug: "lead-generation-agency-high-quality-leads",
    source: "lead-generation-agency-how-smac-digital-helps-businesses-generate-high-quality-leads",
    date: "2026-09-26",
    dateLabel: "26 Sep 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/13806951_10_10_2026_01_03_09.jpg",
    imgLocal: "lead-generation.jpg",
    tag: "Lead generation",
  },
  {
    slug: "social-media-marketing-agency-jaipur",
    source: "social-media-marketing-agency-in-jaipur-why-businesses-choose-smac-digital",
    date: "2026-09-20",
    dateLabel: "20 Sep 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/204027984_10_10_2026_01_04_19.jpg",
    imgLocal: "smm-jaipur.jpg",
    tag: "Social media",
  },
  {
    slug: "optimize-website-content-for-ai-search",
    source: "how-to-optimize-website-content-for-ai-search-smac-digitals-step-by-step-guide",
    date: "2026-09-09",
    dateLabel: "09 Sep 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/16881636_09_09_2026_11_00_10.png",
    imgLocal: "ai-search-content.png",
    tag: "AI search",
  },
  {
    slug: "lead-generation-and-performance-marketing",
    source: "how-lead-generation-and-performance-marketing-work-together-to-drive-growth-smac-digital",
    date: "2026-09-09",
    dateLabel: "09 Sep 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/66003129_09_09_2026_12_35_30.jpeg",
    imgLocal: "performance-marketing.jpeg",
    tag: "Performance",
  },
  {
    slug: "social-media-agency-followers-to-customers",
    source: "how-a-social-media-marketing-agency-can-turn-followers-into-customers-smac-digital",
    date: "2026-08-19",
    dateLabel: "19 Aug 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/292964206_19_08_2026_03_48_32.png",
    imgLocal: "followers-to-customers.png",
    tag: "Social media",
  },
  {
    slug: "rank-website-on-google-2026-jaipur",
    source: "how-to-rank-your-business-website-on-google-in-2026-with-best-digital-marketing-company-in-jaipur",
    date: "2026-08-10",
    dateLabel: "10 Aug 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/739985800_10_08_2026_05_25_29.png",
    imgLocal: "rank-google-2026.png",
    tag: "SEO",
  },
  {
    slug: "latest-google-update-2026-seo-guide",
    source: "latest-google-update-2026-complete-seo-guide-smac-digital",
    date: "2026-07-31",
    dateLabel: "31 Jul 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/828033506_31_07_2026_03_23_08.png",
    imgLocal: "google-update-2026.png",
    tag: "SEO",
  },
  {
    slug: "how-local-seo-works",
    source: "how-local-seo-works-google-maps-reviews-and-near-me-searches-explained",
    date: "2026-03-24",
    dateLabel: "24 Mar 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/997245702_24_03_2026_03_40_22.webp",
    imgLocal: "local-seo.webp",
    tag: "Local SEO",
  },
  {
    slug: "content-refresh-strategy-2026",
    source: "content-refresh-strategy-2026-updating-old-blogs-for-new-algorithms-and-ai-search",
    date: "2026-01-08",
    dateLabel: "08 Jan 2026",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/375285764_08_01_2026_05_38_05.png",
    imgLocal: "content-refresh-2026.png",
    tag: "Content",
  },
  {
    slug: "seo-content-update-2024",
    source: "seo-content-update-2024",
    date: "2024-03-27",
    dateLabel: "27 Mar 2024",
    imgRemote: "https://www.smacdigital.com/public/uploads/product/194459264_27_03_2024_03_37_57.jpg",
    imgLocal: "seo-content-2024.jpg",
    tag: "SEO",
  },
];

function fetchText(url) {
  return new Promise((resolve, reject) => {
    const lib = url.startsWith("https") ? https : http;
    lib
      .get(url, { headers: { "User-Agent": "SMAC-Blog-Import/1.0" } }, (res) => {
        if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
          fetchText(res.headers.location).then(resolve, reject);
          return;
        }
        const chunks = [];
        res.on("data", (c) => chunks.push(c));
        res.on("end", () => resolve(Buffer.concat(chunks).toString("utf8")));
      })
      .on("error", reject);
  });
}

function downloadFile(url, dest) {
  return new Promise((resolve, reject) => {
    if (fs.existsSync(dest) && fs.statSync(dest).size > 1000) {
      resolve(dest);
      return;
    }
    const lib = url.startsWith("https") ? https : http;
    const file = fs.createWriteStream(dest);
    lib
      .get(url, { headers: { "User-Agent": "SMAC-Blog-Import/1.0" } }, (res) => {
        if (res.statusCode >= 300 && res.statusCode < 400 && res.headers.location) {
          file.close();
          fs.unlinkSync(dest);
          downloadFile(res.headers.location, dest).then(resolve, reject);
          return;
        }
        res.pipe(file);
        file.on("finish", () => file.close(() => resolve(dest)));
      })
      .on("error", (err) => {
        try { fs.unlinkSync(dest); } catch {}
        reject(err);
      });
  });
}

function decodeEntities(s) {
  return s
    .replace(/&amp;/g, "&")
    .replace(/&lt;/g, "<")
    .replace(/&gt;/g, ">")
    .replace(/&quot;/g, '"')
    .replace(/&#39;/g, "'")
    .replace(/&nbsp;/g, " ");
}

function stripTags(html) {
  return decodeEntities(html.replace(/<[^>]+>/g, " ").replace(/\s+/g, " ").trim());
}

function cleanBody(html) {
  let body = html;
  // drop cover video-box (we show our own cover)
  body = body.replace(/<div class="video-box">[\s\S]*?<\/div>\s*<\/div>/i, "");
  // unwrap span soup
  for (let i = 0; i < 12; i++) {
    body = body.replace(/<\/?span\b[^>]*>/gi, "");
  }
  body = body.replace(/\sstyle="[^"]*"/gi, "");
  body = body.replace(/\sdir="[^"]*"/gi, "");
  body = body.replace(/<p>\s*<\/p>/gi, "");
  body = body.replace(/https:\/\/www\.smacdigital\.com\/services\/([a-z0-9-]+)/gi, (_, s) => {
    const map = {
      "content-marketing-services": "../services/content-marketing.html",
      "website-design-and-development": "../services/website-design-and-development.html",
      "social-media-marketing": "../services/social-media-marketing.html",
      "search-engine-optimization": "../services/search-engine-optimization.html",
      "lead-generation": "../services/lead-generation.html",
      "inbound-marketing": "../services/inbound-marketing.html",
      "marketing-automation": "../services/marketing-automation.html",
      "mobile-application-development": "../services/mobile-application-development.html",
    };
    return map[s] || `../services/${s}.html`;
  });
  body = body.replace(/https:\/\/www\.smacdigital\.com\/blogs\/([a-z0-9-]+)/gi, (_, slug) => {
    const hit = posts.find((p) => p.source === slug);
    return hit ? `${hit.slug}.html` : `https://www.smacdigital.com/blogs/${slug}`;
  });
  // keep upload/image URLs absolute; only rewrite homepage links in anchors
  body = body.replace(/href="https:\/\/www\.smacdigital\.com\/?"/gi, 'href="../index.html"');
  body = body.replace(/<h([1-6])[^>]*>/gi, "<h$1>");
  body = body.replace(/<(ul|ol|li)[^>]*>/gi, "<$1>");
  // drop leftover empty wrappers
  body = body.replace(/<div class="text">/gi, "");
  body = body.replace(/<\/div>\s*$/g, "");
  return body.trim();
}

function extractPost(html) {
  const titleMatch = html.match(/<div class="blog-detail">[\s\S]*?<h2>([\s\S]*?)<\/h2>/i)
    || html.match(/<h1>([\s\S]*?)<\/h1>/i);
  const title = titleMatch ? stripTags(titleMatch[1]) : "Blog";
  const dateMatch = html.match(/<div class="date"><strong>(\d+)<\/strong>\s*([A-Za-z]+)<\/div>/i);

  const lowerIdx = html.search(/<div class="lower-content">/i);
  let endIdx = html.search(/class="[^"]*comments-form|class="[^"]*comment-form/i);
  if (endIdx < 0) endIdx = html.search(/<!--\s*Comments Form\s*-->/i);
  if (endIdx < 0) endIdx = html.search(/class="sidebar-side/i);
  if (endIdx < 0) endIdx = html.length;

  let body = "";
  if (lowerIdx >= 0 && endIdx > lowerIdx) {
    body = html.slice(lowerIdx, endIdx);
    const textOpen = body.search(/<div class="text">/i);
    if (textOpen >= 0) body = body.slice(textOpen + '<div class="text">'.length);
  }

  body = cleanBody(body);
  const plain = stripTags(body).replace(/^By:\s*SMAC Digital\s*/i, "");
  let excerpt = plain.slice(0, 180).replace(/\s+\S*$/, "");
  if (plain.length > 180) excerpt += "…";
  return {
    title: title.replace(/\s*\|\s*SMAC Digital$/i, "").trim(),
    day: dateMatch ? dateMatch[1] : "",
    month: dateMatch ? dateMatch[2] : "",
    body,
    excerpt,
  };
}

function getShellParts() {
  const src = fs.readFileSync(blogHtmlPath, "utf8");
  // Must not stop at nested <header> inside mega/drop menus
  const headerStart = src.indexOf('<header class="site-header"');
  const mainStart = src.indexOf('<main id="main">');
  if (headerStart < 0 || mainStart < 0) throw new Error("Could not locate site header/main in blog.html");
  let header = src.slice(headerStart, mainStart).trim();
  header = header
    .replace(/href="blog\.html" aria-current="page"/, 'href="../blog.html"')
    .replace(/href="(?!https?:|#|mailto:|tel:)([^"]+)"/g, (m, p) => {
      if (p.startsWith("../")) return m;
      return `href="../${p}"`;
    })
    .replace(/src="assets\//g, 'src="../assets/')
    .replace(/aria-current="page"/g, "");
  header = header.replace(
    /<li><a href="\.\.\/blog\.html">Blog<\/a><\/li>/,
    '<li><a href="../blog.html" aria-current="page">Blog</a></li>'
  );
  const footer = src.match(/<footer class="site-footer"[\s\S]*?<\/footer>/)[0]
    .replace(/href="(?!https?:|#|mailto:|tel:)([^"]+)"/g, (m, p) => {
      if (p.startsWith("../")) return m;
      return `href="../${p}"`;
    })
    .replace(/src="assets\//g, 'src="../assets/')
    .replace(/action="contact\.html"/, 'action="../contact.html"');
  const whatsapp = src.match(/<a class="whatsapp"[\s\S]*?<\/a>\s*<script/)[0].replace(/<script$/, "");
  return { header, footer, whatsapp };
}

function buildDetailPage(post, data, shell) {
  const desc = data.excerpt.replace(/"/g, "&quot;");
  const title = data.title.replace(/"/g, "&quot;");
  return `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${title} | SMAC Digital</title>
  <meta name="description" content="${desc}">
  <link rel="icon" href="../assets/brand/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Inter:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
</head>
<body class="page-body" id="top">
  <a class="skip-link" href="#main">Skip to content</a>
  ${shell.header}
  <main id="main">
    <section class="hero inner-hero blog-detail-hero" aria-labelledby="post-title">
      <div class="hero-stage" aria-hidden="true"><div class="hero-grid"></div></div>
      <div class="wrap hero-copy">
        <p class="pill">${post.tag}</p>
        <h1 id="post-title">${data.title}</h1>
        <p class="lede blog-detail-meta">
          <time datetime="${post.date}">${post.dateLabel}</time>
          <span aria-hidden="true">&middot;</span>
          <span>By SMAC Digital</span>
        </p>
        <div class="hero-actions">
          <a class="btn btn-white" href="../blog.html">All posts</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="../contact.html">Get a free consultation</a>
        </div>
      </div>
    </section>
    <article class="page-section blog-detail">
      <div class="wrap blog-detail-inner">
        <figure class="blog-detail-cover media-reveal">
          <img src="../assets/blog/${post.imgLocal}" alt="" width="1200" height="720" loading="eager">
        </figure>
        <div class="blog-detail-body">
${data.body}
        </div>
        <div class="blog-detail-foot">
          <a class="btn btn-primary" href="../blog.html">← Back to blog</a>
          <a class="btn btn-navy" href="../contact.html">Talk to our team</a>
        </div>
      </div>
    </article>
    <section class="about-cta about-cta--red" aria-labelledby="post-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="post-cta-title">Ready to put this into practice?<em> Let’s talk growth.</em></h2>
          <p>SMAC Digital helps brands turn strategy into pipeline — SEO, social, content, and performance under one roof.</p>
          <div class="about-cta-actions">
            <a class="btn btn-white" href="../contact.html">Get a free consultation</a>
            <span class="or" aria-hidden="true">or</span>
            <a class="btn btn-black" href="../portfolios.html">See the work</a>
          </div>
        </div>
        <aside class="about-cta-panel about-cta-panel--creative">
          <div class="about-cta-panel-glow" aria-hidden="true"></div>
          <div class="about-cta-panel-top">
            <span class="about-cta-live"><i></i> Available now</span>
            <p class="about-cta-kicker">Prefer a direct call?</p>
          </div>
          <div class="about-cta-phones">
            <a class="about-cta-phone" href="tel:+919582792638"><span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span><span><small>Delhi NCR</small><strong>+91 95827 92638</strong></span></a>
            <a class="about-cta-phone" href="tel:+919829069519"><span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span><span><small>Jaipur</small><strong>+91 98290 69519</strong></span></a>
          </div>
          <a class="about-cta-wa" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer"><span class="about-cta-wa-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg></span><span><strong>WhatsApp the team</strong><small>Usually replies in minutes</small></span></a>
        </aside>
      </div>
    </section>
  </main>
  ${shell.footer}
  ${shell.whatsapp}
  <script src="../script.js"></script>
</body>
</html>
`;
}

function updateListing(results) {
  let html = fs.readFileSync(blogHtmlPath, "utf8");
  const esc = (s) =>
    String(s || "")
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;");

  const cards = results
    .map(
      (p) => `        <a class="page-blog-card" href="blogs/${p.slug}.html">
          <span class="page-blog-card-media">
            <img src="assets/blog/${p.imgLocal}" alt="" width="640" height="400" loading="lazy">
          </span>
          <span class="page-blog-card-body">
            <span class="page-blog-card-meta">
              <em>${esc(p.tag)}</em>
              <time datetime="${p.date}">${esc(p.dateLabel)}</time>
            </span>
            <strong>${esc(p.title)}</strong>
            <span class="page-blog-card-excerpt">${esc(p.excerpt)}</span>
            <span class="page-blog-card-go">Read article →</span>
          </span>
        </a>`
    )
    .join("\n");

  const listingBlock = `<section class="page-section page-section-tint">
      <div class="wrap">
        <header class="page-blog-head">
          <p class="page-eyebrow dark">From the team</p>
          <h2>Latest articles</h2>
          <p>Insights from SMAC Digital on SEO, social, lead generation, apps, and growth — updated from our live blog.</p>
        </header>
        <div class="page-blog-grid">
${cards}
        </div>
      </div>
    </section>`;

  if (/page-blog-grid/.test(html)) {
    html = html.replace(
      /<section class="page-section[^"]*">\s*<div class="wrap">\s*<header class="page-blog-head">[\s\S]*?<div class="page-blog-grid">[\s\S]*?<\/div>\s*<\/div>\s*<\/section>/,
      listingBlock
    );
  } else {
    html = html.replace(
      /<section class="page-section">\s*<div class="wrap page-blog-list">[\s\S]*?<\/div>\s*<\/section>/,
      listingBlock
    );
  }
  fs.writeFileSync(blogHtmlPath, html);
}

const shell = getShellParts();
const results = [];

for (const post of posts) {
  const url = `https://www.smacdigital.com/blogs/${post.source}`;
  process.stdout.write(`Fetching ${post.slug}... `);
  try {
    const html = await fetchText(url);
    const data = extractPost(html);
    // prefer parsed date if available
    if (data.day && data.month) {
      // keep our ISO date; label can stay
    }
    await downloadFile(post.imgRemote, path.join(assetsDir, post.imgLocal));
    const page = buildDetailPage(post, data, shell);
    fs.writeFileSync(path.join(blogsDir, `${post.slug}.html`), page);
    results.push({
      ...post,
      title: data.title,
      excerpt: data.excerpt,
    });
    console.log("ok");
  } catch (err) {
    console.log("FAIL", err.message);
  }
}

updateListing(results);
fs.writeFileSync(path.join(root, "tools", "blogs-manifest.json"), JSON.stringify(results, null, 2));
console.log(`Done. ${results.length} posts → blogs/ + blog.html`);
