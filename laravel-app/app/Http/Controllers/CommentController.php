<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   
    // store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id'   => 'required|exists:posts,id',
            'comment'   => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $validated['user_id'] = Auth::id();

        $comment = Comment::create($validated);


        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'comment' => view('components.comment', ['comment' => $comment])->render()
            ]);
        }

        return back()->with('success', 'Comment added.');
    }

    // delete
    public function delete(Request $request, $id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $comment->delete();

        if ($request->ajax()) {
            return response()->json(['status' => 'deleted']);
        }

        return back()->with('success', 'Comment deleted.');
    }
}
