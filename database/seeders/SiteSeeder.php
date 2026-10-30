<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@drsumitz.com'],
            [
                'name' => 'Dr. Sumitz Admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'fallback@drsumitz.com'],
            [
                'name' => 'Admin Fallback',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // 2. Seed Site Parameters
        $parameters = [
            ['id' => 'site_name', 'value' => 'Dr. Sumitz', 'label' => 'Site Name', 'category' => 'general'],
            ['id' => 'site_tagline', 'value' => 'Consultant Orthopedic & Joint Replacement Surgeon', 'label' => 'Site Tagline', 'category' => 'general'],
            ['id' => 'google_tag_id', 'value' => null, 'label' => 'Google Tag ID', 'category' => 'general'],
            ['id' => 'header_scripts', 'value' => null, 'label' => 'Custom Header Scripts', 'category' => 'general'],
            ['id' => 'logo_path', 'value' => null, 'label' => 'Custom Logo Image (WebP)', 'category' => 'branding'],
            ['id' => 'favicon_path', 'value' => null, 'label' => 'Custom Favicon Image (WebP)', 'category' => 'branding'],
            ['id' => 'chat_assistant_name', 'value' => 'Dr. Sumitz Assistant', 'label' => 'Chat Assistant Display Name', 'category' => 'general'],
            ['id' => 'chat_assistant_avatar', 'value' => null, 'label' => 'Chat Assistant Avatar Image (WebP)', 'category' => 'branding'],
            ['id' => 'recaptcha_enabled', 'value' => '0', 'label' => 'Enable Google reCAPTCHA', 'category' => 'general'],
            ['id' => 'recaptcha_site_key', 'value' => null, 'label' => 'reCAPTCHA Site Key', 'category' => 'general'],
            ['id' => 'recaptcha_secret_key', 'value' => null, 'label' => 'reCAPTCHA Secret Key', 'category' => 'general'],
            ['id' => 'phone', 'value' => '+91 95455 59434', 'label' => 'Contact Phone Number', 'category' => 'contact'],
            ['id' => 'email', 'value' => 'care@drsumitz.com', 'label' => 'Contact Email Address', 'category' => 'contact'],
            ['id' => 'address', 'value' => 'First Floor, Krishna Avenue, Above Dominos, Baner Road, Baner, Pune - 411045', 'label' => 'Physical Address', 'category' => 'contact'],
            ['id' => 'whatsapp_number', 'value' => '919545559434', 'label' => 'WhatsApp Number (with country code)', 'category' => 'contact'],
            
            // Custom Section Backgrounds
            ['id' => 'index_hero_bg', 'value' => 'linear-gradient(135deg, #f0fcf9 0%, #ffffff 100%)', 'label' => 'Home Hero Background', 'category' => 'styling'],
            ['id' => 'index_services_bg', 'value' => '#ffffff', 'label' => 'Home Services Background', 'category' => 'styling'],
            ['id' => 'index_about_bg', 'value' => '#ffffff', 'label' => 'Home About Background', 'category' => 'styling'],
            ['id' => 'index_why_bg', 'value' => '#f8fbfb', 'label' => 'Home Why Choose Us Background', 'category' => 'styling'],
            ['id' => 'index_testimonials_bg', 'value' => '#ffffff', 'label' => 'Home Testimonials Background', 'category' => 'styling'],
            ['id' => 'index_faq_bg', 'value' => '#ffffff', 'label' => 'Home FAQ Background', 'category' => 'styling'],
            ['id' => 'index_cta_bg', 'value' => 'linear-gradient(135deg, #1F7AA8 0%, #22B6C7 100%)', 'label' => 'Home CTA Section Background', 'category' => 'styling'],
        ];

        foreach ($parameters as $param) {
            DB::table('site_parameters')->updateOrInsert(
                ['id' => $param['id']],
                [
                    'value' => $param['value'],
                    'label' => $param['label'],
                    'category' => $param['category'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 3. Seed Page Contents
        $contents = [
            // Homepage Hero
            ['page' => 'home', 'section' => 'hero', 'key' => 'title', 'value' => 'Expert Orthopedic Care by Dr. Sumitz'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'Personalized treatment for knee, hip, spine and sports injuries with advanced surgical and non-surgical options.'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'trust_badge', 'value' => 'Trusted by 5,000+ happy patients'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'primary_cta_label', 'value' => 'Book Appointment'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'secondary_cta_label', 'value' => 'Call for Consultation'],

            // Homepage Finder Widget
            ['page' => 'home', 'section' => 'finder', 'key' => 'title', 'value' => "I'm looking for"],
            ['page' => 'home', 'section' => 'finder', 'key' => 'description', 'value' => 'Help patients quickly identify concerns and treatments, inspired by Lokmanya\'s filters but simplified for a single doctor.'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'concerns', 'value' => 'Knee Pain, Hip Pain, Back Pain / Spine Issues, Sports Injury, Fracture / Trauma'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'treatment_types', 'value' => 'Consultation, Surgery, Second Opinion, Follow-up'],
            ['page' => 'home', 'section' => 'finder', 'key' => 'cta_label', 'value' => 'Find Treatment Plan'],

            // Homepage Quick Actions
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item1', 'value' => 'Book Appointment'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item2', 'value' => 'Book Health Checkup'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item3', 'value' => 'Request Second Opinion'],
            ['page' => 'home', 'section' => 'quick_actions', 'key' => 'item4', 'value' => 'Video Consultation'],

            // Homepage Specialties
            ['page' => 'home', 'section' => 'specialties', 'key' => 'title', 'value' => 'Treatments & Specialties'],
            ['page' => 'home', 'section' => 'specialties', 'key' => 'subtitle', 'value' => 'Comprehensive orthopedic care for joints, spine and sports injuries.'],

            // About Doctor Section
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'title', 'value' => 'About Dr. Sumitz'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'intro_text', 'value' => 'Dr. Sumitz is a leading orthopedic surgeon with extensive experience in joint replacement, trauma care, and sports medicine.'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'philosophy', 'value' => 'Combining advanced surgical techniques with a personalized, patient-first approach.'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'image', 'value' => ''],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat1_value', 'value' => '15+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat1_label', 'value' => 'Years Experience'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat2_value', 'value' => '3,000+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat2_label', 'value' => 'Surgeries Completed'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat3_value', 'value' => '5,000+'],
            ['page' => 'home', 'section' => 'about_doctor', 'key' => 'stat3_label', 'value' => 'Happy Patients'],

            // Why Choose Us Section
            ['page' => 'home', 'section' => 'why_choose_us', 'key' => 'title', 'value' => 'Why Choose Dr. Sumitz'],
            ['page' => 'home', 'section' => 'why_choose_us', 'key' => 'subtitle', 'value' => 'We combine clinical excellence with state-of-the-art joint care.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r1_title', 'value' => 'World-Class Surgical Expertise'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r1_desc', 'value' => 'Extensive experience in complex joint and trauma surgeries.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r2_title', 'value' => 'Advanced Minimally Invasive Techniques'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r2_desc', 'value' => 'Smaller incisions, reduced pain, and faster recovery.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r3_title', 'value' => 'Personalized Treatment Plans'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r3_desc', 'value' => 'Individualized care based on patient lifestyle and goals.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r4_title', 'value' => 'Comprehensive Pre & Post-Operative Care'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r4_desc', 'value' => 'Guidance from diagnosis to full rehabilitation.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r5_title', 'value' => 'Transparent Communication'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r5_desc', 'value' => 'Clear explanation of risks, benefits and alternatives.'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r6_title', 'value' => 'Modern Facilities'],
            ['page' => 'home', 'section' => 'why_choose', 'key' => 'r6_desc', 'value' => 'Access to advanced equipment and technology.'],

            // Video Consults
            ['page' => 'home', 'section' => 'videos', 'key' => 'title', 'value' => 'Video Consults & Expert Opinions'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'title', 'value' => 'Understanding Knee Pain and Treatment Options'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'duration', 'value' => '12:45'],
            ['page' => 'home', 'section' => 'video1', 'key' => 'link', 'value' => 'https://www.youtube.com/'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'title', 'value' => 'When Do You Need a Knee Replacement?'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'duration', 'value' => '08:20'],
            ['page' => 'home', 'section' => 'video2', 'key' => 'link', 'value' => 'https://www.youtube.com/'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'title', 'value' => 'Spine Health Tips for Desk Workers'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'duration', 'value' => '15:10'],
            ['page' => 'home', 'section' => 'video3', 'key' => 'link', 'value' => 'https://www.youtube.com/'],

            // Testimonials
            ['page' => 'home', 'section' => 'testimonials', 'key' => 'title', 'value' => 'Patient Success Stories'],
            ['page' => 'home', 'section' => 'testimonials', 'key' => 'subtitle', 'value' => 'Hear from patients who recovered their mobility and returned to pain-free living.'],

            // Awards
            ['page' => 'home', 'section' => 'awards', 'key' => 'title', 'value' => 'Awards & Recognitions'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'title', 'value' => 'Best Orthopedic Surgeon'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'org', 'value' => 'Pune Healthcare Awards 2024'],
            ['page' => 'home', 'section' => 'award1', 'key' => 'year', 'value' => '2024'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'title', 'value' => 'Clinical Excellence Award'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'org', 'value' => 'Indian Ortho Society 2023'],
            ['page' => 'home', 'section' => 'award2', 'key' => 'year', 'value' => '2023'],

            // Locations
            ['page' => 'home', 'section' => 'locations', 'key' => 'title', 'value' => 'Clinic Locations'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'name', 'value' => 'Baner Branch (Main Clinic)'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'address', 'value' => 'First Floor, Krishna Avenue, Above Dominos, Baner Road, Baner, Pune - 411045'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'phone', 'value' => '+91-95455-59434'],
            ['page' => 'home', 'section' => 'location1', 'key' => 'map', 'value' => 'https://maps.google.com'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'name', 'value' => 'Hinjewadi Clinic Branch'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'address', 'value' => 'Atlanta Society, Hinjewadi, Pune - 411057'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'phone', 'value' => '+91-88559-50433'],
            ['page' => 'home', 'section' => 'location2', 'key' => 'map', 'value' => 'https://maps.google.com'],

            // Blogs
            ['page' => 'home', 'section' => 'blogs', 'key' => 'title', 'value' => 'Latest Articles & Patient Guides'],
            ['page' => 'home', 'section' => 'blogs', 'key' => 'subtitle', 'value' => 'Read health tips, arthritis advice, and surgical recovery blueprints shared by our medical experts.'],
            ['page' => 'home', 'section' => 'blogs', 'key' => 'cta_label', 'value' => 'View More Articles'],

            // Header Top Strip & Menus
            ['page' => 'header', 'section' => 'top_strip', 'key' => 'left_label', 'value' => 'FOR APPOINTMENT'],
            ['page' => 'header', 'section' => 'top_strip', 'key' => 'cta_label', 'value' => 'Book Appointment'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'home', 'value' => 'Home'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'about', 'value' => 'About Doctor'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'treatments_services', 'value' => 'Treatments & Services'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'patient_info', 'value' => 'Patient Information'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'success_stories', 'value' => 'Success Stories'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'blog', 'value' => 'Blog'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'contact', 'value' => 'Contact & Location'],
            ['page' => 'header', 'section' => 'menu', 'key' => 'cta', 'value' => 'Book Appointment'],

            // Footer
            ['page' => 'footer', 'section' => 'about', 'key' => 'tagline', 'value' => 'Advanced Orthopedic Care with a Patient-First Approach'],
            ['page' => 'footer', 'section' => 'about', 'key' => 'description', 'value' => 'Providing comprehensive joint, spine and sports injury treatment using modern techniques and personalized care.'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'quick_links', 'value' => 'Quick Links'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'services', 'value' => 'Treatments'],
            ['page' => 'footer', 'section' => 'headings', 'key' => 'contact', 'value' => 'Contact Info'],
            ['page' => 'footer', 'section' => 'bottom', 'key' => 'copyright', 'value' => 'All Rights Reserved.'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'title', 'value' => 'Subscribe to Patient Guides'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'description', 'value' => 'Get recovery tips, exercise routines and new treatment updates.'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'placeholder', 'value' => 'Enter your email'],
            ['page' => 'footer', 'section' => 'newsletter', 'key' => 'btn_label', 'value' => 'Subscribe'],
            ['page' => 'footer', 'section' => 'bottom', 'key' => 'disclaimer', 'value' => 'Medical information provided on this website is for educational purposes only. Always consult a qualified specialist for diagnostic queries.'],
        ];

        DB::table('page_contents')->truncate();
        foreach ($contents as $content) {
            DB::table('page_contents')->insert([
                'page' => $content['page'],
                'section' => $content['section'],
                'key' => $content['key'],
                'value' => $content['value'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 4. Seed Homepage Slides
        DB::table('home_slides')->truncate();
        DB::table('home_slides')->insert([
            [
                'title' => 'Advanced Joint Replacement & Spine Care',
                'subtitle' => 'Painless movement and active recovery through modern orthopedic surgical and rehabilitation protocols.',
                'image_path' => null,
                'button_text' => 'Book Consultation',
                'button_link' => '#appointment',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Minimally Invasive Orthopedic Surgery',
                'subtitle' => 'Restoring your lifestyle and mobility with smaller incisions, reduced pain, and speedier post-operative recovery.',
                'image_path' => null,
                'button_text' => 'Get Second Opinion',
                'button_link' => '#appointment',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. Seed Testimonials
        DB::table('testimonials')->truncate();
        DB::table('testimonials')->insert([
            [
                'name' => 'Rajesh Joshi',
                'role' => 'Knee Replacement Patient, Pune',
                'content' => 'I was struggling to walk even 10 steps due to severe arthritis. Dr. Sumitz performed total knee replacement. Today, 3 months post-op, I am walk-active and completely pain-free.',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Priya Deshmukh',
                'role' => 'Sports Injury Patient, Pune',
                'content' => 'Tore my ACL during a basketball match. Dr. Sumitz recommended a structured arthroscopic repair and post-operative rehab. The team is excellent, highly professional!',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vikram Sharma',
                'role' => 'Spine Therapy Patient, Pune',
                'content' => 'Experienced radiating lower back pain for a year. The physiotherapy and personalized posture modification program suggested by Dr. Sumitz worked wonders. Highly recommend.',
                'rating' => 5,
                'avatar_path' => null,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 6. Seed Blogs
        DB::table('blogs')->truncate();
        DB::table('blogs')->insert([
            [
                'slug' => 'understanding-knee-pain',
                'title' => 'Understanding Knee Pain and Treatment Options',
                'category' => 'Joint Care',
                'summary' => 'Explore the primary causes of knee pain, non-surgical therapies, and advanced surgical alternatives.',
                'content' => '<h3>Common Causes of Knee Pain</h3><p>Knee pain is a highly prevalent condition affecting people of all ages. From sports injuries to degenerative arthritis, identifying the root cause is the key to recovery.</p>',
                'image_path' => null,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'knee-replacement-guide',
                'title' => 'When Do You Need a Knee Replacement?',
                'category' => 'Surgery',
                'summary' => 'A comprehensive guide on evaluating symptoms and identifying the right time for joint replacement.',
                'content' => '<h3>Indications for Joint Replacement</h3><p>Joint replacement surgery is typically recommended for patients with severe osteoarthritis who have not responded to conservative treatments.</p>',
                'image_path' => null,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'spine-health-tips',
                'title' => 'Spine Health Tips for Desk Workers',
                'category' => 'Spine Care',
                'summary' => 'Simple posture modifications and back exercises to minimize lumbar strain and chronic neck pain.',
                'content' => '<h3>Ergonomics and Back Care</h3><p>Working at a desk for extended periods can cause severe neck and back strain. Implementing posture changes and regular exercises is vital.</p>',
                'image_path' => null,
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 7. Seed Dynamic Services (Clinic Services)
        DB::table('services')->truncate();
        $services = [
            [
                'slug' => 'orthopedics',
                'service_name' => 'Orthopedic Care',
                'hero_category' => 'CLINIC SERVICES',
                'hero_title' => 'Advanced Orthopedic Consultation',
                'hero_subtitle' => 'Comprehensive diagnosis and treatment for bone, joint, ligament, and muscle pathologies.',
                'rate_value' => 'Specialist Consults',
                'max_loan' => 'Modern Clinic OPD',
                'tenure' => 'Daily Consult Slots',
                'intro_title' => 'Expert Bone & Joint Consultation',
                'intro_content' => '<p>Get customized diagnostic plans and clinical management for all forms of bone pain, fractures, tendonitis, and arthritis.</p>',
                'eligibility_criteria' => "No age limits\nPrior medical reports helpful\nPrior appointment recommended",
                'documents_required' => "Previous X-ray scans (if any)\nPrescription history\nInsurance details",
                'tips_title' => 'Preparing for your consult',
                'tips_content' => '<p>List down your specific symptoms, when the pain started, and physical movements that trigger discomfort to help the doctor diagnose accurately.</p>',
                'faqs' => json_encode([
                    ['question' => 'How can I schedule a consult?', 'answer' => 'Use the online Book Appointment form or call the clinic numbers to choose your branch and confirm a time slot.']
                ]),
                'badge' => 'Specialist',
                'summary' => 'OPD clinical assessments for joint stiffness, chronic bone pain, osteoporosis, and structural bone issues.',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'joint-replacement',
                'service_name' => 'Joint Replacement',
                'hero_category' => 'SURGICAL PROCEDURES',
                'hero_title' => 'Knee & Hip Replacement Surgery',
                'hero_subtitle' => 'Restore your pain-free active lifestyle with advanced total joint arthroplasty techniques.',
                'rate_value' => 'High Success Rate',
                'max_loan' => 'Minimally Invasive',
                'tenure' => 'Speedy Recovery',
                'intro_title' => 'Total Knee and Hip Arthroplasty',
                'intro_content' => '<p>State of the art surgical solutions replacing damaged joint surfaces with premium orthopedic implants to eliminate chronic arthritis pain.</p>',
                'eligibility_criteria' => "Severe joint degradation\nFailure of non-surgical options\nPatient fitness clearance required",
                'documents_required' => "Digital X-Rays / MRI scans\nBlood profiles\nCardiac fitness clearance",
                'tips_title' => 'Post-operative recovery plans',
                'tips_content' => '<p>Rehabilitation begins immediately. Standard post-op physical therapy schedules ensure return to comfortable walking within a few weeks.</p>',
                'faqs' => json_encode([
                    ['question' => 'What is the lifespan of modern implants?', 'answer' => 'Premium orthopedic implants used by Dr. Sumitz typically last between 15 to 25 years under standard wear conditions.']
                ]),
                'badge' => 'Surgeries',
                'summary' => 'Total Knee Arthroplasty, partial replacements, and hip arthroplasty using advanced medical implants.',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($services as $service) {
            DB::table('services')->updateOrInsert(
                ['slug' => $service['slug']],
                $service
            );
        }

        // 8. Truncate Comparison Lenders
        DB::table('comparison_banks')->truncate();
    }
}
