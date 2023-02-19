<!DOCTYPE html>
<html lang="en">

<head>
  @extends('layouts.head')
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts.main-headerbar')

  <!-- ======= Sidebar ======= -->
  @include('layouts.main-sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- SCRIPTS -->
  @include('layouts.scripts')

</body>

</html>