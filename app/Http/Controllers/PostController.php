<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   public function index(User $user) {

        $posts = Post::where('user_id', $user->id)->simplePaginate(12);

       return view('dashboard', [
        'user' => $user,
        'posts' => $posts
       ]);
   }

   public function create() {
        return view('posts.create');
   }

   public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
            'user_id'

        ]);

       $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('posts.index', Auth::user()->username);
   }

   public function show(User $user, Post $post) {
    return view('posts.show', [
        'post' => $post
    ]);
   }

}
