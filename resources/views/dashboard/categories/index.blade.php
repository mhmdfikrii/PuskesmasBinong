@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Categories</h1>
    </div>

    <div class="table-responsive col-lg-6">
        <a href="/dashboard/posts" class="btn btn-primary mb-3"><span data-feather="arrow-left"></span></a>
        <a href="/dashboard/post/categories/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Buat
            Baru</a>


        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show col-lg-10" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nomer</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Url Kategori</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>

                            <form action="/dashboard/post/categories/{{ $category->id }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Apakah Kamu akan Hapus Kategori ini Ini?')"><span
                                        data-feather="trash"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
