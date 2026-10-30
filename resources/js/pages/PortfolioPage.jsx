import React from 'react';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { portfolioData, caseStudiesData } from '../data/siteData';

export default function PortfolioPage({ onOpenLeadModal }) {
  return (
    <>
      <SeoMeta
        title="Portfolio & Case Studies | SMAC Digital"
        description="Explore selected work by SMAC Digital across B2B wholesale, healthcare, luxury marble, and direct-to-consumer ecommerce."
        canonical="https://www.smacdigital.com/portfolios"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="portfolio-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Portfolio</p>
            <h1 id="portfolio-hero-title">
              <span>Selected</span><br />
              <em>client work.</em>
            </h1>
            <p className="lede">
              Partners in growth — browse brands below to see the brief, the work, and what clients said publicly.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Start a project
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* PROJECTS LIST */}
        <section className="page-section" id="cases">
          <div className="wrap">
            <div className="page-portfolio-grid">
              {portfolioData.map((project) => (
                <article key={project.id} className="page-project" id={project.id}>
                  <a
                    className="page-project-media"
                    href={project.link}
                    target="_blank"
                    rel="noopener noreferrer"
                  >
                    <img
                      src={project.image}
                      alt={project.title}
                      width="800"
                      height="560"
                      loading="lazy"
                    />
                  </a>
                  <div className="page-project-body">
                    <p className="page-project-tag">{project.tag}</p>
                    <h2>{project.title}</h2>
                    <div className="page-project-meta">
                      <div>
                        <h3>Challenge</h3>
                        <p>{project.challenge}</p>
                      </div>
                      <div>
                        <h3>What we did</h3>
                        <p>{project.did}</p>
                      </div>
                      <div>
                        <h3>Outcome</h3>
                        <p>{project.outcome}</p>
                      </div>
                    </div>
                    <a
                      className="btn btn-primary"
                      href={project.link}
                      target="_blank"
                      rel="noopener noreferrer"
                    >
                      View project ↗
                    </a>
                  </div>
                </article>
              ))}
            </div>
          </div>
        </section>

        {/* DETAILED CASE STUDIES */}
        <section className="page-section page-section-tint">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Case Studies</p>
              <h2>Proven Impact &amp; Measurement</h2>
              <p className="section-intro">How we turn digital strategy into measurable pipeline for our partners.</p>
            </header>

            <div className="page-card-grid">
              {caseStudiesData.map((cs) => (
                <article key={cs.id} className="page-card">
                  <span className="about-step">{cs.client}</span>
                  <h3>{cs.title}</h3>
                  <p>{cs.summary}</p>
                  <div style={{ display: 'flex', gap: '1.5rem', marginTop: '1.5rem', borderTop: '1px solid rgba(12, 41, 87, 0.12)', paddingTop: '1rem' }}>
                    {cs.metrics.map((m, mIdx) => (
                      <div key={mIdx}>
                        <strong style={{ display: 'block', fontSize: '1.4rem', color: 'var(--navy)' }}>{m.value}</strong>
                        <span style={{ fontSize: '0.85rem', color: 'var(--muted)' }}>{m.label}</span>
                      </div>
                    ))}
                  </div>
                </article>
              ))}
            </div>
          </div>
        </section>

        {/* CTA */}
        <CtaBanner
          title="Have a challenge for our team?"
          subtitle="Let’s review the brief."
          text="We analyze your category, competitive dynamics, and conversion opportunities before proposing a scope."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
