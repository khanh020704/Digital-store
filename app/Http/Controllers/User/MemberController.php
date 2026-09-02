<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginMemberRequest;
use App\Http\Requests\RegisterMemberRequest;


class MemberController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.members.login');
    }
    
    public function login(LoginMemberRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0, 
        ];
        $remember = false; 
        if($request->member_me){
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            return redirect()->intended('/');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/members/login');

    }
    public function showRegistrationForm()
    {
        $countries = \App\Models\Country::all();
        return view('frontend.members.register', compact('countries'));
    }

    public function register(RegisterMemberRequest $request)
    {
        $data = $request->all();
        $data['level'] = 0; 
        $data['password'] = bcrypt($request->password); 
        
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('frontend/uploads/avatars'), $filename);
            $data['avatar'] = 'frontend/uploads/avatars/' . $filename;
        }
        $user = User::create($data);
        return redirect()->route('members.login')->with('success', 'Registration successful. Please login.');
    }
}
 
