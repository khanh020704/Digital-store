<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FilterController extends Controller
{
    public function filterPrice(Request $request)
    {
        $min = $request->min;
        $max = $request->max;

        $products = Product::whereBetween('price', [$min, $max])->get();

        return view('frontend.search._product_list', compact('products'))->render();
    }
}
