<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('id_user', Auth::id())->get();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');
        return view('frontend.account.my-product', compact('products', 'minPrice', 'maxPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend.account.add', compact('categories', 'brands'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('frontend.search.index', compact('products', 'keyword'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|array|max:3',
            'status' => 'required|in:0,1',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024' 
        ]);

        $data = $request->all();
        $imageNames = [];

        if($request->hasFile('image')){
            foreach($request->file('image')as $file){
                $name = time().'_'.$file->getClientOriginalName();

                $pathFull = public_path('upload/product/full/'.$name);
                $pathSmall = public_path('upload/product/small/'.$name);
                $pathMedium = public_path('upload/product/medium/'.$name);

                Image::read($file)->save($pathFull);
                Image::read($file)->resize(85, 84)->save($pathSmall);
                Image::read($file)->resize(329, 380)->save($pathMedium);

                $imageNames[] = $name;
            }
        }

        $data['image'] = json_encode($imageNames);
        $data['id_user'] = Auth::id();
        $data['status'] = (int) $request->status;
        if ($data['status'] == 0) {
            $data['sale'] = 0;
        }
    
        Product::create($data);
        return redirect()->route('account.products')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $product = Product::with('brand')->findOrFail($id);

        $product->images = json_decode($product->image, true) ?? [];
        $related = Product::where('id_category', $product->id_category)
                        ->where('id', '!=', $id)
                        ->take(6)
                        ->get();

        return view('frontend.account.details', compact('product',  'related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('frontend.account.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:0,1',
            'image' => 'nullable|array|max:3',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024'
        ]);
        $product = Product::findOrFail($id);
        $data = $request->all();

        $oldImages = json_decode($product->image, true) ?? [];

        $deleteImages = $request->delete_images ?? [];

        $remainingImages = array_diff($oldImages, $deleteImages);
        $remainingImages = array_values($remainingImages); // reset key

        $newImages = [];

        if ($request->hasFile('image')) {

        foreach($request->file('image') as $file){

            $name = time().'_'.$file->getClientOriginalName();

            $pathFull = public_path('upload/product/full/'.$name);
            $pathSmall = public_path('upload/product/small/'.$name);
            $pathMedium = public_path('upload/product/medium/'.$name);

            Image::read($file)->save($pathFull);
            Image::read($file)->resize(85, 84)->save($pathSmall);
            Image::read($file)->resize(329, 380)->save($pathMedium);

            $imageNames[] = $name;
            $newImages[] = $name;
            }
        }   

        if (count($remainingImages) + count($newImages) > 3) {
        return back()->withErrors(['image' => 'Tối đa chỉ được 3 hình']);
        }   
        $finalImages = array_merge($remainingImages, $newImages);

        $data['image'] = json_encode($finalImages);

        $data['status'] = (int) $request->status;

        if ($data['status'] == 0) {
            $data['sale'] = 0;
        } 
        $product->update($data);
        return redirect()->route('account.products')->with('success', 'Product updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('account.products')->with('success', 'Product deleted successfully!');
    }
}
