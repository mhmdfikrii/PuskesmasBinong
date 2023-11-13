@extends('dashboard.layouts.main')

@section('container')
  <div class="container my-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            Detail Transaksi
          </div>
          <div class="card-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Nota Pembayaran Medis</th>
                  <td>{{ $notaPembayaran->kode_notapembayaran }}</td>
                </tr>
                <tr>
                  <th>Invoice</th>
                  <td>{{ $transaksi->invoice }}</td>
                </tr>
                <tr>
                  <th>Total</th>
                  <td>{{ $transaksi->total }}</td>
                </tr>
              </tbody>
            </table>
            <h3 class="container text-end">{{ $transaksi->status }}</h3>
            <a class="btn btn-sm btn-primary" href="/dashboard/transaksi">back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
