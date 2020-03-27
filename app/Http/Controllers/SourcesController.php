<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function index()
    {
        $title = 'Source Code';
        $categories = Category::all();
        return view('source', compact('title','categories'));
    }
}
