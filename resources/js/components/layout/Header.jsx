import React, { useState, useEffect, useRef } from 'react';
import { Link, useLocation } from 'react-router-dom';
import MegaMenu from './MegaMenu';
import PortfolioDrop from './PortfolioDrop';

export default function Header({ onOpenLeadModal }) {
  const [isStuck, setIsStuck] = useState(false);
  const [isNavOpen, setIsNavOpen] = useState(false);
  const [isMegaOpen, setIsMegaOpen] = useState(false);
  const [isDropOpen, setIsDropOpen] = useState(false);
  const megaTimerRef = useRef(null);
  const dropTimerRef = useRef(null);
  const location = useLocation();

  useEffect(() => {
    function handleScroll() {
      setIsStuck(window.scrollY > 8);
    }
    handleScroll();
    window.addEventListener('scroll', handleScroll, { passive: true });
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  // Close menus on route change
  useEffect(() => {
    setIsNavOpen(false);
    setIsMegaOpen(false);
    setIsDropOpen(false);
    document.body.style.overflow = '';
  }, [location.pathname]);

  const toggleNav = () => {
    const nextState = !isNavOpen;
    setIsNavOpen(nextState);
    document.body.style.overflow = nextState ? 'hidden' : '';
  };

  const closeNav = () => {
    setIsNavOpen(false);
    setIsMegaOpen(false);
    setIsDropOpen(false);
    document.body.style.overflow = '';
  };

  // Mega Menu hover helpers (Desktop)
  const isDesktop = () => window.matchMedia('(min-width: 981px)').matches;

  const handleMegaMouseEnter = () => {
    if (isDesktop()) {
      clearTimeout(megaTimerRef.current);
      setIsDropOpen(false);
      setIsMegaOpen(true);
    }
  };

  const handleMegaMouseLeave = () => {
    if (isDesktop()) {
      megaTimerRef.current = setTimeout(() => {
        setIsMegaOpen(false);
      }, 250);
    }
  };

  // Portfolio Drop hover helpers (Desktop)
  const handleDropMouseEnter = () => {
    if (isDesktop()) {
      clearTimeout(dropTimerRef.current);
      setIsMegaOpen(false);
      setIsDropOpen(true);
    }
  };

  const handleDropMouseLeave = () => {
    if (isDesktop()) {
      dropTimerRef.current = setTimeout(() => {
        setIsDropOpen(false);
      }, 250);
    }
  };

  const isActive = (path) => {
    if (path === '/' && location.pathname === '/') return true;
    if (path !== '/' && location.pathname.startsWith(path)) return true;
    return false;
  };

  return (
    <header className={`site-header ${isStuck ? 'is-stuck' : ''}`} data-header>
      <div className="wrap header-bar">
        <Link className="logo" to="/" aria-label="SMAC Digital, home" onClick={closeNav}>
          <img src="/assets/brand/logo-white.png" width="150" height="43" alt="SMAC Digital" />
        </Link>

        <button
          className="nav-toggle"
          type="button"
          aria-expanded={isNavOpen}
          aria-controls="site-nav"
          data-nav-toggle
          onClick={toggleNav}
        >
          <span className="nav-toggle-lines" aria-hidden="true"></span>
          <span className="visually-hidden">Menu</span>
        </button>

        <nav className={`site-nav ${isNavOpen ? 'is-open' : ''}`} id="site-nav" data-nav aria-label="Primary">
          <ul className="nav-list">
            <li>
              <Link to="/" className={isActive('/') ? 'is-active' : ''} onClick={closeNav}>
                Home
              </Link>
            </li>
            <li>
              <Link to="/about-us" className={isActive('/about-us') ? 'is-active' : ''} onClick={closeNav}>
                About
              </Link>
            </li>

            {/* Services with MegaMenu */}
            <li
              className={`has-mega ${isMegaOpen ? 'is-open' : ''}`}
              onMouseEnter={handleMegaMouseEnter}
              onMouseLeave={handleMegaMouseLeave}
            >
              <button
                className="nav-parent"
                type="button"
                aria-expanded={isMegaOpen}
                aria-controls="services-menu"
                data-mega-toggle
                onClick={() => {
                  setIsDropOpen(false);
                  setIsMegaOpen(!isMegaOpen);
                }}
              >
                Services
              </button>
              <MegaMenu isOpen={isMegaOpen} onClose={closeNav} />
            </li>

            {/* Portfolio Dropdown */}
            <li
              className={`has-drop ${isDropOpen ? 'is-open' : ''}`}
              onMouseEnter={handleDropMouseEnter}
              onMouseLeave={handleDropMouseLeave}
            >
              <button
                className="nav-parent"
                type="button"
                aria-expanded={isDropOpen}
                aria-controls="portfolio-menu"
                data-drop-toggle
                onClick={() => {
                  setIsMegaOpen(false);
                  setIsDropOpen(!isDropOpen);
                }}
              >
                Portfolio
              </button>
              <PortfolioDrop isOpen={isDropOpen} onClose={closeNav} />
            </li>

            <li>
              <Link to="/testimonials" className={isActive('/testimonials') ? 'is-active' : ''} onClick={closeNav}>
                Testimonials
              </Link>
            </li>
            <li>
              <Link to="/blog" className={isActive('/blog') ? 'is-active' : ''} onClick={closeNav}>
                Blog
              </Link>
            </li>
            <li>
              <Link to="/contact" className={isActive('/contact') ? 'is-active' : ''} onClick={closeNav}>
                Contact
              </Link>
            </li>
          </ul>

          <button
            type="button"
            className="btn btn-primary nav-cta"
            onClick={() => {
              closeNav();
              onOpenLeadModal();
            }}
          >
            Let's Talk
          </button>
        </nav>
      </div>
    </header>
  );
}
