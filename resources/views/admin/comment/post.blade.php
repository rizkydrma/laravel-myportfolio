@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row justify-content-between">
  <div class="col-lg-4 col-sm-6">
    <a href="#" class=" btn btn-warning btn-block" id="btn-deleteAll">
      <i class="fas fa-trash mx-2"></i>Delete
      Multiple Comment</a>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Post Commentar Table</h4>
    <div class="card-header-form">
      <form action="{{ route('post-comment.search') }}" method="GET">
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
            <div class="custom-checkbox custom-control">
              <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input"
                id="checkbox-all">
              <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
            </div>
          </th>
          <th>Name</th>
          <th>Email</th>
          <th>Message</th>
          <th>created</th>
          <th>Action</th>
        </tr>
        @foreach ($post_comment as $item => $data)
        <tr>
          <td class="p-0 text-center">
            <div class="custom-checkbox custom-control">
              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input sub-check"
                id="checkbox-{{ $item + $post_comment->firstitem() }}" data-id="{{ $data->id }}">
              <label for="checkbox-{{ $item + $post_comment->firstitem() }}" class="custom-control-label">&nbsp;</label>
            </div>
          </td>
          <td>{{ $data->name }}</td>

          <td>{{ $data->email }}</td>
          <td>{{ $data->message }}</td>
          <td>{{ $data->created_at->diffForHumans() }}</td>
          <td>
            <div class="d-inline d-flex">
              <form action="{{ route('post-comment.destroy', $data->id) }}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-action btn-delete" title="Delete"
                  data-id={{ $data->id }}><i class="fas fa-trash"></i></a>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($post_comment as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $post_comment->links() }}
    </div>
  </div>
</div>
@endsection
