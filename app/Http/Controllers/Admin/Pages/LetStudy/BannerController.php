<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Ebook;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function banners()
    {
        $menuProducts = Product::with('subProducts')->get();

        $banners = Banner::when(request()->q, function ($banners) {
            $banners = $banners->where('heading', 'like', '%' . request()->q . '%');
        })->with('ebook')->latest()->paginate(10);

        $banners->appends(['q' => request()->q]);
        $ebooks = Ebook::all();

        return inertia('Admin/Pages/LetStudy/Banners/Index', [
            'menuProducts' => $menuProducts,
            'banners' => $banners,
            'ebooks' => $ebooks,
        ]);
    }

    public function bannerStore(Request $request)
    {
        $request->validate([
            'ebook_id'       => 'required|unique:banners,ebook_id',
            'heading'        => 'required',
            'sub_heading'    => 'required',
            'image'          => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'ebook_id.unique' => 'E-book sudah digunakan. Gunakan e-book lain.',
            'image.required' => 'Gambar banner tidak boleh kosong.',
            'image.image'    => 'Gambar banner harus berupa file gambar.',
            'image.mimes'    => 'Gambar banner harus berekstensi jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran gambar banner maksimal 10MB.',
        ]);

        $path_image = $request->file('image')->store('banners', 'public');

        Banner::create([
            'ebook_id'       => $request->ebook_id,
            'heading'        => $request->heading,
            'sub_heading'    => $request->sub_heading,
            'image'          => $path_image,
        ]);

        return redirect()->route('admin.pages.letstudy.banners.index');
    }

    public function bannerUpdate(Request $request, Banner $banner)
    {
        $request->validate([
            'ebook_id'       => 'required|unique:banners,ebook_id,' . $banner->id,
            'heading'        => 'required',
            'sub_heading'    => 'required',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'ebook_id.unique' => 'E-book sudah digunakan. Gunakan e-book lain.',
            'image.image'    => 'Gambar banner harus berupa file gambar.',
            'image.mimes'    => 'Gambar banner harus berekstensi jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran gambar banner maksimal 10MB.',
        ]);

        $path_image = $banner->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('banners', 'public');
        }

        $banner->update([
            'ebook_id'       => $request->ebook_id,
            'heading'        => $request->heading,
            'sub_heading'    => $request->sub_heading,
            'image'          => $path_image,
        ]);

        return redirect()->route('admin.pages.letstudy.banners.index');
    }

    public function bannerDestroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.pages.letstudy.banners.index');
    }
}
