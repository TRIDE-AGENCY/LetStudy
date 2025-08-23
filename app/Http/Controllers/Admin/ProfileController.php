<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $menuProducts = Product::with('subProducts')->get();

        $profile = Profile::find(1);

        return inertia('Admin/Profile/Index', [
            'menuProducts' => $menuProducts,
            'profile' => $profile,
        ]);
    }

    public function profileUpdate(Request $request, Profile $profile)
    {
        $request->validate([
            'about'     => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'community' => 'required',
        ]);

        $profile->update([
            'about'     => $request->about,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'community' => $request->community,
        ]);

        return redirect()->route('admin.profile');
    }
}
