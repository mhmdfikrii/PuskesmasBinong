@extends('layouts.main')

@section('container')
  {{-- <h1 class="mb-5">List Category </h1> --}}

  <div class="container mt-5 mb-4">
    <div class="row">
      @foreach ($categories as $category)
        <div class="col-md-4 mb-3">
          <a href="/home?category={{ $category->slug }}">
            <div class="card text-bg-dark text-white">

              @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-fluid"
                  width="500px" height="400px">
              @else
                <img src="https://source.unsplash.com/500x400?{{ $category->name }}" alt="{{ $category->name }}"
                  class="card-img">
              @endif

              <div class="card-img-overlay d-flex align-items-center p-0">

                {{-- <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                    <div class="card-img-overlay d-flex align-items-center p-0"> --}}
                <h5 class="card-title flex-fill fs-3 p-4 text-center" style="background-color: rgba(0,0,0,0.7)">
                  {{ $category->name }}</h5>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>

  {{-- @foreach ($categories as $category)
    <ul>
        <li>
            <h2><a href="/categories/{{ $category->slug }}">{{ $category->name  }}</a></h2>
        </li>
    </ul>
       
    @endforeach --}}
@endsection
