<?php

namespace App\Http\Controllers;

use App\Bio;
use App\User;
use App\Skill;
use App\Project;
use Illuminate\Http\Request;

use Auth;

class BiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Bio';
        $user = User::where('id', Auth::id())->get();
        $skills = Skill::where('user_id', Auth::id())->get();
        $projects = Project::latest()->paginate(3);

        session(['active' => 'bio']);

        return view('admin.bio.index', compact('title','skills','projects'))->with('user', $user);
    }

    public function update(Request $request, Bio $bio)
    {
        $request->validate([
            'about' => 'required|min:20'
        ]);

        Bio::where('id', $bio->id)
                ->update([
                    'about' => $request->about,
                    'user_id' => Auth::id()
                ]);
        return redirect()->back()->with('status', 'Success Edit About');
    }

    public function store_skill(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'percentase' => 'required',
            'color' => 'required'
        ]);

        Skill::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'percentase' => $request->percentase,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('status','Success Add New Skill, Great!');
    }

    public function edit_skill($id)
    {
        $skills = Skill::findOrFail($id);
        echo json_encode($skills);
    }

    public function update_skill(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required',
            'percentase' => 'required',
            'color' => 'required'
        ]);

        Skill::where('id', $skill->id)
                ->update([
                    'name' => $request->name,
                    'percentase' => $request->percentase,
                    'color' => $request->color,
                ]);
        return redirect()->back()->with('status', 'Success Edit Skill, Great !');

    }

    public function delete_skill(Skill $skill)
    {
        Skill::destroy($skill->id);
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }
}
