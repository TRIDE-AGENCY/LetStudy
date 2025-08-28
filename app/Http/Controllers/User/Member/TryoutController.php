<?php

namespace App\Http\Controllers\User\Member;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Grade;
use App\Models\Product;
use App\Models\Question;
use App\Models\SubProduct;
use App\Models\Tryout;
use App\Models\TryoutGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TryoutController extends Controller
{
    public function tryouts(Product $product, SubProduct $subProduct)
    {
        $menuProducts = Product::with('subProducts')->get();

        $tryouts = Tryout::where('sub_product_id', $subProduct->id)
            ->whereHas('questions')
            ->with(['subProduct', 'questions'])
            ->where('status', 'published')
            ->latest()
            ->get();

        $data = [];

        foreach ($tryouts as $tryout) {

            $tryout_group = TryoutGroup::where('tryout_id', $tryout->id)
                ->where('user_id', auth()->guard('web')->user()->id)
                ->first();

            $grade = Grade::firstOrCreate(
                [
                    'tryout_id' => $tryout->id,
                    'user_id'   => auth()->guard('web')->user()->id
                ],
                [
                    'duration'      => $tryout->duration * 60000,
                    'total_correct' => 0,
                    'grade'         => 0,
                ]
            );

            $data[] = [
                'tryout' => $tryout,
                'grade'  => $grade,
                'tryout_group' => $tryout_group
            ];
        }

        return inertia('User/Members/Tryouts/Index', [
            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
            'tryouts' => $data,
        ]);
    }

    public function tryoutJoin(Request $request, Product $product, SubProduct $subProduct)
    {
        $request->validate([
            'tryout_id' => 'required',
        ]);

        $user_id = auth()->guard('web')->user()->id;

        $tryout = Tryout::where('id', $request->tryout_id)
            ->first();

        $tryout_group = TryoutGroup::firstOrCreate(
            [
                'tryout_id' => $tryout->id,
                'user_id' => $user_id,
            ]
        );

        return redirect()->route('member.tryouts.start', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'id' => $tryout_group->id
        ]);
    }

    public function tryoutStart(Product $product, SubProduct $subProduct, $id)
    {
        $tryout_group = TryoutGroup::with('tryout', 'user')
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('id', $id)
            ->first();

        if (!$tryout_group) {
            return redirect()->route('member.tryouts.index');
        }

        if (Carbon::now()->gt(Carbon::parse($tryout_group->tryout->end_time))) {
            return redirect()->route('member.tryouts.index');
        }

        $grade = Grade::where('tryout_id', $tryout_group->tryout->id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->first();

        $grade->start_time = Carbon::now();
        $grade->update();

        if ($tryout_group->tryout->is_random_question === 1) {
            $questions = Question::where('tryout_id', $tryout_group->tryout->id)->inRandomOrder()->get();
        } else {
            $questions = Question::where('tryout_id', $tryout_group->tryout->id)->get();
        }

        $question_order = 1;

        foreach ($questions as $question) {
            $options = [1, 2];
            if (!empty($question->option_3)) $options[] = 3;
            if (!empty($question->option_4)) $options[] = 4;
            if (!empty($question->option_5)) $options[] = 5;

            if ($tryout_group->tryout->is_random_answer === 1) {
                shuffle($options);
            }

            $answer = Answer::where('user_id', auth()->guard('web')->user()->id)
                ->where('tryout_id', $tryout_group->tryout->id)
                ->where('question_id', $question->id)
                ->first();

            if ($answer) {
                $answer->question_order = $question_order;
                $answer->update();
            } else {
                Answer::create([
                    'tryout_id'         => $tryout_group->tryout->id,
                    'question_id'       => $question->id,
                    'user_id'        => auth()->guard('web')->user()->id,
                    'question_order'    => $question_order,
                    'answer_order'      => implode(",", $options),
                    'answer'            => 0,
                    'is_correct'        => 'N',
                    'flag'              => 'N'
                ]);
            }
            $question_order++;
        }

        return redirect()->route('member.tryouts.show', [
            'product' => $product->slug,
            'subProduct' => $subProduct->slug,
            'id'    => $tryout_group->id,
            'page'  => 1
        ]);
    }

    public function tryoutShow(Product $product, SubProduct $subProduct, $id, $page)
    {
        $menuProducts = Product::with('subProducts')->get();

        $tryout_group = TryoutGroup::with('tryout', 'user')
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('id', $id)
            ->first();

        if (!$tryout_group) {
            return redirect()->route('member.tryouts.index');
        }

        if (Carbon::now()->gt(Carbon::parse($tryout_group->tryout->end_time))) {
            return redirect()->route('member.tryouts.index');
        }

        $grade = Grade::where('tryout_id', $tryout_group->tryout->id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->first();

        if ($grade && $grade->end_time !== null) {
            return redirect()->route(
                'member.tryouts.result',
                [
                    'product' => $product->slug,
                    'subProduct' => $subProduct->slug,
                    $tryout_group->id
                ]
            );
        }

        $all_questions = Answer::with('question')
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('tryout_id', $tryout_group->tryout->id)
            ->orderBy('question_order', 'ASC')
            ->get();

        $question_answered = Answer::with('question')
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('tryout_id', $tryout_group->tryout->id)
            ->where('answer', '!=', 0)
            ->count();

        $question_active = Answer::with('question.tryout')
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('tryout_id', $tryout_group->tryout->id)
            ->where('question_order', $page)
            ->first();

        if ($question_active) {
            $answer_order = explode(",", $question_active->answer_order);
        } else {
            $answer_order = [];
        }

        return inertia('User/Members/Tryouts/Show', [
            'id'                => (int) $id,
            'page'              => (int) $page,
            'tryout_group'      => $tryout_group,
            'all_questions'     => $all_questions,
            'question_answered' => $question_answered,
            'question_active'   => $question_active,
            'answer_order'      => $answer_order,
            'grade' => [
                'start_time' => $grade ? \Carbon\Carbon::parse($grade->start_time)->toISOString() : null,
            ],
            'server_now'        => Carbon::now()->toISOString(),

            'menuProducts' => $menuProducts,
            'product' => $product,
            'subProduct' => $subProduct,
        ]);
    }

    public function tryoutAnswer(Request $request)
    {
        $question = Question::find($request->question_id);

        if ($question->answer == $request->answer) {
            $result = 'Y';
        } else {
            $result = 'N';
        }

        $answer = Answer::where('tryout_id', $request->tryout_id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($answer) {
            $answer->answer     = $request->answer;
            $answer->is_correct = $result;
            $answer->update();
        }

        return redirect()->back();
    }

    public function tryoutClear(Request $request)
    {
        $answer = Answer::where('tryout_id', $request->tryout_id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($answer) {
            $answer->answer = 0;
            $answer->is_correct = 'N';
            $answer->flag = 'N';
            $answer->update();
        }

        return redirect()->back();
    }

    public function tryoutFlag(Request $request)
    {
        $answer = Answer::where('user_id', auth()->guard('web')->user()->id)
            ->where('tryout_id', $request->tryout_id)
            ->where('question_id', $request->question_id)
            ->first();

        if ($answer) {
            $answer->flag = $answer->flag === 'Y' ? 'N' : 'Y';
            $answer->update();
        }

        return redirect()->back();
    }

    public function tryoutEnd(Request $request, Product $product, SubProduct $subProduct)
    {
        $count_correct_answer = Answer::where('tryout_id', $request->tryout_id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->where('is_correct', 'Y')
            ->count();

        $count_question = Question::where('tryout_id', $request->tryout_id)->count();

        $grade_tryout = round($count_correct_answer / $count_question * 100, 2);

        $grade = Grade::where('tryout_id', $request->tryout_id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->first();

        $grade->end_time        = Carbon::now();
        $grade->total_correct   = $count_correct_answer;
        $grade->grade           = $grade_tryout;
        $grade->update();

        return redirect()->route(
            'member.tryouts.result',
            [
                'product' => $product->slug,
                'subProduct' => $subProduct->slug,
                $request->tryout_group_id
            ]
        );
    }

    public function tryoutResult(Product $product, SubProduct $subProduct, $tryout_group_id)
    {
        $menuProducts = Product::with('subProducts')->get();

        $userId = auth()->guard('web')->user()->id;

        $tryout_group = TryoutGroup::with('tryout.questions', 'user')
            ->where('user_id', $userId)
            ->where('id', $tryout_group_id)
            ->firstOrFail();

        $grade = Grade::where('tryout_id', $tryout_group->tryout->id)
            ->where('user_id', auth()->guard('web')->user()->id)
            ->first();

        if ($grade && $grade->start_time && $grade->end_time) {
            $start = Carbon::parse($grade->start_time);
            $end = Carbon::parse($grade->end_time);
            $durationSeconds = $end->diffInSeconds($start, true);
            $grade->duration_minutes = round($durationSeconds / 60, 1);
            if ($grade->duration_minutes > $tryout_group->tryout->duration) {
                $grade->duration_minutes = $tryout_group->tryout->duration;
            }
        } else {
            $grade->duration_minutes = null;
        }

        $allGradesRaw = Grade::with('user')
            ->where('tryout_id', $tryout_group->tryout->id)
            ->whereNotNull('end_time')
            ->orderByDesc('grade')
            ->get();

        $allGradesWithRank = $allGradesRaw->values()->map(function ($item, $index) {
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

        $totalUsers = Grade::where('tryout_id', $tryout_group->tryout->id)
            ->whereNotNull('end_time')
            ->count();

        $ranking = Grade::where('tryout_id', $tryout_group->tryout->id)
            ->whereNotNull('end_time')
            ->where('grade', '>', $grade->grade)
            ->count() + 1;

        $can_show_answer = $tryout_group->tryout->is_show_answer === 1;
        $can_show_rank = $tryout_group->tryout->is_show_rank === 1;

        return inertia('User/Members/Tryouts/Result', [
            'tryout_group'    => $tryout_group,
            'grade'           => $grade,
            'all_grades'      => $allGradesPaginated,
            'user_ranking'    => $ranking,
            'total_users'     => $totalUsers,
            'user_id'         => $userId,
            'can_show_answer' => $can_show_answer,
            'can_show_rank'   => $can_show_rank,
            'menuProducts'    => $menuProducts,
            'product'         => $product,
            'subProduct'      => $subProduct,
        ]);
    }

    public function tryoutReview(Product $product, SubProduct $subProduct, $tryout_group_id, $page)
    {
        $menuProducts = Product::with('subProducts')->get();

        $userId = auth()->guard('web')->user()->id;

        $tryout_group = TryoutGroup::with('tryout', 'user')
            ->where('user_id', $userId)
            ->where('id', $tryout_group_id)
            ->firstOrFail();

        $all_answers = Answer::with('question')
            ->where('user_id', $userId)
            ->where('tryout_id', $tryout_group->tryout->id)
            ->orderBy('question_order', 'ASC')
            ->get();

        $cant_show_answer = $tryout_group->tryout->is_show_answer === 0;
        $can_show_explanation = $tryout_group->tryout->is_show_explanation === 1;

        if ($cant_show_answer) {
            return redirect()->route('member.tryouts.result', [
                'product' => $product->slug,
                'subProduct' => $subProduct->slug,
                $tryout_group->id
            ]);
        }

        $question_active = $all_answers->where('question_order', $page)->first();
        $question_correct = $all_answers->where('is_correct', 'Y')->count();
        $answer_order = $question_active ? explode(',', $question_active->answer_order) : [];

        return inertia('User/Members/Tryouts/Review', [
            'page'                 => (int) $page,
            'all_questions'        => $all_answers,
            'question_active'      => $question_active,
            'question_correct'     => $question_correct,
            'tryout_group'         => $tryout_group,
            'answer_order'         => $answer_order,
            'can_show_explanation' => $can_show_explanation,
            'menuProducts'         => $menuProducts,
            'product'              => $product,
            'subProduct'           => $subProduct,
        ]);
    }
}
