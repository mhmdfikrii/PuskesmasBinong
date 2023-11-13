@extends('dashboard.layouts.main')

@section('container')

  <head>
    <!-- Tag-tag lainnya -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <div class="row">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
      <h1 class="h2">Form Resep Obat</h1>
    </div>
    <div class="table-responsive">
      <form id="tambahObatForm" action="/dashboard/resepobat" method="POST">
        @csrf
        <!-- Konten formulir lainnya -->
        @foreach ($obatCategory as $item)
          <h5>{{ $item->name }}</h5>
          <table class="table-striped table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Stok</th>
                <th>Kuantitas</th>
                <th>Catatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($obat as $data)
                @if ($item->id == $data->kategori_obat)
                  <tr>
                    <td>
                      <input type="checkbox" class="item_obat" name="item_obat[]" value="{{ $data->kode_obat }}">
                      <label>{{ $data->nama_obat }}</label>
                    </td>
                    <td>{{ $data->stok }}</td>
                    <td>
                      <input type="number" class="qty" name="qty[{{ $data->kode_obat }}]" value="0">
                    </td>
                    <td>
                      <textarea type="text" class="dosis" name="dosis[{{ $data->kode_obat }}]" placeholder="catatan ..."></textarea>
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        @endforeach
        <input type="hidden" name="kodeRekamMedis" id="kodeRekamMedis" value="{{ $kode_rekamedis }}">
        <button type="submit" id="submitBtn">Tambah Obat</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#tambahObatForm').on('submit', function(e) {
        e.preventDefault();

        var obatList = [];
        var kode_rekammedis = $('#kodeRekamMedis').val();
        $('.item_obat:checked').each(function() {
          var obatId = $(this).val();
          var dosis = $('.dosis[name="dosis[' + obatId + ']"]').val();
          var qty = $('.qty[name="qty[' + obatId + ']"]').val();

          var obatData = {
            obatId: obatId,
            dosis: dosis,
            qty: qty
          };
          console.log(obatData);
          obatList.push(obatData);
        });

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var payload = {
          obatList: obatList,
          kode_rekammedis: kode_rekammedis
        };

        $.ajax({
          url: $(this).attr('action'),
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          data: payload,
          success: function(response) {
            alert('Obat berhasil ditambahkan!');
            // Lakukan tindakan lain setelah obat berhasil ditambahkan
            window.location.href = "/dashboard/resepobat";
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
