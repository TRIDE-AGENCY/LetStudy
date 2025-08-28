<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Banner;
use App\Models\BannerProduct;
use App\Models\Blog;
use App\Models\Donate;
use App\Models\Ebook;
use App\Models\Faq;
use App\Models\Legal;
use App\Models\Message;
use App\Models\Partner;
use App\Models\Playlist;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Quote;
use App\Models\Report;
use App\Models\Sosmed;
use App\Models\SubProduct;
use App\Models\Support;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\Tryout;
use App\Models\Tutor;
use App\Models\Usp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $banners = Banner::with('ebook')->get();
        $usps = Usp::all();
        $report = Report::find(1);
        $achievements = Achievement::all();
        $products = Product::all();
        $testimonials = Testimonial::with('product')->inRandomOrder()->get();
        $tutors = Tutor::with('ebook.subProduct')->inRandomOrder()->get();
        $quote = Quote::find(1);
        $partners = Partner::all();
        $supports = Support::all();

        $blogs = Blog::where('status', 'published')
            ->with('subProduct')
            ->orderByDesc('is_featured')
            ->latest()
            ->take(6)
            ->get();

        $faqs = Faq::where('status', 'published')
            ->orderByDesc('is_featured')
            ->latest()
            ->take(8)
            ->get();

        $total = $faqs->count();
        $firstCount = (int) ceil($total / 2);
        $secondCount = $total - $firstCount;

        $faqs1 = $faqs->slice(0, $firstCount);
        $faqs2 = $faqs->slice($firstCount, $secondCount);

        $donate = Donate::with(['achievement1', 'achievement2', 'achievement3'])->first();

        $community = Profile::select('whatsapp_community', 'telegram_community')->find(1);

        $sosmed = Sosmed::find(1);

        return inertia('User/Home/Index', [
            'banners' => $banners,
            'usps' => $usps,
            'report' => $report,
            'achievements' => $achievements,
            'products' => $products,
            'testimonials' => $testimonials,
            'tutors' => $tutors,
            'quote' => $quote,
            'partners' => $partners,
            'supports' => $supports,
            'blogs' => $blogs,
            'faqs1' => $faqs1,
            'faqs2' => $faqs2,
            'donate' => $donate,
            'sosmed' => $sosmed,
            'community' => $community,
        ]);
    }

    public function products(Product $product)
    {
        $banner = BannerProduct::where('product_id', $product->id)->first();

        $subProducts = SubProduct::where('product_id', $product->id)->with('subProductBenefits')->latest()->get();

        $ebooks = Ebook::whereHas('subProduct', function ($q) use ($product) {
            $q->where('product_id', $product->id);
        })
            ->with('subProduct')
            ->withCount('tutors')
            ->latest()
            ->get();

        $tryouts = Tryout::whereHas('subProduct', function ($q) use ($product) {
            $q->where('product_id', $product->id);
        })
            ->whereHas('questions')
            ->with(['subProduct', 'questions'])
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $playlists = Playlist::whereHas('subProduct', function ($q) use ($product) {
            $q->where('product_id', $product->id);
        })
            ->with('subProduct')
            ->withCount('playlistVideos')
            ->latest()
            ->take(5)
            ->get();

        $testimonials = Testimonial::where('product_id', $product->id)
            ->inRandomOrder()
            ->get();

        $tutors = Tutor::whereHas('ebook.subProduct', function ($q) use ($product) {
            $q->where('product_id', $product->id);
        })
            ->with('ebook.subProduct')
            ->inRandomOrder()
            ->get();

        $community = Profile::select('whatsapp_community', 'telegram_community')->find(1);

        $quote = Quote::where('product_id', $product->id)->first();

        $blogs = Blog::where('status', 'published')
            ->whereHas('subProduct', function ($q) use ($product) {
                $q->where('product_id', $product->id);
            })
            ->with('subProduct')
            ->orderByDesc('is_featured')
            ->latest()
            ->take(6)
            ->get();


        $donate = Donate::with(['achievement1', 'achievement2', 'achievement3'])->first();

        $sosmed = Sosmed::where('product_id', $product->id)->first();

        return inertia('User/Products/Index', [
            'product' => $product,
            'banner' => $banner,
            'subProducts' => $subProducts,
            'ebooks' => $ebooks,
            'tryouts' => $tryouts,
            'playlists' => $playlists,
            'testimonials' => $testimonials,
            'tutors' => $tutors,
            'quote' => $quote,
            'blogs' => $blogs,
            'donate' => $donate,
            'sosmed' => $sosmed,
            'community' => $community,
        ]);
    }

    public function blogs()
    {
        $blogs = Blog::when(request()->q, function ($blogs) {
            $blogs = $blogs->where('title', 'like', '%' . request()->q . '%');
        })->with('subProduct')->where('status', 'published')->orderByDesc('is_featured')->latest()->paginate(10);

        $blogs->appends(['q' => request()->q]);

        $sosmed = Sosmed::find(1);

        return inertia('User/Blogs/Index', [
            'blogs' => $blogs,
            'sosmed' => $sosmed,
        ]);
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with('subProduct')
            ->where('status', 'published')
            ->firstOrFail();

        $sosmed = Sosmed::find(1);

        return inertia('User/Blogs/Show', [
            'blog' => $blog,
            'sosmed' => $sosmed,
        ]);
    }

    public function faqs()
    {
        $faqs = Faq::when(request()->q, function ($faqs) {
            $faqs = $faqs->where('question', 'like', '%' . request()->q . '%');
        })->where('status', 'published')->orderByDesc('is_featured')->latest()->paginate(10);

        $faqs->appends(['q' => request()->q]);

        $sosmed = Sosmed::find(1);

        return inertia('User/Faqs/Index', [
            'faqs' => $faqs,
            'sosmed' => $sosmed,
        ]);
    }

    public function about()
    {
        $products = Product::all();
        $profile = Profile::find(1);
        $achievements = Achievement::all();
        $donate = Donate::with(['achievement1', 'achievement2', 'achievement3'])->first();
        $sosmed = Sosmed::find(1);

        return inertia('User/About/Index', [
            'products' => $products,
            'profile' => $profile,
            'achievements' => $achievements,
            'donate' => $donate,
            'sosmed' => $sosmed,
        ]);
    }

    public function teams()
    {
        $teams = Team::orderByRaw("
            FIELD(status, NULL, 'chief', 'head', 'vice', 'member')
        ")
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('department');
        $sosmed = Sosmed::find(1);

        return inertia('User/Teams/Index', [
            'pimpinan'               => $teams->get('Pimpinan', collect()),
            'marketing_creative'     => $teams->get('Marketing Creative', collect()),
            'strategic_partnership'  => $teams->get('Strategic Partnership', collect()),
            'administration_finance' => $teams->get('Administration & Finance', collect()),
            'product_project'        => $teams->get('Product & Project Manager', collect()),
            'education_development'  => $teams->get('Education Development', collect()),
            'sosmed' => $sosmed,
        ]);
    }

    public function contact()
    {
        $profile = Profile::find(1);
        $sosmed = Sosmed::find(1);

        return inertia('User/Contact/Index', [
            'profile' => $profile,
            'sosmed' => $sosmed,
        ]);
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'message' => 'required',
        ]);

        Message::create([
            'status'  => 'pending',
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('user.contact');
    }


    public function terms()
    {
        $legal = Legal::where('type', 'terms')->first();

        $sosmed = Sosmed::find(1);

        return inertia('User/Terms/Index', [
            'legal' => $legal,
            'sosmed' => $sosmed,
        ]);
    }

    public function privacy()
    {
        $legal = Legal::where('type', 'privacy')->first();

        $sosmed = Sosmed::find(1);

        return inertia('User/Privacy/Index', [
            'legal' => $legal,
            'sosmed' => $sosmed,
        ]);
    }
}
