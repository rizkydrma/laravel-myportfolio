@extends('template_blog.main')

@section('title', $title)

@section('content')
<main>
  <div class="container">
    <h1 class="text-center text-secondary my-3">Source Code</h1>
    <div class="row">
      <div class="col-lg-9">
        <div class="card-columns">
          @foreach ($sourcecodes as $item)

          <div class="card {{ $item->color }} text-white">
            <img src="{{asset('img/source/'.$item->image)}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $item->title }}</h5>
              <p class="card-text">{!! strip_tags((str_word_count($item->content) > 20 ?
                substr($item->content,0,100)."..." : $item->content)) !!}</p>
              <a href="{{ route('source.detail', $item->slug) }}" class="btn btn-danger btn-sm">Detail</a>
              <p class="card-text"><small class="text-white">{{ $item->created_at->diffForHumans() }}</small></p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @include('template_blog.widget')
    </div>

  </div>
</main>

@endsection