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

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        //cek apakah password dan konfirmasi password sama
        if($request->password == $request->password_confirmation) {
            //store data user ke database
            $user = new User;
                $user->name = ucwords(strtolower($request->name));
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->level = $request->role;
            $user->save();

            //redirect ke index user
            return redirect('')->with('success', 'Data User Berhasil Ditambahkan');
        };

        //redirect ke index user jika password dan konfirmasi password tidak sama
        return redirect('')->with('failed', 'Password tidak sama');
    }
}
