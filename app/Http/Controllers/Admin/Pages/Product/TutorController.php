<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Product;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorController extends Controller
{
    public function tutors(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $tutors = Tutor::when(request()->q, function ($tutors) {
            $tutors = $tutors->where('name', 'like', '%' . request()->q . '%');
        })->whereHas('ebook', function ($query) use ($product) {
            $query->whereHas('subProduct', function ($q) use ($product) {
                $q->where('product_id', $product->id);
            });
        })->with(['ebook' => function ($query) use ($product) {
            $query->whereHas('subProduct', function ($q) use ($product) {
                $q->where('product_id', $product->id);
            });
        }])->latest()->paginate(10);

        $tutors->appends(['q' => request()->q]);

        return inertia('Admin/Pages/Products/Tutors/Index', [
            'menuProducts' => $menuProducts,
            'tutors' => $tutors,
            'product' => $product,
        ]);
    }

    public function tutorCreate(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();
        $ebooks = Ebook::whereHas('subProduct', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return inertia('Admin/Pages/Products/Tutors/Create', [
            'menuProducts' => $menuProducts,
            'ebooks' => $ebooks,
            'product' => $product,
        ]);
    }

    public function tutorStore(Request $request, Product $product)
    {
        $request->validate([
            'ebook_id'       => 'required',
            'name'           => 'required',
            'title'          => 'required',
            'education'      => 'required',
            'photo'          => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'achievement'    => 'required',
        ], [
            'photo.required' => 'Foto profil tidak boleh kosong.',
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
            'achievement.required' => 'Pencapaian tidak boleh kosong.',
        ]);

        $path_photo = $request->file('photo')->store('tutors', 'public');

        Tutor::create([
            'ebook_id'       => $request->ebook_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'education'      => $request->education,
            'photo'          => $path_photo,
            'achievement'    => $request->achievement,
        ]);

        return redirect()->route('admin.pages.products.tutors.index', [
            'product' => $product->slug,
        ]);
    }

    public function tutorEdit(Product $product, $id)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tutor = Tutor::findOrFail($id);
        $tutor->photo_name = basename($tutor->photo);
        $tutor->photo_size = Storage::disk('public')->size($tutor->photo);
        $ebooks = Ebook::whereHas('subProduct', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();

        return inertia('Admin/Pages/Products/Tutors/Edit', [
            'menuProducts' => $menuProducts,
            'tutor' => $tutor,
            'ebooks' => $ebooks,
            'product' => $product,
        ]);
    }

    public function tutorUpdate(Request $request, Product $product, Tutor $tutor)
    {
        $request->validate([
            'ebook_id'       => 'required',
            'name'           => 'required',
            'title'          => 'required',
            'education'      => 'required',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'achievement'    => 'required',
        ], [
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
            'achievement.required' => 'Pencapaian tidak boleh kosong.',
        ]);

        $path_photo = $tutor->photo;
        if ($request->hasFile('photo')) {
            if ($path_photo && Storage::disk('public')->exists($path_photo)) {
                Storage::disk('public')->delete($path_photo);
            }

            $path_photo = $request->file('photo')->store('tutors', 'public');
        }

        $tutor->update([
            'ebook_id'       => $request->ebook_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'education'      => $request->education,
            'photo'          => $path_photo,
            'achievement'    => $request->achievement,
        ]);

        return redirect()->route('admin.pages.products.tutors.index', [
            'product' => $product->slug,
        ]);
    }

    public function tutorDestroy(Product $product, $id)
    {
        $tutor = Tutor::findOrFail($id);

        if ($tutor->photo && Storage::disk('public')->exists($tutor->photo)) {
            Storage::disk('public')->delete($tutor->photo);
        }

        $tutor->delete();

        return redirect()->route('admin.pages.products.tutors.index', [
            'product' => $product->slug,
        ]);
    }
}
