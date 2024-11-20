<?php

namespace App\Http\Controllers\Consultation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController 
{
    
    public function __construct(){
        
    }

    public function index(){
        return view('consultation.auth.login');
    }

    public function login(Request $request){

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'provider' => 'consultation'
        ];

        if(Auth::guard('consultation')->attempt($credentials)){

            $user = Auth::guard('consultation')->user();

            $request->session()->regenerate();

            return redirect()->route('consultation.index')->with('success', 'Đăng nhập thành công');

        }

        return redirect()->route('consultation.auth.login')->with('error','Email hoặc Mật khẩu không chính xác');

    }

    public function logout(Request $request){

        Auth::guard('consultation')->logout();

        $request->session()->forget('session_consultation');

        $request->session()->regenerateToken();

        return redirect()->route('consultation.auth.login');

    }

    
}