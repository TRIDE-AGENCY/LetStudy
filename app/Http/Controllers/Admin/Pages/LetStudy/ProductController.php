<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products()
    {
        $menuProducts = Product::with('subProducts')->get();

        $products = Product::latest()->get();

        return inertia('Admin/Pages/LetStudy/Products/Index', [
            'menuProducts' => $menuProducts,
            'products' => $products,
        ]);
    }

    public function productUpdate(Request $request, Product $product)
    {
        $request->validate([
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'required',
        ], [
            'logo.image' => 'Logo pencapaian harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berekstensi jpg, jpeg, atau png.',
            'logo.max'   => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_logo = $product->logo;
        if ($request->hasFile('logo')) {
            if ($path_logo && Storage::disk('public')->exists($path_logo)) {
                Storage::disk('public')->delete($path_logo);
            }

            $path_logo = $request->file('logo')->store('products', 'public');
        }

        $product->update([
            'logo'  => $path_logo,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.pages.letstudy.products.index');
    }
}
