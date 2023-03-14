<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layouts.head')
</head>

{{-- <body> --}}

<style>
    #spinner {
        display: flex;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb(250, 250, 250);
        z-index: 9999999;
        justify-content: center;
        align-items: center;

    }

    body {
        overflow: hidden;
    }


      /* ================= 3 3 3 ====================  */
      .sk-cube-grid {
  width: 40px;
  height: 40px;
  margin: 100px auto;
}

.sk-cube-grid .sk-cube {
  width: 33%;
  height: 33%;
  background-color: #0574fc;
  float: left;
  -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
          animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
}
.sk-cube-grid .sk-cube1 {
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }
.sk-cube-grid .sk-cube2 {
  -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s; }
.sk-cube-grid .sk-cube3 {
  -webkit-animation-delay: 0.4s;
          animation-delay: 0.4s; }
.sk-cube-grid .sk-cube4 {
  -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s; }
.sk-cube-grid .sk-cube5 {
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }
.sk-cube-grid .sk-cube6 {
  -webkit-animation-delay: 0.3s;
          animation-delay: 0.3s; }
.sk-cube-grid .sk-cube7 {
  -webkit-animation-delay: 0s;
          animation-delay: 0s; }
.sk-cube-grid .sk-cube8 {
  -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s; }
.sk-cube-grid .sk-cube9 {
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s; }

@-webkit-keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1);
  } 35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1);
  }
}

@keyframes sk-cubeGridScaleDelay {
  0%, 70%, 100% {
    -webkit-transform: scale3D(1, 1, 1);
            transform: scale3D(1, 1, 1);
  } 35% {
    -webkit-transform: scale3D(0, 0, 1);
            transform: scale3D(0, 0, 1);
  }
}
      /* ================= 3 3 3 ====================  */

</style>
{{-- jquery  --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}

</head>

<body>

    {{-- loding  --}}
    <section id="spinner" class="spinner">


        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
          </div>
    </section>
    {{-- <div class="lds-hourglass"></div> --}}
    {{-- <h2>loading</h2>
     </section> --}}
    <!-- ======= Header ======= -->


        @include('layouts.main-headerbar')

        <!-- ======= Sidebar ======= -->
        @include('layouts.main-sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @yield('content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

        <!-- SCRIPTS -->
        @include('layouts.scripts')


    </body>
    <script>

        let loder = document.getElementById("spinner")
        let bdy = document.getElementsByTagName("body")[0]

        setTimeout(() => {

            loder.style.display = "none"
            bdy.style.overflow = "auto"
        }, 600);
        </script>

</html>
