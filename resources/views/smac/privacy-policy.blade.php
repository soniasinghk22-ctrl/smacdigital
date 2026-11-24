@extends('smac.layout')

@section('title', $page->metatitle ?? 'Privacy Policy | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Read the Privacy Policy of SMAC Digital to understand how we collect, use, store, and protect your personal and business information.')
@section('meta_keywords', $page->metakeywords ?? 'Privacy Policy, SMAC Digital Privacy, Terms and Privacy')

@section('content')
<section class="hero inner-hero" aria-labelledby="policy-hero-title">
  <div class="hero-stage" aria-hidden="true">
    <div class="hero-grid"></div>
  </div>
  <div class="wrap hero-copy">
    <p class="pill">Legal</p>
    <h1 id="policy-hero-title">
      <span>Privacy</span><br>
      <em>Policy.</em>
    </h1>
    <p class="lede">Last Updated: November 24, 2026</p>
    <div class="hero-actions">
      <a class="btn btn-white" href="{{ url('/contact') }}">Contact our team</a>
      <span class="or" aria-hidden="true">or</span>
      <a class="btn btn-black" href="{{ url('/') }}">Back to home</a>
    </div>
  </div>
</section>

<section class="page-section privacy-policy-section">
  <div class="wrap">
    <div class="privacy-policy-body">
      @if(!empty($page->description))
        {!! $page->description !!}
      @else
        <p><strong>Last Updated:</strong> November 24, 2026</p>

        <h2>1. Introduction</h2>
        <p>Welcome to SMAC Digital. We respect your privacy and are committed to protecting your personal and business information. This Privacy Policy explains how SMAC Digital collects, uses, stores, processes and protects your information when you visit our website, submit an enquiry, request a consultation or use our digital marketing, website development and related services.</p>
        <p>By accessing or using our website and services, you agree to the practices described in this Privacy Policy.</p>

        <h2>2. Information We Collect</h2>
        <p>We may collect the following types of information when you interact with our website or services.</p>

        <h3>Personal Information</h3>
        <ul>
          <li>Full name.</li>
          <li>Phone number and mobile number.</li>
          <li>Email address.</li>
          <li>Company or organization name.</li>
          <li>Business address.</li>
          <li>Job title or designation.</li>
          <li>Any other information you voluntarily provide through our enquiry forms or communication channels.</li>
        </ul>

        <h3>Business and Project Information</h3>
        <p>When you enquire about our services or work with us, we may collect:</p>
        <ul>
          <li>Business requirements and project details.</li>
          <li>Website URLs and business information.</li>
          <li>Marketing objectives and campaign requirements.</li>
          <li>Budget and project timelines.</li>
          <li>Branding, product and service information.</li>
          <li>Information and materials shared for website development, digital marketing or other projects.</li>
        </ul>

        <h3>Technical and Website Information</h3>
        <p>When you visit our website, we may automatically collect certain technical information, including:</p>
        <ul>
          <li>IP address.</li>
          <li>Browser type and version.</li>
          <li>Device type and operating system.</li>
          <li>Pages visited and time spent on our website.</li>
          <li>Referral sources and browsing behaviour.</li>
          <li>Cookies and similar tracking technologies.</li>
          <li>Website traffic and analytics information.</li>
        </ul>

        <h2>3. How We Use Your Information</h2>
        <p>We may use the collected information for the following purposes:</p>
        <ul>
          <li>To respond to enquiries and consultation requests.</li>
          <li>To understand your business requirements and recommend suitable services.</li>
          <li>To provide digital marketing, SEO, social media marketing, lead generation and website development services.</li>
          <li>To prepare proposals, quotations and project plans.</li>
          <li>To communicate regarding projects, services, deliverables and support.</li>
          <li>To manage client relationships and provide customer assistance.</li>
          <li>To improve our website, services and user experience.</li>
          <li>To analyse website traffic, marketing performance and user engagement.</li>
          <li>To send relevant business updates, service information and promotional communications, where permitted.</li>
          <li>To maintain business records and comply with applicable legal obligations.</li>
          <li>To protect our website and business against unauthorized access, fraud and security risks.</li>
        </ul>

        <h2>4. Sharing of Information</h2>
        <p>We do not sell or rent your personal information to third parties.</p>
        <p>However, we may share relevant information with trusted third-party service providers when necessary to operate our business and deliver our services, including:</p>
        <ul>
          <li>Website hosting and server providers.</li>
          <li>Cloud storage and technology service providers.</li>
          <li>Email and communication service providers.</li>
          <li>Digital advertising and marketing platforms.</li>
          <li>Website analytics and performance monitoring providers.</li>
          <li>Project management and customer relationship management (CRM) platforms.</li>
          <li>Payment processing providers, where applicable.</li>
          <li>Legal, professional or regulatory authorities when required by applicable law.</li>
        </ul>
        <p>We share information only to the extent necessary for the relevant business purpose, subject to applicable privacy and data protection requirements.</p>

        <h2>5. Cookies and Tracking Technologies</h2>
        <p>Our website may use cookies, analytics tools and similar technologies to improve website functionality and understand visitor behaviour.</p>
        <p>These technologies may help us:</p>
        <ul>
          <li>Analyse website traffic and visitor activity.</li>
          <li>Understand how users interact with our website.</li>
          <li>Improve website performance and usability.</li>
          <li>Remember user preferences.</li>
          <li>Measure marketing and advertising performance.</li>
          <li>Improve our digital marketing strategies.</li>
        </ul>
        <p>You can manage or disable cookies through your browser settings. Please note that disabling certain cookies may affect some website functionalities.</p>

        <h2>6. Data Security</h2>
        <p>We take reasonable technical, administrative and organizational measures to protect your personal and business information from unauthorized access, misuse, loss, alteration, disclosure or destruction.</p>
        <p>We aim to maintain appropriate safeguards when handling information shared through our website and business communication channels.</p>
        <p>However, no method of electronic transmission or data storage is completely secure. Therefore, we cannot guarantee absolute security of information transmitted over the internet.</p>

        <h2>7. Data Retention</h2>
        <p>We retain personal and business information only for as long as necessary to fulfil the purposes for which it was collected, provide our services, manage client relationships, maintain business records, resolve disputes and comply with applicable legal obligations.</p>
        <p>When information is no longer required, we may delete, anonymize or securely dispose of it, subject to applicable laws and contractual requirements.</p>

        <h2>8. Your Privacy Rights</h2>
        <p>Subject to applicable laws, you may have the right to:</p>
        <ul>
          <li>Request access to your personal information held by us.</li>
          <li>Request correction or updating of inaccurate information.</li>
          <li>Request deletion of your personal information, where applicable.</li>
          <li>Withdraw consent for processing activities based on consent.</li>
          <li>Opt out of promotional or marketing communications.</li>
          <li>Raise concerns regarding the collection, use or sharing of your personal information.</li>
        </ul>
        <p>You may contact us to exercise your applicable privacy rights. We will review and respond to requests in accordance with applicable laws.</p>

        <h2>9. Third-Party Websites and Services</h2>
        <p>Our website may contain links to third-party websites, social media platforms, advertising platforms and external services.</p>
        <p>These third-party websites operate independently and may have their own privacy policies and practices.</p>
        <p>SMAC Digital is not responsible for the privacy practices, content or security of third-party websites. We encourage you to review their respective privacy policies before sharing any personal information.</p>

        <h2>10. Client Information and Confidentiality</h2>
        <p>We understand the importance of protecting our clients' business information, project details, marketing strategies and other confidential materials.</p>
        <p>We use client information only for relevant business purposes, including project execution, communication, support and service delivery.</p>
        <p>We do not publicly disclose confidential client information without appropriate authorization, except where disclosure is required by applicable law or permitted under an applicable agreement.</p>
        <p>Any use of client names, logos, testimonials, case studies or project information for promotional purposes will be subject to applicable permissions and agreements.</p>

        <h2>11. Communication and Marketing</h2>
        <p>When you submit an enquiry, request a consultation or contact SMAC Digital, you may receive communications related to your enquiry, requested services, project updates or business requirements.</p>
        <p>We may also send relevant promotional updates or service-related information where permitted by applicable laws.</p>
        <p>You may request to stop receiving promotional communications at any time by contacting us or using the unsubscribe option where available.</p>

        <h2>12. Children's Privacy</h2>
        <p>Our website and services are intended for businesses, organizations and individuals seeking professional digital marketing and technology services.</p>
        <p>We do not knowingly collect personal information from children in violation of applicable laws. If we become aware that such information has been collected inappropriately, we will take reasonable steps to address the matter in accordance with applicable laws.</p>

        <h2>13. Changes to This Privacy Policy</h2>
        <p>SMAC Digital reserves the right to update or modify this Privacy Policy from time to time to reflect changes in our business practices, website functionality, services or applicable legal requirements.</p>
        <p>Any changes will be published on this page along with the revised date. We encourage visitors to review this Privacy Policy periodically.</p>

        <h2>14. Contact Us</h2>
        <p>If you have any questions, concerns or requests regarding this Privacy Policy or the way we handle your personal information, please contact us using the details below:</p>

        <div class="privacy-contact-block">
          <p><strong>SMAC Digital</strong><br>
          Website: <a href="https://www.smacdigital.com/" target="_blank" rel="noopener noreferrer">https://www.smacdigital.com/</a></p>

          <div class="privacy-office-grid">
            <div class="privacy-office-card">
              <h3>Jaipur Office</h3>
              <p>Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur, Rajasthan 302020</p>
              <p><strong>Phone:</strong> <a href="tel:+919829069519">+91 98290 69519</a></p>
              <p><strong>Email:</strong> <a href="mailto:Jitendra@smacdigital.com">Jitendra@smacdigital.com</a></p>
            </div>

            <div class="privacy-office-card">
              <h3>Kolkata Office</h3>
              <p>Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</p>
              <p><strong>Phone:</strong> <a href="tel:+919831132254">+91 98311 32254</a></p>
              <p><strong>Email:</strong> <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a></p>
            </div>

            <div class="privacy-office-card">
              <h3>Pune Office</h3>
              <p><strong>Phone:</strong> <a href="tel:+919582792638">+91 95827 92638</a></p>
              <p><strong>Email:</strong> <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a></p>
            </div>

            <div class="privacy-office-card">
              <h3>United States Office</h3>
              <p>1507 E Flower Street, Gilbert, AZ 85298, USA</p>
              <p><strong>Email:</strong> <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a></p>
            </div>
          </div>
        </div>

        <p>We will make reasonable efforts to address your privacy-related queries and concerns in a timely manner.</p>
      @endif
    </div>
  </div>
</section>
@endsection
