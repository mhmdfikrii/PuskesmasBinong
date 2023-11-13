<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 fs-6 px-3" href="#">Dashboard Puskesmas</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  {{-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> --}}


  <div class="dropdown ms-auto">
    <button class="btn btn-secondary dropdown-toggle bg-dark" type="button" data-bs-toggle="dropdown"
      aria-expanded="false"><span data-feather="menu"></span>
      Menu
    </button>
    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
      <li>
        <a href="/dashboard/profile/{profile}/edit" class="text-decoration-none text-light"><span
            data-feather="user"></span>
          Profile
        </a>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="nav-link bg-dark border-0 px-0"><span data-feather="log-out"></span>
            Logout</button>
        </form>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a href="/home" class="text-decoration-none text-light"><span data-feather="hexagon"></span>
          Website
        </a>
      </li>
    </ul>
  </div>

</header>
