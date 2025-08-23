<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function blogs()
    {
        $menuProducts = Product::with('subProducts')->get();

        $blogs = Blog::when(request()->q, function ($blogs) {
            $blogs = $blogs->where('title', 'like', '%' . request()->q . '%');
        })->with('subProduct')->orderByDesc('is_featured')->latest()->paginate(10);

        $blogs->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Blogs/Index', [
            'menuProducts' => $menuProducts,
            'blogs' => $blogs,
        ]);
    }

    public function blogCreate()
    {
        $menuProducts = Product::with('subProducts')->get();
        $subProducts = SubProduct::all();

        return inertia('Admin/Pages/LetStudy/Blogs/Create', [
            'menuProducts' => $menuProducts,
            'subProducts' => $subProducts,
        ]);
    }

    public function blogStore(Request $request)
    {
        $request->validate([
            'sub_product_id' => 'nullable',
            'title'       => 'required|unique:blogs,title',
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'content'     => 'required',
            'status'      => 'required',
            'is_featured' => 'required',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'content.required' => 'Konten tidak boleh kosong.',
            'status.required'  => 'Status tidak boleh kosong.',
            'image.required'   => 'Gambar tidak boleh kosong.',
            'image.image'      => 'Gambar blog harus berupa file gambar.',
            'image.mimes'      => 'Gambar blog harus berekstensi jpg, jpeg, atau png.',
            'image.max'        => 'Ukuran gambar blog maksimal 10MB.',
        ]);

        $path_image = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'sub_product_id' => $request->sub_product_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'image'       => $path_image,
            'content'     => $request->content,
            'status'      => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->route('admin.pages.letstudy.blogs.index');
    }

    public function blogEdit($id)
    {
        $menuProducts = Product::with('subProducts')->get();
        $blog = Blog::findOrFail($id);
        $blog->image_name = basename($blog->image);
        $blog->image_size = Storage::disk('public')->size($blog->image);
        $subProducts = SubProduct::all();

        return inertia('Admin/Pages/LetStudy/Blogs/Edit', [
            'menuProducts' => $menuProducts,
            'blog' => $blog,
            'subProducts' => $subProducts,
        ]);
    }

    public function blogUpdate(Request $request, Blog $blog)
    {
        $request->validate([
            'sub_product_id' => 'nullable',
            'title'       => 'required|unique:blogs,title,' . $blog->id,
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'content'     => 'required',
            'status'      => 'required',
            'is_featured' => 'required',
        ], [
            'title.unique'     => 'Judul sudah digunakan. Gunakan judul lain.',
            'content.required' => 'Konten tidak boleh kosong.',
            'status.required'  => 'Status tidak boleh kosong.',
            'image.image' => 'Gambar blog harus berupa file gambar.',
            'image.mimes' => 'Gambar blog harus berekstensi jpg, jpeg, atau png.',
            'image.max'   => 'Ukuran gambar blog maksimal 10MB.',
        ]);

        $path_image = $blog->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'sub_product_id' => $request->sub_product_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'image'       => $path_image,
            'content'     => $request->content,
            'status'      => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->route('admin.pages.letstudy.blogs.index');
    }

    public function blogDestroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->photo && Storage::disk('public')->exists($blog->photo)) {
            Storage::disk('public')->delete($blog->photo);
        }

        $blog->delete();

        return redirect()->route('admin.pages.letstudy.blogs.index');
    }
}
