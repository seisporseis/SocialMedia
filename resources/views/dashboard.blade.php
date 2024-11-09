    @extends('layouts.app')

@section('title')
   Hola {{$user -> username }}!
@endsection

@section('content')

<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5">
            <img 
                src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg')}}" 
                alt="imagen usuario"
                class="rounded-full"
            >
        </div>

        <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
            <div class="flex items-center gap-2">

                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                @auth
                    @if ($user->id === auth()->user()->id)
                    <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-pink-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>     
                    </a>
                    @endif
                @endauth
            </div>
           
            <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                {{ $user->followers->count() }}
                <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
            </p>
    
            <p class="text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followings->count() }}
                <span class="font-normal">@choice('Seguido|Seguidos', $user->followings->count() )</span>
            </p>
    
            <p class="text-gray-800 text-sm mb-3 font-bold">
               {{ $user->posts->count() }}
                <span class="font-normal"> Posts</span>
            </p>

            <div class="flex gap-4">
                @auth
                    @if ( $user->id != Auth::user()->id )
                        @if ( !$user->following(Auth::user()) )
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                                <input type="submit" value="Seguir" class="bg-pink-600 hover:bg-pink-700 hover:border-pink-700 text-white font-bold cursor-pointer rounded-lg px-3 py-1 text-xs border border-pink-600"/>
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <input type="submit" value="Dejar de seguir" class="border border-pink-500 hover:bg-gray-200 font-bold cursor-pointer rounded-lg px-3 py-1 text-xs"/>
                            </form>
                        @endif
                    @endif
               
            @endauth
            </div>
           
        </div>
    </div>
</div>

<section class="container mx-auto mt-10">
    <h2 class="text-3xl text-center font-bold my-10">Publicaciones</h2>

    @if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post )
        <div class="shadow-lg hover:shadow-xl">
            <a href="{{ route('posts.show',['post' => $post, 'user' => $user]) }}">
                <img src="{{ asset('uploads'). '/' . $post->image }}" alt="imagen de la publicación llamada {{ $post->title}}">
            </a>
        </div>
        @endforeach
    </div>

    <div class="my-10 text-center">
        {{ $posts->links() }}
    </div>
    @else
        <p class="text-sm text-center text-gray-500 p-5">No hay publicaciones</p>
    @endif
</section>
@endsection