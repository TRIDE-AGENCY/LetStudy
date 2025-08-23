<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function supports()
    {
        $menuProducts = Product::with('subProducts')->get();

        $supports = Support::when(request()->q, function ($supports) {
            $supports = $supports->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $supports->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Supports/Index', [
            'menuProducts' => $menuProducts,
            'supports' => $supports,
        ]);
    }

    public function supportStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'link' => 'required',
        ], [
            'logo.required' => 'Logo tidak boleh kosong.',
            'logo.image'    => 'Logo harus berupa file gambar.',
            'logo.mimes'    => 'Logo harus berekste nsi jpg, jpeg, atau png.',
            'logo.max'      => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_logo = $request->file('logo')->store('supports', 'public');

        Support::create([
            'name' => $request->name,
            'logo' => $path_logo,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.pages.letstudy.supports.index');
    }

    public function supportUpdate(Request $request, Support $support)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'link' => 'required',
        ], [
            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berekstensi jpg, jpeg, atau png.',
            'logo.max'   => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_logo = $support->logo;
        if ($request->hasFile('logo')) {
            if ($path_logo && Storage::disk('public')->exists($path_logo)) {
                Storage::disk('public')->delete($path_logo);
            }

            $path_logo = $request->file('logo')->store('supports', 'public');
        }

        $support->update([
            'name' => $request->name,
            'logo' => $path_logo,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.pages.letstudy.supports.index');
    }

    public function supportDestroy($id)
    {
        $support = Support::findOrFail($id);

        if ($support->logo && Storage::disk('public')->exists($support->logo)) {
            Storage::disk('public')->delete($support->logo);
        }

        $support->delete();

        return redirect()->route('admin.pages.letstudy.supports.index');
    }
}
