<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function teams()
    {
        $menuProducts = Product::with('subProducts')->get();

        $teams = Team::when(request()->q, function ($teams) {
            $teams = $teams->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $teams->appends(['q' => request()->q]);

        return inertia('Admin/Teams/Index', [
            'menuProducts' => $menuProducts,
            'teams' => $teams,
        ]);
    }

    public function teamStore(Request $request)
    {
        $request->validate([
            'photo'         => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'name'          => 'required|string',
            'department'    => 'required|string',
            'status'        => 'nullable|string',
            'position'      => 'required|string',
            'bio'           => 'required|string',
            'quote'         => 'nullable',
            'email'         => 'nullable',
            'linkedin'      => 'nullable',
            'instagram'     => 'nullable',
            'tiktok'        => 'nullable',
            'x'             => 'nullable',
        ], [
            'photo.required' => 'Foto profil tidak boleh kosong.',
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
        ]);

        $path_photo = $request->file('photo')->store('teams', 'public');

        Team::create([
            'photo'         => $path_photo,
            'name'          => $request->name,
            'department'    => $request->department,
            'status'        => $request->status,
            'position'      => $request->position,
            'bio'           => $request->bio,
            'quote'         => $request->quote,
            'email'         => $request->email,
            'linkedin'      => $request->linkedin,
            'instagram'     => $request->instagram,
            'tiktok'        => $request->tiktok,
            'x'             => $request->x,
        ]);

        return redirect()->route('admin.teams.index');
    }

    public function teamUpdate(Request $request, Team $team)
    {
        $request->validate([
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'name'          => 'required|string',
            'department'    => 'required|string',
            'status'        => 'nullable|string',
            'position'      => 'required|string',
            'bio'           => 'required|string',
            'quote'         => 'nullable',
            'email'         => 'nullable',
            'linkedin'      => 'nullable',
            'instagram'     => 'nullable',
            'tiktok'        => 'nullable',
            'x'             => 'nullable',
        ], [
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
        ]);

        $path_photo = $team->photo;
        if ($request->hasFile('photo')) {
            if ($path_photo && Storage::disk('public')->exists($path_photo)) {
                Storage::disk('public')->delete($path_photo);
            }

            $path_photo = $request->file('photo')->store('teams', 'public');
        }

        $team->update([
            'photo'         => $path_photo,
            'name'          => $request->name,
            'department'    => $request->department,
            'status'        => $request->status,
            'position'      => $request->position,
            'bio'           => $request->bio,
            'quote'         => $request->quote,
            'email'         => $request->email,
            'linkedin'      => $request->linkedin,
            'instagram'     => $request->instagram,
            'tiktok'        => $request->tiktok,
            'x'             => $request->x,
        ]);

        return redirect()->route('admin.teams.index');
    }

    public function teamDestroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->photo && Storage::disk('public')->exists($team->photo)) {
            Storage::disk('public')->delete($team->photo);
        }

        $team->delete();

        return redirect()->route('admin.teams.index');
    }
}
