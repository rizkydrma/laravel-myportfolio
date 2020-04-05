<?php

namespace App\Http\Controllers;

use App\Project;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use File;

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
            'deskripsi' => 'required|min:10',
            'image' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);

        // simpan data image yang di upload ke variabel image
        $image = $request->file('image');
        $imageName = time()."project_".$image->getClientOriginalName();
        
        // path tujuan file/image akan di simpan 
        $path = 'img/project';
        
        // simpan data post ke database
        $project = Project::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'technology' => $request->technology,
            'deskripsi' => $request->deskripsi,
            'image' => $imageName,
            'slug' => Str::slug($request->title)
        ]);

        
        // pindahkan file/image yang di upload ke dalam folder path
        $image->move($path,$imageName);
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
            'deskripsi' => 'required|min:10',
        ]);
        
        // simpan data image yang di upload ke variabel image
        $image = $request->file('image');
        // deklarasi path tujuan upload
        $path = 'img/project';
        // deklarasi data yang akan diubah
        $projectData = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'technology' => $request->technology,
            'deskripsi' => $request->deskripsi,
            'slug' => Str::slug($request->title)
        ];
        if($request->has('image')){
            // validasi kembali image yang akan di upload
            $request->validate([
                'image' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            ]);
            // deklarasi nama image baru
            $imageNew = time()."project_".$image->getClientOriginalName();
            // pindahkan file/image yang di upload ke dalam folder path
            $image->move($path,$imageNew);
            // push data image ke dalam array postData agar tersimpan di DB
            $projectData += ['image' => $imageNew];
        }

        Project::where('id', $project->id)
                ->update($projectData);

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
        File::delete('img/project/'.$project->image);
        Project::destroy($project->id);
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }
}
