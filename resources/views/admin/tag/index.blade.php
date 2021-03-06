@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row justify-content-between">
  <div class="col-lg-4 col-sm-6">
    <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTag">
      <i class="fas fa-plus mx-2"></i>Add tag</a>
  </div>
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('tag.trash') }}" class="btn btn-danger btn-block">
      <i class="fas fa-undo mx-2"></i>Trashed tag</a>
  </div>
  <div class="col-lg-4 col-sm-6">
    <a href="#" class=" btn btn-warning btn-block" id="btn-deleteAll">
      <i class="fas fa-trash mx-2"></i>Delete
      Multiple tag</a>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>tag Table</h4>
    <div class="card-header-form">
      <form action="{{ route('tag.search') }}" method="GET">
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
        @foreach ($tags as $item => $data)
        <tr>
          <td class="p-0 text-center">
            <div class="custom-checkbox custom-control">
              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input sub-check"
                id="checkbox-{{ $item + $tags->firstitem() }}" data-id="{{ $data->id }}">
              <label for="checkbox-{{ $item + $tags->firstitem() }}" class="custom-control-label">&nbsp;</label>
            </div>
          </td>
          <td>{{ $data->name }}</td>

          <td>{{ $data->slug }}</td>
          <td>
            @if (isset($data->created_at))
            {{ $data->created_at->diffForHumans() }}
            @endif
          </td>
          <td>
            <div class="d-inline d-flex">
              <a class="btn btn-primary btn-action mr-1 show-modal" data-toggle="modal" data-target="#modalTagEdit"
                modal="tag" data-id="{{ $data->id }}" title="Edit"><i class="fas fa-pencil-alt"></i></a>

              <form action="{{ route('tag.destroy', $data->id) }}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-action btn-delete" title="Delete"
                  data-id={{ $data->id }}><i class="fas fa-trash"></i></a>

              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($tags as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $tags->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('tag.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">tag</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a new tag" name="name"
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
<div class="modal fade" id="modalTagEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="" id="editModal">
        <div class="modal-body edit">
          <div class="bungkus">
            <div class=" form-group">
              <label for="name">tag</label>
              <input type="text" class="form-control" placeholder="Enter a new tag" name="name">
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