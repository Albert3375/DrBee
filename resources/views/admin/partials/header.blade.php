    <header class="app-header navbar" style="background-color: white;">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="{{ URL('/') }}">
        <img src="{{ asset('img/logo.png') }}" style="width: auto !important; height: auto !important; max-width: 100%; margin: 10px;">
        <img class="navbar-brand-minimized" src="{{ asset('images/icon.png')}} }}" width="30" height="30">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav ml-auto">
        <li style="padding-right: 15px;">
          <a class="buttons" href="{{ URL('logout') }}">
            <h5 style="color:black;">
              <i class="fa fa-sign-out"></i>
              @lang('menu.logout')
            </h5>
          </a>
        </li>
      </ul>
    </header>
