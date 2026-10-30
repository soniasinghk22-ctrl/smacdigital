@extends('layouts.app')

@section('title', $careersPage->metatitle ?? 'Careers & Job Openings at Stone Hub India | Kishangarh Marble Hub')
@section('meta_description', $careersPage->metadescription ?? 'Explore high-growth career opportunities in luxury marble sales, stone processing engineering, architectural specification, and procurement at Stone Hub India.')
@section('meta_keywords', $careersPage->metakeywords ?? 'stone hub india careers, marble jobs kishangarh, stone industry jobs rajasthan, sales jobs luxury marble')

@section('schema')
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [
    [
      '@type' => 'WebPage',
      '@id' => route('careers') . '/#webpage',
      'url' => route('careers'),
      'name' => 'Careers at Stone Hub India | ' . ($site['site_name'] ?? 'Stone Hub India'),
      'description' => 'Join our growing team of natural stone specialists, engineers, and architectural consultants.',
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
    /* Careers Hero */
    .careers-hero {
        position: relative;
        min-height: 440px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5rem 1.5rem 4rem;
        background: #0c0c0e;
        overflow: hidden;
    }
    .careers-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.35;
    }
    .careers-hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(15,15,17,0.4) 0%, rgba(10,10,12,0.94) 100%);
    }
    .careers-hero-content {
        position: relative;
        z-index: 2;
        max-width: 860px;
        margin: 0 auto;
    }
    .careers-badge {
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
        margin-bottom: 1.25rem;
    }
    .careers-hero h1 {
        font-size: clamp(2.2rem, 4.2vw, 3.4rem);
        color: #ffffff !important;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: 'Outfit', sans-serif;
    }
    .careers-hero p {
        font-size: clamp(1rem, 1.6vw, 1.15rem);
        color: rgba(255,255,255,0.85);
        max-width: 720px;
        margin: 0 auto 2rem;
        line-height: 1.65;
    }

    /* Culture Highlights */
    .culture-section {
        padding: 4.5rem 0 3rem;
        background: #ffffff;
    }
    .culture-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 2rem;
        margin-top: 2.5rem;
    }
    .culture-card {
        background: #fbfaf7;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(15,15,17,0.06);
        transition: all 0.3s ease;
    }
    .culture-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.06);
        border-color: rgba(197, 168, 128, 0.4);
    }
    .culture-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: #151518;
        color: var(--accent-gold, #C5A880);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }
    .culture-card h3 {
        font-size: 1.2rem;
        color: #121214 !important;
        font-weight: 700;
        margin-bottom: 0.6rem;
    }
    .culture-card p {
        font-size: 0.92rem;
        color: #555560;
        line-height: 1.6;
        margin: 0;
    }

    /* Jobs & Application Form Section */
    .jobs-section {
        padding: 4.5rem 0 6rem;
        background: #f7f6f2;
    }
    .jobs-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 3rem;
        align-items: start;
    }
    @media (max-width: 960px) {
        .jobs-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Job Opening Cards */
    .job-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 8px 24px rgba(0,0,0,0.03);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    .job-card:hover {
        border-color: var(--accent-gold, #C5A880);
        box-shadow: 0 14px 35px rgba(0,0,0,0.07);
    }
    .job-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.85rem;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    .job-title {
        font-size: 1.25rem;
        color: #121214 !important;
        font-weight: 700;
        margin: 0;
        font-family: 'Outfit', sans-serif;
    }
    .job-location-badge {
        background: rgba(197, 168, 128, 0.15);
        color: #8a6d3b;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid rgba(197, 168, 128, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .job-meta-strip {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        font-size: 0.82rem;
        color: #71717a;
        margin-bottom: 1rem;
    }
    .job-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .job-desc {
        font-size: 0.92rem;
        color: #555560;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }
    .job-apply-btn {
        background: #151518;
        color: #ffffff;
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }
    .job-apply-btn:hover {
        background: var(--accent-gold, #C5A880);
        color: #121214;
    }

    /* Candidate Application Form Card */
    .apply-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        border: 1px solid rgba(15,15,17,0.08);
        box-shadow: 0 12px 35px rgba(0,0,0,0.04);
        position: sticky;
        top: 90px;
    }
    @media (max-width: 640px) {
        .apply-card {
            padding: 1.75rem 1.25rem;
        }
    }
</style>
@endsection

@section('content')

    <!-- Hero Header -->
    <section class="careers-hero">
        <img src="{{ asset('assets/images/pages/hero-showroom.webp') }}" alt="Careers at Stone Hub India Kishangarh" class="careers-hero-bg">
        <div class="careers-hero-overlay"></div>
        <div class="careers-hero-content animate-on-scroll">
            <span class="careers-badge"><i data-lucide="briefcase" style="width: 14px; height: 14px;"></i> Join Our Team</span>
            <h1>Shape the Future of Luxury Stone</h1>
            <p>Join Stone Hub India — an ISO:2015 certified market leader with 300+ imported varieties, state-of-the-art Italian gangsaw processing lines, and an energetic, high-growth environment in Kishangarh and metro offices.</p>
            <a href="#open-roles" class="btn btn-primary btn-lg" style="background: var(--accent-gold); border-color: var(--accent-gold); color: #121214; font-weight: 700;">
                <span>View Current Openings</span>
                <i data-lucide="arrow-down" style="width: 18px; height: 18px;"></i>
            </a>
        </div>
    </section>

    <!-- Culture & Benefits -->
    <section class="culture-section">
        <div class="container">
            <div class="section-header text-center" style="max-width: 760px; margin: 0 auto;">
                <span class="eyebrow" style="color: #8a6d3b; font-weight: 700; letter-spacing: 2px;">LIFE AT STONE HUB INDIA</span>
                <h2 style="font-size: clamp(1.8rem, 3vw, 2.4rem); color: #121214 !important; font-weight: 700; margin-top: 0.5rem;">Why Build Your Career With Us?</h2>
                <p style="color: #666671; font-size: 1.02rem; margin-top: 0.75rem;">We empower our professionals with international exposure, cutting-edge technology, and unparalleled growth in the luxury architectural sector.</p>
            </div>

            <div class="culture-grid animate-on-scroll">
                <div class="culture-card">
                    <div class="culture-icon"><i data-lucide="globe"></i></div>
                    <h3>Global Quarry Networks</h3>
                    <p>Work directly with top quarries in Italy (Carrara), Greece, Brazil, and Turkey, mastering international natural stone supply chains.</p>
                </div>

                <div class="culture-card">
                    <div class="culture-icon"><i data-lucide="cpu"></i></div>
                    <h3>Cutting-Edge Processing Lines</h3>
                    <p>Gain hands-on experience with Italian multi-wire gangsaws, automated resin lines, and high-precision CNC bridge cutters in Kishangarh.</p>
                </div>

                <div class="culture-card">
                    <div class="culture-icon"><i data-lucide="trending-up"></i></div>
                    <h3>Performance Incentives & Growth</h3>
                    <p>Fast-track advancement pathways, competitive compensation, performance bonuses, and continuous mentorship for leaders.</p>
                </div>

                <div class="culture-card">
                    <div class="culture-icon"><i data-lucide="users"></i></div>
                    <h3>Architect & Designer Clientele</h3>
                    <p>Collaborate with India's most celebrated architects, interior designers, and luxury estate developers on landmark projects.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Roles & Application Section -->
    <section class="jobs-section" id="open-roles">
        <div class="container">
            <div class="jobs-grid">

                <!-- Left Column: Open Job Positions -->
                <div class="animate-on-scroll">
                    <div style="margin-bottom: 2rem;">
                        <span style="color: #8a6d3b; font-size: 0.85rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;">OPEN POSITIONS</span>
                        <h2 style="font-size: clamp(1.8rem, 3vw, 2.3rem); color: #121214 !important; font-weight: 700; margin-top: 0.35rem;">Current Job Openings</h2>
                        <p style="color: #666671; font-size: 0.95rem;">Click 'Apply for this Role' to auto-fill the application form.</p>
                    </div>

                    <!-- Job 1 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title">Senior Luxury Stone Sales Consultant</h3>
                            <span class="job-location-badge"><i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> Kishangarh / Delhi NCR</span>
                        </div>
                        <div class="job-meta-strip">
                            <span class="job-meta-item"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Full Time</span>
                            <span class="job-meta-item"><i data-lucide="briefcase" style="width: 13px; height: 13px;"></i> 2 - 6 Years Experience</span>
                            <span class="job-meta-item"><i data-lucide="award" style="width: 13px; height: 13px;"></i> Graduate / MBA</span>
                        </div>
                        <p class="job-desc">Lead consultative sales for high-net-worth clients, architects, and interior designers visiting our Kishangarh stockyard and Delhi gallery. Recommend marble slabs, calculate square footage, and manage client orders through delivery.</p>
                        <button type="button" onclick="selectJobPosition('Senior Luxury Stone Sales Consultant')" class="job-apply-btn">
                            <span>Apply for this Role</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>

                    <!-- Job 2 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title">Stone Processing & Quality Assurance Engineer</h3>
                            <span class="job-location-badge"><i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> Kishangarh Processing Unit</span>
                        </div>
                        <div class="job-meta-strip">
                            <span class="job-meta-item"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Full Time</span>
                            <span class="job-meta-item"><i data-lucide="briefcase" style="width: 13px; height: 13px;"></i> 3 - 7 Years Experience</span>
                            <span class="job-meta-item"><i data-lucide="award" style="width: 13px; height: 13px;"></i> B.Tech / B.Voc / Diploma</span>
                        </div>
                        <p class="job-desc">Supervise gangsaw cutting, slab calibration, epoxy resin line treatment, and mirror polishing quality control. Ensure zero thickness variation and meticulous surface inspection of imported marble blocks.</p>
                        <button type="button" onclick="selectJobPosition('Stone Processing & Quality Assurance Engineer')" class="job-apply-btn">
                            <span>Apply for this Role</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>

                    <!-- Job 3 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title">Architect & Designer Specification Manager</h3>
                            <span class="job-location-badge"><i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> Mumbai / Bangalore / Delhi</span>
                        </div>
                        <div class="job-meta-strip">
                            <span class="job-meta-item"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Full Time</span>
                            <span class="job-meta-item"><i data-lucide="briefcase" style="width: 13px; height: 13px;"></i> 3 - 8 Years Experience</span>
                            <span class="job-meta-item"><i data-lucide="award" style="width: 13px; height: 13px;"></i> Architecture / Design Background</span>
                        </div>
                        <p class="job-desc">Build strategic alliances with top tier architecture firms and luxury interior designers. Present curated stone sample boxes, assist with BOQ specifications, and coordinate large project shipments.</p>
                        <button type="button" onclick="selectJobPosition('Architect & Designer Specification Manager')" class="job-apply-btn">
                            <span>Apply for this Role</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>

                    <!-- Job 4 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title">Procurement & Global Quarry Sourcing Executive</h3>
                            <span class="job-location-badge"><i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> Kishangarh HQ (International Travel)</span>
                        </div>
                        <div class="job-meta-strip">
                            <span class="job-meta-item"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Full Time</span>
                            <span class="job-meta-item"><i data-lucide="briefcase" style="width: 13px; height: 13px;"></i> 2 - 5 Years Experience</span>
                            <span class="job-meta-item"><i data-lucide="award" style="width: 13px; height: 13px;"></i> Graduate / Supply Chain</span>
                        </div>
                        <p class="job-desc">Coordinate international purchase orders, shipping logistics, customs documentation, and quarry inspection across Europe, Brazil, and Turkey for premium marble and quartzite blocks.</p>
                        <button type="button" onclick="selectJobPosition('Procurement & Global Quarry Sourcing Executive')" class="job-apply-btn">
                            <span>Apply for this Role</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>

                    <!-- Job 5 -->
                    <div class="job-card">
                        <div class="job-card-header">
                            <h3 class="job-title">Logistics, Stockyard & Dispatch Supervisor</h3>
                            <span class="job-location-badge"><i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> Kishangarh Stockyard</span>
                        </div>
                        <div class="job-meta-strip">
                            <span class="job-meta-item"><i data-lucide="clock" style="width: 13px; height: 13px;"></i> Full Time</span>
                            <span class="job-meta-item"><i data-lucide="briefcase" style="width: 13px; height: 13px;"></i> 2 - 5 Years Experience</span>
                            <span class="job-meta-item"><i data-lucide="award" style="width: 13px; height: 13px;"></i> Any Graduate</span>
                        </div>
                        <p class="job-desc">Manage heavy overhead gantry cranes, wooden A-frame packaging, slab safety protocols, Gati docket tracking, and secure trailer dispatch to projects nationwide.</p>
                        <button type="button" onclick="selectJobPosition('Logistics, Stockyard & Dispatch Supervisor')" class="job-apply-btn">
                            <span>Apply for this Role</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </div>

                </div>

                <!-- Right Column: Candidate Application Form -->
                <div class="apply-card animate-on-scroll" id="application-form-wrapper">
                    <h3 style="font-size: 1.45rem; color: #121214 !important; font-weight: 700; margin-bottom: 0.4rem; font-family: 'Outfit', sans-serif;">Submit Your Application</h3>
                    <p style="font-size: 0.88rem; color: #666671; margin-bottom: 1.5rem;">Join our high-performing team. Submit your details along with your updated resume.</p>

                    @if(session('success'))
                        <div style="background: #dcfce7; border: 1px solid #22c55e; color: #15803d; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.88rem;">
                            <ul style="margin: 0; padding-left: 1.25rem;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data" id="career-form">
                        @csrf
                        <input type="hidden" name="source" value="Careers Job Application">

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">First Name *</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Mobile / WhatsApp *</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" value="{{ old('phone') }}" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="yourname@email.com" value="{{ old('email') }}" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0.85rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Applying For Position *</label>
                            <select name="position" id="form-position-select" class="form-control" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                                <option value="Senior Luxury Stone Sales Consultant">Senior Luxury Stone Sales Consultant</option>
                                <option value="Stone Processing & Quality Assurance Engineer">Stone Processing & Quality Assurance Engineer</option>
                                <option value="Architect & Designer Specification Manager">Architect & Designer Specification Manager</option>
                                <option value="Procurement & Global Quarry Sourcing Executive">Procurement & Global Quarry Sourcing Executive</option>
                                <option value="Logistics, Stockyard & Dispatch Supervisor">Logistics, Stockyard & Dispatch Supervisor</option>
                                <option value="General / Other Professional Role">General / Other Professional Role</option>
                            </select>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Total Experience *</label>
                                <select name="experience_years" class="form-control" required style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                                    <option value="Fresher / < 1 Year">Fresher / &lt; 1 Year</option>
                                    <option value="1 - 3 Years" selected>1 - 3 Years</option>
                                    <option value="3 - 5 Years">3 - 5 Years</option>
                                    <option value="5 - 8 Years">5 - 8 Years</option>
                                    <option value="8+ Years">8+ Years</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Highest Qualification</label>
                                <input type="text" name="qualification" class="form-control" placeholder="e.g. B.Tech, MBA, Graduate" value="{{ old('qualification') }}" style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Current Designation</label>
                                <input type="text" name="current_designation" class="form-control" placeholder="e.g. Sales Executive" value="{{ old('current_designation') }}" style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Current Company</label>
                                <input type="text" name="current_company" class="form-control" placeholder="Company Name" value="{{ old('current_company') }}" style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Current CTC (Annual / Monthly)</label>
                                <input type="text" name="current_ctc" class="form-control" placeholder="e.g. 5.5 LPA" value="{{ old('current_ctc') }}" style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Expected CTC</label>
                                <input type="text" name="expected_ctc" class="form-control" placeholder="e.g. 7.0 LPA" value="{{ old('expected_ctc') }}" style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0.85rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Upload Resume / CV * (PDF, DOCX up to 10MB)</label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx" class="form-control" required style="padding: 0.5rem; border-radius: 6px; border: 1px dashed #a1a1aa; width: 100%; background: #fafafa;">
                        </div>

                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label style="font-size: 0.82rem; font-weight: 600; color: #27272a; display: block; margin-bottom: 4px;">Current Address / City & Short Intro</label>
                            <textarea name="message" class="form-control" rows="2" placeholder="Briefly describe your background, key strengths, or reasons for joining Stone Hub India..." style="padding: 0.65rem 0.85rem; border-radius: 6px; border: 1px solid #d4d4d8; width: 100%;">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; background: #121214; border-color: #121214; color: #ffffff; padding: 0.85rem; border-radius: 8px; font-weight: 700; font-size: 0.95rem;">
                            <span>Submit Job Application</span>
                            <i data-lucide="send" style="width: 16px; height: 16px; margin-left: 6px;"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    function selectJobPosition(pos) {
        const select = document.getElementById('form-position-select');
        if (select) {
            select.value = pos;
            const formWrapper = document.getElementById('application-form-wrapper');
            if (formWrapper) {
                formWrapper.scrollIntoView({ behavior: 'smooth' });
            }
        }
    }
</script>
@endsection
