<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Tryout;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TryoutController extends Controller
{
    public function tryouts(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tryouts = Tryout::where('sub_product_id', $subProduct->id)
            ->with('subProduct')
            ->latest()
            ->paginate(10);

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
        ], [
            'title.unique'   => 'Nama tryout sudah digunakan. Gunakan nama lain.',
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
        ]);

        return redirect()->route('admin.members.tryouts.index', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
        ]);
    }

    public function tryoutShow(Product $product, SubProduct $subProduct, Tryout $tryout)
    {
        $menuProducts = Product::with('subProducts')->get();
        $tryout = Tryout::findOrFail($tryout->id);
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
        ], [
            'title.unique'   => 'Nama tryout sudah digunakan. Gunakan nama lain.',
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
            'question_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            'option_5'          => 'required',
            'answer'            => 'required',
            'explanation'       => 'nullable',
            'explanation_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'answer.required'         => 'Silahkan pilih jawaban benar.',
            'question_image.image'    => 'Gambar pertanyaan harus berupa file gambar.',
            'question_image.mimes'    => 'Gambar pertanyaan harus berekstensi jpg, jpeg, atau png.',
            'question_image.max'      => 'Ukuran gambar pertanyaan maksimal 10MB.',
            'explanation_image.image' => 'Gambar pembahasan harus berupa file gambar.',
            'explanation_image.mimes' => 'Gambar pembahasan harus berekstensi jpg, jpeg, atau png.',
            'explanation_image.max'   => 'Ukuran gambar pembahasan maksimal 10MB.',
        ]);

        $path_question_image = $request->hasFile('question_image')
            ? $request->file('question_image')->store('questions', 'public')
            : null;
        $path_explanation_image = $request->hasFile('explanation_image')
            ? $request->file('explanation_image')->store('questions', 'public')
            : null;

        Question::create([
            'tryout_id'         => $tryout->id,
            'question'          => $request->question,
            'question_image'    => $path_question_image,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
            'explanation'       => $request->explanation,
            'explanation_image' => $path_explanation_image,
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
        $question->question_image_name = $question->question_image ? basename($question->question_image) : null;
        $question->question_image_size = $question->question_image ? Storage::disk('public')->size($question->question_image) : null;
        $question->explanation_image_name = $question->explanation_image ? basename($question->explanation_image) : null;
        $question->explanation_image_size = $question->explanation_image ? Storage::disk('public')->size($question->explanation_image) : null;

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
            'question_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'option_1'          => 'required',
            'option_2'          => 'required',
            'option_3'          => 'required',
            'option_4'          => 'required',
            'option_5'          => 'required',
            'answer'            => 'required',
            'explanation'       => 'nullable',
            'explanation_image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ], [
            'answer.required'         => 'Silahkan pilih jawaban benar.',
            'question_image.image'    => 'Gambar pertanyaan harus berupa file gambar.',
            'question_image.mimes'    => 'Gambar pertanyaan harus berekstensi jpg, jpeg, atau png.',
            'question_image.max'      => 'Ukuran gambar pertanyaan maksimal 10MB.',
            'explanation_image.image' => 'Gambar pembahasan harus berupa file gambar.',
            'explanation_image.mimes' => 'Gambar pembahasan harus berekstensi jpg, jpeg, atau png.',
            'explanation_image.max'   => 'Ukuran gambar pembahasan maksimal 10MB.',
        ]);

        $path_question_image = $request->hasFile('question_image')
            ? $request->file('question_image')->store('questions', 'public')
            : $question->question_image;
        $path_explanation_image = $request->hasFile('explanation_image')
            ? $request->file('explanation_image')->store('questions', 'public')
            : $question->explanation_image;

        $question->update([
            'question'          => $request->question,
            'question_image'    => $path_question_image,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'option_5'          => $request->option_5,
            'answer'            => $request->answer,
            'explanation'       => $request->explanation,
            'explanation_image' => $path_explanation_image,
        ]);

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }

    public function tryoutDestroyQuestion(Product $product, SubProduct $subProduct, Tryout $tryout, Question $question)
    {
        if ($question->question_image && Storage::disk('public')->exists($question->question_image)) {
            Storage::disk('public')->delete($question->question_image);
        }

        if ($question->explanation_image && Storage::disk('public')->exists($question->explanation_image)) {
            Storage::disk('public')->delete($question->explanation_image);
        }

        $question->delete();

        return redirect()->route('admin.members.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'tryout' => $tryout->slug,
        ]);
    }
}
