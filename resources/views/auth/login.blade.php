@extends('layouts.app')

@section('title')
   Ingresa a tu cuenta
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center px-3">
        <div class="md:w-4/12 bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-center text-teal-900 font-thin text-xl">
                @yield('title')
            </h2>
            <p class="text-center font-thin text-xs text-slate-400 mb-10">
                Escribe tu email y tu contraseña para ingresar
            </p>
            
            <form method="POST" action={{ route('login') }} novalidate>
                @csrf
                @if (session('advertencia'))
                    <p class="text-red-600 font-semibold text-sm p-2 text-center">
                        {{ session('advertencia') }} 
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block text-teal-900 font-medium">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Escribe tu email"
                        class="border p-3 w-full font-light text-sm rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block text-teal-900 font-medium">
                        Password
                    </label>
                    <input 
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password de Registro"
                        class="border p-3 w-full font-light text-sm rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">     
                    <input type="checkbox" name="remember" class="mr-2">
                        <label for="remember" class="text-teal-900 font-medium text-sm">
                            Recordar mi cuenta
                        </label>
                </div>
                <input
                    type="submit"
                    value="Iniciar sesión"
                    class="bg-teal-800 hover:bg-teal-900 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-full shadow-lg"
                />
            </form>
        </div>
    </div>

@endsection