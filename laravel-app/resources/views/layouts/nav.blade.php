<nav class="navbar navbar-light bg-light sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <!-- Brand -->
    <a class="navbar-brand fw-bold" href="#"><span class="brand-s">S</span>Social</a>

    <!-- Desktop menu -->
    <div class="d-none d-lg-flex flex-grow-1 justify-content-between align-items-center ms-3">
      <!-- Left links -->
      <ul class="navbar-nav d-flex flex-row align-items-center mb-0">
        <li class="nav-item">
          <a href="#" class="nav-link active d-flex align-items-center">
            <i class="bi bi-house-door me-1"></i> Home
          </a>
        </li>
        <li class="nav-item ms-3">
          <a href="#" class="nav-link d-flex align-items-center">
            <i class="bi bi-person-circle me-1"></i> Profile
          </a>
        </li>
      </ul>

      <!-- Right links -->
      <ul class="navbar-nav d-flex flex-row align-items-center mb-0">
        <li class="nav-item">
          <a href="#" class="nav-link d-flex align-items-center">
            <img src="https://i.pravatar.cc/30?img=3" alt="profile" class="rounded-circle me-2">
            alex_dev
          </a>
        </li>
        <li class="nav-item ms-3">
          <a href="#" class="nav-link text-danger d-flex align-items-center">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
          </a>
        </li>
      </ul>
    </div>

    <!-- Mobile toggler button -->
    <button class="btn btn-outline-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
      <i class="bi bi-list"></i>
    </button>
  </div>
</nav>

<!-- Sidebar Offcanvas for mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileSidebarLabel"> <a class="navbar-brand fw-bold" href="#"><span class="brand-s">S</span>Social</a>
</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center">
          <i class="bi bi-house-door me-2"></i> Home
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center">
          <i class="bi bi-person-circle me-2"></i> Profile
        </a>
      </li>
      <li><hr class="dropdown-divider"></li>
      <li class="nav-item">
        <a href="#" class="nav-link d-flex align-items-center">
          <img src="https://i.pravatar.cc/30?img=3" alt="profile" class="rounded-circle me-2">
          alex_dev
        </a>
      </li>
      <li class="nav-item mt-2">
        <a href="#" class="nav-link text-danger d-flex align-items-center">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>
      </li>
    </ul>
  </div>
</div>
