<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Playlist;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Tryout;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();

        $ebooks = Ebook::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(10);

        $tryouts = Tryout::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(10);

        $playlists = Playlist::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(10);

        return inertia('User/Members/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebooks' => $ebooks,
            'tryouts' => $tryouts,
            'playlists' => $playlists,
        ]);
    }
}
