@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Categories</h1>
    </div>

    <div class="table-responsive col-lg-6">
        <a href='/dashboard/tambahobat' class="btn btn-success mb-3"><span data-feather="arrow-left"
                class="align-text-bottom"></span>
        </a>
        <a href='/dashboard/tambahobatcategory/create' class="btn btn-primary mb-3"><span data-feather="plus"
                class="align-text-bottom"></span> Tambah Category</a>

        <form id="search-form" action="{{ route('search') }}" method="GET">
            <input type="text" name="query" id="search-input" placeholder="Cari...">
        </form>


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
                    <th scope="col">image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="search-results">
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><img style="width: 12rem" src="{{ asset('storage/' . $category->image) }}" alt="..."></td>
                        <td>
                            <div class="d-flex">
                                <a class="badge bg-primary border-0"
                                    href="/dashboard/tambahobatcategory/edit/{{ $category->id }}"><span
                                        data-feather="edit"></span></a>
                                <a href="#" class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Are you sure you want to delete this data?')) { deleteData({{ $category->id }}, {{ $key + 1 }}); }"><span
                                        data-feather="trash"></span></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tbody id="content">

            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var typingTimer;
            var doneTypingInterval = 500;

            $('#search-input').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });

            function doneTyping() {
                var query = $('#search-input').val();

                $.get('{{ route('search') }}', {
                    query: query
                }, function(data) {
                    $('#search-results').html(data);
                    feather.replace();
                });
            }

            $('#search-form').on('submit', function(event) {
                event.preventDefault();
                doneTyping();
            });
        });

        function deleteData(id, key) {
            let row = $('tr[data-id="' + key + '"]');


            $.ajax({
                url: '/dashboard/tambahobatcategory/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(result) {
                    row.fadeOut('slow', function() {
                        $(this).remove();
                    });
                    alert(result.message + ' = ' + key);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
    </script>
@endsection
