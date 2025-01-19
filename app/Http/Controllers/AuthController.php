<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginVIew(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, true)) {
            return redirect('/');
        }else{
            return redirect()->back()->withErrors(['msg'=>'Wrong username or password']);
        }
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }
}
