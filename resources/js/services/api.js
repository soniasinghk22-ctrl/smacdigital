import servicesData from '../data/servicesData.json';
import blogsData from '../data/blogsData.json';
import { portfolioData, testimonialsData, locationsData, teamData } from '../data/siteData';

const API_BASE = '/api';

export const api = {
  // Fetch global site settings (site name, logo, phones, emails, addresses, social links)
  async getSettings() {
    try {
      const res = await fetch(`${API_BASE}/site-settings`);
      if (res.ok) {
        const json = await res.json();
        return json.data || json;
      }
    } catch (e) {
      console.warn('API getSettings error, falling back to local defaults', e);
    }
    return {
      site_name: 'SMAC Digital',
      site_tagline: 'Performance-driven digital marketing agency',
      email: 'Jitendra@smacdigital.com',
      phone: '+91-9829069519',
      whatsapp: '+919582792638',
      logo: '/assets/brand/logo-white.png',
      locations: locationsData,
      social: {
        facebook: 'https://www.facebook.com/smacdigi',
        twitter: 'https://twitter.com/DigitalSmac',
        linkedin: 'https://www.linkedin.com/company/smac-digital-pvt-ltd',
        instagram: 'https://www.instagram.com/smacdigital/'
      }
    };
  },

  // Fetch all services
  async getServices() {
    try {
      const res = await fetch(`${API_BASE}/services`);
      if (res.ok) {
        const json = await res.json();
        if (Array.isArray(json.data) && json.data.length > 0) return json.data;
      }
    } catch (e) {
      console.warn('API getServices error, falling back to local services data', e);
    }
    return servicesData;
  },

  // Fetch single service by slug
  async getServiceBySlug(slug) {
    try {
      const res = await fetch(`${API_BASE}/services/${slug}`);
      if (res.ok) {
        const json = await res.json();
        if (json.data) return json.data;
      }
    } catch (e) {
      console.warn(`API getServiceBySlug(${slug}) error, using local fallback`, e);
    }
    return servicesData.find(s => s.slug === slug) || null;
  },

  // Fetch blogs
  async getBlogs() {
    try {
      const res = await fetch(`${API_BASE}/blogs`);
      if (res.ok) {
        const json = await res.json();
        if (Array.isArray(json.data) && json.data.length > 0) return json.data;
      }
    } catch (e) {
      console.warn('API getBlogs error, using local blogs data', e);
    }
    return blogsData;
  },

  // Fetch single blog by slug
  async getBlogBySlug(slug) {
    try {
      const res = await fetch(`${API_BASE}/blogs/${slug}`);
      if (res.ok) {
        const json = await res.json();
        if (json.data) return json.data;
      }
    } catch (e) {
      console.warn(`API getBlogBySlug(${slug}) error, using local fallback`, e);
    }
    return blogsData.find(b => b.slug === slug) || null;
  },

  // Fetch testimonials
  async getTestimonials() {
    try {
      const res = await fetch(`${API_BASE}/testimonials`);
      if (res.ok) {
        const json = await res.json();
        if (Array.isArray(json.data) && json.data.length > 0) return json.data;
      }
    } catch (e) {
      console.warn('API getTestimonials error, using local data', e);
    }
    return testimonialsData;
  },

  // Fetch portfolio projects
  async getPortfolios() {
    try {
      const res = await fetch(`${API_BASE}/portfolios`);
      if (res.ok) {
        const json = await res.json();
        if (Array.isArray(json.data) && json.data.length > 0) return json.data;
      }
    } catch (e) {
      console.warn('API getPortfolios error, using local data', e);
    }
    return portfolioData;
  },

  // Submit lead / contact brief
  async submitLead(formData) {
    // CSRF token support if present
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const headers = {
      'Accept': 'application/json'
    };
    if (csrfToken) {
      headers['X-CSRF-TOKEN'] = csrfToken;
    }

    const res = await fetch(`${API_BASE}/leads/submit`, {
      method: 'POST',
      headers,
      body: formData
    });

    if (!res.ok) {
      const err = await res.json().catch(() => ({}));
      throw new Error(err.message || `Submission failed with status ${res.status}`);
    }

    return await res.json();
  }
};
