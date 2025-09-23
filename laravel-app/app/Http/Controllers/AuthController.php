<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    
    // login
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // check if login is email or username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $login_type => $request->login,
            'password'  => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->with('success', 'Welcome back!');
        }

        return back()
            ->withInput()
            ->withErrors(['login' => 'Invalid credentials provided.'])
            ->with('tab', 'login'); // keep login tab active
    }

    // register
    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'       => 'required|email|unique:users,email',
            'username'    => 'required|string|min:3|max:20|unique:users,name',
            'password'    => 'required|string|min:8',
            'profile_pic' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('tab', 'register'); 
        }

        $user = new User();
        $user->name     = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_photo_path = $request->profile_pic;
        $user->user_url = \Str::slug($request->username) . '-' . \Str::random(10);

        $user->save();

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully! Welcome.');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
