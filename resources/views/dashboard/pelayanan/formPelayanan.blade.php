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
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
      <h1 class="h2">Form Pelayanan Pasien</h1>
    </div>
    <div class="table-responsive">
      <form id="tambahNotaPembayaran" action="/dashboard/pelayanan" method="POST">
        @csrf
        <!-- Konten formulir lainnya -->
        @foreach ($categoryPelayanan as $category)
          <h5>{{ $category->nama_category }}</h5>
          <table class="table-striped table-custom table">
            <thead>
              <tr>
                <th>Nama</th>
                <th class="text-center">Stok</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pelayanan as $layanan)
                @if ($layanan->category == $category->id)
                  <tr>
                    <td>
                      <input type="checkbox" class="item_layanan" name="item_layanan[]" value="{{ $layanan->id }}">
                      <label>{{ $layanan->layanan }}</label>
                    </td>
                    <td class="text-center">Rp{{ number_format($layanan->biaya, 0, ',', '.') }}</td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        @endforeach
        <input type="hidden" name="kode_rekammedis" class="kode_rekammedis" id="kode_rekammedis"
          value="{{ $kodeRekammedis }}">
        <button type="submit" class="btn btn-primary" id="submitBtn">Tambah Pelayanan</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tambahNotaPembayaran').on('submit', function(e) {
        e.preventDefault();

        let layananList = [];
        let kodeRekammedis = '';
        // get param tindakan
        var urlParams = new URLSearchParams(window.location.search);
        var tindakan = urlParams.get('tindakan');

        $('.item_layanan:checked').each(function() {
          let layananID = $(this).val();
          let harga = $(this).closest('tr').find('td:last-child').text();
          kodeRekammedis = document.getElementById('kode_rekammedis').value;

          // Menghapus karakter non-digit dari string
          let hargaNumerik = parseFloat(harga.replace(/[^0-9.-]+/g, ""));

          let layananData = {
            id: layananID,
            biaya: hargaNumerik * 1000,
          };

          layananList.push(layananData);
        });


        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        let payload = {
          layananList: layananList,
          kodeRekammedis: kodeRekammedis
        };

        console.log(payload)

        $.ajax({
          url: $(this).attr('action'),
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          data: payload,
          success: function(response) {
            alert('Pelayanan berhasil ditambahkan!');
            if (tindakan != "surat-rujukan") {
              window.location.href = "/dashboard/resepobat/form/" + kodeRekammedis;
            } else {
              window.location.href = "/dashboard/suratrujukan/form/" + kodeRekammedis;
            }
          },
          error: function(xhr, status, error) {
            // Respon error dari server
            if (xhr.responseJSON && xhr.responseJSON.errors) {
              // Terdapat pesan kesalahan yang dikirimkan oleh server
              var errorMessages = xhr.responseJSON.errors;
              alert('Terjadi kesalahan: ' + errorMessages.join('\n'));
            } else {
              // Pesan kesalahan umum
              alert('Terjadi kesalahan. Silakan coba lagi!');
            }
            console.log(xhr.responseText);
          }
        });
      });
    });
  </script>
@endsection
