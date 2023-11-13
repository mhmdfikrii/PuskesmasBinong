@extends('dashboard.layouts.main')

@section('container')
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Detail Surat Rujukan
          </div>
          <div class="card-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Kode Rujukan</th>
                  <td>{{ $data->kode_rujukan }}</td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td>{{ $data->rekamMedis->dataAntrian->user->name }}</td>
                </tr>
                @if ($data->rekamMedis->dataAntrian->user->bpjs != null)
                  <tr>
                    <th>BPJS</th>
                    <td>{{ $data->rekamMedis->dataAntrian->user->bpjs }}</td>
                  </tr>
                @endif
                @if (auth()->user()->is_admin != 0)
                  <tr>
                    <th>Rekammedis</th>
                    <td><a style="text-decoration: none; color:rgb(49, 163, 49); font-weight: bold;"
                        href="/dashboard/rekammedis/{{ $data->rekamMedis->antrian }}">Link
                        Rekammedis</a>
                    </td>
                  </tr>
                @endif
                @if ($data->fasilitas != null)
                  <tr>
                    <th>Fasilitas</th>
                    <td>{{ $data->fasilitas }}</td>
                  </tr>
                @endif
                @if ($data->rencana_tindak_lanjut != null)
                  <tr>
                    <th>Rencana Tindak Lanjut</th>
                    <td>{{ $data->rencana_tindak_lanjut }}</td>
                  </tr>
                @endif

                <tr>
                  <th>Dibuat</th>
                  <td>{{ \Carbon\Carbon::parse($data->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">Kembali</a>
          @if (auth()->user()->is_admin == 0 && !auth()->user()->bpjs)
            <a href="/dashboard/pdf/suratRujukan/{{ $data->kode_rujukan }}" class="btn btn-success mb-3">Unduh</a>
          @endif
        </div>
      </div>
    </div>
</div @endSection
