@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Obat Yang Tersedia</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="/dashboard/listobat" method="GET">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                        placeholder="Cari nama obat...">
                    <button type="submit" class="btn btn-primary"> <span data-feather="search"
                            class="align-text-bottom"></span></button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">Nomer</th>
                <th scope="col">Nama Obat</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga Obat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obats as $obat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kategori_obat }}</td>
                    <td>
                        {{ $obat->stok }}
                    </td>
                    <td>Rp. {{ $obat->harga }}</td>
                    <td>
                        <div class="col-md-3">
                            <input type="number" hidden class="form-control form-control-sm input-qty"
                                max="{{ $obat->stok }}" min="1" value="1">
                        </div>
                        <button type="button" class="badge btn-add-to-cart" id="btn-add-to-cart"
                            obat-kode="{{ $obat->kode_obat }}" obat-nama="{{ $obat->nama_obat }}"
                            obat-harga="{{ $obat->harga }}" obat-stok="{{ $obat->stok }}">
                            <span color="#000" data-feather="shopping-cart"></span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <h3>Cart</h3>
    <table class="table table-striped table-sm" id="cart-table">
        <thead>
            <tr>
                <th scope="col">Nama Obat</th>
                <th scope="col">Harga Obat</th>

                <th scope="col">Hapus</th>
            </tr>
        </thead>
        <tbody id="cart-items">
        </tbody>
        <tfoot>

            <tr>
                <td>Total Harga</td>
                <td id="cart-total">Rp. 0</td>
            </tr>
        </tfoot>
    </table>


    <script>
        var cartItems = [];
        var cartTotal = 0;
        $(document).ready(function() {
            $(".btn-add-to-cart").click(function() {
                var kodeObat = $(this).attr("obat-kode");
                var namaObat = $(this).attr("obat-nama");
                var hargaObat = $(this).attr("obat-harga");
                var qty = $(".input-qty").val(); // mendapatkan nilai qty dari input

                // cek apakah qty melebihi stok yang tersedia
                if (parseInt(qty) > parseInt($(this).attr("obat-stok"))) {
                    alert("Stok tidak mencukupi");
                    $(".input-qty").val($(this).attr("obat-stok"));
                    qty = $(this).attr("obat-stok");
                }

                // ubah nilai qty pada input agar sesuai dengan nilai yang diperbolehkan
                $(".input-qty").val(qty);


                var item = {
                    kodeObat: kodeObat,
                    namaObat: namaObat,
                    hargaObat: hargaObat,
                    qty: parseInt(qty)
                };

                // cek apakah item sudah ada di dalam cartItems
                var existingItemIndex = cartItems.findIndex(function(i) {
                    return i.kodeObat === kodeObat;
                });
                if (existingItemIndex !== -1) {
                    // jika sudah ada, tambahkan qty
                    cartItems[existingItemIndex].qty += parseInt(qty);
                } else {
                    // jika belum ada, tambahkan item baru
                    item.qty = parseInt(qty);
                    cartItems.push(item);
                }

                renderCartItems();
            });

            // menangani ketika tombol hapus item diklik
            $(document).on("click", ".btn-delete-item", function() {
                var kodeObat = $(this).attr("obat-kode");

                // hapus item dari cartItems
                cartItems = cartItems.filter(function(i) {
                    return i.kodeObat !== kodeObat;
                });

                renderCartItems();
            });


            // fungsi untuk merender ulang isi keranjang belanja
            function renderCartItems() {
                $("#cart-items").empty();
                cartTotal = 0;

                for (var i = 0; i < cartItems.length; i++) {
                    var item = cartItems[i];
                    var subtotal = item.hargaObat * item.qty;

                    $("#cart-items").append(`
        <tr>
          <td>${item.namaObat} (Qty: ${item.qty})</td>
          <td>Rp. ${subtotal}</td>
          <td><button type="button" class="badge btn-delete-item text-dark" obat-kode="${item.kodeObat}">
            <span color="#000" data-feather="trash">X</span>
          </button></td>
        </tr>
      `);

                    cartTotal += subtotal;
                }

                $("#cart-total").html("Rp. " + cartTotal);
            }
        });
    </script>
@endsection
