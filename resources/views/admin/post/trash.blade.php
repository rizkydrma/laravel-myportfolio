@extends('template_backend.main')
@section('title', $title)

@section('content')


<div class="row ">
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
  <table class="table table-striped">
    <thead>
      <tr>
        <td>No</td>
        <td>Nama</td>
        <td>Category</td>
        <td>Tags</td>
        <td>Gambar</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post => $data)
      <tr>
        <td>{{ $post + $posts->firstitem() }}</td>
        <td>{{ $data->title }}</td>
        <td>{{ $data->category->name}}</td>
        <td>
          <ul>
            @foreach ($data->tag as $item)
            <li>
              {{ $item->name }}
            </li>
            @endforeach
          </ul>
        </td>
        <td>
          <img src="{{ asset('/data_post/'.$data->image) }}" class="img-fluid img-thumbnail" style="width: 5rem">
        </td>
        <td>
          <div class="d-inline-flex">
            <a href="{{ route('post.restore', $data->id) }}" class="btn btn-info  mr-2"><i class="fas fa-undo"></i></a>
            <form action="{{ route('post.kill', ['id' => $data->id, 'image' => $data->image]) }}" method="POST"
              id="form-{{ $data->id }}">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-warning btn-delete" data-id="{{ $data->id }}"><i
                  class="fas fa-trash"></i></button>
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
    </tbody>
  </table>

  {{ $posts->links() }}

  @endsection