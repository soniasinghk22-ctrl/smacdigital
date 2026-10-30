async function checkPages() {
  let totalBlogs = 0;
  let allUrls = [];
  for (let p = 1; p <= 30; p++) {
    try {
      const res = await fetch('https://www.smacdigital.com/blogs?page=' + p, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      const text = await res.text();
      const count = (text.match(/class="news-block/g) || []).length;
      console.log(`Page ${p}: length ${text.length}, blog blocks: ${count}`);
      if (text.length === 0 || count === 0) {
        console.log(`Finished pagination at page ${p}`);
        break;
      }
      totalBlogs += count;

      // Extract all blog URLs from this page
      const linkRegex = /href="(https:\/\/www\.smacdigital\.com\/blogs\/[^"]+)"/g;
      let m;
      while ((m = linkRegex.exec(text)) !== null) {
        if (!allUrls.includes(m[1])) {
          allUrls.push(m[1]);
        }
      }
    } catch (err) {
      console.error(`Error on page ${p}:`, err.message);
      break;
    }
  }
  console.log(`Total blogs counted on listing: ${totalBlogs}`);
  console.log(`Total unique blog URLs: ${allUrls.length}`);
  console.log('Sample URLs:');
  console.log(allUrls.slice(0, 5));
}

checkPages();
