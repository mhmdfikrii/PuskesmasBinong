@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
    </div>

    <div class="table-responsive">
        <a class="btn btn-primary mb-3" href="/dashboard/post/categories"><span data-feather="layout"></span>
            Categories</a>
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Buat Baru</a>

        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Nomer</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span
                                    data-feather="eye"></span></a>

                            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                                    data-feather="edit"></span></a>

                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="badge bg-danger border-0"
                                    onclick="return confirm('Apakah Kamu akan Hapus Postingan Ini?')"><span
                                        data-feather="trash"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
