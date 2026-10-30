const fs = require('fs');
const path = require('path');

const UPLOADS_DIR = path.join(__dirname, '..', 'public', 'uploads', 'blogs');
if (!fs.existsSync(UPLOADS_DIR)) {
  fs.mkdirSync(UPLOADS_DIR, { recursive: true });
}

// Month lookup
const MONTHS = {
  Jan: '01', Feb: '02', Mar: '03', Apr: '04', May: '05', Jun: '06',
  Jul: '07', Aug: '08', Sep: '09', Oct: '10', Nov: '11', Dec: '12'
};

function parseDateToMySql(str) {
  if (!str) return new Date().toISOString().slice(0, 19).replace('T', ' ');
  // Formats like "24 Oct 2026", "24-Oct-2026", "2026-10-24"
  const m = str.match(/(\d{1,2})[\s\-]+([a-zA-Z]{3})[\s\-]+(\d{4})/i);
  if (m) {
    const day = m[1].padStart(2, '0');
    const month = MONTHS[m[2].slice(0, 3)] || '01';
    const year = m[3];
    return `${year}-${month}-${day} 10:00:00`;
  }
  const iso = new Date(str);
  if (!isNaN(iso.getTime())) {
    return iso.toISOString().slice(0, 19).replace('T', ' ');
  }
  return new Date().toISOString().slice(0, 19).replace('T', ' ');
}

function cleanHtmlEntities(str) {
  if (!str) return '';
  return str
    .replace(/&amp;/g, '&')
    .replace(/&quot;/g, '"')
    .replace(/&#039;/g, "'")
    .replace(/&rsquo;/g, "'")
    .replace(/&lsquo;/g, "'")
    .replace(/&ldquo;/g, '"')
    .replace(/&rdquo;/g, '"')
    .replace(/&nbsp;/g, ' ')
    .replace(/&mdash;/g, '—')
    .replace(/&ndash;/g, '–');
}

function assignCategory(title, slug, keywords) {
  const text = `${title} ${slug} ${keywords}`.toLowerCase();
  if (text.includes('shopify') || text.includes('meesho') || text.includes('myntra') || text.includes('d2c') || text.includes('marketplace') || text.includes('ecommerce') || text.includes('e-commerce') || text.includes('cart') || text.includes('rto')) {
    return 'E-Commerce & D2C';
  }
  if (text.includes('seo') || text.includes('rank') || text.includes('organic') || text.includes('google update') || text.includes('algorithm') || text.includes('serp') || text.includes('backlink') || text.includes('keyword')) {
    return 'SEO';
  }
  if (text.includes('social media') || text.includes('instagram') || text.includes('facebook') || text.includes('linkedin') || text.includes('b2b social') || text.includes('influencer')) {
    return 'Social Media Marketing';
  }
  if (text.includes('mobile app') || text.includes('app development') || text.includes('android') || text.includes('ios') || text.includes('react native') || text.includes('flutter')) {
    return 'Mobile App Development';
  }
  if (text.includes('website') || text.includes('web development') || text.includes('web design') || text.includes('wordpress') || text.includes('redesign')) {
    return 'Web Development';
  }
  if (text.includes('lead generation') || text.includes('leads') || text.includes('b2b') || text.includes('prospect')) {
    return 'Lead Generation';
  }
  if (text.includes('content') || text.includes('copywriting') || text.includes('blogging') || text.includes('storytelling')) {
    return 'Content Marketing';
  }
  if (text.includes('google ads') || text.includes('ppc') || text.includes('adwords') || text.includes('paid ads') || text.includes('campaign')) {
    return 'Google Ads & PPC';
  }
  if (text.includes('cro') || text.includes('conversion') || text.includes('funnel') || text.includes('growth')) {
    return 'Performance Marketing';
  }
  return 'Digital Marketing Strategy';
}

async function downloadFile(url, targetPath, retries = 2) {
  for (let attempt = 1; attempt <= retries; attempt++) {
    try {
      const res = await fetch(url, {
        headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' }
      });
      if (!res.ok) {
        throw new Error(`HTTP ${res.status}`);
      }
      const buffer = Buffer.from(await res.arrayBuffer());
      fs.writeFileSync(targetPath, buffer);
      return true;
    } catch (err) {
      if (attempt === retries) throw err;
      await new Promise(r => setTimeout(r, 1000));
    }
  }
  return false;
}

async function processAllBlogs() {
  const cards = JSON.parse(fs.readFileSync(path.join(__dirname, 'listing_cards.json'), 'utf8'));
  console.log(`Starting migration for ${cards.length} blogs...`);

  const results = [];
  const errors = [];
  let downloadedImagesCount = 0;

  for (let i = 0; i < cards.length; i++) {
    const card = cards[i];
    const slug = card.url.split('/blogs/')[1];
    console.log(`[${i + 1}/${cards.length}] Fetching: ${slug}`);

    let html = '';
    try {
      const res = await fetch(card.url, {
        headers: { 'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' }
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      html = await res.text();
    } catch (err) {
      errors.push({
        type: 'ARTICLE_FETCH_FAILED',
        url: card.url,
        slug,
        error: err.message
      });
      console.error(`  ERROR fetching article ${slug}: ${err.message}`);
      continue;
    }

    // 1. Title
    const titleMatch = html.match(/<title>([^<]+)<\/title>/i);
    const metaTitle = titleMatch ? cleanHtmlEntities(titleMatch[1].trim()) : cleanHtmlEntities(card.cardTitle);

    const h1Match = html.match(/<div class="inner-box">\s*<h1>(.*?)<\/h1>/is) || html.match(/<h2[^>]*>(.*?)<\/h2>/is);
    let title = h1Match ? cleanHtmlEntities(h1Match[1].replace(/<[^>]+>/g, '').trim()) : cleanHtmlEntities(card.cardTitle);
    if (!title) title = cleanHtmlEntities(card.cardTitle);

    // 2. SEO
    const descMatch = html.match(/<meta\s+name="description"\s+content="([^"]*)"/i);
    const metaDesc = descMatch ? cleanHtmlEntities(descMatch[1].trim()) : '';

    const kwMatch = html.match(/<meta\s+name="keywords"\s+content="([^"]*)"/i);
    const metaKw = kwMatch ? cleanHtmlEntities(kwMatch[1].trim()) : '';

    // 3. Schema Markup
    const schemaMatch = html.match(/<script type="application\/ld\+json">(.*?)<\/script>/is);
    const schemaMarkup = schemaMatch ? schemaMatch[0].trim() : null;

    // 4. Date & Author
    const authorMatch = html.match(/<div class="author-name">By:\s*([^<]+)<\/div>/i);
    const author = authorMatch ? cleanHtmlEntities(authorMatch[1].trim()) : 'SMAC Digital';

    const mysqlPublishedAt = parseDateToMySql(card.cardDate);

    // 5. Category
    const category = assignCategory(title, slug, metaKw);

    // 6. Summary / Excerpt
    let summary = cleanHtmlEntities(card.cardExcerpt);
    if (!summary || summary.length < 20) {
      summary = metaDesc || title;
    }

    // 7. Featured Image
    const featImgMatch = html.match(/<div class="video-box">\s*<div class="image">\s*<img[^>]+src="([^">]+)"/i);
    const rawFeaturedImg = featImgMatch ? featImgMatch[1] : card.cardImage;
    let localImagePath = null;

    if (rawFeaturedImg) {
      try {
        const featUrl = rawFeaturedImg.startsWith('http') ? rawFeaturedImg : `https://www.smacdigital.com${rawFeaturedImg.startsWith('/') ? '' : '/'}${rawFeaturedImg}`;
        const ext = path.extname(new URL(featUrl).pathname) || '.jpg';
        const filename = `${slug}-cover${ext}`;
        const localPath = path.join(UPLOADS_DIR, filename);

        if (!fs.existsSync(localPath)) {
          await downloadFile(featUrl, localPath);
          downloadedImagesCount++;
        }
        localImagePath = `uploads/blogs/${filename}`;
      } catch (err) {
        errors.push({
          type: 'FEATURED_IMAGE_FAILED',
          url: card.url,
          imageUrl: rawFeaturedImg,
          error: err.message
        });
        console.warn(`  Warning: Could not download featured image for ${slug}: ${err.message}`);
        localImagePath = 'assets/blog/lead-generation.jpg'; // fallback
      }
    } else {
      localImagePath = 'assets/blog/lead-generation.jpg';
    }

    // 8. Body Content
    let contentHtml = '';
    const textStart = html.indexOf('<div class="lower-content">');
    if (textStart !== -1) {
      const sub = html.substring(textStart);
      const textSubStart = sub.indexOf('<div class="text">');
      if (textSubStart !== -1) {
        const textSub = sub.substring(textSubStart + '<div class="text">'.length);
        const endMarkers = [
          '<!-- Comments Form -->',
          '<div class="comments-form">',
          '<div class="sidebar-side',
          '</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>'
        ];
        let endIdx = -1;
        for (const marker of endMarkers) {
          const idx = textSub.indexOf(marker);
          if (idx !== -1 && (endIdx === -1 || idx < endIdx)) {
            endIdx = idx;
          }
        }
        if (endIdx !== -1) {
          contentHtml = textSub.substring(0, endIdx);
          // strip the video-box if it exists inside text
          contentHtml = contentHtml.replace(/<div class="video-box">[\s\S]*?<\/div>\s*<\/div>/i, '').trim();
          // strip trailing unclosed tags
          contentHtml = contentHtml.replace(/<\/div>\s*<\/div>\s*$/i, '').trim();
        }
      }
    }

    if (!contentHtml || contentHtml.length < 50) {
      // Fallback: entire text container
      contentHtml = `<p>${summary}</p>`;
      errors.push({
        type: 'CONTENT_EMPTY_OR_SHORT',
        url: card.url,
        slug,
        length: contentHtml.length
      });
    }

    // 9. Download inline images inside contentHtml and rewrite src
    const imgRegex = /<img[^>]+src="([^">]+)"/gi;
    let imgMatch;
    const inlineImageUrls = [];
    while ((imgMatch = imgRegex.exec(contentHtml)) !== null) {
      inlineImageUrls.push(imgMatch[1]);
    }

    for (let j = 0; j < inlineImageUrls.length; j++) {
      const originalSrc = inlineImageUrls[j];
      try {
        let fullImgUrl = originalSrc;
        if (!fullImgUrl.startsWith('http')) {
          fullImgUrl = `https://www.smacdigital.com${fullImgUrl.startsWith('/') ? '' : '/'}${fullImgUrl}`;
        }
        const ext = path.extname(new URL(fullImgUrl).pathname) || '.jpg';
        const inlineFilename = `${slug}-inline-${j + 1}${ext}`;
        const inlineLocalPath = path.join(UPLOADS_DIR, inlineFilename);

        if (!fs.existsSync(inlineLocalPath)) {
          await downloadFile(fullImgUrl, inlineLocalPath);
          downloadedImagesCount++;
        }
        // Rewrite in contentHtml
        const replacementSrc = `/uploads/blogs/${inlineFilename}`;
        contentHtml = contentHtml.split(originalSrc).join(replacementSrc);
      } catch (err) {
        errors.push({
          type: 'INLINE_IMAGE_FAILED',
          url: card.url,
          imageUrl: originalSrc,
          error: err.message
        });
        console.warn(`  Warning: Could not download inline image ${originalSrc}: ${err.message}`);
      }
    }

    results.push({
      id: i + 1,
      title,
      slug,
      category,
      summary,
      content: contentHtml,
      image_path: localImagePath,
      author,
      published_at: mysqlPublishedAt,
      dateLabel: card.cardDate,
      metatitle: metaTitle,
      metadescription: metaDesc,
      metakeywords: metaKw,
      schema_markup: schemaMarkup,
      source_url: card.url
    });
  }

  console.log(`\n========================================`);
  console.log(`Scraping Complete!`);
  console.log(`Total blogs processed: ${results.length} of ${cards.length}`);
  console.log(`Total images downloaded: ${downloadedImagesCount}`);
  console.log(`Total warnings/errors: ${errors.length}`);
  console.log(`========================================\n`);

  fs.writeFileSync(path.join(__dirname, 'scraped_blogs.json'), JSON.stringify(results, null, 2));
  fs.writeFileSync(path.join(__dirname, 'migration_errors.json'), JSON.stringify(errors, null, 2));
}

processAllBlogs().catch(console.error);
