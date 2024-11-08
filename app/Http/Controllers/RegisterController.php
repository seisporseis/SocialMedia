<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->request->add([
            'username' => Str::slug($request->username)
        ]);
        
        //Validación
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:5|max:20',
            'email' =>'required|unique:users',
            'password' => 'required|confirmed|min:6'          
        ]);

        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);

        return redirect()->route('posts.index', Auth::user()->username);

    }

}
