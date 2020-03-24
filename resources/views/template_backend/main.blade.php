@include('template_backend.header')
@include('template_backend.sidebar')

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h4>@yield('title')</h3>
    </div>
    <div class="section-body">
      @yield('content')
    </div>
  </section>
</div>

@yield('modal')
@include('template_backend.footer')