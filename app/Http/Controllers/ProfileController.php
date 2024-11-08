<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }

    public function store(Request $request) {

        $request->request->add([
            'username' => Str::slug($request->username)
        ]);
        
        $request->validate([
            'username' => [
                'required', 
                'min:5', 
                'max:20',
                Rule::unique('users', 'username') ->ignore(Auth::user())
            ],
        ]);

        if($request->image) {
            $image = $request->file('image');

            $imageName = Str::uuid(). "." .$image->extension();
    
            $manager = new ImageManager(new Driver);
    
            $serverImage = $manager::imagick()->read($image);
            $serverImage->cover(1000,1000);
    
            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        } 

        $usuario = User::find(Auth::user()->id);
        $usuario->username = $request->username;
        $usuario->image =  $imageName ?? Auth::user()->image ?? '';
        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }
}
