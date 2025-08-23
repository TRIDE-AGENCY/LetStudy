<?php

namespace App\Http\Controllers\Admin\Pages\LetStudy;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function quote()
    {
        $menuProducts = Product::with('subProducts')->get();

        $quote = Quote::find(1);

        return inertia('Admin/Pages/LetStudy/Quote/Index', [
            'menuProducts' => $menuProducts,
            'quote' => $quote,
        ]);
    }

    public function quoteUpdate(Request $request, Quote $quote)
    {
        $request->validate([
            'name'  => 'required',
            'title' => 'required',
            'quote' => 'required',
        ]);

        $quote->update([
            'name'  => $request->name,
            'title' => $request->title,
            'quote' => $request->quote,
        ]);

        return redirect()->route('admin.pages.letstudy.quote.index');
    }
}
