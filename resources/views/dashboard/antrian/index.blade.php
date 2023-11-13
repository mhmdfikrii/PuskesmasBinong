@extends('dashboard.layouts.main')

@section('container')
  <div class="row justify-content-center my-4">
    <div class="col-12 text-center">
      <h2 class="section-title mb-3">Nomor Antrian</h2>
    </div>
    <!-- Poli-item -->
    @foreach ($polis as $poli)
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="d-block match-height border-0 bg-white px-4 py-5 text-center shadow"
          style="width: 300px; height: 230px;">
          <p class="h3">{{ $poli->name }}</p>
          <br>
          @foreach ($antrian as $antrianItem)
            @if ($poli->kode_poli == $antrianItem->kode_poli)
              @if ($antrianItem->antrian)
                <p class="fs-1">{{ $antrianItem->antrian }}</p>
                <p class="mb-0">&nbsp;</p>
              @else
                <p class="fs-3">Tidak Ada Antrian</p>
                <p class="mb-0">&nbsp;</p>
              @endIf
            @endif
          @endforeach
        </div>
      </div>
    @endforeach

    @if ($antrianPasien !== null)
      <div class="col-lg-12 col-sm-12 mb-5 text-center">
        <form action="/dashboard/tiket/{{ $antrianPasien->kode_antrian }}" method="post">
          @csrf
          @method('delete')
          <button class="border-0" type="submit" onclick="return confirm('Apakah Kamu akan Hapus Tiket Antrian Ini?')">
            <div class="text-light d-block bg-danger match-height border-0 px-4 py-5 text-center shadow"
              style="height: 150px;">
              <p class="h3">Batalkan Tiket Antrian</p>
            </div>
          </button>
        </form>
      </div>
      <div class="col-lg-12 col-sm-12 mb-5">
        <a href="/dashboard/tiket" style="text-decoration: none">
          <div class="text-light d-block bg-success match-height border-0 px-4 py-5 text-center shadow"
            style="height: 150px;">
            <p class="h3">Tiket Antrian Anda</p>
          </div>
        </a>
      </div>
    @else
      <div id="daftar-antrian" class="col-lg-12 col-sm-12 mb-5" style="cursor: pointer">
        <div class="text-light d-block bg-primary match-height border-0 px-4 py-5 text-center shadow"
          style="height: 150px;">
          <p class="h3">Daftar Antrian</p>
        </div>
      </div>
    @endif
    {{-- Data daftar antrian --}}
    <div id="form-data" class="row justify-content-center" style="display: none">
      @auth
        <div class="col-12 text-center">
          <h2 class="section-title my-2">Daftar Antrian</h2>
        </div>
        <div class="col-lg-6 col-sm-6">
          @include('dashboard/antrian/formAntrian')
          <button id="tombol-close" class="btn btn-success mb-5">Close</button>
        </div>
      @endauth
    </div>
  </div>
  <script>
    $(document).ready(function() {
      // Event onClick pada tombol "Tambah Data"
      $('#daftar-antrian').on('click', function() {
        // Tampilkan form
        $('#form-data').show();
        $('#daftar-antrian').hide();
      });

      // Event onClick pada tombol "Close"
      $('#tombol-close').on('click', function() {
        // Sembunyikan form
        $('#form-data').hide();
        $('#daftar-antrian').show();
      });
    });
  </script>
@endsection
