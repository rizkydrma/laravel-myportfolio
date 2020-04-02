<?php

namespace App\Http\Controllers;

use App\Sourcecode;
use App\Tag;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use File;

class SourcecodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Source Code Page';
        $sourcecodes = Sourcecode::paginate(6);

        session(['active' => 'sourcecode']);
        return view('admin.source_code.index', compact('title','sourcecodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Source Code Page';
        $tags = Tag::all();

        return view('admin.source_code.create', compact('title','tags'));
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
            'title' => 'required|unique:sourcecodes|min:3',
            'content' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            'color' => 'required'
        ]);

        // simpan image yang di upload ke variable image
        $image = $request->file('image');
        // buat nama image baru agar menjadi unique
        $imageName = time() . "source_" . $image->getClientOriginalName();

        // path tujuan file/image di simpan
        $path = 'img/source';
        // simpan data ke database
        $sorcecodes = Sourcecode::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
            'download' => $request->download,
            'video' => $request->video,
            'color' => $request->color,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::id()
        ]);

        // simpan data tag yang berelasi many to many ke tb sourcecode_tag
        $sorcecodes->tag()->attach($request->tags);

        // pindahkan file/image sesuai path
        $image->move($path, $imageName);

        return redirect()->back()->with('status','Success add data source code');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sourcecode  $sourcecode
     * @return \Illuminate\Http\Response
     */
    public function show(Sourcecode $sourcecode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sourcecode  $sourcecode
     * @return \Illuminate\Http\Response
     */
    public function edit(Sourcecode $sourcecode)
    {
        $title = 'Edit Source Code';
        $tags = Tag::all();

        return view('admin.source_code.edit', compact('title','tags','sourcecode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sourcecode  $sourcecode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sourcecode $sourcecode)
    {
        $request->validate([
            'title' => 'required|unique:sourcecodes',
            'content' => 'required'
        ]);

        // simpan data image yang di upload ke variabel image
        $image = $request->file('image');
        // deklarasi path tujuan upload
        $path = 'img/source';

        $sourceData = [
            'title' => $request->title,
            'content' => $request->content,
            'color' => $request->color,
            'download' => $request->download,
            'video' => $request->video,
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
            $imageName = time()."post_".$image->getClientOriginalName();
            // pindahkan file/image yang di upload ke dalam folder path
            $image->move($path,$imageName);
            // push data image ke dalam array postData agar tersimpan di DB
            $sourceData['image'] = $imageName;
        }
        // ubah tag berelasi many to many
        $sourcecode->tag()->sync($request->tags);
        Sourcecode::where('id', $sourcecode->id)
            ->update($sourceData);

        return redirect()->route('sourcecode.index')->with('status', 'Success Edit Some Source');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sourcecode  $sourcecode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sourcecode $sourcecode)
    {
        Sourcecode::destroy($sourcecode->id);
        return redirect()->back()->with('status','Success delete some data');
    }

    public function search(Request $request)
    {
        $title = 'Source Code';
        $sourcecodes = Sourcecode::when($request->search, function($query) use ($request){
            $query->where('title','LIKE',"%{$request->search}%");
        })->paginate(6);
        $sourcecodes->appends($request->only('search'));

        return view('admin.source_code.index', compact('title','sourcecodes'));
    }

    public function trash()
    {
        $title = 'Trash Source Code';
        $sourcecodes = Sourcecode::onlyTrashed()->paginate(6);

        return view('admin.source_code.trash',compact('title','sourcecodes'));
    }

    public function restore($id)
    {
        Sourcecode::withTrashed()->where('id', $id)->restore();

        return redirect()->back()->with('status', 'Success Restore Some Data');
    }

    public function kill($id, $image)
    {
        File::delete('img/source/'.$image);
        Sourcecode::where('id', $id)->forceDelete();

        return redirect()->back()->with('status', 'Success Delete Some Data');
    }
}
