<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Education;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function admin()
    {
        $menuProducts = Product::with('subProducts')->get();

        $admin = User::where('role', 'Admin')
            ->when(request()->q, function ($admin) {
                $admin = $admin->where('name', 'like', '%' . request()->q . '%');
            })->latest()->paginate(10);

        $admin->appends(['q' => request()->q]);

        $provinces = Province::all();
        $cities = City::all();
        $educations = Education::all();

        return inertia('Admin/Managements/Admin/Index', [
            'menuProducts' => $menuProducts,
            'admins' => $admin,
            'provinces' => $provinces,
            'cities' => $cities,
            'educations' => $educations,
        ]);
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'gender'        => 'required|string',
            'province_id'   => 'nullable',
            'city_id'       => 'nullable',
            'birth_date'    => 'nullable',
            'education'     => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required|confirmed|min:8',
        ], [
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'email.unique' => 'Email ini sudah digunakan, silakan pakai email lain.',
            'password.required' => 'Kata sandi tidak boleh kosong.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'        => 'Kata sandi minimal 8 karakter.',
        ]);

        User::create([
            'name'          => $request->name,
            'role'          => 'Admin',
            'gender'        => $request->gender,
            'province_id'   => $request->province_id,
            'city_id'       => $request->city_id,
            'birth_date'    => $request->birth_date,
            'education'     => $request->education,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('admin.managements.admin.index');
    }

    public function adminUpdate(Request $request, User $admin)
    {
        $request->validate([
            'name'          => 'required|string',
            'gender'        => 'required|string',
            'province_id'   => 'nullable',
            'city_id'       => 'nullable',
            'birth_date'    => 'nullable',
            'education'     => 'required',
            'email'         => 'required|unique:users,email,' . $admin->id,
            'password'      => 'nullable|confirmed|min:8',
        ], [
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'email.unique' => 'Email ini sudah digunakan, silakan pakai email lain.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'        => 'Kata sandi minimal 8 karakter.',
        ]);

        $data = [
            'name'          => $request->name,
            'role'          => 'Admin',
            'gender'        => $request->gender,
            'province_id'   => $request->province_id,
            'city_id'       => $request->city_id,
            'birth_date'    => $request->birth_date,
            'education'     => $request->education,
            'email'         => $request->email,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.managements.admin.index');
    }

    public function adminDestroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.managements.admin.index');
    }
}
