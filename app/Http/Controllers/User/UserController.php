<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function frontendIndex()
    {
        return view('frontend.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.user.create');
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
    public function edit()
    {
        $user = Auth::user();
        $countries = \App\Models\Country::all();
        return view('frontend.account.update', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

    // nếu có password thì mới update
    if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    } else {
        unset($data['password']);
    }

    // upload avatar
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('upload/user'), $filename);
        $data['avatar'] = 'upload/user/'.$filename;
    }

    $user->update($data);

    return back()->with('success', 'Update successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
