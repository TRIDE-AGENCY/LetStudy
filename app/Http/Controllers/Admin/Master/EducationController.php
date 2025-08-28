<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Product;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function educations()
    {
        $menuProducts = Product::with('subProducts')->get();

        $educations = Education::when(request()->q, function ($educations) {
            $educations = $educations->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $educations->appends(['q' => request()->q]);

        return inertia('Admin/Masters/Educations/Index', [
            'menuProducts' => $menuProducts,
            'educations' => $educations,
        ]);
    }

    public function educationStore(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'names' => 'required|array',
            'names.*' => 'string|max:255'
        ], [
            'type.required'  => 'Tipe tidak boleh kosong.',
        ]);

        foreach ($request->names as $name) {
            Education::create([
                'type' => $request->type,
                'name' => $name,
            ]);
        }

        return redirect()->route('admin.masters.educations.index');
    }

    public function educationUpdate(Request $request, Education $education)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
        ], [
            'type.required'  => 'Tipe tidak boleh kosong.',
        ]);

        $education->update([
            'type' => $request->type,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.masters.educations.index');
    }

    public function educationDestroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.masters.educations.index');
    }
}
