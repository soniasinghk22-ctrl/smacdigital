import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import SeoMeta from '../components/shared/SeoMeta';
import CtaBanner from '../components/shared/CtaBanner';
import { api } from '../services/api';

export default function ServiceDetailPage({ onOpenLeadModal }) {
  const { slug } = useParams();
  const [service, setService] = useState(null);
  const [allServices, setAllServices] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function loadData() {
      setLoading(true);
      window.scrollTo(0, 0);
      try {
        const [current, list] = await Promise.all([
          api.getServiceBySlug(slug),
          api.getServices()
        ]);
        setService(current);
        setAllServices(list);
      } finally {
        setLoading(false);
      }
    }
    loadData();
  }, [slug]);

  if (loading) {
    return (
      <div className="wrap" style={{ padding: '8rem 0', textAlign: 'center' }}>
        <p>Loading service details…</p>
      </div>
    );
  }

  if (!service) {
    return (
      <div className="wrap" style={{ padding: '8rem 0', textAlign: 'center' }}>
        <h2>Service Not Found</h2>
        <p>We could not find the service requested.</p>
        <Link className="btn btn-primary" to="/services">
          Browse All Services
        </Link>
      </div>
    );
  }

  const relatedServices = allServices.filter(s => s.slug !== slug).slice(0, 3);
  const isSeoPage = slug === 'search-engine-optimization';

  return (
    <>
      <SeoMeta
        title={`${service.title} | SMAC Digital Services`}
        description={service.lede || (service.intro && service.intro[0]) || `Explore professional ${service.title} services by SMAC Digital.`}
        canonical={`https://www.smacdigital.com/services/${service.slug}`}
      />

      <main id="main">
        {/* HERO */}
        <section className="hero inner-hero" aria-labelledby="svc-hero-title">
          <div className="hero-stage" aria-hidden="true">
            <div className="hero-grid"></div>
          </div>
          <div className="wrap hero-copy">
            <p className="pill">{service.title}</p>
            <h1 id="svc-hero-title">
              <span>{service.title.split(' ')[0]}</span><br />
              <em>{service.title.split(' ').slice(1).join(' ')}</em>
            </h1>
            <p className="lede">{service.lede}</p>
            <div className="hero-actions">
              <button type="button" className="btn btn-white" onClick={onOpenLeadModal}>
                Get a Quote
              </button>
              <span className="or" aria-hidden="true">or</span>
              <button type="button" className="btn btn-black" onClick={onOpenLeadModal}>
                Free consultation
              </button>
            </div>
          </div>
        </section>

        {/* SPECIALIZED SEO LANDING VIEW */}
        {isSeoPage ? (
          <>
            <section className="seo-lp-intro">
              <div className="wrap">
                <p className="page-eyebrow dark">Delhi NCR · India</p>
                <h2>SMAC Digital, The Best SEO Company In Delhi NCR</h2>
                <p className="seo-lp-lead">
                  There are many reasons why SMAC Digital is one of the best in providing SEO Services in Delhi NCR. Here are some reasons:
                </p>
                <div className="seo-lp-reason-grid">
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-experience.svg" alt="" width="52" height="52" loading="lazy" />
                    <h3>More Than 7 Years of Experience</h3>
                    <p>At SMAC Digital, we pride ourselves on over 7 years of dedicated experience in providing exceptional SEO services in Delhi NCR. We’ve helped businesses of all sizes improve their online visibility, increase website traffic, and drive organic growth.</p>
                  </article>
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-recognised.svg" alt="" width="52" height="52" loading="lazy"></img>
                    <h3>A Recognised Firm</h3>
                    <p>SMAC Digital is a recognized SEO company in Delhi NCR, known for delivering tailored digital solutions. Our expert team drives measurable results, ensuring your brand's visibility, engagement, and growth online.</p>
                  </article>
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-manager.svg" alt="" width="52" height="52" loading="lazy" />
                    <h3>Dedicated Project Manager</h3>
                    <p>At SMAC Digital, we assign a dedicated project manager to every client, ensuring personalized attention and seamless communication throughout your project. Your goals are our priority from start to finish.</p>
                  </article>
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-feedback.svg" alt="" width="52" height="52" loading="lazy" />
                    <h3>Positive Feedback</h3>
                    <p>At SMAC Digital, we take pride in delivering exceptional SEO services, and the positive feedback from our clients reflects our commitment to excellence. Their satisfaction fuels our dedication to growth.</p>
                  </article>
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-tools.svg" alt="" width="52" height="52" loading="lazy" />
                    <h3>Professional Tools Utilisation</h3>
                    <p>At SMAC Digital, we leverage cutting-edge professional SEO tools to deliver measurable results. Our team utilizes industry-leading software to optimize your website, improve rankings, and drive organic growth effectively.</p>
                  </article>
                  <article className="seo-lp-card">
                    <img src="/assets/seo-landing/icons/icon-support.svg" alt="" width="52" height="52" loading="lazy" />
                    <h3>360 Support Services</h3>
                    <p>At SMAC Digital, we offer 360 Support Services to ensure your SEO campaigns run smoothly. From strategy to implementation and continuous optimization, our expert team provides round-the-clock assistance.</p>
                  </article>
                </div>
                <div className="seo-lp-center-cta">
                  <button type="button" className="btn btn-navy" onClick={onOpenLeadModal}>
                    Get A Quote
                  </button>
                </div>
              </div>
            </section>

            <section className="seo-lp-results">
              <div className="seo-lp-results-pattern" aria-hidden="true"></div>
              <div className="wrap">
                <p className="page-eyebrow">Proven outcomes</p>
                <h2>Check Out Some Of Our SEO Results!</h2>
                <div className="seo-lp-stats">
                  <article className="seo-lp-stat">
                    <img src="/assets/seo-landing/icons/icon-stat-world.svg" alt="" width="64" height="64" loading="lazy" />
                    <strong>10%</strong>
                    <span>Countries Served</span>
                  </article>
                  <article className="seo-lp-stat">
                    <img src="/assets/seo-landing/icons/icon-stat-brands.svg" alt="" width="64" height="64" loading="lazy" />
                    <strong>100+</strong>
                    <span>Brands Created</span>
                  </article>
                  <article className="seo-lp-stat">
                    <img src="/assets/seo-landing/icons/icon-stat-campaigns.svg" alt="" width="64" height="64" loading="lazy" />
                    <strong>Over 300+</strong>
                    <span>Campaigns Delivered</span>
                  </article>
                  <article className="seo-lp-stat">
                    <img src="/assets/seo-landing/icons/icon-stat-rank.svg" alt="" width="64" height="64" loading="lazy" />
                    <strong>1,000+</strong>
                    <span>Keywords Ranked</span>
                  </article>
                </div>
              </div>
            </section>
          </>
        ) : null}

        {/* INTRO & MEDIA */}
        <section className="page-section">
          <div className="wrap about-vm-row">
            {service.image && (
              <div className="about-vm-media">
                <img
                  src={service.image.startsWith('/') ? service.image : `/${service.image}`}
                  alt={service.title}
                  width="720"
                  height="520"
                  loading="lazy"
                />
              </div>
            )}
            <div className="about-vm-copy">
              <p className="page-eyebrow dark">Overview</p>
              <h2>{service.title}</h2>
              {Array.isArray(service.intro) ? (
                service.intro.map((p, i) => <p key={i}>{p}</p>)
              ) : (
                <p>{service.lede}</p>
              )}
            </div>
          </div>
        </section>

        {/* PILLARS */}
        {service.pillars && service.pillars.length > 0 && (
          <section className="page-section page-section-tint">
            <div className="wrap">
              <p className="page-eyebrow dark">Core pillars</p>
              <h2>Our Strategic Pillars</h2>
              <div className="page-card-grid">
                {service.pillars.map((pill, idx) => (
                  <article key={idx} className="page-card">
                    <span className="about-step">{pill.k || `0${idx + 1}`}</span>
                    <h3>{pill.t}</h3>
                    <p>{pill.d}</p>
                  </article>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* DEEP-DIVE SECTIONS */}
        {service.sections && service.sections.length > 0 && (
          <section className="page-section">
            <div className="wrap">
              {service.sections.map((sec, idx) => (
                <div key={idx} style={{ marginBottom: '3rem' }}>
                  <h2>{sec.heading}</h2>
                  {sec.paragraphs?.map((p, pIdx) => (
                    <p key={pIdx} style={{ fontSize: '1.05rem', lineHeight: 1.7 }}>{p}</p>
                  ))}
                  {sec.bullets && (
                    <ul style={{ paddingLeft: '1.25rem', marginTop: '1rem', lineHeight: 1.8 }}>
                      {sec.bullets.map((b, bIdx) => (
                        <li key={bIdx} style={{ marginBottom: '0.75rem' }}>{b}</li>
                      ))}
                    </ul>
                  )}
                </div>
              ))}
            </div>
          </section>
        )}

        {/* WHY CHOOSE SMAC */}
        {service.why && service.why.length > 0 && (
          <section className="page-section page-section-tint">
            <div className="wrap">
              <p className="page-eyebrow dark">Why SMAC</p>
              <h2>{service.whyTitle || `Why Choose SMAC Digital for ${service.title}`}</h2>
              <div className="page-card-grid">
                {service.why.map((item, idx) => (
                  <article key={idx} className="page-card">
                    <h3>{item.title}</h3>
                    <p>{item.text}</p>
                  </article>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* PROCESS */}
        {service.process && service.process.length > 0 && (
          <section className="page-section">
            <div className="wrap">
              <p className="page-eyebrow dark">Methodology</p>
              <h2>Execution Process</h2>
              <div className="page-card-grid">
                {service.process.map((step, idx) => (
                  <article key={idx} className="page-card">
                    <span className="about-step">Step 0{idx + 1}</span>
                    <h3>{step.t}</h3>
                    <p>{step.d}</p>
                  </article>
                ))}
              </div>
            </div>
          </section>
        )}

        {/* RELATED SERVICES */}
        <section className="page-section page-section-tint">
          <div className="wrap">
            <header className="section-head">
              <p className="eyebrow">Explore More</p>
              <h2>Related Services</h2>
            </header>
            <div className="page-service-grid">
              {relatedServices.map((rel) => (
                <Link key={rel.slug} className="page-service-card" to={`/services/${rel.slug}`}>
                  <img
                    src={rel.image.startsWith('/') ? rel.image : `/${rel.image}`}
                    alt={rel.title}
                    width="640"
                    height="400"
                    loading="lazy"
                  />
                  <div>
                    <h2>{rel.title}</h2>
                    <p>{rel.lede || rel.intro?.[0]}</p>
                    <span>Explore →</span>
                  </div>
                </Link>
              ))}
            </div>
          </div>
        </section>

        {/* CTA */}
        <CtaBanner
          title={service.ctaTitle || `Ready to scale your ${service.title.toLowerCase()}?`}
          subtitle="Let's build the roadmap."
          onOpenLeadModal={onOpenLeadModal}
        />
      </main>
    </>
  );
}
