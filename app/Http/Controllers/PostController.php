<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated=$request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
        $post = Post::create([
            ...$validated,
            'author_id'=>auth()->id()
        ]);
        return response()->json([
            'message:'=>'Post created successfully',
            201,
            $post
        ]);
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
            $post
        ]);
    }

    public function destroy(Post $post)
    {
        if($post->author_id!=auth()->id()){
            return response()->json('Unauthorized', 401);
        }
        $post->delete();
        return response()->json([
            'message:'=>'Post deleted successfully',
        ]);
    }
}
