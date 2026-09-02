<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('frontend.account.cart');
    }
      public function add(Request $request)
    {
        $id = $request->id_product;
        $qty = (int)$request->qty;

        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => json_decode($product->image, true)[0] ?? '',
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);

        $cart = session()->get('cart', []);
        $totalQty = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'totalQty' => $totalQty,
            'cart' => $cart
        ]);
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
    public function update(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            if($type=='up'){
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id]['qty'] -= 1;

                if($cart[$id]['qty'] <= 0){
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                    return response()->json([
                        'delete' => true,
                        'cartTotal' => $this->getTotal($cart)
                    ]);
                }
            }
        }
    
    session()->put('cart', $cart);
    $total = $this->getTotal($cart);
    $ecoTax = $total * 0.02;
    return response()->json([
        'qty'=> $cart[$id]['qty'],
        'itemTotal' => $cart[$id]['qty'] * $cart[$id]['price'],
        'cartTotal' => $this->getTotal($cart),
        'ecoTax' => $ecoTax,
        'delete'=> false
    ]);
    }
    public function delete(Request $request ) {
        $id = $request->id;
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
        $total = $this->getTotal($cart);
        $ecoTax = $total * 0.02;
        return response()->json([
            'cartTotal' => $this->getTotal($cart),
            'ecoTax' => $ecoTax
        ]);
    }
    private function getTotal($cart){
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }
        return $total;
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
    public function store(Request $request, string $id)
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
