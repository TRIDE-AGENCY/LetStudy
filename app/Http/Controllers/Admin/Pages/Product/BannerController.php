<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\BannerProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function banner(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $banner = BannerProduct::where('product_id', $product->id)->first();
        $banner->image_name = $banner && $banner->image
            ? basename($banner->image)
            : null;
        $banner->image_size = $banner && $banner->image && Storage::disk('public')->exists($banner->image)
            ? Storage::disk('public')->size($banner->image)
            : null;

        return inertia('Admin/Pages/Products/Banner/Index', [
            'menuProducts' => $menuProducts,
            'banner' => $banner,
            'product' => $product,
        ]);
    }

    public function bannerUpdate(Request $request, Product $product, BannerProduct $banner)
    {
        $request->validate([
            'heading'     => 'required',
            'sub_heading' => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'image.image' => 'Gambar harus berupa file gambar.',
            'image.mimes' => 'Gambar harus berekstensi jpg, jpeg, atau png.',
            'image.max'   => 'Ukuran gambar maksimal 10MB.',
        ]);

        $path_image = $banner->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('banners', 'public');
        }

        $banner->update([
            'product_id'  => $product->id,
            'heading'     => $request->heading,
            'sub_heading' => $request->sub_heading,
            'image'       => $path_image,
        ]);

        return redirect()->route('admin.pages.products.banner.index', [
            'product' => $product->slug,
        ]);
    }
}
