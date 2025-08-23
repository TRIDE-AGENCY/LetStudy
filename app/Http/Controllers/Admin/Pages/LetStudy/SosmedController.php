<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function sosmed()
    {
        $menuProducts = Product::with('subProducts')->get();

        $sosmed = Sosmed::find(1);

        return inertia('Admin/Pages/LetStudy/Sosmed/Index', [
            'menuProducts' => $menuProducts,
            'sosmed' => $sosmed,
        ]);
    }

    public function sosmedUpdate(Request $request, Sosmed $sosmed)
    {
        $request->validate([
            'instagram' => 'nullable',
            'youtube'   => 'nullable',
            'tiktok'    => 'nullable',
            'linkedin'  => 'nullable',
            'x'         => 'nullable',
        ]);

        $sosmed->update([
            'instagram' => $request->instagram,
            'youtube'   => $request->youtube,
            'tiktok'    => $request->tiktok,
            'linkedin'  => $request->linkedin,
            'x'         => $request->x,
        ]);

        return redirect()->route('admin.pages.letstudy.sosmed.index');
    }
}
