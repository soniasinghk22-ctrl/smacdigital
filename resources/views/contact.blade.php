@extends('layouts.app')

@section('title', ($contactPage->metatitle ?? 'Contact Premium Marble Showrooms | Stone Hub India'))
@section('meta_description', ($contactPage->metadescription ?? 'Contact Stone Hub India. Request a catalogue, chat with our stone experts, or locate our premium Italian marble showrooms in Kishangarh and Delhi.'))
@section('meta_keywords', ($contactPage->metakeywords ?? 'imported marble supplier kishangarh, italian marble showroom delhi, stone hub india contact'))

@section('schema')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@graph' }}": [
    {
      "{{ '@type' }}": "ContactPage",
      "{{ '@id' }}": "{{ route('contact') }}/#webpage",
      "url": "{{ route('contact') }}",
      "name": "Contact Premium Marble Showrooms | {{ $site['site_name'] ?? 'Stone Hub India' }}",
      "description": "Contact Stone Hub India. Request a catalogue, chat with our stone experts, or locate our premium Italian marble showrooms in Kishangarh and Delhi.",
      "isPartOf": {
        "{{ '@type' }}": "WebSite",
        "{{ '@id' }}": "{{ route('home') }}/#website"
      },
      "mainEntity": {
        "{{ '@type' }}": "Organization",
        "{{ '@id' }}": "{{ route('home') }}/#organization",
        "name": "{{ $site['site_name'] ?? 'Stone Hub India' }}",
        "url": "{{ route('home') }}"
      }
    }
  ]
}
</script>
@endsection

@section('content')
    @if(!empty($contactPage) && !empty($contactPage->description) && trim(strip_tags($contactPage->description)) !== '')
        <section class="section" style="padding: 6rem 0; background: #f4f2ed; color: #4a4a52;">
            <div class="container animate-on-scroll" style="max-width: 900px; margin: 0 auto;">
                <div class="blog-content" style="line-height: 1.8; font-size: 1.05rem; color: #4a4a52;">
                    {!! $contactPage->description !!}
                </div>
            </div>
        </section>
    @else

    <!-- Details Hero -->
    <section class="page-hero">
        <div class="page-hero-media">
            <img src="{{ asset('assets/images/pages/hero-contact.webp') }}" alt="Stone Hub India showroom enquiry" loading="eager">
        </div>
        <div class="page-hero-overlay"></div>
        <div class="page-hero-content">
            <span class="page-hero-eyebrow">CONNECT WITH OUR CURATORS</span>
            <h1>Contact Stone Hub India</h1>
            <p>Reach out to our stone experts for custom dimensions, pricing guides, or to schedule a private gallery inspection.</p>
        </div>
    </section>

    <!-- Contact Main Grid -->
    <section class="section" style="background: #f4f2ed;">
        <div class="container contact-grid animate-on-scroll">
            <div class="contact-info-list">
                <h2 style="color:#121214 !important;">Our Showrooms & Galleries</h2>
                <p class="text-muted" style="margin-bottom: 2rem; color:#5f5f68 !important;">Visit our premium yards to inspect standing slabs and pick the exact blocks that resonate with your architectural vision.</p>
                
                <div class="contact-info-item" style="align-items: flex-start;">
                    <div class="contact-info-icon" style="color: var(--accent-gold); margin-top: 5px;"><i data-lucide="map-pin"></i></div>
                    <div class="contact-info-content">
                        <h3 style="color:#121214 !important;">Locations</h3>
                        <div style="display: flex; flex-direction: column; gap: 15px;">
                            <div>
                                <strong style="color: #8a6d3b; display: block; margin-bottom: 2px;">Kishangarh Factory & Stockyard (Main)</strong>
                                <p style="margin: 0; line-height: 1.4; color: #5f5f68;">{{ $site['address'] ?? 'NH-8, Makrana Road, Industrial Area, Kishangarh, Rajasthan - 305801, India' }}</p>
                            </div>
                            <div style="border-top: 1px solid rgba(15,15,17,0.08); padding-top: 10px;">
                                <strong style="color: #8a6d3b; display: block; margin-bottom: 2px;">Delhi NCR Gallery</strong>
                                <p style="margin: 0; line-height: 1.4; color: #5f5f68;">Lajpat Nagar, Ring Road, New Delhi - 110024</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-info-item" style="align-items: flex-start;">
                    <div class="contact-info-icon" style="color: var(--accent-gold); margin-top: 5px;"><i data-lucide="phone"></i></div>
                    <div class="contact-info-content">
                        <h3 style="color:#121214 !important;">Phone Support</h3>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" style="color: #2f2f36; text-decoration: none; font-weight: 500;">{{ $site['phone'] ?? '+91 96727 77749' }}</a>
                            <a href="tel:{{ $site['phone_2'] ?? '+919672777744' }}" style="color: #2f2f36; text-decoration: none; font-weight: 500;">{{ $site['phone_2'] ?? '+91 96727 77744' }}</a>
                            <span style="font-size: 0.85rem; color: #666671;">(Showroom consultations & structural guidelines)</span>
                        </div>
                    </div>
                </div>
                
                <div class="contact-info-item">
                    <div class="contact-info-icon" style="color: var(--accent-gold);"><i data-lucide="mail"></i></div>
                    <div class="contact-info-content">
                        <h3 style="color:#121214 !important;">Email Inquiries</h3>
                        <p><a href="mailto:{{ $site['email'] ?? 'info@stonehubindia.com' }}" style="color:#2f2f36;">{{ $site['email'] ?? 'info@stonehubindia.com' }}</a></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon" style="background-color:#25d366; color:white;"><i data-lucide="message-circle"></i></div>
                    <div class="contact-info-content">
                        <h3 style="color:#121214 !important;">WhatsApp Gallery</h3>
                        <p><a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text=Hi%20Stone%20Hub%20India,%20I'd%20like%20to%20request%20a%20catalogue%20and%20price%20list." target="_blank" style="color:#2f2f36;">Chat with Curator Now</a> (Get slab photos via WhatsApp)</p>
                    </div>
                </div>
            </div>
            
            <div class="form-card" style="background: #fff; border: 1px solid rgba(15,15,17,0.07); box-shadow: 0 10px 28px rgba(15,15,17,0.05);">
                <h2 style="margin-bottom: 1.5rem; color: #121214 !important;">Request A Catalogue</h2>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source" value="Contact Page Form">
                    <div class="form-group">
                        <label for="c-name" style="color: #5f5f68;">Full Name</label>
                        <input type="text" id="c-name" name="name" class="form-control" placeholder="Enter your name" style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="c-phone" style="color: #5f5f68;">Phone Number</label>
                            <input type="tel" id="c-phone" name="phone" class="form-control" placeholder="10-digit number" pattern="[0-9]{10}" style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;" required>
                        </div>
                        <div class="form-group">
                            <label for="c-email" style="color: #5f5f68;">Email Address</label>
                            <input type="email" id="c-email" name="email" class="form-control" placeholder="Enter email" style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="c-dept" style="color: #5f5f68;">Preferred Marble Collection</label>
                            <select id="c-dept" name="service" class="form-control" style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;" required>
                                <option value="">-- Select --</option>
                                @forelse(($globalCollections ?? []) as $gcOpt)
                                    <option value="{{ $gcOpt->slug }}">{{ $gcOpt->name }}</option>
                                @empty
                                    <option value="bellezza">Bellezza</option>
                                    <option value="migliore">Migliore</option>
                                    <option value="forte">Forte</option>
                                    <option value="amore">Amore</option>
                                    <option value="spazio">Spazio</option>
                                    <option value="lontano">Lontano</option>
                                    <option value="giovane">Giovane</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="c-date" style="color: #5f5f68;">Preferred Visit / Contact Date</label>
                            <input type="date" id="c-date" name="appointment_date" class="form-control" style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="c-message" style="color: #5f5f68;">Project Details (Space, Estimated Sqft, Vein/Color Preference)</label>
                        <textarea id="c-message" name="message" class="form-control" rows="4" placeholder="Briefly specify your project details..." style="background: #f7f6f3; border-color: rgba(15,15,17,0.1); color: #151518;"></textarea>
                    </div>
                    
                    @if(!empty($site['recaptcha_enabled']) && $site['recaptcha_enabled'] == '1' && !empty($site['recaptcha_site_key']))
                        <div class="form-group" style="margin-bottom: 1.5rem; display: flex; justify-content: center;">
                            <div class="g-recaptcha" data-sitekey="{{ $site['recaptcha_site_key'] }}"></div>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Request Catalogue & Pricing</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Map Integration Section -->
    <section class="section" style="padding-top:0; background:#f4f2ed;">
        <div class="container animate-on-scroll">
            <div class="contact-map-box">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3571.2985392652156!2d74.8767744!3d26.5120612!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396be4219a16f2c7%3A0xe54fb3250b73c8d1!2sStone%20Hub%20India%20-%20Imported%20Marble%20in%20Kishangarh!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                    width="100%" height="450" style="border:0; border-radius: var(--radius-lg);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    @endif

@endsection
