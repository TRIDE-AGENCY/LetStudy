<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProductController extends Controller
{
    public function subProducts(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $subProducts = SubProduct::where('product_id', $product->id)->with('subProductBenefits')->latest()->get();

        return inertia('Admin/Pages/Products/SubProducts/Index', [
            'menuProducts' => $menuProducts,
            'subProducts' => $subProducts,
            'product' => $product,
        ]);
    }

    public function subProductUpdate(Request $request, Product $product, SubProduct $subProduct)
    {
        $request->validate([
            'icon'  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'required',
            'sub_product_benefits' => 'required|array|min:1',
            'sub_product_benefits.*.benefit' => 'required|string',
        ], [
            'icon.image' => 'Ikon pencapaian harus berupa file gambar.',
            'icon.mimes' => 'Ikon harus berekstensi jpg, jpeg, atau png.',
            'icon.max'   => 'Ukuran ikon maksimal 10MB.',
            'sub_product_benefits.required' => 'Minimal harus ada 1 tujuan & manfaat.',
            'sub_product_benefits.min'      => 'Minimal harus ada 1 tujuan & manfaat.',
        ]);

        $path_icon = $subProduct->icon;
        if ($request->hasFile('icon')) {
            if ($path_icon && Storage::disk('public')->exists($path_icon)) {
                Storage::disk('public')->delete($path_icon);
            }

            $path_icon = $request->file('icon')->store('subProducts', 'public');
        }

        $subProduct->update([
            'icon'  => $path_icon,
            'description' => $request->description,
        ]);

        $subProduct->subProductBenefits()->delete();

        foreach ($request->sub_product_benefits as $sub_product_benefit) {
            $subProduct->subProductBenefits()->create([
                'benefit' => $sub_product_benefit['benefit'],
            ]);
        }

        return redirect()->route('admin.pages.products.subproducts.index', [
            'product' => $product->slug,
        ]);
    }
}
