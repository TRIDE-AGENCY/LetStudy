<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('subProducts')->when(request()->q, function ($products) {
            $products = $products->where('title', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $products->appends(['q' => request()->q]);

        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Products/Index', [
            'menuProducts' => $menuProducts,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo'        => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'title'       => 'required|unique:products,title',
            'description' => 'required',
            'sub_products' => 'required|array',
            'sub_products.*.title' => 'required|string',
        ], [
            'title.unique'  => 'Nama produk sudah digunakan. Gunakan nama lain.',
            'logo.required' => 'Logo tidak boleh kosong.',
            'logo.image'    => 'Logo harus berupa file gambar.',
            'logo.mimes'    => 'Logo harus berekstensi jpg, jpeg, atau png.',
            'logo.max'      => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_logo = $request->file('logo')->store('products', 'public');

        $product = Product::create([
            'logo'        => $path_logo,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
        ]);

        foreach ($request->sub_products as $subProduct) {
            $product->subProducts()->create([
                'title' => $subProduct['title'],
                'slug'  => Str::slug($subProduct['title']),
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'title'       => 'required|unique:products,title,' . $product->id,
            'description' => 'required',
            'sub_products' => 'required|array',
            'sub_products.*.title' => 'required|string',
        ], [
            'title.unique' => 'Nama produk sudah digunakan. Gunakan nama lain.',
            'logo.image' => 'Logo harus berupa file gambar.',
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
            'logo'        => $path_logo,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'description' => $request->description,
        ]);

        if ($request->has('sub_products')) {
            $existingIds = $product->subProducts()->pluck('id')->toArray();
            $incomingIds = [];

            foreach ($request->sub_products as $subProduct) {
                if (isset($subProduct['id'])) {
                    $product->subProducts()->where('id', $subProduct['id'])->update([
                        'title' => $subProduct['title'],
                        'slug'  => Str::slug($subProduct['title']),
                    ]);
                    $incomingIds[] = $subProduct['id'];
                } else {
                    $new = $product->subProducts()->create([
                        'title' => $subProduct['title'],
                        'slug'  => Str::slug($subProduct['title']),
                    ]);
                    $incomingIds[] = $new->id;
                }
            }

            $toDelete = array_diff($existingIds, $incomingIds);
            $product->subProducts()->whereIn('id', $toDelete)->delete();
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->logo && Storage::disk('public')->exists($product->logo)) {
            Storage::disk('public')->delete($product->logo);
        }

        $product->delete();

        return redirect()->route('admin.products.index');
    }
}
