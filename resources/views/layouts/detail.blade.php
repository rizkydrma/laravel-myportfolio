@extends('template_blog.main')

@section('content')
@foreach ($content as $item)
<main>
  <div class="container blog-detail">
    <div class="row">
      <div class="col-12">
        <img src="{{ asset('/img/post/'.$item->image) }}" alt="" class="img-fluid rounded-lg">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="content-detail content bg-card">
          <h2 class="text-primary">{{ $item->title }}</h2>
          <h6 class="text-secondary bold">{{ $item->category->name }}</h6>
          <p class="card-text">
            <small class="text-muted text-secondary">{{ $item->created_at->diffForHumans() }}</small>
          </p>
          <p class="text-secondary text-justify">
            {!! $item->content !!}
          </p>

        </div>
        <div class="row justify-content-between mt-5">
          <div class="col-lg-3 col-sm-12">
            @if ($previous)
            <div class="card bg-card direct-content">
              <div class="card-body">
                <p class="text-secondary">{{ $previous->title }}</p>
                <a href="{{ route('blog.detail', $previous->slug) }}" class="text-primary">
                  <span aria-hidden="true">&laquo;</span>
                  Detail
                </a>
              </div>
            </div>
            @endif

          </div>
          @if ($next)
          <div class="col-lg-3 col-sm-12">
            <div class="card bg-card direct-content">
              <div class="card-body">
                <p class="text-secondary">{{ $next->title }}</p>
                <a href="{{ route('blog.detail', $next->slug) }}" class="text-primary">Detail
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </div>
            </div>
          </div>
          @endif

        </div>
      </div>
      @include('template_blog.widget')
    </div>
  </div>
</main>
@endforeach

@endsection