@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col">
    <form action="{{ route('sourcecode.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter new title">
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
          <option value="{{ $tag->id }}">{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <div class="d-flex mb-2">
          <label>Content</label>
          <button class="btn btn-primary btn-sm ml-2" type="button" id="typeEditor">Use Manual Editor</button>
        </div>
        <div class="ckeditor">
          <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Enter a content"
            id="content">
            {{ old('content')}}
          </textarea>
        </div>
        <div class="manual">
        <textarea name="content" id="manual" class="form-control" cols="150" rows="25" style="height: 200px">{{ old('content') }}</textarea>
        </div>
        @error('content')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Color</label>
        <select class="form-control" name="color">
          <option value="" holder>Choose Color</option>
          <option value="bg-primary">Blue</option>
          <option value="bg-success">Green</option>
          <option value="bg-warning">Yellow</option>
          <option value="bg-info">Light Blue</option>
          <option value="bg-danger">Red</option>
          <option value="bg-secondary">Grey</option>

        </select>
      </div>

      <div class="form-group">
        <label>Link Download</label>
        <input type="text" class="form-control" name="download" placeholder="Enter new download">
        @error('download')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Link Video</label>
        <input type="text" class="form-control" name="video" placeholder="Enter new video">
        @error('video')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label class="col-form-label">Thumbnail</label>
        <div class="col-sm-12 col-md-7">
          <div id="image-preview" class="image-preview">
            <label for="image-upload" id="image-label">Choose File</label>
            <input type="file" name="image" id="image-upload" />
          </div>
        </div>
      </div>

      <button class="btn btn-primary btn-block">Save Source</button>
    </form>
  </div>
</div>



@endsection