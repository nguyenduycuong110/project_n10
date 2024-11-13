<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController 
{
    
    public function __construct(){
        
    }

    public function index(){
        return view('reception.auth.login');

    }

    public function login(Request $request){

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'provider' => 'reception'
        ];
        

        if(Auth::guard('reception')->attempt($credentials)){

            $user = Auth::guard('reception')->user();

            $request->session()->regenerate();

            return redirect()->route('reception.index')->with('success', 'Đăng nhập thành công');

        }

        return redirect()->route('reception.auth.login')->with('error','Email hoặc Mật khẩu không chính xác');
    }

    public function logout(Request $request){

        dd(Auth());

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('reception.auth.login');

    }


}
