<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDetail()
    {
        $products = Product::with('subProducts')->get();

        $userId = auth()->guard('web')->user()->id;
        $user = User::find($userId);
        $educations = Education::all();

        return inertia('Admin/User/Index', [
            'menuProducts' => $products,
            'user' => $user,
            'educations' => $educations,
        ]);
    }

    public function userDetailUpdate(Request $request, User $user)
    {
        $user = auth()->guard('web')->user();
        $request->validate([
            'name'             => 'required|string',
            'gender'           => 'required|string',
            'birth_place'      => 'nullable',
            'birth_date'       => 'nullable',
            'education'        => 'required',
            'email'            => 'required|unique:users,email,' . $user->id,
            'current_password' => 'required_with:password',
            'password'         => 'nullable|confirmed',
        ], [
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'email.unique' => 'Email ini sudah digunakan, silakan pakai email lain.',
            'current_password.required_with' => 'Kata sandi lama wajib diisi jika ingin mengganti kata sandi baru.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi lama tidak sesuai.'])->withInput();
            }
        }

        $data = [
            'name'          => $request->name,
            'role'          => 'Admin',
            'gender'        => $request->gender,
            'birth_place'   => $request->birth_place,
            'birth_date'    => $request->birth_date,
            'education'     => $request->education,
            'email'         => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user');
    }
}
