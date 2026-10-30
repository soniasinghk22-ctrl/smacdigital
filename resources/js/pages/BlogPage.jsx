import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { api } from '../services/api';

export default function BlogPage({ onOpenLeadModal }) {
  const [blogs, setBlogs] = useState([]);
  const [selectedTag, setSelectedTag] = useState('All');
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function loadBlogs() {
      try {
        const data = await api.getBlogs();
        setBlogs(data);
      } finally {
        setLoading(false);
      }
    }
    loadBlogs();
  }, []);

  const [visibleCount, setVisibleCount] = useState(12);

  const tags = ['All', ...new Set(blogs.map(b => b.tag).filter(Boolean))];

  const filteredBlogs = selectedTag === 'All'
    ? blogs
    : blogs.filter(b => b.tag === selectedTag);

  const displayedBlogs = filteredBlogs.slice(0, visibleCount);

  const handleTagChange = (t) => {
    setSelectedTag(t);
    setVisibleCount(12);
  };

  return (
    <>
      <SeoMeta
        title="Digital Marketing Blog & Knowledge Base | SMAC Digital"
        description="Notes on lead generation, mobile applications, D2C Shopify growth, and organic search optimization from the SMAC Digital team."
        canonical="https://www.smacdigital.com/blog"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="blog-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Blog</p>
            <h1 id="blog-hero-title">
              <span>Exploring trends,</span><br />
              <em>sharing perspectives.</em>
            </h1>
            <p className="lede">
              Notes on lead generation, apps, ecommerce, and growth from the SMAC Digital team.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Ask us anything
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* ARTICLES GRID */}
        <section className="page-section page-section-tint">
          <div className="wrap">
            <header className="page-blog-head" style={{ marginBottom: '2rem' }}>
              <p className="page-eyebrow dark">From the team</p>
              <h2>Latest articles ({filteredBlogs.length})</h2>
              <p>Insights from SMAC Digital on SEO, social, lead generation, apps, and growth.</p>

              {/* Tag filters */}
              <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap', marginTop: '1.25rem' }}>
                {tags.map((t) => (
                  <button
                    key={t}
                    type="button"
                    onClick={() => handleTagChange(t)}
                    style={{
                      background: selectedTag === t ? 'var(--navy)' : 'var(--white)',
                      color: selectedTag === t ? '#fff' : 'var(--navy)',
                      border: '1px solid rgba(12, 41, 87, 0.15)',
                      borderRadius: '20px',
                      padding: '6px 14px',
                      fontSize: '0.85rem',
                      fontWeight: 600,
                      cursor: 'pointer',
                      transition: 'all 0.2s'
                    }}
                  >
                    {t}
                  </button>
                ))}
              </div>
            </header>

            <div className="page-blog-grid">
              {displayedBlogs.map((b) => (
                <Link key={b.slug} className="page-blog-card" to={`/blogs/${b.slug}`}>
                  <span className="page-blog-card-media">
                    <img src={b.image} alt={b.title} width="640" height="400" loading="lazy" />
                  </span>
                  <span className="page-blog-card-body">
                    <span className="page-blog-card-meta">
                      <em>{b.tag}</em>
                      <time dateTime={b.date}>{b.dateLabel}</time>
                    </span>
                    <strong>{b.title}</strong>
                    <span className="page-blog-card-excerpt">{b.excerpt}</span>
                    <span className="page-blog-card-go">Read article →</span>
                  </span>
                </Link>
              ))}
            </div>

            {filteredBlogs.length > visibleCount && (
              <div style={{ textAlign: 'center', marginTop: '3rem' }}>
                <button
                  type="button"
                  className="btn btn-outline"
                  onClick={() => setVisibleCount(prev => prev + 12)}
                  style={{ minWidth: '220px' }}
                >
                  Load More Articles ({filteredBlogs.length - visibleCount} remaining)
                </button>
              </div>
            )}
          </div>
        </section>

        {/* CTA BANNER */}
        <CtaBanner
          title="Stay ahead of digital shifts."
          subtitle="Partner with SMAC Digital."
          text="Subscribe to strategic perspectives or schedule a private consultation for your brand."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
