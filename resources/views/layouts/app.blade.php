<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield('title')</title> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        @livewireStyles
    </head>

    <body class="h-fit bg-gradient-to-b from-rose-100 to-teal-100 bg-no-repeat">
        <header class="p-5">
            <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
                <a 
                    href="{{ route('home') }}" 
                    class="text-4xl font-bold bg-gradient-to-r from-teal-900 to-rose-500 bg-clip-text text-transparent">
                    DevStagram
                </a>

                @auth
                <nav class="flex flex-col lg:flex-row items-center gap-8"> 
                    <a class="text-sm font-thin text-teal-800" href="{{ route('posts.index', auth()->user()->username) }}">
                      Estás en linea, <span class="underline font-medium cursor-pointer">{{ auth()->user()->username }}</span>
                    </a>

                    <a 
                    href="{{ route('posts.create') }}" 
                    class="flex items-center bg-teal-800 gap-2 hover:bg-teal-900 p-3 rounded-md text-sm text-white shadow-md cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>
                        Publicar
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-teal-900 bg-white rounded-full hover:bg-slate-100 px-4 py-2 shadow-sm">
                            Cerrar sesión
                        </button>
                    </form>
                </nav>
                @endauth
                @guest
                <nav class="flex gap-6"> 
                    <a class="text-teal-900 bg-white rounded-full hover:bg-slate-100 px-4 py-2 shadow-sm" href="{{ route('login') }}">Login</a>
                    <a class="text-teal-900 bg-white rounded-full hover:bg-slate-100 px-4 py-2 shadow-sm" href={{ route('register') }}>Crear cuenta</a>
                </nav>
                @endguest
            </div> 
        </header>
        <main class="container mx-auto mt-10">
            @yield('content')
        </main>
        <footer class="text-center font-thin p-10 text-teal-900">
            Dalia Mercado - {{ now()->year }}
        </footer>
    @livewireScripts
    </body>
</html>
