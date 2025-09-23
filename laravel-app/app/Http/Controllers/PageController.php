<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //index
    public function login(){
        return view('auth.login');
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
