<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tag Page';
        $tags = Tag::paginate(6);

        session(['active' => 'tag']);
        return view('admin.tag.index',compact('title','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|min:3'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('status','Success Add Some Data !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $tags = Tag::findOrFail($tag->id);
        echo json_encode($tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Tag::where('id', $tag->id)
            ->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
        return redirect()->back()->with('status', 'Success Update Some Data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        Tag::destroy($tag->id);
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }

    public function search(Request $request)
    {
        $title = 'Tag Page';
        $tags = Tag::when($request->search, function($query) use ($request){
            $query->where('name','LIKE', "%{$request->search}%");
        })->paginate(6);
        $tags->appends($request->only('search'));

        return view('admin.tag.index',compact('title','tags'));
    }

    // Method Untuk menampilkan data yang sudah di hapus
    public function trash()
    {
        $title = 'Trashed Tag';
        // Memunculkan data yang sudah di hapus berdasarkan field delete_at
        $tags = Tag::onlyTrashed()->paginate(6);
        return view('admin.tag.trash',compact('title','tags'));
    }

    // Method Mengembalikan data yang sudah dihapus
    public function restore($id)
    {
        // mengembalikan data dan menghapus value dari field delete_at menjadi null
        Tag::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status','Success Restore Some Data');
    }

    // Method untuk benar-benar menghapus dari database
    public function kill($id)
    {
        Tag::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back()->with('status','Success Delete Some Data');
    }

    // Method untuk multiple delete data namun masih tersimpan di trash
    public function deleteAll(Request $request)
    {
        Tag::whereIn('id', explode(',', $request->id))->delete();
        return redirect()->back()->with('status','Success Delete Multiple Data');
    }
}
