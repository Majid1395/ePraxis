<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
        <!-- Authentication Links -->
        @guest
            <li>
                <a title="Login" class="nav-link active" href="{{ route('login') }}">
                    <i class="me-2 icon-md" data-feather="login"></i>{{ __('Anmelden') }}
                </a>
            </li>
        @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->vorname}} {{Auth::user()->name}}
            </a>
          <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
              <div class="mb-3">
                  @if(Auth::user())
                      <img class="wd-80 ht-80 rounded-circle" src="{{asset('/assets/images/users')}}/{{Auth()->user()->bild}}" alt="">
                  @else
                      <img class="wd-80 ht-80 rounded-circle" src="{{asset('/assets/images/default.png')}}" alt="">
                  @endif
              </div>
              <div class="text-center">
                  @if(Auth::user())
                      <p class="tx-16 fw-bolder">{{Auth()->user()->vorname}} {{Auth()->user()->name}}</p>
                      <p class="tx-12 text-muted">{{Auth()->user()->email}}</p>
                  @else
                      <p class="tx-16 fw-bolder">example</p>
                      <p class="tx-12 text-muted">example@hotmail.com</p>
                  @endif
              </div>
            </div>
            <ul class="list-unstyled p-1">
                <li class="dropdown-item py-2">
                    <a href="{{url('/')}}" class="text-body ms-0" title="Dashboard">
                        <i class="me-2 icon-md" data-feather="home"></i>
                        <span>Home</span>
                    </a>
                </li>
              <li class="dropdown-item py-2">
                <a href="{{url('benutzer-profil')}}" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="user"></i>
                  <span>Profil</span>
                </a>
              </li>
              <li class="dropdown-item py-2">
                <a href="{{route('logout')}}" onclick=" event.preventDefault(); document.getElementById('logout-form').submit();" class="text-body ms-0">
                  <i class="me-2 icon-md" data-feather="log-out"></i>
                  <span>{{__('Abmelden')}}</span>
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form>
              </li>
            </ul>
          </div>
        </li>
      @endguest
    </ul>
  </div>
</nav>
