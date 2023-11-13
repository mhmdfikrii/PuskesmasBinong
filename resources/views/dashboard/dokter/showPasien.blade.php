@extends('dashboard.layouts.main')

@section('container')
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Detail Rekam Medis
          </div>
          <div class="card-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Kode Rekam Medis</th>
                  <td>{{ $data->kode_rekammedis }}</td>
                </tr>
                <tr>
                <tr>
                  <th>Nama Pasien</th>
                  <td>{{ $data->dataAntrian->user->name }}</td>
                </tr>
                <tr>
                <tr>
                  <th>Dokter</th>
                  <td>{{ $data->dataDokter->name }}</td>
                </tr>
                <tr>
                  <th>Anamnesa</th>
                  <td>{{ $data->anamnesa }}</td>
                </tr>
                <tr>
                  <th>Pemeriksaan Fisik</th>
                  <td>{{ $data->pemeriksaan_fisik }}</td>
                </tr>
                <tr>
                  <th>Diagnosa</th>
                  <td>{{ $data->diagnosa }}</td>
                </tr>
                <tr>
                  <th>Tindakan</th>
                  <td>{{ $data->tindakan }}</td>
                </tr>

              </tbody>
            </table>
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">Kembali</a>
          @if (auth()->user()->is_admin != 0)
            <a href="/dashboard/listpasien/rekammedis/{{ $data->kode_rekammedis }}" class="btn btn-success">edit</a>
          @endif
          @if (auth()->user()->is_admin == 0)
            <a href="/dashboard/pdf/rekamMedis/{{ $data->kode_rekammedis }}" class="btn btn-success mb-3">Unduh</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
