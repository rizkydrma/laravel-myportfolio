<?php

namespace App\Http\Controllers;

use App\Category;
use App\Sourcecode;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function index()
    {
        $title = 'Source Code';
        $sourcecodes = Sourcecode::paginate(6);
        
        $categories = Category::all();
        return view('source', compact('title','categories','sourcecodes'));
    }

    public function source_detail($slug)
    {
        $title = 'Source Code';
        $content = Sourcecode::where('slug', $slug)->get();
        $categories = Category::all();
        // get id content yang sekarang
        foreach ($content as $data ) {
            $id = $data->id;
        }
        // get data content selanjutnya berdasarkan id
        $next = Sourcecode::where('id','>', $id)->first();
        // get data content sebelumnya berdsasarkan id
        $previous = Sourcecode::where('id','<', $id)->first();

        return view('layouts.detail', compact('title','content','categories'))->with('previous', $previous)->with('next', $next);
    }
}
