@extends('template_backend.main')

@section('title', $title)

@section('content')
@if (session('status'))
<div class="flashdata" data-flashdata="{{ session('status') }}"></div>
@else
@if (count($errors)>0)
<div class="flashdata" data-flashdata="
@error('name')
{{ $message }}
@enderror
">
</div>
@else
<div class="flashdata" data-flashdata=""></div>
@endif
@endif


<div class="row">
  <div class="col-lg-3 col-sm-6">
    <a href="{{ route('category.index') }}" class="btn btn-primary btn-block ml-4">Add Category</a>
  </div>
  <div class="col-lg-3 col-sm-6">
    <a href="{{ route('category.trash') }}" class="btn btn-danger btn-block">Trashed Category</a>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>Category Table</h4>
    <div class="card-header-form">
      <form action="{{ route('category.search') }}" method="GET">
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
          <th>slug</th>
          <th>created</th>
          <th>Action</th>
        </tr>
        @foreach ($category as $item => $data)
        <tr>
          <td class="p-0 text-center">
            <div class="custom-checkbox custom-control ">
              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input sub-check"
                id="checkbox-{{ $item + $category->firstitem() }}">
              <label for="checkbox-{{ $item + $category->firstitem() }}" class="custom-control-label">&nbsp;</label>
            </div>
          </td>
          <td>{{ $data->name }}</td>

          <td>{{ $data->slug }}</td>
          <td>{{ $data->created_at->diffForHumans() }}</td>
          <td>
            <div class="d-inline d-flex">
              <a href="{{ route('category.restore', $data->id) }}" class="btn btn-info btn-action mr-1"
                title="Restore"><i class="fas fa-undo"></i></a>

              <form action="{{ route('category.kill', $data->id) }}}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-warning btn-action btn-delete" title="Delete"
                  data-id={{ $data->id }}><i class="fas fa-trash"></i></a>

              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($category as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $category->links() }}
    </div>
  </div>
</div>
@endsection