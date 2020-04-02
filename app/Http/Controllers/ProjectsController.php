<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'title' => 'required|min:3',
            'technology' => 'required',
            'deskripsi' => 'required|min:10'
        ]);

        Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'technology' => $request->technology,
            'deskripsi' => $request->deskripsi,
            'slug' => Str::slug($request->title)
        ]);

        return redirect()->back()->with('status','Success Add New Project, Great !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projects = Project::findOrFail($id);
        echo json_encode($projects);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|min:3',
            'technology' => 'required',
            'deskripsi' => 'required|min:10'
        ]);

        Project::where('id', $project->id)
                ->update([
                        'user_id' => Auth::id(),
                        'title' => $request->title,
                        'technology' => $request->technology,
                        'deskripsi' => $request->deskripsi,
                        'slug' => Str::slug($request->title)
                    ]);

        return redirect()->back()->with('status','Success Edit Project, Great !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Project::destroy($project->id);
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }
}
