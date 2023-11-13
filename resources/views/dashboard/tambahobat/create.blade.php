@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">{{ $title }}</h1>
  </div>
  <form action="/dashboard/tambahobat" method="post" class="mb-3">
    @method('post')
    @csrf

    <div class="mb-3">
      <label for="kode_obat" class="form-label">Kode Obat</label>
      <input type="text" class="form-control @error('kode_obat') is-invalid @enderror" id="kode_obat" name="kode_obat"
        placeholder="Masukan Kode Obat" value="{{ old('kode_obat') }}" autofocus>
      @error('kode_obat')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama_obat" class="form-label">Nama Obat</label>
      <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" name="nama_obat"
        placeholder="Masukan Nama Obat" value="{{ old('nama_obat') }}" autofocus>
      @error('nama_obat')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama_obat" class="form-label">Kategori Obat</label>
      <select class="form-select" aria-label="Default select example" name="kategori_obat">
        {{-- <option disabled selected>Silahkan Pilih Kategori</option> --}}
        <option value="0" selected>Pilih Category</option>
        <hr>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="stok" class="form-label">Stok Obat</label>
      <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
        placeholder="Masukan Stok Obat" value="{{ old('stok') }}">
      @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga Obat</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
        placeholder="Masukan Harga Obat" value="{{ old('harga') }}">
      @error('harga')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Deskripsi Obat</label>
      <div class="form-floating">
        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi ..." style="height: 100px"></textarea>
      </div>
    </div>

    <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span> Tambah Obat</button>
  </form>
@endsection
