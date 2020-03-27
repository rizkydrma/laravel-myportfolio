<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index()
    {

        $title = 'Portfolio';
        return view('portfolio', compact('title'));
    }

    public function blog()
    {
        $title = 'Blog';
        $posts = Post::latest()->paginate(5);
        $categories = Category::all();
        return view('blog', compact('title','posts','categories'));
    }

    public function blog_detail($slug)
    {
        $content = Post::where('slug', $slug)->get();
        $categories = Category::all();
        // dapatkan id content yang sekarang
        foreach($content as $data){
            $id = $data->id;
        }
        // get data content selanjutnya berdasarkan id
        $next = Post::where('id', '>' , $id)->first();
        // get data content sebelumnya berdasarkan id
        $previous = Post::where('id', '<' , $id)->first();
 
        return view('layouts.detail', compact('content','categories'))->with('previous', $previous)->with('next', $next);
    }

    public function list_category(Category $category)
    {
        $title = 'Blog';

        $categories = Category::all();
        // get data post yang berkategori sesuai parameter 
        $posts = $category->post()->paginate(5);
        return view('blog', compact('categories', 'posts','title'));
    }

    public function search(Request $request)
    {
        $title = 'Blog';
        $categories = Category::all();
        $posts = Post::where('title', $request->search)
                    ->orWhere('title', 'LIKE', "%{$request->search}%")->paginate(5);
        return view('blog', compact('title','categories','posts'));
    }
}
