@extends('layouts.app')

@section('title')
    Crea tu cuenta
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center px-3">
        <div class="md:w-4/12 bg-white p-8 rounded-lg shadow-xl">
            <h2 class="text-center text-teal-900 font-thin text-xl">
                @yield('title')
            </h2>
            <p class=" text-center font-thin text-xs text-slate-400 mb-10">
               Rellena tus datos para crear tu cuenta
            </p>

            <form action={{ route('register') }} method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block text-teal-900 font-medium">
                           Nombre
                    </label>
                    <input 
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Tu Nombre"
                        class="border p-3 w-full font-light text-sm rounded-lg @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}"
                    />

                    @error('name')
                        <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block text-teal-900 font-medium">
                        Username
                    </label>
                    <input 
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full font-light text-sm rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('username') }}"
                    />

                    @error('username')
                        <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block text-teal-900 font-medium">
                        Email
                    </label>
                    <input 
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu Email de Registro"
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
                    <label for="password_confirmation" class="mb-2 block text-teal-900 font-medium">
                        Repetir Password
                    </label>
                    <input 
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repite tu Password"
                        class="border p-3 w-full rounded-lg font-light text-sm"
                    />
                </div>

                <input
                    type="submit"
                    value="Crear Cuenta"
                    class="bg-teal-800 hover:bg-teal-900 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-full shadow-lg"                />
            </form>
        </div>
    </div>

@endsection