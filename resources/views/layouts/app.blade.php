<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield('title')</title> 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-black">DevStagram</a>

                @auth
                    <nav class="flex items-center gap-8"> 
                        <a 
                        href="{{ route('posts.create') }}" 
                        class="flex items-center gap-2 border border-pink-500 hover:bg-gray-200 p-2 rounded text-sm cursor-pointer">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                              </svg>
                                                      
                            Publicar
                        </a>
                        <a class="text-sm text-gray-600 underline" href="{{ route('posts.index', auth()->user()->username) }}">
                            {{ auth()->user()->username }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-cyan-900 hover:text-pink-600 text-sm font-bold">
                                Cerrar sesión
                            </button>
                        </form>
                    </nav>
                @endauth
                @guest
                <nav class="flex gap-8"> 
                    <a class="text-cyan-900 hover:text-pink-600 text-sm font-bold" href="{{ route('login') }}">Login</a>
                    <a class="text-cyan-900 hover:text-pink-600 text-sm font-bold" href={{ route('register') }}>Crear cuenta</a>
                </nav>
                @endguest
               
            </div> 
        </header>
        <main class="container mx-auto mt-10">
            <h2 class="text-3xl text-center font-black mb-10 text-pink-600">
                @yield('title')
            </h2>
            @yield('content')
        </main>
        <footer class="text-center p-5 text-sm text-gray-600">
            DevStagram - {{ now()->year }}
        </footer>

    </body>
</html>
