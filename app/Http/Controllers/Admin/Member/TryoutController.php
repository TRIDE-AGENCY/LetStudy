<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Tryout;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Question;
use App\Models\TryoutGroup;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TryoutController extends Controller
{
    public function tryouts(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tryouts = Tryout::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->with('questions')
            ->latest()
            ->paginate(100);

        return inertia('Admin/Members/Tryouts/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryouts' => $tryouts,
        ]);
    }

    public function tryoutCreate(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Tryouts/Create', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
        ]);
    }

    public function tryoutStore(Request $request, Product $product, SubProduct $subProduct)
    {
        $request->validate([
            'title'       => 'required|unique:tryouts,title',
            'description' => 'nullable',
            'instruction' => 'nullable',
            'duration'    => 'required',
            'start_time'  => 'nullable',
            'end_time'    => 'nullable',
            'is_random_question'  => 'required',
            'is_random_answer'    => 'required',
            'is_show_answer'      => 'required',
            'is_show_explanation' => 'required',
            'is_show_rank'        => 'required',
            'status'      => 'required',
        ], [
            'title.unique'   => 'Nama tryout sudah digunakan. Gunakan nama lain.',
            'status.required'  => 'Status tidak boleh kosong.',
        ]);

        Tryout::create([
            'sub_product_id' => $subProduct->id,
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'description'    => $request->description,
            'instruction'    => $request->instruction,
            'duration'       => $request->duration,
            'start_time'     => $request->start_time ? date('Y-m-d H:i:s', strtotime($request->start_time)) : null,
            'end_time'       => $request->end_time ? date('Y-m-d H:i:s', strtotime($request->end_time)) : null,
            'is_random_question'  => $request->is_random_question,
            'is_random_answer'    => $request->is_random_answer,
            'is_show_answer'      => $request->is_show_answer,
            'is_show_explanation' => $request->is_show_explanation,
            'is_show_rank'        => $request->is_show_rank,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.members.tryouts.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function tryoutShow(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tryout = Tryout::withCount([
            'grades as finished_grades_count' => function ($q) {
                $q->whereNotNull('end_time');
            }
        ])->findOrFail($tryout->id);
        $questions = $tryout->questions()
            ->when(request()->q, function ($query) {
                $query->where('question', 'like', '%' . request()->q . '%');
            })
            ->latest()
            ->paginate(10);
        $questions->appends(['q' => request()->q]);
        $tryout->setRelation('questions', $questions);

        return inertia('Admin/Members/Tryouts/Show', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryout' => $tryout,
        ]);
    }

    public function tryoutResult(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $menuProducts = Product::with('subProducts')->get();

        $grade = Grade::where('tryout_id', $tryout->id)
            ->with('user')
            ->whereNotNull('end_time')
            ->orderByDesc('grade')
            ->get();

        $allGradesWithRank = $grade->values()->map(function ($item, $index) {
            $item->ranking = $index + 1;
            return $item;
        });

        if (request()->filled('q')) {
            $query = strtolower(request()->q);
            $allGradesWithRank = $allGradesWithRank->filter(function ($item) use ($query) {
                return $item->user && str_contains(strtolower($item->user->name), $query);
            })->values();
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = $allGradesWithRank->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $allGradesPaginated = new LengthAwarePaginator($currentItems, $allGradesWithRank->count(), $perPage, $currentPage);
        $allGradesPaginated->withPath(url()->current())->appends(['q' => request()->q]);

        return inertia('Admin/Members/Tryouts/Result', [
            'menuProducts' => $menuProducts,
            'product'      => $product,
            'subProduct'   => $subProduct,
            'tryout'       => $tryout,
            'all_grades'   => $allGradesPaginated,
        ]);
    }

    public function tryoutEdit(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Tryouts/Edit', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryout' => $tryout,
        ]);
    }

    public function tryoutUpdate(Request $request, Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $request->validate([
            'title'       => 'required|unique:tryouts,title,' . $tryout->id,
            'description' => 'nullable',
            'instruction' => 'nullable',
            'duration'    => 'required',
            'start_time'  => 'nullable',
            'end_time'    => 'nullable',
            'is_random_question'  => 'required',
            'is_random_answer'    => 'required',
            'is_show_answer'      => 'required',
            'is_show_explanation' => 'required',
            'is_show_rank'        => 'required',
            'status'      => 'required',
        ], [
            'title.unique'   => 'Nama tryout sudah digunakan. Gunakan nama lain.',
            'status.required'  => 'Status tidak boleh kosong.',
        ]);

        $tryout->update([
            'title'          => $request->title,
            'slug'           => Str::slug($request->title),
            'description'    => $request->description,
            'instruction'    => $request->instruction,
            'duration'       => $request->duration,
            'start_time'     => $request->start_time ? date('Y-m-d H:i:s', strtotime($request->start_time)) : null,
            'end_time'       => $request->end_time ? date('Y-m-d H:i:s', strtotime($request->end_time)) : null,
            'is_random_question'  => $request->is_random_question,
            'is_random_answer'    => $request->is_random_answer,
            'is_show_answer'      => $request->is_show_answer,
            'is_show_explanation' => $request->is_show_explanation,
            'is_show_rank'        => $request->is_show_rank,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }

    public function tryoutDestroy(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $tryout->delete();

        return redirect()->route('admin.members.tryouts.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function tryoutCreateQuestion(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Tryouts/Questions/Create', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryout' => $tryout,
        ]);
    }

    public function tryoutStoreQuestion(Request $request, Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $request->validate([
            'question'          => 'required',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            'option_5'          => 'required',
            'answer'            => 'required',
            'explanation'       => 'nullable',
        ], [
            'answer.required'         => 'Silahkan pilih jawaban benar.',
        ]);

        Question::create([
            'tryout_id'         => $tryout->id,
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
            'explanation'       => $request->explanation,
        ]);

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }

    public function tryoutEditQuestion(Product $product, SubProduct $subProduct, Tryout $tryout, Question $question)
    {
        $menuProducts = Product::with('subProducts')->get();

        return inertia('Admin/Members/Tryouts/Questions/Edit', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryout' => $tryout,
            'question' => $question,
        ]);
    }

    public function tryoutUpdateQuestion(Request $request, Product $product, SubProduct $subProduct, Tryout $tryout, Question $question)
    {
        $request->validate([
            'question'          => 'required',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            'option_5'          => 'required',
            'answer'            => 'required',
            'explanation'       => 'nullable',
        ], [
            'answer.required'         => 'Silahkan pilih jawaban benar.',
        ]);

        $question->update([
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
            'explanation'       => $request->explanation,
        ]);

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }

    public function tryoutDestroyQuestion(Product $product, SubProduct $subProduct, Tryout $tryout, Question $question)
    {
        $question->delete();

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }
}
