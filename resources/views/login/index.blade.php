@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <main class="form-signin w-100 m-auto">
                <h1 class="mb-3 text-center">Login</h1>
                {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">  <!--logo--> --}}

                @if (session()->has('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                @if (session()->has('gagal'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('gagal') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="/login" method="post">
                    @csrf

                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Password" required value="{{ old('password') }}">
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input class="mt-3" type="checkbox" onclick="myFunction()"> Tampilkan Password
                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit"><i class="bi bi-person"></i>
                        Login</button>
                </form>
                <small class="d-block text-center mt-3">
                    <a href="/register" class="text-decoration-none"> Register Now!</a>
                </small>
            </main>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
