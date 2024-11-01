<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request->get('username'));

        //Validación
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:5|max:20',
            'email' =>'required|unique:users|email',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
    }
}
