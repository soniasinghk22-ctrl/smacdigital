import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import HeroGraphic from '../components/ui/HeroGraphic';
import TypingTitle from '../components/ui/TypingTitle';
import Counter from '../components/ui/Counter';
import Carousel from '../components/ui/Carousel';
import ModernDropdown from '../components/ui/ModernDropdown';
import { portfolioData, testimonialsData } from '../data/siteData';
import blogsData from '../data/blogsData.json';
import { api } from '../services/api';

const SERVICE_OPTIONS = [
  "Marketing automation",
  "Inbound",
  "Social media",
  "SEO",
  "Video",
  "Website",
  "Mobile app",
  "Media planning",
  "Lead generation",
  "Content",
  "Reputation",
  "Analytics"
];

export default function HomePage({ onOpenLeadModal }) {
  const [activeFaq, setActiveFaq] = useState(null);
  const [activeWorkIndex, setActiveWorkIndex] = useState(0);

  // Form state for on-page contact form
  const [formValues, setFormValues] = useState({
    name: '',
    email: '',
    phone: '',
    company: '',
    services: [],
    message: ''
  });
  const [formErrors, setFormErrors] = useState({});
  const [formStatus, setFormStatus] = useState({ type: '', message: '' });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const toggleFaq = (idx) => {
    setActiveFaq(activeFaq === idx ? null : idx);
  };

  const handleFormSubmit = async (e) => {
    e.preventDefault();
    const errs = {};
    if (!formValues.name.trim() || formValues.name.trim().length < 2) {
      errs.name = "Enter your full name.";
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formValues.email.trim())) {
      errs.email = "Enter a valid business email.";
    }
    if (!/^\d{10}$/.test(formValues.phone.replace(/[\s\-+]/g, ''))) {
      errs.phone = "Enter a 10-digit phone number.";
    }
    if (!formValues.services.length) {
      errs.services = "Choose at least one service.";
    }
    if (!formValues.message.trim() || formValues.message.trim().length < 10) {
      errs.message = "Add a short note about the project requirements.";
    }
    setFormErrors(errs);
    if (Object.keys(errs).length > 0) return;

    setIsSubmitting(true);
    setFormStatus({ type: '', message: '' });

    try {
      const data = new FormData();
      data.append('name', formValues.name);
      data.append('email', formValues.email);
      data.append('phone', formValues.phone);
      data.append('company', formValues.company);
      data.append('service', formValues.services.join(', '));
      data.append('message', formValues.message);
      data.append('landing_url', window.location.href);
      data.append('referrer_url', document.referrer || '');

      await api.submitLead(data);

      setFormStatus({
        type: 'success',
        message: 'Request received! The SMAC Digital team has your brief and will reply shortly.'
      });
      setFormValues({ name: '', email: '', phone: '', company: '', services: [], message: '' });
      setFormErrors({});
    } catch (err) {
      setFormStatus({
        type: 'error',
        message: err.message || 'Request could not be delivered. Please call +91 95827 92638 or reach out via WhatsApp.'
      });
    } finally {
      setIsSubmitting(false);
    }
  };

  const faqs = [
    {
      q: "What does SMAC stand for?",
      a: "SMAC stands for Social, Mobile, Analytics, and Cloud — the four technological pillars transforming the global digital landscape. We build integrated growth engines combining targeted social campaigns, mobile-first design, deep analytics, and scalable cloud infrastructure."
    },
    {
      q: "How does SMAC Digital approach new projects?",
      a: "We start with a thorough audit of your current digital footprint, competitor benchmark, and customer journey. We then formulate a unified strategy covering organic visibility (SEO), performance marketing, content, and high-conversion storefronts or landing pages."
    },
    {
      q: "Do you work with international clients outside India?",
      a: "Yes. In addition to our Indian offices in Jaipur, Pune, and Kolkata, we maintain an active international desk in Gilbert, Arizona, serving clients in the US, UK, Australia, and the Middle East with seamless timezone coverage."
    },
    {
      q: "What kind of ROI and results can we expect?",
      a: "Our clients typically experience between 200% to 400%+ organic traffic growth within 6 months, accompanied by higher lead-to-opportunity conversion rates, lower customer acquisition costs, and verified bottom-line growth."
    }
  ];

  return (
    <>
      <SeoMeta
        title="Best Performing Digital Marketing Agency in India | SMAC Digital"
        description="Smac Digital is a top-performing digital marketing agency in India that works with a performance-driven approach through experienced marketers. Get quotes for customized SEO, Social Media, and Online ADS proposal for your brand now."
      />

      <main id="main">
        {/* HERO SECTION */}
        <section className="hero" aria-labelledby="hero-title">
          <HeroGraphic />

          {/* Social Rail */}
          <ul className="social-rail">
            <li>
              <a className="is-mark" href="https://www.facebook.com/smacdigi" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.2 8.5V6.9c0-.7.4-.9 1.1-.9H17V3.4h-2C12.4 3.4 11 4.7 11 7v1.5H9v2.6h2V21h3.2v-9.9h2.2l.3-2.6h-2.5z"/></svg>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/DigitalSmac" target="_blank" rel="noopener noreferrer" aria-label="X">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M14.7 10.4 21.3 3h-1.6l-5.7 6.3L9.3 3H3.6l7 9.9L3.6 21h1.6l6.1-6.8L14.7 21h5.7l-7.2-10.6Zm-2.2 2.4-.7-1L6.2 4.5h2.4l4.5 6.2.7 1 5.9 8.2h-2.4l-4.8-6.5Z"/></svg>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/company/smac-digital-pvt-ltd" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.7 9H3.9v11.3h2.8V9ZM5.3 3.6a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4ZM20.2 13.4c0-3.3-1.8-4.8-4.1-4.8-1.9 0-2.7 1-3.2 1.7V9H10.1c0 1.5 0 11.3 0 11.3h2.8v-6.3c0-.3 0-.7.1-.9.3-.7 1-1.5 2.1-1.5 1.5 0 2.1 1.1 2.1 2.7v6h2.8v-6.9Z"/></svg>
              </a>
            </li>
            <li>
              <a href="https://www.instagram.com/smacdigital/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 7.2a4.8 4.8 0 1 0 0 9.6 4.8 4.8 0 0 0 0-9.6Zm0 7.9a3.1 3.1 0 1 1 0-6.2 3.1 3.1 0 0 1 0 6.2Zm6-9.3a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0ZM21.4 12c0-1.2 0-2.2-.1-3.2-.1-1-.3-1.9-.8-2.7a4.6 4.6 0 0 0-1.6-1.6c-.8-.5-1.7-.7-2.7-.8-1-.1-2-.1-4.2-.1s-3.2 0-4.2.1c-1 .1-1.9.3-2.7.8a4.6 4.6 0 0 0-1.6 1.6c-.5.8-.7 1.7-.8 2.7-.1 1-.1 2-.1 3.2s0 2.2.1 3.2c.1 1 .3 1.9.8 2.7.4.7 1 1.2 1.6 1.6.8.5 1.7.7 2.7.8 1 .1 2 .1 4.2.1s3.2 0 4.2-.1c1-.1 1.9-.3 2.7-.8a4.6 4.6 0 0 0 1.6-1.6c.5-.8.7-1.7.8-2.7.1-1 .1-2 .1-3.2Zm-1.6 3.1c0 .9-.1 1.5-.2 1.9-.1.4-.3.7-.6 1-.3.3-.6.5-1 .6-.4.1-1 .2-1.9.2-1.1.1-1.5.1-4.1.1s-3 0-4.1-.1c-.9 0-1.5-.1-1.9-.2-.4-.1-.7-.3-1-.6-.3-.3-.5-.6-.6-1-.1-.4-.2-1-.2-1.9-.1-1.1-.1-1.5-.1-4.1s0-3 .1-4.1c0-.9.1-1.5.2-1.9.1-.4.3-.7.6-1 .3-.3.6-.5 1-.6.4-.1 1-.2 1.9-.2 1.1-.1 1.5-.1 4.1-.1s3 0 4.1.1c.9 0 1.5.1 1.9.2.4.1.7.3 1 .6.3.3.5.6.6 1 .1.4.2 1 .2 1.9.1 1.1.1 1.5.1 4.1s0 3-.1 4.1Z"/></svg>
              </a>
            </li>
          </ul>

          <div className="wrap hero-copy">
            <p className="pill">Performance marketing · Digital growth</p>
            <TypingTitle lines={["We don't sell hours.", "We build pipelines."]} />
            <p className="lede">
              SMAC Digital is a performance-driven agency. We plan SEO, social, content, and products as one system — then measure what actually arrives.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Start a brief
              </button>
              <span className="or" aria-hidden="true">or</span>
              <Link className="btn btn-black" to="/portfolios">
                See the work
              </Link>
            </div>
          </div>
        </section>

        {/* STATS STRIP */}
        <section className="stats-strip" aria-label="Agency key statistics">
          <div className="wrap stats-grid">
            <div className="stat-item">
              <Counter target={12} suffix="+" />
              <p>Years shipping digital growth</p>
            </div>
            <div className="stat-item">
              <Counter target={400} suffix="%+" />
              <p>Average organic traffic lift</p>
            </div>
            <div className="stat-item">
              <Counter target={100} suffix="k+" />
              <p>Leads delivered for partners</p>
            </div>
            <div className="stat-item">
              <Counter target={98} suffix="%" />
              <p>Client retention year-on-year</p>
            </div>
          </div>
        </section>

        {/* WHO WE ARE */}
        <section className="about-who" id="about" aria-labelledby="who-title">
          <div className="about-who-bg" aria-hidden="true"></div>
          <div className="wrap about-who-grid">
            <div className="about-who-copy">
              <p className="page-eyebrow dark">Who we are</p>
              <h2 id="who-title">Social · Mobile · Analytics · Cloud</h2>
              <p>
                SMAC defines as S-Social, M-Mobile, A-Analytics, and C-Cloud — four elements changing the digital world. We adopted this name to become the front face of growth in digital marketing.
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

        {/* SERVICES PREVIEW */}
        <section className="page-section" id="services" aria-labelledby="services-head-title">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Services</p>
              <h2 id="services-head-title">Pick a lane. We'll map the rest.</h2>
              <p className="section-intro">SEO, social, content, and product builds — planned as one growth system.</p>
            </header>

            <div className="page-service-grid">
              <Link className="page-service-card" to="/services/search-engine-optimization">
                <img src="/assets/services/seo.jpg" alt="Search Engine Optimization" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Search Engine Optimization</h2>
                  <p>Earn a stronger place in search.</p>
                  <span>Explore →</span>
                </div>
              </Link>
              <Link className="page-service-card" to="/services/social-media-marketing">
                <img src="/assets/services/social.jpg" alt="Social Media Marketing" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Social Media Marketing</h2>
                  <p>Show up where the audience already spends time.</p>
                  <span>Explore →</span>
                </div>
              </Link>
              <Link className="page-service-card" to="/services/lead-generation">
                <img src="/assets/services/lead.jpg" alt="Lead Generation" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Lead Generation</h2>
                  <p>Campaigns judged by the inquiries they create.</p>
                  <span>Explore →</span>
                </div>
              </Link>
              <Link className="page-service-card" to="/services/website-design-and-development">
                <img src="/assets/services/website.jpg" alt="Website Design and Development" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Website Design and Development</h2>
                  <p>A site that answers a marketing problem.</p>
                  <span>Explore →</span>
                </div>
              </Link>
              <Link className="page-service-card" to="/services/marketing-automation">
                <img src="/assets/services/automation.jpg" alt="Marketing Automation" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Marketing Automation</h2>
                  <p>Let email and social follow-up keep moving.</p>
                  <span>Explore →</span>
                </div>
              </Link>
              <Link className="page-service-card" to="/services/video-marketing">
                <img src="/assets/services/video.jpg" alt="Video Marketing" width="640" height="400" loading="lazy" />
                <div>
                  <h2>Video Marketing</h2>
                  <p>Show the product in motion, then place the films.</p>
                  <span>Explore →</span>
                </div>
              </Link>
            </div>

            <div style={{ textAlign: 'center', marginTop: '3rem' }}>
              <Link className="btn btn-primary" to="/services">
                Browse All 15 Services →
              </Link>
            </div>
          </div>
        </section>

        {/* PORTFOLIO SHOWCASE */}
        <section className="page-section page-section-tint" id="work" aria-labelledby="work-head-title">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Work</p>
              <h2 id="work-head-title">Selected client outcomes.</h2>
              <p className="section-intro">Brands we have partnered with across manufacturing, healthcare, luxury marble, and direct commerce.</p>
            </header>

            <div className="work-showcase" data-work-showcase>
              <div className="work-tabs-bar" data-work-tabs>
                <div className="work-tabs-track">
                  {portfolioData.map((project, idx) => (
                    <button
                      key={project.id}
                      type="button"
                      className={`work-tab ${idx === activeWorkIndex ? 'is-active' : ''}`}
                      onClick={() => setActiveWorkIndex(idx)}
                    >
                      {project.title}
                    </button>
                  ))}
                </div>
              </div>

              <div className="work-slides-container">
                {portfolioData.map((project, idx) => {
                  if (idx !== activeWorkIndex) return null;
                  return (
                    <article key={project.id} className="work-slide is-active">
                      <div className="work-slide-media">
                        <img src={project.image} alt={project.title} width="800" height="520" loading="lazy" />
                      </div>
                      <div className="work-slide-body">
                        <p className="pill">{project.tag}</p>
                        <h3>{project.title}</h3>
                        <p><strong>Challenge:</strong> {project.challenge}</p>
                        <p><strong>What we did:</strong> {project.did}</p>
                        <p><strong>Outcome:</strong> {project.outcome}</p>
                        <a className="btn btn-navy" href={project.link} target="_blank" rel="noopener noreferrer">
                          View Project ↗
                        </a>
                      </div>
                    </article>
                  );
                })}
              </div>
            </div>
          </div>
        </section>

        {/* TESTIMONIALS */}
        <section className="page-section" aria-labelledby="say-title">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Testimonials</p>
              <h2 id="say-title">What clients say publicly.</h2>
              <p className="section-intro">Real partnerships, verified reviews, and measurable outcomes.</p>
            </header>
            <Carousel items={testimonialsData} autoSlide={true} interval={7000} />
          </div>
        </section>

        {/* INSIGHTS / BLOGS */}
        <section className="page-section page-section-tint" id="insights" aria-labelledby="insights-title">
          <div className="wrap">
            <header className="section-head" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-end', flexWrap: 'wrap', gap: '1rem' }}>
              <div>
                <p className="eyebrow">Insights</p>
                <h2 id="insights-title">From the knowledge base.</h2>
                <p className="section-intro">Guides on Shopify D2C, app development in Jaipur, AI search, and SEO.</p>
              </div>
              <Link className="btn btn-navy" to="/blog">
                All articles →
              </Link>
            </header>

            <div className="page-blog-grid">
              {blogsData.slice(0, 3).map((blog) => (
                <Link key={blog.slug} className="page-blog-card" to={`/blogs/${blog.slug}`}>
                  <span className="page-blog-card-media">
                    <img src={blog.image} alt={blog.title} width="640" height="400" loading="lazy" />
                  </span>
                  <span className="page-blog-card-body">
                    <span className="page-blog-card-meta">
                      <em>{blog.tag}</em>
                      <time dateTime={blog.date}>{blog.dateLabel}</time>
                    </span>
                    <strong>{blog.title}</strong>
                    <span className="page-blog-card-excerpt">{blog.excerpt}</span>
                    <span className="page-blog-card-go">Read article →</span>
                  </span>
                </Link>
              ))}
            </div>
          </div>
        </section>

        {/* FAQS */}
        <section className="page-section" aria-labelledby="faq-title">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Frequently Asked Questions</p>
              <h2 id="faq-title">Everything you need to know.</h2>
            </header>

            <div className="faq-accordion">
              {faqs.map((faq, idx) => {
                const isOpen = activeFaq === idx;
                return (
                  <div key={idx} className={`faq-item ${isOpen ? 'is-open' : ''}`}>
                    <button
                      type="button"
                      className="faq-question"
                      aria-expanded={isOpen}
                      onClick={() => toggleFaq(idx)}
                    >
                      <span>{faq.q}</span>
                      <span className="faq-icon" aria-hidden="true">
                        <svg viewBox="0 0 20 20" width="18" height="18" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                          <polyline points={isOpen ? "6 12 10 8 14 12" : "6 8 10 12 14 8"}></polyline>
                        </svg>
                      </span>
                    </button>
                    {isOpen && (
                      <div className="faq-answer">
                        <p>{faq.a}</p>
                      </div>
                    )}
                  </div>
                );
              })}
            </div>
          </div>
        </section>

        {/* ON-PAGE LEAD FORM */}
        <section className="contact-studio" id="contact" aria-labelledby="home-contact-title">
          <div className="contact-studio-glow" aria-hidden="true"></div>
          <div className="wrap contact-studio-grid">
            <div className="contact-studio-copy">
              <p className="contact-eyebrow">START A BRIEF</p>
              <h2 id="home-contact-title">Tell us what you're building. <em>We'll shape the plan.</em></h2>
              <p className="contact-studio-lead">
                Share goals, timelines, and the channels that matter. The form posts directly to our team — you'll receive a confirmation once accepted.
              </p>

              <div className="contact-quick">
                <a className="contact-chip" href="tel:+919829069519">
                  <span className="contact-chip-ico" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M7.5 3.5h3.2l1 4.2-2 1.2a12.5 12.5 0 0 0 5.4 5.4l1.2-2 4.2 1v3.2a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 3.5 5.7a2 2 0 0 1 2-2.2Z" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinejoin="round"/></svg>
                  </span>
                  Call Jaipur
                </a>
                <a className="contact-chip" href="mailto:Jitendra@smacdigital.com">
                  <span className="contact-chip-ico" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 6.5h16v11H4Zm0 0 8 6 8-6" fill="none" stroke="currentColor" strokeWidth="1.7" strokeLinejoin="round"/></svg>
                  </span>
                  Email
                </a>
                <a className="contact-chip contact-chip-accent" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
                  <span className="contact-chip-ico" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 3.5a8.2 8.2 0 0 0-7 12.5L4 20.5l4.6-1.2A8.2 8.2 0 1 0 12 3.5Zm-3.2 5.3c.2-.5.4-.5.7-.5h.5c.2 0 .4 0 .5.4l.7 1.7c.1.2 0 .4-.1.6l-.4.5c-.1.2-.1.4.1.7a6.8 6.8 0 0 0 2 2c.3.2.5.2.7.1l.6-.4c.2-.1.4-.1.6 0l1.6.8c.3.2.4.3.4.5v.5c0 .3 0 .5-.3.7a3.3 3.3 0 0 1-1.6.6c-.9 0-3.1-.4-5.1-2.3-1.8-1.7-2.4-3.6-2.5-4.2 0-.5.2-1 .4-1.3Z" fill="currentColor"/></svg>
                  </span>
                  WhatsApp
                </a>
              </div>
            </div>

            <form className="lead-form" id="lead-form" onSubmit={handleFormSubmit} noValidate>
              <div className="field-row">
                <div className={`field field-float ${formErrors.name ? 'is-invalid' : ''}`}>
                  <input
                    id="home-name"
                    name="name"
                    type="text"
                    placeholder=" "
                    value={formValues.name}
                    onChange={(e) => {
                      setFormValues({ ...formValues, name: e.target.value });
                      if (formErrors.name) setFormErrors({ ...formErrors, name: null });
                    }}
                    required
                  />
                  <label htmlFor="home-name">Full name</label>
                  {formErrors.name && <p className="field-error">{formErrors.name}</p>}
                </div>

                <div className={`field field-float ${formErrors.email ? 'is-invalid' : ''}`}>
                  <input
                    id="home-email"
                    name="email"
                    type="email"
                    placeholder=" "
                    value={formValues.email}
                    onChange={(e) => {
                      setFormValues({ ...formValues, email: e.target.value });
                      if (formErrors.email) setFormErrors({ ...formErrors, email: null });
                    }}
                    required
                  />
                  <label htmlFor="home-email">Business email</label>
                  {formErrors.email && <p className="field-error">{formErrors.email}</p>}
                </div>
              </div>

              <div className="field-row">
                <div className={`field field-float ${formErrors.phone ? 'is-invalid' : ''}`}>
                  <input
                    id="home-phone"
                    name="phone"
                    type="tel"
                    maxLength="10"
                    placeholder=" "
                    value={formValues.phone}
                    onChange={(e) => {
                      setFormValues({ ...formValues, phone: e.target.value });
                      if (formErrors.phone) setFormErrors({ ...formErrors, phone: null });
                    }}
                    required
                  />
                  <label htmlFor="home-phone">Phone number</label>
                  {formErrors.phone && <p className="field-error">{formErrors.phone}</p>}
                </div>

                <div className="field field-float">
                  <input
                    id="home-company"
                    name="company"
                    type="text"
                    placeholder=" "
                    value={formValues.company}
                    onChange={(e) => setFormValues({ ...formValues, company: e.target.value })}
                  />
                  <label htmlFor="home-company">Company or website</label>
                </div>
              </div>

              <ModernDropdown
                options={SERVICE_OPTIONS}
                selected={formValues.services}
                onChange={(selected) => {
                  setFormValues({ ...formValues, services: selected });
                  if (formErrors.services) setFormErrors({ ...formErrors, services: null });
                }}
                error={formErrors.services}
              />

              <div className={`field field-float field-textarea ${formErrors.message ? 'is-invalid' : ''}`}>
                <textarea
                  id="home-requirements"
                  name="message"
                  rows="4"
                  placeholder=" "
                  value={formValues.message}
                  onChange={(e) => {
                    setFormValues({ ...formValues, message: e.target.value });
                    if (formErrors.message) setFormErrors({ ...formErrors, message: null });
                  }}
                  required
                ></textarea>
                <label htmlFor="home-requirements">Project requirements</label>
                {formErrors.message && <p className="field-error">{formErrors.message}</p>}
              </div>

              <button className="lead-submit" type="submit" disabled={isSubmitting}>
                <span>{isSubmitting ? 'Sending…' : 'Get a free consultation'}</span>
                <span className="lead-submit-arrow" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" strokeWidth="1.9" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </span>
              </button>

              {formStatus.message && (
                <p className={`form-status is-${formStatus.type}`} role="status">
                  {formStatus.message}
                </p>
              )}
            </form>
          </div>
        </section>
      </main>
    </>
  );
}
