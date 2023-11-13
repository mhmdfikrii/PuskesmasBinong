@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">Edit Keluhan Pasien</h1>
  </div>
  <div class="row my-3 px-3">
    <div class="col-10">
      <form action="/dashboard/listpasien/rekammedis/{{ $data['kode_rekammedis'] }}" method="post" class="mb-3">
        @method('put')
        @csrf

        <div class="mb-3">
          <label for="antrian" class="form-label">Kode Antrian</label>
          <input type="text" class="form-control" value="{{ $data->antrian }}" disabled>
          <input type="hidden" class="@error('antrian') is-invalid @enderror" id="antrian" name="antrian"
            value="{{ $data->antrian }}">
          @error('antrian')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        @if ($data->bpjs)
          <div class="mb-3">
            <label for="bpjs" class="form-label">BPJS</label>
            <input type="hidden" name="bpjs" class="form-control" value={{ $data['bpjs'] ? $data['bpjs'] : '' }}>
            <input type="text" class="form-control @error('bpjs') is-invalid @enderror" placeholder="BPJS"
              value={{ $data['bpjs'] ? $data['bpjs'] : '' }} disabled>
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
            name="diagnosa" placeholder="Masukan diagnosa" value={{ old('diagnosa', $data['diagnosa']) }}>
          @error('diagnosa')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="anamnesa" class="form-label">Anamnesa</label>
          <textarea class="form-control @error('anamnesa') is-invalid @enderror" id="anamnesa" name="anamnesa" id="anamnesa"
            cols="30" rows="4">{{ old('anamnesa', $data['anamnesa']) }}</textarea>
          @error('anamnesa')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="pemeriksaan_Fisik" class="form-label">Pemeriksaan Fisik</label>
          <textarea class="form-control @error('pemeriksaan_Fisik') is-invalid @enderror" id="pemeriksaan_Fisik"
            name="pemeriksaan_Fisik" name="pemeriksaan_Fisik" id="pemeriksaan_Fisik" cols="30" rows="4">{{ old('pemeriksaan_Fisik', $data['pemeriksaan_fisik']) }}</textarea>
          @error('pemeriksaan_Fisik')
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
