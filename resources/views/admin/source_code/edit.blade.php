@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col">
    <form action="{{ route('sourcecode.update', $sourcecode->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control
          @error('title')
            is-invalid
          @enderror
        " value="{{ $sourcecode->title }}" name="title" placeholder="Enter new title">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Tags</label>
        <select class="form-control select2" multiple="" name="tags[]">
          @foreach ($tags as $tag)
          <option value="{{ $tag->id }}" @foreach ($sourcecode->tag as $item)
            @if ($tag->id == $item->id)
            selected
            @endif
            @endforeach
            >{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Content</label>
        <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Enter a content" id="content">
          {{ $sourcecode->content }}
        </textarea>
        @error('content')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Color</label>
        <select class="form-control" name="color">
          @if (isset($sourcecode->color))
          <option value="{{ $sourcecode->color }}">{{ $sourcecode->color }}</option>
          @endif
          <option value="bg-primary">bg-primary</option>
          <option value="bg-success">bg-success</option>
          <option value="bg-warning">bg-warning</option>
          <option value="bg-info">bg-info</option>
          <option value="bg-danger">bg-danger</option>
          <option value="bg-secondary">bg-secondary</option>

        </select>
      </div>

      <div class="form-group">
        <label>Link Download</label>
        <input type="text" class="form-control" name="download" placeholder="Enter new download"
          value="{{ $sourcecode->download }}">
        @error('download')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Link Video</label>
        <input type="text" class="form-control" name="video" placeholder="Enter new video"
          value="{{ $sourcecode->video }}">
        @error('video')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Thumbnail</label>
        <input type="file" name="image" class="form-control">
        @error('image')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <button class="btn btn-primary btn-block">Save Source</button>
    </form>
  </div>
</div>


@endsection