<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

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

    // home
    public function index(Request $request)
    {
        $posts = Post::with('user')
            ->active()
            ->latest()
            ->paginate(5);

        if ($request->ajax()) {
            if ($posts->isEmpty()) {
                return response()->json(['html' => '', 'done' => true]);
            }
            return response()->json([
                'html' => view('components.post', compact('posts'))->render(),
                'done' => false
            ]);
        }

        return view('home', compact('posts'));
    }

    //profile
    public function profile(Request $request)
    {
        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $posts = Post::with(['user', 'reacts'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(5);

        if ($request->ajax()) {
            if ($posts->isEmpty()) {
                return response()->json(['html' => '', 'done' => true]);
            }

            return response()->json([
                'html' => view('components.post', compact('posts'))->render(),
                'done' => false
            ]);
        }

        return view('profile', compact('posts','user'));
    }

    //other_profile
    public function other_profile(Request $request,$user_url){
        $user = User::where('user_url', $user_url)->first();

        if (!$user) {
            abort(404);
        }

        $userId = $user->id;
 

        $posts = Post::with(['user', 'reacts'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(5);
        
        // dd($posts->count());

        if ($request->ajax()) {
            if ($posts->isEmpty()) {
                return response()->json(['html' => '', 'done' => true]);
            }

            return response()->json([
                'html' => view('components.post', compact('posts'))->render(),
                'done' => false
            ]);
        }

        return view('profile', compact('posts','user'));
    }
}
