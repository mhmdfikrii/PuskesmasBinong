@extends('dashboard.layouts.main')

@section('container')
  <style>
    .table-custom {
      /* Set lebar tabel menjadi 100% */
      table-layout: fixed;
      /* Tetapkan layout tabel ke "fixed" */
    }

    .table-custom th,
    .table-custom td {
      width: auto;
      /* Set lebar kolom menjadi otomatis */
      overflow-wrap: break-word;
      /* Pecah kata jika terlalu panjang */
    }
  </style>

  <head>
    <!-- Tag-tag lainnya -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <div class="row my-5">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
      <h1 class="h2">Form Pembayaran Pasien</h1>
    </div>
    <div class="table-responsive">
      <form action="/dashboard/pembayaran/notapembayaran" method="POST">
        @csrf
        <!-- card pelayanan -->
        <div class="card mt-4">
          <div class="card-header">
            History Pelayanan
          </div>
          <div class="card-body">
            <?php $total = 0; ?>
            @foreach ($pelayananUser as $userItem)
              <div class="card mb-3">
                <div class="card-body">
                  @foreach ($pelayanan as $layanan)
                    @if ($layanan->id == $userItem->pelayanan_id)
                      <h5 class="card-title">{{ $layanan->layanan }}</h5>
                    @endif
                  @endforeach
                  <p>Biaya: {{ $userItem->biaya }}</p>
                  <?php $total += $userItem->biaya; ?>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <!-- card obat -->
        @if ($dataResepObat !== null)
          <div class="card mt-4">
            <div class="card-header">
              History Resep Obat
            </div>
            <div class="card-body">
              @foreach ($dataResepObat as $resepObat)
                <div class="card mb-3">
                  <div class="card-body">
                    <h5 class="card-title">{{ $resepObat->kode_obat }}</h5>
                    @foreach ($obats as $obat)
                      @if ($obat->kode_obat == $resepObat->kode_obat)
                        <p>Nama Obat: {{ $obat->nama_obat }}</p>
                        <p>Biaya: {{ $obat->harga * $resepObat->qty }}</p>
                        <?php
                        $total += $obat->harga * $resepObat->qty;
                        ?>
                      @endif
                    @endforeach
                    <p class="card-text">Kuantitas: {{ $resepObat->qty }}</p>
                    <p class="card-text">Catatan: {{ $resepObat->dosis }}</p>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="container my-3 px-3 py-2">
              <h3>Total : Rp{{ $pasien->dataAntrian->user->bpjs !== null ? 0 : $total }}</h3>
            </div>
        @endif
    </div>
    @if ($status !== 'rujukan')
      <input type="hidden" name="kode_resepobat" value="{{ $dataKode }}">
    @else
      <input type="hidden" name="kode_rujukan" value="{{ $dataKode }}">
    @endif
    <input type="hidden" name="total" value="{{ $pasien->dataAntrian->user->bpjs !== null ? 0 : $total }}">
    <button type="submit" class="btn btn-primary mt-3" id="submitBtn">Tambah Nota</button>
    </form>
  </div>
  </div>
@endsection
