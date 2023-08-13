<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $user = User::all();
        return view('pages.user.index', ['user' => $user]);
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request) 
    {
        //validasi data user yang akan ditambahkan
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);

        //store data user ke database
        $user = new User;
            $user->name = ucwords(strtolower($request->name));
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->level = $request->role;
        $user->save();

        //redirect ke index user
        return redirect('user')->with('success', 'Data User Berhasil Ditambahkan');
    }

    public function edit($id) 
    {
        $user = User::find($id);
        return view('pages.user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'role' => 'required',
        ]);

        $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = $request->role;
        $user->update();

        return redirect('user')->with('success', 'Data user berhasil diperbaharui');
    }

    public function delete($id)
    {
        User::find($id)->delete();

        return redirect('user')->with('success', 'Data user berhasil dihapus');
    }
}
