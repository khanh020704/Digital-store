<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

    if ($request->name) {
        $query->where('name', 'LIKE', '%' . $request->name . '%');
    }

    if ($request->price) {
        [$min, $max] = explode('-', $request->price);

        $query->whereBetween('price', [(int)$min, (int)$max]);
    }

    if ($request->category) {
        $query->where('id_category', $request->category);
    }

    if ($request->brand) {
        $query->where('id_brand', $request->brand);
    }

    if ($request->status !== null && $request->status !== '') {
        $query->where('status', $request->status);
    }

    $products = $query->paginate(6)->appends($request->all());
    $categories = Category::all();
    $brands = Brand::all();

    return view('frontend.search.advanced', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
