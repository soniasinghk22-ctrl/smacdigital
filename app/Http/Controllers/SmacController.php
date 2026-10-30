<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CmsPage;
use App\Models\MenuItem;
use App\Models\PageContent;
use App\Models\PartnerLogo;
use App\Models\SiteParameter;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class SmacController extends Controller
{
    protected function getCommonData()
    {
        $parameters = SiteParameter::pluck('value', 'id')->toArray();
        $headerMenus = MenuItem::where('menu_type', 'header')->where('is_active', true)->orderBy('sort_order')->get();
        $megaServices = MenuItem::where('menu_type', 'mega_services')->where('is_active', true)->orderBy('sort_order')->get()->groupBy('category_group');
        $portfolioMenus = MenuItem::where('menu_type', 'portfolio_menu')->where('is_active', true)->orderBy('sort_order')->get();
        $footerMenus = MenuItem::where('menu_type', 'like', 'footer_%')->where('is_active', true)->orderBy('sort_order')->get()->groupBy('menu_type');
        $headerContents = PageContent::getPageSections('header');
        $footerContents = PageContent::getPageSections('footer');

        return compact(
            'parameters',
            'headerMenus',
            'megaServices',
            'portfolioMenus',
            'footerMenus',
            'headerContents',
            'footerContents'
        );
    }

    public function index()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'home')->first();
        $homeContents = PageContent::getPageSections('home');
        $partners = PartnerLogo::getActive();
        $latestBlogs = Blog::orderBy('published_at', 'desc')->take(4)->get();
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('smac.index', array_merge($common, compact('page', 'homeContents', 'partners', 'latestBlogs', 'testimonials')));
    }

    public function about()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'about-us')->first();
        $aboutContents = PageContent::getPageSections('about');

        return view('smac.about', array_merge($common, compact('page', 'aboutContents')));
    }

    public function services()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'services')->first();
        $servicesContents = PageContent::getPageSections('services');

        return view('smac.services-index', array_merge($common, compact('page', 'servicesContents')));
    }

    public function serviceShow($slug)
    {
        $cleanSlug = preg_replace('/\.html$/', '', $slug);
        $viewSlug = $cleanSlug;
        if ($cleanSlug === 'content-marketing-services' && !view()->exists("smac.services.content-marketing-services")) {
            $viewSlug = 'content-marketing';
        }

        $common = $this->getCommonData();
        $page = CmsPage::where('slug', "services/{$cleanSlug}")
            ->orWhere('slug', $cleanSlug)
            ->orWhere('slug', "services/{$viewSlug}")
            ->orWhere('slug', $viewSlug)
            ->first();

        if (view()->exists("smac.services.{$viewSlug}")) {
            return view("smac.services.{$viewSlug}", array_merge($common, compact('cleanSlug', 'viewSlug', 'page')));
        }

        abort(404, 'Service page not found');
    }

    public function portfolios()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'portfolios')->first();
        $portfolioContents = PageContent::getPageSections('portfolios');

        return view('smac.portfolios', array_merge($common, compact('page', 'portfolioContents')));
    }

    public function testimonials()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'testimonials')->first();
        $testimonials = Testimonial::orderBy('sort_order')->get();

        return view('smac.testimonials', array_merge($common, compact('page', 'testimonials')));
    }

    public function blogs(Request $request)
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'blogs')->first();
        $category = $request->query('category');
        $search = $request->query('q');

        $query = Blog::query();

        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('published_at', 'desc')->paginate(12)->withQueryString();
        $categories = Category::where('status', true)->pluck('name');
        if ($categories->isEmpty()) {
            $categories = Blog::whereNotNull('category')->distinct()->pluck('category');
        }

        $categoryCounts = Blog::selectRaw('category, count(*) as total_count')
            ->whereNotNull('category')
            ->groupBy('category')
            ->pluck('total_count', 'category')
            ->toArray();
        $totalBlogsCount = Blog::count();

        return view('smac.blog-index', array_merge($common, compact('page', 'blogs', 'categories', 'category', 'search', 'categoryCounts', 'totalBlogsCount')));
    }

    public function blogShow($slug)
    {
        $cleanSlug = preg_replace('/\.html$/', '', $slug);
        $common = $this->getCommonData();

        // Find by slug or ID
        $blog = Blog::where('slug', $cleanSlug)->first();
        if (!$blog && is_numeric($cleanSlug)) {
            $blog = Blog::find($cleanSlug);
        }

        if (!$blog) {
            $htmlFile = base_path("smac-digital-html/blogs/{$cleanSlug}.html");
            if (file_exists($htmlFile)) {
                return response(file_get_contents($htmlFile), 200, [
                    'Content-Type' => 'text/html; charset=UTF-8'
                ]);
            }
            abort(404, 'Blog post not found');
        }

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        if ($relatedBlogs->count() < 3) {
            $more = Blog::where('id', '!=', $blog->id)
                ->whereNotIn('id', $relatedBlogs->pluck('id'))
                ->orderBy('published_at', 'desc')
                ->take(3 - $relatedBlogs->count())
                ->get();
            $relatedBlogs = $relatedBlogs->merge($more);
        }

        return view('smac.blog-show', array_merge($common, compact('blog', 'relatedBlogs')));
    }

    public function contact()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'contact-us')->first();
        $contactContents = PageContent::getPageSections('contact');

        return view('smac.contact', array_merge($common, compact('page', 'contactContents')));
    }

    public function career()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'careers')->first();
        $careerContents = PageContent::getPageSections('career');

        return view('smac.career', array_merge($common, compact('page', 'careerContents')));
    }

    public function events()
    {
        $common = $this->getCommonData();
        $page = CmsPage::where('slug', 'events')->first();
        $eventsContents = PageContent::getPageSections('events');

        return view('smac.events', array_merge($common, compact('page', 'eventsContents')));
    }
}
