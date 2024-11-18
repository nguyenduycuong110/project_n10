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

        Auth::guard('reception')->logout();

        $request->session()->forget("session_reception");

        $request->session()->regenerateToken();

        return redirect()->route('reception.auth.login');

    }

}
