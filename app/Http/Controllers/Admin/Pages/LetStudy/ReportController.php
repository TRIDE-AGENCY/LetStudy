<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function report()
    {
        $menuProducts = Product::with('subProducts')->get();

        $report = Report::find(1);
        $report->image_name = $report && $report->image
            ? basename($report->image)
            : null;
        $report->image_size = $report && $report->image && Storage::disk('public')->exists($report->image)
            ? Storage::disk('public')->size($report->image)
            : null;

        return inertia('Admin/Pages/LetStudy/Report/Index', [
            'menuProducts' => $menuProducts,
            'report' => $report,
        ]);
    }

    public function reportUpdate(Request $request, Report $report)
    {
        $request->validate([
            'heading'     => 'required',
            'sub_heading' => 'required',
            'id_report'   => 'required',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'image.image' => 'Gambar harus berupa file gambar.',
            'image.mimes' => 'Gambar harus berekstensi jpg, jpeg, atau png.',
            'image.max'   => 'Ukuran gambar maksimal 10MB.',
        ]);

        $path_image = $report->image;
        if ($request->hasFile('image')) {
            if ($path_image && Storage::disk('public')->exists($path_image)) {
                Storage::disk('public')->delete($path_image);
            }

            $path_image = $request->file('image')->store('reports', 'public');
        }

        $report->update([
            'heading'     => $request->heading,
            'sub_heading' => $request->sub_heading,
            'id_report'   => $request->id_report,
            'image'       => $path_image,
        ]);

        return redirect()->route('admin.pages.letstudy.report.index');
    }
}
