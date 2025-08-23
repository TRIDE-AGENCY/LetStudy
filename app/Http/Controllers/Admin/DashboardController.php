<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = Product::with('subProducts')->get();

        return inertia('Admin/Dashboard/Index', [
            'menuProducts' => $products
        ]);
    }
}
