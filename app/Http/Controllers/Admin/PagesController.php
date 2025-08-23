<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Banner;
use App\Models\BannerProduct;
use App\Models\Blog;
use App\Models\Donate;
use App\Models\Faq;
use App\Models\Legal;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Report;
use App\Models\Sosmed;
use App\Models\SubProduct;
use App\Models\Support;
use App\Models\Testimonial;
use App\Models\Tutor;
use App\Models\Usp;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function letStudy()
    {
        $products = Product::with('subProducts')->get();

        $banners = Banner::count();
        $usps = Usp::count();

        $report = Report::find(1);
        $reportComplete = $report &&
            $report->heading &&
            $report->sub_heading &&
            $report->id_report &&
            $report->image;

        $achievements = Achievement::count();
        $listProducts = Product::count();
        $testimonials = Testimonial::count();
        $tutors = Tutor::count();

        $quote = Quote::find(1);
        $quoteComplete = $quote &&
            $quote->name &&
            $quote->title &&
            $quote->quote;

        $partners = Partner::count();
        $supports = Support::count();
        $blogs = Blog::count();
        $faqs = Faq::count();

        $donate = Donate::find(1);
        $donateComplete = $donate &&
            $donate->bank_name &&
            $donate->bank_number &&
            $donate->bank_account &&
            $donate->qrcode_image &&
            $donate->qrcode_name &&
            $donate->qrcode_nmid &&
            $donate->achievement1_id &&
            $donate->achievement2_id &&
            $donate->achievement3_id;

        $sosmedRecord = Sosmed::find(1);
        $sosmedCount = 0;
        if ($sosmedRecord) {
            $fields = ['instagram', 'youtube', 'tiktok', 'linkedin', 'x', 'email'];
            foreach ($fields as $field) {
                if (!empty($sosmedRecord->$field)) {
                    $sosmedCount++;
                }
            }
        }

        return inertia('Admin/Pages/LetStudy/Index', [
            'menuProducts' => $products,
            'banners' => $banners,
            'usps' => $usps,
            'reportComplete' => $reportComplete ? 'Data Lengkap' : 'Belum Lengkap',
            'achievements' => $achievements,
            'listProducts' => $listProducts,
            'testimonials' => $testimonials,
            'tutors' => $tutors,
            'quoteComplete' => $quoteComplete ? 'Data Lengkap' : 'Belum Lengkap',
            'partners' => $partners,
            'supports' => $supports,
            'blogs' => $blogs,
            'faqs' => $faqs,
            'donateComplete' => $donateComplete ? 'Data Lengkap' : 'Belum Lengkap',
            'sosmedCount' => $sosmedCount,
        ]);
    }

    public function products(Product $product)
    {
        $products = Product::with('subProducts')->get();

        $banner = BannerProduct::where('product_id', $product->id)->first();;
        $bannerComplete = $banner &&
            $banner->heading &&
            $banner->sub_heading &&
            $banner->image;

        $subProducts = SubProduct::where('product_id', $product->id)->count();

        $testimonials = Testimonial::where('product_id', $product->id)->count();

        $tutors = Tutor::whereHas('ebook.subProduct', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->count();

        $quote = Quote::where('product_id', $product->id)->first();;
        $quoteComplete = $quote &&
            $quote->name &&
            $quote->title &&
            $quote->quote;

        $blogs = Blog::whereHas('subProduct', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->count();

        $sosmedRecord = Sosmed::where('product_id', $product->id)->first();
        $sosmedCount = 0;
        if ($sosmedRecord) {
            $fields = ['instagram', 'youtube', 'tiktok', 'linkedin', 'x', 'email'];
            foreach ($fields as $field) {
                if (!empty($sosmedRecord->$field)) {
                    $sosmedCount++;
                }
            }
        }

        return inertia('Admin/Pages/Products/Index', [
            'menuProducts' => $products,
            'product' => $product,
            'bannerComplete' => $bannerComplete ? 'Data Lengkap' : 'Belum Lengkap',
            'subProducts' => $subProducts,
            'testimonials' => $testimonials,
            'tutors' => $tutors,
            'quoteComplete' => $quoteComplete ? 'Data Lengkap' : 'Belum Lengkap',
            'blogs' => $blogs,
            'sosmedCount' => $sosmedCount,
        ]);
    }

    public function legalTerms()
    {
        $products = Product::with('subProducts')->get();
        $legal = Legal::where('type', 'terms')->first();

        return inertia('Admin/Pages/Legals/Terms/Index', [
            'menuProducts' => $products,
            'legal' => $legal,
        ]);
    }

    public function legalTermsUpdate(Request $request, Legal $legal)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => 'Konten tidak boleh kosong.',
        ]);

        $legal->update([
            'type' => 'terms',
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.legal.terms.index');
    }

    public function legalPrivacy()
    {
        $products = Product::with('subProducts')->get();
        $legal = Legal::where('type', 'privacy')->first();

        return inertia('Admin/Pages/Legals/Privacy/Index', [
            'menuProducts' => $products,
            'legal' => $legal,
        ]);
    }

    public function legalPrivacyUpdate(Request $request, Legal $legal)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => 'Konten tidak boleh kosong.',
        ]);

        $legal->update([
            'type' => 'privacy',
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.legal.privacy.index');
    }
}
