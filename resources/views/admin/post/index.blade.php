@extends('template_backend.main')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('post.create') }}" class="btn btn-primary btn-block">
      <i class="fas fa-plus mx-2"></i>Add Post</a>
  </div>
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('post.trash') }}" class="btn btn-danger btn-block">
      <i class="fas fa-undo mx-2"></i>Trashed post</a>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h4>Post Table</h4>
    <div class="card-header-form">
      <form action="{{ route('post.search') }}" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
          <div class="input-group-btn">
            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th class="text-center">
            No
          </th>
          <th>Title</th>
          <th>Category</th>
          <th>Tags</th>
          <th>Creator</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        @foreach ($posts as $item => $data)
        <tr>
          <td class="p-0 text-center">
            {{ $item + $posts->firstitem() }}
          </td>
          <td>{{ $data->title }}</td>
          <td>{{ $data->category->name }}</td>
          <td>
            <ul>
              @foreach ($data->tag as $item)
              <h6>
                <span class="badge badge-info">{{ $item->name }}</span>
              </h6>
              @endforeach
            </ul>
          </td>
          <td>{{ $data->user->name }}</td>
          <td>
            <img src="{{ asset('/img/post/'.$data->image) }}" alt="gambar {{ $data->id }}"
              class="img-fluid img-thumbnail" style="width: 7rem;">
          </td>
          <td>
            <div class="d-inline d-flex">
              <a href="{{ route('post.edit', $data->id) }}" class="btn btn-primary btn-action mr-1 show-modal"
                title="Edit"><i class="fas fa-pencil-alt"></i></a>

              <form action="{{ route('post.destroy', $data->id) }}}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-action btn-delete" title="Delete"
                  data-id={{ $data->id }}><i class="fas fa-trash"></i></a>

              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($posts as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection