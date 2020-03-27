@include('template_backend.header')
@include('template_backend.sidebar')

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h4>@yield('title')</h3>
    </div>
    <div class="section-body">
      {{-- NOTIFICATION SWEET ALERT --}}
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
      {{-- NOTIFICATION SWEET ALERT --}}
      @yield('content')
    </div>
  </section>
</div>

@yield('modal')
@include('template_backend.footer')