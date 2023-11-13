@extends('layouts.main')

@section('container')
  <div class="row justify-content-center">
    @foreach ($polis as $poli)
      <div class="col-lg-4 col-sm-6 mb-4">
        <div class="d-block match-height border-0 bg-white px-4 py-5 text-center shadow"
          style="width: 300px; height: 230px;">
          <p class="h2">{{ $poli->name }}</p>
          <br>
          <p class="fs-3" id="antrianInfo{{ $poli->kode_poli }}">Loading...</p>
          <p style="display: none" class="fs-1" id="antrianStatus{{ $poli->kode_poli }}">Loading...</p>
          <p class="mb-0">&nbsp;</p>
        </div>
      </div>
    @endforeach
  </div>
@endsection

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function updateAntrianInfo(poliKode, antrian) {
    if (antrian) {
      $(`#antrianInfo${poliKode}`).text(antrian);
    } else {
      $(`#antrianInfo${poliKode}`).text("Antrian Kosong");
    }
  }

  function updateAntrianStatus(poliKode, status) {
    if (status === true) {
      $(`#antrianStatus${poliKode}`).text("Sedang Dilayani");
    } else {
      $(`#antrianStatus${poliKode}`).text("Menunggu");
    }
  }

  function getAntrianData() {
    $.get("/get-antrian-status", function(data) {
      data.forEach(item => {
        updateAntrianInfo(item.kode_poli, item.antrian || "Antrian Kosong");
        updateAntrianStatus(item.kode_poli, item.status);
      });
    });
  }

  // Mulai polling setiap 5 detik
  setInterval(getAntrianData, 5000);
</script>
