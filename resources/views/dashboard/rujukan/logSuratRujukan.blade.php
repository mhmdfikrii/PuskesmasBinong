@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">Log Surat Rujuk</h1>
  </div>

  <div class="table-responsive">
    <table class="table-striped table">
      <thead>
        <tr>
          <th>Kode Surat Rujuk</th>
          <th>Tanggal Dibuat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rekamMedis as $data)
          @if ($data->rekamMedis != null && $data->rekamMedis)
            @if ($data->rekamMedis->suratRujukan && $data->rekamMedis->suratRujukan != null)
              <tr>
                <td>{{ $data->rekamMedis->suratRujukan->kode_rujukan }}</td>
                <td>
                  {{ \Carbon\Carbon::parse($data->rekamMedis->suratRujukan->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
                </td>
                <td>
                  <a class="badge bg-primary border-0"
                    href="/dashboard/suratrujukan/{{ $data->rekamMedis->suratRujukan->kode_rujukan }}"><span
                      data-feather="eye"></span></a>
                </td>
              </tr>
            @endif
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
