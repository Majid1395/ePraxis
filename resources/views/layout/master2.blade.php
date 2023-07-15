<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive Laravel Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, laravel, theme, front-end, ui kit, web">

    <title>ePraxis - Admin</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- Icon -->
  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div  id="app">
        @if(Auth::user())
        <nav class="navbar">
            <a href="{{ url('/') }}" class="sidebar-toggler">
                {{ ('ePraxis') }}
            </a>
            <div class="navbar-brand">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->vorname }} {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                             @if(auth()->check()&& auth()->user()->rolle->name === 'patient')
                            <a href="{{url('benutzer-profil')}}"  class="dropdown-item"style="color: #000; font-size:16px; font-weight: bold;">Profil</a>
                            @else
                             <a href="{{url('dashboard')}}"  class="dropdown-item">Dashboard</a>
                            @endif
                            <a href="{{route('logout')}}" onclick=" event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>{{__('Abmelden')}}</span>
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">@csrf</form>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
        @endif
    </div>
    <div class="page-wrapper full-page">
        <main>
            @yield('content')

        </main>
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>
</html>
