@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span>
                    Edit</a>

                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="return confirm('Apakah Kamu akan Hapus Postingan Ini?')"><span
                            data-feather="trash"></span> Hapus</button>
                </form>

                <h2 class="mb-3 mt-3">{{ $post->title }}</h2>

                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                        class="img-fluid rounded mx-auto d-block" width="1200px" height="400px">
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                        alt="{{ $post->category->name }}" class="img-fluid">
                @endif


                {{-- <h5>{{ $post->author}}</h5> --}}
                <article class="my-3 fs-6">
                    {!! $post->body !!}
                </article>
            </div>
        </div>
    </div>
@endsection
