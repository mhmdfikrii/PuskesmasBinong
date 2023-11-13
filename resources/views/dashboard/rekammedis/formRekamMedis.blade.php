@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
    <h1 class="h2">Form Keluhan Pasien</h1>
  </div>
  <div class="row my-3 px-3">
    <div class="col-10">
      <form action="/dashboard/rekammedis" method="post" class="mb-3">
        @method('post')
        @csrf

        <div class="mb-3">
          <label for="kode_antrian" class="form-label">Kode Antrian</label>
          <input type="text" class="form-control" value="{{ $antrian['kode_antrian'] }}" disabled>
          <input type="hidden" class="@error('kode_antrian') is-invalid @enderror" id="kode_antrian" name="kode_antrian"
            value="{{ $antrian['kode_antrian'] }}">
          @error('kode_antrian')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        @if ($user->bpjs)
          <div class="mb-3">
            <label for="bpjs" class="form-label">BPJS</label>
            <input type="hidden" name="bpjs" class="form-control" value={{ $user['bpjs'] ? $user['bpjs'] : '' }}>
            <input type="text" class="form-control @error('bpjs') is-invalid @enderror" placeholder="BPJS"
              value={{ $user['bpjs'] ? $user['bpjs'] : '' }} disabled>
            @error('bpjs')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        @endif

        <div class="mb-3">
          <label for="diagnosa" class="form-label">Diagnosa</label>
          <input type="text" class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa"
            name="diagnosa" placeholder="Masukan diagnosa" value="{{ old('diagnosa') }}">
          @error('diagnosa')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="anamnesa" class="form-label">Anamnesa</label>
          <textarea class="form-control @error('anamnesa') is-invalid @enderror" id="anamnesa" name="anamnesa" name="anamnesa"
            id="anamnesa" cols="30" rows="4" placeholder="Anamnesa ..."></textarea>
          @error('anamnesa')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="pemeriksaan_Fisik" class="form-label">Pemeriksaan Fisik</label>
          <textarea class="form-control @error('pemeriksaan_Fisik') is-invalid @enderror" id="pemeriksaan_Fisik"
            name="pemeriksaan_Fisik" name="pemeriksaan_Fisik" id="pemeriksaan_Fisik" placeholder="Pemeriksaan Fisik ..."
            cols="30" rows="4"></textarea>
          @error('pemeriksaan_Fisik')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>


        <div class="mb-3">
          <label for="tindakan" class="form-label">Tindakan</label>
          <select class="form-control @error('tindakan') is-invalid @enderror" id="tindakan" name="tindakan">
            <option disabled selected>Pilih Tindakan ... </option>
            <option value="surat-rujukan">Surat rujukan</option>
            <option value="obat-resep">Resep obat</option>
          </select>
          @error('tindakan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span>Submit</button>
      </form>
    </div>
  </div>
@endsection
