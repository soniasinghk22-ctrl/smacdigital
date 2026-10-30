import React from 'react';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { locationsData, teamData } from '../data/siteData';

export default function AboutPage({ onOpenLeadModal }) {
  return (
    <>
      <SeoMeta
        title="About Us | Best Digital Marketing Agency in India | SMAC Digital"
        description="Learn about SMAC Digital, a pioneer digital marketing company in Jaipur, Pune, and Kolkata driving results through Social, Mobile, Analytics, and Cloud."
        canonical="https://www.smacdigital.com/about-us"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="about-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">About SMAC</p>
            <h1 id="about-hero-title">
              <span>A performance-driven</span><br />
              <em>digital marketing agency.</em>
            </h1>
            <p className="lede">
              SMAC gives you the opportunity to create your niche in the global marketplace through targeted marketing and communication strategies. Our ultimate goal is to make consumers associate your brand with a smile.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Talk to us
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* WHO WE ARE */}
        <section className="about-who" aria-labelledby="who-title">
          <div className="about-who-bg" aria-hidden="true"></div>
          <div className="wrap about-who-grid">
            <div className="about-who-copy">
              <p className="page-eyebrow dark">Who we are</p>
              <h2 id="who-title">Social · Mobile · Analytics · Cloud</h2>
              <p>
                SMAC defines as S-Social, M-Mobile, A-Analytics and C-Cloud — four elements changing the digital world. We adopted this name to become the front face of growth in digital marketing.
              </p>
              <p>
                We commit to performance and aim to over-deliver every time. We adapt to the strengths and weaknesses of each business. We are digital transformers who create perception that drives brand adaptability in the consumer mindset.
              </p>
            </div>
            <aside className="about-who-metrics" aria-label="Company results">
              <article className="about-metric about-metric-lg">
                <strong>$2M+</strong>
                <span>Monthly online sales</span>
              </article>
              <article className="about-metric">
                <strong>400%+</strong>
                <span>Traffic growth</span>
              </article>
              <article className="about-metric">
                <strong>1000+</strong>
                <span>Keywords ranking in a month</span>
              </article>
              <article className="about-metric">
                <strong>30k+</strong>
                <span>Dealer acquisition</span>
              </article>
            </aside>
          </div>
        </section>

        {/* VISION */}
        <section className="about-vm" aria-labelledby="vision-title">
          <div className="wrap about-vm-row">
            <div className="about-vm-media">
              <img src="/assets/work/stone-hub.jpg" alt="Brand work from SMAC Digital partners" width="720" height="520" loading="lazy" />
            </div>
            <div className="about-vm-copy">
              <p className="page-eyebrow dark">Vision</p>
              <h2 id="vision-title">Make every brand feel inevitable in its market.</h2>
              <p>
                We see a digital world where ambitious businesses do not fight for attention with noise — they earn it with clarity, craft, and measurable growth. SMAC exists to turn strategy, creativity, and technology into one performance system.
              </p>
              <p>
                Our vision is simple: consumers should associate your brand with a smile — and your dashboard with results that justify every rupee and dollar invested.
              </p>
            </div>
          </div>
        </section>

        {/* MISSION */}
        <section className="about-vm about-vm-tint" aria-labelledby="mission-title">
          <div className="wrap about-vm-row is-flip">
            <div className="about-vm-media">
              <img src="/assets/services/website.jpg" alt="Digital product and marketing craft" width="720" height="520" loading="lazy" />
            </div>
            <div className="about-vm-copy">
              <p className="page-eyebrow dark">Mission</p>
              <h2 id="mission-title">Help businesses create their niche in the global marketplace.</h2>
              <p>
                We combine targeted marketing and communication strategies across Social, Mobile, Analytics, and Cloud — so brands reach the right audience and convert attention into revenue.
              </p>
              <ul className="about-vm-list">
                <li>Plan campaigns and product experiences as one growth system</li>
                <li>Ship work that can be measured — traffic quality, leads, and sales</li>
                <li>Stay close to Google’s ecosystem as a Partner while keeping craft honest</li>
                <li>Serve teams across India and the US with the same performance standard</li>
              </ul>
            </div>
          </div>
        </section>

        {/* HOW WE WORK */}
        <section className="page-section" aria-labelledby="work-title">
          <div className="wrap">
            <p className="page-eyebrow dark">How we work</p>
            <h2 id="work-title">Beyond a marketing agency</h2>
            <p className="about-section-lead">
              We adapt to the strengths and weaknesses of each business. The goal is brand adaptability in the consumer mindset — not vanity metrics.
            </p>
            <div className="page-card-grid about-work-grid">
              <article className="page-card">
                <span className="about-step">01</span>
                <h3>Association</h3>
                <p>For a successful brand, you need a sense of association. Creating identity through cognizance is our primary goal.</p>
              </article>
              <article className="page-card">
                <span className="about-step">02</span>
                <h3>Full stack growth</h3>
                <p>Marketing automation, inbound, social, SEO, video, websites, and mobile apps — planned as one system.</p>
              </article>
              <article className="page-card">
                <span className="about-step">03</span>
                <h3>Amplification</h3>
                <p>We ride digital amplification to boost growth — with measurement that keeps teams honest.</p>
              </article>
            </div>
          </div>
        </section>

        {/* PRESENCE */}
        <section className="about-presence" aria-labelledby="presence-title">
          <div className="about-presence-pattern" aria-hidden="true"></div>
          <div className="wrap">
            <header className="about-presence-head">
              <p className="page-eyebrow">Presence</p>
              <h2 id="presence-title">Built across India. Connected to the US.</h2>
              <p>Teams in Pune, Jaipur, and Kolkata — with a US desk in Gilbert, Arizona — so briefs move across time zones without losing ownership.</p>
            </header>
            <ul className="about-office-grid" role="list">
              {locationsData.map((loc) => (
                <li key={loc.city}>
                  <strong>{loc.city}</strong>
                  <span>{loc.role}</span>
                  <a href={`tel:${loc.phoneRaw}`}>{loc.phone}</a>
                </li>
              ))}
            </ul>
          </div>
        </section>

        {/* TEAM */}
        <section className="about-team" aria-labelledby="team-title">
          <div className="about-team-bg" aria-hidden="true"></div>
          <div className="wrap">
            <header className="about-team-head">
              <p className="page-eyebrow">Team</p>
              <h2 id="team-title">Talk to the people who run the brief.</h2>
              <p>Business enquiries across Pune, Jaipur, and Kolkata — the same team that owns delivery from kickoff to reporting.</p>
            </header>
            <ul className="about-team-grid" role="list">
              {teamData.map((member) => (
                <li key={member.name} className="about-team-card">
                  <div className="about-team-top">
                    <img src={member.image} width="88" height="88" alt={member.name} loading="lazy" />
                    <div>
                      <h3>{member.name}</h3>
                      <p className="about-team-role">{member.role}</p>
                    </div>
                  </div>
                  <p className="about-team-address">{member.address}</p>
                  <div className="about-team-links">
                    <a href={`tel:${member.phone.replace(/[\s\-+]/g, '')}`}>
                      <svg viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
                        <path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/>
                      </svg>
                      {member.phone}
                    </a>
                    <a href={`mailto:${member.email}`}>
                      <svg viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
                        <path fill="currentColor" d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/>
                      </svg>
                      {member.email}
                    </a>
                  </div>
                </li>
              ))}
            </ul>
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
