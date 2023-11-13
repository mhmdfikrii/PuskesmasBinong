@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pb-2 pt-3">
    <h1 class="h2">Log Resep Obat</h1>
  </div>

  <div class="table-responsive">
    <table class="table-striped table">
      <thead>
        <tr>
          <th>Invoice</th>
          <th>Tanggal Dibuat</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($notaPembayaran as $data)
          @if (
              ($data->resepObat
                  ? $data->resepObat->rekamMedis->dataAntrian->User->NIK
                  : $data->suratRujukan->rekamMedis->dataAntrian->User->NIK) == auth()->user()->NIK &&
                  $data->transaksi &&
                  $data->transaksi != null)
            <tr>
              <td>{{ $data->transaksi->invoice }}</td>
              <td>{{ $data->resepObat ? 'Ambil Resep Obat' : 'Surat Rujukan' }}</td>
              <td>
                {{ \Carbon\Carbon::parse($data->transaksi->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i:s') }}
              </td>
              <td>
                <a class="badge bg-primary border-0"
                  href="/dashboard/pdf/notaPembayaran/{{ $data->resepObat ? $data->kode_notapembayaran : $data->kode_notapembayaran }}"><span
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
          {{ $notaPembayaran->links() }}
        </ul>
      </nav>
    </div>
  </div>
@endsection
