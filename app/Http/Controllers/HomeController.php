<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\SiteParameter;

use App\Models\HomeSlide;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomeSlide::orderBy('sort_order')->orderBy('id')->get();
        $testimonials = Testimonial::orderBy('sort_order')->orderBy('id')->get();
        $homePage = \App\Models\CmsPage::where('slug', 'home')->first();
        $blogs = \App\Models\Blog::orderBy('published_at', 'desc')->orderBy('id', 'desc')->take(3)->get();
        return view('index', compact('slides', 'testimonials', 'homePage', 'blogs'));
    }

    public function about()
    {
        $aboutPage = \App\Models\CmsPage::where('slug', 'about-us')->first();
        return view('about', compact('aboutPage'));
    }

    public function collections()
    {
        $collectionsPage = \App\Models\CmsPage::where('slug', 'collections')->first();
        $collections = \App\Models\Collection::where('status', true)->orderBy('id')->get();
        return view('collections', compact('collections', 'collectionsPage'));
    }

    public function collectionShow($slug)
    {
        $collection = \App\Models\Collection::where('slug', $slug)->where('status', true)->firstOrFail();
        $marbles = $collection->marbles()->where('status', true)->get();
        return view('collections.show', compact('collection', 'marbles'));
    }

    public function marbleShow($slug)
    {
        $marble = \App\Models\Marble::where('slug', $slug)->where('status', true)->firstOrFail();
        $relatedCollections = $marble->collections()->get();
        return view('products.show', compact('marble', 'relatedCollections'));
    }

    public function application()
    {
        $applicationPage = \App\Models\CmsPage::where('slug', 'application')->first();
        return view('application.index', compact('applicationPage'));
    }

    public function applicationShow($slug)
    {
        $applicationPage = \App\Models\CmsPage::where('slug', 'application')->first();
        
        $spaces = [
            'flooring' => [
                'slug' => 'flooring',
                'title' => 'Italian Marble Flooring',
                'headline' => 'Timeless Grandeur Underfoot',
                'description' => 'Transform living rooms, master hallways, and grand entryways with seamless mirror-polished Italian marble slabs featuring continuous natural veining and bookmatching.',
                'hero_image' => 'uploads/collection/italian_marble_statuario_salon.jpg',
                'metatitle' => 'Italian Marble Flooring Design & Price Per Sq Ft | Stone Hub India',
                'metadescription' => 'Explore premium Italian marble flooring with mirror-polished finishes, large format slabs, and bookmatching designs from Stone Hub India Kishangarh.',
                'metakeywords' => 'italian marble flooring, marble floor design, marble flooring cost, statuario flooring',
                'specs' => [
                    'thickness' => '18mm - 20mm Calibrated',
                    'finish' => 'High Gloss Mirror Polish / Silk Honed',
                    'durability' => 'Very High Abrasion Resistance',
                    'pattern' => 'Open-Book & Cross Vein Matching'
                ],
                'gallery' => [
                    ['file' => '580802311_23_11_2019_12_31_01.jpg', 'title' => 'Statuario White Floor Bookmatching'],
                    ['file' => '580372193_23_11_2019_12_26_44.jpg', 'title' => 'Seamless Italian Marble Hallway'],
                    ['file' => '162114114_23_11_2019_12_27_16.jpg', 'title' => 'Black Marble Floor Inlay Border'],
                    ['file' => '607198761_14_12_2019_01_10_41.jpg', 'title' => 'High Gloss Living Room Marble'],
                    ['file' => '640536833_14_12_2019_12_23_00.jpg', 'title' => 'White Carrara Marble Flooring'],
                    ['file' => '6408372_14_12_2019_12_22_47.jpg', 'title' => 'Designer Marble Floor Border Layout']
                ],
                'search_tags' => ['statuario', 'botticino', 'michael angelo', 'laurent', 'armani', 'white']
            ],
            'living-room' => [
                'slug' => 'living-room',
                'title' => 'Living Room & Accent Walls',
                'headline' => 'The Focal Center of Luxury Architecture',
                'description' => 'Make a breathtaking architectural statement with bookmatched marble TV backdrops, four-piece quad-matched feature walls, and opulent living lounge surfaces.',
                'hero_image' => 'uploads/collection/brown_earth_marble_living.jpg',
                'metatitle' => 'Living Room Italian Marble & Feature Wall Design | Stone Hub India',
                'metadescription' => 'Discover living room marble wall designs, TV unit backdrops, and imported marble lounge surfaces from Stone Hub India Kishangarh.',
                'metakeywords' => 'living room marble, marble tv wall, bookmatch marble wall, italian marble living room',
                'specs' => [
                    'thickness' => '16mm - 18mm Cladding / 20mm Flooring',
                    'finish' => 'High Gloss / Leathered / Backlit Translucent',
                    'durability' => 'Medium to High (Wall & Lounge)',
                    'pattern' => '4-Piece Quad Bookmatch & Vein Flow'
                ],
                'gallery' => [
                    ['file' => '655029462_23_11_2019_12_35_50.jpg', 'title' => 'Bookmatched TV Feature Wall'],
                    ['file' => '2520108_23_11_2019_12_36_17.jpg', 'title' => 'Living Room Italian Marble Lounge'],
                    ['file' => '864392735_23_11_2019_12_36_49.jpg', 'title' => 'Contemporary Living Room Flooring'],
                    ['file' => '937080318_23_11_2019_12_37_43.jpg', 'title' => 'Natural Vein Accent Wall Cladding'],
                    ['file' => '519006335_14_12_2019_11_56_08.jpg', 'title' => 'Imported Marble Fireplace Backdrop'],
                    ['file' => '797714032_14_12_2019_11_56_26.jpg', 'title' => 'Luxury Double-Height Wall Paneling']
                ],
                'search_tags' => ['calacatta', 'patagonia', 'portoro', 'onyx', 'statuario', 'grey']
            ],
            'lobby' => [
                'slug' => 'lobby',
                'title' => 'Grand Lobby & Entrance Architecture',
                'headline' => 'First Impressions of Unrivaled Prestige',
                'description' => 'Architectural imported marble engineered for monumental residential foyers, corporate headquarters, 5-star hotel receptions, and elevator cladding with heavy-duty footfall durability.',
                'hero_image' => 'uploads/collection/imported_marble_grand_foyer.jpg',
                'metatitle' => 'Marble Lobby Design & Imported Stone for Foyers | Stone Hub India',
                'metadescription' => 'Elevate entrance foyers, hotel lobbies, and corporate atriums with imported marble slabs and waterjet border inlays from Stone Hub India.',
                'metakeywords' => 'marble lobby, hotel entrance marble, lobby marble design, foyer marble stone',
                'specs' => [
                    'thickness' => '18mm - 20mm Heavy Duty',
                    'finish' => 'Ultra Mirror Polish / Honed Satin',
                    'durability' => 'Extra Heavy Commercial Footfall',
                    'pattern' => 'Radial Geometric & Continuous Vein Inlay'
                ],
                'gallery' => [
                    ['file' => '945181111_23_11_2019_12_34_31.jpg', 'title' => 'Grand Hotel Entrance Foyer'],
                    ['file' => '739393487_14_12_2019_12_04_52.jpg', 'title' => 'Corporate Atrium Marble Flooring'],
                    ['file' => '77730246_12_12_2019_05_33_24.jpg', 'title' => 'Residential Villa Entrance Hall'],
                    ['file' => '304455326_14_12_2019_12_05_03.jpg', 'title' => 'Bookmatched Elevator Surround'],
                    ['file' => '480037006_14_12_2019_12_05_14.jpg', 'title' => 'Commercial Reception Counter Cladding'],
                    ['file' => '899221966_14_12_2019_12_05_30.jpg', 'title' => 'Double Height Foyer Wall Paneling']
                ],
                'search_tags' => ['statuario', 'flurry', 'perlato', 'patagonia', 'michael angelo']
            ],
            'outdoor-travertine' => [
                'slug' => 'outdoor-travertine',
                'title' => 'Outdoor Travertine & Exterior Facades',
                'headline' => 'Nature-Carved Resilience for Exterior Spaces',
                'description' => 'Natural pitted Travertine Romano and Titanium Travertine for villa terraces, swimming pool surrounds, ventilated wall facades, and garden pathways. Naturally heat-dissipating and slip-resistant.',
                'hero_image' => 'uploads/collection/classic_travertine_villa_terrace.jpg',
                'metatitle' => 'Outdoor Travertine & Exterior Facade Marble | Stone Hub India',
                'metadescription' => 'Buy imported Travertine Romano, Silver Travertine, and outdoor cladding slabs at best prices in Kishangarh from Stone Hub India.',
                'metakeywords' => 'outdoor travertine, travertine marble price, pool deck stone, exterior wall cladding marble',
                'specs' => [
                    'thickness' => '20mm - 30mm Exterior Grade',
                    'finish' => 'Honed & Unfilled / Tumbled / Sandblasted',
                    'durability' => 'Weather, Frost & UV Stable',
                    'pattern' => 'Linear Cross Cut & Vein Cut Earthy Tones'
                ],
                'gallery' => [
                    ['file' => '936578013_14_12_2019_11_51_27.jpg', 'title' => 'Villa Outdoor Travertine Patio'],
                    ['file' => '115543566_14_12_2019_11_51_52.jpg', 'title' => 'Swimming Pool Decking Travertine'],
                    ['file' => '350849451_23_11_2019_12_41_06.jpg', 'title' => 'Ventilated Exterior Wall Cladding'],
                    ['file' => '332469450_23_11_2019_12_41_30.jpg', 'title' => 'Italian Travertine Romano Flooring'],
                    ['file' => '313447642_23_11_2019_12_41_55.jpg', 'title' => 'Garden Pathway & Terrace Slabs'],
                    ['file' => '784685789_14_12_2019_11_53_13.jpg', 'title' => 'Silver Travertine Exterior Facade']
                ],
                'search_tags' => ['travertine', 'titanium', 'silver', 'romano', 'beige']
            ],
            'kitchen' => [
                'slug' => 'kitchen',
                'title' => 'Kitchen Countertops & Waterfall Islands',
                'headline' => 'Culinary Artistry Meets Enduring Strength',
                'description' => 'Monolithic waterfall edge kitchen islands, dining tabletops, and stain-sealed cooktop slabs. Engineered with high-density exotic quartzite and Italian marble for heat and scratch resistance.',
                'hero_image' => 'uploads/collection/exotic_quartzite_patagonia_island.jpg',
                'metatitle' => 'Kitchen Marble Countertops & Quartzite Waterfall Islands | Stone Hub India',
                'metadescription' => 'Custom fabrication of luxury kitchen countertops, dining tabletops, and waterfall islands in exotic quartzite and Italian marble from Stone Hub India.',
                'metakeywords' => 'kitchen marble countertop, quartzite waterfall island, kitchen slab design, calacatta kitchen',
                'specs' => [
                    'thickness' => '20mm Monolithic with Mitred Edge',
                    'finish' => 'Satin Leather / Diamond Polished',
                    'durability' => 'High Heat & Scratch Resistance',
                    'pattern' => 'Continuous Waterfall Edge Grain Matching'
                ],
                'gallery' => [
                    ['file' => '457172252_20_11_2019_03_53_13.jpg', 'title' => 'Calacatta Marble Waterfall Island'],
                    ['file' => '818725205_11_12_2019_03_05_18.jpg', 'title' => 'Seamless Dining Tabletop Slab'],
                    ['file' => '580802311_23_11_2019_12_31_01.jpg', 'title' => 'Stain-Resistant Sealed Kitchen Counter'],
                    ['file' => '162114114_23_11_2019_12_27_16.jpg', 'title' => 'Black Marble Backsplash & Island']
                ],
                'search_tags' => ['calacatta', 'patagonia', 'marquina', 'quartzite', 'statuario', 'blue roma']
            ],
            'bathroom-marble-design' => [
                'slug' => 'bathroom-marble-design',
                'title' => 'Luxury Bathrooms & Washroom Suites',
                'headline' => 'Private Spa Retreats in Pure Stone',
                'description' => 'Indulge in sanctuary-like five-star bathroom suites with bookmatched shower enclosures, floating marble vanity tops, integrated monolithic sinks, and honed anti-slip flooring.',
                'hero_image' => 'uploads/collection/black_gold_bath_suite.jpg',
                'metatitle' => 'Bathroom Marble Design & Luxury Washroom Vanity Slabs | Stone Hub India',
                'metadescription' => 'Transform bathrooms into luxury spas with bookmatched Italian marble shower walls, vanity counters, and anti-slip honed flooring from Stone Hub India.',
                'metakeywords' => 'bathroom marble design, italian marble washroom, vanity marble slab, bookmatch shower marble',
                'specs' => [
                    'thickness' => '16mm Wall Cladding / 18mm Honed Flooring',
                    'finish' => 'Silk Honed (Anti-Slip) & Mirror Wall Cladding',
                    'durability' => 'Hydrophobic Epoxy Impregnation',
                    'pattern' => 'Bookmatched Mirror Vanity Walls'
                ],
                'gallery' => [
                    ['file' => '283366348_23_11_2019_12_42_53.jpg', 'title' => 'Bookmatched Master Shower Enclosure'],
                    ['file' => '357971031_23_11_2019_12_44_05.jpg', 'title' => 'Floating Italian Marble Vanity Top'],
                    ['file' => '262501644_23_11_2019_12_44_33.jpg', 'title' => 'Freestanding Bathtub Surround in Black Portoro'],
                    ['file' => '429240745_23_11_2019_12_44_57.jpg', 'title' => 'Seamless Anti-Skid Honed Bathroom Floor'],
                    ['file' => '625387927_23_11_2019_12_45_24.jpg', 'title' => 'Integrated Monolithic Stone Basin'],
                    ['file' => '706757095_23_11_2019_12_45_46.jpg', 'title' => 'Powder Room Onyx Translucent Accent Wall']
                ],
                'search_tags' => ['statuario', 'portoro', 'onyx', 'blue lagoon', 'armani', 'pink onyx']
            ],
            'washrooms' => [
                'slug' => 'bathroom-marble-design',
                'title' => 'Luxury Bathrooms & Washroom Suites',
                'headline' => 'Private Spa Retreats in Pure Stone',
                'description' => 'Indulge in sanctuary-like five-star bathroom suites with bookmatched shower enclosures, floating marble vanity tops, integrated monolithic sinks, and honed anti-slip flooring.',
                'hero_image' => 'uploads/collection/black_gold_bath_suite.jpg',
                'metatitle' => 'Bathroom Marble Design & Luxury Washroom Vanity Slabs | Stone Hub India',
                'metadescription' => 'Transform bathrooms into luxury spas with bookmatched Italian marble shower walls, vanity counters, and anti-slip honed flooring from Stone Hub India.',
                'metakeywords' => 'bathroom marble design, italian marble washroom, vanity marble slab, bookmatch shower marble',
                'specs' => [
                    'thickness' => '16mm Wall Cladding / 18mm Honed Flooring',
                    'finish' => 'Silk Honed (Anti-Slip) & Mirror Wall Cladding',
                    'durability' => 'Hydrophobic Epoxy Impregnation',
                    'pattern' => 'Bookmatched Mirror Vanity Walls'
                ],
                'gallery' => [
                    ['file' => '283366348_23_11_2019_12_42_53.jpg', 'title' => 'Bookmatched Master Shower Enclosure'],
                    ['file' => '357971031_23_11_2019_12_44_05.jpg', 'title' => 'Floating Italian Marble Vanity Top'],
                    ['file' => '262501644_23_11_2019_12_44_33.jpg', 'title' => 'Freestanding Bathtub Surround in Black Portoro'],
                    ['file' => '429240745_23_11_2019_12_44_57.jpg', 'title' => 'Seamless Anti-Skid Honed Bathroom Floor'],
                    ['file' => '625387927_23_11_2019_12_45_24.jpg', 'title' => 'Integrated Monolithic Stone Basin'],
                    ['file' => '706757095_23_11_2019_12_45_46.jpg', 'title' => 'Powder Room Onyx Translucent Accent Wall']
                ],
                'search_tags' => ['statuario', 'portoro', 'onyx', 'blue lagoon', 'armani', 'pink onyx']
            ]
        ];

        if (!isset($spaces[$slug])) {
            $col = \App\Models\Collection::where('slug', $slug)->first();
            if ($col) {
                return redirect()->route('collections.show', $slug);
            }
            abort(404);
        }

        $spaceData = $spaces[$slug];
        $galleryImages = $spaceData['gallery'] ?? [];

        // Curate matching marbles from database
        $searchTags = $spaceData['search_tags'] ?? [];
        $curatedMarbles = \App\Models\Marble::where('status', true)
            ->where(function($q) use ($searchTags, $slug) {
                foreach ($searchTags as $tag) {
                    $q->orWhere('name', 'like', "%{$tag}%")
                      ->orWhere('description', 'like', "%{$tag}%")
                      ->orWhere('applications', 'like', "%{$slug}%");
                }
            })
            ->take(6)
            ->get();

        if ($curatedMarbles->isEmpty()) {
            $curatedMarbles = \App\Models\Marble::where('status', true)->take(6)->get();
        }

        return view('application.show', compact('spaceData', 'galleryImages', 'curatedMarbles', 'applicationPage'));
    }

    public function applicationConsultationSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email|max:255',
        ]);

        $space = $request->input('space', 'General Application');
        $compiled = "Application Space: " . $space . "\n";
        if ($request->filled('city')) {
            $compiled .= "City/Location: " . $request->city . "\n";
        }
        if ($request->filled('area_sqft')) {
            $compiled .= "Estimated Area: " . $request->area_sqft . "\n";
        }
        if ($request->filled('message')) {
            $compiled .= "Requirements: " . $request->message . "\n";
        }

        $lead = \App\Models\Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $compiled,
            'source' => $request->input('source', 'Application Consultation - ' . $space),
            'status' => 'New',
        ]);

        return redirect()->back()->with('success', 'Thank you! Your space consultation request has been received. Our stone specialist will reach out with curated slabs shortly.');
    }

    public function enquiry()
    {
        $enquiryPage = \App\Models\CmsPage::where('slug', 'enquiry')->first();
        return view('enquiry', compact('enquiryPage'));
    }

    public function enquirySubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email|max:255',
            'city' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,dwg|max:20480',
        ]);

        $spaces = $request->input('spaces', []);
        $stones = $request->input('stone_preference', []);

        $compiled = "=== LUXURY PROJECT QUOTATION SPECIFICATIONS ===\n\n";
        $compiled .= "• Client Type / Role: " . ($request->input('project_type', 'Villa / Homeowner')) . "\n";
        $compiled .= "• Project Delivery City: " . ($request->city) . "\n";
        $compiled .= "• Estimated Area: " . ($request->input('area_sqft', '1,000 - 3,000 sq. ft.')) . "\n";
        $compiled .= "• Slab Thickness: " . ($request->input('thickness', '18mm Standard Calibrated')) . "\n";
        
        if (!empty($spaces)) {
            $compiled .= "\n• Application Spaces:\n  - " . implode("\n  - ", (array)$spaces) . "\n";
        }
        
        if (!empty($stones)) {
            $compiled .= "\n• Preferred Stones / Tones:\n  - " . implode("\n  - ", (array)$stones) . "\n";
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/enquiries'), $fileName);
            $fileUrl = asset('uploads/enquiries/' . $fileName);
            $compiled .= "\n• Attached Floor Plan / BOQ File:\n  " . $fileUrl . "\n";
        }

        if ($request->filled('message')) {
            $compiled .= "\n• Additional Notes & Timeline:\n  " . $request->message . "\n";
        }

        $lead = \App\Models\Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $compiled,
            'source' => 'Project Enquiry Form',
            'status' => 'New',
        ]);

        return redirect()->back()->with('success', 'Your project quotation enquiry has been registered with our Kishangarh stockyard team.');
    }

    public function careers()
    {
        $careersPage = \App\Models\CmsPage::where('slug', 'career')->first();
        return view('careers', compact('careersPage'));
    }

    public function careerSubmit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email|max:255',
            'position' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $resumeUrl = '';
        if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/resumes'), $fileName);
            $resumeUrl = asset('uploads/resumes/' . $fileName);
        }

        $fullName = trim($request->first_name . ' ' . $request->last_name);

        $compiled = "=== JOB APPLICATION PROFILE ===\n\n";
        $compiled .= "• Position Applied: " . ($request->position) . "\n";
        $compiled .= "• Candidate Name: " . $fullName . "\n";
        $compiled .= "• Contact Phone: " . $request->phone . "\n";
        $compiled .= "• Contact Email: " . $request->email . "\n";
        $compiled .= "• Total Experience: " . ($request->input('experience_years', 'N/A')) . "\n";
        $compiled .= "• Qualification: " . ($request->input('qualification', 'N/A')) . "\n";
        $compiled .= "• Current Role: " . ($request->input('current_designation', 'N/A')) . " @ " . ($request->input('current_company', 'N/A')) . "\n";
        $compiled .= "• Compensation: Current " . ($request->input('current_ctc', 'N/A')) . " | Expected " . ($request->input('expected_ctc', 'N/A')) . "\n";
        
        if ($resumeUrl) {
            $compiled .= "\n• Resume / CV Download:\n  " . $resumeUrl . "\n";
        }

        if ($request->filled('message')) {
            $compiled .= "\n• Candidate Statement & Address:\n  " . $request->message . "\n";
        }

        $lead = \App\Models\Lead::create([
            'name' => $fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $compiled,
            'source' => 'Careers Application - ' . $request->position,
            'status' => 'New',
        ]);

        return redirect()->back()->with('success', 'Your application for ' . $request->position . ' has been submitted successfully. Our HR team will review your profile and connect with you.');
    }

    public function infra()
    {
        $infraPage = \App\Models\CmsPage::where('slug', 'infrastructure')->first();
        return view('infrastructure', compact('infraPage'));
    }

    public function locationShow($city, $slug = 'imported-marble-seller')
    {
        $citySlug = \Illuminate\Support\Str::slug($city);

        // City alias normalizations
        $cityAliases = [
            'delhi' => 'new-delhi',
            'bengaluru' => 'bangalore',
            'calcutta' => 'kolkata',
            'bombay' => 'mumbai',
            'madras' => 'tamil-nadu',
            'orissa' => 'odisha',
        ];
        if (isset($cityAliases[$citySlug])) {
            $citySlug = $cityAliases[$citySlug];
        }
        $cityClean = str_replace('-', ' ', $citySlug);
        
        $locationPage = \App\Models\LocationPage::where(function($q) use ($city, $citySlug, $cityClean) {
                $q->where('city', $city)
                  ->orWhere('city', $citySlug)
                  ->orWhere('city', $cityClean)
                  ->orWhereRaw('LOWER(REPLACE(city, " ", "-")) = ?', [$citySlug])
                  ->orWhereRaw('LOWER(REPLACE(city, "-", " ")) = ?', [$cityClean]);
            })
            ->where('status', true)
            ->first();

        if (!$locationPage) {
            // Check JSON content city_slug fallback
            $all = \App\Models\LocationPage::where('status', true)->get();
            foreach ($all as $item) {
                $slugInContent = $item->content['city_slug'] ?? \Illuminate\Support\Str::slug($item->city);
                if ($slugInContent === $citySlug || $slugInContent === $city) {
                    $locationPage = $item;
                    break;
                }
            }
        }

        if (!$locationPage) {
            abort(404);
        }
        
        $featuredMarbles = \App\Models\Marble::where('status', true)->with('collections')->take(8)->get();
        $marbles = $featuredMarbles;
        $allCities = \App\Models\LocationPage::where('status', true)
            ->where('id', '!=', $locationPage->id)
            ->orderBy('city', 'asc')
            ->get();
        $testimonials = \App\Models\Testimonial::orderBy('sort_order')->take(6)->get();
        $collections = \App\Models\Collection::where('status', true)->orderBy('id')->take(6)->get();

        return view('location-page', compact('locationPage', 'marbles', 'featuredMarbles', 'allCities', 'testimonials', 'collections'));
    }

    public function locationShowCityIn($city, $sub)
    {
        return $this->locationShow($city, 'imported-marble-seller');
    }



    public function testimonials()
    {
        $testimonialPage = \App\Models\CmsPage::where('slug', 'testimonials')->first();
        $testimonials = Testimonial::orderBy('sort_order')->orderBy('id')->get();
        return view('testimonials', compact('testimonials', 'testimonialPage'));
    }

    public function faq()
    {
        $faqPage = \App\Models\CmsPage::where('slug', 'faqs')->first();
        $collections = \App\Models\Collection::where('status', true)->orderBy('id')->get();
        return view('faq', compact('collections', 'faqPage'));
    }

    public function italianMarblePricelist()
    {
        $items = italian_marble_pricelist();
        return view('pricelist.index', compact('items'));
    }

    public function productsCatalog(Request $request)
    {
        $productsPage = \App\Models\CmsPage::where('slug', 'products')->first();
        $query = \App\Models\Marble::where('status', true)->with('collections');

        if ($request->filled('collection')) {
            $colSlug = $request->input('collection');
            $query->whereHas('collections', function($q) use ($colSlug) {
                $q->where('slug', $colSlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('origin', 'like', "%{$search}%")
                  ->orWhere('finishes', 'like', "%{$search}%");
            });
        }

        $marbles = $query->orderBy('name', 'asc')->paginate(18)->withQueryString();
        $collections = \App\Models\Collection::where('status', true)->orderBy('name')->get();

        return view('products.index', compact('marbles', 'collections', 'productsPage'));
    }

    public function importedMarbleShow($slug)
    {
        // Check if rich Marble model exists
        $marble = \App\Models\Marble::where('slug', $slug)->where('status', true)->first();
        if ($marble) {
            $relatedCollections = $marble->collections()->get();
            return view('products.show', compact('marble', 'relatedCollections'));
        }

        $item = italian_marble_by_slug($slug);
        if (!$item) {
            abort(404);
        }

        $related = collect(italian_marble_pricelist())
            ->reject(fn ($row) => ($row['slug'] ?? '') === $slug)
            ->shuffle()
            ->take(4)
            ->values()
            ->all();

        return view('pricelist.show', compact('item', 'related'));
    }

    public function blog(Request $request)
    {
        $blogsPage = \App\Models\CmsPage::where('slug', 'blogs')->first();
        $blogs = \App\Models\Blog::orderBy('published_at', 'desc')->orderBy('id', 'desc')->paginate(9);
        
        if ($request->ajax()) {
            $html = '';
            foreach ($blogs as $blog) {
                $html .= view('blog.partials.card', compact('blog'))->render();
            }
            return response()->json([
                'html' => $html,
                'next_page' => $blogs->nextPageUrl()
            ]);
        }
        
        return view('blog.index', compact('blogs', 'blogsPage'));
    }

    public function blogShow($slug)
    {
        $blog = \App\Models\Blog::where('slug', $slug)->first();
        if ($blog) {
            return view('blog.show', compact('blog'));
        }
        abort(404);
    }

    public function contact()
    {
        $contactPage = \App\Models\CmsPage::where('slug', 'contact-us')->first();
        return view('contact', compact('contactPage'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email|max:255',
        ]);

        $siteSettings = \App\Models\SiteParameter::all()->pluck('value', 'id')->toArray();
        
        // 1. Build detailed compilation message
        $compiledMessage = '';
        if ($request->filled('loan_type')) {
            $compiledMessage .= 'Loan Type: ' . ucwords($request->loan_type) . "\n";
        }
        if ($request->filled('amount')) {
            $compiledMessage .= 'Expected Amount: ₹' . number_format($request->amount) . "\n";
        }
        if ($request->filled('service')) {
            $compiledMessage .= 'Service: ' . str_replace('-', ' ', ucwords($request->service)) . "\n";
        }
        if ($request->filled('message')) {
            $compiledMessage .= 'Details: ' . $request->message . "\n";
        }

        // 2. Save Lead immediately to guarantee it is saved in the database FIRST
        // Auto-create leads table if it doesn't exist
        if (!\Illuminate\Support\Facades\Schema::hasTable('leads')) {
            try {
                \Illuminate\Support\Facades\Schema::create('leads', function (\Illuminate\Database\Schema\Blueprint $table) {
                    $table->id();
                    $table->string('name');
                    $table->string('phone');
                    $table->string('email')->nullable();
                    $table->text('message')->nullable();
                    $table->string('source')->default('Contact Form');
                    $table->string('status')->default('New');
                    $table->text('notes')->nullable();
                    $table->timestamps();
                });
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Leads table creation failed: ' . $e->getMessage());
            }
        }

        $lead = \App\Models\Lead::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'message' => $compiledMessage ?: 'Requesting a quick callback/consultation.',
            'source'  => $request->input('source', 'Contact Form'),
            'status'  => 'New',
        ]);

        // 3. Google reCAPTCHA Verification (if enabled in settings)
        $isSpam = false;
        $spamReason = '';
        if (!empty($siteSettings['recaptcha_enabled']) && $siteSettings['recaptcha_enabled'] == '1' && !empty($siteSettings['recaptcha_site_key']) && !empty($siteSettings['recaptcha_secret_key'])) {
            try {
                $recaptchaResponse = $request->input('g-recaptcha-response');
                $secretKey = $siteSettings['recaptcha_secret_key'];
                
                if (empty($recaptchaResponse)) {
                    $isSpam = true;
                    $spamReason = 'reCAPTCHA response checkbox was empty/unchecked.';
                } else {
                    $verifyResponse = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => $secretKey,
                        'response' => $recaptchaResponse,
                        'remoteip' => $request->ip()
                    ]);
                    
                    if (!$verifyResponse->successful() || !$verifyResponse->json('success')) {
                        $isSpam = true;
                        $spamReason = 'reCAPTCHA verification failed on Google endpoint.';
                    }
                }
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('reCAPTCHA safety check encountered exception: ' . $e->getMessage());
            }

            // Update lead status if it was flagged as spam
            if ($isSpam && $lead) {
                try {
                    $lead->update([
                        'status' => 'Spam',
                        'notes' => 'Flagged: ' . $spamReason
                    ]);
                } catch (\Throwable $e) {
                    \Illuminate\Support\Facades\Log::warning('Failed to flag spam lead: ' . $e->getMessage());
                }
            }
        }

        // 4. Send Email Notification if SMTP settings are fully configured in the settings area
        if (!empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_username']) && !empty($siteSettings['smtp_password']) && !empty($siteSettings['smtp_to_email'])) {
            try {
                // Dynamically configure Laravel mailer settings
                config([
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => $siteSettings['smtp_host'],
                    'mail.mailers.smtp.port' => (int)($siteSettings['smtp_port'] ?? 587),
                    'mail.mailers.smtp.username' => $siteSettings['smtp_username'],
                    'mail.mailers.smtp.password' => $siteSettings['smtp_password'],
                    'mail.mailers.smtp.encryption' => ($siteSettings['smtp_encryption'] ?? 'tls') === 'none' ? null : ($siteSettings['smtp_encryption'] ?? 'tls'),
                    'mail.from.address' => $siteSettings['smtp_from_address'] ?? 'no-reply@mlgfinedge.com',
                    'mail.from.name' => $siteSettings['smtp_from_name'] ?? 'MLG Finedge Alerts',
                    'mail.default' => 'smtp',
                ]);

                // Purge SMTP mailer cache to force Laravel to re-read updated runtime configs
                \Illuminate\Support\Facades\Mail::purge('smtp');

                $toEmail = $siteSettings['smtp_to_email'];
                $fromAddress = $siteSettings['smtp_from_address'] ?? 'no-reply@mlgfinedge.com';
                $fromName = $siteSettings['smtp_from_name'] ?? 'MLG Finedge Alerts';
                $leadName = $lead->name;

                \Illuminate\Support\Facades\Mail::raw(
                    "New Lead Inquiry Received" . ($isSpam ? " [Flagged Spam]" : "") . ":\n\n" .
                    "Name: " . $lead->name . "\n" .
                    "Phone: " . $lead->phone . "\n" .
                    "Email: " . ($lead->email ?: 'N/A') . "\n" .
                    "Source: " . ($lead->source) . "\n\n" .
                    "Details:\n" . ($lead->message),
                    function ($message) use ($toEmail, $fromAddress, $fromName, $leadName) {
                        $message->to($toEmail)
                                ->subject('New Lead Inquiry: ' . $leadName)
                                ->from($fromAddress, $fromName);
                    }
                );
                
                \Illuminate\Support\Facades\Log::info('Email alert sent for lead: ' . $leadName);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('SMTP Lead Email Notification failed: ' . $e->getMessage() . ' | Line: ' . $e->getLine());
            }
        }

        // 5. Send WhatsApp Notification if WhatsApp API settings are fully configured in the settings area
        if (!empty($siteSettings['whatsapp_api_url']) && !empty($siteSettings['whatsapp_admin_recipient'])) {
            try {
                $apiUrl = $siteSettings['whatsapp_api_url'];
                $apiToken = $siteSettings['whatsapp_api_token'] ?? '';
                $recipient = $siteSettings['whatsapp_admin_recipient'];
                
                $textMessage = "New Lead Alert!" . ($isSpam ? " [Flagged Spam]" : "") . "\n" .
                              "Name: {$lead->name}\n" .
                              "Phone: {$lead->phone}\n" .
                              "Email: " . ($lead->email ?: 'N/A') . "\n" .
                              "Source: {$lead->source}\n" .
                              "Message: " . ($lead->message);
                
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiToken,
                    'Content-Type' => 'application/json',
                ])->post($apiUrl, [
                    'to' => $recipient,
                    'message' => $textMessage,
                    'phone' => $recipient,
                    'body' => $textMessage,
                    'text' => ['body' => $textMessage]
                ]);
                
                if ($response->successful()) {
                    \Illuminate\Support\Facades\Log::info('WhatsApp notification sent successfully for lead: ' . $lead->name);
                } else {
                    \Illuminate\Support\Facades\Log::warning('WhatsApp API returned error code: ' . $response->status() . ' | Response: ' . $response->body());
                }
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('WhatsApp notification failed: ' . $e->getMessage() . ' | Line: ' . $e->getLine());
            }
        }

        return redirect()->route('thank-you')->with('success', 'Your inquiry has been submitted successfully.');
    }

    public function landingShow($slug)
    {
        $landingPage = \App\Models\LandingPage::where('slug', $slug)->first();
        if ($landingPage) {
            return view('landing-page', compact('landingPage'));
        }
        abort(404);
    }

    public function thankYou()
    {
        return view('thank-you');
    }

    /* Clinic Specialists */
    public function specialists()
    {
        $specialistsPage = \App\Models\CmsPage::where('slug', 'specialists')->first();
        $specialists = \App\Models\TeamMember::where('status', true)->get();
        return view('specialists.index', compact('specialists', 'specialistsPage'));
    }


    public function specialistdetails($slug)
    {
        $specialist = \App\Models\TeamMember::where('slug', $slug)->where('status', true)->firstOrFail();
        return view('specialists.show', compact('specialist'));
    }



    /* CMS Pages catch-all */
    public function cmsPageShow($slug)
    {
        $page = \App\Models\CmsPage::where('slug', $slug)->where('status', true)->first();
        if ($page) {
            return view('cms-page', compact('page'));
        }

        // Check if $slug matches a City / Location Page
        $cityPage = \App\Models\LocationPage::where(function($q) use ($slug) {
                $q->where('city', $slug)->orWhere('city', \Illuminate\Support\Str::slug($slug));
            })
            ->where('status', true)
            ->first();

        if ($cityPage) {
            return redirect()->route('location.city.seller', ['city' => $cityPage->city], 301);
        }

        abort(404);
    }

    public function visualizeSlab(Request $request, $slug)
    {
        $request->validate([
            'room_type' => 'required|string|in:living_room,kitchen,bathroom,lobby',
        ]);

        $marble = \App\Models\Marble::where('slug', $slug)->where('status', true)->firstOrFail();
        
        $apiKey = SiteParameter::where('id', 'gemini_api_key')->value('value');
        if (empty($apiKey)) {
            return response()->json(['error' => 'AI Visualization is currently unavailable (Gemini API Key not set in admin settings).'], 400);
        }

        $roomType = $request->input('room_type');
        $roomNames = [
            'living_room' => 'luxury living room flooring',
            'kitchen' => 'modern kitchen countertop and backsplash',
            'bathroom' => 'luxury bathroom wall cladding and vanity',
            'lobby' => 'grand hotel lobby entrance flooring'
        ];
        $roomDesc = $roomNames[$roomType];

        // Fetch original slab image file path/URL
        $rawImage = $marble->image;
        if (empty($rawImage)) {
            return response()->json(['error' => 'Product has no slab image configured.'], 400);
        }

        $imagePath = public_path(site_image($rawImage));
        if (!file_exists($imagePath)) {
            // Try storage fallback
            if (str_starts_with($rawImage, 'uploads/')) {
                $imagePath = public_path($rawImage);
            }
        }

        $base64Image = null;
        $mimeType = 'image/jpeg';

        try {
            if (file_exists($imagePath)) {
                $content = file_get_contents($imagePath);
            } else {
                // Try fetching absolute url
                $absUrl = asset(site_image($rawImage));
                $response = Http::timeout(5)->get($absUrl);
                $content = $response->successful() ? $response->body() : null;
            }

            if ($content) {
                $base64Image = base64_encode($content);
                // Determine mime type
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $detectedMime = $finfo->buffer($content);
                if ($detectedMime) {
                    $mimeType = $detectedMime;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to load slab image for AI visualizer: ' . $e->getMessage());
        }

        if (empty($base64Image)) {
            return response()->json(['error' => 'Unable to read slab image. Please verify the product image exists.'], 400);
        }

        // 2. Ask Gemini to analyze the slab texture and write a highly descriptive prompt for Imagen 3
        $geminiPrompt = "Analyze this natural stone slab image named '{$marble->name}'. Describe its base color, veining style, pattern direction, and character in detail. Then, write a detailed, highly descriptive prompt for an AI image generator (such as Imagen 3) to render a photo-realistic, luxury, high-end interior {$roomDesc} that uses this exact natural stone slab texture seamlessly. The output prompt must specify the lighting (e.g. warm sunlight, bright morning light), composition, and modern aesthetic. Return ONLY the final generated Imagen prompt, do not write any introductory or explanatory text.";

        $generatedPrompt = null;
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $geminiPrompt],
                            [
                                'inlineData' => [
                                    'mimeType' => $mimeType,
                                    'data' => $base64Image
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $resData = $response->json();
                $generatedPrompt = $resData['candidates'][0]['content']['parts'][0]['text'] ?? null;
            } else {
                Log::warning('Gemini prompt generation failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::warning('Gemini prompt generation exception: ' . $e->getMessage());
        }

        if (empty($generatedPrompt)) {
            // Fallback text prompt if Gemini fails
            $generatedPrompt = "A photo-realistic, ultra-luxury, bright interior photo of a {$roomDesc} featuring a premium custom natural stone marble resembling {$marble->name} with luxury veining patterns. 8k resolution, award-winning interior design, high-end furniture, dramatic soft ambient lighting.";
        }

        // Clean up prompt to remove markdown quotes or backticks
        $generatedPrompt = trim(str_replace(['`', '""', '"'], '', $generatedPrompt));

        // 3. Generate image using Imagen API
        $generatedImageBase64 = null;
        
        // Try Imagen 3 first
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/imagen-3.0-generate-002:generateImages?key={$apiKey}", [
                'prompt' => $generatedPrompt,
                'numberOfImages' => 1,
                'outputMimeType' => 'image/jpeg',
                'aspectRatio' => '16:9'
            ]);

            if ($response->successful()) {
                $resData = $response->json();
                $generatedImageBase64 = $resData['generatedImages'][0]['image']['imageBytes'] ?? null;
            } else {
                Log::warning('Imagen 3 visualizer generation failed: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::warning('Imagen 3 visualizer exception: ' . $e->getMessage());
        }

        // Try Gemini 3.1 flash image as a fallback
        if (empty($generatedImageBase64)) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-image:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $generatedPrompt]]]
                    ],
                    'generationConfig' => [
                        'response_modalities' => ['TEXT', 'IMAGE']
                    ]
                ]);

                if ($response->successful()) {
                    $resData = $response->json();
                    foreach ($resData['candidates'][0]['content']['parts'] ?? [] as $part) {
                        if (isset($part['inlineData']['data'])) {
                            $generatedImageBase64 = $part['inlineData']['data'];
                            break;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning('Gemini 3.1 image visualizer fallback exception: ' . $e->getMessage());
            }
        }

        if (empty($generatedImageBase64)) {
            return response()->json(['error' => 'AI Generation failed. Please verify that your API key is correct and has access to Imagen/Gemini model features.'], 500);
        }

        // Save generated image to public storage (create directory if not exist)
        $filename = 'visualizer_' . $marble->slug . '_' . $roomType . '_' . uniqid() . '.jpg';
        $saveDir = public_path('uploads/ai_visuals');
        if (!file_exists($saveDir)) {
            mkdir($saveDir, 0755, true);
        }
        
        file_put_contents($saveDir . '/' . $filename, base64_decode($generatedImageBase64));
        $imageUrl = asset('uploads/ai_visuals/' . $filename);

        return response()->json([
            'success' => true,
            'url' => $imageUrl,
            'prompt' => $generatedPrompt
        ]);
    }
}
