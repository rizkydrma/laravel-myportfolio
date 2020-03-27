@extends('template_blog.main')

@section('title', $title)

@section('content')
<main>
  <div class="container">
    <h1 class="text-center text-secondary my-3">Source Code</h1>
    <div class="row">
      <div class="col-lg-9">
        <div class="card-columns">
          <div class="card bg-primary text-white">
            <img src="{{asset('img/source/content-2.jpg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              <button class="btn btn-danger btn-sm">Detail</button>
              <p class="card-text"><small class="text-white">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="card bg-primary text-white">
            <img src="{{asset('img/source/content-2.jpg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              <button class="btn btn-danger btn-sm">Detail</button>
              <p class="card-text"><small class="text-white">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="card bg-danger text-white">
            <img src="{{asset('img/source/content-3.jpg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              <button class="btn btn-danger btn-sm">Detail</button>
              <p class="card-text"><small class="text-white">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="card bg-warning text-white">
            <img src="{{asset('img/source/content-1.jpg')}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
              <button class="btn btn-danger btn-sm">Detail</button>
              <p class="card-text"><small class="text-white">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
      @include('template_blog.widget')
    </div>

  </div>
</main>

@endsection