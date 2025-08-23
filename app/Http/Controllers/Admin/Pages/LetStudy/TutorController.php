<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\Product;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorController extends Controller
{
    public function tutors()
    {
        $menuProducts = Product::with('subProducts')->get();

        $tutors = Tutor::when(request()->q, function ($tutors) {
            $tutors = $tutors->where('name', 'like', '%' . request()->q . '%');
        })->with('ebook')->latest()->paginate(10);

        $tutors->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Tutors/Index', [
            'menuProducts' => $menuProducts,
            'tutors' => $tutors,
        ]);
    }

    public function tutorCreate()
    {
        $menuProducts = Product::with('subProducts')->get();
        $ebooks = Ebook::all();

        return inertia('Admin/Pages/LetStudy/Tutors/Create', [
            'menuProducts' => $menuProducts,
            'ebooks' => $ebooks,
        ]);
    }

    public function tutorStore(Request $request)
    {
        $request->validate([
            'ebook_id'       => 'required',
            'name'           => 'required',
            'title'          => 'required',
            'education'      => 'required',
            'photo'          => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'achievement'    => 'required',
        ], [
            'photo.required' => 'Foto profil tidak boleh kosong.',
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
            'achievement.required' => 'Pencapaian tidak boleh kosong.',
        ]);

        $path_photo = $request->file('photo')->store('tutors', 'public');

        Tutor::create([
            'ebook_id'       => $request->ebook_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'education'      => $request->education,
            'photo'          => $path_photo,
            'achievement'    => $request->achievement,
        ]);

        return redirect()->route('admin.pages.letstudy.tutors.index');
    }

    public function tutorEdit($id)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tutor = Tutor::findOrFail($id);
        $tutor->photo_name = basename($tutor->photo);
        $tutor->photo_size = Storage::disk('public')->size($tutor->photo);
        $ebooks = Ebook::all();

        return inertia('Admin/Pages/LetStudy/Tutors/Edit', [
            'menuProducts' => $menuProducts,
            'tutor' => $tutor,
            'ebooks' => $ebooks,
        ]);
    }

    public function tutorUpdate(Request $request, Tutor $tutor)
    {
        $request->validate([
            'ebook_id'       => 'required',
            'name'           => 'required',
            'title'          => 'required',
            'education'      => 'required',
            'photo'          => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'achievement'    => 'required',
        ], [
            'photo.image'    => 'Foto profil harus berupa file gambar.',
            'photo.mimes'    => 'Foto profil harus berekstensi jpg, jpeg, atau png.',
            'photo.max'      => 'Ukuran foto profil maksimal 10MB.',
            'achievement.required' => 'Pencapaian tidak boleh kosong.',
        ]);

        $path_photo = $tutor->photo;
        if ($request->hasFile('photo')) {
            if ($path_photo && Storage::disk('public')->exists($path_photo)) {
                Storage::disk('public')->delete($path_photo);
            }

            $path_photo = $request->file('photo')->store('tutors', 'public');
        }

        $tutor->update([
            'ebook_id'       => $request->ebook_id,
            'name'           => $request->name,
            'title'          => $request->title,
            'education'      => $request->education,
            'photo'          => $path_photo,
            'achievement'    => $request->achievement,
        ]);

        return redirect()->route('admin.pages.letstudy.tutors.index');
    }

    public function tutorDestroy($id)
    {
        $tutor = Tutor::findOrFail($id);

        if ($tutor->photo && Storage::disk('public')->exists($tutor->photo)) {
            Storage::disk('public')->delete($tutor->photo);
        }

        $tutor->delete();

        return redirect()->route('admin.pages.letstudy.tutors.index');
    }
}
