const fs = require('fs');
const path = require('path');

const manifest = JSON.parse(fs.readFileSync('smac-digital-html/tools/blogs-manifest.json', 'utf8'));
const enrichedBlogs = manifest.map(b => {
  const filePath = path.join('smac-digital-html', 'blogs', b.slug + '.html');
  let bodyHtml = '';
  if (fs.existsSync(filePath)) {
    const raw = fs.readFileSync(filePath, 'utf8');
    const startIdx = raw.indexOf('<div class="blog-detail-body">');
    if (startIdx !== -1) {
      const contentPart = raw.slice(startIdx + '<div class="blog-detail-body">'.length);
      const endIdx = contentPart.indexOf('<div class="blog-detail-foot">');
      if (endIdx !== -1) {
        bodyHtml = contentPart.slice(0, endIdx).trim();
      } else {
        const articleEnd = contentPart.indexOf('</article>');
        bodyHtml = (articleEnd !== -1 ? contentPart.slice(0, articleEnd) : contentPart).trim();
      }
    }
  }
  return {
    ...b,
    image: '/assets/blog/' + b.imgLocal,
    bodyHtml
  };
});

fs.mkdirSync('resources/js/data', { recursive: true });
fs.writeFileSync('resources/js/data/blogsData.json', JSON.stringify(enrichedBlogs, null, 2));
console.log('Enriched blogs count:', enrichedBlogs.length, 'Blogs with content:', enrichedBlogs.filter(b => b.bodyHtml.length > 50).length);
