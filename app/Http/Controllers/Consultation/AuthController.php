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

    
}