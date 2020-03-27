@extends('template_backend.main')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-lg-4 col-sm-6">
    <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalUser">
      <i class="fas fa-plus mx-2"></i>Add user</a>
  </div>
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('user.trash') }}" class="btn btn-danger btn-block">
      <i class="fas fa-undo mx-2"></i>Trashed user</a>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <h4>user Table</h4>
    <div class="card-header-form">
      <form action="{{ route('user.search') }}" method="GET">
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
          <th>Created</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
        @foreach ($users as $item => $data)
        <tr>
          <td class="p-0 text-center">
            <div class="custom-checkbox custom-control">
              <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input sub-check"
                id="checkbox-{{ $item + $users->firstitem() }}" data-id="{{ $data->id }}">
              <label for="checkbox-{{ $item + $users->firstitem() }}" class="custom-control-label">&nbsp;</label>
            </div>
          </td>
          <td>{{ $data->name }}</td>

          <td>{{ $data->email }}</td>
          <td>{{ $data->created_at->diffForHumans() }}</td>
          <td>
            @if ($data->role == 1)
            <span class="badge badge-info"> Administrator </span>
            @else
            <span class="badge badge-warning"> Author </span>
            @endif
          </td>
          <td>
            <div class="d-inline d-flex">
              <a href="{{ route('user.restore', $data->id) }}" class="btn btn-info btn-action mr-1 show-modal"
                title="Edit"><i class="fas fa-undo"></i></a>

              <form action="{{ route('user.kill', $data->id) }}}" method="POST" id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-warning btn-action btn-delete" title="Delete"
                  data-id={{ $data->id }}><i class="fas fa-trash"></i></a>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($users as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('user.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">user</label>
            <input type="text" class="form-control" id="name" placeholder="Enter a new user" name="name"
              value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              placeholder="Enter your email" value="{{ old('email') }}">
            @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control">
              <option value="" holder>Choose Role</option>
              <option value="1" @if(old('role')==1) selected @endif>Administrator</option>
              <option value="2" @if(old('role')==2) selected @endif>Author</option>
            </select>
            @error('role')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
              autocomplete="off">
            @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
              name="password_confirmation" autocomplete="off">
            @error('password_confirmation')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
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