<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Post;
use App\Models\React;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="My Laravel API",
 *      description="API Documentation for Social App",
 *      @OA\Contact(
 *          email="thawzinsoe.dev@gmail.com"
 *      )
 * )
 */
class APISController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","username","password","password_confirmation"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="username", type="string"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password"),
     *             @OA\Property(property="profile_pic", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
        public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'                 => 'required|email|unique:users,email',
            'username'              => 'required|string|min:3|max:20|unique:users,name',
            'password'              => 'required|string|min:8|confirmed',
            'profile_pic'           => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();

        $user = User::create([
            'name'                => $validated['username'],
            'email'               => $validated['email'],
            'password'            => Hash::make($validated['password']),
            'user_url'            => Str::slug($validated['username']) . '-' . Str::random(10),
            'profile_photo_path'  => $validated['profile_pic'] ?? null,
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'message' => 'User registered successfully',
            'user'    => $user,
            'token'   => $token
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"login","password"},
     *             @OA\Property(property="login", type="string"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login successful"),
     *     @OA\Response(response=401, description="Invalid credentials")
     * )
     */
      public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $validated = $validator->validated();
        $loginType = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $user = User::where($loginType, $validated['login'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful',
            'user'    => $user,
            'token'   => $token
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Logged out successfully"),
     *     @OA\Response(response=403, description="Not logged in")
     * )
     */
    public function logout(Request $request)
    {
        if(!Auth::check()){
            return response()->json(['status'=>'error','errors'=>"Login First"],403);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'success','message' => 'Logged out successfully']);
    }

    /**
     * @OA\Get(
     *     path="/api/news-feed",
     *     tags={"Posts"},
     *     summary="Get news feed posts",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of posts")
     * )
     */
    public function newsFeed(Request $request)
    {
        $posts = Post::with(['user','reacts','comments'])->latest()->paginate(10);
        return response()->json(['status'=>'success','posts'=>$posts]);
    }

    /**
     * @OA\Get(
     *     path="/api/my-profile",
     *     tags={"User"},
     *     summary="Get my profile info",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Profile details")
     * )
     */
    public function myProfile(Request $request)
    { 
        $user = $request->user()->loadCount(['posts','reacts','comments']);

        $profile = [
            'id'             => $user->id,
            'name'           => $user->name,
            'email'          => $user->email,
            'created_at'     => $user->created_at,
            'posts_count'    => $user->posts_count,
            'reacts_count'   => $user->reacts_count,
            'comments_count' => $user->comments_count,
            'profile_photo'  => $user->profile_photo_url, 
        ];

        return response()->json(['status'=>'success','profile'=>$profile]);
    }

    /**
     * @OA\Get(
     *     path="/api/my-posts",
     *     tags={"Posts"},
     *     summary="Get my posts",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of my posts")
     * )
     */
    public function myPosts(Request $request)
    {
        $posts = Post::with(['user','reacts','comments'])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return response()->json(['status'=>'success','posts'=>$posts]);
    }

    /**
     * @OA\Post(
     *     path="/api/post",
     *     tags={"Posts"},
     *     summary="Create new post",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="text", type="string"),
     *             @OA\Property(property="image_file", type="string", format="binary"),
     *             @OA\Property(property="video_file", type="string", format="binary")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Post created successfully"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function PostStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text'       => 'nullable|string|max:500',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:5120',   
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:25600',      
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error','errors' => $validator->errors()], 422);
        }

        if (!$request->filled('text') && !$request->hasFile('image_file') && !$request->hasFile('video_file')) {
            return response()->json(['status'=>'error','message'=>'You must enter text or upload a file.'],422);
        }

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

        $post = Post::create([
            'user_id'    => Auth::id(),
            'text'       => $request->text,
            'media_type' => $mediaType,
            'media_url'  => $mediaUrl,
            'status'     => 1, 
        ]);

        return response()->json(['status'=>'success','message'=>'Post created successfully.','post'=>$post],201);
    }

    /**
     * @OA\Delete(
     *     path="/api/post/{id}",
     *     tags={"Posts"},
     *     summary="Delete my post",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Post deleted"),
     *     @OA\Response(response=404, description="Post not found")
     * )
     */
    public function deleteMyPost(Request $request, $id)
    {
        $validator = Validator::make(['id'=>$id], ['id'=>'required|exists:posts,id']);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()],422);
        }

        $post = Post::where('id',$id)->where('user_id',$request->user()->id)->first();
        if (!$post) {
            return response()->json(['status'=>'error','message'=>'Post not found'],404);
        }

        $post->delete();
        return response()->json(['status'=>'success','message'=>'Post deleted']);
    }

    /**
     * @OA\Post(
     *     path="/api/react",
     *     tags={"Reacts"},
     *     summary="Toggle like/react",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"post_id"},
     *             @OA\Property(property="post_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=200, description="React toggled")
     * )
     */
    public function reactToggle(Request $request)
    {
        $validator = Validator::make($request->all(), ['post_id' => 'required|exists:posts,id']);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()],422);
        }

        $userId = $request->user()->id;
        $postId = $request->post_id;

        $react = React::where('post_id',$postId)->where('user_id',$userId)->first();
        if ($react) {
            $react->delete();
            $liked = false;
        } else {
            React::create(['post_id'=>$postId,'user_id'=>$userId]);
            $liked = true;
        }

        $count = React::where('post_id',$postId)->count();
        return response()->json(['status'=>'success','liked'=>$liked,'count'=>$count]);
    }

    /**
     * @OA\Post(
     *     path="/api/comment",
     *     tags={"Comments"},
     *     summary="Add comment",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"post_id","comment"},
     *             @OA\Property(property="post_id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="parent_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Comment created")
     * )
     */
    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id'   => 'required|exists:posts,id',
            'comment'   => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()],422);
        }

        $validated = $validator->validated();

        $comment = Comment::create([
            'user_id'   => $request->user()->id,
            'post_id'   => $validated['post_id'],
            'comment'   => $validated['comment'],
            'parent_id' => $validated['parent_id'] ?? null,
        ]);

        return response()->json(['status'=>'success','comment'=>$comment],201);
    }

    /**
     * @OA\Delete(
     *     path="/api/comment/{id}",
     *     tags={"Comments"},
     *     summary="Delete my comment",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Comment deleted"),
     *     @OA\Response(response=404, description="Comment not found")
     * )
     */
    public function deleteComment(Request $request, $id)
    {
        $validator = Validator::make(['id'=>$id], ['id'=>'required|exists:comments,id']);
        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()],422);
        }

        $comment = Comment::where('id',$id)->where('user_id',$request->user()->id)->first();
        if (!$comment) {
            return response()->json(['status'=>'error','message'=>'Comment not found'],404);
        }

        $comment->delete();
        return response()->json(['status'=>'success','message'=>'Comment deleted']);
    }
}
