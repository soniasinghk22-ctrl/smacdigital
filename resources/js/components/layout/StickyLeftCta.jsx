import React from 'react';

export default function StickyLeftCta({ onOpen }) {
  return (
    <button
      type="button"
      className="sticky-left-cta"
      onClick={onOpen}
      aria-label="Let's Talk - Open Brief Modal"
      role="button"
      aria-haspopup="dialog"
    >
      <span className="sticky-cta-pulse" aria-hidden="true"></span>
      <span className="sticky-cta-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
          <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
      </span>
      <span className="sticky-cta-label">Let's Talk</span>
    </button>
  );
}
