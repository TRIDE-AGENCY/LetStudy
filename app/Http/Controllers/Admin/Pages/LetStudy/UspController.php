<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Usp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UspController extends Controller
{
    public function usps()
    {
        $menuProducts = Product::with('subProducts')->get();

        $usps = Usp::when(request()->q, function ($usps) {
            $usps = $usps->where('title', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $usps->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Usps/Index', [
            'menuProducts' => $menuProducts,
            'usps' => $usps,
        ]);
    }

    public function uspStore(Request $request)
    {
        $request->validate([
            'icon'        => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'title'       => 'required',
            'description' => 'required',
        ], [
            'icon.required' => 'Ikon tidak boleh kosong.',
            'icon.image'    => 'Ikon harus berupa file gambar.',
            'icon.mimes'    => 'Ikon harus berekstensi jpg, jpeg, atau png.',
            'icon.max'      => 'Ukuran ikon maksimal 10MB.',
        ]);

        $path_icon = $request->file('icon')->store('usps', 'public');

        Usp::create([
            'icon'        => $path_icon,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.pages.letstudy.usps.index');
    }

    public function uspUpdate(Request $request, Usp $usp)
    {
        $request->validate([
            'icon'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'title'       => 'required',
            'description' => 'required',
        ], [
            'icon.image' => 'Ikon harus berupa file gambar.',
            'icon.mimes' => 'Ikon harus berekstensi jpg, jpeg, atau png.',
            'icon.max'   => 'Ukuran ikon maksimal 10MB.',
        ]);

        $path_icon = $usp->icon;
        if ($request->hasFile('icon')) {
            if ($path_icon && Storage::disk('public')->exists($path_icon)) {
                Storage::disk('public')->delete($path_icon);
            }

            $path_icon = $request->file('icon')->store('usps', 'public');
        }

        $usp->update([
            'icon'        => $path_icon,
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.pages.letstudy.usps.index');
    }

    public function uspDestroy($id)
    {
        $usp = Usp::findOrFail($id);

        if ($usp->icon && Storage::disk('public')->exists($usp->icon)) {
            Storage::disk('public')->delete($usp->icon);
        }

        $usp->delete();

        return redirect()->route('admin.pages.letstudy.usps.index');
    }
}
