import React from 'react';
import { Link } from 'react-router-dom';

export default function Footer() {
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <>
      <footer className="site-footer">
        <div className="footer-glow" aria-hidden="true">
          <svg className="footer-net" viewBox="0 0 1200 520" preserveAspectRatio="xMidYMid slice" focusable="false">
            <g className="footer-net-lines" fill="none" strokeLinecap="round">
              <path d="M80 90 L220 150 L360 110 L520 180 L700 120 L880 200 L1040 140 L1140 210" />
              <path d="M40 320 L180 280 L340 340 L500 260 L680 320 L860 250 L1020 310 L1180 270" />
              <path d="M220 150 L180 280 M360 110 L340 340 M520 180 L500 260 M700 120 L680 320 M880 200 L860 250" />
              <path d="M160 420 L300 380 L460 440 L640 370 L820 430 L980 390" />
            </g>
            <g className="footer-net-nodes">
              <circle cx="80" cy="90" r="3.2" /><circle cx="220" cy="150" r="4" /><circle cx="360" cy="110" r="3" />
              <circle cx="520" cy="180" r="4.5" /><circle cx="700" cy="120" r="3.5" /><circle cx="880" cy="200" r="4" />
              <circle cx="1040" cy="140" r="3" /><circle cx="1140" cy="210" r="3.5" />
              <circle cx="40" cy="320" r="3" /><circle cx="180" cy="280" r="4" /><circle cx="340" cy="340" r="3.5" />
              <circle cx="500" cy="260" r="5" /><circle cx="680" cy="320" r="3.5" /><circle cx="860" cy="250" r="4" />
              <circle cx="1020" cy="310" r="3" /><circle cx="1180" cy="270" r="3.5" />
              <circle cx="160" cy="420" r="3" /><circle cx="300" cy="380" r="3.5" /><circle cx="460" cy="440" r="4" />
              <circle cx="640" cy="370" r="3.5" /><circle cx="820" cy="430" r="3" /><circle cx="980" cy="390" r="3.5" />
            </g>
          </svg>
        </div>

        <div className="wrap footer-grid">
          {/* Brand */}
          <div className="footer-brand footer-area-brand">
            <Link className="logo" to="/" aria-label="SMAC Digital, home" onClick={scrollToTop}>
              <img src="/assets/brand/logo-white.png" width="180" height="52" alt="SMAC Digital" />
            </Link>
            <p className="footer-mark">Social · Mobile · Analytics · Cloud</p>
            <p className="footer-blurb">Performance-driven digital marketing across India and the US.</p>
            <img className="partner-badge" src="/assets/brand/google-partner.png" alt="Google Partner" width="130" height="52" />
          </div>

          {/* Services */}
          <div className="footer-col footer-area-services">
            <h2>Our Services</h2>
            <ul>
              <li><Link to="/services/marketing-automation">Marketing Automation</Link></li>
              <li><Link to="/services/inbound-marketing">Inbound Marketing</Link></li>
              <li><Link to="/services/social-media-marketing">Social Media Marketing</Link></li>
              <li><Link to="/services/search-engine-optimization">Search Engine Optimization</Link></li>
              <li><Link to="/services/video-marketing">Video Marketing</Link></li>
              <li><Link to="/services/website-design-and-development">Website Design &amp; Development</Link></li>
              <li><Link to="/services/mobile-application-development">Mobile App Development</Link></li>
              <li><Link to="/services/digital-media-planning">Digital Media Planning</Link></li>
              <li><Link to="/services/lead-generation">Lead Generation</Link></li>
              <li><Link to="/services/content-marketing">Content Marketing</Link></li>
            </ul>
          </div>

          {/* Quick Links */}
          <div className="footer-col footer-area-links">
            <h2>Quick Links</h2>
            <ul>
              <li><Link to="/about-us">About</Link></li>
              <li><Link to="/portfolios">Portfolio</Link></li>
              <li><Link to="/portfolios#cases">Case studies</Link></li>
              <li><Link to="/testimonials">Testimonials</Link></li>
              <li><Link to="/blog">Blog</Link></li>
              <li><Link to="/about-us">Partners</Link></li>
              <li><Link to="/contact">Contact</Link></li>
              <li><Link to="/events">Events</Link></li>
              <li><Link to="/career">Career</Link></li>
            </ul>
          </div>

          {/* Subscription */}
          <div className="footer-col footer-subscribe footer-area-subscribe">
            <h2>Subscription</h2>
            <p>Get a free digital audit note in your inbox.</p>
            <form className="footer-sub-form" onSubmit={(e) => { e.preventDefault(); alert("Thank you for subscribing to SMAC Digital insights!"); e.target.reset(); }}>
              <label className="visually-hidden" htmlFor="footer-email">E-mail</label>
              <input id="footer-email" name="email" type="email" placeholder="E-mail" autoComplete="email" required />
              <button type="submit" aria-label="Subscribe to newsletter">
                <svg viewBox="0 0 24 24" aria-hidden="true" width="18" height="18">
                  <path fill="currentColor" d="M8.3 4.7 15.6 12l-7.3 7.3 1.4 1.4L18.4 12 9.7 3.3z" />
                </svg>
              </button>
            </form>
          </div>

          {/* India Offices */}
          <div className="footer-office footer-area-india">
            <h2>
              <span className="footer-flag" aria-hidden="true">
                <svg viewBox="0 0 36 24" focusable="false" width="24" height="16">
                  <rect width="36" height="8" fill="#FF9933" />
                  <rect y="8" width="36" height="8" fill="#fff" />
                  <rect y="16" width="36" height="8" fill="#138808" />
                  <circle cx="18" cy="12" r="2.6" fill="none" stroke="#000080" strokeWidth="0.7" />
                  <circle cx="18" cy="12" r="0.55" fill="#000080" />
                </svg>
              </span>
              India
            </h2>
            <address>
              <strong>Jaipur</strong>
              <span>Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur 302020</span>
              <a href="tel:+919829069519">+91 98290 69519</a>
              <a href="mailto:Jitendra@smacdigital.com">Jitendra@smacdigital.com</a>
            </address>
            <address>
              <strong>Kolkata</strong>
              <span>Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</span>
              <a href="tel:+919831132254">+91 98311 32254</a>
              <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a>
            </address>
            <address>
              <strong>Pune</strong>
              <a href="tel:+919582792638">+91 95827 92638</a>
              <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
            </address>
          </div>

          {/* USA Office */}
          <div className="footer-office footer-area-usa">
            <h2>
              <span className="footer-flag" aria-hidden="true">
                <svg viewBox="0 0 36 24" focusable="false" width="24" height="16">
                  <rect width="36" height="24" fill="#B22234" />
                  <path d="M0 2.77h36M0 5.54h36M0 8.31h36M0 11.08h36M0 13.85h36M0 16.62h36M0 19.38h36" stroke="#fff" strokeWidth="1.85" />
                  <rect width="14.4" height="12.92" fill="#3C3B6E" />
                </svg>
              </span>
              USA
            </h2>
            <address>
              <span>1507 E Flower Street, Gilbert AZ 85298</span>
              <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
            </address>
          </div>

          {/* Career & Socials */}
          <div className="footer-career footer-area-career">
            <h2>For career-related enquiries, please contact:</h2>
            <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
            <a href="tel:+919582792638">+91 95827 92638</a>
            <ul className="socials" aria-label="Social links">
              <li>
                <a href="https://www.facebook.com/smacdigi" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                  <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
                    <path fill="currentColor" d="M14.2 8.5V6.9c0-.7.4-.9 1.1-.9H17V3.4h-2C12.4 3.4 11 4.7 11 7v1.5H9v2.6h2V21h3.2v-9.9h2.2l.3-2.6h-2.5z" />
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/smacdigital/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                  <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
                    <path fill="currentColor" d="M12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6Zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2Zm6-9.3a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0ZM21.4 12c0-1.2 0-2.2-.1-3.2-.1-1-.3-1.9-.8-2.7a4.6 4.6 0 0 0-1.6-1.6c-.8-.5-1.7-.7-2.7-.8-1-.1-2-.1-4.2-.1s-3.2 0-4.2.1c-1 .1-1.9.3-2.7.8a4.6 4.6 0 0 0-1.6 1.6c-.5.8-.7 1.7-.8 2.7-.1 1-.1 2-.1 3.2s0 2.2.1 3.2c.1 1 .3 1.9.8 2.7.4.7 1 1.2 1.6 1.6.8.5 1.7.7 2.7.8 1 .1 2 .1 4.2.1s3.2 0 4.2-.1c1-.1 1.9-.3 2.7-.8a4.6 4.6 0 0 0 1.6-1.6c.5-.8.7-1.7.8-2.7.1-1 .1-2 .1-3.2Zm-1.6 3.1c0 .9-.1 1.5-.2 1.9-.1.4-.3.7-.6 1-.3.3-.6.5-1 .6-.4.1-1 .2-1.9.2-1.1.1-1.5.1-4.1.1s-3 0-4.1-.1c-.9 0-1.5-.1-1.9-.2-.4-.1-.7-.3-1-.6-.3-.3-.5-.6-.6-1-.1-.4-.2-1-.2-1.9-.1-1.1-.1-1.5-.1-4.1s0-3 .1-4.1c0-.9.1-1.5.2-1.9.1-.4.3-.7.6-1 .3-.3.6-.5 1-.6.4-.1 1-.2 1.9-.2 1.1-.1 1.5-.1 4.1-.1s3 0 4.1.1c.9 0 1.5.1 1.9.2.4.1.7.3 1 .6.3.3.5.6.6 1 .1.4.2 1 .2 1.9.1 1.1.1 1.5.1 4.1s0 3-.1 4.1Z" />
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/DigitalSmac" target="_blank" rel="noopener noreferrer" aria-label="X">
                  <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
                    <path fill="currentColor" d="M14.7 10.4 21.3 3h-1.6l-5.7 6.3L9.3 3H3.6l7 9.9L3.6 21h1.6l6.1-6.8L14.7 21h5.7l-7.2-10.6Zm-2.2 2.4-.7-1L6.2 4.5h2.4l4.5 6.2.7 1 5.9 8.2h-2.4l-4.8-6.5Z" />
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://www.linkedin.com/company/smac-digital-pvt-ltd" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                  <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
                    <path fill="currentColor" d="M6.7 9H3.9v11.3h2.8V9ZM5.3 3.6a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4ZM20.2 13.4c0-3.3-1.8-4.8-4.1-4.8-1.9 0-2.7 1-3.2 1.7V9H10.1c0 1.5 0 11.3 0 11.3h2.8v-6.3c0-.3 0-.7.1-.9.3-.7 1-1.5 2.1-1.5 1.5 0 2.1 1.1 2.1 2.7v6h2.8v-6.9Z" />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div className="wrap footer-base">
          <p>© {new Date().getFullYear()} SMAC Digital. All rights reserved.</p>
          <nav className="footer-legal" aria-label="Footer links">
            <Link to="/contact">Contact</Link>
            <Link to="/blog">Blog</Link>
            <Link to="/portfolios">Portfolios</Link>
            <Link to="/testimonials">Testimonials</Link>
            <a href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">WhatsApp</a>
          </nav>
        </div>
      </footer>

      {/* Floating WhatsApp CTA */}
      <a className="whatsapp" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp SMAC Digital on +91 95827 92638">
        <svg viewBox="0 0 24 24" aria-hidden="true">
          <path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z" />
        </svg>
      </a>
    </>
  );
}
