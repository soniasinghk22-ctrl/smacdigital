import React from 'react';
import { Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';

export default function EventsPage({ onOpenLeadModal }) {
  return (
    <>
      <SeoMeta
        title="Events & Workshops | SMAC Digital"
        description="Upcoming speaking engagements, digital marketing workshops, and community sessions hosted by SMAC Digital."
        canonical="https://www.smacdigital.com/events"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="events-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Events</p>
            <h1 id="events-hero-title">
              <span>Workshops,</span><br />
              <em>sessions, and community.</em>
            </h1>
            <p className="lede">
              When SMAC hosts or joins industry sessions, details will land here. Meanwhile, ask us about private workshops for your team.
            </p>
            <div className="hero-actions">
              <Link className="btn btn-white" to="/contact">
                Host a session
              </Link>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* EVENTS LIST */}
        <section className="page-section">
          <div className="wrap">
            <article className="page-empty-card" style={{ textAlign: 'center', padding: '4rem 2rem', background: 'var(--mist)', borderRadius: '16px', maxWidth: '640px', margin: '0 auto' }}>
              <h2>No public events listed right now</h2>
              <p style={{ margin: '1rem 0 2rem' }}>
                Check back soon, or contact us to discuss a private digital marketing workshop for your organisation.
              </p>
              <Link className="btn btn-primary" to="/contact">
                Contact SMAC
              </Link>
            </article>
          </div>
        </section>

        {/* CTA BANNER */}
        <CtaBanner
          title="Meet us in the room."
          subtitle="Continue the conversation."
          text="Whether you caught us at an event or want to host one together — let’s connect and explore how SMAC Digital can support your brand."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
