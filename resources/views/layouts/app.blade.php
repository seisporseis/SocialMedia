<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield('title')</title> 
        @vite('resources/css/app.css')    
    </head>
    <body class="bg-gray-200">
        <header class="p-5 border-b bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">DevStagram</h1>
                <nav> 
                    <a class="text-cyan-900 text-sm" href="/">Login</a>
                    <a class="text-cyan-900 text-sm" href="/create-account">Crear cuenta</a>
                </nav>
            </div> 
        </header>
        <main class="container mx-auto mt-10">
            <h2 class="text-2xl text-center font-black mb-10">
                @yield('title')
            </h2>
            @yield('content')
        </main>
        <footer class="text-center p-5 text-sm text-gray-600">
            DevStagram - {{ now()->year }}
        </footer>

    </body>
</html>