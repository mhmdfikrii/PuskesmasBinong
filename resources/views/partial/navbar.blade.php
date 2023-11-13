<style>
  a.hover-bg {
    text-decoration: none;
  }

  a.hover-bg:hover {
    background-color: gray;
  }
</style>

<?php
$url = '/dashboard';

if (auth()->check()) {
    $user = App\Models\User::where('id', auth()->user()->id)->first();

    switch ($user->is_admin) {
        case 1:
            $url = '/dashboard/verifikasi';

            break;

        case 2:
            $url = '/dashboard/listpasien';

            break;

        case 3:
            $url = '/dashboard/pembayaran/list';

            break;

        default:
            $url = '/dashboard';

            break;
    }
}

?>

<div class="position-absolute text-light col-md px-3 py-1" style="background-color: rgba(0, 0, 0, 0.7); font-size: 12px;">
  <?php setlocale(LC_TIME, 'id_ID'); ?>
  <p> {{ strftime('%A, %d %B %Y') }}</p>
</div>

<img src="{{ asset('img/bar subang.jpg') }}" class="img-fluid col-lg-4 img-responsive" style="width: 100%; height: auto;">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fs-3 font-weight-bold" href="/home">Puskesmas Binong</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $active === 'posts' ? 'active' : '' }}" href="/home">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link {{ $active === 'categories' ? 'active' : '' }}" href="/categories">Kategori
            Informasi</a>
        </li>

        @if (auth()->user() == null || auth()->user()->is_admin === 0)
          <li class="nav-item">
            <a class="nav-link {{ $active === 'antrian' ? 'active' : '' }}" href="/antrian">Antrian</a>
          </li>
        @endif

        <li class="nav-item">
          <a class="nav-link {{ $active === 'about' ? 'active' : '' }}" href="/about">Tentang Puskesmas</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Selamat Datang, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href={{ $url }}><i class="bi bi-house-door"></i> My Dashboard</a>
              </li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                    Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-expanded="false"><i class="bi bi-door-open-fill"></i>
              Login Akun
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a href="/login" class="nav-link {{ $active === 'login' ? 'login' : '' }}"><i class="bi bi-person"></i>
                  Login</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a href="/register" class="nav-link {{ $active === 'login' ? 'register' : '' }}"><i
                    class="bi bi-box-arrow-in-right"></i> Register</a></li>
            </ul>
          </div>
        @endauth
      </ul>
    </div>

  </div>
  <ul class="navbar-nav" style="margin-right:1.5rem">
    <li class="nav-item">
      <!-- Tombol cari -->
      <button class="btn btn-outline-secondary bg-light text-dark d-inline text-light border-0" type="button"
        data-bs-toggle="modal" data-bs-target="#tombolcari"><i class="bi bi-search"></i> Pencarian</button>

      <!-- Modal -->
      <div class="modal fade" id="tombolcari" tabindex="-1" aria-labelledby="tombolcariLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tombolcariLabel">Halaman Pencarian <i class="bi bi-search"></i>
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form onkeypress="return event.keyCode !== 13;" method="GET" action="{{ route('searchPost') }}"
                id="search-form">
                <div class="input-group mb-3" style="width: 450px;">
                  <input autocomplete="off" type="text" class="form-control" id="search-post" placeholder="Search..."
                    name="search">
                  <button class="btn btn-dark" type="button"><i class="bi bi-search"></i></button>
                </div>
              </form>

              <div id="result-post"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

    </li>
  </ul>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var typingTimer;
    var doneTypingInterval = 200;

    $('#search-post').on('keyup', function() {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    function doneTyping() {
      var query = $('#search-post').val();
      if (query.trim() === '') { // periksa apakah query kosong atau hanya berisi spasi
        $('#result-post').html(''); // kosongkan hasil pencarian
        return;
      }

      $.get('{{ route('searchPost') }}', {
        query: query
      }, function(data) {
        $('#result-post').html(data);
        feather.replace();
      });
    }
  });
</script>
