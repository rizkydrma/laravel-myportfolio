<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Rizky Darma App</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">RD</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      <li class="menu-header">Management Data</li>
      <li class="
        @if (session('active') == 'post')
            active
        @endif
    "><a class="nav-link" href="{{ route('post.index') }}"><i class="fas fa-pen-alt"></i> <span>Post</span></a></li>
      <li class="
        @if (session('active') == 'sourcecode')
            active
        @endif
      "><a class="nav-link" href="{{ route('sourcecode.index') }}"><i class="fas fa-code"></i> <span>Source
            Code</span></a></li>
      <li><a class="nav-link" href="blank.html"><i class="fas fa-video"></i> <span>Video Tutorial</span></a></li>
      <li class="
      @if (session('active') == 'category')
          active
      @endif
    "><a class="nav-link" href="{{ route('category.index') }}"><i class="fas fa-asterisk"></i>
          <span>Category</span></a>
      </li>
      <li class="
      @if (session('active') == 'tag')
          active
      @endif
      "><a class="nav-link" href="{{ route('tag.index') }}"><i class="fas fa-gavel"></i> <span>Tag</span></a></li>

      <li class="menu-header">Management User</li>
      <li class="
      @if (session('active') == 'user')
          active
      @endif
      "><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
      <li class="menu-header">Management Bio</li>
      <li class="
      @if (session('active') == 'bio')
          active
      @endif
      "><a class="nav-link" href="{{ route('bio.index') }}"><i class="fas fa-user"></i> <span>Management Bio</span></a>
      </li>
    </ul>

  </aside>
</div>