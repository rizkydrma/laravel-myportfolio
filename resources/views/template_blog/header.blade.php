<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rizky Darma | @yield('title')</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css')}} ">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }} ">
  <!-- FONT -->
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

  <!-- Style CSS -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('/css/light.css') }}" rel="stylesheet" id="theme">
  <link href="{{ asset('/css/animasi.css') }}" rel="stylesheet">


</head>

<body class="body-color">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="navbar">
    <div class="container">
      <a class="navbar-brand text-secondary bold" href="{{ route('blog') }}">RIZKY DARMA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link text-secondary" href="{{ route('blog') }}">HOME</a>
          <a class="nav-item nav-link text-secondary" href="{{ route('blog.blog') }}">BLOG</a>
          <a class="nav-item nav-link text-secondary" href="{{ route('source') }}">SOURCE CODE</a>
          <a class="nav-item nav-link text-secondary" href="#">VIDEO TUTORIAL</a>
          <div class="bg-primary rounded-pill text-center" id="themeToggle">
            <a href="#" class="btn btn-light rounded-pill" id="modeLight">
              <i class="fas fa-sun turn-off px-2 py-1"></i>
            </a>
            <a href="#" id="modeDark">
              <i class="fas fa-moon turn-off px-2 py-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->