import React from 'react';
import { Link } from 'react-router-dom';

export default function MegaMenu({ isOpen, onClose }) {
  return (
    <div className={`mega ${isOpen ? 'is-open' : ''}`} id="services-menu">
      <div className="mega-inner">
        <aside className="mega-intro">
          <p className="mega-intro-kicker">Services</p>
          <h3>Pick a lane.<br />We’ll map the rest.</h3>
          <p>SEO, social, content, and product builds — planned as one growth system.</p>
          <Link className="mega-all" to="/services" onClick={onClose}>
            Browse all services
            <svg viewBox="0 0 24 24" aria-hidden="true" width="16" height="16">
              <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" />
            </svg>
          </Link>
        </aside>

        <div className="mega-grid">
          {/* Column 01 */}
          <div className="mega-col">
            <p className="mega-label"><span>01</span> Digital marketing</p>
            <Link className="mega-item" to="/services/search-engine-optimization" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M16 16.5 20 20.5" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Search Engine Optimization</strong>
                <em>Earn a stronger place in search.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/social-media-marketing" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <rect x="4" y="4" width="16" height="16" rx="4" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <circle cx="12" cy="12" r="3.2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <circle cx="16.5" cy="7.5" r="0.8" fill="currentColor" />
                </svg>
              </span>
              <span>
                <strong>Social Media Marketing</strong>
                <em>Show up where the audience already spends time.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/lead-generation" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M4 16.5 9 11l3 3 8-8" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" />
                  <path d="M14 6h6v6" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Lead Generation</strong>
                <em>Campaigns judged by the inquiries they create.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/inbound-marketing" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M12 4v10" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                  <path d="M8 11l4 4 4-4" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round" />
                  <path d="M5 19h14" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Inbound Marketing</strong>
                <em>Bring the right people in.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/digital-media-planning" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <rect x="3.5" y="5" width="17" height="14" rx="2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M3.5 9.5h17M8 5v4.5" fill="none" stroke="currentColor" strokeWidth="1.6" />
                </svg>
              </span>
              <span>
                <strong>Digital Media Planning</strong>
                <em>Decide where attention and budget should work.</em>
              </span>
            </Link>
          </div>

          {/* Column 02 */}
          <div className="mega-col">
            <p className="mega-label"><span>02</span> Content and reputation</p>
            <Link className="mega-item" to="/services/content-marketing" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M6 4.5h9.5L19 8v11.5H6z" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinejoin="round" />
                  <path d="M15 4.5V8h4M8.5 12h7M8.5 15.5h5" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Content Marketing</strong>
                <em>Give the brand something worth finding.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/video-marketing" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <rect x="3.5" y="6" width="12" height="12" rx="2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M15.5 10.5 20.5 8v8l-5-2.5z" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinejoin="round" />
                </svg>
              </span>
              <span>
                <strong>Video Marketing</strong>
                <em>Show the product in motion, then place the films.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/influencer-marketing" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <circle cx="9" cy="9" r="3" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M4.5 18.5c.8-2.4 2.4-3.5 4.5-3.5s3.7 1.1 4.5 3.5" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                  <circle cx="16.5" cy="9.5" r="2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M16 15c1.6.2 2.8 1 3.5 3" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Influencer Marketing</strong>
                <em>Put the brand with people the audience already trusts.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/online-reputation-management" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M12 3.8 14.2 9l5.5.4-4.2 3.5 1.3 5.3L12 15.4 7.2 18.2 8.5 13 4.3 9.4 9.8 9z" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinejoin="round" />
                </svg>
              </span>
              <span>
                <strong>Online Reputation Management</strong>
                <em>Shape what people find about the brand.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/social-media-analytics" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M4 19V5M4 19h16" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                  <path d="M8 15v-3M12 15V8M16 15v-5" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Social Media Analytics</strong>
                <em>See which activity earns its place.</em>
              </span>
            </Link>
          </div>

          {/* Column 03 */}
          <div className="mega-col">
            <p className="mega-label"><span>03</span> Websites and products</p>
            <Link className="mega-item" to="/services/website-design-and-development" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <rect x="3.5" y="5" width="17" height="12" rx="2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M3.5 9h17M8 19h8" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Website Design and Development</strong>
                <em>A site that answers a marketing problem.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/mobile-application-development" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <rect x="8" y="3.5" width="8" height="17" rx="2" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M11 18.2h2" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Mobile Application Development</strong>
                <em>Meet people on the device they already use.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/marketing-automation" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="3" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M12 4.5v2.2M12 17.3V19.5M4.5 12h2.2M17.3 12H19.5M6.6 6.6l1.6 1.6M15.8 15.8l1.6 1.6M17.4 6.6l-1.6 1.6M8.2 15.8l-1.6 1.6" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Marketing Automation</strong>
                <em>Let email and social follow-up keep moving.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/sentiment-analysis" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="8" fill="none" stroke="currentColor" strokeWidth="1.6" />
                  <path d="M8.5 14.2c.9 1.2 2.1 1.8 3.5 1.8s2.6-.6 3.5-1.8M9 10h.1M15 10h.1" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>Sentiment Analysis</strong>
                <em>Read how people talk about the brand.</em>
              </span>
            </Link>
            <Link className="mega-item" to="/services/devops-services" onClick={onClose}>
              <span className="mega-ico" aria-hidden="true">
                <svg viewBox="0 0 24 24">
                  <path d="M7 16.5a3.2 3.2 0 0 1 .4-6.3A4.2 4.2 0 0 1 15.6 8 3.4 3.4 0 0 1 18 14.5H7" fill="none" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" />
                </svg>
              </span>
              <span>
                <strong>DevOps Services</strong>
                <em>Keep the product shipping and stable.</em>
              </span>
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
}
