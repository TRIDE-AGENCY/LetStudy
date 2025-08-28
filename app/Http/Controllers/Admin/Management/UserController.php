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

class UserController extends Controller
{
    public function user()
    {
        $menuProducts = Product::with('subProducts')->get();

        $user = User::where('role', 'User')
            ->when(request()->q, function ($user) {
                $user = $user->where('name', 'like', '%' . request()->q . '%');
            })->latest()->paginate(10);

        $user->appends(['q' => request()->q]);

        $provinces = Province::all();
        $cities = City::all();
        $educations = Education::all();

        return inertia('Admin/Managements/User/Index', [
            'menuProducts' => $menuProducts,
            'users' => $user,
            'provinces' => $provinces,
            'cities' => $cities,
            'educations' => $educations,
        ]);
    }

    public function userStore(Request $request)
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
            'role'          => 'User',
            'gender'        => $request->gender,
            'province_id'   => $request->province_id,
            'city_id'       => $request->city_id,
            'birth_date'    => $request->birth_date,
            'education'     => $request->education,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        return redirect()->route('admin.managements.user.index');
    }

    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|string',
            'gender'        => 'required|string',
            'province_id'   => 'nullable',
            'city_id'       => 'nullable',
            'birth_date'    => 'nullable',
            'education'     => 'required',
            'email'         => 'required|unique:users,email,' . $user->id,
            'password'      => 'nullable|confirmed|min:8',
        ], [
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'email.unique' => 'Email ini sudah digunakan, silakan pakai email lain.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min'        => 'Kata sandi minimal 8 karakter.',
        ]);

        $data = [
            'name'          => $request->name,
            'role'          => 'User',
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

        $user->update($data);

        return redirect()->route('admin.managements.user.index');
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.managements.user.index');
    }
}
