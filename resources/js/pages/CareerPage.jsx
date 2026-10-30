import React from 'react';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';

export default function CareerPage({ onOpenLeadModal }) {
  return (
    <>
      <SeoMeta
        title="Careers & Opportunities | SMAC Digital"
        description="Build with a performance-driven team. Open roles in SEO, paid media, web engineering, content, and client strategy across Jaipur, Pune, Kolkata, or remote."
        canonical="https://www.smacdigital.com/career"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="career-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Careers</p>
            <h1 id="career-hero-title">
              <span>Build with a team</span><br />
              <em>that ships growth.</em>
            </h1>
            <p className="lede">
              We're always interested in marketers, designers, and builders who care about performance.
            </p>
            <div className="hero-actions">
              <a className="btn btn-white" href="mailto:rahul@smacdigital.com">
                Email careers
              </a>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* DETAILS */}
        <section className="page-section">
          <div className="wrap page-split">
            <div>
              <h2>Open conversations</h2>
              <p>
                Roles often span SEO, social, content, paid media, web, and product. Send a short note with your focus, portfolio or LinkedIn, and preferred city (Jaipur, Kolkata, Pune, or remote-friendly).
              </p>
              <div className="page-cta-row" style={{ display: 'flex', gap: '1rem', marginTop: '1.5rem', flexWrap: 'wrap' }}>
                <a className="btn btn-primary" href="mailto:rahul@smacdigital.com">
                  rahul@smacdigital.com
                </a>
                <a className="btn btn-navy" href="tel:+919582792638">
                  +91 95827 92638
                </a>
              </div>
            </div>
            <div className="page-card-grid single">
              <article className="page-card">
                <h3>What we look for</h3>
                <p>Clear thinking, craft pride, and comfort measuring what shipped. Agency pace with client empathy.</p>
              </article>
              <article className="page-card">
                <h3>How to apply</h3>
                <p>Email with subject “Career — [your role interest]”. We'll reply when there's a fit.</p>
              </article>
            </div>
          </div>
        </section>

        {/* CTA BANNER */}
        <CtaBanner
          title="Build with ambitious teams."
          subtitle="Grow your craft here."
          text="Join a performance-driven digital agency where strategy, creativity, and ownership matter — explore roles or reach out to our team."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
