@extends('dashboard.layouts.main')

@section('container')
  <div class="row">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
      <h1 class="h2">Transaksi Users Pasien</h1>
    </div>

    <div class="table-responsive col-lg-6">
      <div class="row">
        <div class="col-md-6">
          <form id="search-form" onkeypress="return event.keyCode != 13;" action="{{ route('listUser') }}" method="GET">
            @csrf
            <div class="input-group mb-3">
              <input autocomplete="off" type="text" name="search" class="form-control"
                placeholder="Cari NIK / Nama .." id="search-input">
              <button type="submit" class="btn btn-primary"> <span data-feather="search"
                  class="align-text-bottom"></span></button>
            </div>
          </form>
        </div>
      </div>


      @if (session()->has('status'))
        <div class="alert alert-success alert-dismissible fade show col-lg-10" role="alert">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <table class="table-striped table-sm table">
        <thead>
          <tr>
            <th scope="col">Nomer</th>
            <th scope="col">Date</th>
            <th scope="col">status </th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="search-results">
          @foreach ($notaPembayaran as $pembayaran)
            <tr>
              <td>{{ $pembayaran->kode_notapembayaran }}</td>
              <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
              </td>
              <td>
                @if ($pembayaran->transaksi->status == 'Pending')
                  <a style="text-decoration: none" class="badge bg-primary border-0">Pending</a>
                @endif
                @if ($pembayaran->transaksi->status == 'Settled')
                  <a style="text-decoration: none" class="badge bg-success border-0">Settled</a>
                @endif
                @if ($pembayaran->transaksi->status == 'Failed')
                  <a style="text-decoration: none" class="badge bg-danger border-0">Failed</a>
                @endif
              </td>
              <td>
                <div class="d-flex gap-2">
                  <form action="/dashboard/transaksi/{{ $pembayaran->transaksi->invoice }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" style="text-decoration: none"
                      class="badge bg-{{ $pembayaran->transaksi->status != 'Settled' ? 'danger' : 'success' }} border-0" onclick="return confirm('Apakah sudah Bayar?')">Bayar</button>
                  </form>
                  <a class="badge bg-primary border-0" style="text-decoration: none"
                    href="/dashboard/transaksi/{{ $pembayaran->kode_notapembayaran }}"><span
                      data-feather="eye"></span></a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="my-5">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          {{ $notaPembayaran->links() }}
        </ul>
      </nav>
    </div>
  </div>
@endsection
