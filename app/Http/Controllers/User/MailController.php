<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;

class MailController extends Controller
{
    public function showCheckout()
{
    $countries = Country::all();

    return view('frontend.account.checkout', compact('countries'));
}
    /**
     * Display a listing of the resource.
     */
    public function order(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

    $user = Auth::user();
    $total = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['qty'];
    });
    $ecoTax = $total * 0.02;
    $grandTotal = $total + $ecoTax;

    $data = [
        'subject' => 'Xác nhận đơn hàng',
        'body' => 'Cảm ơn bạn đã đặt hàng!',
        'cart' => $cart,
        'total' => $total,
        'ecoTax' => $ecoTax,
        'grandTotal' => $grandTotal,
    ];

    // GỬI MAIL
    Mail::to($user->email)->send(new MailNotify($data));

    // clear cart
    session()->forget('cart');

    return back()->with('success', 'Đặt hàng thành công & đã gửi mail!');
}
    public function index()
    {
        //
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
