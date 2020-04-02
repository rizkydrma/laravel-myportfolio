@extends('template_blog.main')

@section('title', $title)

@section('content')
@foreach ($content as $item)
<main>
  <div class="container">
    <div class="row mt-4">
      <div class="col-lg-8 col-sm-12">
        {{-- Banner --}}
        <div class="blog-detail">
          @if (preg_match("/post/i", $item->image))
          <img src="{{ asset('/img/post/'.$item->image) }}" alt="" class="img-fluid rounded-lg">
          @else
          <img src="{{ asset('/img/source/'.$item->image) }}" alt="" class="img-fluid rounded-lg">
          @endif
        </div>

        {{-- Content --}}
        <div class="content-detail content bg-card">
          <h2 class="text-primary">{{ $item->title }}</h2>
          @if (isset($item->category->name))
          <h6 class="text-secondary bold">{{ $item->category->name }}</h6>
          @endif
          <p class="card-text">
          <img src="{{ asset('img/avatar/avatar-1.png') }}" alt="" class="rounded-circle" style="width: 1.5rem"> 
          <small class="text-secondary bold"> {{ $item->user->name }} </small>
          <i class="fas fa-clock text-secondary ml-5"> <small class="text-muted text-secondary">{{ $item->created_at->diffForHumans() }}</small> </i>  
          </p>
          <div class="text-secondary text-justify">
            {!! $item->content !!}
          </div>
          <p class="card-text">
            <small class="text-muted text-secondary">
              Tags :
              @foreach ($item->tag as $data)
              {{$data->name}},
              @endforeach
            </small>
          </p>
        </div>

        {{-- other Post --}}
        <div class="row justify-content-between mt-5">
          <div class="col-lg-4 col-sm-12">
            @if ($previous)
            <div class="card bg-card direct-content">
              <div class="card-body">
                <p class="text-secondary">{{ $previous->title }}</p>
                @if (preg_match("/post/i", $item->image))
                <a href="{{ route('blog.detail', $previous->slug) }}" class="text-primary">
                  @else
                  <a href="{{ route('source.detail', $previous->slug) }}" class="text-primary">
                    @endif
                    <span aria-hidden="true">&laquo;</span>
                    Detail
                  </a>
              </div>
            </div>
            @endif

          </div>
          @if ($next)
          <div class="col-lg-4 col-sm-12">
            <div class="card bg-card direct-content">
              <div class="card-body">
                <p class="text-secondary">{{ $next->title }}</p>
                @if (preg_match("/post/i", $item->image))
                <a href="{{ route('blog.detail', $next->slug) }}" class="text-primary">
                  @else
                  <a href="{{ route('source.detail', $next->slug) }}" class="text-primary">
                    @endif
                    Detail
                    <span aria-hidden="true">&raquo;</span>
                  </a>
              </div>
            </div>
          </div>
          @endif

        </div>

        {{-- Comments --}}
        <div class="bg-card p-4">
        <form action="{{ route('blog.comment.store', $item) }}" method="post">
          {{ csrf_field() }}
          <label for="comment" class="text-secondary">Leave a Comment</label>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <input type="text" class="form-control form-control-sm
                  @error('name')
                  is-invalid
                  @enderror
                " id="name" name="name" placeholder="Fullname" value="{{ old('name') }}">
                  @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <input type="email" class="form-control form-control-sm
                  @error('email')
                  is-invalid
                  @enderror
                " id="email" name="email" placeholder="Email Address" value="{{ old('email')}}">
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control
              @error('message')
              is-invalid
              @enderror
            " id="message" rows="3" name="message" placeholder="Enter your message">{{ old('name')}}</textarea>
              @error('message')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
              <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
            </div>
          </form>

          {{-- All Comments --}}
          @foreach ($item->comments()->get() as $comment)
          <div class="comment text-secondary">  
            <div class="col-lg-12 col-sm-12">
              <div class="row">
                <div class="col-1">
                  <img src="{{ asset('img/avatar/avatar-1.png') }}" class="d-inline rounded-circle" alt="..." style="width: 3.5rem">
                </div>
                <div class="col-8 offset-1 p-1">
                  <h6>{{ $comment->name }}</h6>
                <p><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-sm-12">
              <p>
                {{ strip_tags($comment->message) }}
              </p>
            </div>
          </div>
        @endforeach


        </div>
      </div>
      @include('template_blog.widget')

    </div>
  </div>
</main>
@endforeach

@endsection