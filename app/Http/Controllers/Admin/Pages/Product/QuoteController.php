<?php

namespace App\Http\Controllers\Admin\Pages\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function quote(Product $product)
    {
        $menuProducts = Product::with('subProducts')->get();

        $quote = Quote::where('product_id', $product->id)->first();

        return inertia('Admin/Pages/Products/Quote/Index', [
            'menuProducts' => $menuProducts,
            'quote' => $quote,
            'product' => $product,
        ]);
    }

    public function quoteUpdate(Request $request, Product $product, Quote $quote)
    {
        $request->validate([
            'name'  => 'required',
            'title' => 'required',
            'quote' => 'required',
        ]);

        $quote->update([
            'product_id' => $product->id,
            'name'  => $request->name,
            'title' => $request->title,
            'quote' => $request->quote,
        ]);

        return redirect()->route('admin.pages.products.quote.index', [
            'product' => $product->slug,
        ]);
    }
}
