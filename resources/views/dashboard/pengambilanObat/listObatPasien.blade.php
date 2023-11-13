@extends('dashboard.layouts.main')

@section('container')
  <div class="container mb-5">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
      <h1 class="h2">Pengambilan Obat</h1>
    </div>

    @if (session()->has('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form class="container" action="/dashboard/ambilobat/s/{{ $kodeResepObat }}" method="post">
      @csrf
      @method('put')
      <button class="btn btn-primary" type="submit">Selesai</button>
    </form>
    <!-- card pelayanan -->
    <div class="card my-5">
      <div class="card-header">
        List Pengambilan Obat
      </div>
      <div class="card-body">
        @foreach ($resepObat as $resep)
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">{{ $resep->kode_resep_obat }}
              </h5>
              @foreach ($obat as $obat_resep)
                @if ($obat_resep->kode_obat == $resep->kode_obat)
                  <p>Nama Obat : {{ $obat_resep->nama_obat }}</p>
                  <p>Stok yang diambil : {{ $resep->qty }}</p>
                  @if ($resep->status !== 1)
                    <p>Stok yang tersedia : {{ $obat_resep->stok }}</p>
                  @endif
                  <p style="font-weight: bold">Catatan : {{ $resep->dosis }}</p>
                @endif
              @endforeach
              @if ($resep->status !== 1)
                <h3 class="text-center">Obat Belum Diambil</h3>
              @else
                <h3 class="text-center">Obat Telah Diambil</h3>
              @endif
            </div>
          </div>
      </div>
      @endforeach
    </div>
  </div>
@endsection
