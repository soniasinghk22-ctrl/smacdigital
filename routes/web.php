<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\SmacController;

// Fallback safety for relative styles/scripts in sub-routes
Route::get('/services/style.css', fn() => response()->file(public_path('style.css')));
Route::get('/services/script.js', fn() => response()->file(public_path('script.js')));
Route::get('/blogs/style.css', fn() => response()->file(public_path('style.css')));
Route::get('/blogs/script.js', fn() => response()->file(public_path('script.js')));

// SMAC Digital Dynamic Pages (Managed from Backend, 100% Matching Design & Content)
Route::get('/', [SmacController::class, 'index'])->name('home');
Route::get('/index.html', [SmacController::class, 'index']);

Route::get('/about-us', [SmacController::class, 'about'])->name('about');
Route::get('/about-us.html', [SmacController::class, 'about']);
Route::redirect('/about', '/about-us', 301);

Route::get('/services', [SmacController::class, 'services'])->name('services.index');
Route::get('/services.html', [SmacController::class, 'services']);
Route::get('/service', [SmacController::class, 'services'])->name('service.index');
Route::get('/service.html', [SmacController::class, 'services']);

Route::get('/services/{slug}', [SmacController::class, 'serviceShow'])->name('services.show');

Route::get('/portfolios', [SmacController::class, 'portfolios'])->name('portfolios');
Route::get('/portfolios.html', [SmacController::class, 'portfolios']);

Route::get('/testimonials', [SmacController::class, 'testimonials'])->name('testimonials');
Route::get('/testimonials.html', [SmacController::class, 'testimonials']);

Route::get('/blog', [SmacController::class, 'blogs'])->name('blog');
Route::get('/blog.html', [SmacController::class, 'blogs']);
Route::redirect('/blogs', '/blog', 301);

Route::get('/blogs/{slug}', [SmacController::class, 'blogShow'])->name('blog.show');
Route::get('/blog/{slug}', [SmacController::class, 'blogShow']);

Route::get('/contact', [SmacController::class, 'contact'])->name('contact');
Route::get('/contact.html', [SmacController::class, 'contact']);
Route::redirect('/contact-us', '/contact', 301);

Route::get('/career', [SmacController::class, 'career'])->name('career');
Route::get('/career.html', [SmacController::class, 'career']);
Route::redirect('/careers', '/career', 301);

Route::get('/events', [SmacController::class, 'events'])->name('events');
Route::get('/events.html', [SmacController::class, 'events']);

Route::post('/save-lead', [App\Http\Controllers\Api\PublicApiController::class, 'submitLead']);
Route::post('/contact/submit', [App\Http\Controllers\Api\PublicApiController::class, 'submitLead'])->name('contact.submit');

// Collections & Landing Pages Routes
Route::get('/collection/{slug}', [HomeController::class, 'collectionShow'])->name('collections.show');
Route::get('/category/{slug}', function($slug) {
    return redirect()->route('collections.show', ['slug' => $slug], 301);
});
Route::get('/landing/{slug}', [HomeController::class, 'landingShow'])->name('landing.show');
Route::get('/l/{slug}', [HomeController::class, 'landingShow'])->name('landing.short');
// Application Routes
Route::get('/application', [HomeController::class, 'application'])->name('application');
Route::get('/application/{slug}', [HomeController::class, 'applicationShow'])->name('application.show');
Route::post('/application/consultation', [HomeController::class, 'applicationConsultationSubmit'])->name('application.consultation.submit');
Route::redirect('/applications', '/application', 301);

// Infrastructure Redirects
Route::redirect('/stock-yard', '/infrastructure', 301);
Route::redirect('/processing-unit', '/infrastructure', 301);
Route::redirect('/clientele', '/testimonials', 301);

// Enquiry Routes
Route::get('/enquiry', [HomeController::class, 'enquiry'])->name('enquiry');
Route::get('/send-enquiry', [HomeController::class, 'enquiry'])->name('enquiry.alias');
Route::post('/enquiry/submit', [HomeController::class, 'enquirySubmit'])->name('enquiry.submit');

// Legacy Careers Routes handled by React above
// Route::post('/careers/submit', [HomeController::class, 'careerSubmit'])->name('careers.submit');
Route::redirect('/articles', '/blogs', 301);
Route::get('/article/{slug}', function($slug) {
    return redirect('/blogs/' . $slug, 301);
});
Route::redirect('/italian-marble-price', '/italian-marble-pricelist', 301);
Route::redirect('/marble-price-list', '/italian-marble-pricelist', 301);
Route::redirect('/website-map', '/sitemap.xml', 301);
Route::redirect('/sitemap', '/sitemap.xml', 301);
Route::redirect('/sitemap1.xml', '/sitemap.xml', 301);
Route::redirect('/stonehub-sitemap.xml', '/sitemap.xml', 301);
Route::redirect('/product-sitemap.xml', '/sitemap.xml', 301);
Route::redirect('/collection-sitemap.xml', '/sitemap.xml', 301);
Route::redirect('/blogs-sitemap..xml', '/sitemap.xml', 301);
// Location & City Pages SEO Route Handlers
Route::redirect('/imported-marble-supplier-in-india', '/delhi/imported-marble-seller', 301);
Route::get('/{city}/imported-marble-seller', [HomeController::class, 'locationShow'])->defaults('slug', 'imported-marble-seller')->name('location.city.seller');
Route::get('/{city}/imported-marble-in-{sub}', [HomeController::class, 'locationShowCityIn'])->name('location.city.in');


// Clinic Specialists
Route::get('/specialists', [HomeController::class, 'specialists'])->name('specialists');
Route::get('/specialists/{slug}', [HomeController::class, 'specialistdetails'])->name('specialists.show');

// 301 Redirects for Old SEO URLs (aligned with SMAC Digital React canonical routes)
Route::redirect('/about', '/about-us', 301);
Route::redirect('/faqs', '/', 301);
Route::redirect('/facilities', '/', 301);

Route::redirect('/compare-loans', '/', 301);
Route::post('/api/database/import', [AdminController::class, 'importLiveDatabase']);

// Live server DB setup — creates all missing tables in one request
Route::get('/setup-database', [AdminController::class, 'setupLiveDatabase']);

// Instant Live Chat Routes (Public)
Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
Route::get('/chat/history', [App\Http\Controllers\ChatController::class, 'getHistory'])->name('chat.history');
Route::post('/chat/auto-trigger', [App\Http\Controllers\ChatController::class, 'autoTrigger'])->name('chat.auto-trigger');

// Web Notification Routes (Public)
Route::post('/api/push-subscribe', [App\Http\Controllers\NotificationController::class, 'subscribe']);
Route::get('/api/notifications/poll', [App\Http\Controllers\NotificationController::class, 'poll']);


// Admin CMS Auth
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin CMS Dashboard (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/parameters', [AdminController::class, 'updateParameters'])->name('admin.parameters.update');
    
    Route::post('/admin/slides', [AdminController::class, 'storeSlide'])->name('admin.slides.store');
    Route::get('/admin/slides/{id}/detail', [AdminController::class, 'detailSlide'])->name('admin.slides.detail');
    Route::post('/admin/slides/{id}/update', [AdminController::class, 'updateSlide'])->name('admin.slides.update');
    Route::post('/admin/slides/{id}/delete', [AdminController::class, 'deleteSlide'])->name('admin.slides.delete');
    
    Route::post('/admin/testimonials', [AdminController::class, 'storeTestimonial'])->name('admin.testimonials.store');
    Route::get('/admin/testimonials/{id}/detail', [AdminController::class, 'detailTestimonial'])->name('admin.testimonials.detail');
    Route::post('/admin/testimonials/{id}/update', [AdminController::class, 'updateTestimonial'])->name('admin.testimonials.update');
    Route::post('/admin/testimonials/{id}/delete', [AdminController::class, 'deleteTestimonial'])->name('admin.testimonials.delete');

    // Blogs CRUD
    Route::get('/admin/blogs/list', [AdminController::class, 'listBlogs'])->name('admin.blogs.list');
    Route::get('/admin/blogs/{id}/detail', [AdminController::class, 'detailBlog'])->name('admin.blogs.detail');
    Route::post('/admin/blogs', [AdminController::class, 'storeBlog'])->name('admin.blogs.store');
    Route::post('/admin/blogs/{id}/update', [AdminController::class, 'updateBlog'])->name('admin.blogs.update');
    Route::post('/admin/blogs/{id}/delete', [AdminController::class, 'deleteBlog'])->name('admin.blogs.delete');

    // Collections CRUD
    Route::post('/admin/collections', [AdminController::class, 'storeCollection'])->name('admin.collections.store');
    Route::post('/admin/collections/{id}/update', [AdminController::class, 'updateCollection'])->name('admin.collections.update');
    Route::post('/admin/collections/{id}/delete', [AdminController::class, 'deleteCollection'])->name('admin.collections.delete');

    // Categories CRUD
    Route::get('/admin/categories/list', [AdminController::class, 'listCategories'])->name('admin.categories.list');
    Route::get('/admin/categories/{id}/detail', [AdminController::class, 'detailCategory'])->name('admin.categories.detail');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::post('/admin/categories/quick-add', [AdminController::class, 'quickAddCategory'])->name('admin.categories.quick');
    Route::post('/admin/categories/{id}/update', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::post('/admin/categories/{id}/delete', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    // Marbles CRUD
    Route::post('/admin/marbles', [AdminController::class, 'storeMarble'])->name('admin.marbles.store');
    Route::post('/admin/marbles/{id}/update', [AdminController::class, 'updateMarble'])->name('admin.marbles.update');
    Route::post('/admin/marbles/{id}/delete', [AdminController::class, 'deleteMarble'])->name('admin.marbles.delete');

    // Locations CRUD & AI Content Generation
    Route::post('/admin/locations', [AdminController::class, 'storeLocation'])->name('admin.locations.store');
    Route::post('/admin/locations/{id}/update', [AdminController::class, 'updateLocation'])->name('admin.locations.update');
    Route::post('/admin/locations/{id}/delete', [AdminController::class, 'deleteLocation'])->name('admin.locations.delete');
    Route::post('/admin/ai/generate-location', [AdminController::class, 'aiGenerateLocationPage'])->name('admin.ai.location');

    // Specialists CRUD
    Route::post('/admin/specialists', [AdminController::class, 'storeSpecialist'])->name('admin.specialists.store');
    Route::post('/admin/specialists/{id}/update', [AdminController::class, 'updateSpecialist'])->name('admin.specialists.update');
    Route::post('/admin/specialists/{id}/delete', [AdminController::class, 'deleteSpecialist'])->name('admin.specialists.delete');

    // CMS Pages CRUD
    Route::post('/admin/cms-pages', [AdminController::class, 'storeCmsPage'])->name('admin.cms_pages.store');
    Route::post('/admin/cms-pages/{id}/update', [AdminController::class, 'updateCmsPage'])->name('admin.cms_pages.update');
    Route::post('/admin/cms-pages/{id}/delete', [AdminController::class, 'deleteCmsPage'])->name('admin.cms_pages.delete');

    // Banks CRUD
    Route::post('/admin/banks', [AdminController::class, 'storeBank'])->name('admin.banks.store');
    Route::post('/admin/banks/{id}/update', [AdminController::class, 'updateBank'])->name('admin.banks.update');
    Route::post('/admin/banks/{id}/delete', [AdminController::class, 'deleteBank'])->name('admin.banks.delete');

    // Page Content Update
    Route::post('/admin/page-contents', [AdminController::class, 'updatePageContents'])->name('admin.page-contents.update');

    // Menu Items CRUD
    Route::post('/admin/menu-items', [AdminController::class, 'storeMenuItem'])->name('admin.menu.store');
    Route::get('/admin/menu-items/{id}/detail', [AdminController::class, 'detailMenuItem'])->name('admin.menu.detail');
    Route::post('/admin/menu-items/{id}/update', [AdminController::class, 'updateMenuItem'])->name('admin.menu.update');
    Route::post('/admin/menu-items/{id}/delete', [AdminController::class, 'deleteMenuItem'])->name('admin.menu.delete');

    // Partners / Client Logos CRUD
    Route::post('/admin/partners', [AdminController::class, 'storePartner'])->name('admin.partners.store');
    Route::get('/admin/partners/{id}/detail', [AdminController::class, 'detailPartner'])->name('admin.partners.detail');
    Route::post('/admin/partners/{id}/update', [AdminController::class, 'updatePartner'])->name('admin.partners.update');
    Route::post('/admin/partners/{id}/delete', [AdminController::class, 'deletePartner'])->name('admin.partners.delete');

    // Media Manager Upload
    Route::post('/admin/media-upload', [AdminController::class, 'uploadMedia'])->name('admin.media.upload');
    Route::post('/admin/media/sync-r2', [AdminController::class, 'syncLocalImagesToR2'])->name('admin.media.sync');
    Route::post('/admin/database/push-to-live', [AdminController::class, 'pushLocalDatabaseToLive'])->name('admin.database.push-to-live');

    // Sync database content
    Route::post('/admin/sync-database', [AdminController::class, 'syncDatabase'])->name('admin.sync-database');

    // Leads Management
    Route::get('/admin/leads/export', [AdminController::class, 'exportLeads'])->name('admin.leads.export');
    Route::post('/admin/leads/bulk-delete', [AdminController::class, 'bulkDeleteLeads'])->name('admin.leads.bulk-delete');
    Route::post('/admin/leads/{id}/update', [AdminController::class, 'updateLead'])->name('admin.leads.update');
    Route::post('/admin/leads/{id}/delete', [AdminController::class, 'deleteLead'])->name('admin.leads.delete');

    // AI Content Generation
    Route::post('/admin/ai/generate-blog', [AdminController::class, 'aiGenerateBlog'])->name('admin.ai.blog');
    Route::post('/admin/ai/generate-service', [AdminController::class, 'aiGenerateService'])->name('admin.ai.service');
    Route::post('/admin/ai/generate-image', [AdminController::class, 'aiGenerateImage'])->name('admin.ai.image');
    Route::post('/admin/ai/seo-recommendations', [AdminController::class, 'aiGenerateSeoRecommendations'])->name('admin.ai.seo-recommendations');
    Route::post('/admin/ai/generate-slider', [AdminController::class, 'aiGenerateSlider'])->name('admin.ai.slider');
    Route::post('/admin/ai/generate-schema', [AdminController::class, 'aiGenerateSchema'])->name('admin.ai.schema.generate');
    Route::post('/admin/schema/update', [AdminController::class, 'saveSchemaMarkup'])->name('admin.schema.update');

    // SEO & LLMO Regeneration Routes
    Route::post('/admin/seo/regenerate-sitemap', [AdminController::class, 'regenerateSitemap'])->name('admin.seo.regenerate-sitemap');
    Route::post('/admin/seo/regenerate-robots', [AdminController::class, 'regenerateRobots'])->name('admin.seo.regenerate-robots');
    Route::post('/admin/seo/regenerate-llms', [AdminController::class, 'regenerateLlms'])->name('admin.seo.regenerate-llms');
    Route::post('/admin/seo/regenerate-all', [AdminController::class, 'regenerateAllSeoFiles'])->name('admin.seo.regenerate-all');



    // Cloudflare Analytics
    Route::post('/admin/cloudflare/analytics', [AdminController::class, 'getCloudflareAnalytics'])->name('admin.cloudflare.analytics');

    // Google Analytics & Search Console & My Business Data API
    Route::post('/admin/google/analytics', [AdminController::class, 'getGoogleAnalyticsData'])->name('admin.google.analytics');
    Route::get('/admin/google/auth', [AdminController::class, 'redirectToGoogle'])->name('admin.google.auth');
    Route::get('/admin/google/callback', [AdminController::class, 'handleGoogleCallback'])->name('admin.google.callback');
    Route::post('/admin/google/disconnect', [AdminController::class, 'disconnectGoogle'])->name('admin.google.disconnect');
    Route::get('/admin/google/properties', [AdminController::class, 'getGoogleProperties'])->name('admin.google.properties');

    // Landing Pages CRUD
    Route::post('/admin/landing-pages', [AdminController::class, 'storeLandingPage'])->name('admin.landing.store');
    Route::post('/admin/landing-pages/{id}/update', [AdminController::class, 'updateLandingPage'])->name('admin.landing.update');
    Route::post('/admin/landing-pages/{id}/delete', [AdminController::class, 'deleteLandingPage'])->name('admin.landing.delete');
    Route::post('/admin/ai/generate-landing', [AdminController::class, 'aiGenerateLandingPage'])->name('admin.ai.landing');
    Route::post('/admin/ai/sync-gmb-testimonials', [AdminController::class, 'aiSyncGmbTestimonials'])->name('admin.ai.gmb-sync');

    // GMB Sharing & Sitemap Routes
    Route::post('/admin/sitemap/generate', [AdminController::class, 'generateSitemap'])->name('admin.sitemap.generate');
    Route::post('/admin/ai/draft-gmb-post', [AdminController::class, 'aiDraftGmbPost'])->name('admin.ai.gmb-draft');
    Route::post('/admin/gmb/publish-post', [AdminController::class, 'publishGmbPost'])->name('admin.gmb.publish');

    // Live Chat Administration
    Route::get('/admin/chats', [App\Http\Controllers\ChatController::class, 'adminListSessions'])->name('admin.chats.list');
    Route::get('/admin/chats/{session_id}', [App\Http\Controllers\ChatController::class, 'adminGetSessionMessages'])->name('admin.chats.messages');
    Route::post('/admin/chats/{session_id}/reply', [App\Http\Controllers\ChatController::class, 'adminSendReply'])->name('admin.chats.reply');
    Route::delete('/admin/chats/{session_id}', [App\Http\Controllers\ChatController::class, 'adminDeleteChat'])->name('admin.chats.delete');

    // User Management CRUD
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/admin/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/notifications/broadcast', [App\Http\Controllers\NotificationController::class, 'broadcast'])->name('admin.notifications.broadcast');

    // Safe Database Migration Runner for Admin
    Route::match(['get', 'post'], '/admin/database/migrate', function() {
        try {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            $output = \Illuminate\Support\Facades\Artisan::output();
            \App\Providers\AppServiceProvider::clearSharedViewCache();
            return response()->json(['success' => true, 'output' => $output]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    })->name('admin.database.migrate');

    // Catch-all dashboard tab route
    Route::get('/admin/{tab}', [AdminController::class, 'dashboard'])->name('admin.tab');
});

// Location Pages (AI Generated, structured as /{city}/{slug})
Route::get('/{city}/{slug}', [HomeController::class, 'locationShow'])->name('location.show');

// CMS catch-all route (placed at the end to prevent conflicts)
Route::get('/{slug}', [HomeController::class, 'cmsPageShow'])->name('cms.show');

// Dynamic Cache Clear Endpoint (Secure via Cloudflare R2 Secret Access Key)
Route::get('/api/clear-cache', function(\Illuminate\Http\Request $request) {
    $setupKey = trim(\App\Models\SiteParameter::where('id', 'cloudflare_r2_secret_access_key')->value('value') ?? '');
    $providedKey = $request->query('key', '');
    if (empty($setupKey) || $providedKey !== $setupKey) {
        return response()->json(['status' => 'error', 'message' => 'Unauthorized key.'], 401);
    }
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return response()->json(['status' => 'success', 'message' => 'Caches cleared successfully!']);
});

