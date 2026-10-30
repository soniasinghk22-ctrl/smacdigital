import React, { useState, useEffect } from 'react';
import ModernDropdown from '../ui/ModernDropdown';
import { api } from '../../services/api';

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

export default function LeadModal({ isOpen, onClose }) {
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

  useEffect(() => {
    function handleKeyDown(e) {
      if (e.key === 'Escape' && isOpen) {
        onClose();
      }
    }
    window.addEventListener('keydown', handleKeyDown);
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [isOpen, onClose]);

  // Prevent scroll when modal is open
  useEffect(() => {
    if (isOpen) {
      document.body.classList.add('modal-open');
    } else {
      document.body.classList.remove('modal-open');
    }
    return () => document.body.classList.remove('modal-open');
  }, [isOpen]);

  if (!isOpen) return null;

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
    setStatus({ type: '', message: '' });

    if (!validate()) return;

    setIsSubmitting(true);

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

      // Capture UTMs
      const searchParams = new URLSearchParams(window.location.search);
      ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'utm_id', 'gclid', 'fbclid'].forEach(key => {
        const val = searchParams.get(key);
        if (val) data.append(key, val);
      });

      await api.submitLead(data);

      setStatus({
        type: 'success',
        message: 'Request received! The SMAC Digital team has your brief and will reply shortly.'
      });

      setFormData({
        name: '',
        email: '',
        phone: '',
        company: '',
        services: [],
        message: ''
      });
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
    <div className="lead-modal is-open" id="lead-modal" role="dialog" aria-modal="true" aria-labelledby="modal-form-title">
      <div className="lead-modal-backdrop" onClick={onClose}></div>
      <div className="lead-modal-card">
        <div className="lead-modal-head">
          <button className="lead-modal-close" type="button" onClick={onClose} aria-label="Close brief modal">
            <svg viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" fill="none" stroke="currentColor" strokeWidth="2.2" strokeLinecap="round" strokeLinejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
          <p className="lead-form-kicker">START A BRIEF</p>
          <h3 className="lead-form-title" id="modal-form-title">Share a few details. We’ll reply with a clear next step.</h3>
        </div>

        <form className="modal-lead-form" onSubmit={handleSubmit} noValidate>
          <div className="field-row">
            <div className={`field field-float ${errors.name ? 'is-invalid' : ''}`}>
              <input
                id="modal-name"
                name="name"
                type="text"
                autoComplete="name"
                placeholder=" "
                value={formData.name}
                onChange={(e) => {
                  setFormData({ ...formData, name: e.target.value });
                  if (errors.name) setErrors({ ...errors, name: null });
                }}
                required
              />
              <label htmlFor="modal-name">Full name</label>
              {errors.name && <p className="field-error">{errors.name}</p>}
            </div>

            <div className={`field field-float ${errors.email ? 'is-invalid' : ''}`}>
              <input
                id="modal-email"
                name="email"
                type="email"
                autoComplete="email"
                placeholder=" "
                value={formData.email}
                onChange={(e) => {
                  setFormData({ ...formData, email: e.target.value });
                  if (errors.email) setErrors({ ...errors, email: null });
                }}
                required
              />
              <label htmlFor="modal-email">Business email</label>
              {errors.email && <p className="field-error">{errors.email}</p>}
            </div>
          </div>

          <div className="field-row">
            <div className={`field field-float ${errors.phone ? 'is-invalid' : ''}`}>
              <input
                id="modal-phone"
                name="phone"
                type="tel"
                inputMode="numeric"
                autoComplete="tel"
                maxLength="10"
                placeholder=" "
                value={formData.phone}
                onChange={(e) => {
                  setFormData({ ...formData, phone: e.target.value });
                  if (errors.phone) setErrors({ ...errors, phone: null });
                }}
                required
              />
              <label htmlFor="modal-phone">Phone number</label>
              {errors.phone && <p className="field-error">{errors.phone}</p>}
            </div>

            <div className="field field-float">
              <input
                id="modal-company"
                name="company"
                type="text"
                autoComplete="organization"
                placeholder=" "
                value={formData.company}
                onChange={(e) => setFormData({ ...formData, company: e.target.value })}
              />
              <label htmlFor="modal-company">Company or website</label>
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
              id="modal-requirements"
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
            <label htmlFor="modal-requirements">Project requirements</label>
            {errors.message && <p className="field-error">{errors.message}</p>}
          </div>

          <button className="lead-submit" type="submit" disabled={isSubmitting}>
            <span>{isSubmitting ? 'Sending…' : 'Get a free consultation'}</span>
            <span className="lead-submit-arrow" aria-hidden="true">
              <svg viewBox="0 0 24 24">
                <path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" strokeWidth="1.9" strokeLinecap="round" strokeLinejoin="round" />
              </svg>
            </span>
          </button>

          {status.message && (
            <p className={`form-status is-${status.type}`} role="status" aria-live="polite">
              {status.message}
            </p>
          )}
        </form>
      </div>
    </div>
  );
}
