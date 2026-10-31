<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\SiteParameter;
use App\Models\Lead;
use Illuminate\Support\Facades\File;

class PublicApiController extends Controller
{
    /**
     * Get global site settings.
     */
    public function getSettings()
    {
        $parameters = SiteParameter::all()->pluck('value', 'id')->toArray();

        $data = [
            'site_name' => $parameters['site_name'] ?? 'SMAC Digital',
            'site_tagline' => $parameters['site_tagline'] ?? 'Performance-driven digital marketing agency',
            'email' => $parameters['primary_email'] ?? 'Jitendra@smacdigital.com',
            'phone' => $parameters['primary_phone'] ?? '+91-9829069519',
            'whatsapp' => $parameters['whatsapp_number'] ?? '+919582792638',
            'logo' => $parameters['logo_path'] ?? '/assets/brand/logo-white.png',
            'social' => [
                'facebook' => $parameters['social_facebook'] ?? 'https://www.facebook.com/smacdigi',
                'twitter' => $parameters['social_twitter'] ?? 'https://twitter.com/DigitalSmac',
                'linkedin' => $parameters['social_linkedin'] ?? 'https://www.linkedin.com/company/smac-digital-pvt-ltd',
                'instagram' => $parameters['social_instagram'] ?? 'https://www.instagram.com/smacdigital/'
            ]
        ];

        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * Get all services.
     */
    public function getServices()
    {
        $jsonPath = resource_path('js/data/servicesData.json');
        if (File::exists($jsonPath)) {
            $services = json_decode(File::get($jsonPath), true);
            return response()->json(['success' => true, 'data' => $services]);
        }
        return response()->json(['success' => true, 'data' => []]);
    }

    /**
     * Get single service by slug.
     */
    public function getService($slug)
    {
        $jsonPath = resource_path('js/data/servicesData.json');
        if (File::exists($jsonPath)) {
            $services = json_decode(File::get($jsonPath), true);
            foreach ($services as $service) {
                if ($service['slug'] === $slug) {
                    return response()->json(['success' => true, 'data' => $service]);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Service not found'], 404);
    }

    /**
     * Get all blogs (from database with fallback to JSON).
     */
    public function getBlogs()
    {
        $dbBlogs = Blog::orderBy('published_at', 'desc')->get();

        if ($dbBlogs->isNotEmpty()) {
            $formatted = $dbBlogs->map(function ($b) {
                return [
                    'id' => $b->id,
                    'slug' => $b->slug,
                    'title' => $b->title,
                    'tag' => $b->category ?? 'Insights',
                    'excerpt' => $b->summary,
                    'image' => $b->image_path ? (str_starts_with($b->image_path, 'http') || str_starts_with($b->image_path, '/') ? $b->image_path : '/' . $b->image_path) : '/assets/blog/lead-generation.jpg',
                    'date' => $b->published_at ? $b->published_at->format('Y-m-d') : $b->created_at->format('Y-m-d'),
                    'dateLabel' => $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y'),
                    'author' => 'SMAC Digital',
                    'readTime' => max(3, min(15, round(str_word_count(strip_tags($b->content)) / 200))) . ' min read',
                    'metatitle' => $b->metatitle,
                    'metadescription' => $b->metadescription,
                    'bodyHtml' => $b->content
                ];
            });
            return response()->json(['success' => true, 'data' => $formatted]);
        }

        $jsonPath = resource_path('js/data/blogsData.json');
        if (File::exists($jsonPath)) {
            $blogs = json_decode(File::get($jsonPath), true);
            return response()->json(['success' => true, 'data' => $blogs]);
        }

        return response()->json(['success' => true, 'data' => []]);
    }

    /**
     * Get single blog by slug.
     */
    public function getBlog($slug)
    {
        $b = Blog::where('slug', $slug)->first();

        if ($b) {
            $data = [
                'id' => $b->id,
                'slug' => $b->slug,
                'title' => $b->title,
                'tag' => $b->category ?? 'Insights',
                'excerpt' => $b->summary,
                'image' => $b->image_path ? (str_starts_with($b->image_path, 'http') || str_starts_with($b->image_path, '/') ? $b->image_path : '/' . $b->image_path) : '/assets/blog/lead-generation.jpg',
                'date' => $b->published_at ? $b->published_at->format('Y-m-d') : $b->created_at->format('Y-m-d'),
                'dateLabel' => $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y'),
                'author' => 'SMAC Digital',
                'readTime' => max(3, min(15, round(str_word_count(strip_tags($b->content)) / 200))) . ' min read',
                'metatitle' => $b->metatitle,
                'metadescription' => $b->metadescription,
                'bodyHtml' => $b->content
            ];
            return response()->json(['success' => true, 'data' => $data]);
        }

        $jsonPath = resource_path('js/data/blogsData.json');
        if (File::exists($jsonPath)) {
            $blogs = json_decode(File::get($jsonPath), true);
            foreach ($blogs as $blog) {
                if ($blog['slug'] === $slug) {
                    return response()->json(['success' => true, 'data' => $blog]);
                }
            }
        }

        return response()->json(['success' => false, 'message' => 'Article not found'], 404);
    }

    /**
     * Get testimonials from database or fallback.
     */
    public function getTestimonials()
    {
        $testimonials = Testimonial::orderBy('sort_order', 'asc')->get();

        if ($testimonials->isNotEmpty()) {
            return response()->json(['success' => true, 'data' => $testimonials]);
        }

        return response()->json(['success' => true, 'data' => [
            [
                'id' => 1,
                'quote' => 'Our contracts have gone higher by about one-third of what we were getting before we took the services from SMAC Digital. They helped us a lot in finding more new clients from all over India digitally through their great website setup and digital marketing strategy.',
                'author' => 'Stone Hub India',
                'role' => 'Imported Marble & Architectural Stone',
                'metric' => '+33% Contracts'
            ],
            [
                'id' => 2,
                'quote' => "It's been 12 months of our association with SMAC Digital. Their partnership, service delivery and quality control have made us stand out among our competitors, and are some of the key reasons for our expansion.",
                'author' => 'Tumbledry',
                'role' => 'Dry Clean & Laundry Chain',
                'metric' => '12 Months Partner'
            ],
            [
                'id' => 3,
                'quote' => 'Online learning and quizzing is on its zenith now and because of SMAC Digital, the students enrolled in our online learning platform Belearno are finding our website handy for their use.',
                'author' => 'Belearno',
                'role' => 'EdTech & Online Learning Platform',
                'metric' => 'UX & Reach'
            ],
            [
                'id' => 4,
                'quote' => 'SMAC Digital gave our interior designing business exposure to the world of the internet. They gave us steady growth by making our website greatly influential.',
                'author' => 'Casa Interno',
                'role' => 'Interior Architecture & Design',
                'metric' => 'Steady Growth'
            ]
        ]]);
    }

    /**
     * Submit lead brief from contact forms or brief modals.
     */
    public function submitLead(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|string|max:50',
            'service' => 'nullable|string',
            'company' => 'nullable|string|max:191',
            'message' => 'required|string',
            'landing_url' => 'nullable|string',
            'referrer_url' => 'nullable|string',
            'utm_source' => 'nullable|string',
            'utm_campaign' => 'nullable|string'
        ]);

        $composedMessage = '';
        if (!empty($validated['service'])) {
            $composedMessage .= "Services: " . $validated['service'] . "\n";
        }
        if (!empty($validated['company'])) {
            $composedMessage .= "Company: " . $validated['company'] . "\n";
        }
        $composedMessage .= "Requirements: " . $validated['message'];

        $lead = Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $composedMessage,
            'source' => $request->filled('utm_source') ? ('UTM: ' . $request->utm_source) : ($request->filled('landing_url') ? $request->landing_url : 'Website Lead Form'),
            'status' => 'new',
            'notes' => 'Received from SMAC Digital website form'
        ]);

        // Send Email Notification to Admin
        try {
            $siteSettings = SiteParameter::pluck('value', 'id')->toArray();
            $toEmail = !empty($siteSettings['smtp_to_email']) 
                ? $siteSettings['smtp_to_email'] 
                : (!empty($siteSettings['primary_email']) ? $siteSettings['primary_email'] : 'Jitendra@smacdigital.com');
            $fromAddress = $siteSettings['smtp_from_address'] ?? 'no-reply@smacdigital.com';
            $fromName = $siteSettings['smtp_from_name'] ?? 'SMAC Digital Alerts';

            $emailBody = "New Lead Inquiry Received on SMAC Digital Website:\n\n" .
                         "Name: " . $lead->name . "\n" .
                         "Email: " . $lead->email . "\n" .
                         "Phone: " . $lead->phone . "\n" .
                         (!empty($validated['company']) ? "Company / Website: " . $validated['company'] . "\n" : "") .
                         (!empty($validated['service']) ? "Services of Interest: " . $validated['service'] . "\n" : "") .
                         "Source: " . $lead->source . "\n" .
                         "Submitted At: " . now()->format('d M Y, h:i A') . "\n\n" .
                         "Requirements / Message:\n" . $validated['message'];

            if (!empty($siteSettings['smtp_host']) && !empty($siteSettings['smtp_username']) && !empty($siteSettings['smtp_password'])) {
                config([
                    'mail.mailers.smtp.transport' => 'smtp',
                    'mail.mailers.smtp.host' => $siteSettings['smtp_host'],
                    'mail.mailers.smtp.port' => (int)($siteSettings['smtp_port'] ?? 587),
                    'mail.mailers.smtp.username' => $siteSettings['smtp_username'],
                    'mail.mailers.smtp.password' => $siteSettings['smtp_password'],
                    'mail.mailers.smtp.encryption' => ($siteSettings['smtp_encryption'] ?? 'tls') === 'none' ? null : ($siteSettings['smtp_encryption'] ?? 'tls'),
                    'mail.from.address' => $fromAddress,
                    'mail.from.name' => $fromName,
                    'mail.default' => 'smtp',
                ]);
                \Illuminate\Support\Facades\Mail::purge('smtp');

                \Illuminate\Support\Facades\Mail::raw($emailBody, function ($m) use ($toEmail, $fromAddress, $fromName, $lead) {
                    $m->to($toEmail)
                      ->subject('New Website Lead: ' . $lead->name . (!empty($lead->phone) ? ' (' . $lead->phone . ')' : ''))
                      ->from($fromAddress, $fromName);
                });
            } else {
                // Fallback to PHP native mail()
                $subject = 'New Website Lead: ' . $lead->name . (!empty($lead->phone) ? ' (' . $lead->phone . ')' : '');
                $headers = "From: " . $fromName . " <" . $fromAddress . ">\r\n" .
                           "Reply-To: " . $lead->email . "\r\n" .
                           "X-Mailer: PHP/" . phpversion();
                @mail($toEmail, $subject, $emailBody, $headers);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Lead notification email dispatch error: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Lead received successfully! The SMAC Digital team will reply shortly.',
            'lead_id' => $lead->id
        ]);
    }
}
