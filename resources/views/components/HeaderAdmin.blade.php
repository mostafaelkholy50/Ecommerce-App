<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="{{ asset('assets/img/1741914690345.png') }}" alt="">
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->



<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item d-block d-lg-none">
      <a class="nav-link nav-icon search-bar-toggle" href="#">
        <i class="bi bi-search"></i>
      </a>
    </li><!-- End Search Icon-->



    <li class="nav-item dropdown pe-3">
  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-person-circle me-2 fs-5 text-primary"></i>
    <span class="d-none d-md-block dropdown-toggle ps-1">
      {{ Auth::guard('admin')->user()->name ?? 'Admin' }}
    </span>
  </a><!-- End Profile Image Icon -->

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
    <li class="dropdown-header text-center">
      <i class="bi bi-person-circle d-block fs-2 text-primary"></i>
      <h6 class="mt-2">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</h6>
      <p class="small text-muted">{{ Auth::guard('admin')->user()->email ?? 'admin@example.com' }}</p>
    </li>
    <li><hr class="dropdown-divider"></li>

    <li>
      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="bi bi-person"></i>
        <span>My Profile</span>
      </a>
    </li>
    <li><hr class="dropdown-divider"></li>

    <li>
      <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <button class="dropdown-item d-flex align-items-center" type="submit">
          <i class="bi bi-box-arrow-right"></i>
          <span>Sign Out</span>
        </button>
      </form>
    </li>
  </ul><!-- End Profile Dropdown Items -->
</li><!-- End Profile Nav -->


  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
