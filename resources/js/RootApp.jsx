import React, { useState, useEffect } from 'react';
import { Routes, Route, useLocation } from 'react-router-dom';
import Header from './components/layout/Header';
import Footer from './components/layout/Footer';
import StickyLeftCta from './components/layout/StickyLeftCta';
import LeadModal from './components/layout/LeadModal';

// Pages
import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import ServicesPage from './pages/ServicesPage';
import ServiceDetailPage from './pages/ServiceDetailPage';
import PortfolioPage from './pages/PortfolioPage';
import TestimonialsPage from './pages/TestimonialsPage';
import BlogPage from './pages/BlogPage';
import BlogDetailPage from './pages/BlogDetailPage';
import ContactPage from './pages/ContactPage';
import CareerPage from './pages/CareerPage';
import EventsPage from './pages/EventsPage';

export default function RootApp() {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const location = useLocation();

  // Scroll to top on every route transition
  useEffect(() => {
    window.scrollTo({ top: 0, left: 0, behavior: 'instant' });
  }, [location.pathname]);

  // Auto-open modal after 2.5 seconds on home page once per session
  useEffect(() => {
    if (location.pathname === '/' && !sessionStorage.getItem('smac_brief_prompted')) {
      const timer = setTimeout(() => {
        setIsModalOpen(true);
        sessionStorage.setItem('smac_brief_prompted', 'true');
      }, 2500);
      return () => clearTimeout(timer);
    }
  }, [location.pathname]);

  const handleOpenModal = () => setIsModalOpen(true);
  const handleCloseModal = () => setIsModalOpen(false);

  return (
    <div className="site-wrapper">
      <a className="skip-link" href="#main">Skip to content</a>

      <Header onOpenLeadModal={handleOpenModal} />

      <Routes>
        <Route path="/" element={<HomePage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/about-us" element={<AboutPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/services" element={<ServicesPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/services/:slug" element={<ServiceDetailPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/portfolios" element={<PortfolioPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/testimonials" element={<TestimonialsPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/blog" element={<BlogPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/blogs" element={<BlogPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/blogs/:slug" element={<BlogDetailPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/contact" element={<ContactPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/contact-us" element={<ContactPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/career" element={<CareerPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/careers" element={<CareerPage onOpenLeadModal={handleOpenModal} />} />
        <Route path="/events" element={<EventsPage onOpenLeadModal={handleOpenModal} />} />
        {/* Fallback */}
        <Route path="*" element={<HomePage onOpenLeadModal={handleOpenModal} />} />
      </Routes>

      <Footer />

      <StickyLeftCta onOpen={handleOpenModal} />
      <LeadModal isOpen={isModalOpen} onClose={handleCloseModal} />
    </div>
  );
}
