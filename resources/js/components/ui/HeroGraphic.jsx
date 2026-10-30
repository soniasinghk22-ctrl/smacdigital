import React from 'react';

export default function HeroGraphic() {
  return (
    <div className="hero-stage" aria-hidden="true">
      <div className="hero-grid"></div>
      <div className="growth-bars growth-bars-full">
        <span style={{ '--h': '22%' }}></span>
        <span style={{ '--h': '34%' }}></span>
        <span style={{ '--h': '28%' }}></span>
        <span style={{ '--h': '46%' }}></span>
        <span style={{ '--h': '40%' }}></span>
        <span style={{ '--h': '58%' }}></span>
        <span style={{ '--h': '52%' }}></span>
        <span style={{ '--h': '68%' }}></span>
        <span style={{ '--h': '62%' }}></span>
        <span style={{ '--h': '78%' }}></span>
        <span style={{ '--h': '72%' }}></span>
        <span style={{ '--h': '88%' }}></span>
        <span style={{ '--h': '82%' }}></span>
        <span style={{ '--h': '96%' }}></span>
        <span style={{ '--h': '90%' }}></span>
        <span style={{ '--h': '100%' }}></span>
      </div>
      <svg className="growth-line growth-line-full" viewBox="0 0 1200 320" preserveAspectRatio="none" focusable="false">
        <path
          className="growth-line-path"
          d="M40 280 C120 270, 180 240, 240 220 S360 190, 420 165 S540 140, 600 120 S720 95, 780 78 S900 55, 960 42 S1100 28, 1160 22"
        />
        <circle className="growth-dot" cx="1160" cy="22" r="8" />
      </svg>
      <div className="seo-rank">
        <div className="seo-search">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="11" cy="11" r="6" fill="none" stroke="currentColor" strokeWidth="1.8" />
            <path d="M16 16.5 20.5 21" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" />
          </svg>
          <span>seo</span>
        </div>
        <ul className="seo-list">
          <li><em>#3</em><span>digital marketing</span></li>
          <li><em>#2</em><span>lead generation</span></li>
          <li className="is-top"><em>#1</em><span>seo services</span></li>
        </ul>
      </div>
      <div className="dm-orbit">
        <span>Social</span>
        <span>Ads</span>
        <span>Content</span>
        <span>Email</span>
        <span>Analytics</span>
      </div>
      <div className="growth-tags">
        <span>↑ Traffic</span>
        <span>↑ Conversions</span>
        <span>↑ Rankings</span>
        <span>↑ ROI</span>
      </div>
    </div>
  );
}
