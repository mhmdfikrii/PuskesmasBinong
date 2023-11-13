@extends('layouts.main')

@section('container')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="mb-3">{{ $post->title }}</h2>
        <h5>Category <a style="text-decoration:none" href="/home?category={{ $post->category->slug }}">
            {{ $post->category->name }}
          </a></h5>
        @if ($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
            class="img-fluid d-block mx-auto rounded" width="500px" height="400px">
        @else
          <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" alt="{{ $post->category->name }}"
            class="img-fluid">
        @endif
        <article class="fs-6 my-3">
          {!! $post->body !!}
        </article>

        <a href="/home" class="d-block mt-4 mb-5">Back Page</a>
      </div>
    </div>
  </div>
@endsection
