import React, { useState, useEffect, useCallback } from 'react';

export default function Carousel({ items = [], autoSlide = false, interval = 6000 }) {
  const [currentIndex, setCurrentIndex] = useState(0);

  const nextSlide = useCallback(() => {
    setCurrentIndex((prev) => (prev + 1) % items.length);
  }, [items.length]);

  const prevSlide = useCallback(() => {
    setCurrentIndex((prev) => (prev - 1 + items.length) % items.length);
  }, [items.length]);

  useEffect(() => {
    if (!autoSlide || items.length <= 1) return;
    const timer = setInterval(nextSlide, interval);
    return () => clearInterval(timer);
  }, [autoSlide, interval, nextSlide, items.length]);

  const handleKeyDown = (e) => {
    if (e.key === 'ArrowRight') {
      e.preventDefault();
      nextSlide();
    } else if (e.key === 'ArrowLeft') {
      e.preventDefault();
      prevSlide();
    }
  };

  if (!items.length) return null;

  return (
    <div className="say-carousel" data-carousel onKeyDown={handleKeyDown} tabIndex={0}>
      <div className="carousel-stage">
        {items.map((item, idx) => {
          const isActive = idx === currentIndex;
          return (
            <figure
              key={item.id || idx}
              className={`say-slide ${isActive ? 'is-active' : ''}`}
              data-slide
              hidden={!isActive}
            >
              <div className="say-slide-top">
                <span className="say-badge">{item.metric || 'Real Results'}</span>
                <div className="say-stars" aria-label="5 out of 5 stars">
                  {'★★★★★'}
                </div>
              </div>
              <blockquote className="say-quote">
                “{item.quote}”
              </blockquote>
              <figcaption className="say-author">
                <strong>{item.author}</strong>
                <span>{item.role}</span>
              </figcaption>
            </figure>
          );
        })}
      </div>

      <div className="carousel-nav">
        <button
          type="button"
          className="carousel-btn prev"
          data-carousel-prev
          onClick={prevSlide}
          aria-label="Previous testimonial"
        >
          <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
            <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
          </svg>
        </button>

        <div className="carousel-dots" role="tablist">
          {items.map((_, idx) => (
            <button
              key={idx}
              type="button"
              role="tab"
              aria-selected={idx === currentIndex}
              tabIndex={idx === currentIndex ? 0 : -1}
              aria-label={`Testimonial ${idx + 1} of ${items.length}`}
              onClick={() => setCurrentIndex(idx)}
              className={idx === currentIndex ? 'is-active' : ''}
            />
          ))}
        </div>

        <button
          type="button"
          className="carousel-btn next"
          data-carousel-next
          onClick={nextSlide}
          aria-label="Next testimonial"
        >
          <svg viewBox="0 0 24 24" aria-hidden="true" width="20" height="20">
            <path d="M9 18l6-6-6-6" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
          </svg>
        </button>
      </div>
    </div>
  );
}
