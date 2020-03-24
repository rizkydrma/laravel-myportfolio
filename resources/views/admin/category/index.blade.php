@extends('template_backend.main')

@section('title', $title)

@section('content')
<a href="#" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal">Add Category</a>
<div class="card">
  <div class="card-header">
    <h4>Category Table</h4>
    <div class="card-header-form">
      <form>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
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
            <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                class="fas fa-pencil-alt"></i></a>
            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
              data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
              data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
        @endforeach
      </table>
      {{ $category->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('category.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a new category" name="name">
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
@endsection