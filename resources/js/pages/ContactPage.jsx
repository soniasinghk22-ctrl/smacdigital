import React, { useState } from 'react';
import SeoMeta from '../components/shared/SeoMeta';
import ModernDropdown from '../components/ui/ModernDropdown';
import { locationsData } from '../data/siteData';
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

export default function ContactPage() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    company: '',
    services: [],
    message: ''
  });
  const [errors, setErrors] = useState({});
  const [status, setStatus] = useState({ type: '', message: '' });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const validate = () => {
    const errs = {};
    if (!formData.name.trim() || formData.name.trim().length < 2) {
      errs.name = "Enter your full name.";
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email.trim())) {
      errs.email = "Enter a valid business email.";
    }
    if (!/^\d{10}$/.test(formData.phone.replace(/[\s\-+]/g, ''))) {
      errs.phone = "Enter a 10-digit phone number.";
    }
    if (!formData.services.length) {
      errs.services = "Choose at least one service.";
    }
    if (!formData.message.trim() || formData.message.trim().length < 10) {
      errs.message = "Add a short note about the project requirements.";
    }
    setErrors(errs);
    return Object.keys(errs).length === 0;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;

    setIsSubmitting(true);
    setStatus({ type: '', message: '' });

    try {
      const data = new FormData();
      data.append('name', formData.name);
      data.append('email', formData.email);
      data.append('phone', formData.phone);
      data.append('company', formData.company);
      data.append('service', formData.services.join(', '));
      data.append('message', formData.message);
      data.append('landing_url', window.location.href);
      data.append('referrer_url', document.referrer || '');

      await api.submitLead(data);

      setStatus({
        type: 'success',
        message: 'Request received! The SMAC Digital team has your brief and will reply shortly.'
      });
      setFormData({ name: '', email: '', phone: '', company: '', services: [], message: '' });
      setErrors({});
    } catch (err) {
      setStatus({
        type: 'error',
        message: err.message || 'Request could not be delivered. Please call +91 95827 92638 or reach out via WhatsApp.'
      });
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <>
      <SeoMeta
        title="Contact Us | SMAC Digital Agency Jaipur, Pune, Kolkata"
        description="Get in touch with SMAC Digital. Offices in Jaipur, Kolkata, Pune, and Gilbert, AZ. Send a brief or call our team directly for customized digital growth."
        canonical="https://www.smacdigital.com/contact"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero contact-page-hero" aria-labelledby="contact-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Contact</p>
            <h1 id="contact-hero-title">
              <span>Let’s map your next</span><br />
              <em>growth move.</em>
            </h1>
            <p className="lede">
              Offices in Jaipur, Kolkata, Pune, and the US. Send a brief — we’ll reply with clear next steps.
            </p>
            <div className="hero-actions">
              <a className="btn btn-white" href="#enquiry">
                Send an enquiry
              </a>
              <span className="or" aria-hidden="true">or</span>
              <a className="btn btn-black" href="#map">
                View on map
              </a>
            </div>
          </div>
        </section>

        {/* MAP SECTION */}
        <section className="contact-map" id="map" aria-label="SMAC Digital on Google Maps">
          <div className="contact-map-frame">
            <iframe
              title="SMAC Digital Jaipur office on Google Maps"
              src="https://www.google.com/maps?q=Anukampa+Point,+116/230,+Shipra+Path,+Mansarovar,+Jaipur,+Rajasthan+302020&z=16&output=embed"
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
              allowFullScreen
            ></iframe>
          </div>
          <div className="contact-map-bar">
            <div className="wrap contact-map-bar-inner">
              <div>
                <p className="contact-map-kicker">Headquarters</p>
                <p className="contact-map-title">Anukampa Point, Mansarovar · Jaipur</p>
              </div>
              <a
                className="btn btn-white"
                href="https://www.google.com/maps/dir/?api=1&destination=Anukampa+Point,+116/230,+Shipra+Path,+Mansarovar,+Jaipur,+Rajasthan+302020"
                target="_blank"
                rel="noopener noreferrer"
              >
                Get directions ↗
              </a>
            </div>
          </div>
        </section>

        {/* CONTACT STUDIO & ENQUIRY */}
        <section className="contact-studio" id="enquiry" aria-labelledby="enquiry-title">
          <div className="contact-studio-glow" aria-hidden="true"></div>
          <div className="wrap contact-studio-grid">
            <div className="contact-studio-copy">
              <p className="contact-eyebrow">Enquiry</p>
              <h2 id="enquiry-title">
                Tell us what you’re building.<em> We’ll shape the plan.</em>
              </h2>
              <p className="contact-studio-lead">
                Share goals, timelines, and the channels that matter. The form posts to our lead desk — you’ll see a confirmation once it’s accepted.
              </p>

              <div className="contact-quick" aria-label="Quick contact">
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

              <ol className="contact-places" aria-label="Office addresses">
                {locationsData.map((loc) => (
                  <li key={loc.city} className="contact-place">
                    <h3>{loc.city} <small style={{ fontWeight: 400, opacity: 0.8 }}>({loc.role})</small></h3>
                    <p>{loc.address}</p>
                    <div style={{ marginTop: '0.5rem', display: 'flex', gap: '1rem', flexWrap: 'wrap' }}>
                      <a href={`tel:${loc.phoneRaw}`} style={{ fontWeight: 600, color: 'var(--navy)' }}>
                        {loc.phone}
                      </a>
                      <a href={`mailto:${loc.email}`} style={{ color: 'var(--red)' }}>
                        {loc.email}
                      </a>
                    </div>
                  </li>
                ))}
              </ol>
            </div>

            {/* FORM */}
            <form className="lead-form" onSubmit={handleSubmit} noValidate>
              <div className="field-row">
                <div className={`field field-float ${errors.name ? 'is-invalid' : ''}`}>
                  <input
                    id="contact-name"
                    name="name"
                    type="text"
                    placeholder=" "
                    value={formData.name}
                    onChange={(e) => {
                      setFormData({ ...formData, name: e.target.value });
                      if (errors.name) setErrors({ ...errors, name: null });
                    }}
                    required
                  />
                  <label htmlFor="contact-name">Full name</label>
                  {errors.name && <p className="field-error">{errors.name}</p>}
                </div>

                <div className={`field field-float ${errors.email ? 'is-invalid' : ''}`}>
                  <input
                    id="contact-email"
                    name="email"
                    type="email"
                    placeholder=" "
                    value={formData.email}
                    onChange={(e) => {
                      setFormData({ ...formData, email: e.target.value });
                      if (errors.email) setErrors({ ...errors, email: null });
                    }}
                    required
                  />
                  <label htmlFor="contact-email">Business email</label>
                  {errors.email && <p className="field-error">{errors.email}</p>}
                </div>
              </div>

              <div className="field-row">
                <div className={`field field-float ${errors.phone ? 'is-invalid' : ''}`}>
                  <input
                    id="contact-phone"
                    name="phone"
                    type="tel"
                    maxLength="10"
                    placeholder=" "
                    value={formData.phone}
                    onChange={(e) => {
                      setFormData({ ...formData, phone: e.target.value });
                      if (errors.phone) setErrors({ ...errors, phone: null });
                    }}
                    required
                  />
                  <label htmlFor="contact-phone">Phone number</label>
                  {errors.phone && <p className="field-error">{errors.phone}</p>}
                </div>

                <div className="field field-float">
                  <input
                    id="contact-company"
                    name="company"
                    type="text"
                    placeholder=" "
                    value={formData.company}
                    onChange={(e) => setFormData({ ...formData, company: e.target.value })}
                  />
                  <label htmlFor="contact-company">Company or website</label>
                </div>
              </div>

              <ModernDropdown
                options={SERVICE_OPTIONS}
                selected={formData.services}
                onChange={(selected) => {
                  setFormData({ ...formData, services: selected });
                  if (errors.services) setErrors({ ...errors, services: null });
                }}
                error={errors.services}
              />

              <div className={`field field-float field-textarea ${errors.message ? 'is-invalid' : ''}`}>
                <textarea
                  id="contact-requirements"
                  name="message"
                  rows="4"
                  placeholder=" "
                  value={formData.message}
                  onChange={(e) => {
                    setFormData({ ...formData, message: e.target.value });
                    if (errors.message) setErrors({ ...errors, message: null });
                  }}
                  required
                ></textarea>
                <label htmlFor="contact-requirements">Project requirements</label>
                {errors.message && <p className="field-error">{errors.message}</p>}
              </div>

              <button className="lead-submit" type="submit" disabled={isSubmitting}>
                <span>{isSubmitting ? 'Sending…' : 'Send enquiry'}</span>
                <span className="lead-submit-arrow" aria-hidden="true">
                  <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" strokeWidth="1.9" strokeLinecap="round" strokeLinejoin="round"/></svg>
                </span>
              </button>

              {status.message && (
                <p className={`form-status is-${status.type}`} role="status">
                  {status.message}
                </p>
              )}
            </form>
          </div>
        </section>
      </main>
    </>
  );
}
