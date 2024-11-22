@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto justify-between items-center p-10">
        <div class="flex flex-col xl:flex-row md:w-full justify-center gap-6">      
            <div class="w-full xl:w-1/2">
                <img 
                class="shadow-lg" 
                src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}">                
            </div>

            <div class="w-full xl:w-1/2">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth

                <p class="font-bold text-teal-900 text-lg"> {{ $post->user->username }} </p>
                <p class="font-thin text-xs text-slate-400">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5 font-light">
                    {{ $post->description }}
                </p>
                @auth
                    @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE')
                        @csrf
                        <button class="flex gap-2 items-center mt-2 p-2  text-xs underline cursor-pointer border border-transparent  rounded-md text-teal-900  hover:bg-slate-100 hover:shadow-sm ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <input 
                                type="submit" 
                                value="Eliminar publicación"
                                class="hover:text-red-700 hover:underline text-xs font-semibold cursor-pointer">
                        </button>
                    </form>
                    @endif
                @endauth
            </div>            
        </div>

        <div class="mt-10 w-full px-1 justify-center gap-6 ">
            <div class="shadow bg-white p-5 mb-5 rounded-md">
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
                        class="bg-teal-800 hover:bg-teal-900 transition-colors cursor-pointer font-bold px-6 py-2 text-white rounded-full shadow-lg"
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