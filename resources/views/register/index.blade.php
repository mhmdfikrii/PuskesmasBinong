@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <img src="{{ asset('img/Lambang_Kabupaten_Subang.png') }}"
                style="display: block; margin: auto; width: 200px; height: auto;">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center">Daftar Pengguna Baru</h1>

                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                        <label for="name">Nama Lengkap</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="number" name="NIK" class="form-control @error('NIK') is-invalid @enderror"
                            id="NIK" placeholder="Nama Lengkap" value="{{ old('NIK') }}" required autofocus>
                        <label for="NIK">NIK</label>
                        @error('NIK')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="User Name" required value="{{ old('username') }}">
                        <label for="username">Nama Panggilan</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="date" name="tgllahir" class="form-control" id="tgllahir" placeholder=" " required
                            value="{{ old('tgllahir') }}">
                        <label for="tgllahir">Tanggal Lahir</label>
                        @error('tgllahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            id="alamat" placeholder="0000000" required value="{{ old('alamat') }}">
                        <label for="alamat">Alamat Lengkap</label>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="kepalakeluarga" name="kepalakeluarga"
                            class="form-control @error('kepalakeluarga') is-invalid @enderror" id="kepalakeluarga"
                            placeholder="0000000" required value="{{ old('kepalakeluarga') }}">
                        <label for="kepalakeluarga">Nama Kepala Keluarga</label>
                        @error('kepalakeluarga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Default select example" style="width: 100%;"
                            name="opsibpjs">
                            <option disabled selected>Keanggotaan BPJS</option>
                            <option>YA</option>
                            <option>TIDAK</option>
                        </select>
                        <label for="opsibpjs">Keanggotaan BPJS</label>
                    </div>

                    <input type="number" name="cek" hidden>

                    <input type="number" name="is_admin" hidden value="0">

                    <div class="form-floating mb-2" id="bpjsField">
                        <input type="number" name="bpjs" class="form-control @error('bpjs') is-invalid @enderror"
                            id="bpjs" placeholder="" value="{{ old('bpjs') }}">
                        <label for="bpjs">No. BPJS</label>
                        @error('bpjs')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                        <label for="email">E-mail address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password" required value="{{ old('password') }}">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="password" name="confirm_password"
                            class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password"
                            placeholder="Password" required>
                        <label for="confirm_password">Konfirmasi Password</label>
                        @error('confirm_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input class="mt-3 mb-2" type="checkbox" onclick="myFunction()"> Tampilkan Semua Password
                    <button class="w-100 btn-dark btn-lg btn-primary mt-3" type="submit"><i class="bi bi-person"></i>
                        Register </button>
                </form>
                <small class="d-block text-center mt-3 mb-5">
                    <a href="/login" class="text-decoration-none"> Login Sekarang!</a>
                </small>
            </main>
        </div>
    </div>


    <script>
        function myFunction() {

            var x = document.getElementById("confirm_password");
            var y = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";

            } else {
                x.value = "";
                x.type = "password";
                y.type = "password";

            }
        }

        const select = document.querySelector('select[name="opsibpjs"]');
        const input = document.querySelector('input[name="cek"]');

        select.addEventListener('change', function() {
            if (select.value === 'TIDAK') {
                input.value = 1;
            } else {
                input.value = 2;
            }
        });

        const opsibpjs = document.querySelector('select[name="opsibpjs"]');
        const bpjsField = document.querySelector('#bpjsField');

        // Sematkan event listener pada field "Keanggotaan BPJS"
        opsibpjs.addEventListener('change', () => {
            // Jika opsi "TIDAK" dipilih, sembunyikan field "No. BPJS"
            if (opsibpjs.value === 'TIDAK') {
                bpjsField.style.display = 'none';
            } else {
                bpjsField.style.display = 'block';
            }
        });
    </script>
@endsection
