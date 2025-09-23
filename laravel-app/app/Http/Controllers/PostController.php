<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // store
    public function store(Request $request)
    {
 
        if (!$request->filled('text') && !$request->hasFile('image_file') && !$request->hasFile('video_file')) {
            return redirect()->back()->with(['error' => 'You must enter text or upload a file.']);
        }


        $request->validate([
            'text'       => 'nullable|string|max:500',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5120',   
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:25600',      
        ]);

        $mediaType = null;
        $mediaUrl  = null;

  
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $mediaType = 'image';
            $path = $file->store('posts', 'public');
            $mediaUrl = Storage::url($path);
        }


        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $mediaType = 'video';
            $path = $file->store('posts', 'public');
            $mediaUrl = Storage::url($path);
        }


        Post::create([
            'user_id'    => Auth::id(),
            'text'       => $request->text,
            'media_type' => $mediaType,
            'media_url'  => $mediaUrl,
            'status'     => 1, 
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully.');
    }

    // delete
    public function delete(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::where('id', $request->post_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();


        if ($post->media_url) {
            $path = str_replace('/storage/', '', $post->media_url);
            Storage::disk('public')->delete($path);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
