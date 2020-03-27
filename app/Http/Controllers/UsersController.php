<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User Page';
        $users = User::paginate(6);

        session(['active' => 'user']);
        return view('admin.user.index', compact('title','users'));
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|required_with:password_confirmation|confirmed',
            'password_confirmation' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back()->with('status', 'Success Add Some User');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('title','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        // simpan data update ke sebuah variable
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            // memastikan role yang di input harus menjadi integer
            'role' => intval($request->role)
        ];

        //Cek jika user menginput password baru
        if($request->input('password')){
            // Validasi kembali password yang di inputkan user
            $request->validate([
                'password' => 'required|required_with:password_confimation|confirmed',
                'password_confirmation' => 'required'
            ]);

            // Push password ke variable user data
            $userData['password'] = bcrypt($request->password);
        }

        User::where('id', $id)
            ->update($userData);

        return redirect()->route('user.index')->with('status', 'Success Update Some User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('status','Success Delete Some User');
    }

    public function search(Request $request)
    {
        $title = 'User Page';
        $users = User::when($request->search, function($query) use ($request){
            $query->where('name','LIKE',"%{$request->search}%");
        })->paginate(6);
        $users->appends($request->only('search'));

        return view('admin.user.index',compact('title','users'));
    }

    public function trash()
    {
        $title = 'Trashed User';
        $users = User::onlyTrashed()->paginate(6);

        return view('admin.user.trash', compact('title','users'));
    }

    public function restore($id)
    {
        User::withTrashed()->where('id', $id)->restore();
        return redirect()->back()->with('status', 'Success Restore Some Data');
    }

    public function kill($id)
    {
        User::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back()->with('status', 'Success Delete Some Data');
    }

    public function deleteAll(Request $request)
    {
        User::whereIn('id', explode(',', $request->id))->delete();
        return redirect()->back()->with('status', 'Success Delete Multiple Data');
    }
}
