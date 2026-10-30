import React from 'react';
import { Link } from 'react-router-dom';

export default function CtaBanner({
  title = "Ready to put this into practice?",
  subtitle = "Let’s talk growth.",
  text = "SMAC Digital helps brands turn strategy into pipeline — SEO, social, content, and performance under one roof.",
  onOpenLeadModal
}) {
  return (
    <section className="about-cta about-cta--red" aria-labelledby="cta-banner-title">
      <div className="about-cta-pattern" aria-hidden="true"></div>
      <div className="wrap about-cta-inner">
        <div className="about-cta-copy">
          <p className="pill">Next step</p>
          <h2 id="cta-banner-title">
            {title} <em>{subtitle}</em>
          </h2>
          <p>{text}</p>
          <div className="about-cta-actions">
            <button
              type="button"
              className="btn btn-white"
              onClick={onOpenLeadModal}
            >
              Get a free consultation
            </button>
            <span className="or" aria-hidden="true">or</span>
            <Link className="btn btn-black" to="/portfolios">
              See the work
            </Link>
          </div>
        </div>

        <aside className="about-cta-panel about-cta-panel--creative">
          <div className="about-cta-panel-glow" aria-hidden="true"></div>
          <div className="about-cta-panel-top">
            <span className="about-cta-live"><i></i> Available now</span>
            <p className="about-cta-kicker">Prefer a direct call?</p>
          </div>
          <div className="about-cta-phones">
            <a className="about-cta-phone" href="tel:+919582792638">
              <span className="about-cta-phone-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/>
                </svg>
              </span>
              <span>
                <small>Delhi NCR / Pune</small>
                <strong>+91 95827 92638</strong>
              </span>
            </a>
            <a className="about-cta-phone" href="tel:+919829069519">
              <span className="about-cta-phone-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/>
                </svg>
              </span>
              <span>
                <small>Jaipur / Head Office</small>
                <strong>+91 98290 69519</strong>
              </span>
            </a>
          </div>
        </aside>
      </div>
    </section>
  );
}
