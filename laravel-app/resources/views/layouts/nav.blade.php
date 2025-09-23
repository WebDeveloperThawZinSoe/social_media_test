<!-- Navbar (same as yours) -->
<nav class="navbar navbar-light bg-light sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <!-- Brand -->
    <a class="navbar-brand fw-bold" href="#"><span class="brand-s">S</span>Social</a>

    <!-- Desktop menu -->
    <div class="d-none d-lg-flex flex-grow-1 justify-content-between align-items-center ms-3">
      <!-- Left links -->
      <ul class="navbar-nav d-flex flex-row align-items-center mb-0">
        <li class="nav-item">
          <a href="{{ route('home') }}" 
            class="nav-link d-flex align-items-center {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door me-1"></i> Home
          </a>
        </li>

        <li class="nav-item ms-3">
          <a href="{{ route('profile') }}" 
            class="nav-link d-flex align-items-center {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="bi bi-person-circle me-1"></i> Profile
          </a>
        </li>
      </ul>

      <!-- Right links -->
      <ul class="navbar-nav d-flex flex-row align-items-center mb-0">
        <li class="nav-item">
          <a href="{{ route('profile') }}" class="nav-link d-flex align-items-center">
            <img 
              src="{{ Auth::user()->profile_photo_path 
                      ? asset(Auth::user()->profile_photo_path) 
                      : 'https://static.vecteezy.com/system/resources/thumbnails/036/280/651/small/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg' }}" 
              alt="profile" 
              class="rounded-circle me-2 border border-2 border-light shadow-sm" 
              style="width:35px; height:35px; object-fit:cover;">


             {{Auth::user()->name}}
          </a>
        </li>
        <li class="nav-item ms-3">
          <button class="nav-link text-danger d-flex align-items-center border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
          </button>
        </li>
      </ul>
    </div>

    <!-- Mobile toggler button -->
    <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
      <i class="bi bi-list"></i>
    </button>
  </div>
</nav>

<!-- Mobile Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileSidebarLabel">
      <a class="navbar-brand fw-bold" href="#"><span class="brand-s">S</span>Social</a>
    </h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{route('home')}}" class="nav-link d-flex align-items-center">
          <i class="bi bi-house-door me-2"></i> Home
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('profile')}}" class="nav-link d-flex align-items-center">
          <i class="bi bi-person-circle me-2"></i> Profile
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li class="nav-item">
        <a href="{{route('profile')}}" class="nav-link d-flex align-items-center">
          <img 
              src="{{ Auth::user()->getProfilePhotoUrlAttribute() }}" 
              alt="profile" 
              class="rounded-circle me-2 border border-2 border-light shadow-sm" 
              style="width:35px; height:35px; object-fit:cover;">
          {{Auth::user()->name}}
        </a>
      </li>
      <li class="nav-item mt-2">
        <button class="nav-link text-danger d-flex align-items-center border-0 bg-transparent p-0" data-bs-toggle="modal" data-bs-target="#logoutModal">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
      </li>
    </ul>
  </div>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-exclamation-triangle me-2"></i> Confirm Logout</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>
