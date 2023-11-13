@extends('dashboard.layouts.main')

@section('container')
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Detail Log Transaksi
          </div>
          <div class="card-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Kode Nota Transaksi</th>
                  <td>{{ $data->invoice }}</td>
                </tr>
                <tr>
                  <th>Nama</th>
                <td>{{ $data->notaPembayaran-> }}</td>
                </tr>
                <tr>
                  <th>Total Pembayaran</th>
                  <td>{{ $data }}</td>
                </tr>


                <tr>
                  <th>Dibuat</th>
                  <td>{{ $data->created_at }}</td>
                </tr>

              </tbody>
            </table>
          </div>
          <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">Kembali</a>
          @if (auth()->user()->is_admin == 0)
            <a href="/dashboard/pdf/suratRujukan/{{ $data->kode_rujukan }}" class="btn btn-success mb-3">Unduh</a>
          @endif
        </div>
      </div>
    </div>
</div @endSection
