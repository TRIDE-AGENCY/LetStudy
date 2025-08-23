<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EbookController extends Controller
{
    public function ebooks(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $ebooks = Ebook::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(100);

        return inertia('Admin/Members/Ebooks/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebooks' => $ebooks,
        ]);
    }

    public function ebookCreate(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Ebooks/Create', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
        ]);
    }

    public function ebookStore(Request $request, Product $product, SubProduct $subProduct)
    {
        $request->validate([
            'title'       => 'required|unique:ebooks,title',
            'id_ebook'    => 'required|unique:ebooks,id_ebook',
            'id_form'     => 'required',
            'launch_date' => 'required',
            'total_pages' => 'required',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'required',
            'benefit'     => 'required',
        ], [
            'title.unique'   => 'Judul e-book sudah digunakan. Gunakan judul lain.',
            'id_ebook.unique' => 'ID e-book sudah digunakan. Gunakan ID lain.',
            'image.required' => 'Sampul tidak boleh kosong.',
            'image.image'    => 'Sampul ebook harus berupa file gambar.',
            'image.mimes'    => 'Sampul ebook harus berekstensi jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran sampul ebook maksimal 10MB.',
        ]);

        $path_image = $request->file('image')->store('ebooks', 'public');

        Ebook::create([
            'sub_product_id' => $subProduct->id,
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'id_ebook'       => $request->id_ebook,
            'id_form'        => $request->id_form,
            'launch_date'    => date('Y-m-d', strtotime($request->launch_date)),
            'total_pages'    => $request->total_pages,
            'image'          => $path_image,
            'description'    => $request->description,
            'benefit'        => $request->benefit,
        ]);

        return redirect()->route('admin.members.ebooks.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function ebookShow(Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Ebooks/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebook' => $ebook,
        ]);
    }

    public function ebookEdit(Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        $menuProducts = Product::with('subProducts')->get();
        $ebook->image_name = basename($ebook->image);
        $ebook->image_size = Storage::disk('public')->size($ebook->image);

        return inertia('Admin/Members/Ebooks/Edit', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebook' => $ebook,
        ]);
    }

    public function ebookUpdate(Request $request, Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        $request->validate([
            'title'       => 'required|unique:ebooks,title,' . $ebook->id,
            'id_ebook'    => 'required|unique:ebooks,id_ebook,' . $ebook->id,
            'id_form'     => 'required',
            'launch_date' => 'required',
            'total_pages' => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'description' => 'required',
            'benefit'     => 'required',
        ], [
            'title.unique'   => 'Judul e-book sudah digunakan. Gunakan judul lain.',
            'id_ebook.unique' => 'ID e-book sudah digunakan. Gunakan ID lain.',
            'image.image'    => 'Sampul ebook harus berupa file gambar.',
            'image.mimes'    => 'Sampul ebook harus berekstensi jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran sampul ebook maksimal 10MB.',
        ]);

        $path_image = $ebook->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('ebooks', 'public');
        }

        $ebook->update([
            'sub_product_id' => $subProduct->id,
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'id_ebook'       => $request->id_ebook,
            'id_form'        => $request->id_form,
            'launch_date'    => date('Y-m-d', strtotime($request->launch_date)),
            'total_pages'    => $request->total_pages,
            'image'          => $path_image,
            'description'    => $request->description,
            'benefit'        => $request->benefit,
        ]);

        return redirect()->route('admin.members.ebooks.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'ebook' => $ebook->slug,
        ]);
    }

    public function ebookDestroy(Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        if ($ebook->image && Storage::disk('public')->exists($ebook->image)) {
            Storage::disk('public')->delete($ebook->image);
        }

        $ebook->delete();

        return redirect()->route('admin.members.ebooks.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function ebookRead(Product $product, SubProduct $subProduct, Ebook $ebook)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Ebooks/Read', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'ebook' => $ebook,
        ]);
    }
}
