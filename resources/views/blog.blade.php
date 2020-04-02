@extends('template_blog.main')

@section('title', $title)

@section('header')
<div class="jumbotron jumbotron-fluid shadow-img">
  <div class="container">
    <h1 class="display-4 text-white">WELCOME TO MY BLOG</h1>
    <p class="lead bold text-light">
      Jangan membaca sampai koma, tapi bacalah sampai titik
    </p>
    <button class="btn btn-warning rounded-pill">Ayo Mulai</button>
  </div>
</div>
@endsection

@section('content')
<main>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-12">
        <div class="content">
          <h4 class="text-secondary">Recent Post</h4>
          @foreach ($posts as $item)
          <div class="card mb-3 bg-card">
            <div class="row no-gutters">
              <div class="col-md-4">
                <a href="{{ route('blog.detail', $item->slug) }}">
                  <img src="{{ asset('/img/post/'.$item->image) }}" class="card-img" alt="..." class="img-fluid" />
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <a href="{{ route('blog.detail', $item->slug) }}">
                    <h5 class="card-title text-primary">{{ $item->title }}</h5>
                  </a>
                  <h6 class="card-subtitle text-warning" style="display: inline-block">
                    {{ $item->category->name }}</h6>
                  <span class="badge badge-warning rounded-pill">{{ $item->user->name }}</span>
                  <div class="text-secondary">
                    {!! strip_tags((str_word_count($item->content) > 30 ? substr($item->content,0,150)."..." : $item->content)) !!}
                  </div>
                  <p class="card-text">
                    <small class="text-muted text-secondary">{{ $item->created_at->diffForHumans() }}</small>
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @include('template_blog.widget')
    </div>

    {{ $posts->links() }}
    {{-- <nav aria-label="Page navigation bg-card mt-5">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav> --}}
  </div>
</main>

@endsection