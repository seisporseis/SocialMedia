<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function middleware(): array 
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }
    public function __invoke() 
    {
        $ids = Auth::user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts
        ]);
    }
}