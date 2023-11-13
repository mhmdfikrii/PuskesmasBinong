@extends('layouts.main')

@section('container')

  <section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h2 class="section-title mb-3">Nomor Antrian</h2>
        </div>
        <!-- Poli-item -->
        @foreach ($polis as $poli)
          <div class="col-lg-4 col-sm-6 my-2 mb-4">
            <div class="d-block match-height border-0 bg-white px-4 py-5 text-center shadow"
              style="width: 300px; height: 230px;">
              <p class="h3">{{ $poli->name }}</p>
              <br>
              @foreach ($antrian as $antrianItem)
                @if ($poli->kode_poli === $antrianItem->kode_poli)
                  @if ($antrianItem->antrian)
                    <p class="fs-1">{{ $antrianItem->antrian }}</p>
                    <p class="mb-0">&nbsp;</p>
                  @else
                    <p class="fs-3">Tidak Ada Antrian</p>
                    <p class="mb-0">&nbsp;</p>
                  @endIf
                @endif
              @endforeach
              <p class="mb-0">&nbsp;</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <h1 class="mb-3 text-center">{{ $title }}</h1>

  @if ($posts->count())
    <div class="card mb-3 mt-3">

      @if ($posts[0]->image)
        <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}"
          class="img-fluid d-block mx-auto rounded" width="500px" height="400px">
      @else
        <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}"
          alt="{{ $posts[0]->category->name }}" class="img-fluid">
      @endif

      <div class="card-body">
        <h3 class="card-title"><a class="text-decoration-none text-dark"
            href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a></h3>
        <p>
          <small>
            <h5>Category <a class="text-decoration-none"
                href="/home?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
            </h5>
          </small>
        </p>
        <p class="card-text">{{ $posts[0]->excerpt }}...</p>
        <p class="card-text"><small class="text-muted">{{ $posts[0]->created_at->diffForHumans() }}</small></p>
        <a class="text-decoration-none btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Baca Selengkapnya</a>
      </div>
    </div>


    <div class="container">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7)">
                <a class="text-decoration-none text-light"
                  href="/home?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
              </div>

              @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                  class="img-fluid d-block mx-auto rounded" width="500px" height="400px">
              @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}"
                  alt="{{ $post->category->name }}" class="img-fluid">
              @endif


              <div class="card-body">
                <h5 class="card-title"><a class="text-decoration-none text-dark"
                    href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h5>
                <p>
                  <small>
                    Created
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                  </small>
                </p>
                <p class="card-text">{{ $post->excerpt }}.</p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Baca Selengkapnya</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    <p class="fs-4 text-center">Post Not Found.</p>
  @endif

  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  </div>
@endsection
