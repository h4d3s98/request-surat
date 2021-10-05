<!DOCTYPE html>
<html lang="en">
<head>
   @include('layout.header')
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

      <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('/images/logo.png') }}" alt="">
                <h2 style="padding-left: 10px;color: white">Surat FTI</h2>
            </a>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        @include('layout.menu_atas')
        @include('layout.Sidebar')

        @yield('konten')

        @include('layout.footer')