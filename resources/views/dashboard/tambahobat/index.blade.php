@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
    <h1 class="h2">Tambah Obat Puskesmas</h1>
  </div>

  @if (session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <a class="btn btn-primary mb-3" href="/dashboard/tambahobat/create"><span data-feather="plus"
      class="align-text-bottom"></span> Tambah Obat</a>
  <a class="btn btn-primary mb-3" href="/dashboard/tambahobatcategory"><span data-feather="layout"
      class="align-text-bottom"></span> Category</a>

  <div class="row">
    <div class="col-md-6">
      <form action="/dashboard/tambahobat" method="GET">
        <div class="input-group mb-3">
          <input type="text" name="search" class="form-control" value="{{ request('search') }}"
            placeholder="Cari obat...">
          <button type="submit" class="btn btn-primary"> <span data-feather="search"
              class="align-text-bottom"></span></button>
        </div>
      </form>
    </div>
  </div>


  <div class="table-responsive">
    <table class="table-striped table-sm table">
      <thead>
        <tr>
          <th scope="col">Nomer</th>
          <th scope="col">Kode Obat</th>
          <th scope="col">Nama Obat</th>
          <th scope="col">Kategori</th>
          <th scope="col">Stok</th>
          <th scope="col">Harga Obat</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($obats as $obat)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $obat->kode_obat }}</td>
            <td>{{ $obat->nama_obat }}</td>
            <td>{{ $obat->category->name }}</td>
            <td>{{ $obat->stok }}</td>
            <td>Rp. {{ $obat->harga }}</td>
            <td>



              <a href="/dashboard/tambahobat/{{ $obat->kode_obat }}/edit" class="badge bg-warning"><span
                  data-feather="edit"></span></a>
              <form action="/dashboard/tambahobat/{{ $obat->kode_obat }}" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="text" name="kode_obat" value="{{ $obat->kode_obat }}" hidden>
                <button class="badge bg-danger border-0"
                  onclick="return confirm('Apakah Kamu akan Hapus Obat Ini?')"><span data-feather="trash"></span></button>
              </form>

            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
