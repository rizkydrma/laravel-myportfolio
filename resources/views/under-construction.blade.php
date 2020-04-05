@extends('template_blog.main')

@section('title', $title)

@section('content')
<main>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 text-center">
      <img src="{{ asset('img/under-construction.png') }}" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</main>

@endsection