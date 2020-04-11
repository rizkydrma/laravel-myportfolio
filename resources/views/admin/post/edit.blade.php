@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col">
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('patch')
      <div class="form-group">
        <label>title</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="title"
          value="{{ $post->title }}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
          <option value="" holder>Choose category</option>
          @foreach ($category as $item)
          <option value="{{ $item->id }}" @if ($item->id == $post->category_id)
            selected
            @endif
            > {{ $item->name }} </option>
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
          <option value="{{ $tag->id }}" @foreach ($post->tag as $value)
            @if ($tag->id == $value->id)
            selected
            @endif
            @endforeach
            >{{ $tag->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Content</label>
        <button class="btn btn-primary btn-sm ml-2" type="button" id="typeEditor">Use Manual Editor</button>
        <div class="ckeditor">
          <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Enter a content"
          id="content">{{ $post->content }}</textarea>
        </div>
        <div class="manual">
          <textarea name="content" id="manual" cols="100" rows="35">{{ $post->content }}</textarea>
        </div>
          @error('content')
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

      <button class="btn btn-primary btn-block">Save Post</button>
    </form>
  </div>
</div>

@endsection