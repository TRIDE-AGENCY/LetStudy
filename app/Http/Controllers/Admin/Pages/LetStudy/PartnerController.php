<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function partners()
    {
        $menuProducts = Product::with('subProducts')->get();

        $partners = Partner::when(request()->q, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request()->q . '%')
                    ->orWhere('statement', 'like', '%' . request()->q . '%');
            });
        })->latest()->paginate(10);

        $partners->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Partners/Index', [
            'menuProducts' => $menuProducts,
            'partners' => $partners,
        ]);
    }

    public function partnerStore(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'title'     => 'required',
            'photo'     => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'logo'      => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'statement' => 'required',
        ], [
            'photo.required' => 'Foto profil tidak boleh kosong.',
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
            'logo.required'  => 'Logo tidak boleh kosong.',
            'logo.image'     => 'Logo harus berupa file gambar.',
            'logo.mimes'     => 'Logo harus berekstensi jpg, jpeg, atau png.',
            'logo.max'       => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_photo = $request->file('photo')->store('partners', 'public');
        $path_logo = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name'      => $request->name,
            'title'     => $request->title,
            'photo'     => $path_photo,
            'logo'      => $path_logo,
            'statement' => $request->statement,
        ]);

        return redirect()->route('admin.pages.letstudy.partners.index');
    }

    public function partnerUpdate(Request $request, Partner $partner)
    {
        $request->validate([
            'name'      => 'required',
            'title'     => 'required',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'statement' => 'required',
        ], [
            'photo.image' => 'Foto profil harus berupa file gambar.',
            'photo.mimes' => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'   => 'Ukuran foto profil maksimal 10MB.',
            'logo.image'  => 'Logo harus berupa file gambar.',
            'logo.mimes'  => 'Logo harus berekstensi jpg, jpeg, atau png.',
            'logo.max'    => 'Ukuran logo maksimal 10MB.',
        ]);

        $path_photo = $partner->photo;
        if ($request->hasFile('photo')) {
            if ($path_photo && Storage::disk('public')->exists($path_photo)) {
                Storage::disk('public')->delete($path_photo);
            }

            $path_photo = $request->file('photo')->store('partners', 'public');
        }

        $path_logo = $partner->logo;
        if ($request->hasFile('logo')) {
            if ($path_logo && Storage::disk('public')->exists($path_logo)) {
                Storage::disk('public')->delete($path_logo);
            }

            $path_logo = $request->file('logo')->store('partners', 'public');
        }

        $partner->update([
            'name'      => $request->name,
            'title'     => $request->title,
            'photo'     => $path_photo,
            'logo'      => $path_logo,
            'statement' => $request->statement,
        ]);

        return redirect()->route('admin.pages.letstudy.partners.index');
    }

    public function partnerDestroy($id)
    {
        $partner = Partner::findOrFail($id);

        if ($partner->photo && Storage::disk('public')->exists($partner->photo)) {
            Storage::disk('public')->delete($partner->photo);
        }

        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->route('admin.pages.letstudy.partners.index');
    }
}
