<div class="col-lg-4 col-sm-12">
  @if (isset($categories))
  <h4 class="text-secondary">Category</h4>
  <ul class="list-group bg-card">
    @foreach ($categories as $item)
    <li class="list-group-item bg-card">
      <div class="row">
        <div class="col">
          <a href="{{ route('blog.category', $item->slug) }}" class="text-secondary">
            {{ $item->name }}
          </a>
        </div>
        <div class="col text-right">
          <span class="badge badge-pill badge-primary">{{ $item->post->count() }}</span>
        </div>
      </div>
    </li>
    @endforeach
  </ul>
  @endif

  <div class="bg-card p-3 mt-3">
    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalCenter">
      Search Something
    </button>
  </div>

  
  <div class="bg-card p-3 mt-3">
    <h5 class="text-secondary">Tags</h5> 
    @foreach ($tag_count as $tag)
    @foreach ($tags as $item)
        @if ($tag->tag_id == $item->id)
        @if ($title == 'Blog')
        <a href="{{ route('blog.tag', $item->slug) }}">
          @else
          <a href="{{ route('source.tag', $item->slug) }}"> 
        @endif
          <span class="badge badge-secondary">{{ $item->name }} <span class="badge badge-light"> 
            {{ $tag->total }}
          </span></span>
        </a>
        @endif
    @endforeach
    @endforeach
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-card">
        <div class="modal-header">
          <h5 class="modal-title text-secondary" id="exampleModalCenterTitle">Search Something </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if (isset($categories))
        <form action="{{ route('blog.search') }}" method="GET">
          @else
          <form action="{{ route('source.search') }}" method="GET">
            @endif
            <div class="modal-body ">
              <div class="form-group">
                <input type="text" class="form-control" id="search" name="search" placeholder="Enter something">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>