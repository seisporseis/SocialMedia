@extends('layouts.app')

@section('title')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('content')
<div class="md:flex md:justify-center">
    <div class="md:w-4/12 bg-white p-8 rounded-lg shadow-xl">
        <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
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
                    value="{{ auth()->user()->username }}"
                />

                @error('username')
                    <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="image" class="mb-2 block text-teal-900 font-medium">
                       Foto de perfil
                </label>
                <input 
                    id="image"
                    name="image"
                    type="file"
                    class="border p-3 w-full font-light text-sm rounded-lg"
                    value=""
                    accept=".jpg, .jpeg, .png"
                />
            </div>

            <input
                type="submit"
                value="Guardar Cambios"
                class="bg-teal-800 hover:bg-teal-900 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-full shadow-lg"
            />
        </form>
    </div>
</div>  
@endsection