<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required|min:8'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput($request->all());
        }

        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials))
        {
            if(auth()->user()->is_admin)
                return redirect(route('admin.dashboard'));
            return redirect(route('home'));
        }

        return back()->withErrors(['login' => 'Username or Password incorrect'])->withInput($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
