const fs = require('fs');

async function getAllListingCards() {
  const allCards = [];
  for (let p = 1; p <= 10; p++) {
    const res = await fetch(`https://www.smacdigital.com/blogs?page=${p}`, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const text = await res.text();
    if (!text || text.length === 0) break;

    const blocks = text.split(/<div class="news-block\s+/i).slice(1);
    console.log(`Page ${p} has ${blocks.length} blocks.`);
    if (blocks.length === 0) break;

    for (const b of blocks) {
      // Extract URL
      const urlMatch = b.match(/href="(https:\/\/www\.smacdigital\.com\/blogs\/[^"]+)"/i);
      const url = urlMatch ? urlMatch[1] : null;

      // Extract image
      const imgMatch = b.match(/<img[^>]+src="([^">]+)"/i);
      const cardImage = imgMatch ? imgMatch[1] : null;

      // Extract title
      const titleMatch = b.match(/<h3><a[^>]*>(.*?)<\/a><\/h3>/is);
      const cardTitle = titleMatch ? titleMatch[1].replace(/<[^>]+>/g, '').trim() : '';

      // Extract excerpt
      const excerptMatch = b.match(/<div class="post-meta">\s*<p>(.*?)<\/p>/is);
      const cardExcerpt = excerptMatch ? excerptMatch[1].replace(/<[^>]+>/g, '').trim() : '';

      // Extract date
      const dateMatch = b.match(/<div class="post-date">(.*?)<\/div>/is);
      const cardDate = dateMatch ? dateMatch[1].replace(/<[^>]+>/g, '').trim() : '';

      if (url) {
        allCards.push({ url, cardTitle, cardImage, cardExcerpt, cardDate });
      }
    }
  }
  console.log(`Total extracted cards: ${allCards.length}`);
  fs.writeFileSync('scripts/listing_cards.json', JSON.stringify(allCards, null, 2));
}

getAllListingCards().catch(console.error);
