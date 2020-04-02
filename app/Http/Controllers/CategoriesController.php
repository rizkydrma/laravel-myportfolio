<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Category Page';
        $category = Category::paginate(5);

        session(['active' => 'category']);
        return view('admin.category.index',compact('title','category'));
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

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('status','Success Add Some Data !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        echo json_encode($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        Category::where('id', $id)
                ->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
        return redirect()->back()->with('status', 'Success Update Some Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }

    public function search(Request $request)
    {

        // $value = $request->search;
        // $category = Category::where('name','like','%' . $value . '%')->paginate(6);
        
        $title = 'Category Page';
        $category = Category::when($request->search, function($query) use ($request){
            $query->where('name','LIKE', "%{$request->search}%");
        })->paginate(6);
        $category->appends($request->only('search'));

        return view('admin.category.index',compact('title','category'));
    }

    public function trash()
    {
        $title = 'Trashed Category';
        $category = Category::onlyTrashed()->paginate(6);
        return view('admin.category.trash', compact('title','category'));
    }

    public function restore($id)
    {
        Category::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status','Success Restore Some Data');
    }

    public function kill($id)
    {
        Category::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back()->with('status','Success Delete Some Data');
    }

    public function deleteAll(Request $request)
    {
        $id = $request->id;
        Category::whereIn('id', explode(',',$id))->delete();
        return redirect()->back()->with('status','Success Delete Multiple Data');

    }
}
