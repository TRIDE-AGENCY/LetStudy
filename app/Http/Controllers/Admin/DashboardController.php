<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('subProducts')
            ->withCount('testimonials')
            ->get();

        $subProducts = SubProduct::withCount([
            'ebooks',
            'tryouts',
            'playlists'
        ])->get();

        $blogs = Blog::with('subProduct.product')
            ->get()
            ->groupBy(
                function ($blog) {
                    return $blog->sub_product_id ? $blog->subProduct->product->title : 'General';
                }
            );

        $tutors = Tutor::with('ebook.subProduct.product')
            ->get()
            ->groupBy(function ($tutor) {
                return $tutor->ebook->subProduct->product->title;
            });

        $users = User::where('role', 'User')->get();

        return inertia('Admin/Dashboard/Index', [
            'menuProducts' => $products,
            'subProducts' => $subProducts,
            'users' => $users,
            'tutors' => $tutors,
            'blogs' => $blogs,
        ]);
    }
}
