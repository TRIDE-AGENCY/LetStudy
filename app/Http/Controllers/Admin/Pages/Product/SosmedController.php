<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function sosmed(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $sosmed = Sosmed::where('product_id', $product->id)->first();

        return inertia('Admin/Pages/Products/Sosmed/Index', [
            'menuProducts' => $menuProducts,
            'sosmed' => $sosmed,
            'product' => $product,
        ]);
    }

    public function sosmedUpdate(Request $request, Product $product, Sosmed $sosmed)
    {
        $request->validate([
            'instagram' => 'nullable',
            'youtube'   => 'nullable',
            'tiktok'    => 'nullable',
            'linkedin'  => 'nullable',
            'x'         => 'nullable',
        ]);

        $sosmed->update([
            'product_id' => $product->id,
            'instagram' => $request->instagram,
            'youtube'   => $request->youtube,
            'tiktok'    => $request->tiktok,
            'linkedin'  => $request->linkedin,
            'x'         => $request->x,
        ]);

        return redirect()->route('admin.pages.products.sosmed.index', [
            'product' => $product->slug,
        ]);
    }
}
