@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
    <h1 class="h2">Form Rujukan</h1>
  </div>
  <div class="row my-3 px-3">
    <div class="col-10">
      <form action="/dashboard/suratrujukan/{{ $kode_rekammedis }}" method="post" class="mb-3">
        @method('post')
        @csrf
        <div class="mb-3">
          <h5 for="antrian" class="form-label">Kode Rekap Surat Rujukan :</h5>
          <input class="form-control" autofocus type="text" name='kode_rujukan' id='kode_rujukan'>

        </div>
        <input type="hidden" name="kode_rekammedis" id="kode_rekammedis" value="{{ $kode_rekammedis }}">
        <div class="mb-3">
          <h5 for="antrian" class="form-label">Fasilitas perujuk dengan alasan :</h5>
          <div class="checkbox-btn my-3">
            <div class="btn-group-vertical gap-3" role="group" aria-label="Vertical radio toggle button group">
              <div class="checkbox1">
                <input type="checkbox" name="fasilitas" value="Perlu Pemeriksaan Penunjang">
                <label for="fasilitas">Perlu pemeriksaan penunjang</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" value="Masih membutuhkan terapi lanjut" name="fasilitas">
                <label for="fasilitas">Masih membutuhkan terapi lanjut</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" value="Followup terapi sebelummnya" name="fasilitas">
                <label for="fasilitas">Followup terapi sebelummnya</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" name="fasilitas" id="btn-lainnya1">
                <label for="vbtn-radio4">Lainnya ...</label>
              </div>
            </div>
          </div>
          <div id="lainnya-input1" style="display: none;">
            <input type="text" id="lainnya-text1" class="form-control mt-3" name="fasilitas"
              placeholder="Masukkan alasan lainnya">
          </div>
        </div>

        <div class="mb-3">
          <h5 for="antrian" class="form-label">Rencana tindak lanjut pada kunjungan selanjutnya :</h5>
          <div class="checkbox-btn my-3">
            <div class="btn-group-vertical gap-3" role="group" aria-label="Vertical radio toggle button group">
              <div class="checkbox1">
                <input type="checkbox" name="rencana_tindak_lanjut" value="Perlu Pemeriksaan Penunjang">
                <label for="rencana_tindak_lanjut">Perlu pemeriksaan penunjang</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" value="Melihat efek Therapy sebelumnya" name="rencana_tindak_lanjut">
                <label for="rencana_tindak_lanjut">Melihat efek Therapy sebelumnya</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" value="Menenentukan Therapy selanjutnya" name="rencana_tindak_lanjut">
                <label for="rencana_tindak_lanjut">Menenentukan Therapy selanjutnya</label>
              </div>
              <div class="checkbox1">
                <input type="checkbox" name="rencana_tindak_lanjut" id="btn-lainnya2">
                <label for="vbtn-radio4">Lainnya ...</label>
              </div>
            </div>
          </div>
          <div id="lainnya-input2" style="display: none;">
            <input type="text" id="lainnya-text2" class="form-control mt-3" name="rencana_tindak_lanjut"
              placeholder="Masukkan alasan lainnya">
          </div>
        </div>

        <input type="hidden" id="selected-values1" name="fasilitas">
        <input type="hidden" id="selected-values2" name="rencana_tindak_lanjut">

        <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span>Submit</button>
      </form>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    // Fasilitas
    $(document).ready(function() {
      $('input[name="fasilitas"]').change(function() {
        var selectedValues = [];
        var lainnya = document.getElementById('lainnya-text1').value;
        $('#btn-lainnya1').val(lainnya);
        $('input[name="fasilitas"]:checked').each(function() {
          selectedValues.push($(this).val());
        });

        var selectedString = selectedValues.join(',');
        $('#selected-values1').val(selectedString);
      });

      $('#btn-lainnya1').change(function() {
        if ($(this).is(':checked')) {
          $('#lainnya-input1').show();
        } else {
          $('#lainnya-input1').hide();
        }

      });

      //   rencana_tindak_lanjut
      $('input[name="rencana_tindak_lanjut"]').change(function() {
        let selectedValues = [];
        let lainnya = document.getElementById('lainnya-text2').value;
        $('#btn-lainnya2').val(lainnya);
        $('input[name="rencana_tindak_lanjut"]:checked').each(function() {
          selectedValues.push($(this).val());
        });

        let selectedString = selectedValues.join(',');
        $('#selected-values2').val(selectedString);
      });
      $('#btn-lainnya2').change(function() {
        if ($(this).is(':checked')) {
          $('#lainnya-input2').show();
        } else {
          $('#lainnya-input2').hide();
        }

      });
    });
  </script>
@endsection
