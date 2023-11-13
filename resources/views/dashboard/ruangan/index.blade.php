@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">List Ruangan Puskesmas</h1>
  </div>

  <div class="table-responsive">
    <a href="/dashboard/ruangan/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Buat Baru</a>

    @if (session()->has('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <table class="table-striped table-sm table">
      <thead>
        <tr>
          <th scope="col">Nomer</th>
          <th scope="col">Kode</th>
          <th scope="col">Nama</th>
          <th scope="col">status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $ruangan)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ruangan->kode }}</td>
            <td>{{ $ruangan->name }}</td>
            <td>{!! $ruangan->status
                ? '<span class="badge bg-success">terisi</span>'
                : '<span class="badge bg-danger">kosong</span>' !!}</td>
            <td>
              <div class="d-flex m-1 gap-1">
                <a class="badge bg-success border-0" href="/dashboard/ruangan/{{ $ruangan->kode }}/edit"><span
                    data-feather="edit"></span></a>
                <form action="/dashboard/ruangan/{{ $ruangan->kode }}" method="post">
                  @csrf
                  @method('delete')
                  <button onclick="return confirm('Apakah Kamu akan Hapus Postingan Ini?')"
                    class="badge bg-danger border-0"><span data-feather="trash"></span></button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
