@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}">
            
            <div class="p-3 flex items-center gap-2">
                @auth
                    @if ($post->checkLike(Auth::user()))
                        <form method="POST" action="{{ route('posts.likes.destroy', $post) }}">
                            @method('DELETE')
                            @csrf
                            <div class="my-4">
                                <button type="submit" class="pt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#dc2626" viewBox="0 0 24 24" stroke-width="1" stroke="#dc2626" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ route('post.likes.store', $post) }}">
                            @csrf
                            <div class="my-4">
                                <button type="submit" class="pt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif
                @endauth

                <p class="font-bold text-xs"> 
                    {{ $post->likes->count()}} 
                    <span class="font-light text-xs">Likes</span>
                </p>
            </div>
           
           
            <div>
                <p class="font-bold"> {{ $post->user->username }} </p>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->description }}
                </p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                <form method="POST" action="{{ route('posts.destroy', $post) }}">
                    @method('DELETE')
                    @csrf
                    <input 
                        type="submit" 
                        value="Eliminar publicación"
                        class="hover:text-red-700 hover:underline text-xs font-semibold my-5 p-2 cursor-pointer"
                        >
                </form>
                @endif
            @endauth
        </div>

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                @if (session('message'))
                    
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center">
                        {{ session('message')}}
                    </div>
            
                @endif

                <form action="{{ route('comments.store',['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comment" class="mb-2 block text-gray-400 font-thin text-xs text-center">
                               Agrega un comentario aquí
                        </label>
                        <textarea 
                            id="comment"
                            name="comment"
                            placeholder="Escribe aquí un comentario"
                            class="border p-3 w-full rounded-lg font-light @error('name') border-red-500 @enderror"
                        >{{ old('comment') }}</textarea>
        
                        @error('comment')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                        @enderror
                    </div>

                    <input
                        type="submit"
                        value="Comentar"
                        class="bg-pink-500 hover:bg-pink-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                    />
                </form>
                @endauth

                <div class="shadow bg-white my-5 max-h-96 overflow-y-scroll">
                   @if ($post->comments->count())
                    @foreach ($post->comments as $comment)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('posts.index', $comment->user) }}" class="font-bold hover:text-pink-600 hover:underline">
                                {{ $comment->user->username }}
                            </a>

                            <p class="text-gray-900 py-2">
                                {{ $comment->comment }}
                            </p>

                            <p class="text-xs font-thin text-gray-400">             
                                {{$comment->created_at->diffForHumans()}}
                            </p>
                        </div>
                    @endforeach
                   @else
                    <p class="text-sm text-center text-gray-500 p-5">
                        No hay comentarios
                    </p>
                   @endif
                </div>
                
            </div>
        </div>
   
    </div>
@endsection