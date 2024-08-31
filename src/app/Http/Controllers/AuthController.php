<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('/')->with('message','ログインしました');
        }
        return redirect()->route('loginView')->with('message','ログインに失敗しました');
    }

}
