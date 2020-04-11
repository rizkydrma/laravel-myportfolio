<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Rizky Darma | Dashboard - @yield('title') </title>
  <link rel="shortcut icon" href="{{ asset('img/icon/rizky-darma.png') }}" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css')}} ">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }} ">

  <!-- csss lib -->
  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/atom-one-dark.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">

  <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>


  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
  </div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>

              <div class="dropdown-divider"></div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
              </a>
            </div>
          </li>
        </ul>
      </nav>