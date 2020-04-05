<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Sourcecode;
use App\Sourcecomment;

class PostCommentController extends Controller
{
    public function show_post()
    {
        $title = 'Post Comment';
        $post_comment = Comment::paginate(6);

        session(['active' => 'comment']);
        return view('admin.comment.post', compact('post_comment','title'));
    }

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

    public function destroy_post(Comment $comment)
    {
        Comment::destroy($comment->id);
        return redirect()->back()->with('status','Success Delete Some Data');
    }

    public function deleteAll(Request $request)
    {
        $id = $request->id;
        Comment::whereIn('id', explode(',',$id))->delete();
        return redirect()->back()->with('status','Success Delete Multiple Data');
    }

    public function search(Request $request)
    {
        
        $title = 'Post Comment';
        $post_comment = Comment::when($request->search, function($query) use ($request){
            $query->where('name','LIKE', "%{$request->search}%")
                    ->orWhere('message','LIKE',"%{$request->search}%");
        })->paginate(6);
        $post_comment->appends($request->only('search'));

        return view('admin.comment.post', compact('post_comment','title'));
    }
    
    public function show_source()
    {
        $title = 'Source Comment';
        $source_comment = Sourcecomment::paginate(6);

        session(['active' => 'comment']);
        return view('admin.comment.source', compact('source_comment','title'));
    }

    public function store_source(Request $request, Sourcecode $sourcecode)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Sourcecomment::create([
            'sourcecode_id' => $sourcecode->id,
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email
        ]);

        return redirect()->back(); 
    }

    public function destroy_source(Sourcecomment $sourcecomment)
    {
        Sourcecomment::destroy($sourcecomment->id);
        return redirect()->back()->with('status','Success Delete Some Data');
    }

    public function deleteAll_source(Request $request)
    {
        $id = $request->id;
        Sourcecomment::whereIn('id', explode(',',$id))->delete();
        return redirect()->back()->with('status','Success Delete Multiple Data');
    }

    public function search_source(Request $request)
    {

        // $value = $request->search;
        // $category = Category::where('name','like','%' . $value . '%')->paginate(6);
        
        $title = 'Source Comment';
        $source_comment = Sourcecomment::when($request->search, function($query) use ($request){
            $query->where('name','LIKE', "%{$request->search}%");
        })->paginate(6);
        $source_comment->appends($request->only('search'));

        return view('admin.comment.source', compact('source_comment','title'));
    }
}
