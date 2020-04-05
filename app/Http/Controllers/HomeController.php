<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use App\Sourcecode;
use App\Sourcecomment;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        $sourcecodes = Sourcecode::all();
        $comments = Comment::limit(5)->get();
        $sourcecomment = Sourcecomment::limit(5)->get();
        $tags = Tag::all();
        $categories = Category::all();
        
        session(['active' => 'dashboard']);
        return view('home', compact('users','posts','sourcecodes','comments','sourcecomment','tags','categories'));
    }
}
