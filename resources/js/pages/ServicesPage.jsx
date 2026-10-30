import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { api } from '../services/api';

export default function ServicesPage({ onOpenLeadModal }) {
  const [services, setServices] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function loadServices() {
      try {
        const data = await api.getServices();
        setServices(data);
      } finally {
        setLoading(false);
      }
    }
    loadServices();
  }, []);

  return (
    <>
      <SeoMeta
        title="Digital Marketing Services | SMAC Digital"
        description="Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system. Explore our 15 specialized marketing and tech services."
        canonical="https://www.smacdigital.com/services"
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="services-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">Services</p>
            <h1 id="services-hero-title">
              <span>Digital marketing</span><br />
              <em>services that ship.</em>
            </h1>
            <p className="lede">
              Pick a lane. We'll map the rest — SEO, social, content, and product builds planned as one growth system.
            </p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Start a brief
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Get a free consultation
              </button>
            </div>
          </div>
        </section>

        {/* SERVICES GRID */}
        <section className="page-section">
          <div className="wrap page-service-grid">
            {services.map((svc) => (
              <Link key={svc.slug} className="page-service-card" to={`/services/${svc.slug}`}>
                <img
                  src={svc.image.startsWith('/') ? svc.image : `/${svc.image}`}
                  alt={svc.title}
                  width="640"
                  height="400"
                  loading="lazy"
                />
                <div>
                  <h2>{svc.title}</h2>
                  <p>{svc.lede || svc.intro?.[0]}</p>
                  <span>Explore →</span>
                </div>
              </Link>
            ))}
          </div>
        </section>

        {/* CTA BANNER */}
        <CtaBanner
          title="Ready to choose your growth stack?"
          subtitle="Let’s plan the blueprint."
          text="Discuss your current bottlenecks with experienced digital marketers and get a customized proposal."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
