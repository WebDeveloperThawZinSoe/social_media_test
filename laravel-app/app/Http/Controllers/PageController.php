<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //index
    public function login(){
        if(Auth::check()){
            return redirect("/");
        }else{
            return view('auth.login');
        }
        
    }

    //home
    public function index(){
        return view("home");
    }

    //home
    public function profile(){
        return view("profile");
    }
}
