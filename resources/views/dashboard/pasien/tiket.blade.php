@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">Tiket anda</h1>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Informasi Tiket</h5>
      <ul class="list-group">
        <li class="list-group-item"><strong>Kode Antrian:</strong> {{ $tiket->antrian }}</li>
        <li class="list-group-item"><strong>Kode Poli:</strong> {{ $tiket->kode_poli }}</li>
        <li class="list-group-item"><strong>Nama Pasien:</strong> {{ $tiket->name }}</li>
        <li class="list-group-item"><strong>Waktu:</strong>
          {{ \Carbon\Carbon::parse($tiket->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}</li>
      </ul>
    </div>
  </div>
  <div class="container my-5">
    <div id="status-container">
      <!-- Status tiket akan ditampilkan di sini -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      // Fungsi untuk melakukan poling status tiket
      function checkTiketStatus() {
        $.ajax({
          url: '/check_tiket_status',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            // Data status tiket berhasil diambil, perbarui tampilan
            updateStatus(data);
          },
          error: function(xhr, status, error) {
            // Tangani kesalahan jika ada
            console.error('Error checking tiket status:', status, error);
          },
          complete: function() {
            // Lakukan poling kembali setelah 2 detik
            setTimeout(checkTiketStatus, 5000);
          }
        });
      }

      // Fungsi untuk memperbarui tampilan status tiket
      function updateStatus(status) {
        var statusContainer = $('#status-container');
        if (status !== true) {
          // Jika status tidak true (false atau lainnya), tampilkan pesan "Silahkan tunggu ..."
          statusContainer.html('<h5>Silahkan tunggu ....</h5>');
        } else {
          // Jika status adalah true, tampilkan pesan "Silahkan anda menuju ke poli {{ $tiket->kode_poli }}"
          statusContainer.html('<h5>Silahkan anda menuju ke poli {{ $tiket->kode_poli }}</h5>');
        }
      }

      // Mulai poling ketika halaman dimuat
      $(document).ready(function() {
        checkTiketStatus();
      });
    </script>
  </div>
@endsection
