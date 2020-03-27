<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use File;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Post Page';
        $posts = Post::paginate(6);
        
        session(['active' => 'post']);
        return view('admin.post.index', compact('title','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Post Page';
        $category = Category::all();
        $tags = Tag::all();

        return view('admin.post.create', compact('title','category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'category_id' => 'required',
            'content' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);

        // simpan data image yang di upload ke variabel image
        $image = $request->file('image');
        $imageName = time()."_".$image->getClientOriginalName();
        
        // path tujuan file/image akan di simpan 
        $path = 'data_post';

        // simpan data post ke database
        $post = Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'image' => $imageName,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id()
        ]);

        // simpan data yang berelasi many to many , post_tag
        $post->tag()->attach($request->tags);
        
        // pindahkan file/image yang di upload ke dalam folder path
        $image->move($path,$imageName);
        return redirect()->back()->with('status','Success make a Post');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = 'Edit Post';
        $tags = Tag::all();
        $category = Category::all();
        return view('admin.post.edit', compact('post','tags','title','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ]);
        
        // simpan data image yang di upload ke variabel image
        $image = $request->file('image');
        // deklarasi path tujuan upload
        $path = 'data_post';

        // deklarasi data yang akan diubah
        $postData = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id()
        ];
        // jika ada image yang di ubah
        if($request->has('image')){
            // validasi kembali image yang akan di upload
            $request->validate([
                'image' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            ]);
            // deklarasi nama image baru
            $imageNew = time()."_".$image->getClientOriginalName();
            // pindahkan file/image yang di upload ke dalam folder path
            $image->move($path,$imageNew);
            // push data image ke dalam array postData agar tersimpan di DB
            $postData += ['image' => $imageNew];
        }

        // ubah tag berelasi many to many
        $post->tag()->sync($request->tags);
        Post::where('id', $post->id)
            ->update($postData);

        return redirect()->route('post.index')->with('status', 'Success Edit Some Post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect()->back()->with('status','Success Delete Some Data');
    }

    public function search(Request $request)
    {
        $title = 'Post Page';
        $posts = Post::when($request->search, function($query) use($request){
            $query->where('title','LIKE', "%{$request->search}%");
        })->paginate(6);
        $posts->appends($request->only('search'));

        return view('admin.post.index', compact('title','posts'));
    }

    public function trash()
    {
        $title = 'Trash Post';
        $posts = Post::onlyTrashed()->paginate(6);

        return view('admin.post.trash', compact('title','posts'));
    }

    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();

        return redirect()->back()->with('status','Success Restore Some Data');
    }

    public function kill($id,$image)
    {
        
        File::delete('data_post/'.$image);
        Post::where('id', $id)->forceDelete();

        return redirect()->back()->with('status','Success Delete Some Data');
    }
}

