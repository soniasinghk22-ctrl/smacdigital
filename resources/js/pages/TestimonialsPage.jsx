import React, { useState, useEffect } from 'react';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { api } from '../services/api';

export default function TestimonialsPage({ onOpenLeadModal }) {
  const [testimonials, setTestimonials] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function loadTestimonials() {
      try {
        const data = await api.getTestimonials();
        setTestimonials(data);
      } finally {
        setLoading(false);
      }
    }
    loadTestimonials();
  }, []);

  return (
    <>
      <SeoMeta
        title="Client Testimonials & Reviews | SMAC Digital"
        description="Read verified client feedback and testimonials from partners who scaled their organic visibility and lead generation with SMAC Digital."
        canonical="https://www.smacdigital.com/testimonials"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="testimonials-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Testimonials</p>
            <h1 id="testimonials-hero-title">
              <span>Words from</span><br />
              <em>our customers.</em>
            </h1>
            <p className="lede">
              These cases are perfectly simple and easy to distinguish — real partners, real outcomes.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Become a partner
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* QUOTE GRID */}
        <section className="page-section">
          <div className="wrap page-quote-grid">
            {testimonials.map((t, idx) => (
              <figure key={t.id || idx} className="page-quote">
                <blockquote>“{t.quote || t.content}”</blockquote>
                <figcaption>
                  <strong>{t.author || t.name}</strong>
                  {t.role && <span style={{ display: 'block', fontSize: '0.85rem', color: 'var(--muted)', marginTop: '4px' }}>{t.role}</span>}
                </figcaption>
              </figure>
            ))}
          </div>
        </section>

        {/* CTA BANNER */}
        <CtaBanner
          title="Trusted by growing brands."
          subtitle="Become the next story."
          text="Hear how teams use SMAC Digital to improve visibility, engagement, and ROI — then start a conversation about your next milestone."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
