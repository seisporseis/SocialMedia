@extends('layouts.app')

@section('title')
    Feed principal
@endsection

@section('content')
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post )
            <div class="shadow-lg hover:shadow-xl">
                <a href="{{ route('posts.show',['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads'). '/' . $post->image }}" alt="imagen de la publicación llamada {{ $post->title}}">
                </a>
            </div>
            @endforeach
        </div>

        <div class="my-10 text-center">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-sm text-center font-thin">Empieza a ser seguidor para ver sus publicaciones aquí</p>
    @endif
@endsection