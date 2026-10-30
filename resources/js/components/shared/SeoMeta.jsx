import { useEffect } from 'react';

export default function SeoMeta({
  title = "Best Performing Digital Marketing Agency in India | SMAC Digital",
  description = "Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers.",
  keywords = "Best Digital Marketing Agency in India, Social Media Marketing in India, SMAC Digital",
  canonical = "https://www.smacdigital.com",
  ogImage = "/assets/brand/logo-white.png"
}) {
  useEffect(() => {
    document.title = title;

    const setMeta = (name, content, isProperty = false) => {
      const attr = isProperty ? 'property' : 'name';
      let el = document.querySelector(`meta[${attr}="${name}"]`);
      if (!el) {
        el = document.createElement('meta');
        el.setAttribute(attr, name);
        document.head.appendChild(el);
      }
      el.setAttribute('content', content);
    };

    setMeta('description', description);
    setMeta('keywords', keywords);
    setMeta('og:title', title, true);
    setMeta('og:description', description, true);
    setMeta('og:image', ogImage, true);
    setMeta('og:type', 'website', true);

    let canonicalEl = document.querySelector('link[rel="canonical"]');
    if (!canonicalEl) {
      canonicalEl = document.createElement('link');
      canonicalEl.setAttribute('rel', 'canonical');
      document.head.appendChild(canonicalEl);
    }
    canonicalEl.setAttribute('href', canonical);
  }, [title, description, keywords, canonical, ogImage]);

  return null;
}
