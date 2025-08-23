<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function achievements()
    {
        $menuProducts = Product::with('subProducts')->get();

        $achievements = Achievement::when(request()->q, function ($achievements) {
            $achievements = $achievements->where('title', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $achievements->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Achievements/Index', [
            'menuProducts' => $menuProducts,
            'achievements' => $achievements,
        ]);
    }

    public function achievementStore(Request $request)
    {
        $request->validate([
            'icon'  => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'title' => 'required',
            'value' => 'required',
        ], [
            'icon.required' => 'Ikon tidak boleh kosong.',
            'icon.image'    => 'Ikon pencapaian harus berupa file gambar.',
            'icon.mimes'    => 'Ikon harus berekstensi jpg, jpeg, atau png.',
            'icon.max'      => 'Ukuran ikon maksimal 10MB.',
        ]);

        $path_icon = $request->file('icon')->store('achievements', 'public');

        Achievement::create([
            'icon'  => $path_icon,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.pages.letstudy.achievements.index');
    }

    public function achievementUpdate(Request $request, Achievement $achievement)
    {
        $request->validate([
            'icon'  => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'title' => 'required',
            'value' => 'required',
        ], [
            'icon.image' => 'Ikon pencapaian harus berupa file gambar.',
            'icon.mimes' => 'Ikon harus berekstensi jpg, jpeg, atau png.',
            'icon.max'   => 'Ukuran ikon maksimal 10MB.',
        ]);

        $path_icon = $achievement->icon;
        if ($request->hasFile('icon')) {
            if ($path_icon && Storage::disk('public')->exists($path_icon)) {
                Storage::disk('public')->delete($path_icon);
            }

            $path_icon = $request->file('icon')->store('achievements', 'public');
        }

        $achievement->update([
            'icon'  => $path_icon,
            'title' => $request->title,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.pages.letstudy.achievements.index');
    }

    public function achievementDestroy($id)
    {
        $achievement = Achievement::findOrFail($id);

        if ($achievement->icon && Storage::disk('public')->exists($achievement->icon)) {
            Storage::disk('public')->delete($achievement->icon);
        }

        $achievement->delete();

        return redirect()->route('admin.pages.letstudy.achievements.index');
    }
}
