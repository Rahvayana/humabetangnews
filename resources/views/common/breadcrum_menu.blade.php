<ol class="breadcrumb"> 
  <!-- Breadcrumb-->
    @yield('breadcrumb')


    <!-- Breadcrumb Menu-->
    <li class="breadcrumb-menu d-md-down-none">
      <div class="btn-group" role="group" aria-label="Button group">
        <a class="btn" href="#">
          <i class="icon-speech"></i>
        </a>
      <a class="btn" href="{{url('dashboard')}}">
          <i class="icon-graph"></i>  Dashboard</a>
        {{-- <a class="btn" href="#">
          <i class="icon-settings"></i>  Settings</a> --}}
      </div>
    </li>
  </ol>