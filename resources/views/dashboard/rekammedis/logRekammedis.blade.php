@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">Log Rekam Medis</h1>
  </div>

  <div class="table-responsive">
    <table class="table-striped table">
      <thead>
        <tr>
          <th>Kode Rekam Medis</th>
          <th>Tanggal Dibuat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rekamMedis as $data)
          @if ($data->rekamMedis)
            <tr>
              <td>{{ $data->rekamMedis->kode_rekammedis }}</td>
              <td>
                {{ \Carbon\Carbon::parse($data->rekamMedis->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
              </td>
              <td>
                <a class="badge bg-primary border-0" href="/dashboard/rekammedis/{{ $data->rekamMedis->antrian }}"><span
                    data-feather="eye"></span></a>
              </td>
            </tr>
          @endif
        @endforeach
      </tbody>
    </table>
    <div class="my-5">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          {{ $rekamMedis->links() }}
        </ul>
      </nav>
    </div>
  </div>
@endsection
