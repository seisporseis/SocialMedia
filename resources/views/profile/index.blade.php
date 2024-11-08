@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('content')
<div class="md:flex md:justify-center">
    <div class="md:w-1/2 bg-white shadow p-6">
        <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block text-blue-900 font-bold">
                       Username
                </label>
                <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu Nombre de Usuario"
                    class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    value="{{ auth()->user()->username }}"
                />

                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="image" class="mb-2 block text-blue-900 font-bold">
                       Imagen Perfil
                </label>
                <input 
                    id="image"
                    name="image"
                    type="file"
                    class="border p-3 w-full rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png"
                />
            </div>

            <input
                type="submit"
                value="Guardar Cambios"
                class="bg-pink-500 hover:bg-pink-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>
    </div>
</div>  
@endsection