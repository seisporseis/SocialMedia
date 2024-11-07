@extends('layouts.app')

@section('title')
    Crea una nueva publicación 
@endsection

@section('content')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        <form action="" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block text-blue-900 font-bold">
                       Titulo
                </label>
                <input 
                    id="titulo"
                    name="titulo"
                    type="text"
                    placeholder="¿Qué quieres publicar hoy?"
                    class="border p-3 w-full rounded-lg font-light @error('name') border-red-500 @enderror"
                    value="{{ old('titulo') }}"
                />

                @error('titulo')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="descripcion" class="mb-2 block text-blue-900 font-bold">
                       Descripción
                </label>
                <textarea 
                    id="descripcion"
                    name="descripcion"
                    placeholder="Escribe un texto para tu post"
                    class="border p-3 w-full rounded-lg font-light @error('name') border-red-500 @enderror"
                >{{ old('descripcion') }}</textarea>

                @error('descripcion')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <input 
                    name="imagen"
                    type="hidden"
                    value="{{ old('imagen') }}"
                />
                @error('imagen')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <input
                type="submit"
                value="Publicar"
                class="bg-pink-500 hover:bg-pink-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
            />
        </form>
    </div>
</div>
@endsection