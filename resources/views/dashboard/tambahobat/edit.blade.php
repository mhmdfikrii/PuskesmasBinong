@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">{{ $title }}</h1>
  </div>

  <form action="/dashboard/tambahobat/{{ $obat->kode_obat }}" method="post" class="mb-3">
    @method('put')
    @csrf

    <div class="mb-3">
      <label for="kode_obat" class="form-label">Kode Obat</label>
      <input type="text" disabled class="form-control @error('kode_obat') is-invalid @enderror" id="kode_obat"
        name="kode_obat" placeholder="Masukan Kode Obat" value="{{ old('kode_obat', $obat->kode_obat) }}" autofocus>
      @error('kode_obat')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama_obat" class="form-label">Nama Obat</label>
      <input type="text" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" name="nama_obat"
        placeholder="Masukan Nama Obat" value="{{ old('nama_obat', $obat->nama_obat) }}" autofocus>
      @error('nama_obat')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama_obat" class="form-label">Kategori Obat</label>
      <select class="form-select" aria-label="Default select example" name="kategori_obat">
        <option value="">-- Silakan Pilih Kategori --</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}"
            {{ old('kategori_obat', $obat->kategori_obat) == $category->id ? 'selected' : '' }}>{{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="stok" class="form-label">Stok Obat</label>
      <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
        placeholder="Masukan Stok Obat" value="{{ old('stok', $obat->stok) }}" autofocus>
      @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga Obat</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
        placeholder="Masukan Harga Obat" value="{{ old('harga', $obat->harga) }}" autofocus>
      @error('harga')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Deskripsi Obat</label>
      <div class="form-floating">
        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi ..." style="height: 100px">{{ old('deskripsi', $obat->deskripsi) }}</textarea>
      </div>
    </div>


    <input type="text" name="kode_obat" value="{{ $obat->kode_obat }}" hidden>

    <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span> Update Obat</button>
  </form>
@endsection
