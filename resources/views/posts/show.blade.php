@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}">
            
            <div>
                @auth
                <livewire:like-post :post="$post" />
                @endauth
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