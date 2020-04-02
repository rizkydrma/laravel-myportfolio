<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Sourcecode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SourcesController extends Controller
{
    public function index()
    {
        $title = 'Source Code';
        $sourcecodes = Sourcecode::paginate(10);
        $tags = Tag::all();
        $tag_count = DB::table('sourcecode_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        
        return view('source', compact('title','sourcecodes','tags','tag_count'));
    }

    public function source_detail($slug)
    {
        $title = 'Source Code';
        $content = Sourcecode::where('slug', $slug)->get();
        $tags = Tag::all();
        $tag_count = DB::table('sourcecode_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        // get id content yang sekarang
        foreach ($content as $data ) {
            $id = $data->id;
        }
        // get data content selanjutnya berdasarkan id
        $next = Sourcecode::where('id','>', $id)->first();
        // get data content sebelumnya berdsasarkan id
        $previous = Sourcecode::where('id','<', $id)->first();

        return view('layouts.detail', compact('title','content','tags','tag_count'))->with('previous', $previous)->with('next', $next);
    }

    public function search(Request $request)
    {
        $title = 'Source Code';
        $sourcecodes = Sourcecode::where('title', $request->search)
                            ->orWhere('title','LIKE',"%{$request->search}%")
                            ->paginate(10);
        $tags = Tag::all();
        $tag_count = DB::table('sourcecode_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
        return view('source',compact('title','sourcecodes','tags','tag_count'));
    }

    public function list_tag(Tag $tag)
    {
        $title = 'Source Code';
        $tags = Tag::all();
        $tag_count = DB::table('sourcecode_tag')->select(DB::raw('tag_id, count(id) as total'))
                            ->groupby('tag_id')
                            ->orderby('tag_id','asc')
                            ->get();
                            
        // get data post yang berkategori sesuai parameter 
        $sourcecodes = $tag->sourcecode()->latest()->paginate(5);
        return view('source', compact('sourcecodes','title','tags','tag_count'));
    }
}
