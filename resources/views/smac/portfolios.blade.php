@extends('smac.layout')

@section('title', $page->metatitle ?? 'Portfolio & Case Studies | SMAC Digital')
@section('meta_description', $page->metadescription ?? 'Explore selected work by SMAC Digital across B2B wholesale, healthcare, luxury marble, and direct-to-consumer ecommerce.')
@section('meta_keywords', $page->metakeywords ?? 'Marketing Portfolio, Case Studies, Client Results, SMAC Digital Work')

@section('content')

    
    
    <section class="hero inner-hero" aria-labelledby="portfolio-hero-title">
      <div class="hero-stage" aria-hidden="true">
        <div class="hero-grid"></div>
      </div>
      <div class="wrap hero-copy">
        <p class="pill">Portfolio</p>
        <h1 id="portfolio-hero-title">
          <span>Selected</span><br>
          <em>client work.</em>
        </h1>
        <p class="lede">Partners in growth — browse brands below to see the brief, the work, and what clients said publicly.</p>
        <div class="hero-actions">
          <a class="btn btn-white" href="{{ url('/contact') }}">Start a project</a>
          <span class="or" aria-hidden="true">or</span>
          <a class="btn btn-black" href="{{ url('/contact') }}">Get a free consultation</a>
        </div>
      </div>
    </section>
    <section class="page-section" id="cases">
      <div class="wrap">
        <div class="page-portfolio-grid">
          
            <article class="page-project" id="shree-rakhi">
              <a class="page-project-media" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/shree-rakhi.jpg" alt="Shree Rakhi" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Rakhi manufacturer & wholesaler</p>
                <h2>Shree Rakhi</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A wholesale rakhi house needed a digital storefront dealers could use to browse collections and raise wholesale enquiries.</p></div>
                  <div><h3>What we did</h3><p>Website design and development for categories, licensed lines, and a clear path to the wholesale desk.</p></div>
                  <div><h3>Outcome</h3><p>A live wholesale site presenting the catalogue and dealer journey end to end.</p></div>
                </div>
                <a class="btn btn-primary" href="https://smacdemo.in/shree-rakhi-new/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="rhl">
              <a class="page-project-media" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/rhl-preview.jpg" alt="Rajasthan Hospital" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Multispecialty hospital</p>
                <h2>Rajasthan Hospital</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A hospital needed a clearer digital front door for departments, doctors, and patient contact.</p></div>
                  <div><h3>What we did</h3><p>Website structure around specialities, services, and appointment-led contact paths.</p></div>
                  <div><h3>Outcome</h3><p>A live hospital site that presents care offerings without burying the enquiry route.</p></div>
                </div>
                <a class="btn btn-primary" href="https://smacdemo.in/rhl/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="stone-hub">
              <a class="page-project-media" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/stone-hub.jpg" alt="Stone Hub India" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Imported marble & slabs</p>
                <h2>Stone Hub India</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A stone curator needed digital reach that could bring enquiries from beyond a single city.</p></div>
                  <div><h3>What we did</h3><p>Website and digital marketing focused on collections, applications, and catalogue requests.</p></div>
                  <div><h3>Outcome</h3><p>From their published testimonial: contracts rose by about one-third, with new clients found digitally from across India.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.stonehubindia.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="kalavaati">
              <a class="page-project-media" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/kalavaati.jpg" alt="Kalavaati" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Indian art & craft</p>
                <h2>Kalavaati</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A craft brand needed digital storytelling that felt as considered as the work on the shelf.</p></div>
                  <div><h3>What we did</h3><p>Ecommerce-ready site work that puts craft, material, and collection browsing first.</p></div>
                  <div><h3>Outcome</h3><p>A digital home that presents handmade collections with room to sell and scale.</p></div>
                </div>
                <a class="btn btn-primary" href="https://kalavaati.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="aashiyana">
              <a class="page-project-media" href="https://www.aashiyanacottage.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/aashiyana.jpg" alt="Aashiyana Luxury Cottages" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Resorts</p>
                <h2>Aashiyana Luxury Cottages</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A resort brand needed guests to feel the stay before they book.</p></div>
                  <div><h3>What we did</h3><p>Website experience around rooms, amenities, and enquiry.</p></div>
                  <div><h3>Outcome</h3><p>A booking-led digital front that matches the property tone.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.aashiyanacottage.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="navvi">
              <a class="page-project-media" href="https://navvi.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/navvi.jpg" alt="Navvi" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Indian ethnic fashion</p>
                <h2>Navvi</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A fashion label needed a sharper digital shelf for ethnic wear.</p></div>
                  <div><h3>What we did</h3><p>Site and merchandising paths for collections and discovery.</p></div>
                  <div><h3>Outcome</h3><p>A storefront that lets product lead the story.</p></div>
                </div>
                <a class="btn btn-primary" href="https://navvi.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="ashoka">
              <a class="page-project-media" href="https://ashokaholidays.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/ashoka.jpg" alt="Ashoka Holidays" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Indian travel company</p>
                <h2>Ashoka Holidays</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A travel company needed clearer trip discovery and enquiry.</p></div>
                  <div><h3>What we did</h3><p>Website structure for destinations, packages, and contact.</p></div>
                  <div><h3>Outcome</h3><p>A travel site that makes next-step booking feel obvious.</p></div>
                </div>
                <a class="btn btn-primary" href="https://ashokaholidays.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="dmaasa">
              <a class="page-project-media" href="https://dmaasa.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/dmaasa-preview.jpg" alt="Dmaasa" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Brand site</p>
                <h2>Dmaasa</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>The brand needed a digital presence that matched its offering.</p></div>
                  <div><h3>What we did</h3><p>Website design and development around core services and proof.</p></div>
                  <div><h3>Outcome</h3><p>A live site with a clear path to talk to the team.</p></div>
                </div>
                <a class="btn btn-primary" href="https://dmaasa.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="tenderfold">
              <a class="page-project-media" href="https://www.tenderfold.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/tenderfold-preview.jpg" alt="Tenderfold" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Brand site</p>
                <h2>Tenderfold</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A growing brand needed a trustworthy web presence.</p></div>
                  <div><h3>What we did</h3><p>Site craft that presents product and contact with clarity.</p></div>
                  <div><h3>Outcome</h3><p>A polished digital front door for the business.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.tenderfold.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="dmb">
              <a class="page-project-media" href="https://dmbsweets.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/dmb.jpg" alt="DMB Sweets" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Heritage sweets, snacks &amp; restaurant</p>
                <h2>DMB Sweets</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A heritage sweet house and restaurant chain in Jaipur needed an engaging digital presence to present sweets, snacks, and catering services.</p></div>
                  <div><h3>What we did</h3><p>Website design and development structuring festival collections, catering, and online inquiries.</p></div>
                  <div><h3>Outcome</h3><p>A high-conversion digital presence that strengthened brand recall and streamlined festive and bulk orders.</p></div>
                </div>
                <a class="btn btn-primary" href="https://dmbsweets.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="intex">
              <a class="page-project-media" href="https://www.intex.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/intex.jpg" alt="Intex Technologies" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Consumer electronics &amp; mobile</p>
                <h2>Intex Technologies</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A major consumer electronics and IT hardware brand required performance marketing to reach high-intent consumer segments nationwide.</p></div>
                  <div><h3>What we did</h3><p>Search engine marketing, campaign landing pages, and audience targeting for consumer electronics lines.</p></div>
                  <div><h3>Outcome</h3><p>Expanded brand visibility, increased product page engagement, and measurable growth in qualified leads.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.intex.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="tumbledry">
              <a class="page-project-media" href="https://tumbledry.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/tumbledry.jpg" alt="Tumbledry" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Laundry &amp; dry cleaning chain</p>
                <h2>Tumbledry</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>India’s largest dry cleaning and laundry chain needed rapid multi-city brand discovery and localized customer acquisition.</p></div>
                  <div><h3>What we did</h3><p>Scalable localized SEO, Google Search marketing, and customer acquisition campaigns across metro territories.</p></div>
                  <div><h3>Outcome</h3><p>From their published testimonial: over 12 months of sustained partnership driving competitor differentiation and multi-city store expansion.</p></div>
                </div>
                <a class="btn btn-primary" href="https://tumbledry.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="livpure-uae">
              <a class="page-project-media" href="https://www.livpure.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/livpure-uae.jpg" alt="Livpure UAE" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Water purification &amp; appliances (UAE)</p>
                <h2>Livpure UAE</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>Livpure needed an authoritative digital footprint to capture consumer demand and regional distributor interest across the UAE.</p></div>
                  <div><h3>What we did</h3><p>Regional digital media planning, localized landing pages, and search visibility tailored to GCC search behavior.</p></div>
                  <div><h3>Outcome</h3><p>Targeted online reach and steady distributor and homeowner inquiries across regional emirates.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.livpure.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="global-sales">
              <a class="page-project-media" href="https://globalsalesweb.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/global-sales.jpg" alt="Global Sales Web" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">B2B sales &amp; trade platform</p>
                <h2>Global Sales Web</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A B2B global sales platform needed an intuitive web structure to connect verified international buyers with Indian manufacturers.</p></div>
                  <div><h3>What we did</h3><p>Web portal architecture, category taxonomies, and clear conversion paths for trade inquiries.</p></div>
                  <div><h3>Outcome</h3><p>A dependable B2B platform facilitating international buyer discovery and trade inquiries.</p></div>
                </div>
                <a class="btn btn-primary" href="https://globalsalesweb.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="livpure">
              <a class="page-project-media" href="https://www.livpure.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/livpure.jpg" alt="Livpure" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Water purifiers &amp; smart appliances</p>
                <h2>Livpure</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A household brand in water purification and wellness appliances needed comprehensive search dominance across key product lines.</p></div>
                  <div><h3>What we did</h3><p>Technical SEO architecture, on-page optimization, and full-funnel search campaigns across purification and sleep verticals.</p></div>
                  <div><h3>Outcome</h3><p>Competitive organic rankings and steady month-over-month growth in product exploration.</p></div>
                </div>
                <a class="btn btn-primary" href="https://www.livpure.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="g-k-ratnam">
              <a class="page-project-media" href="https://gkratnam.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/g-k-ratnam.jpg" alt="G K Ratnam" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Fine jewellery &amp; certified gemstones</p>
                <h2>G K Ratnam</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A luxury gemstone and jewelry brand required a digital showcase that communicated timeless craftsmanship and certified authenticity.</p></div>
                  <div><h3>What we did</h3><p>Refined catalogue web experience, bespoke gemstone galleries, and high-trust product showcases.</p></div>
                  <div><h3>Outcome</h3><p>Heightened brand positioning and qualified inquiries from bridal and fine jewelry buyers nationwide.</p></div>
                </div>
                <a class="btn btn-primary" href="https://gkratnam.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="drsumitz">
              <a class="page-project-media" href="https://drsumitz.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/drsumitz.jpg" alt="SumitZ Clinics" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Orthopaedic &amp; physiotherapy healthcare</p>
                <h2>SumitZ Clinics</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A multi-branch orthopaedic and physiotherapy clinic needed to help patients in acute discomfort quickly identify treatment options and book consultations.</p></div>
                  <div><h3>What we did</h3><p>Patient-focused web design, condition-specific treatment pages, and direct doctor appointment booking funnels.</p></div>
                  <div><h3>Outcome</h3><p>A clear healthcare front door leading to higher appointment bookings across clinic branches.</p></div>
                </div>
                <a class="btn btn-primary" href="https://drsumitz.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="tirupaticollege">
              <a class="page-project-media" href="http://tirupaticollege.org/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/tirupaticollege.jpg" alt="Tirupati College" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Higher education institution</p>
                <h2>Tirupati College</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A leading higher education college needed a comprehensive academic portal for degree courses, admissions, faculty, and student services.</p></div>
                  <div><h3>What we did</h3><p>Structured academic web layout, departmental directories, and clear online admission inquiry forms.</p></div>
                  <div><h3>Outcome</h3><p>An accessible educational hub supporting higher student inquiries and streamlined admissions communication.</p></div>
                </div>
                <a class="btn btn-primary" href="http://tirupaticollege.org/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="homeopathy">
              <a class="page-project-media" href="assets/work/homeopathy-big.jpg" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/homeopathy.jpg" alt="Homeopathy Clinic" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Classical homeopathy &amp; holistic wellness</p>
                <h2>Homeopathy Clinic</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A holistic homeopathic practice needed to educate patients on root-cause healing and offer transparent consultation avenues.</p></div>
                  <div><h3>What we did</h3><p>Content-first healthcare web layout, disease awareness sections, and easy appointment request pathways.</p></div>
                  <div><h3>Outcome</h3><p>A welcoming digital presence building patient trust and steady consultation requests for chronic ailments.</p></div>
                </div>
                <a class="btn btn-primary" href="assets/work/homeopathy-big.jpg" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="navpacknprint">
              <a class="page-project-media" href="https://navpacknprint.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/navpacknprint.jpg" alt="Navpack &amp; Print" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Packaging &amp; commercial printing</p>
                <h2>Navpack &amp; Print</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>An industrial packaging manufacturer needed to display its printing capabilities, certifications, and product packaging lines to corporate buyers.</p></div>
                  <div><h3>What we did</h3><p>B2B capabilities showcase, machinery portfolio layout, and instant quote request workflows.</p></div>
                  <div><h3>Outcome</h3><p>Enhanced industrial authority and qualified packaging inquiry volume from enterprise and FMCG clients.</p></div>
                </div>
                <a class="btn btn-primary" href="https://navpacknprint.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="oppalius">
              <a class="page-project-media" href="assets/work/oppalius-big.jpg" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/oppalius.jpg" alt="Oppalius" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Luxury jewellery &amp; lifestyle</p>
                <h2>Oppalius</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A high-end diamond and luxury jewelry designer required a web presence that echoed understated elegance and artistic design.</p></div>
                  <div><h3>What we did</h3><p>Minimalist editorial web design, high-resolution product showcases, and private viewing inquiry routes.</p></div>
                  <div><h3>Outcome</h3><p>An exclusive digital showcase attracting connoisseurs looking for bespoke luxury jewelry.</p></div>
                </div>
                <a class="btn btn-primary" href="assets/work/oppalius-big.jpg" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="pallavimakeupartist">
              <a class="page-project-media" href="https://pallavimakeupartist.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/pallavimakeupartist.jpg" alt="Pallavi Makeup Artist" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Bridal &amp; celebrity makeover studio</p>
                <h2>Pallavi Makeup Artist</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A bridal makeup artist needed a visually stunning portfolio to highlight bridal looks, studio services, and client transformations.</p></div>
                  <div><h3>What we did</h3><p>Visual-first gallery web experience, client reviews, and direct WhatsApp and phone booking links.</p></div>
                  <div><h3>Outcome</h3><p>Stronger social proof and consistent bridal booking inquiries across wedding seasons.</p></div>
                </div>
                <a class="btn btn-primary" href="https://pallavimakeupartist.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="promasterfilings">
              <a class="page-project-media" href="https://promasterfilings.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/promasterfilings.jpg" alt="ProMaster Filings" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Corporate filings &amp; legal compliance</p>
                <h2>ProMaster Filings</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A legal and corporate compliance consultancy needed to simplify complex incorporation, tax, and trademark procedures for startup founders.</p></div>
                  <div><h3>What we did</h3><p>Clean service hierarchy, package pricing presentations, and clear lead capture forms.</p></div>
                  <div><h3>Outcome</h3><p>Reduced client inquiry friction and predictable inbound leads for company registration and tax compliance.</p></div>
                </div>
                <a class="btn btn-primary" href="https://promasterfilings.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="saisravanthi">
              <a class="page-project-media" href="assets/work/saisravanthi-big.jpg" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/saisravanthi.jpg" alt="Sai Sravanthi" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Designer textiles &amp; ethnic fashion</p>
                <h2>Sai Sravanthi</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A boutique couture and textile label needed to bring traditional handcrafted fabrics and designer sarees to modern buyers online.</p></div>
                  <div><h3>What we did</h3><p>Artistic lookbook web layouts, collection galleries, and direct designer consultation paths.</p></div>
                  <div><h3>Outcome</h3><p>Broader digital reach beyond local boutiques and consistent client inquiries for bespoke designer outfits.</p></div>
                </div>
                <a class="btn btn-primary" href="assets/work/saisravanthi-big.jpg" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="samriddhigroup">
              <a class="page-project-media" href="https://samriddhigroup.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/samriddhigroup.jpg" alt="Samriddhi Group" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Real estate builders &amp; developers</p>
                <h2>Samriddhi Group</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A real estate developer required a modern property showcase for residential townships, layout plans, and lifestyle amenities.</p></div>
                  <div><h3>What we did</h3><p>Interactive project presentation pages, architectural renders, and site-visit consultation booking modules.</p></div>
                  <div><h3>Outcome</h3><p>Increased prospective homebuyer trust and a steady stream of qualified site-visit registrations.</p></div>
                </div>
                <a class="btn btn-primary" href="https://samriddhigroup.com/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="thegifterysolutions">
              <a class="page-project-media" href="assets/work/thegifterysolutions-big.jpg" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/thegifterysolutions.jpg" alt="The Giftery Solutions" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Bespoke corporate gifting</p>
                <h2>The Giftery Solutions</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A premium gifting company needed an inspiring digital catalogue to present curated gift hampers to corporate HR teams and event planners.</p></div>
                  <div><h3>What we did</h3><p>Occasion-based product categorization, bespoke hamper showcase, and quick bulk quote request tools.</p></div>
                  <div><h3>Outcome</h3><p>A professional gifting storefront leading to consistent enterprise orders and repeat festive contracts.</p></div>
                </div>
                <a class="btn btn-primary" href="assets/work/thegifterysolutions-big.jpg" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="usam">
              <a class="page-project-media" href="https://usam.in/" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/usam.jpg" alt="USAM CAD Soft" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">CAD software &amp; engineering solutions</p>
                <h2>USAM CAD Soft</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>An engineering technology provider needed a well-structured site to detail specialized CAD, BIM, and PLM software solutions and training.</p></div>
                  <div><h3>What we did</h3><p>Enterprise software cataloging, vendor solution overviews, and consultation demo inquiry forms.</p></div>
                  <div><h3>Outcome</h3><p>Clear software positioning and steady inbound demo requests from engineering and architectural firms.</p></div>
                </div>
                <a class="btn btn-primary" href="https://usam.in/" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
            <article class="page-project" id="oohmexicano">
              <a class="page-project-media" href="assets/work/oohmexicano-big.jpg" target="_blank" rel="noopener noreferrer">
                <img src="assets/work/oohmexicano.jpg" alt="OohMexicano" width="800" height="560" loading="lazy">
              </a>
              <div class="page-project-body">
                <p class="page-project-tag">Mexican restaurant &amp; quick-service dining</p>
                <h2>OohMexicano</h2>
                <div class="page-project-meta">
                  <div><h3>Challenge</h3><p>A festive Mexican dining brand needed an energetic digital space to showcase its authentic menu, dining atmosphere, and party catering.</p></div>
                  <div><h3>What we did</h3><p>Appetizing menu showcase, location and timing details, and direct table reservation and party booking links.</p></div>
                  <div><h3>Outcome</h3><p>Increased footfall, stronger local recognition, and higher party and catering bookings.</p></div>
                </div>
                <a class="btn btn-primary" href="assets/work/oohmexicano-big.jpg" target="_blank" rel="noopener noreferrer">View project</a>
              </div>
            </article>
        </div>
      </div>
    </section>
  
    <section class="about-cta about-cta--red" aria-labelledby="portfolio-cta-title">
      <div class="about-cta-pattern" aria-hidden="true"></div>
      <div class="wrap about-cta-inner">
        <div class="about-cta-copy">
          <p class="pill">Next step</p>
          <h2 id="portfolio-cta-title">
            See results in action.
            <em>Build your next win.</em>
          </h2>
          <p>Review the campaigns and digital products we’ve delivered — then let’s map a plan that fits your goals, market, and budget.</p>
          <div class="about-cta-actions">
            <a class="btn btn-white" href="{{ url('/contact') }}">Get a free consultation</a>
            <span class="or" aria-hidden="true">or</span>
            <a class="btn btn-black" href="{{ url('/portfolios') }}">See the work</a>
          </div>
        </div>
        <aside class="about-cta-panel about-cta-panel--creative">
          <div class="about-cta-panel-glow" aria-hidden="true"></div>
          <div class="about-cta-panel-top">
            <span class="about-cta-live"><i></i> Available now</span>
            <p class="about-cta-kicker">Prefer a direct call?</p>
          </div>
          <div class="about-cta-phones">
            <a class="about-cta-phone" href="tel:+919582792638">
              <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
              <span>
                <small>Delhi NCR</small>
                <strong>+91 95827 92638</strong>
              </span>
            </a>
            <a class="about-cta-phone" href="tel:+919829069519">
              <span class="about-cta-phone-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.8 21 3 13.2 3 3.7c0-.6.4-1 1-1H7.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1L6.6 10.8z"/></svg></span>
              <span>
                <small>Jaipur</small>
                <strong>+91 98290 69519</strong>
              </span>
            </a>
          </div>
          <a class="about-cta-wa" href="https://wa.me/919582792638" target="_blank" rel="noopener noreferrer">
            <span class="about-cta-wa-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="currentColor" d="M12.04 2C6.58 2 2.15 6.4 2.15 11.83c0 1.74.46 3.44 1.34 4.94L2 22l5.39-1.4a10 10 0 0 0 4.65 1.18h.01c5.46 0 9.89-4.4 9.89-9.83C21.94 6.4 17.5 2 12.04 2zm5.76 13.92c-.24.68-1.4 1.3-1.94 1.38-.5.07-1.12.1-1.81-.11-.42-.13-.95-.3-1.64-.59-2.88-1.24-4.76-4.14-4.9-4.33-.14-.19-1.16-1.54-1.16-2.94s.73-2.08 1-2.37c.24-.27.64-.4 1.02-.4.12 0 .23 0 .33.01.3.01.45.03.65.5.24.58.82 2 .89 2.15.07.14.12.32.02.51-.09.19-.14.31-.28.48-.14.16-.29.37-.41.49-.14.14-.28.29-.12.56.16.27.71 1.17 1.53 1.9 1.05.94 1.94 1.23 2.21 1.37.27.14.43.12.59-.07.16-.19.68-.79.86-1.06.18-.27.36-.22.6-.13.24.09 1.54.73 1.8.86.27.13.44.2.51.31.06.11.06.64-.18 1.32z"/></svg></span>
            <span>
              <strong>WhatsApp the team</strong>
              <small>Usually replies in minutes</small>
            </span>
          </a>
        </aside>
      </div>
    </section>
  
@endsection
