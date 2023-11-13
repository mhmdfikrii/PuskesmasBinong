@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Verifikasi Data Pasien BPJS</h1>
    </div>

    <div class="table-responsive col-lg-15">

        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show col-lg-15" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-sm" id="example">
            <thead>
                <tr>

                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat Lengkap</th>
                    <th scope="col">Nomer BPJS</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Nama Kepala Keluarga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    @if ($user->cek == 2)
                        <tr>

                            <td>{{ $user->name }} <button onclick="showData('{{ $user->NIK }}')" class="border-0"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><span
                                        data-feather="eye"></span></button></td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->bpjs }} <button onclick="copyToClipboard('{{ $user->bpjs }}')"
                                    class="border-0"><span data-feather="copy"></span></button></td>
                            <td>{{ $user->age }} Tahun</td>
                            <td>{{ $user->kepalakeluarga }}</td>
                            <td>

                                <form action="{{ route('verifikasi.update', ['user' => $user->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')

                                    <input id="inputCek_{{ $user->id }}" type="hidden" name="cek" value="0">

                                    <button class="badge bg-success border-0" type="submit"
                                        id="verifikasi_{{ $user->id }}" onclick="setCek(1, {{ $user->id }})">
                                        <span data-feather="check"></span>
                                    </button>

                                    <button class="badge bg-danger border-0" type="submit" id="gagal_{{ $user->id }}"
                                        onclick="setCek(0, {{ $user->id }})">
                                        <span data-feather="x"></span>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Verifikasi Pembaruan Data BPJS</h1>
    </div>
    <div class="table-responsive col-lg-15">
        <table class="table table-striped table-sm" id="example1">
            <thead>
                <tr>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat Lengkap</th>
                    <th scope="col">Nomer BPJS</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Nama Kepala Keluarga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if ($user->cek == 0)
                        <tr>
                            <td>{{ $user->name }} <button onclick="showData('{{ $user->NIK }}')" class="border-0"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"><span
                                        data-feather="eye"></span></button></td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->bpjs }} <button onclick="copyToClipboard('{{ $user->bpjs }}')"
                                    class="border-0"><span data-feather="copy"></span></button></td>
                            <td>{{ $user->age }} Tahun</td>
                            <td>{{ $user->kepalakeluarga }}</td>
                            <td>

                                <form action="{{ route('verifikasi.update', ['user' => $user->id]) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')

                                    <input id="inputCek_{{ $user->id }}" type="hidden" name="cek" value="0">

                                    <button class="badge bg-success border-0" type="submit"
                                        id="verifikasi_{{ $user->id }}" onclick="setCek(1, {{ $user->id }})">
                                        <span data-feather="check"></span>
                                    </button>

                                    <button class="badge bg-danger border-0" type="submit" id="gagal_{{ $user->id }}"
                                        onclick="setCek(0, {{ $user->id }})">
                                        <span data-feather="x"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    @include('dashboard.layouts.modalPasien')

    <script>
        function copyToClipboard(text) {
            const elem = document.createElement('textarea');
            elem.value = text;
            document.body.appendChild(elem);
            elem.select();
            document.execCommand('copy');
            document.body.removeChild(elem);
            alert('Teks telah disalin ke clipboard!');
        }

        function setCek(value, userId) {
            document.querySelector('#inputCek_' + userId).value = value;
        }

        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).ready(function() {
            $('#example1').DataTable();
        });

        function showData(nik) {
            $.ajax({
                url: '/dashboard/daftarpasien/' + nik,
                method: 'GET',
                beforeSend: function() {
                    // show loading animation before the request is sent
                    $('#exampleModal #modal-body').html(
                        '<div class="text-center"><p>Tunggu Sebentar...</p></div>');
                },
                success: function(response) {
                    // hide the loading animation and display the data
                    $('#exampleModal #modal-body').html(response);
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });

            // show the modal after the request is sent
            $('#exampleModal').modal('show');
        }
    </script>
@endsection
