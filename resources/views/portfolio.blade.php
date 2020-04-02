@extends('template_blog.main')

@section('title', $title)

@section('content')
<!-- Header -->
<section class="header">
  <div class="container ">
    <div class="row d-flex flex-sm-row-reverse">
      <div class="col-lg-6 col-sm-12 mt-5">
        <div class="big-circle-2">
          <div class="big-circle"></div>
        </div>
        <div class="bio-image text-center">
          <img src="{{ asset('img/portfolio/bio-min.png') }}" alt="" class="img-fluid fade">
        </div>
        <div class="small-circle circle-1"></div>
        <div class="small-circle circle-2"></div>
        <div class="small-circle circle-3"></div>
        <div class="small-circle circle-4"></div>
        <div class="small-circle circle-5"></div>
      </div>
      <div class="col-lg-6 col-sm-12 branding p-5">
        <div class="col-sm-12">
          <h3 class="text-primary fade" style="font-weight: bold;">HELLO, IM RIZKY DARMA</h3>
        </div>
        <div class="col-sm-12">
          <h1 class="text-secondary bold fade">WEB DEVELOPER</h1>
        </div>
        <div class="col-sm-12">
          <p class="text-secondary fade" style="letter-spacing: 3px;">I Want To Be A Fullstack Web
            Developer</p>
        </div>
        <div class="col-lg-5 col-sm-12">
          <a href="#" class="btn btn-primary rounded-pill btn-block fade">Get Acquainted</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Header-->
<!-- Specialiazation -->
<section class="special mt-3">
  <div class="container">
    <hr>
    <div class="card card-special fade bg-card">
      <div class="card-body">
        <h4 class="card-subtitle mb-2 text-center text-primary bold">WHAT I DO</h4>
        <h2 class="card-title text-center text-secondary">SPECIALIZATION IN</h2>
        <div class="row p-2">
          @foreach ($users->skill as $item)
          <div class="col-lg-6 col-sm-12">
          <label class="text-secondary">{{ $item->name }}</label>
            <div class="progress" style="height: 25px;">
            <div class="progress-bar progress-bar-striped {{ $item->color }}" role="progressbar" style="width: {{ $item->percentase }}%;"
                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Specialiazation -->

<!-- About Me -->
<section class="about mt-5">
  <div class="container">
    <hr>
    <div class="row">
      <div class="col-lg-4 col-sm-12 text-center p-5">
        <img src="{{ asset('img/portfolio/bio-image-min.png')}}" alt="image-me-rounded-small"
          class="img-fluid rounded-circle" style="border: 5px solid #007bff;">
      </div>
      <div class="col-lg-8 col-sm-12 p-5">
        <h2 class="text-primary bold">ABOUT ME</h2>
      <h5 class="text-secondary">{{ $users->bio->about }}</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-sm-12">
        <h5 class=" text-center text-primary">Recent Project</h5>
        <hr>
      </div>
    </div>

    <div class="row justify-content-center">
      @foreach ($users->project()->limit(3)->get() as $item)
        <div class="col-lg-4 col-sm-12 card-deck">
          <div class="card card-special bg-card">
            <div class="card-body">
              <h5 class="card-title text-primary">{{$item->title}}</h5>
              <h6 class="card-subtitle mb-2 text-muted text-secondary">{{$item->technology}}</h6>
            <p class="card-text text-secondary">{{ $item->deskripsi }}</p>
              </div>
              <div class="card-footer">
                <a href="#" class="card-link btn btn-primary btn-sm">Detail</a>
              </div>
            </div>
          </div>
        @endforeach
      
    </div>
</section>
<!-- About Me -->
@endsection