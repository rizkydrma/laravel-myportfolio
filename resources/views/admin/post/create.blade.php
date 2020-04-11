@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col">
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Judul</label>
        <input type="text" class="form-control" name="title" placeholder="Enter new judul">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control selectric">
          <option value="" holder>Choose category</option>
          @foreach ($category as $data)
          <option value="{{ $data->id }}"> {{ $data->name }} </option>
          @endforeach
        </select>
        @error('category_id')
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
        <textarea name="content"  cols="120" rows="25">{{ old('content') }}</textarea>
        </div>
        @error('content')
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

      <button class="btn btn-primary btn-block">Save Post</button>
    </form>
  </div>
</div>


@endsection