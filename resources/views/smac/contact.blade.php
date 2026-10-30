@extends('smac.layout')

@section('title', $page->metatitle ?? 'Contact Us | SMAC Digital Agency Jaipur, Pune, Kolkata')
@section('meta_description', $page->metadescription ?? 'Get in touch with SMAC Digital. Offices in Jaipur, Kolkata, Pune, and Gilbert, AZ. Send a brief or call our team directly.')
@section('meta_keywords', $page->metakeywords ?? 'Contact SMAC Digital, Marketing Agency Office, Start a Project')

@section('content')

    <section class="hero inner-hero contact-page-hero" aria-labelledby="contact-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Contact</p>
        <h1 id="contact-hero-title">
          <span>Let’s map your next</span><br>
          <em>growth move.</em>
        </h1>
        <p class="lede">Offices in Jaipur, Kolkata, Pune, and the US. Send a brief — we’ll reply with clear next steps.</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="#enquiry">Send an enquiry</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="#map">View on map</a>
        </div>
      </div>
    </section>

    <section class="contact-map" id="map" aria-label="SMAC Digital on Google Maps">
      <div class="contact-map-frame">
        <iframe
          title="SMAC Digital Jaipur office on Google Maps"
          src="https://www.google.com/maps?q=Anukampa+Point,+116/230,+Shipra+Path,+Mansarovar,+Jaipur,+Rajasthan+302020&amp;z=16&amp;output=embed"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          allowfullscreen></iframe>
      </div>
      <div class="contact-map-bar">
        <div class="wrap contact-map-bar-inner">
          <div>
            <p class="contact-map-kicker">Headquarters</p>
            <p class="contact-map-title">Anukampa Point, Mansarovar · Jaipur</p>
          </div>
          <a class="btn btn-white" href="https://www.google.com/maps/dir/?api=1&amp;destination=Anukampa+Point,+116/230,+Shipra+Path,+Mansarovar,+Jaipur,+Rajasthan+302020" target="_blank" rel="noopener noreferrer">Get directions</a>
        </div>
      </div>
    </section>

    <section class="contact-studio" id="enquiry" aria-labelledby="enquiry-title">
      <div class="contact-studio-glow" aria-hidden="true"></div>
      <div class="wrap contact-studio-grid">
        <div class="contact-studio-copy">
          <p class="contact-eyebrow">Enquiry</p>
          <h2 id="enquiry-title">Tell us what you’re building.<em> We’ll shape the plan.</em></h2>
          <p class="contact-studio-lead">Share goals, timelines, and the channels that matter. The form posts to our lead desk — you’ll see a confirmation once it’s accepted.</p>

          <div class="contact-quick" aria-label="Quick contact">
            <a class="contact-chip" href="tel:+919829069519">
              <span class="contact-chip-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7.5 3.5h3.2l1 4.2-2 1.2a12.5 12.5 0 0 0 5.4 5.4l1.2-2 4.2 1v3.2a2 2 0 0 1-2.2 2A15.5 15.5 0 0 1 3.5 5.7a2 2 0 0 1 2-2.2Z" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></span>
              Call Jaipur
            </a>
            <a class="contact-chip" href="mailto:Jitendra@smacdigital.com">
              <span class="contact-chip-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 6.5h16v11H4Zm0 0 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg></span>
              Email
            </a>
            <a class="contact-chip contact-chip-accent" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
              <span class="contact-chip-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.5a8.2 8.2 0 0 0-7 12.5L4 20.5l4.6-1.2A8.2 8.2 0 1 0 12 3.5Zm-3.2 5.3c.2-.5.4-.5.7-.5h.5c.2 0 .4 0 .5.4l.7 1.7c.1.2 0 .4-.1.6l-.4.5c-.1.2-.1.4.1.7a6.8 6.8 0 0 0 2 2c.3.2.5.2.7.1l.6-.4c.2-.1.4-.1.6 0l1.6.8c.3.2.4.3.4.5v.5c0 .3 0 .5-.3.7a3.3 3.3 0 0 1-1.6.6c-.9 0-3.1-.4-5.1-2.3-1.8-1.7-2.4-3.6-2.5-4.2 0-.5.2-1 .4-1.3Z" fill="currentColor"/></svg></span>
              WhatsApp
            </a>
          </div>

          <ol class="contact-places" aria-label="Office addresses">
            <li class="contact-place">
              <span class="contact-place-pin" aria-hidden="true">01</span>
              <div>
                <h3>Jaipur</h3>
                <p class="contact-place-role">Jitendra Swami · Business enquiries</p>
                <p>Anukampa Point, 116/230, 2nd Floor, Shipra Path, Mansarovar, Jaipur 302020</p>
                <a href="tel:+919829069519">+91 98290 69519</a>
                <a href="mailto:Jitendra@smacdigital.com">Jitendra@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-place">
              <span class="contact-place-pin" aria-hidden="true">02</span>
              <div>
                <h3>Kolkata</h3>
                <p class="contact-place-role">Deep Chakravarty · Business enquiries</p>
                <p>Hari Kripa, 422 Satyajit Kanan Rd, Barakhola, Mukundapur, Kolkata 700099</p>
                <a href="tel:+919831132254">+91 98311 32254</a>
                <a href="mailto:deep@smacdigital.com">deep@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-place">
              <span class="contact-place-pin" aria-hidden="true">03</span>
              <div>
                <h3>Pune</h3>
                <p class="contact-place-role">Rahul Swami</p>
                <a href="tel:+919582792638">+91 95827 92638</a>
                <a href="mailto:rahul@smacdigital.com">rahul@smacdigital.com</a>
              </div>
            </li>
            <li class="contact-place">
              <span class="contact-place-pin" aria-hidden="true">04</span>
              <div>
                <h3>United States</h3>
                <p>1507 E Flower Street, Gilbert AZ 85298</p>
              </div>
            </li>
          </ol>
        </div>

        <form class="lead-form" id="lead-form" method="post" action="{{ url('/save-lead') }}" novalidate>
          @csrf
          <div class="lead-form-top">
            <p class="lead-form-kicker">Start a brief</p>
            <h3 class="lead-form-title">Share a few details. We’ll reply with a clear next step.</h3>
          </div>

          <input type="hidden" name="landing_url" value="">
          <input type="hidden" name="referrer_url" value="">
          <input type="hidden" name="utm_source" value="">
          <input type="hidden" name="utm_medium" value="">
          <input type="hidden" name="utm_campaign" value="">
          <input type="hidden" name="utm_term" value="">
          <input type="hidden" name="utm_content" value="">
          <input type="hidden" name="utm_id" value="">
          <input type="hidden" name="gclid" value="">
          <input type="hidden" name="fbclid" value="">

          <div class="field field-float">
            <input id="full-name" name="name" type="text" autocomplete="name" placeholder=" " required>
            <label for="full-name">Full name</label>
            <p class="field-error" id="full-name-error" hidden></p>
          </div>
          <div class="field field-float">
            <input id="email" name="email" type="email" autocomplete="email" placeholder=" " required>
            <label for="email">Business email</label>
            <p class="field-error" id="email-error" hidden></p>
          </div>
          <div class="field-row">
            <div class="field field-float">
              <input id="phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel" maxlength="10" placeholder=" " required>
              <label for="phone">Phone number</label>
              <p class="field-error" id="phone-error" hidden></p>
            </div>
            <div class="field field-float">
              <input id="company" name="company" type="text" autocomplete="organization" placeholder=" ">
              <label for="company">Company or website</label>
              <p class="field-error" id="company-error" hidden></p>
            </div>
          </div>
          <fieldset class="field field-services">
            <legend>Services of interest</legend>
            <div class="checks">
              <label class="service-pill"><input type="checkbox" name="service" value="Marketing Automation"><span>Marketing automation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Inbound Marketing"><span>Inbound</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Social Media Marketing"><span>Social media</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Search Engine Optimization"><span>SEO</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Video Marketing"><span>Video</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Website Design and Development"><span>Website</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Mobile Application Development"><span>Mobile app</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Digital Media Planning"><span>Media planning</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Lead Generation"><span>Lead generation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Content Marketing"><span>Content</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Online Reputation Management"><span>Reputation</span></label>
              <label class="service-pill"><input type="checkbox" name="service" value="Social Media Analytics"><span>Analytics</span></label>
            </div>
            <p class="field-error" id="service-error" hidden></p>
          </fieldset>
          <div class="field field-float field-textarea">
            <textarea id="requirements" name="message" rows="4" placeholder=" " required></textarea>
            <label for="requirements">Project requirements</label>
            <p class="field-error" id="requirements-error" hidden></p>
          </div>
          <button class="lead-submit" type="submit" data-submit>
            <span>Get a free consultation</span>
            <span class="lead-submit-arrow" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M5 12h12M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
          </button>
          <p class="form-status" id="form-status" role="status" aria-live="polite"></p>
        </form>
      </div>
    </section>
  
@endsection
