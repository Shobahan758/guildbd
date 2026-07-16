<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin') — GameNova</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
  <aside class="admin-sidebar d-none d-lg-flex flex-column">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}">
      <span class="admin-brand-mark"><i class="bi bi-controller"></i></span>
      <span>Game<span>Nova</span></span>
    </a>
    <p class="sidebar-label">Workspace</p>
    <nav class="admin-nav nav flex-column">
      <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
      <a class="nav-link @if(request()->routeIs('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}"><i class="bi bi-bag-check-fill"></i>Orders</a>
      <a class="nav-link @if(request()->routeIs('admin.games.*')) active @endif" href="{{ route('admin.games.index') }}"><i class="bi bi-joystick"></i>Games & packages</a>
    </nav>
    <div class="sidebar-bottom mt-auto">
      <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-box-arrow-up-right"></i>View storefront</a>
      <form action="{{ route('logout') }}" method="post">@csrf<button class="nav-link w-100" type="submit"><i class="bi bi-box-arrow-left"></i>Sign out</button></form>
    </div>
  </aside>

  <div class="offcanvas offcanvas-start admin-mobile-menu" tabindex="-1" id="adminMenu" aria-labelledby="adminMenuLabel">
    <div class="offcanvas-header">
      <h2 class="offcanvas-title fs-5 fw-bold" id="adminMenuLabel">GameNova Admin</h2>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <nav class="admin-nav nav flex-column">
        <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-1x2-fill"></i>Dashboard</a>
        <a class="nav-link @if(request()->routeIs('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}"><i class="bi bi-bag-check-fill"></i>Orders</a>
        <a class="nav-link @if(request()->routeIs('admin.games.*')) active @endif" href="{{ route('admin.games.index') }}"><i class="bi bi-joystick"></i>Games & packages</a>
        <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i>Storefront</a>
      </nav>
    </div>
  </div>

  <div class="admin-page">
    <header class="admin-topbar">
      <button class="btn menu-button d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminMenu" aria-controls="adminMenu"><i class="bi bi-list"></i></button>
      <div>
        <p class="topbar-kicker mb-0">GameNova control center</p>
        <h1 class="topbar-title mb-0">@yield('page-title', 'Dashboard')</h1>
      </div>
      <div class="admin-profile ms-auto">
        <span class="profile-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
        <span class="d-none d-sm-block"><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></span>
      </div>
    </header>

    <main class="admin-content">
      @if(session('success'))<div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>@endif
      @if($errors->any())<div class="alert alert-danger" role="alert">Please check the highlighted information.</div>@endif
      @yield('content')
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
