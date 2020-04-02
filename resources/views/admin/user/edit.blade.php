@extends('template_backend.main')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col">
    <form action="{{ route('user.update', $user->id) }}" method="POST">
      @csrf
      @method('put')
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
          placeholder="Enter username" value="{{ $user->name }}">
        @error('name')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
          placeholder="Enter your email" value="{{ $user->email }}" readonly>
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
          <option value="1" {{ $user->role == 1 ? 'selected' : ' '  }}>Administrator</option>
          <option value="2" {{ $user->role == 2 ? 'selected' : ' '  }}>Author</option>
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
      <button class="btn btn-primary btn-block">Update User</button>
    </form>
  </div>
</div>
@endsection