<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function tinymce(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:10240',
        ], [
            'file.required' => 'File gambar wajib diunggah.',
            'file.image'    => 'File harus berupa gambar.',
            'file.mimes'    => 'Format gambar harus jpg, jpeg, png, webp, atau gif.',
            'file.max'      => 'Ukuran gambar maksimal 10MB.',
        ]);

        $path = $request->file('file')->store('blogs/content', 'public');

        return response()->json([
            'location' => asset('storage/' . $path),
        ]);
    }
}
