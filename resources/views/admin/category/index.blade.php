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
    <a href="#" class="btn btn-primary btn-block ml-4" data-toggle="modal" data-target="#modalCategory">Add Category</a>
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
            <div class="custom-checkbox custom-control">
              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                id="checkbox-{{ $item + $category->firstitem() }}">
              <label for="checkbox-{{ $item + $category->firstitem() }}" class="custom-control-label">&nbsp;</label>
            </div>
          </td>
          <td>{{ $data->name }}</td>

          <td>{{ $data->slug }}</td>
          <td>{{ $data->created_at->diffForHumans() }}</td>
          <td>
            <div class="d-inline d-flex">
              <a class="btn btn-primary btn-action mr-1 show-modal" data-toggle="modal" data-target="#modalCategoryEdit"
                modal="category" data-id="{{ $data->id }}" title="Edit"><i class="fas fa-pencil-alt"></i></a>

              <form action="{{ route('category.destroy', $data->id) }}}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-action btn-delete" title="Delete"
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

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('category.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a new category" name="name"
              value="{{ old('name') }}">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Data</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="modalCategoryEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="" id="editCategory">
        <div class="modal-body edit">
          <div class="bungkus">
            <div class=" form-group">
              <label for="name">Category</label>
              <input type="text" class="form-control" placeholder="Enter a new category" name="name">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Data</button>
          @csrf
          @method('patch')
      </form>
    </div>

  </div>
</div>
</div>
@endsection