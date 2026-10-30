import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { api } from '../services/api';

export default function BlogDetailPage({ onOpenLeadModal }) {
  const { slug } = useParams();
  const [blog, setBlog] = useState(null);
  const [related, setRelated] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function loadBlog() {
      setLoading(true);
      window.scrollTo(0, 0);
      try {
        const [current, all] = await Promise.all([
          api.getBlogBySlug(slug),
          api.getBlogs()
        ]);
        setBlog(current);
        setRelated(all.filter(b => b.slug !== slug).slice(0, 3));
      } finally {
        setLoading(false);
      }
    }
    loadBlog();
  }, [slug]);

  if (loading) {
    return (
      <div className="wrap" style={{ padding: '8rem 0', textAlign: 'center' }}>
        <p>Loading article…</p>
      </div>
    );
  }

  if (!blog) {
    return (
      <div className="wrap" style={{ padding: '8rem 0', textAlign: 'center' }}>
        <h2>Article Not Found</h2>
        <p>We could not find the article you were looking for.</p>
        <Link className="btn btn-primary" to="/blog">
          Back to Blog
        </Link>
      </div>
    );
  }

  return (
    <>
      <SeoMeta
        title={`${blog.title} | SMAC Digital Insights`}
        description={blog.excerpt || `Read ${blog.title} on the SMAC Digital blog.`}
        canonical={`https://www.smacdigital.com/blogs/${blog.slug}`}
        ogImage={blog.image}
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero blog-detail-hero" aria-labelledby="post-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">{blog.tag || 'Insights'}</p>
            <h1 id="post-title">{blog.title}</h1>
            <p className="lede blog-detail-meta">
              <time dateTime={blog.date}>{blog.dateLabel}</time>
              <span aria-hidden="true"> &middot; </span>
              <span>By SMAC Digital</span>
            </p>
            <div className="hero-actions">
              <Link className="btn btn-white" to="/blog">
                All posts
              </Link>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* ARTICLE CONTENT */}
        <article className="page-section blog-detail">
          <div className="wrap blog-detail-inner">
            {blog.image && (
              <figure className="blog-detail-cover">
                <img src={blog.image} alt={blog.title} width="1200" height="720" loading="eager" />
              </figure>
            )}

            <div
              className="blog-detail-body"
              dangerouslySetInnerHTML={{ __html: blog.bodyHtml || blog.content || `<p>${blog.excerpt}</p>` }}
            />

            <div className="blog-detail-foot" style={{ marginTop: '3rem', display: 'flex', gap: '1rem', flexWrap: 'wrap' }}>
              <Link className="btn btn-primary" to="/blog">
                ← Back to blog
              </Link>
              <button type="button" className="btn btn-navy" onClick={onOpenLeadModal}>
                Talk to our team
              </button>
            </div>
          </div>
        </article>

        {/* RELATED ARTICLES */}
        {related.length > 0 && (
          <section className="page-section page-section-tint">
            <div className="wrap">
              <header className="section-head">
                <p className="eyebrow">Keep Reading</p>
                <h2>Related Articles</h2>
              </header>
              <div className="page-blog-grid">
                {related.map((r) => (
                  <Link key={r.slug} className="page-blog-card" to={`/blogs/${r.slug}`}>
                    <span className="page-blog-card-media">
                      <img src={r.image} alt={r.title} width="640" height="400" loading="lazy" />
                    </span>
                    <span className="page-blog-card-body">
                      <span className="page-blog-card-meta">
                        <em>{r.tag}</em>
                        <time dateTime={r.date}>{r.dateLabel}</time>
                      </span>
                      <strong>{r.title}</strong>
                      <span className="page-blog-card-excerpt">{r.excerpt}</span>
                      <span className="page-blog-card-go">Read article →</span>
                    </span>
                  </Link>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* CTA BANNER */}
        <CtaBanner
          title="Ready to put this into practice?"
          subtitle="Let’s talk growth."
          text="SMAC Digital helps brands turn strategy into pipeline — SEO, social, content, and performance under one roof."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
