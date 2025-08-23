<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Donate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateController extends Controller
{
    public function donate()
    {
        $menuProducts = Product::with('subProducts')->get();

        $donate = Donate::find(1);
        $donate->qrcode_image_name = $donate && $donate->qrcode_image
            ? basename($donate->qrcode_image)
            : null;
        $donate->qrcode_image_size = $donate && $donate->qrcode_image && Storage::disk('public')->exists($donate->qrcode_image)
            ? Storage::disk('public')->size($donate->qrcode_image)
            : null;

        $achievements = Achievement::all();

        return inertia('Admin/Pages/LetStudy/Donate/Index', [
            'menuProducts' => $menuProducts,
            'donate' => $donate,
            'achievements' => $achievements,
        ]);
    }

    public function donateUpdate(Request $request, Donate $donate)
    {
        $request->validate([
            'achievement1_id' => 'nullable|exists:achievements,id',
            'achievement2_id' => 'nullable|exists:achievements,id',
            'achievement3_id' => 'nullable|exists:achievements,id',
            'bank_name'    => 'required',
            'bank_account' => 'required',
            'bank_number'  => 'required',
            'qrcode_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'qrcode_name'  => 'required',
            'qrcode_nmid'  => 'required',
        ], [
            'qrcode_image.image' => 'QR Code harus berupa file gambar.',
            'qrcode_image.mimes' => 'QR Code harus berekstensi jpg, jpeg, atau png.',
            'qrcode_image.max'   => 'Ukuran QR Code maksimal 10MB.',
        ]);

        $path_qrcode_image = $donate->qrcode_image;
        if ($request->hasFile('qrcode_image')) {
            if ($path_qrcode_image && Storage::disk('public')->exists($path_qrcode_image)) {
                Storage::disk('public')->delete($path_qrcode_image);
            }

            $path_qrcode_image = $request->file('qrcode_image')->store('donates', 'public');
        }

        $donate->update([
            'achievement1_id'      => $request->achievement1_id,
            'achievement2_id'      => $request->achievement2_id,
            'achievement3_id'      => $request->achievement3_id,
            'bank_name'    => $request->bank_name,
            'bank_account' => $request->bank_account,
            'bank_number'  => $request->bank_number,
            'qrcode_image' => $path_qrcode_image,
            'qrcode_name'  => $request->qrcode_name,
            'qrcode_nmid'  => $request->qrcode_nmid,
        ]);

        return redirect()->route('admin.pages.letstudy.donate.index');
    }
}
