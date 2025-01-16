<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 xl:mx-10">
            @foreach($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Imagen del post {{ $post->title }}">
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10 xl:mx-10">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-center text-teal-900 font-thin py-20 ">Todavía no tienes publicaciones</p>
    @endif
</div>