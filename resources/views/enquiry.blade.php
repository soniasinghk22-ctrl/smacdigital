@extends('layouts.app')

@section('title', $enquiryPage->metatitle ?? 'Request a Project Quotation & Sourcing | Stone Hub India')
@section('meta_description', $enquiryPage->metadescription ?? 'Request custom price quotes, slab estimation, and BOQ consultation for imported Italian marble, exotic quartzite, and travertine from Stone Hub India Kishangarh.')
@section('meta_keywords', $enquiryPage->metakeywords ?? 'marble enquiry, italian marble quote, marble price per sq ft, buy italian marble kishangarh, stone hub india quotation')

@section('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'ContactPage',
      '@id' => route('enquiry') . '/#webpage',
      'url' => route('enquiry'),
      'name' => 'Project Marble Quotation & Sourcing | ' . ($site['site_name'] ?? 'Stone Hub India'),
      'description' => 'Request direct quarry quotes, block inspections, and quantity estimation for luxury natural stones.',
      'isPartOf' => [
        '@type' => 'WebSite',
        '@id' => route('home') . '/#website'
      ]
    ]
  ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('styles')
<style>
    /* Enquiry Portal Styles */
    .enquiry-hero {
        position: relative;
        min-height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5rem 1.5rem 3.5rem;
        background: #0b0b0d;
        overflow: hidden;
    }
    .enquiry-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.35;
    }
    .enquiry-hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(15,15,17,0.5) 0%, rgba(11,11,13,0.95) 100%);
    }
    .enquiry-hero-content {
        position: relative;
        z-index: 2;
        max-width: 860px;
        margin: 0 auto;
    }
    .enquiry-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(197, 168, 128, 0.12);
        border: 1px solid rgba(197, 168, 128, 0.35);
        border-radius: 999px;
        color: var(--accent-gold, #C5A880);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }
    .enquiry-hero h1 {
        font-size: clamp(2.2rem, 4.2vw, 3.4rem);
        color: #ffffff !important;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Outfit', sans-serif;
    }
    .enquiry-hero p {
        font-size: clamp(1rem, 1.6vw, 1.15rem);
        color: rgba(255,255,255,0.82);
        max-width: 720px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Form Container Grid */
    .enquiry-section {
        padding: 4rem 0 6rem;
        background: #f5f4ef;
    }
    .enquiry-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 2.5rem;
        align-items: start;
    }
    @media (max-width: 960px) {
        .enquiry-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Main Form Card */
    .enquiry-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.75rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 12px 35px rgba(0,0,0,0.04);
    }
    @media (max-width: 640px) {
        .enquiry-card {
            padding: 1.75rem 1.25rem;
        }
    }

    .form-step-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.25rem;
        color: #121214 !important;
        font-weight: 700;
        margin: 2rem 0 1.25rem 0;
        padding-bottom: 0.6rem;
        border-bottom: 1px solid rgba(15,15,17,0.06);
    }
    .form-step-title:first-of-type {
        margin-top: 0;
    }
    .form-step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #151518;
        color: var(--accent-gold, #C5A880);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        font-weight: 700;
    }

    /* Multi-select Pills & Checkboxes */
    .pill-checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 1.25rem;
    }
    .pill-checkbox-item {
        position: relative;
        cursor: pointer;
    }
    .pill-checkbox-item input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .pill-checkbox-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.55rem 1.1rem;
        background: #f7f6f2;
        border: 1px solid rgba(15,15,17,0.1);
        border-radius: 999px;
        font-size: 0.88rem;
        font-weight: 600;
        color: #3f3f46;
        transition: all 0.2s ease;
        user-select: none;
    }
    .pill-checkbox-item input:checked + .pill-checkbox-label {
        background: #151518;
        color: #ffffff;
        border-color: var(--accent-gold, #C5A880);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .pill-checkbox-label i {
        width: 14px;
        height: 14px;
        color: var(--accent-gold, #C5A880);
    }

    /* Sidebar Trust & Contact Card */
    .sidebar-sticky {
        position: sticky;
        top: 90px;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .summary-card {
        background: #151518;
        color: #ffffff;
        border-radius: 18px;
        padding: 2.25rem;
        border: 1px solid rgba(197, 168, 128, 0.25);
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    }
    .summary-card h3 {
        color: #ffffff !important;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.25rem;
        font-family: 'Outfit', sans-serif;
    }
    .direct-help-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 2rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }
</style>
@endsection

@section('content')

    <!-- Hero Header -->
    <section class="enquiry-hero">
        <img src="{{ asset('uploads/collection/imported_marble_grand_foyer.jpg') }}" alt="Stone Hub India Project Marble Enquiry" class="enquiry-hero-bg">
        <div class="enquiry-hero-overlay"></div>
        <div class="enquiry-hero-content animate-on-scroll">
            <span class="enquiry-badge"><i data-lucide="calculator" style="width: 14px; height: 14px;"></i> Direct Quarry Quotations</span>
            <h1>Project Marble Enquiry & Quotation</h1>
            <p>Specify your architectural requirements, preferred marble varieties, and estimated square footage to receive transparent pricing, slab photos, and delivery schedules directly from our Kishangarh stockyard.</p>
        </div>
    </section>

    <!-- Main Form Section -->
    <section class="enquiry-section">
        <div class="container">
            <div class="enquiry-grid">

                <!-- Left Column: Interactive Quotation Form -->
                <div class="enquiry-card animate-on-scroll">
                    
                    @if(session('success'))
                        <div style="background: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 1.25rem; border-radius: 10px; margin-bottom: 2rem; display: flex; align-items: flex-start; gap: 12px;">
                            <i data-lucide="check-circle-2" style="width: 22px; height: 22px; flex-shrink: 0; margin-top: 2px;"></i>
                            <div>
                                <strong style="display: block; font-size: 1.05rem; margin-bottom: 2px;">Enquiry Received Successfully!</strong>
                                <p style="margin: 0; font-size: 0.92rem;">{{ session('success') }} Our stone curators in Kishangarh will review your specifications and reach out with slab lots and quotation within 2 business hours.</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 10px; margin-bottom: 2rem; font-size: 0.9rem;">
                            <ul style="margin: 0; padding-left: 1.25rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('enquiry.submit') }}" method="POST" enctype="multipart/form-data" id="project-enquiry-form">
                        @csrf
                        <input type="hidden" name="source" value="Project Enquiry Form">

                        <!-- Step 1: Contact & Project Info -->
                        <div class="form-step-title">
                            <span class="form-step-num">1</span>
                            <span>Client & Project Information</span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.25rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Full Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Rajesh Singhania" value="{{ old('name') }}" required style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Phone / WhatsApp *</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" value="{{ old('phone') }}" required style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="name@company.com" value="{{ old('email') }}" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Project Delivery City / State *</label>
                                <input type="text" name="city" class="form-control" placeholder="e.g. Mumbai, Delhi NCR, Jaipur, Hyderabad" value="{{ old('city') }}" required style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 6px;">You are reaching out as a:</label>
                            <div class="pill-checkbox-group">
                                @php
                                    $roles = ['Villa / Homeowner', 'Architect', 'Interior Designer', 'Builder / Developer', 'Commercial Contractor'];
                                @endphp
                                @foreach($roles as $role)
                                    <label class="pill-checkbox-item">
                                        <input type="radio" name="project_type" value="{{ $role }}" {{ $loop->first ? 'checked' : '' }}>
                                        <span class="pill-checkbox-label">{{ $role }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Step 2: Application Spaces Required -->
                        <div class="form-step-title">
                            <span class="form-step-num">2</span>
                            <span>Target Application Spaces</span>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="font-size: 0.85rem; color: #666671; display: block; margin-bottom: 8px;">Select all areas where marble / stone will be installed:</label>
                            <div class="pill-checkbox-group">
                                @php
                                    $reqSpaces = [
                                        'Flooring (Living & Bedrooms)' => 'layers',
                                        'Living Room Accent / TV Wall' => 'tv',
                                        'Grand Entrance Lobby' => 'building',
                                        'Kitchen Waterfall Island & Counters' => 'utensils',
                                        'Master Bathroom & Vanity' => 'droplet',
                                        'Outdoor Travertine / Pool Deck' => 'sun',
                                        'Staircase Steps & Risers' => 'arrow-up-right',
                                        'Backlit Translucent Onyx Panel' => 'sparkles'
                                    ];
                                @endphp
                                @foreach($reqSpaces as $sName => $sIcon)
                                    <label class="pill-checkbox-item">
                                        <input type="checkbox" name="spaces[]" value="{{ $sName }}">
                                        <span class="pill-checkbox-label">
                                            <i data-lucide="{{ $sIcon }}"></i> {{ $sName }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Step 3: Preferred Stone Varieties / Tones -->
                        <div class="form-step-title">
                            <span class="form-step-num">3</span>
                            <span>Marble Color & Stone Preference</span>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.5rem;">
                            <label style="font-size: 0.85rem; color: #666671; display: block; margin-bottom: 8px;">Select tone preferences or specific varieties:</label>
                            <div class="pill-checkbox-group">
                                @php
                                    $stoneTones = [
                                        'White Italian Marble (Statuario / Calacatta)',
                                        'Beige & Cream Marble (Botticino / Perlato)',
                                        'Grey Marble (Armani Grey / Laurent)',
                                        'Black & Gold Marble (Portoro / Black Gold)',
                                        'Exotic Quartzite (Patagonia / Blue Roma)',
                                        'Translucent Onyx (Pink / White / Green)',
                                        'Italian Travertine (Romano / Silver)',
                                        'Recommend Best Options for My Budget'
                                    ];
                                @endphp
                                @foreach($stoneTones as $tone)
                                    <label class="pill-checkbox-item">
                                        <input type="checkbox" name="stone_preference[]" value="{{ $tone }}">
                                        <span class="pill-checkbox-label">{{ $tone }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Step 4: Estimated Area & Thickness -->
                        <div class="form-step-title">
                            <span class="form-step-num">4</span>
                            <span>Quantity & Specifications</span>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 1.5rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Estimated Total Area (Sq. Ft.) *</label>
                                <select name="area_sqft" class="form-control" required style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                                    <option value="Under 1,000 sq. ft.">Under 1,000 sq. ft.</option>
                                    <option value="1,000 - 3,000 sq. ft." selected>1,000 - 3,000 sq. ft.</option>
                                    <option value="3,000 - 7,000 sq. ft.">3,000 - 7,000 sq. ft.</option>
                                    <option value="7,000 - 15,000 sq. ft.">7,000 - 15,000 sq. ft.</option>
                                    <option value="15,000+ sq. ft. (Commercial / Large Villa)">15,000+ sq. ft. (Large Project)</option>
                                </select>
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Preferred Slab Thickness</label>
                                <select name="thickness" class="form-control" style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;">
                                    <option value="18mm Standard Calibrated" selected>18mm Standard Calibrated</option>
                                    <option value="20mm Heavy Duty">20mm Heavy Duty</option>
                                    <option value="16mm Light Wall Cladding">16mm Light Wall Cladding</option>
                                    <option value="Curator Recommendation">Curator Recommendation</option>
                                </select>
                            </div>
                        </div>

                        <!-- Step 5: Notes & Attachment -->
                        <div class="form-step-title">
                            <span class="form-step-num">5</span>
                            <span>Floor Plan / BOQ Specification (Optional)</span>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Attach Architectural Drawing, BOQ, or Reference Photo</label>
                            <input type="file" name="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.dwg" class="form-control" style="padding: 0.6rem; border-radius: 8px; border: 1px dashed #a1a1aa; width: 100%; background: #fafafa;">
                            <span style="font-size: 0.78rem; color: #71717a; margin-top: 4px; display: block;">Supports PDF, DOC, DWG, JPG up to 20MB.</span>
                        </div>

                        <div class="form-group" style="margin-bottom: 2rem;">
                            <label style="font-size: 0.85rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 5px;">Project Timeline & Additional Notes</label>
                            <textarea name="message" class="form-control" rows="3" placeholder="Mention target installation date, specific veins, budget per sq. ft., or any custom requirements..." style="padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #d4d4d8; width: 100%;"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; background: var(--accent-gold); border-color: var(--accent-gold); color: #121214; font-weight: 700; padding: 1rem; border-radius: 10px; font-size: 1.05rem;">
                            <span>Submit Project Enquiry & Request Quote</span>
                            <i data-lucide="send" style="width: 18px; height: 18px; margin-left: 8px;"></i>
                        </button>
                    </form>
                </div>

                <!-- Right Column: Live Summary & Direct Assistance -->
                <div class="sidebar-sticky animate-on-scroll">
                    
                    <!-- Sourcing Guarantees Card -->
                    <div class="summary-card">
                        <h3>Stone Hub India Direct Sourcing</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.92rem; color: rgba(255,255,255,0.85); line-height: 1.5;">
                            <div style="display: flex; gap: 10px;">
                                <i data-lucide="shield-check" style="width: 20px; height: 20px; color: var(--accent-gold); flex-shrink: 0;"></i>
                                <span><strong>Direct Quarry Import:</strong> Sourced straight from Carrara, Verona, Thassos, and Vitória without middlemen.</span>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <i data-lucide="award" style="width: 20px; height: 20px; color: var(--accent-gold); flex-shrink: 0;"></i>
                                <span><strong>ISO:2015 Quality Certified:</strong> Every lot tested for water absorption, compressive strength, and vein integrity.</span>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <i data-lucide="truck" style="width: 20px; height: 20px; color: var(--accent-gold); flex-shrink: 0;"></i>
                                <span><strong>Insured Nationwide Transit:</strong> Heavy A-frame wooden crating and transit insurance to any city in India.</span>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <i data-lucide="video" style="width: 20px; height: 20px; color: var(--accent-gold); flex-shrink: 0;"></i>
                                <span><strong>Virtual Slab Inspection:</strong> Live HD video walk through our 5,00,000+ sq ft stockyard in Kishangarh.</span>
                            </div>
                        </div>

                        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                <span style="font-size: 0.8rem; color: #a1a1aa; display: block;">STOCKYARD INVENTORY</span>
                                <strong style="color: var(--accent-gold); font-size: 1.25rem;">400+ Live Varieties</strong>
                            </div>
                            <a href="{{ route('pricelist') }}" style="color: #ffffff; font-size: 0.85rem; font-weight: 600; text-decoration: underline;">Price List &rarr;</a>
                        </div>
                    </div>

                    <!-- Direct Contact & WhatsApp Help -->
                    <div class="direct-help-card">
                        <h4 style="font-size: 1.15rem; color: #121214 !important; font-weight: 700; margin-bottom: 0.5rem;">Prefer Instant Assistance?</h4>
                        <p style="font-size: 0.88rem; color: #666671; margin-bottom: 1.25rem;">Connect immediately with our Senior Stone Specifier on WhatsApp or Phone.</p>

                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <a href="https://wa.me/{{ $site['whatsapp_number'] ?? '919672777749' }}?text=Hi%20Stone%20Hub%20India,%20I'd%20like%20to%20request%20a%20project%20marble%20quotation." target="_blank" class="btn" style="background: #25d366; color: #ffffff; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;">
                                <i data-lucide="message-circle" style="width: 18px; height: 18px;"></i>
                                Chat on WhatsApp (Slab Photos)
                            </a>

                            <a href="tel:{{ $site['phone'] ?? '+919672777749' }}" class="btn" style="background: #f4f2ed; border: 1px solid rgba(15,15,17,0.1); color: #121214; padding: 0.75rem 1rem; border-radius: 8px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none;">
                                <i data-lucide="phone" style="width: 18px; height: 18px; color: var(--accent-gold);"></i>
                                {{ $site['phone'] ?? '+91 96727 77749' }}
                            </a>
                        </div>

                        <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid rgba(15,15,17,0.06); font-size: 0.82rem; color: #71717a; line-height: 1.4;">
                            <strong style="color: #121214; display: block; margin-bottom: 2px;">Kishangarh Main Stockyard & Showroom:</strong>
                            {{ $site['address'] ?? 'NH-8, Makrana Road, Industrial Area, Kishangarh, Rajasthan - 305801' }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
