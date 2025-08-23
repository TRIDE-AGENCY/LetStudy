<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Product;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function faqs()
    {
        $menuProducts = Product::with('subProducts')->get();

        $faqs = Faq::when(request()->q, function ($faqs) {
            $faqs = $faqs->where('question', 'like', '%' . request()->q . '%');
        })->orderByDesc('is_featured')->latest()->paginate(10);

        $faqs->appends(['q' => request()->q]);

        return inertia('Admin/Pages/LetStudy/Faqs/Index', [
            'menuProducts' => $menuProducts,
            'faqs' => $faqs,
        ]);
    }

    public function faqCreate()
    {
        $menuProducts = Product::with('subProducts')->get();
        $products = Product::all();

        return inertia('Admin/Pages/LetStudy/Faqs/Create', [
            'menuProducts' => $menuProducts,
            'products' => $products,
        ]);
    }

    public function faqStore(Request $request)
    {
        $request->validate([
            'question'    => 'required|unique:faqs,question',
            'answer'      => 'required',
            'category'    => 'required',
            'status'      => 'required',
            'is_featured' => 'required',
        ], [
            'question.unique'  => 'Pertanyaan sudah digunakan. Gunakan pertanyaan lain.',
            'answer.required'  => 'Jawaban tidak boleh kosong.',
            'status.required'  => 'Status tidak boleh kosong.',
        ]);

        Faq::create([
            'question'    => $request->question,
            'answer'      => $request->answer,
            'category'    => $request->category,
            'status'      => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->route('admin.pages.letstudy.faqs.index');
    }

    public function faqEdit($id)
    {
        $menuProducts = Product::with('subProducts')->get();
        $faq = Faq::findOrFail($id);
        $products = Product::all();

        return inertia('Admin/Pages/LetStudy/Faqs/Edit', [
            'menuProducts' => $menuProducts,
            'faq' => $faq,
            'products' => $products,
        ]);
    }

    public function faqUpdate(Request $request, Faq $faq)
    {
        $request->validate([
            'question'    => 'required|unique:faqs,question,' . $faq->id,
            'answer'      => 'required',
            'category'    => 'required',
            'status'      => 'required',
            'is_featured' => 'required',
        ], [
            'question.unique' => 'Pertanyaan sudah digunakan. Gunakan pertanyaan lain.',
            'answer.required' => 'Jawaban tidak boleh kosong.',
            'status.required' => 'Status tidak boleh kosong.',
        ]);

        $faq->update([
            'question'    => $request->question,
            'answer'      => $request->answer,
            'category'    => $request->category,
            'status'      => $request->status,
            'is_featured' => $request->is_featured,
        ]);

        return redirect()->route('admin.pages.letstudy.faqs.index');
    }

    public function faqDestroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.pages.letstudy.faqs.index');
    }
}
