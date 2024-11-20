@extends('layouts.app')

@section('title')
   Hola {{$user -> username }}!
@endsection

@section('content')
<div class="flex items-center lg:justify-center flex-col">
    <div class="w-full p-5 flex justify-center items-center lg:gap-10 gap-6">
        <div class="lg:w-2/12 w-2/12">
            <img 
                src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg') }}" 
                alt="imagen perfil usuario"
                class="rounded-full">
        </div>

        <div class="">
            <div class="flex items-center lg:gap-4 gap-2">
                <p class="text-teal-900 text-xl font-bold uppercase">
                    {{ $user->username }}
                </p>
                @auth
                    @if ($user->id === auth()->user()->id)
                    <a href="{{ route('profile.index') }}" class="border border-transparent p-2 rounded-md flex items-center gap-1 text-teal-900 text-xs font-thin hover:underline hover:bg-slate-100 hover:shadow-sm cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                        Editar perfil     
                    </a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center lg:gap-6 py-5">
                <p class="flex flex-col items-center text-teal-900 lg:text-lg mb-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-thin ">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>
        
                <p class="flex flex-col items-center text-teal-900 lg:text-lg mb-3 font-bold">
                    {{ $user->followings->count() }}
                    <span class="font-thin text-lg">@choice('Seguido|Seguidos', $user->followings->count() )</span>
                </p>
        
                <p class="flex flex-col items-center text-teal-900 lg:text-lg mb-3 font-bold">
                   {{ $user->posts->count() }}
                    <span class="font-thin "> Posts</span>
                </p>
            </div>           
            <div class="flex gap-4">
                @auth
                    @if ( $user->id != Auth::user()->id )
                        @if ( !$user->following(Auth::user()) )
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf
                                <input type="submit" value="Seguir" class="bg-teal-800 hover:bg-teal-900 border-teal-800 hover:border-teal-900 text-white cursor-pointer rounded-lg px-4 py-2 border "/>
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <input type="submit" value="Dejar de seguir" class="border-teal-900 hover:bg-slate-100 text-teal-900 cursor-pointer rounded-lg border px-4 py-2"/>
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
    <x-post-list :posts="$posts" />
</section>
@endsection