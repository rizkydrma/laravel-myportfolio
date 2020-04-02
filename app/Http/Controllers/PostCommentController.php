<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostCommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Comment::create([
            'post_id' => $post->id,
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email
        ]);

        return redirect()->back(); 
    }
}
