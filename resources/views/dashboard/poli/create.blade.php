@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
    <h1 class="h2">{{ $title }}</h1>
  </div>

  <div class="m-3">
    <a class="btn btn-primary btn-sm" href="/dashboard/poli"><span data-feather="arrow-left"></span></a>
  </div>

  <div class="col-lg-8">
    <form action="/dashboard/poli" method="post" class="mb-5">
      @csrf
      @method('post')
      <div class="mb-3">
        <label for="name" class="form-label">Nama Poli</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Poli ..."
          value="Poli" id="name" name="name" value="{{ old('name') }}" autofocus>
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="dokter" class="form-label">Nama Dokter</label>
        <select class="form-select" aria-label="Default select example" id="dokter" name="dokter">
          <option value="0" selected>Pilih Dokter</option>
          <hr>
          @foreach ($dokter as $dokter)
            @if ($dokter->status != "1")
              <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
            @endif
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="ruangan" class="form-label">Ruangan</label>
        <select class="form-select" aria-label="Default select example" id="ruangan" name="ruangan">
          <option value="0" selected>Pilih Ruangan</option>
          <hr>
          @foreach ($ruangan as $ruangan)
            @if ($ruangan->status !== 1)
              <option value="{{ $ruangan->kode }}">{{ $ruangan->name }}</option>
            @endif
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="jadwalStart" class="form-label">Jadwal</label>
        <input type="time" name="jadwalStart" id="jadwalStart">
        <input type="time" name="jadwalEnd" id="jadwalEnd">
      </div>

      <div class="mb-3">
        <label for="description">Deskripsi</label>
        <input id="description" type="hidden" name="description" value="{{ old('description') }}">
        <trix-editor input="description"></trix-editor>
      </div>

      <div class="mb-3">
        <label for="isActive" class="form-label">Poli Active ?</label>
        <input type="checkbox" name="isActive" id="isActive">
      </div>


      <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span> Buat
        Poli</button>
    </form>
  </div>

  <script>
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    })
  </script>
@endsection
