@extends('layouts.app')

@section('title')
    Nueva publicación 
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form 
            action="{{ route('images.store') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            id="dropzone" 
            class="dropzone w-full h-80 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>

    <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">
        <form 
            action="{{ route('posts.store') }}" 
            method="POST" 
            novalidate>
            @csrf
            <div class="mb-5">
                <label for="title" class="mb-2 block text-teal-900 font-medium">
                    Título
                </label>
                <input 
                    id="title"
                    name="title"
                    type="text"
                    placeholder="¿Qué quieres publicar hoy?"
                    class="border p-3 w-full font-light text-sm rounded-lg @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}"
                />

                @error('title')
                    <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="description" class="mb-2 block text-teal-900 font-medium">
                    Descripción
                </label>
                <textarea 
                    id="description"
                    name="description"
                    placeholder="Escribe un texto para tu post"
                    class="border p-3 w-full font-light text-sm rounded-lg @error('description') border-red-500 @enderror">
                    {{ old('description') }}
                </textarea>

                @error('description')
                    <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <div class="mb-5">
                <input 
                    name="image"
                    type="hidden"
                    value="{{ old('image') }}"
                />
                @error('image')
                    <p class="text-red-600 font-semibold text-sm p-2 text-center">{{ $message }} </p>
                @enderror
            </div>

            <input
                type="submit"
                value="Publicar"
                class="bg-teal-800 hover:bg-teal-900 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-full shadow-lg"
            />
        </form>
    </div>
</div>
@endsection