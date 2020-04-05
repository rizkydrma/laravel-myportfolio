@extends('template_backend.main')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('sourcecode.create') }}" class="btn btn-primary btn-block">
      <i class="fas fa-plus mx-2"></i>Add sourcecode</a>
  </div>
  <div class="col-lg-4 col-sm-6">
    <a href="{{ route('sourcecode.trash') }}" class="btn btn-danger btn-block">
      <i class="fas fa-undo mx-2"></i>Trashed sourcecode</a>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h4>Sourcecode Table</h4>
    <div class="card-header-form">
      <form action="{{ route('sourcecode.search') }}" method="GET">
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
          <th>Tag</th>
          <th>Download</th>
          <th>Creator</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        @foreach ($sourcecodes as $item => $data)
        <tr>
          <td class="p-0 text-center">
            {{ $item + $sourcecodes->firstitem() }}
          </td>
          <td>{{ $data->title }}</td>
          <td>
            @if (isset($data->category))
              {{ $data->category->name }}
              @endif
            </td>
          <td>
            @foreach ($data->tag as $item)
            <h6>

              <span class="badge badge-info">{{ $item->name }}</span>
            </h6>
            @endforeach
          </td>
          <td>{{ $data->video }}</td>
          <td>{{ $data->user->name }}</td>
          <td>
            <img src="{{ asset('/img/source/'.$data->image) }}" alt="gambar {{ $data->id }}"
              class="img-fluid img-thumbnail" style="width: 7rem;">
          </td>
          <td>
            <div class="d-inline d-flex">
              <a href="{{ route('sourcecode.restore', $data->id) }}" class="btn btn-info mr-1" title="Restore"><i
                  class="fas fa-undo"></i></a>

              <form action="{{ route('sourcecode.kill', ['id' => $data->id, 'image' => $data->image] )}}" method="post"
                id="form-{{ $data->id }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-delete" title="Delete" data-id={{ $data->id }}><i
                    class="fas fa-trash"></i></a>

              </form>
            </div>
          </td>
        </tr>
        @endforeach
        @forelse($sourcecodes as $data)
        @empty
        <tr class='text-center'>
          <td colspan="6">Tidak ada data</td>
        </tr>
        @endforelse
      </table>
      </table>
      {{ $sourcecodes->links() }}
    </div>
  </div>
</div>
@endsection