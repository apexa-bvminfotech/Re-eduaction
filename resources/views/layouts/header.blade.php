<nav class="main-header navbar navbar-expand navbar-white navbar-light">
       <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <h4 style="margin-top: 6px ; font-weight: bold;">Welcome {{auth()->user()->name, auth()->user()->surname}}</h4>
        </li>
        <li class="nav-item d-none d-sm-inline-block"></li>
    </ul>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                  @if(file_exists(asset('assets/user/'. Auth::user()->user_profile )))
                    <img src="{{ asset('assets/user/'. Auth::user()->user_profile ) }}" alt="..." class="avatar-img rounded-circle" style="border-radius: 10px;width: 30px;height: 30px;">
                  @else
                      <img src="{{asset('assets/student/images/dummy-profile.jpeg' )}}" alt="..." class="avatar-img rounded-circle" style="border-radius: 10px;width: 30px;height: 30px;">
                  @endif
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route('profile')}}">Profile</a>
                {{-- <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activities</a> --}}
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
         <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
