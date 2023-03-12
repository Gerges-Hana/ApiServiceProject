<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layouts.head')
</head>

{{-- <body> --}}

{{-- <style>
    #spinner {
        display: flex;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #09c;
        z-index: 9999999;
        justify-content: center;
        align-items: center;

    }

    body {
        overflow: hidden;
    }



    .lds-hourglass {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-hourglass:after {
        content: " ";
        display: block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 8px;
        box-sizing: border-box;
        border: 32px solid #fff;
        border-color: #fff transparent #fff transparent;
        animation: lds-hourglass 1.2s infinite;
    }

    @keyframes lds-hourglass {
        0% {
            transform: rotate(0);
            animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
        }

        50% {
            transform: rotate(900deg);
            animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        100% {
            transform: rotate(1800deg);
        }
    }
</style> --}}
{{-- jquery  --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}

{{-- <script>
//    $(document).ready(function(){
//     // $('.spinner').css(' backgroundColor','red').fadeOut(10,function(){
//     //     $('body').css('overflow','auto')
//     // })

//    })
// $(window).on('load',function(){
//     $('#spinner').fadeOut(1000,function(){
//         $('body').css('overflow','auto')
//     })
// })
</script>>  --}}


</head>

<body>

    {{-- loding  --}}
    {{-- <section id="spinner" class="spinner"> --}}
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


</html>
