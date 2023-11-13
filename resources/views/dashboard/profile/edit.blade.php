@extends('dashboard.layouts.main')

@section('container')
  <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
    <h1 class="h2">Edit Profile</h1>
  </div>

  @if (session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="col-lg-8">
    <form action="/dashboard/profile/{{ auth()->user()->id }}" method="post" class="mb-5">
      @csrf
      @method('put')

      <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" hidden
        placeholder="Nama Lengkap" name="id" autofocus value="{{ old('id', auth()->user()->id) }}">

      <div class="col-lg-8 mb-3">
        <label for="name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
          placeholder="Nama Lengkap" name="name" autofocus value="{{ old('name', auth()->user()->name) }}">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror

        <div class="mt-3 mb-3">
          <label for="NIK" class="form-label">NIK</label>
          <input type="number" class="form-control @error('NIK') is-invalid @enderror" id="NIK" readonly
            placeholder="NIK" name="NIK" value="{{ old('NIK', auth()->user()->NIK) }}">
          @error('NIK')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>


        <div class="mt-3 mb-3">
          <label for="username" class="form-label">Nama Panggilan</label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
            placeholder="Username" name="username" value="{{ old('username', auth()->user()->username) }}">
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="tgllahir" class="form-label">Tanggal Lahir</label>
          <input type="date" name="tgllahir" class="form-control" id="tgllahir" placeholder="Tanggal Lahir" required
            value="{{ old('tgllahir', auth()->user()->tgllahir) }}">
          @error('tgllahir')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="alamat" class="form-label">Alamat Lengkap</label>
          <input type="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
            placeholder="0000000" required value="{{ old('alamat', auth()->user()->alamat) }}">
          @error('alamat')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="kepalakeluarga" class="form-label">Nama Kepala Keluarga</label>
          <input type="kepalakeluarga" name="kepalakeluarga"
            class="form-control @error('kepalakeluarga') is-invalid @enderror" id="kepalakeluarga" placeholder="0000000"
            required value="{{ old('kepalakeluarga', auth()->user()->kepalakeluarga) }}">
          @error('kepalakeluarga')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="bpjs" class="form-label">No. BPJS</label>
          @if (auth()->user()->cek == 1)
            <input type="text" name="bpjs" readonly class="form-control" id="bpjs"
              value="{{ auth()->user()->bpjs }}">
          @else
            <input type="text" name="bpjs" class="form-control @error('bpjs') is-invalid @enderror" id="bpjs"
              required value="{{ old('bpjs', auth()->user()->bpjs) }}">
            @error('bpjs')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          @endif
        </div>

        <div class="mt-3 mb-3">
          <label for="email" class="form-label">E-mail address</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
            placeholder="name@example.com" name="email" value="{{ old('email', auth()->user()->email) }}">
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="old_password" class="form-label">Password Lama</label>
          <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
            placeholder="Masukan Password lama" name="old_password">
          @error('old_password"')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <hr>

        <div class="mt-3 mb-3">
          <label for="password" class="form-label">Password Baru</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            placeholder="Password Baru" name="password">
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="mt-3 mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
            id="confirm_password" placeholder="Password" name="confirm_password">
          @error('confirm_password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <input type="checkbox" onclick="myFunction()"> Tampilkan Semua Password
        <br>
        <br>
        <button type="submit" class="btn btn-primary"><span data-feather="plus-circle"></span> Update
          Profile</button>

    </form>
  </div>

  <script>
    function myFunction() {
      var a = document.getElementById("old_password");
      var x = document.getElementById("confirm_password");
      var y = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
        y.type = "text";
        a.type = "text";
      } else {
        x.type = "password";
        y.type = "password";
        a.type = "password";
      }
    }
  </script>
@endsection
