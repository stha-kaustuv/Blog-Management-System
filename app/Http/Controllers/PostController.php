<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category','author'])->get();
        $user=auth()->user();
        $formatted=$posts->map(function($post){
            return [
                'id' => $post->id,
                'title' => $post->title,
                'author_name' => $post->author?->name,
                'body' => $post->body,
                'category_name' => $post->category?->name,
                'created_at' => $post->created_at,
            ];
        });

        return response()->json($formatted);
    }
    public function store(Request $request)
    {
        $validated=$request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required| integer| exists:categories,id',
        ]);
        $post = Post::create([
            ...$validated,
            'author_id'=>auth()->id()
        ]);
        return response()->json([
            'message:'=>'Post created successfully',
            'post'=>$post
        ],201);
    }
    public function update(Request $request, Post $post)
    {
        $validated=$request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        if($post->author_id!=auth()->id()){
            return response()->json('Unauthorized', 401);
        }
        $post->update($validated);
        return response()->json([
            'message:'=>'Post updated successfully',
            'updated'=>$post
        ]);
    }

    public function destroy(Post $post)
    {
        if($post->author_id!=auth()->id()){
            return response()->json('Unauthorized', 401);
        }
        $post->delete();
        return response()->json([
            'message'=>'Post deleted successfully',
        ]);
    }
}
