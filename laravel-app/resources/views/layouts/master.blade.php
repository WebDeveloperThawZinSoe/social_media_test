<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Social')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   <style>  
       body {
      background: #f8fafc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Navbar */
    .navbar {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.06);
      padding: 10px 20px;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 22px;
    }
    .navbar-brand .brand-s {
      background: #111;
      color: #fff;
      padding: 4px 8px;
      border-radius: 6px;
      font-weight: 700;
      margin-right: 4px;
    }
    .navbar-nav .nav-link {
      font-weight: 500;
      margin: 0 5px;
    }
    .navbar .dropdown-toggle img {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      margin-right: 6px;
    }

    /* Active nav background */
    .navbar .nav-link {
      padding: 6px 12px;
      border-radius: 8px;
      transition: background 0.2s ease;
    }
    .navbar .nav-link.active,
    .navbar .nav-link.active:focus,
    .navbar .nav-link[aria-current="page"] {
      background: #111;
      border-radius: 8px;
      font-weight: 600;
      color: #f3f4f6 !important;
    }
    .navbar .nav-link:hover {
      background: #f9fafb;
    }
   </style>
  @stack('styles') 
</head>
<body>
  @yield('content') 
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts') 
</body>
</html>
