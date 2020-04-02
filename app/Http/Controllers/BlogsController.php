<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    public function index()
    {
        $title = 'Portfolio';
        $users = User::get()->first();
        
        return view('portfolio', compact('title','users'));
    }

    public function blog()
    {
        $title = 'Blog';
        $posts = Post::latest()->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();
        $tag_count = DB::table('post_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();

        return view('blog', compact('title','posts','categories','tags','tag_count'));
    }

    public function blog_detail($slug, Post $post)
    {
        $title = 'Blog';
        $content = Post::where('slug', $slug)->get();
        $categories = Category::all();
        $tags = Tag::all();

        // dapatkan id content yang sekarang
        foreach($content as $data){
            $id = $data->id;
        }


        $tag_count = DB::table('post_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        // get data content selanjutnya berdasarkan id
        $next = Post::where('id', '>' , $id)->first();
        // get data content sebelumnya berdasarkan id
        $previous = Post::where('id', '<' , $id)->first();
 
        return view('layouts.detail', compact('title','content','categories','tags','tag_count'))
                                    ->with('previous', $previous)
                                    ->with('next', $next);
    }

    public function list_category(Category $category)
    {
        $title = 'Blog';

        $categories = Category::all();
        $tags = Tag::all();
        $tag_count = DB::table('post_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        // get data post yang berkategori sesuai parameter 
        $posts = $category->post()->latest()->paginate(5);
        return view('blog', compact('categories', 'posts','title','tags','tag_count'));
    }

    public function search(Request $request)
    {
        $title = 'Blog';
        $categories = Category::all();
        $tags = Tag::all();
        $tag_count = DB::table('post_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        $posts = Post::where('title', $request->search)
                    ->orWhere('title', 'LIKE', "%{$request->search}%")->latest()->paginate(5);
        return view('blog', compact('title','categories','posts','tags','tag_count'));
    }

    public function list_tag(Tag $tag)
    {
        $title = 'Blog';

        $categories = Category::all();
        $tags = Tag::all();
        $tag_count = DB::table('post_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        // get data post yang berkategori sesuai parameter 
        $posts = $tag->post()->latest()->paginate(5);
        return view('blog', compact('categories', 'posts','title','tags','tag_count'));
    }
}
