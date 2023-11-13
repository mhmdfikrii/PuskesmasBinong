@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">List Poli Puskesmas</h1>
  </div>

  <div class="table-responsive">
    <a href="/dashboard/poli/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Buat Baru</a>

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
          <th scope="col">Nama</th>
          <th scope="col">Dokter</th>
          <th scope="col">Ruangan</th>
          <th scope="col">Jadwal</th>
          <th scope="col">Active</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $poli)
          <tr>
            <td>{{ $poli->kode_poli }}</td>
            <td>{{ $poli->name }}</td>
            <td>{{ $poli->dataDokter->name }}</td>
            <td>{{ $poli->ruangan }}</td>
            <td>{{ $poli->jadwal . ' WIB' }}</td>
            <td>
              @if ($poli->isActive == 1)
                <form action="/dashboard/poli/status/{{ $poli->kode_poli }}" method="POST">
                  @csrf
                  @method('put')
                  <button type="submit" class="badge bg-success border-0"
                    onclick="return confirm('Apakah Kamu akan Non Aktifkan Poli Ini?')">active</button>
                </form>
              @else
                <form action="/dashboard/poli/status/{{ $poli->kode_poli }}" method="POST">
                  @csrf
                  @method('put')
                  <button type="submit" class="badge bg-danger border-0"
                    onclick="return confirm('Apakah Kamu akan Aktifkan Poli Ini?')">non active</button>
                </form>
              @endif
            </td>

            <td>
              <div class="d-flex gap-2">
                {{-- <a href="/dashboard/poli/{{ $poli->kode_poli }}/edit" class="badge bg-success border-0"><span
                    data-feather="edit"></span></a> --}}
                <form action="/dashboard/poli/{{ $poli->kode_poli }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="badge bg-danger border-0"
                    onclick="return confirm('Apakah Kamu akan Hapus Postingan Ini?')"><span
                      data-feather="trash"></span></button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
