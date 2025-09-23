<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\React;

class ReactController extends Controller
{
    //react_toggle
    public function react_toggle(Request $request)
    {
        $postId = $request->post_id;
        $userId = Auth::id();

        $post = Post::findOrFail($postId);

        // Check if already reacted
        $react = React::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($react) {
            $react->delete();
            $liked = false;
        } else {
            React::create([
                'post_id' => $postId,
                'user_id' => $userId,
            ]);
            $liked = true;
        }

        // Count total likes
        $count = React::where('post_id', $postId)->count();

        return response()->json([
            'liked' => $liked,
            'count' => $count
        ]);
    }
}
