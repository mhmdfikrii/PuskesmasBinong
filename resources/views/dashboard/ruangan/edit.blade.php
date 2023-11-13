@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/ruangan/{{ $ruangan->kode }}" method="post" class="mb-5">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="kode" class="form-label">Kode Ruangan</label>
                <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode"
                    value="{{ old('kode', $ruangan->kode) }}" autofocus>
                @error('kode')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Ruangan</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $ruangan->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span> Buat Post</button>
        </form>

    </div>
@endsection
