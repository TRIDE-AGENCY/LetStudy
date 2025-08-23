<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function testimonials(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $testimonials = Testimonial::when(request()->q, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request()->q . '%')
                    ->orWhere('testimonial', 'like', '%' . request()->q . '%');
            });
        })->where('product_id', $product->id)->with('product')->latest()->paginate(10);

        $testimonials->appends(['q' => request()->q]);

        return inertia('Admin/Pages/Products/Testimonials/Index', [
            'menuProducts' => $menuProducts,
            'testimonials' => $testimonials,
            'product' => $product,
        ]);
    }

    public function testimonialStore(Request $request, Product $product)
    {
        $request->validate([
            'photo'        => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'name'         => 'required',
            'title'        => 'required',
            'testimonial'  => 'required',
        ], [
            'photo.required' => 'Foto profil tidak boleh kosong.',
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
        ]);

        $path_photo = $request->file('photo')->store('testimonials', 'public');

        Testimonial::create([
            'product_id'  => $product->id,
            'photo'       => $path_photo,
            'name'        => $request->name,
            'title'       => $request->title,
            'testimonial' => $request->testimonial,
        ]);

        return redirect()->route('admin.pages.products.testimonials.index', [
            'product' => $product->slug,
        ]);
    }

    public function testimonialUpdate(Request $request, Product $product, Testimonial $testimonial)
    {
        $request->validate([
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'name'         => 'required',
            'title'        => 'required',
            'testimonial'  => 'required',
        ], [
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
        ]);

        $path_photo = $testimonial->photo;
        if ($request->hasFile('photo')) {
            if ($path_photo && Storage::disk('public')->exists($path_photo)) {
                Storage::disk('public')->delete($path_photo);
            }

            $path_photo = $request->file('photo')->store('testimonials', 'public');
        }

        $testimonial->update([
            'product_id'  => $product->id,
            'photo'       => $path_photo,
            'name'        => $request->name,
            'title'       => $request->title,
            'testimonial' => $request->testimonial,
        ]);

        return redirect()->route('admin.pages.products.testimonials.index', [
            'product' => $product->slug,
        ]);
    }

    public function testimonialDestroy(Product $product, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.pages.products.testimonials.index', [
            'product' => $product->slug,
        ]);
    }
}
