import React from 'react';
import { Link } from 'react-router-dom';

export default function PortfolioDrop({ isOpen, onClose }) {
  return (
    <div className={`drop drop-portfolio ${isOpen ? 'is-open' : ''}`} id="portfolio-menu">
      <div className="drop-portfolio-inner">
        <div className="drop-portfolio-main">
          <header className="drop-portfolio-head">
            <div>
              <h3>Featured Projects</h3>
              <p>Explore our portfolio of high-impact digital solutions designed to drive engagement and deliver measurable growth.</p>
            </div>
            <Link className="drop-portfolio-cta" to="/portfolios" onClick={onClose}>
              Explore Our Portfolio
              <svg viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
                <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" />
              </svg>
            </Link>
          </header>

          <div className="drop-portfolio-grid">
            <a className="drop-card" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">
              <img src="/assets/work/shree-rakhi.jpg" alt="Shree Rakhi gift set display" width="480" height="320" loading="lazy" />
              <span>Shree Rakhi</span>
            </a>
            <a className="drop-card" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">
              <img src="/assets/work/rhl-preview.jpg" alt="Rajasthan Hospital campus" width="480" height="320" loading="lazy" />
              <span>Rajasthan Hospital</span>
            </a>
            <a className="drop-card" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">
              <img src="/assets/work/stone-hub.jpg" alt="Stone Hub India showroom" width="480" height="320" loading="lazy" />
              <span>Stone Hub India</span>
            </a>
            <a className="drop-card" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">
              <img src="/assets/work/kalavaati.jpg" alt="Kalavaati handcrafted ceramics" width="480" height="320" loading="lazy" />
              <span>Kalavaati</span>
            </a>
          </div>
        </div>

        <aside className="drop-portfolio-side">
          <p className="drop-side-kicker">Featured Case Studies</p>
          <Link className="drop-side-card" to="/portfolios#cases" onClick={onClose}>
            <img src="/assets/cases/case-1.jpg" alt="Featured case study" width="420" height="260" loading="lazy" />
            <strong>Don't know what customers want, do you want?</strong>
            <span>Read case studies</span>
          </Link>
          <div className="drop-side-links">
            <Link to="/testimonials" onClick={onClose}>Testimonials</Link>
            <Link to="/portfolios" onClick={onClose}>All projects</Link>
          </div>
        </aside>
      </div>
    </div>
  );
}
