<?php

namespace App\Http\Controllers\User\Member;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    public function ebooks(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $ebooks = Ebook::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->withCount('tutors')
            ->latest()
            ->paginate(100);

        return inertia('User/Members/Ebooks/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebooks' => $ebooks,
        ]);
    }

    public function ebookShow(Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        $menuProducts = Product::with('subProducts')->get();

        $ebook = Ebook::where('id', $ebook->id)
            ->where('sub_product_id', $subProduct->id)
            ->withCount('tutors')
            ->with('tutors')
            ->firstOrFail();

        return inertia('User/Members/Ebooks/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebook' => $ebook,
        ]);
    }
}
