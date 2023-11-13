@extends('dashboard.layouts.main')

@section('container')
  <div class="row">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
      <h1 class="h2">Pembayaran Users Pasien</h1>
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
            <th scope="col">Nama </th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="search-results">
          @php
            $hasUnpaidData = true; // Inisialisasi variabel bantuan
          @endphp

          @foreach ($pasien as $user)
            @if (
                (!$user->resepObat || !$user->resepObat->notaPembayaran) &&
                    (!$user->suratRujukan || !$user->suratRujukan->notaPembayaran))
              <tr>
                <td>{{ $user->dataAntrian->antrian }}</td>
                <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                <td>{{ $user->dataAntrian->name }}</td>
                <td>
                  <div class="d-flex">
                    <a class="btn btn-success btn-sm" href="/dashboard/pembayaran/form/{{ $user->kode_rekammedis }}">Bayar</a>
                  </div>
                </td>
              </tr>
              @php
                $hasUnpaidData = false; // Set variabel bantuan menjadi true jika ada data yang belum dibayar
              @endphp
            @endif
          @endforeach

          @if ($hasUnpaidData)
            <tr>
              <td colspan="4">
                <div class="my-5">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <!-- Tampilkan pagination links hanya jika ada data yang belum dibayar -->
                      {{ $pasien->links() }}
                    </ul>
                  </nav>
                </div>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

  </div>

  @include('dashboard.layouts.modalPasien')
@endsection
