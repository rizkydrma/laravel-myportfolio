@extends('template_backend.main')

@section('content')
<section>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Admin</h4>
                </div>
                <div class="card-body">
                    @if (isset($users))
                    {{ $users->count() }}
                    @else 
                    0
                    @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-success">
                <i class="fas fa-eye"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Post</h4>
                </div>
                <div class="card-body">
                    @if (isset($posts))
                    {{ $posts->count() }}
                    @else 
                    0
                    @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-info">
                <i class="fas fa-code"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Source Code</h4>
                </div>
                <div class="card-body">
                    @if (isset($sourcecodes))
                    {{ $sourcecodes->count() }}
                    @else 
                    0
                    @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                <i class="fas fa-video"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Video Tutorial</h4>
                </div>
                <div class="card-body">
                    @if (isset($videos))
                    {{ $videos->count() }}
                    @else 
                    0
                    @endif
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row text-center">
                <div class="col-6" style="border-right: 1px solid #aaa;">
                    <h5>Category</h5>
                    <hr>
                    @foreach ($categories as $item)
                        <h6>{{ $item->name }}</h6>
                    @endforeach
                </div>
                <div class="col-6">
                    <h5>Tag</h5>
                    <hr>
                    @foreach ($tags as $item)
                        <h6>{{ $item->name }}</h6>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-hero">
                <div class="card-header">
                    <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                    </div>
                    <h4>{{ $sourcecomment->count() }}</h4>
                    <div class="card-description">Latest Sourcecode Commentar</div>
                </div>
                <div class="card-body p-0">
                    <div class="tickets-list">
                    @foreach ($sourcecomment as $item)
                        <a href="#" class="ticket-item">
                            <div class="ticket-title">
                            <p>{{ Str::limit($item->message,100) }}</p>
                            </div>
                            <div class="ticket-info">
                            <div>{{ $item->name }}</div>
                            <div class="bullet"></div>
                            <div class="text-primary">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    @endforeach
                      <a href="{{ route('source-comment.show') }}" class="ticket-item ticket-more">
                            View All <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-hero">
                <div class="card-header">
                    <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                    </div>
                    <h4>{{ $comments->count() }}</h4>
                    <div class="card-description">Latest Post Commentar</div>
                </div>
                <div class="card-body p-0">
                    <div class="tickets-list">
                    @foreach ($comments as $item)
                        <a href="#" class="ticket-item">
                            <div class="ticket-title">
                            <p>{{ Str::limit($item->message,100) }}</p>
                            </div>
                            <div class="ticket-info">
                            <div>{{ $item->name }}</div>
                            <div class="bullet"></div>
                            <div class="text-primary">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                        </a>
                    @endforeach
                      <a href="{{ route('post-comment.show') }}" class="ticket-item ticket-more">
                            View All <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection